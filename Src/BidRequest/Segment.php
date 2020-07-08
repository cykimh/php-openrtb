<?php

namespace openrtb\BidRequest;

class Segment extends \openrtb\Abstractions\BaseModel {

    protected $attributes = array(
        'id' => array(
            'type' => self::ATTR_ID,                // data segment에 명시된 데이터 제공자 ID
        ),
        'name' => array(
            'type' => self::ATTR_STRING,            // data segment에 명시된 데이터 제공자 이름
        ),
        'value' => array(
            'type' => self::ATTR_STRING,            // data segment 값의 문자열 표현입니다. 이 데이터를 전달하는 방법은 사전에 오프라인으로 데이터 제공자와 협의되어 있어야 합니다.(예를 들면 성별은 "male" 또는 "female" 나이는 "30-40"
        ),
        'ext' => array(
            'type' => 'openrtb\BidRequest\Ext',
        ),
    );

}