<?php

namespace openrtb\BidRequest;

class Imp extends \openrtb\Abstractions\BaseModel {

    protected $attributes = array(
        'id' => array(
            'required' => true,
            'type' => self::ATTR_ID,
        ),
        'banner' => array(
            'type' => 'openrtb\BidRequest\Banner',
        ),
        'video' => array(
            'type' => 'openrtb\BidRequest\Video',
        ),
        'native' => array(
            'type' => 'openrtb\BidRequest\Native',
        ),
        'displaymanager' => array(
            'type' => self::ATTR_STRING,
        ),
        'displaymanagerver' => array(
            'type' => self::ATTR_STRING,
        ),
        'instl' => array(
            'type' => self::ATTR_INTEGER,
            'default_value' => 0,
        ),
        'tagid' => array(
            'type' => self::ATTR_STRING,
        ),
        'bidfloor' => array(
            'type' => self::ATTR_FLOAT,
            'default_value' => 0.0,
        ),
        'bidfloorcur' => array(
            'type' => self::ATTR_STRING,
            'default_value' => 'USD',
        ),
        'secure' => array(
            'type' => self::ATTR_INTEGER,
        ),
        'iframebuster' => array(
            'type' => self::ATTR_ARRAY,
            'sub_type' => self::ATTR_STRING,
        ),
        'pmp' => array(
            'type' => 'openrtb\BidRequest\PMP',
        ),
        'ext' => array(
            'type' => 'openrtb\BidRequest\Ext',
        ),
    );

}