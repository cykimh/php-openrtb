<?php
namespace openrtb\BidRequest;

class Data extends \openrtb\Abstractions\BaseModel {
  
	protected $attributes = array(
		'id' => array (
			'type' => self::ATTR_ID
		),
		'name' => array (
			'type' => self::ATTR_STRING
		),
		'segment' => array (
			'type' => self::ATTR_ARRAY,
			'sub_type' => 'openrtb\BidRequest\Segment'
		),
		'ext' => array (
			'type' => 'openrtb\BidRequest\Ext'
		),
	);
  
}