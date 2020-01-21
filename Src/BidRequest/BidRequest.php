<?php

namespace openrtb\BidRequest;

class BidRequest extends \openrtb\Abstractions\BaseModel {

    protected $attributes = array(
        'id' => array(
            'required' => true,
            'type' => self::ATTR_ID,
        ),
        'imp' => array(
            'required' => true,
            'type' => self::ATTR_ARRAY,
            'sub_type' => 'openrtb\BidRequest\Imp'
        ),
        'app' => array(
            'type' => 'openrtb\BidRequest\App',
        ),
        'device' => array(
            'type' => 'openrtb\BidRequest\Device',
        ),
        'user' => array(
            'type' => 'openrtb\BidRequest\User',
        ),
        'test' => array(
            'type' => self::ATTR_INTEGER,
            'default_value' => 0,
        ),
        'at' => array(
            'type' => self::ATTR_INTEGER,
            'default_value' => 2,
        ),
        'tmax' => array(
            'type' => self::ATTR_INTEGER,
        ),
        'wseat' => array(
            'type' => self::ATTR_ARRAY,
            'sub_type' => self::ATTR_STRING,
        ),
        'allimps' => array(
            'type' => self::ATTR_INTEGER,
            'default_value' => 0,
        ),
        'cur' => array(
            'type' => self::ATTR_ARRAY,
            'sub_type' => self::ATTR_STRING
        ),
        'bcat' => array(
            'type' => self::ATTR_ARRAY,
            'sub_type' => self::ATTR_STRING,
        ),
        'badv' => array(
            'type' => self::ATTR_ARRAY,
            'sub_type' => self::ATTR_STRING,
        ),
        'regs' => array(
            'type' => 'openrtb\BidRequest\Regulation',
        ),
        'ext' => array(
            'type' => 'openrtb\BidRequest\Ext',
        ),
    );

}