<?php
namespace openrtb\BidRequest;

class Data extends \openrtb\Abstractions\BaseModel {
  
	protected $attributes = array(
		'id' => array (
			'type' => self::ATTR_ID                         // exchange에서 명시하는 데이터 제공자 ID
		),
		'name' => array (
			'type' => self::ATTR_STRING                     // exchange에서 명시하는 데이터 제공자 이름
        ),
		'segment' => array (
			'type' => self::ATTR_ARRAY,                     // (3.2.15)실제 데이터 값을 포함하는 segment 객체 배열
			'sub_type' => 'openrtb\BidRequest\Segment'
		),
		'ext' => array (
			'type' => 'openrtb\BidRequest\Ext'
		),
	);
  
}