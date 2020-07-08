<?php
namespace openrtb\BidRequest;

class Publisher extends \openrtb\Abstractions\BaseModel {
  
	protected $attributes = array(
		'id' => array (
			'type' => self::ATTR_ID                 // exchange에 명시되어있는 퍼블리셔 아이디
		),
		'name' => array (
			'type' => self::ATTR_STRING             // 퍼블리셔 이름(퍼블리셔 요청에 들어있을)
		),
		'cat' => array (
			'type' => self::ATTR_ARRAY,             // 퍼블리셔를 설명하는 IAB 컨텐츠 카테고리(5.1)
			'sub_type' => self::ATTR_STRING
		),
		'domain' => array (
			'type' => self::ATTR_STRING             // 퍼블리셔의 최상위 레벨 도메인(publisher.com)
		),
		'ext' => array (
			'type' => 'openrtb\BidRequest\Ext'      // OpenRTB의 고유 Exchange 확장 오브젝트에 대한 표시.
		),
	);
  
}