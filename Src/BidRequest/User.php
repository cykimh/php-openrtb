<?php
namespace openrtb\BidRequest;

class User extends \openrtb\Abstractions\BaseModel {
  
	protected $attributes = array(
		'id' => array (
			'type' => self::ATTR_ID                     // exchange에서 사용될 유저의 ID. id나 buyerid 중 최소 하나는 추천되어져야한다.
		),
		'buyeruid' => array (
			'type' => self::ATTR_STRING                 // buyer를 위해 Exchange에서 매핑시킨 buyer user ID.
		),
		'yob' => array (
			'type' => self::ATTR_INTEGER                // 4자리 정수 출생년도
		),
		'gender' => array (
			'type' => self::ATTR_STRING                 // 성별. "M"=male, "F"=female, "O"=known
		),
		'keywords' => array (
			'type' => self::ATTR_STRING                 // 콤마로 분리된 키워드, 관심, 또는 의도 목록
		),
		'customdata' => array (
			'type' => self::ATTR_STRING                 // 익스체인지에서 지원할 경우 비더가 익스체인지의 쿠키에 저장한 커스텀 데이터입니다. 쿠키에 안전한 base85 인코딩되어 있을 수 있으며 포맷은 상관없습니다. 이 필드는 사용자 정보를 저장하는 데 유용합니다. 주의: JSON 인코딩은 반드시 이스케이프된 인용부호를 이용해야 합니다.
		),
		'geo' => array (
			'type' => 'openrtb\BidRequest\Geo'          // geo 객체에 의해 정의된 유저의 홈베이스 기반 위치 정보.
		),
		'data' => array (
			'type' => 'openrtb\BidRequest\Data'         // 추가적인 유저 정보. 각각의 data 객체(3.2.14)는 다른 데이터 소스를 나타낸다.
		),
		'ext' => array (
			'type' => 'openrtb\BidRequest\Ext'          // OpenRTB의 고유 Exchange 확장 오브젝트에 대한 표시.
		),
	);
  
}