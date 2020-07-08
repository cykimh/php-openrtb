<?php
namespace openrtb\BidRequest;

class App extends \openrtb\Abstractions\BaseModel {
  
	protected $attributes = array(
		'id' => array(
			'type' => self::ATTR_ID                             // Exchange의 명시된 App Id
		),
		'name' => array(
			'type' => self::ATTR_STRING                         // 앱 이름(퍼블리셔의 요청에 들어있을)
		),
		'bundle' => array(
			'type' => self::ATTR_STRING                         // 안드로이드는 어플리케이션 번들이나 패키지명(com.foo.mygame). iOS는 번호 ID. 여러 exchange에 걸쳐 unique한 Id가 되야함.
 		),
 		'domain' => array (
 			'type' => self::ATTR_STRING                         // 앱의 도메인(mygame.foo.com)
 		),
 		'storeurl' => array(
 			'type' =>  self::ATTR_STRING                        // 앱이 올라가있는 스토어 url
 		),
 		'cat' => array(
 			'type' =>  self::ATTR_ARRAY,                        // 앱에 대한 IAB 컨텐츠 카테고리 배열(5.1)
 			'sub_type' => self::ATTR_STRING
 		),
 		'sectioncat' => array(
 			'type' =>  self::ATTR_ARRAY,                        // 앱의 현재 섹션에 대한 IAB 컨텐츠 카테고리 배열(5.1)
 			'sub_type' => self::ATTR_STRING
 		),
 		'pagecat' => array(
 			'type' =>  self::ATTR_ARRAY,                        // 앱의 현재 페이지나 뷰의 묘사에 대한 IAB 컨텐츠 카테고리 배열(5.1)
 			'sub_type' => self::ATTR_STRING
 		),
 		'ver' => array(
 			'type' =>  self::ATTR_STRING                        // 앱 버전
 		),
 		'privacypolicy' => array(
 			'type' =>  self::ATTR_INTEGER                       // 앱이 개인 정보 보호 정책을 표시하는가? 0=no, 1=yes
 		),
 		'paid' => array(
 			'type' =>  self::ATTR_INTEGER                       // 0=공짜 앱, 1=유료 앱 버전
 		),
 		'publisher' => array(
 			'type' =>  'openrtb\BidRequest\Publisher'           // 퍼블리셔에 대한 상세정보를 담고 있는 오브젝트(3.2.8)
 		),
 		'content' => array(
 			'type' =>  'openrtb\BidRequest\Content'             // 앱에 들어있는 컨텐츠에 대한 상세 정보 오브젝트(3.2.9)
 		),
 		'keywords' => array(
 			'type' =>  self::ATTR_STRING                        // 앱을 설명할 수 있는 키워드 목록을 콤마로 나눠서 전송
 		),
 		'ext' => array(
 			'type' => 'openrtb\BidRequest\Ext'                  // OpenRTB의 고유 Exchange 확장 오브젝트에 대한 표시.
 		)
	);
  
}