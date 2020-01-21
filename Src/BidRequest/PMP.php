<?php
namespace openrtb\BidRequest;

class PMP extends \openrtb\Abstractions\BaseModel {
  
	protected $attributes = array(
		'private_auction' => array(
			'type' => self::ATTR_INTEGER
		),
		'deals' => array(
			'type' => self::ATTR_ARRAY,
			'sub_type' => 'openrtb\BidRequest\Deal'
		),
		'ext' => array(
			'type' => 'openrtb\BidRequest\Ext'
		)
	);
  
}