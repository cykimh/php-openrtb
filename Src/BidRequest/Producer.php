<?php

namespace openrtb\BidRequest;

class Producer extends \openrtb\Abstractions\BaseModel {

    protected $attributes = array(
        'id' => array(
            'type' => self::ATTR_ID,                // 컨텐츠 프로듀서 또는 원작자 ID. 컨텐츠가 신디케이트하거나 embed 태그를 사용하여 사이트에 게시 할 경우 유용
        ),
        'name' => array(
            'type' => self::ATTR_STRING,            // 컨텐츠 프로듀서나 원작자 이름(e.g. "워너 브라더스")
        ),
        'cat' => array(
            'type' => self::ATTR_ARRAY,             // 컨텐츠 프로듀서를 표현하는 IAB 컨텐츠 카테고리 배열. (5.1)
            'sub_type' => self::ATTR_STRING,
        ),
        'domain' => array(
            'type' => self::ATTR_STRING,            // 컨텐츠 프로듀서의 최상단 도메인(e.g. producer.com)
        ),
        'ext' => array(
            'type' => 'openrtb\BidRequest\Ext',
        ),
    );

}