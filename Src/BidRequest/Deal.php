<?php

namespace openrtb\BidRequest;

class Deal extends \openrtb\Abstractions\BaseModel {

    protected $attributes = array(
        'id' => array(
            'required' => true,                 // 직접거래(direct deal)의 유니크 식별자
            'type' => self::ATTR_STRING,
        ),
        'bidfloor' => array(
            'type' => self::ATTR_FLOAT,         // 이 노출의 최소 입찰가를 CPM으로 표현
            'default_value' => 0.0,
        ),
        'bidfloorcur' => array(
            'type' => self::ATTR_STRING,        // ISO-4217 alpha 코드를 사용하여 화폐 단위 표현. exchange에 의해 허용되는 경우 입찰자에 의해 반환된 입찰 화폐와 다를 수 있습니다.
            'default_value' => 'USD',
        ),
        'at' => array(
            'type' => self::ATTR_INTEGER,       // 입찰 요청의 총 입찰 유형 선택에 따라서 선택된다. 1=우선 가격, 2=두번 째 가격(second price plus), 3= bidfloor에 전달된 합의된 거래가격을 의미한다.
        ),
        'wseat' => array(
            'type' => self::ATTR_ARRAY,         // 구매자 seat 중 화이트리스트는 이 거래에 입찰 할 수 있습니다. Seat Id는 입찰자 및 Exchange 사이에 우선적으로 전달해야 합니다. 생략은 seat를 제한하지 않는다는 것으로 판단.
            'sub_type' => self::ATTR_STRING,
        ),
        'wadomain' => array(
            'type' => self::ATTR_ARRAY,         // 이 거래에 입찰 할 수 있는 광고주 도메인(ex. advertiser.com)의 배열. 생략은 광고주의 제한을 의미하지 않습니다.
            'sub_type' => self::ATTR_STRING,
        ),
        'ext' => array(
            'type' => 'openrtb\BidRequest\Ext',         // OpenRTB의 고유 Exchange 확장 오브젝트에 대한 표시
        ),
    );

}