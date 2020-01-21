<?php
/**
 * Created by YupChang on 2020-01-13
 */
require_once APPPATH . "/third_party/PHPOpenRtb/PHPOpenRtb.php";

class Ad_served_v2 extends CI_Controller {

    private const BANNER_SIZE = array(
        [320,50],[320,480],[300,250],[480,320],[320,100],[100,100],[150,150],[200,200],[728,90],[970,90],[160,600],[300,600],[120,600],[250,250]
    );
    // 허용 아이콘 사이즈
    private const ICON_SIZE = array(
        [15,15],[20,20],[40,40],[60,60]
    );

    private $oBidRequest;
    private $oBidResponse;

    private $sDspUrl;
    private $sImgUrl;

    /**
     * Ad_served2 constructor.
     */
    public function __construct() {
        parent::__construct();

        $this->sDspUrl  = $this->config->item('ssl_domain') . '/' . get_class($this);

        $this->config->load('ftp', true);
        $aFtpInfo       = $this->config->item('ftp');
        $this->sImgUrl  = $aFtpInfo['img']['domain'] . $aFtpInfo['img']['default_path'] . '/admixer_dsp_ad';


        try {
            $sRawData = file_get_contents('php://input');

            $this->oBidRequest = new \openrtb\BidRequest\BidRequest();
            $this->oBidRequest->hydrate($sRawData);

        } catch (\Exception $e) {
            var_dump($e->getMessage());
        }

        $this->oBidResponse = new \openrtb\BidResponse\BidResponse();

    }

    public function ad_req() {

        $sReqId     = $this->oBidRequest->get('id');
        $oReqImp    = $this->oBidRequest->get('imp');

        if (!isset($oReqImp)) {
            $this->_no_bid_return();
        }

        $this->oBidResponse->set('id', $sReqId);
        $this->oBidResponse->set('bidid', '' ); // Todo : ??
        $this->oBidResponse->set('cur', $this->oBidRequest->get('cur') ?? 'KRW');

        $oSeats = array();
        foreach($oReqImp as $imp) {
            $oSeatBid = array();
            switch (true) {
                case $imp->get('banner') :
                    $oSeatBid = $this->_banner_ad_req($imp);
                    break;
                case $imp->get('video') :
                    $oSeatBid = $this->_video_ad_req($imp);
                    break;
                case $imp->get('native') :
                    $oSeatBid = $this->_native_ad_req($imp);
                    break;
                default :
                    $this->_no_bid_return();
                    break;
            }
            $oSeats[] = $oSeatBid;
        }

        $this->oBidResponse->set('seatbid', $oSeats);
//        $this->oBidResponse->set('nbr', ''); // Todo : ??

        header('Content-Type: application/json');
        echo $this->oBidResponse->getDataAsJson();
    }

    private function _banner_ad_req($oImp) {

        $oSeatBid = new \openrtb\BidResponse\SeatBid();

        $oSeatBid->set('seat', 'Admixer_Dsp_'.uniqid());
        $sBidId = sha1(uniqid());

        $oBid = new \openrtb\BidResponse\Bid();
        $oBid->set('id', $sBidId);
        $oBid->set('impid', $oImp->get('id'));
        $oBid->set('price', $oImp->get('bidfloor'));

        $oReqBannerObj = $oImp->get('banner');

        // 배너 사이즈가 바로 있을때
        if ($oReqBannerObj->get('w') && $oReqBannerObj->get('h')) {
            $nW = $oReqBannerObj->get('w');
            $nH = $oReqBannerObj->get('h');
        } else if ($oReqBannerObj->get('wmin') && $oReqBannerObj->get('hmin')) {
            $aImgSize = $this->_search_image_size("banner", $oReqBannerObj->get('wmin'), $oReqBannerObj->get('hmin'));
            $nW = $aImgSize[0] ?? 0;
            $nH = $aImgSize[1] ?? 0;
        } else {
            throw new \openrtb\Exceptions\ValidationException('BannerObject Size Is Not Exist');
        }

        $bValid = $this->_validation_size("banner", $nW, $nH);
        if(!$bValid) $this->_no_bidding_return();

        $sAdm = $this->_get_adm("banner", $nW, $nH);
        $oBid->set('adm', $sAdm);
        $oBid->set('w', $nW);
        $oBid->set('h', $nH);

        $oBid->set('adid', '');
        $oBid->set('iurl', '');
        $oBid->set('nurl', '');

        $oBid->set('adomain', ["https://partner.admixer.co.kr"]);

        $oExt = new \openrtb\BidResponse\Ext();

        $sQueryString = http_build_query(['bid_id' => $sBidId, 'size_cd' => $nW.'X'.$nH]);
        $sClickUrl = $this->sDspUrl . '/click_tracking?' . $sQueryString;
        $oExt->set('clickurl', $sClickUrl);

        $oBid->set('ext', $oExt);
        $oSeatBid->set('bid', [$oBid]);

        return $oSeatBid;

 /*       {
            "id": "[$BID_ID]",
            "cur": "KRW",
            "seatbid": [{
                    "seat": "Admixer_Dsp",
                "bid": [{
                        "id": "1",
                    "impid": "[$BID_IMP_ID]",
                    "price": [$BID_BIDFLOOR],
                    "adid": "a1a4b777-b6f5-45f6-9baf-a6fac07cef15",
                    "crid": "0",
                    "cid": "0",
                    "adm": [$BID_ADM],
                    "w": [$BID_WIDTH],
                    "h": [$BID_HEIGHT],
                    "iurl": null,
                    "nurl": "",
                    "ext": {
                            "clickurl": "[$CLICK_TRACKING]"
                    },
                    "adomain": ["admixer.co.kr"]
                }]
        	}]
        }
 */
    }
    private function _video_ad_req($oImp) {

        $oSeatBid = new \openrtb\BidResponse\SeatBid();

        $oSeatBid->set('seat', 'Admixer_Dsp_'.uniqid());
        $sBidId     = sha1(uniqid());

        $oBid = new \openrtb\BidResponse\Bid();
        $oBid->set('id', $sBidId);
        $oBid->set('impid', $oImp->get('id'));
        $oBid->set('price', $oImp->get('bidfloor'));
        $oBid->set('adm', '');

        $oBid->set('w', $oImp->get('video')->get('w'));
        $oBid->set('h', $oImp->get('video')->get('h'));

        $oSeatBid->set('bid', [$oBid]);

        return $oSeatBid;

    }
    private function _native_ad_req($oImp) {

        $oSeatBid = new \openrtb\BidResponse\SeatBid();

        $oSeatBid->set('seat', 'Admixer_Dsp_'.uniqid());
        $sBidId = sha1(uniqid());

        $oBid = new \openrtb\BidResponse\Bid();
        $oBid->set('id', $sBidId);
        $oBid->set('impid', $oImp->get('id'));
        $oBid->set('price', $oImp->get('bidfloor'));

        $sNativeAdm = $oImp->get('native')->get('request');

        var_dump($sNativeAdm);
        $oNative = new \openrtb\NativeAdRequest\NativeAdRequest();
        $oNative->hydrate($sNativeAdm);


//        $oNative

        var_dump($oNative);exit; //string
        print_r($oNative);exit;


        $oBid->set('adm', '');

        $oBid->set('w', $oImp->get('video')->get('w'));
        $oBid->set('h', $oImp->get('video')->get('h'));

        $oSeatBid->set('bid', [$oBid]);

        return $oSeatBid;
    /*    {
            "id": "[$BID_ID]",
	"cur": "USD",
    "seatbid": [{
            "seat": "Admixer_Dsp",
        "bid": [{
                "id": "1",
            "impid": "[$BID_IMP_ID]",
            "price": [$BID_BIDFLOOR],
            "nurl": "http://example-dsp.com/win-notie-url&price=${AUCTION_PRICE}",
            "adm": [$BID_ADM],
            "cid": "1",
            "crid": "1",
            "adomain": ["https://partner.admixer.co.kr"]
        }]
    }]
}*/

    }

    private function _search_image_size($type, $min_width, $min_height) {

        $arr = ($type=="banner") ? self::BANNER_SIZE : self::ICON_SIZE;

        $aFindSize = array_filter($arr, function($aSize) use($min_width, $min_height) {
            return ($aSize[0] >= $min_width && $aSize[1] >= $min_height);
        });

        return array_shift($aFindSize);

    }

    // 현재 소재로 사용가능한 사이즈 체크
    private function _validation_size($type, $width, $height) {
        $arr = ($type == "banner") ? self::BANNER_SIZE : self::ICON_SIZE;
        foreach($arr as $aSize) {
            if($aSize[0] == $width && $aSize[1] == $height) {
                return true;
            }
        }
        return false;
    }
    private function _get_adm($type, $width, $height) {
        $nAdformatId= ($type == "banner") ? 1 : (($type == "video") ? 2 : 3);

        $this->db   = $this->load->database('admixer', TRUE);    // 리포트는 SlaveDb를 바라보도록

        $sQuery     = "SELECT * FROM admixer_dsp.adm_sample WHERE 1 AND adformat_id = ? AND width = ? AND height = ?";
        $aResult    = $this->db->query($sQuery, [$nAdformatId, $width, $height])->row_array();
        return preg_replace('/\r\n|\r|\n/', '', $aResult['adm']);
    }

    // Return HTTP 204 No Content 반환
    private function _no_bid_return() {
        header("HTTP/1.0 204 No Content");
        exit;
    }


}