<?php

namespace openrtb\BidRequest;

class Video extends \openrtb\Abstractions\BaseModel {

    protected $attributes = array(
        'id' => array(
            'type' => self::ATTR_ID,                            //
        ),
        'w' => array(
            'type' => self::ATTR_INTEGER,                       // 비디오 플레이어의 DIPS 단위 가로길이.
        ),
        'h' => array(
            'type' => self::ATTR_INTEGER,                       // 비디오 플레이어의 DIPS 단위 세로길이.
        ),
        'mimes' => array(
            'required' => true,
            'type' => self::ATTR_ARRAY,                         // 컨텐츠의 MIME 타입을 지원. 가장 인기있는 속성은 윈도우 media를 사용하는 "video/x-ms-wmv", flash video를 사용하는 "video/x-flv"입니다.
            'sub_type' => self::ATTR_STRING,
        ),
        'minduration' => array(
            'type' => self::ATTR_INTEGER,                       // 비디오의 최소 지속 시간(초)
        ),
        'maxduration' => array(
            'type' => self::ATTR_INTEGER,                       // 비디오의 최대 지속 시간(초)
        ),
        'protocol' => array(
            'type' => self::ATTR_INTEGER,                       //
        ),
        'protocols' => array(
            'type' => self::ATTR_ARRAY,                         // video 입찰 응답을 지원하는 프로토콜 배열. 5.8에서 상세 설명. 최소한 하나 이상의 프로토콜이 protocols의 속성에서 정의되어야 한다.
            'sub_type' => self::ATTR_INTEGER,
        ),
        'startdelay' => array(
            'type' => self::ATTR_INTEGER,                       // 프리 롤, 미드 롤 또는 포스트 롤 광고 게재 위치에 대한 초 시작 지연 시간을 나타냅니다. 5.10에서 일반적인 값을 제안.
        ),
        'linearity' => array(
            'type' => self::ATTR_INTEGER,                       // 노출에 대해 순서가 있는 광고인지 아닌지 표현. 지정하지 않을 경우, 모두 허락되는 것으로 간주. 5.7에서 상세 설명
        ),
        'sequence' => array(
            'type' => self::ATTR_INTEGER,                       // 여러 광고 노출이 같은 입찰 요청에 제공되는 경우. 이 필드(일련 번호)는 여러 광고 소재를 조율해서 복수개의 광고물을 순서대로 전송합니다.
        ),
        'battr' => array(
            'type' => self::ATTR_ARRAY,                         // 차단된 광고물 속성 (5.3)
            'sub_type' => self::ATTR_INTEGER,
        ),
        'maxextended' => array(
            'type' => self::ATTR_INTEGER,                       // 최대 연장된 재생 시간. 값이 0이거나 비어있을 경우 시간 연장을 허용하지 않는다. -1을 넣을 경우 제한이 없이 허용하고, 0보다 클 경우, 입력 값을 초(sec)로 보고, 플레이하는 동안 최대 확장으로 maxduration 값을 넘어선 시간 이상 재생.
        ),
        'minbitrate' => array(
            'type' => self::ATTR_INTEGER,                       // 최소 bit rate(Kbps). exchange는 세팅을 통해 publisher 마다 동적 또는 보편적으로 설정할 수 있습니다.
        ),
        'maxbitrate' => array(
            'type' => self::ATTR_INTEGER,                       // 최대 bit rate(Kbps). exchange는 세팅을 통해 publisher 마다 동적 또는 보편적으로 설정할 수 있습니다.
        ),
        'boxingallowed' => array(
            'type' => self::ATTR_INTEGER,                       // 익스체인지 매체가 16×9 화면에서 플레이하기 위해 4×3 비율의 컨텐츠 레터박스를 금지하면 이 필드는 false 로 셋팅되어야 합니다. 기본값은 true 로 화면에 맞는 컨텐츠 레터 박스를 허락하도록 합니다. 레터박스를 허락할 경우 “1”, 그렇지 않을 경우 “0” 으로 설정합니다.
            'default_value' => 1,
        ),
        'playbackmethod' => array(
            'type' => self::ATTR_ARRAY,                         // playback method를 설정하는 곳.auto sound, click-to-play, mouse-over 등이 있으며, 따로 지정하지 않을 경우 모두 허용하는 것으로 간주(5.9).
            'sub_type' => self::ATTR_INTEGER,
        ),
        'delivery' => array(
            'type' => self::ATTR_ARRAY,                         // delivery method를 지원.(streaming, progressive 중 선택(5.13)). 따로 지정하지 않을 경우 모두 지원하는 것으로 간주.
            'sub_type' => self::ATTR_INTEGER,
        ),
        'pos' => array(
            'type' => self::ATTR_INTEGER,                       // 스크린의 광고 포지션, 위치(5.4)
        ),
        'companionad' => array(
            'type' => self::ATTR_ARRAY,                         // 컴패니언 광고를 사용할 수 있는 경우 Banner 객체를 배열로 넣는다.
            'sub_type' => 'openrtb\BidRequest\Banner',
        ),
        'companiontype' => array(
            'type' => self::ATTR_ARRAY,                         // VAST 컴패니언 광고 타입을 지원(static resource, html resource, iframe resource). (5.12). 컴패니언ad array에 컴패니언배너 객체가 포함되있을 경우 추천되는 파라메터.
            'sub_type' => 'openrtb\BidRequest\Banner',
        ),
        'api' => array(
            'type' => self::ATTR_ARRAY,                         // 지원하는 API framework의 목록(5.6). 명시적으로 api 리스트를 지정하지 않을경우 아무것도 지원되지 않는다.
            'sub_type' => self::ATTR_INTEGER,
        ),
        'ext' => array(
            'type' => 'openrtb\BidRequest\Ext',                 // OpenRTB의 고유 Exchange 확장 오브젝트에 대한 표시.
        ),
    );

}