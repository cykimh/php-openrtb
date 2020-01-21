<?php
namespace openrtb\BidRequest;

class User extends \openrtb\Abstractions\BaseModel {
  
	protected $attributes = array(
		'id' => array (
			'type' => self::ATTR_ID
		),
		'buyeruid' => array (
			'type' => self::ATTR_STRING
		),
		'yob' => array (
			'type' => self::ATTR_INTEGER
		),
		'gender' => array (
			'type' => self::ATTR_STRING
		),
		'keywords' => array (
			'type' => self::ATTR_STRING
		),
		'customdata' => array (
			'type' => self::ATTR_STRING
		),
		'geo' => array (
			'type' => 'openrtb\BidRequest\Geo'
		),
		'data' => array (
			'type' => 'openrtb\BidRequest\Data'
		),
		'ext' => array (
			'type' => 'openrtb\BidRequest\Ext'
		),
	);
  
}