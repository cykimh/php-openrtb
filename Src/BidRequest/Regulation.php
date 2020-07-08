<?php

namespace openrtb\BidRequest;

class Regulation extends \openrtb\Abstractions\BaseModel {

    protected $attributes = array(
        'id' => array(
            'type' => self::ATTR_ID,
        ),
        'coppa' => array(
            'type' => self::ATTR_INTEGER,               // 이 요청은 미국 FTC에 의해 설립된 COPPA 규정을 준수하는지 여부를 판별(0=no, 1=yes)
        ),
        'ext' => array(
            'type' => 'openrtb\BidRequest\Ext',
        ),
    );

}