<?php

/**
 * Created by YupChang on 2020-02-04
 */

namespace openrtb\NativeAdResponse;

class Native extends \openrtb\Abstractions\BaseModel {

    protected $attributes = array(
        'ver' => array(
            'type' => self::ATTR_STRING,
            'default_value' => '1.2',
        ),
        'assets' => array(
            'type' => self::ATTR_ARRAY,
            'sub_type' => 'openrtb\NativeAdResponse\Assets',
        ),
        'assetsurl' => array(
            'type' => self::ATTR_STRING,
        ),
        'dcourl' => array(
            'type' => self::ATTR_STRING,
        ),
        'link' => array( // Destination Link. This is default link object for the ad. Individual assets can also have a link object which applies if the asset is activated(clicked). If the asset doesn’t have a link object, the parent link object applies. See LinkObject Definition
            'type' => 'openrtb\NativeAdResponse\Link',
        ),
        'imptrackers' => array(
            'type' => self::ATTR_ARRAY,
            'sub_type' => self::ATTR_STRING,
        ),
        'jstrackers' => array(
            'type' => self::ATTR_STRING,
        ),
        'eventtrackers' => array(
            'type' => self::ATTR_ARRAY,
            'sub_type' => 'openrtb\NativeAdResponse\EventTrackers',
        ),
        'privacy' => array(
            'type' => self::ATTR_STRING,
        ),
        'ext' => array(
            'type' => 'openrtb\NativeAdResponse\Ext',
        ),

    );
    /* {
    "native" : {
    "ver": "", // [String] 마크업버전
    "assets": [ //  [Array, Required] 기본 광고 내용, assetsurl이 없으면 필수!
    {
        "id": 1, // [Int]
        "required": 0, // [Int]

            // title,img,video,data 중 하나만 들어갈 수 있다
        "title" : { // [Object] TitleObject 참조
        "text" : "", // [String, Required] 본문
        "len" : 0, // [Integer] 타이틀 길이, assetsurl, dcourl 일 경우는 필수
        "ext" : {} // [Object] 맞춤JSON
        },
        "img": { // [Object] ImageObject 참조
            "type" : 0, // [Integer] assetsurl, dcourl에 필요, 이미지 유형
            // 1: 아이콘, 3:main
            "url" : "", // [String] 이미지 Url
            "w" : 0,  // [Integer] 이미지 너비
            "h" : 0, // [Integer] 이미지 높이
            "ext" : {} // [Object] 맞춤JSON
        },
        "video": { // [Object] VideoObject 참조
            "vasttag" : "" // [String] VastXml
        },
        "data": { // [Object]
            "type": 0, // [Integer] assetsurl, dcourl에 필요, 데이터 타입
            // 1: sponsored, 2: desc, 3: rating, 4: likes, 5: downloads, 6: price,
            // 7: salesprice, 8: phone, 9:address, 10:desc2, 11:displayurl, 12: ctatext
            "len" : 0, // [Integer] assetsurl, dcourl에 필요, 데이터 길이
            "value" : "", // [String] 형식화 된 데이터 문자열
            "ext" : {} // [Object] 맞춤JSON
        },
        "link": { // [Object] 광고에 대한 어떤 행동
            "url": "", // [String] 클릭 시 방문 URL
            "clicktrackers": "", // [String] 클릭 트래킹 UURL
            "fallback": "", // [String] 딥링크를 위한 Fallback Url
            "ext" : {} // [Object] 맞춤JSON
        },
        "ext": {}
        }],
        "assetsurl": "", // [String] 객체 자산 URL, 응답은 JSON
        "dcourl": "", // [String] 동적 컨텐츠 광고
        "link":{},
        "imptrackers":[],
        "jstracker": "",
        "eventtrackers": [{ // [Object] 사용시 imptrackers와 jstracker가 사용되지 않는다
        "event": 0,
          "method": 0,
          "url" : "",
          "customdata": {},
          "ext": {}
        }],
        "privacy": "",
        "ext": {}

     }
    }*/
}