<?php

namespace openrtb\BidRequest;

class Banner extends \openrtb\Abstractions\BaseModel {

    protected $attributes = array(
        'id' => array(
            'type' => self::ATTR_ID,                    // Banner 객체의 유일성을 띄는 값. 배너 객체가 컴패니언 광고의 배열을 표현하기 위해 비디오 객체에서 사용되는 경우 추천.
        ),
        'w' => array(
            'type' => self::ATTR_INTEGER,               // 노출의 가로길이(DIPS). Format 객체가 지정되있지 않은 경우, required.
        ),
        'h' => array(
            'type' => self::ATTR_INTEGER,               // 노출의 세로길이(DIPS). Format 객체가 지정되있지 않은 경우, required.
        ),
        'wmax' => array(
            'type' => self::ATTR_INTEGER,               // 노출의 픽셀단위 최대 가로길이. w 값과 함께 포함된 경우, w는 권장되거나, 바람직한 폭 넓이로 해석
        ),
        'hmax' => array(
            'type' => self::ATTR_INTEGER,               // 노출의 픽셀단위 최대 세로 길이. h 값과 함께 포함된 경우, h는 권장되거나, 바람직한 세로 길이로 해석
        ),
        'wmin' => array(
            'type' => self::ATTR_INTEGER,               // 노출의 픽셀단위 최소 가로길이. w 값과 함께 포함된 경우, w는 권장되거나, 바람직한 폭 넓이로 해석
        ),
        'hmin' => array(
            'type' => self::ATTR_INTEGER,               // 노출의 픽셀단위 최소 세로 길이. h 값과 함께 포함된 경우, h는 권장되거나, 바람직한 세로 길이로 해석
        ),
        'btype' => array(
            'type' => self::ATTR_ARRAY,                 // 차단된 배너 광고 유형(5.2). 빈 값일 경우 모두 허용으로 간주.
            'sub_type' => self::ATTR_INTEGER,
        ),
        'battr' => array(
            'type' => self::ATTR_ARRAY,                 // 차단된 광고물 속성(5.3). 빈 값일 경우 모두 허용으로 간주.
            'sub_type' => self::ATTR_INTEGER,
        ),
        'pos' => array(
            'type' => self::ATTR_INTEGER,               // 화면의 광고 스크린 포지션, 위치(5.4)
        ),
        'mimes' => array(
            'type' => self::ATTR_ARRAY,                 // 컨텐츠 MIME 속성 지원. 가장 인기 있는 속성은 "application/x-shockwave-flash", "image/jpg", "image/gif"다.
            'sub_type' => self::ATTR_STRING,
        ),
        'topframe' => array(
            'type' => self::ATTR_INTEGER,               // 배너가 최상위 프레임에 전송 되는지, 아니면 iFrame에 전송되는 지를 나타내는 플래그. 0 = 그렇지 않다. 1 = 최상위 프레임에 전송된다.
        ),
        'expdir' => array(
            'type' => self::ATTR_ARRAY,                 // 확장 광고 속성을 설정(5.5)
            'sub_type' => self::ATTR_INTEGER,
        ),
        'api' => array(
            'type' => self::ATTR_ARRAY,                 // 이 노출에 대해 지원되는 API 프레임 워크 목록(5.6 참조). API를 명시하지 않을 경우, 지원되지 않는 것으로 한다.
            'sub_type' => self::ATTR_INTEGER,
        ),
        'ext' => array(
            'type' => 'openrtb\BidRequest\Ext',
        ),
    );

}