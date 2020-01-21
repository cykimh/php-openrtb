<?php

/**
 * Created by YupChang on 2020-01-20
 */

namespace openrtb\NativeAdResponse;

class NativeAdResponse extends \openrtb\Abstractions\BaseModel {

    protected $attributes = array(
        'ver' => array(
            'type' => self::ATTR_STRING,
            'default_value' => '1.2',
        ),
        'assets' => array(
            'type' => self::ATTR_ARRAY,
            'sub_type' => 'openrtb\NativeAdResponse\Assets',
        ),
        'assetsurl' => array(
            'type' => self::ATTR_STRING,
        ),
        'dcourl' => array(
            'type' => self::ATTR_STRING,
        ),
        'link' => array(
            'type' => 'openrtb\NativeAdResponse\Link',
        ),
        'imptrackers' => array(
            'type' => self::ATTR_ARRAY,
            'sub_type' => self::ATTR_STRING,
        ),
        'jstrackers' => array(
            'type' => self::ATTR_STRING,
        ),
        'eventtrackers' => array(
            'type' => self::ATTR_ARRAY,
        ),
        'privacy' => array(
            'type' => self::ATTR_STRING,
        ),
        'ext' => array(
            'type' => 'openrtb\NativeAdResponse\Ext',
        ),

    );

}