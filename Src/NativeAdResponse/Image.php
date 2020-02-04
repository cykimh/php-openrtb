<?php

namespace openrtb\NativeAdResponse;

class Image extends \openrtb\Abstractions\BaseModel {

    protected $attributes = array(
        'type' => array(
            'type' => self::ATTR_INTEGER,
        ),
        'url' => array(
            'required' => true,
            'type' => self::ATTR_STRING,
        ),
        'w' => array(
            'type' => self::ATTR_INTEGER,
        ),
        'h' => array(
            'type' => self::ATTR_INTEGER,
        ),
        'ext' => array(
            'type' => 'openrtb\NativeAdResponse\Ext',
        ),
    );

}