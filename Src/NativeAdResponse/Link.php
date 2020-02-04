<?php

namespace openrtb\NativeAdResponse;

class Link extends \openrtb\Abstractions\BaseModel {

    protected $attributes = array(
        'url' => array(
            'required' => true,
            'type' => self::ATTR_STRING,
        ),
        'clicktrackers' => array(
            'type' => self::ATTR_ARRAY,
            'sub_type' => self::ATTR_STRING,
        ),
        'fallback' => array(
            'type' => self::ATTR_STRING,
        ),
        'ext' => array(
            'type' => 'openrtb\NativeAdResponse\Ext',
        ),
    );
}