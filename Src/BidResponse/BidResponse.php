<?php

namespace openrtb\BidResponse;

class BidResponse extends \openrtb\Abstractions\BaseModel {

    protected $attributes = array(
        'id' => array(                                  // ID of the bid request to which this is a response
            'required' => true,                         // 이 응답에 대한 입찰 요청에 들어있는 ID값
            'type' => self::ATTR_ID,
        ),
        'seatbid' => array(                             // Array of seatbid objects; 1+ required if a bid is to be made
            'type' => self::ATTR_ARRAY,                 // seatbid 객체의 배열, bid가 만들어지면 +1되야함
            'sub_type' => 'openrtb\BidResponse\SeatBid',
        ),
        'bidid' => array(                               // Bidder generated response ID to assist with logging/tracking
            'type' => self::ATTR_STRING,                // 입찰 응답의 ID로 입찰자가 응답을 추적하기 위해 사용함. 이 값은 상호참조를 위해 입찰자가 선택합니다.
        ),
        'cur' => array(                                 // Bid currency using ISO-4217 alpha codes.
            'type' => self::ATTR_STRING,                // ISO-4217 알파코드를 사용해 표현하는 bid의 통화
            'default_value' => 'USD',
        ),
        'customdata' => array(                          // Optional feature to allow a bidder to set data in the exchange’s cookie. The string must be in base85 cookie safe characters and be in any format. Proper JSON encoding must be used to include “escaped” quotation marks.
            'type' => self::ATTR_STRING,                // 옵션 기능은 입찰자가 exchange의 쿠키 데이터를 설정할 수 있습니다. 문자열은 반드시 base85로 인코딩 된 쿠키 값을 사용하는 것이 안전합니다. JSON 인코딩을 사용할 경우 ""를 포함시켜 줘야합니다.
        ),
        'nbr' => array(                                 // Reason for not bidding. Refer to List 5.19
            'type' => self::ATTR_INTEGER,               // 입찰을 하지 않는 이유,  Reason code( 5.22)
        ),
        'ext' => array(                                 // Placeholder for bidder-specific extensions to OpenRTB
            'type' => 'openrtb\BidResponse\Ext',
        ),
    );

    public function __constuct($response) {

    }
}