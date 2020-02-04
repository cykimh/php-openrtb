<?php

/**
 * Created by YupChang on 2020-01-20
 */

namespace openrtb\NativeAdRequest;

class NativeAdRequest extends \openrtb\Abstractions\BaseModel {

    protected $attributes = array(
        'ver' => array(
            'type' => self::ATTR_STRING,
            'default_value' => '1.2',
        ),
        'context' => array(
            'type' => self::ATTR_INTEGER,
        ),
        'contextsubtype' => array(
            'type' => self::ATTR_INTEGER,
        ),
        'plcmttype' => array(
            'type' => self::ATTR_INTEGER,
        ),
        'plcmtcnt' => array(
            'type' => self::ATTR_INTEGER,
            'default_value' => 1,
        ),
        'seq' => array(
            'type' => self::ATTR_INTEGER,
            'default_value' => 0,
        ),
        'assets' => array(
//            'required' => true,
            'type' => self::ATTR_ARRAY,
            'sub_type' => 'openrtb\NativeAdRequest\Assets',
        ),
        'aurlsupport' => array(
            'type' => self::ATTR_INTEGER,
            'default_value' => 0,
        ),
        'durlsupport' => array(
            'type' => self::ATTR_INTEGER,
            'default_value' => 0,
        ),
        'eventtrackers' => array(
            'type' => self::ATTR_ARRAY,
            'sub_type' => 'openrtb\NativeAdRequest\EventTrackers',
        ),
        'privacy' => array(
            'type' => self::ATTR_INTEGER,
            'default_value' => 0,
        ),
        'ext' => array(
            'type' => 'openrtb\NativeAdRequest\Ext',
        ),
        'native' => array(
            'type' => 'openrtb\NativeAdRequest\NativeAdRequest',
        ),
    );

}