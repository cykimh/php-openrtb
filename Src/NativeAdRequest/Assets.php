<?php

/**
 * Created by YupChang on 2020-01-20
 */
namespace openrtb\NativeAdRequest;

class Assets extends \openrtb\Abstractions\BaseModel {

    protected $attributes = array(
        'id' => array(
            'required' => true,
            'type' => self::ATTR_ID,
        ),
        'required' => array(
            'type' => self::ATTR_INTEGER,
            'default_value' => 0,
        ),
        'title' => array(
            'type' => 'openrtb\NativeAdRequest\Title',
        ),
        'img' => array(
            'type' => 'openrtb\NativeAdRequest\Image',
        ),
        'video' => array(
            'type' => 'openrtb\NativeAdRequest\Video',
        ),
        'data' => array(
            'type' => 'openrtb\NativeAdRequest\Data',
        ),
        'ext' => array(
            'type' => 'openrtb\NativeAdRequest\Ext',
        ),

    );

}