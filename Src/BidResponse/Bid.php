<?php
namespace openrtb\BidResponse;

class Bid extends \openrtb\Abstractions\BaseModel {
  
	protected $attributes = array(
		'id' => array(                              // Bidder generated bid ID to assist with logging/tracking.
      		'required' => true,                     // 입찰자를 bid ID로 로깅 / 추적과 디버깅을 할 때 사용합니다
			'type' => self::ATTR_ID
		),
		'impid' => array(                           // ID of the Imp object in the related bid request.
      		'required' => true,                     // 관련 입찰 요청의 Imp 객체의 ID (입찰이 적용되는 Imp 객체의 ID)
            'type' => self::ATTR_ID
		),
		'price' => array(                           // Bid price expressed as CPM although the actual transaction is for a unit impression only. Note that while the type indicates float, integer math is highly recommended when handling currencies (e.g., BigDecimal in Java).
      		'required' => true,                     // 입찰 가격은 CPM으로 표시. 타입에 float 형을 적어놨지만, 정산 처리할 때는 integer 형을 적극 추천.(반올림 오차를 피하기 위해서)
			'type' => self::ATTR_FLOAT
		),
		'adid' => array(                            // ID of a preloaded ad to be served if the bid wins.
			'type' => self::ATTR_STRING             // 낙찰이 되는 경우에 전송될 광고 ID.
		),
		'nurl' => array(                            // Win notice URL called by the exchange if the bid wins; optional means of serving ad markup.
			'type' => self::ATTR_STRING             // 낙찰이 됬을 경우 Exchange에 의해 Win Notice를 호출 받을 URL.옵션은 광고 마크업 리턴을 의미합니다
		),
		'adm' => array(                             // Optional means of conveying ad markup in case the bid wins; supersedes the win notice if markup is included in both.
			'type' => self::ATTR_STRING             // 낙찰이 됬을 경우 광고 markup을 전달하는 옵션을 의미. markup이 모두 포함된 경우 win notice를 대체합니다.
		),
		'adomain' => array(                         // Advertiser domain for block list checking (e.g., “ford.com”). This can be an array of for the case of rotating creatives. Exchanges can mandate that only one domain is allowed
 			'type' =>  self::ATTR_ARRAY,            // 고주의 도메인이 차단 목록에 있는지 체크하는 용도로 사용. Exchange는 하나의 도메인만 허용되도록 강제할 수 있다. 광고주의 최상위 도메인.
 			'sub_type' => self::ATTR_STRING
		),
		'bundle' => array(                          // Bundle or package name (e.g., com.foo.mygame) of the app being advertised, if applicable; intended to be a unique ID across exchanges.
			'type' => self::ATTR_STRING             // 안드로이드는 어플리케이션 번들이나 패키지명(com.foo.mygame). iOS는 번호 ID. exchange와 통신해 unique한 Id가 되야함.
		),
		'iurl' => array(                            // URL without cache-busting to an image that is representative of the content of the campaign for ad quality/safety checking
			'type' => self::ATTR_STRING             // 광고 품질/안전 검사를 위한 캠페인의 내용의 cache-busting이 안된 샘플 이미지 URL
        ),
		'cid' => array(                             // Campaign ID to assist with ad quality checking; the collection of creatives for which iurl should be representative.
			'type' => self::ATTR_STRING             // 광고 마크업에 나타난 캠페인 ID는 광고 품질 확인을 지원합니다. iurl을 대표하기위한 광고의 컬렉션.
        ),
		'crid' => array(                            // Creative ID to assist with ad quality checking
			'type' => self::ATTR_STRING             // 이슈나 문제점을 보고하기 위한 광고물 ID. 이 속성은 Exchange에서 게시한 광고물 ID의 참조로 활용될 수 있습니다.
		),
		'cat' => array(                             // IAB content categories of the creative. Refer to List 5.1.
 			'type' =>  self::ATTR_ARRAY,            // 광고 소재를 IAB 컨텐츠 카테고리를 통해 표현(5.1)
 			'sub_type' => self::ATTR_STRING
		),
		'attr' => array(                            // Set of attributes describing the creative. Refer to List 5.3.
 			'type' =>  self::ATTR_ARRAY,            // 광고를 기술하는 속성을 설정합니다. (5.3)
 			'sub_type' => self::ATTR_INTEGER
		),
		'dealid' => array(                          // Reference to the deal.id from the bid request if this bid pertains to a private marketplace direct deal
			'type' => self::ATTR_STRING             // 입찰이 PMP에서 하는 직접 거래일 경우 입찰 요청에서 deal.id 를 참고(레퍼런스). 거래 방식이 PMP 일 경우 필수 조건
		),
		'h' => array(                               // Height of the creative in pixels.
			'type' => self::ATTR_INTEGER            // 광고의 가로 폭
		),
		'w' => array(                               // Width of the creative in pixels.
			'type' => self::ATTR_INTEGER            // 광고의 세로 길이
		),
 		'ext' => array(                             // Placeholder for bidder-specific extensions to OpenRTB.
 			'type' => 'openrtb\BidResponse\Ext'             //
 		),
	);
  
}