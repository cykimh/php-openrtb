<?php

namespace openrtb\BidResponse;

class BidResponse extends \openrtb\Abstractions\BaseModel {

    protected $attributes = array(
        'id' => array(                                  // ID of the bid request to which this is a response
            'required' => true,
            'type' => self::ATTR_ID,
        ),
        'seatbid' => array(                             // Array of seatbid objects; 1+ required if a bid is to be made
            'type' => self::ATTR_ARRAY,
            'sub_type' => 'openrtb\BidResponse\SeatBid',
        ),
        'bidid' => array(                               // Bidder generated response ID to assist with logging/tracking
            'type' => self::ATTR_STRING,
        ),
        'cur' => array(                                 // Bid currency using ISO-4217 alpha codes.
            'type' => self::ATTR_STRING,
            'default_value' => 'USD',
        ),
        'customdata' => array(                          // Optional feature to allow a bidder to set data in the exchange’s cookie. The string must be in base85 cookie safe characters and be in any format. Proper JSON encoding must be used to include “escaped” quotation marks.
            'type' => self::ATTR_STRING,
        ),
        'nbr' => array(                                 // Reason for not bidding. Refer to List 5.19
            'type' => self::ATTR_INTEGER,
        ),
        'ext' => array(                                 // Placeholder for bidder-specific extensions to OpenRTB
            'type' => 'openrtb\BidResponse\Ext',
        ),
    );

    public function __constuct($response) {

    }
}