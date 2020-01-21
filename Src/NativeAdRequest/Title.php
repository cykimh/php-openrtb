<?php

/**
 * Created by YupChang on 2020-01-20
 */
namespace openrtb\NativeAdRequest;

class Title extends \openrtb\Abstractions\BaseModel {

    protected $attributes = array(
        /**
         * Maximum length of the text in the title element.
         * Recommended to be 25, 90, or 140
         */
        'len' => array(
            'required' => true,
            'type' => self::ATTR_INTEGER,
        ),
        'ext' => array(
            'type' => 'openrtb\NativeAdRequest\Ext',
        ),

    );

}