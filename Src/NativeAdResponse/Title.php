<?php

namespace openrtb\NativeAdResponse;

class Title extends \openrtb\Abstractions\BaseModel {

    protected $attributes = array(
        'text' => array(
            'required' => true,
            'type' => self::ATTR_STRING,
        ),
        'len' => array(
            'type' => self::ATTR_INTEGER,
        ),
        'ext' => array(
            'type' => '\openrtb\NativeAdResponse\Ext',
        ),
    );

}