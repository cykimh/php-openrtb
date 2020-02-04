<?php

namespace openrtb\NativeAdResponse;

class Data extends \openrtb\Abstractions\BaseModel {

    protected $attributes = array(
        'type' => array(
            'type' => self::ATTR_INTEGER,
        ),
        'len' => array(
            'type' => self::ATTR_INTEGER,
        ),
        'value' => array(
            'required' => true,
            'type' => self::ATTR_STRING,
        ),
        'ext' => array(
            'type' => 'openrtb\NativeAdResponse\Ext',
        ),
        'label' => array(
            'type' => self::ATTR_STRING,
        ),
    );

    protected $type_label = array(
        1 => "sponsored",
        2 => "description",
        3 => "rating",
        4 => "likes",
        5 => "downloads",
        6 => "price",
        7 => "saleprice",
        8 => "phone",
        9 => "address",
        10 => "desc2",
        11 => "displayurl",
        12 => "cta",
    );

    public function get_type_label($type) {
        return $this->type_label[$type] ?? "Data Type Invalid";
    }


}