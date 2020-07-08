<?php
namespace openrtb\BidRequest;

class Geo extends \openrtb\Abstractions\BaseModel {
  
	protected $attributes = array(
		'lat' => array (
			'type' => self::ATTR_FLOAT          // 음수가 남쪽인 -90.0부터 +90.0 위도
		),
		'lon' => array (
			'type' => self::ATTR_FLOAT          // 음수가 서쪽인 -180.0 부터 +180.0 경도
		),
		'type' => array (
			'type' => self::ATTR_INTEGER        // 위치 데이터 소스. lat/lon을 지정 안했을 경우 추천(5.18)
		),
		'country' => array (
			'type' => self::ATTR_STRING         // ISO-3166-1-alpha-3을 사용한 국가 코드
		),
		'region' => array (
			'type' => self::ATTR_STRING         // ISO-3166-2를 사용한 지역 코드. 2자리 코드
		),
		'regionfips104' => array (
			'type' => self::ATTR_STRING         // FIPS 10-4 표기법을 사용한 나라의 지역코드. OpenRTB에서는 지원하지만, 2008년 이후로 NIST에 의해 철회됨.
		),
		'metro' => array (
			'type' => self::ATTR_STRING         // 구글 지하철 코드. 닐슨의 DMAs와 비슷하지만 완벽히 같진 않음.코드에 대한 링크 부록 A를 참고.
		),
		'city' => array (
			'type' => self::ATTR_STRING         // 교환과 전송 위치를 UN코드를 사용하여 도시를 나타냄. 코드에 대한 링크 부록 A를 참고
		),
		'zip' => array (
			'type' => self::ATTR_STRING         // 우편 번호 코드
		),
		'utcoffset' => array (
			'type' => self::ATTR_INTEGER        // UTC에서 시간 (분)+/-로 현재 시간을 나타냄
		),
		'ext' => array (
			'type' => 'openrtb\BidRequest\Ext'  // OpenRTB의 고유 Exchange 확장 오브젝트에 대한 표시.
		),
	);
  
}