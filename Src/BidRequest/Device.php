<?php

namespace openrtb\BidRequest;

class Device extends \openrtb\Abstractions\BaseModel {

    protected $attributes = array(
        'id' => array(
            'type' => self::ATTR_ID,
        ),
        'ua' => array(
            'type' => self::ATTR_STRING,            // 브라우저 유저 agent 정보
        ),
        'geo' => array(
            'type' => 'openrtb\BidRequest\Geo',         // Geo 객체(3.2.12)로 정의된 유저 디바이스의 현재 위치
        ),
        'dnt' => array(
            'type' => self::ATTR_INTEGER,           // 브라우저에서 헤더에 설정된 표준 플래그 "Do not track(추적하지 않음)"가 false 이면 '0 = 무제한 추적', true로 되있으면 '1= 추적하지 않음'
        ),
        'lmt' => array(
            'type' => self::ATTR_INTEGER,           // "광고 추적 제한" 상업적으로 승인된 만큼 추적(e.g iOS, Android) 0=추적에 제한이 없다. 1=추적은 상업 가이드 라인에 따라 제한되어야한다.
        ),
        'ip' => array(
            'type' => self::ATTR_STRING,            // 디바이스의 IPv4 주소
        ),
        'ipv6' => array(
            'type' => self::ATTR_STRING,            // 디바이스의 IPv6 주소
        ),
        'devicetype' => array(
            'type' => self::ATTR_INTEGER,           // 디바이스의 표준 타입(5.17에 정의)
        ),
        'make' => array(
            'type' => self::ATTR_STRING,            // 디바이스 제작사(e.g Apple)
        ),
        'model' => array(
            'type' => self::ATTR_STRING,            // 디바이스 모델(e.g iPhone)
        ),
        'os' => array(
            'type' => self::ATTR_STRING,            // 디바이스 OS (e.g iOS)
        ),
        'osv' => array(
            'type' => self::ATTR_STRING,            // 디바이스 OS 버전(e.g 3.1.2)
        ),
        'hwv' => array(
            'type' => self::ATTR_STRING,            // 디바이스 하드웨어 버전(e.g iPhon 5S일 경우 "5S")
        ),
        'h' => array(
            'type' => self::ATTR_INTEGER,           // 픽셀단위의 물리적인 스크린 높이
        ),
        'w' => array(
            'type' => self::ATTR_INTEGER,           // 픽셀단위의 물리적인 스크린 가로 길이
        ),
        'ppi' => array(
            'type' => self::ATTR_INTEGER,           // 스크린의 인치 당 픽셀 수
        ),
        'pxratio' => array(
            'type' => self::ATTR_FLOAT,             // 디바이스 독립적 픽셀과 실제 픽셀 비율
        ),
        'js' => array(
            'type' => self::ATTR_INTEGER,           // javascript를 지원할 것인가? 0=no, 1=yes
        ),
        'flashver' => array(
            'type' => self::ATTR_STRING,            // 브라우저에서 지원되는 Flash의 버전
        ),
        'language' => array(
            'type' => self::ATTR_STRING,            // ISO-639-1-alpha-2를 사용한 브라우저 언어
        ),
        'carrier' => array(
            'type' => self::ATTR_STRING,            // carrier 또는 ISP. "WIFI"는 높은 대역폭을 나타내도록 모바일에서 사용됨
        ),
        'connectiontype' => array(
            'type' => self::ATTR_INTEGER,           // 네트워크 커넥션 타입(5.18)
        ),
        'ifa' => array(
            'type' => self::ATTR_STRING,            // 광고주가 사용할 수 있도록 허가된 깔끔한 ID(해시 생략)
        ),
        'didsha1' => array(
            'type' => self::ATTR_STRING,            // 하드웨어 디바이스 ID(e.g IMEI). SHA1로 해쉬(암호화)
        ),
        'didmd5' => array(
            'type' => self::ATTR_STRING,            // 하드웨어 디바이스 ID(e.g IMEI). MD5로 해쉬
        ),
        'dpidsha1' => array(
            'type' => self::ATTR_STRING,            // 플랫폼 디바이스 ID (e.g android Id). SHA1로 해쉬
        ),
        'dpidmd5' => array(
            'type' => self::ATTR_STRING,            // 플랫폼 디바이스 ID (e.g android Id). MD5로 해쉬
        ),
        'macsha1' => array(
            'type' => self::ATTR_STRING,            // 디바이스의 맥주소. SHA1로 해쉬
        ),
        'macmd5' => array(
            'type' => self::ATTR_STRING,            // 디바이스 맥주소. MD5로 해쉬
        ),
        'ext' => array(
            'type' => 'openrtb\BidRequest\Ext',         // OpenRTB의 고유 Exchange 확장 오브젝트에 대한 표시.
        ),
    );

}