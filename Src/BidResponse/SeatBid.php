<?php
namespace openrtb\BidResponse;

class SeatBid extends \openrtb\Abstractions\BaseModel {
  
	protected $attributes = array(
		'bid' => array(
			'type' => self::ATTR_ARRAY,                 // 입찰 객체는 노출과 연관되서 추가된다. 여러개의 bid 객체는 하나의 노출과 연관될 수도있다.
			'sub_type' => 'openrtb\BidResponse\Bid',
			'required' => true
		),
		'seat' => array(
			'type' => self::ATTR_STRING                 // 입찰을 이루어주는 구매자의 seat ID(e.g 광고주, 대행사)
		),
		'group' => array(
			'type' => self::ATTR_INTEGER,               // 한 입찰에 다수의 노출이 있을 경우, 노출을 각각 하나씩 보고 입찰할 수 있다. 1=노출은 무조건 그룹 단위로 입찰을 성공 또는 실패한다.
			'default_value' => 0
		),
		'ext' => array(
			'type' => 'openrtb\BidResponse\Ext'
		)
	);

}