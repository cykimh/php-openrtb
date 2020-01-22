<?php
/**
 * Created by YupChang on 2020-01-22
 */

namespace openrtb\NativeAdResponse;


class EventTrackers extends \openrtb\Abstractions\BaseModel {

    protected $attributes = array(
        'event' => array(
            'required' => true,
            'type' => self::ATTR_INTEGER,
        ),
        'method' => array(
            'required' => true,
            'type' => self::ATTR_INTEGER,
        ),
        'url' => array(
            'type' => self::ATTR_STRING,
        ),
        'customdata' => array(

        ),
        'ext' => array(
            'type' => 'openrtb\NativeAdResponse\Ext',
        ),

    );

}