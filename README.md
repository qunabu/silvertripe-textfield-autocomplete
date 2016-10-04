silvertripe-textfield-autocomplete
=========================

Super Simple Autocomplete text field for Silverstripe

inspired by https://github.com/tractorcow/silverstripe-autocomplete, yet this is a straight forward plain text module. 

usage
=====


```php
TextFieldAutoComplete.php::create('MyTextField','My Text Field','',null,null,'LookupDataObject','LookupFieldName')
```
where it will accept values from the following dataobject field...

```php
class LookupDataObject extends DataObject {
	static $db = array(
		'LookupFieldName'				=> 'Varchar',
	);
}
```
where  `'LookupDataObject'` is `sourceField` and 'LookupFieldName' is `sourceClass`.

In CMS textfiled will have jQuery Autocomplete http://api.jqueryui.com/autocomplete/ (which is part of SilverStripe Admin) attached to itself with `source` attributes filled with all unique string from `sourceField` of `sourceClass`
```php
  DB::query("SELECT DISTINCT $this->sourceField FROM $this->sourceClass");
```