<?php
namespace openrtb\BidRequest;

class Content extends \openrtb\Abstractions\BaseModel {
  
	protected $attributes = array(
		'id' => array (
			'type' => self::ATTR_ID                 // 컨텐츠를 구분할 수 있는 유니크한 ID
		),
		'episode' => array (
			'type' => self::ATTR_INTEGER            // 에피소드 번호(일반적으로 비디오 컨텐츠에 적용)
		),
		'title' => array (
			'type' => self::ATTR_STRING             // 컨텐츠 제목.
		),
		'series' => array (
			'type' => self::ATTR_STRING             // 컨텐츠 시리즈.
		),
		'season' => array (
			'type' => self::ATTR_STRING             // 컨텐츠 시즌. 일반적으로 비디오 컨텐츠에 사용(e.q. season 3)
		),
		'producer' => array (
			'type' => 'openrtb\BidRequest\Producer' // 컨텐츠 프로듀서(3.2.10)에 대한 상세 정보
		),
		'url' => array (
			'type' => self::ATTR_STRING             // 바이 사이드의 문맥 분석이나 검토를 위한 컨텐츠의 원본 URL
		),
		'cat' => array (
			'type' => self::ATTR_ARRAY,             // 컨텐츠 프로듀서를 설명하는 IAB 컨텐츠 카테고리 배열(5.1)
			'sub_type' => self::ATTR_STRING
		),
		'videoquality' => array (
			'type' => self::ATTR_INTEGER            // IAB 분류에 따른 비디오 품질(5.11), 추후 prodq만 제공할 예정.
		),
		'context' => array (
			'type' => self::ATTR_INTEGER            // 컨텐츠의 타입(게임, 비디오, 텍스트 등). (5.14)
		),
		'contentrating' => array (
			'type' => self::ATTR_STRING             // 컨텐츠 등급(MPAA)
		),
		'userrating' => array (
			'type' => self::ATTR_STRING             // 컨텐츠의 유저 등급(별 또는 좋아요 등등)
		),
		'qagmediarating' => array (
			'type' => self::ATTR_INTEGER            // QAG 가이드 라인에 따른 미디어 평가.
		),
		'keywords' => array (
			'type' => self::ATTR_STRING             // 콤마로 나뉘어진 컨텐츠 설명의 키워드 목록
		),
		'livestream' => array (
			'type' => self::ATTR_INTEGER            // 0=라이브아님, 1=라이브 컨텐츠(live video stream, 라이브 블로그)
		),
		'sourcerelationship' => array (
			'type' => self::ATTR_INTEGER            // 0=indirect, 1=direct
		),
		'len' => array (
			'type' => self::ATTR_INTEGER            // 컨텐츠 초의 길이. 비디오나 오디오에 적당함.
		),
		'language' => array (
			'type' => self::ATTR_STRING             // 컨텐츠 언어를 ISO-639-1-alpha-2를 사용하여 표현
		),
		'embeddable' => array (
			'type' => self::ATTR_INTEGER            // QAG Video를 근거로 임베드가능한(내장 가능한) 콘텐츠인지 확인(0=no, 1=yes)
		),
		'ext' => array (
			'type' => 'openrtb\BidRequest\Ext'      // OpenRTB의 고유 Exchange 확장 오브젝트에 대한 표시.
		),
	);
  
}