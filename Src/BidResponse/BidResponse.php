<?php

namespace openrtb\BidResponse;

class BidResponse extends \openrtb\Abstractions\BaseModel {

    protected $attributes = array(
        'id' => array(
            'required' => true,
            'type' => self::ATTR_ID,
        ),
        'seatbid' => array(
            'type' => self::ATTR_ARRAY,
            'sub_type' => 'openrtb\BidResponse\SeatBid',
        ),
        'bidid' => array(
            'type' => self::ATTR_STRING,
        ),
        'cur' => array(
            'type' => self::ATTR_STRING,
            'default_value' => 'USD',
        ),
        'customdata' => array(
            'type' => self::ATTR_STRING,
        ),
        'nbr' => array(
            'type' => self::ATTR_INTEGER,
        ),
        'ext' => array(
            'type' => 'openrtb\BidResponse\Ext',
        ),
    );

    public function __constuct($response) {

    }
}