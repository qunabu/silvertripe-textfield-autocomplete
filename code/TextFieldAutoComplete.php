<?php

/**
 * Created by PhpStorm.
 * User: qunabu
 * Date: 03.10.2016
 * Time: 18:41
 *
 * Autocompleting text field, using jQuery.
 *
 * @package    forms
 * @subpackage fields-formattedinput
 */
class TextFieldAutoComplete extends TextField{
  /**
   * Name of the class this field searches.
   *
   * @var string
   */
  private $sourceClass;

  /**
   * Name of the field to use as a filter for searches and results.
   *
   * @var string
   */
  private $sourceField;

  /**
   * @param string      $name         The name of the field.
   * @param null|string $title        The title to use in the form.
   * @param string      $value        The initial value of this field.
   * @param null|int    $maxLength    Maximum number of characters.
   * @param null|string $form
   * @param string      $sourceClass  The suggestion source class.
   * @param string      $sourceField The suggestion source field.
   */
  public function __construct($name, $title = null, $value = '', $maxLength = null, $form = null, $sourceClass = null, $sourceField = null)
  {
    // set source
    $this->sourceClass = $sourceClass;
    $this->sourceField = $sourceField;

    // construct the TextField
    parent::__construct($name, $title, $value, $maxLength, $form);
  }
  /**
   * @param array $properties
   *
   * @return string
   */
  public function Field($properties = array())
  {
    // jQuery Autocomplete Requirements
    Requirements::css(THIRDPARTY_DIR . '/jquery-ui-themes/smoothness/jquery-ui.css');
    Requirements::javascript(THIRDPARTY_DIR . '/jquery/jquery.js');
    Requirements::javascript(THIRDPARTY_DIR . '/jquery-ui/jquery-ui.js');

    // Entwine requirements
    Requirements::javascript(THIRDPARTY_DIR . '/jquery-entwine/dist/jquery.entwine-dist.js');

    // init script for this field
    Requirements::javascript(TEXTFIELDAUTOCOMPLETEFIELD_DIR . '/javascript/TextFieldAutoComplete.js');

    return parent::Field($properties);
  }
  /**
   * @return array
   */
  public function getAttributes()
  {
    $attrs = parent::getAttributes();
    if (isset($attrs['class'])) {
      $attrs['class'] = $attrs['class'] . ' text textfieldautocomplete';
    } else {
      $attrs['class'] = 'text textfieldautocomplete';
    }

    $results = array();
    $values = DB::query("SELECT DISTINCT $this->sourceField FROM $this->sourceClass");
    foreach($values as $value) {
      $results[] = $value[$this->sourceField];
    }

    $attrs['data-source'] = json_encode($results);

    return $attrs;
  }
}

