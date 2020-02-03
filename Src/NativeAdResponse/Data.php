<?php

namespace openrtb\NativeAdResponse;

class Data extends \openrtb\Abstractions\BaseModel {

    protected $attributes = array(
        'type' => array(
            'type' => self::ATTR_INTEGER,
        ),
        'len' => array(
            'type' => self::ATTR_INTEGER,
        ),
        'value' => array(
            'required' => true,
            'type' => self::ATTR_STRING,
        ),
        'ext' => array(
            'type' => '\openrtb\NativeAdResponse\Ext',
        ),
    );


}