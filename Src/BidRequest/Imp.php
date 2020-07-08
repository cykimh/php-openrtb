<?php

namespace openrtb\BidRequest;

class Imp extends \openrtb\Abstractions\BaseModel {

    protected $attributes = array(
        'id' => array(
            'required' => true,                             // 입찰 요청의 컨텍스트 내에서 imp 객체에 대한 고유 식별자(일반적으로 1에서 시작해서 증가)
            'type' => self::ATTR_ID,
        ),
        'banner' => array(
            'type' => 'openrtb\BidRequest\Banner',          // 광고 노출을 배너로 할 경우 필요한 객체
        ),
        'video' => array(
            'type' => 'openrtb\BidRequest\Video',           // 광고 노출을 비디오로 할 경우 필요한 객체
        ),
        'native' => array(
            'type' => 'openrtb\BidRequest\Native',          // 광고 노출을 네이티브로 할 경우 필요한 객체
        ),
        'displaymanager' => array(
            'type' => self::ATTR_STRING,                    // 광고 중개 파트너, SDK 기술, 또는 광고를 렌더링(전시) 하는 player의 이름(보통 비디오나 모바일). 일부 광고 서버에서는 파트너가 광고 코드를 커스텀하는 용도로 사용됩니다. 비디오나 앱 광고를 노출할 때 추천
        ),
        'displaymanagerver' => array(
            'type' => self::ATTR_STRING,                    // 광고 중개 파트너, SDK 기술, 또는 광고를 렌더링 하는 player의 버전(보통 비디오나 모바일). 일부 광고 서버에서 파트너가 광고 코드를 커스텀하는 용도로 사용됩니다. 비디오나 앱 광고를 노출할 때 추천
        ),
        'instl' => array(
            'type' => self::ATTR_INTEGER,                   // 1=광고가 삽입광고(인터스티셜 광고)이거나 전체화면, 0=그렇지 않음.
            'default_value' => 0,
        ),
        'tagid' => array(
            'type' => self::ATTR_STRING,                    // 특정 광고 게재 위치 또는 경매를 시작 하는 데 사용 된 광고 태그의 식별자 이슈의 디버깅을 위해서 사용되거나, 구매 최적화에 유용합니다.
        ),
        'bidfloor' => array(
            'type' => self::ATTR_FLOAT,                     // 노출의 최소 입찰가. CPM 단위로 표현.
            'default_value' => 0.0,
        ),
        'bidfloorcur' => array(
            'type' => self::ATTR_STRING,                    // 화폐 단위, 현재는 ISO-4217 알파 코드를 이용하여 지정. exchange에 의해 허용되는 경우 입찰자에 의해 반환 된 화폐 단위가 다를 수 있습니다.
            'default_value' => 'USD',
        ),
        'secure' => array(
            'type' => self::ATTR_INTEGER,                   // 노출이 보안 HTTPS URL createive assets이나 마크업을 필요로 할 경우 나타내는 플래그 0=non-secure, 1=secure. 생략된 경우, 안전한 상태를 알 수 있지만, HTTP 지원인 경우도 염두에 두어야한다.
        ),
        'iframebuster' => array(
            'type' => self::ATTR_ARRAY,                     // 지원되는 확장 iFrame파일 이름 리스트. Exchange 마다 다르다.
            'sub_type' => self::ATTR_STRING,
        ),
        'pmp' => array(
            'type' => 'openrtb\BidRequest\PMP',             // impression 객체에 대한 PMP 내용을 담을 파라메터. PMP Object가 들어간다.
        ),
        'ext' => array(
            'type' => 'openrtb\BidRequest\Ext',
        ),
    );

}