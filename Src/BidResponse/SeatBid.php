<?php
namespace openrtb\BidResponse;

class SeatBid extends \openrtb\Abstractions\BaseModel {
  
	protected $attributes = array(
		'bid' => array(
			'type' => self::ATTR_ARRAY,
			'sub_type' => 'openrtb\BidResponse\Bid',
			'required' => true
		),
		'seat' => array(
			'type' => self::ATTR_STRING
		),
		'group' => array(
			'type' => self::ATTR_INTEGER,
			'default_value' => 0
		),
		'ext' => array(
			'type' => 'openrtb\BidResponse\Ext'
		)
	);

}