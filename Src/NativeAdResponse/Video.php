<?php

namespace openrtb\NativeAdResponse;

class Video extends \openrtb\Abstractions\BaseModel {

    protected $attributes = array(
        'vasttag' => array(
            'required' => true,
            'type' => self::ATTR_STRING,
        ),
    );

}