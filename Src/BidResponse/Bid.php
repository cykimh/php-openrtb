<?php
namespace openrtb\BidResponse;

class Bid extends \openrtb\Abstractions\BaseModel {
  
	protected $attributes = array(
		'id' => array(                              // Bidder generated bid ID to assist with logging/tracking.
      		'required' => true,
			'type' => self::ATTR_ID
		),
		'impid' => array(                           // ID of the Imp object in the related bid request.
      		'required' => true,
			'type' => self::ATTR_ID
		),
		'price' => array(                           // Bid price expressed as CPM although the actual transaction is for a unit impression only. Note that while the type indicates float, integer math is highly recommended when handling currencies (e.g., BigDecimal in Java).
      		'required' => true,
			'type' => self::ATTR_FLOAT
		),
		'adid' => array(                            // ID of a preloaded ad to be served if the bid wins.
			'type' => self::ATTR_STRING
		),
		'nurl' => array(                            // Win notice URL called by the exchange if the bid wins; optional means of serving ad markup.
			'type' => self::ATTR_STRING
		),
		'adm' => array(                             // Optional means of conveying ad markup in case the bid wins; supersedes the win notice if markup is included in both.
			'type' => self::ATTR_STRING
		),
		'adomain' => array(                         // Advertiser domain for block list checking (e.g., “ford.com”). This can be an array of for the case of rotating creatives. Exchanges can mandate that only one domain is allowed
 			'type' =>  self::ATTR_ARRAY,
 			'sub_type' => self::ATTR_STRING
		),
		'bundle' => array(                          // Bundle or package name (e.g., com.foo.mygame) of the app being advertised, if applicable; intended to be a unique ID across exchanges.
			'type' => self::ATTR_STRING
		),
		'iurl' => array(                            // URL without cache-busting to an image that is representative of the content of the campaign for ad quality/safety checking
			'type' => self::ATTR_STRING
		),
		'cid' => array(                             // Campaign ID to assist with ad quality checking; the collection of creatives for which iurl should be representative.
			'type' => self::ATTR_STRING
		),
		'crid' => array(                            // Creative ID to assist with ad quality checking
			'type' => self::ATTR_STRING
		),
		'cat' => array(                             // IAB content categories of the creative. Refer to List 5.1.
 			'type' =>  self::ATTR_ARRAY,
 			'sub_type' => self::ATTR_STRING
		),
		'attr' => array(                            // Set of attributes describing the creative. Refer to List 5.3.
 			'type' =>  self::ATTR_ARRAY,
 			'sub_type' => self::ATTR_INTEGER
		),
		'dealid' => array(                          // Reference to the deal.id from the bid request if this bid pertains to a private marketplace direct deal
			'type' => self::ATTR_STRING
		),
		'h' => array(                               // Height of the creative in pixels.
			'type' => self::ATTR_INTEGER
		),
		'w' => array(                               // Width of the creative in pixels.
			'type' => self::ATTR_INTEGER
		),
 		'ext' => array(                             // Placeholder for bidder-specific extensions to OpenRTB.
 			'type' => 'openrtb\BidResponse\Ext'
 		),
	);
  
}