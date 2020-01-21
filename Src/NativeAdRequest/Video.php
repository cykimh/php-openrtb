<?php

/**
 * Created by YupChang on 2020-01-20
 */
namespace openrtb\NativeAdRequest;

class Video extends \openrtb\Abstractions\BaseModel {

    protected $attributes = array(
        'mimes' => array(
            'required' => true,
            'type' => self::ATTR_INTEGER,
        ),
        'minduration' => array(
            'required' => true,
            'type' => self::ATTR_INTEGER,
        ),
        'maxduration' => array(
            'required' => true,
            'type' => self::ATTR_INTEGER,
        ),
        'protocols' => array(
            'required' => true,
            'type' => self::ATTR_ARRAY,
            'sub_type' => self::ATTR_INTEGER,
        ),
        'ext' => array(
            'type' => 'openrtb\NativeAdRequest\Ext',
        ),

    );

}