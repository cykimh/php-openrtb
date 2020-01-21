<?php

namespace openrtb\BidRequest;

class Segment extends \openrtb\Abstractions\BaseModel {

    protected $attributes = array(
        'id' => array(
            'type' => self::ATTR_ID,
        ),
        'name' => array(
            'type' => self::ATTR_STRING,
        ),
        'value' => array(
            'type' => self::ATTR_STRING,
        ),
        'ext' => array(
            'type' => 'openrtb\BidRequest\Ext',
        ),
    );

}