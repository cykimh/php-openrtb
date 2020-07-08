<?php
namespace openrtb\BidRequest;

class PMP extends \openrtb\Abstractions\BaseModel {
  
	protected $attributes = array(
		'private_auction' => array(
			'type' => self::ATTR_INTEGER                // Deal 객체에 명시된 wseat의 이름으로 된 직접 거래 상품의 입찰 자격 표시를 설정. 0=모든 입찰 허용, 1=입찰가를 그 지정 상품과 조건에 제한한다
		),
		'deals' => array(
			'type' => self::ATTR_ARRAY,                 // (3.2.18)이 노출에 적용되는 특정 거래를 deal 객체를 통해 전달
			'sub_type' => 'openrtb\BidRequest\Deal'
		),
		'ext' => array(
			'type' => 'openrtb\BidRequest\Ext'
		)
	);
  
}