<?php
namespace openrtb\BidRequest;

class Regulation extends \openrtb\Abstractions\BaseModel {
  
  protected $attributes = array(
    'id' => array(
      'type' => self::ATTR_ID,
    ),
    'coppa' => array(
      'type' => self::ATTR_INTEGER,
    ),
    'ext' => array(
      'type' => 'openrtb\BidRequest\Ext',
    ),
  );
  
}