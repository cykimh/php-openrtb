<?php

namespace openrtb\NativeAdResponse;

class Assets extends \openrtb\Abstractions\BaseModel {

    protected $attributes = array(
        'id' => array(
            'required' => true,
            'type' => self::ATTR_ID,
        ),
        'required' => array(
            'type' => self::ATTR_INTEGER,
        ),
        'title' => array(
            'type' => 'openrtb\NativeAdResponse\Title',
        ),
        'img' => array(
            'type' => 'openrtb\NativeAdResponse\Image',
        ),
        'video' => array(
            'type' => 'openrtb\NativeAdResponse\Video',
        ),
        'data' => array(
            'type' => 'openrtb\NativeAdResponse\Data',
        ),
        'link' => array(
            'type' => 'openrtb\NativeAdResponse\Link',
        ),
        'ext' => array(
            'type' => 'openrtb\NativeAdResponse\Ext',
        ),
    );

}