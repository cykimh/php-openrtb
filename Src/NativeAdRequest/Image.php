<?php

/**
 * Created by YupChang on 2020-01-20
 */
namespace openrtb\NativeAdRequest;

class Image extends \openrtb\Abstractions\BaseModel {

    protected $attributes = array(
        'type' => array(
            'type' => self::ATTR_INTEGER,
        ),
        'w' => array(
            'type' => self::ATTR_INTEGER,
        ),
        'wmin' => array(
            'type' => self::ATTR_INTEGER,
        ),
        'h' => array(
            'type' => self::ATTR_INTEGER,
        ),
        'hmin' => array(
            'type' => self::ATTR_INTEGER,
        ),
        'mimes' => array(
            'type' => self::ATTR_ARRAY,
            'sub_type' => self::ATTR_STRING,
        ),
        'ext' => array(
            'type' => 'openrtb\NativeAdRequest\Ext',
        ),

    );

}