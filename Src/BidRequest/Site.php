<?php

namespace openrtb\BidRequest;

class Site extends \openrtb\Abstractions\BaseModel {

    protected $attributes = array(
        'id' => array(
            'type' => self::ATTR_ID,                        // exchange에 명시되있는 site ID
        ),
        'name' => array(
            'type' => self::ATTR_STRING,                    // 사이트이름(퍼블리셔의 요청에 따라 마스킹되어있을 수도 있음)
        ),
        'domain' => array(
            'type' => self::ATTR_STRING,                    // 사이트 도메인(www.foo.com)
        ),
        'cat' => array(
            'type' => self::ATTR_ARRAY,                     // 사이트의 IAB 컨텐츠 카테고리 배열. (5.1 참조)
            'sub_type' => self::ATTR_STRING,
        ),
        'sectioncat' => array(
            'type' => self::ATTR_ARRAY,                     // 사이트의 현재 섹션을 묘사하는 IAB 컨텐츠 카테고리 배열(5.1)
            'sub_type' => self::ATTR_STRING,
        ),
        'pagecat' => array(
            'type' => self::ATTR_ARRAY,                     // 사이트의 현재 페이지나 뷰를 묘사하는 IAB 컨텐츠 카테고리 배열(5.1)
            'sub_type' => self::ATTR_STRING,
        ),
        'page' => array(
            'type' => self::ATTR_STRING,                    // 광고가 보여질(impression) 페이지의 URL
        ),
        'ref' => array(
            'type' => self::ATTR_STRING,                    // 현재 페이지로 안내(navigation)된 referer URL
        ),
        'search' => array(
            'type' => self::ATTR_STRING,                    // 현재 페이지로 안내(navigation)된 검색어(search string)
        ),
        'mobile' => array(
            'type' => self::ATTR_INTEGER,                   // 모바일에 최적화된 신호인가? 0=no, 1=yes
        ),
        'privacypolicy' => array(
            'type' => self::ATTR_INTEGER,                   // 사이트가 개인정보보호를 표시하는가? 0=no, 1=yes
        ),
        'publisher' => array(
            'type' => 'openrtb\BidRequest\Publisher',       // 사이트의 퍼블리셔의 상세 정보를 담은 객체(3.2.8)
        ),
        'content' => array(
            'type' => 'openrtb\BidRequest\Content',         // 사이트의 컨텐츠의 상세 정보를 담은 객체(3.2.9)
        ),
        'keywords' => array(
            'type' => self::ATTR_STRING,                    // 콤마로 분리한 사이트에 대한 키워드 목록
        ),
        'ext' => array(
            'type' => 'openrtb\BidRequest\Ext',             // OpenRTB의 고유 Exchange 확장 오브젝트에 대한 표시.
        ),
    );

}