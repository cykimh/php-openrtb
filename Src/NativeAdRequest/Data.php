<?php

/**
 * Created by YupChang on 2020-01-20
 */
namespace openrtb\NativeAdRequest;

class Data extends \openrtb\Abstractions\BaseModel {

    protected $attributes = array(
        'type' => array(
            'required' => true,
            'type' => self::ATTR_INTEGER,
        ),
        'len' => array(
            'type' => self::ATTR_INTEGER,
        ),
        'ext' => array(
            'type' => 'openrtb\NativeAdRequest\Ext',
        ),

    );

}