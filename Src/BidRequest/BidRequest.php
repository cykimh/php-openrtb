<?php

namespace openrtb\BidRequest;

class BidRequest extends \openrtb\Abstractions\BaseModel {

    protected $attributes = array(
        'id' => array(
            'required' => true,                         // exchange에 의해 제공되는 bid request의 유니크아이디.
            'type' => self::ATTR_ID,
        ),
        'imp' => array(
            'required' => true,                         // 제공되는 노출 수를 나타내는 Imp객체(3.2.2)의 배열 최소 하나의 Imp객체를 필요로 한다.
            'type' => self::ATTR_ARRAY,
            'sub_type' => 'openrtb\BidRequest\Imp'
        ),
        'site' => array(
            'type' => 'openrtb\BidRequest\Site',        // publisher의 웹사이트에 대한 사이트 객체(3.2.6)의 세부 사항. 웹사이트에만 적용 및 추천가능
        ),
        'app' => array(
            'type' => 'openrtb\BidRequest\App',         // publisher의 응용프로그램 객체(3.2.7)에 대한 세부 사항 앱에만 적용 및 추천 가능
        ),
        'device' => array(
            'type' => 'openrtb\BidRequest\Device',      // 노출이 전달 될 사용자의 장치에 대한 장치 객체(3.2.11)의 세부 사항
        ),
        'user' => array(
            'type' => 'openrtb\BidRequest\User',        // 기기 사용자에 대한 사용자 객체(3.2.13)의 세부 사항, 광고 대상
        ),
        'test' => array(
            'type' => self::ATTR_INTEGER,               // 경매를 청구하지 않는 테스트 모드(0 = 라이브모드, 1 = 테스트모드)
            'default_value' => 0,
        ),
        'at' => array(
            'type' => self::ATTR_INTEGER,               // 경매 유형, 1=우선 가격(우선 순위 경매), 2=두번째 가격(차선 순위 경매). exchange별 입찰 유형은 500보다 큰 값을 사용하여 정의 할 수 있다.
            'default_value' => 2,
        ),
        'tmax' => array(
            'type' => self::ATTR_INTEGER,               // (밀리초) 입찰에 참여하기 위한 밀리세컨드 단위 최대 지연시간. 값은 오프라인으로 전달.
        ),
        'wseat' => array(
            'type' => self::ATTR_ARRAY,                 // 경매에 참여할 수 있는 바이어 입찰자격 코드 리스트. (Seat ID로 표현)
            'sub_type' => self::ATTR_STRING,
        ),
        'allimps' => array(
            'type' => self::ATTR_INTEGER,               // Exchange가 제공하는 동시에 같은 광고주 광고를 여러개 게제하는 기능(road-blocking)을 지원하는 상황에서 사용할 수 있는 노출을 모두 나타낸다는 것을 확인 할 수 있는 Flag를 나타냅니다. (예를 들어, 웹페이지의 모든 pre/mid/post 롤 등의 모든 영상 스팟)  0=없거나 unknown(확인 불가), 1=제공하는 노출이 사용할 수 있는 모든 것을 나타낸다.
            'default_value' => 0,
        ),
        'cur' => array(
            'type' => self::ATTR_ARRAY,                 // ISO-4217 알파 코드를 사용하여 입찰요청에 입찰에 대한 허용 통화(화폐)의 배열입니다. 통화를 하나만 사용할 경우에는 이 파라메터는 필요 없음.
            'sub_type' => self::ATTR_STRING
        ),
        'bcat' => array(
            'type' => self::ATTR_ARRAY,                 // IAB의 콘텐츠 카테고리를 사용하여 차단된 광고주 카테고리(5.1에서 상세 설명)
            'sub_type' => self::ATTR_STRING,
        ),
        'badv' => array(
            'type' => self::ATTR_ARRAY,                 // 자신의 도메인으로 광고주의 차단 목록 (ex. ford.com)
            'sub_type' => self::ATTR_STRING,
        ),
        'regs' => array(
            'type' => 'openrtb\BidRequest\Regulation',  // 이 요청에 대한 효력, 산업, 법률 및 정부 규제를 지정하는 사무 처리 규정 객체(3.2.16)
        ),
        'ext' => array(
            'type' => 'openrtb\BidRequest\Ext',
        ),
    );

}