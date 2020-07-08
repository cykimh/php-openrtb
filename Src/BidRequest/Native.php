<?php

namespace openrtb\BidRequest;

class Native extends \openrtb\Abstractions\BaseModel {

    protected $attributes = array(
        'id' => array(
            'type' => self::ATTR_ID,
        ),
        'request' => array(
            'required' => true,                     // 네이티브 광고 스펙을 준수하는 요청 payload
            'type' => self::ATTR_STRING,
        ),
        'ver' => array(
            'type' => self::ATTR_STRING,            // 네이티브 광고 스펙 요청 컴파일의 버전. 효율적인 파싱을 위해 매우 추천
        ),
        'battr' => array(
            'type' => self::ATTR_ARRAY,             // 차단된 크리에이티브 속성(creative attritubes). (5.3)
            'sub_type' => self::ATTR_INTEGER,
        ),
        'api' => array(
            'type' => self::ATTR_ARRAY,             // 노출을 지원하는 API framework의 목록(5.6). 명시적으로 api 리스트를 지정하지 않을경우 아무것도 지원되지 않는다
            'sub_type' => self::ATTR_INTEGER,
        ),
        'ext' => array(
            'type' => 'openrtb\BidRequest\Ext',
        ),
    );

}