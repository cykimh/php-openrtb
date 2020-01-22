<?php
/**
 * Created by YupChang on 2020-01-22
 */

namespace openrtb\NativeAdRequest;


class EventTrackers extends \openrtb\Abstractions\BaseModel {

    protected $attributes = array(
        'event' => array(
            'required' => true,
            'type' => self::ATTR_INTEGER,
        ),
        'method' => array(
            'required' => true,
            'type' => self::ATTR_ARRAY,
            'sub_type' => self::ATTR_INTEGER,
        ),
        'ext' => array(
            'type' => 'openrtb\NativeAdRequest\Ext',
        ),

    );

}