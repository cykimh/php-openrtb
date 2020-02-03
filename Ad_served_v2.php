<?php
/**
 * Created by YupChang on 2020-01-13
 */
require_once APPPATH . "/third_party/php-openrtb/PHPOpenRtb.php";

class Ad_served_v2 extends CI_Controller {

    protected const BANNER_SIZE = array(
        [320, 50], [320, 480], [300, 250], [480, 320], [320, 100], [100, 100], [150, 150], [200, 200], [728, 90], [970, 90], [160, 600], [300, 600], [120, 600], [250, 250]
    );
    // 허용 아이콘 사이즈
    protected const ICON_SIZE = array(
        [15, 15], [20, 20], [40, 40], [60, 60]
    );

    protected $oBidRequest;
    protected $oBidResponse;

    protected $sAdmixerDspUrl;             //
    protected $sClickTrackingUrl;
    protected $sAdImgUrl;
    protected $sRedirectUrl;

    /**
     * Ad_served2 constructor.
     */
    public function __construct() {
        parent::__construct();

//        $this->sAdmixerDspUrl  = $this->config->item('ssl_domain') . '/' . get_class($this);
//
//        $this->config->load('ftp', true);
//        $aFtpInfo       = $this->config->item('ftp');
//        $this->sAdImgUrl  = $aFtpInfo['img']['domain'] . $aFtpInfo['img']['default_path'] . '/admixer_dsp_ad';

        $this->sAdImgUrl            = "impurl";
        $this->sAdmixerDspUrl       = "dspurl";
        $this->sClickTrackingUrl    = $this->sAdmixerDspUrl . "/click_tracking?";
        $this->sRedirectUrl         = "https://partner.admixer.co.kr";

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


    protected function _banner_ad_req($oImp) {

        $oSeatBid = new \openrtb\BidResponse\SeatBid();

        $oSeatBid->set('seat', 'admixer_nasmedia_'.uniqid());
        $sBidId = sha1(uniqid());

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

        // BidResponse 객체 생성
        $oBid = new \openrtb\BidResponse\Bid();
        $oBid->set('id', $sBidId);
        $oBid->set('impid', $oImp->get('id'));
        $oBid->set('price', $oImp->get('bidfloor'));

        $sAdm = $this->_get_adm("banner", $nW, $nH);
        $oBid->set('adm', $sAdm);
        $oBid->set('w', $nW);
        $oBid->set('h', $nH);
        /*
                $oBid->set('adid', '');
                $oBid->set('iurl', '');
                $oBid->set('nurl', '');
        */
        $oBid->set('adomain', [$this->sRedirectUrl]);

        $oExt = new \openrtb\BidResponse\Ext();

        $sQueryString = http_build_query(['bid_id' => $sBidId, 'size_cd' => $nW.'X'.$nH]);
        $oExt->set('clickurl', $this->sClickTrackingUrl . $sQueryString);

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
    protected function _video_ad_req($oImp) {

        $oSeatBid = new \openrtb\BidResponse\SeatBid();

        $oSeatBid->set('seat', 'Admixer_Dsp_'.uniqid());
        $sBidId     = sha1(uniqid());

        // BidResponse 객체 생성
        $oBid = new \openrtb\BidResponse\Bid();
        $oBid->set('id', $sBidId);
        $oBid->set('impid', $oImp->get('id'));
        $oBid->set('price', $oImp->get('bidfloor'));

        $sAdm = $this->_get_adm("video");
        $oBid->set('adm', $sAdm);

        $oBid->set('w', $oImp->get('video')->get('w'));
        $oBid->set('h', $oImp->get('video')->get('h'));

        $oBid->set('adomain', [$this->sRedirectUrl]);
//        $oBid->set('cid', 0);
//        $oBid->set('crid', 0);
//        $oBid->set('iurl', 0);
//        $oBid->set('bundle', 0);
//        $oBid->set('cat', 0);
//        $oBid->set('attr', 0);
//        $oBid->set('dealid', '');

        $oExt = new \openrtb\BidResponse\Ext();
        $oExt->set('bidtype', 0);
        $oBid->set('ext', $oExt);

        $oSeatBid->set('bid', [$oBid]);

        return $oSeatBid;
    }
    protected function _native_ad_req($oImp) {

        $oSeatBid = new \openrtb\BidResponse\SeatBid();
        $oSeatBid->set('seat', 'Admixer_Dsp_' . uniqid());

        $sBidId = sha1(uniqid());

        $oBid = new \openrtb\BidResponse\Bid();
        $oBid->set('id', $sBidId);
        $oBid->set('impid', $oImp->get('id'));
        $oBid->set('price', $oImp->get('bidfloor'));

        $sNativeAdm = $oImp->get('native')->get('request');

        $sAdm = $this->_get_native_adm($sNativeAdm);
        $oBid->set('adm', $sAdm);
//        $oBid->set('w', $oImp->get('video')->get('w'));
//        $oBid->set('h', $oImp->get('video')->get('h'));

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





    // NativeRequest객체에 따른 NativeResponse객체 반환
    protected function _get_native_adm($sReq='') {

        $oNativeRequest = new \openrtb\NativeAdRequest\NativeAdRequest();
        $oNativeRequest->hydrate($sReq);

        // Native 응답객체 선언 생성
        $oNativeResponse = new \openrtb\NativeAdResponse\NativeAdResponse();

        // Ver
        $oNativeResponse->set('ver', $oNativeRequest->get('ver'));

        // Assets
        $aAssets = $oNativeRequest->get('assets');

        $aAssetsResponse = [];

        foreach($aAssets as $asset) {
            $oAsset = new \openrtb\NativeAdResponse\Assets();
            $oAsset->set('id', $asset->get('id'));

            $bRequired = 1;
            $bValid = false;

            switch (true) {
                case $asset->get('title') :
                    $bRequired = $asset->get('title')->get('required');

                    $oTitle = new \openrtb\NativeAdResponse\Title();
                    $oTitle->set('text', "Nasmedia Title");
                    $oAsset->set('title', $oTitle);
                    break;

                case $asset->get('img') :

                    $bRequired = $asset->get('img')->get('required');
                    $oImg = new \openrtb\NativeAdResponse\Image();

                    $sImgType = ($asset->get('img')->get('type') == 3) ? 'banner' : 'icon'; // 1: Icon, 3: Main
                    // 배너 사이즈가 바로 있을때
                    if ($asset->get('img')->get('w') && $asset->get('img')->get('h')) {
                        $nW = $asset->get('img')->get('w');
                        $nH = $asset->get('img')->get('h');

                    } else if ($asset->get('img')->get('wmin') && $asset->get('img')->get('hmin')) {
                        $aImgSize = $this->_search_image_size($sImgType, $asset->get('img')->get('wmin'), $asset->get('img')->get('hmin'));
                        $nW = $aImgSize[0] ?? 0;
                        $nH = $aImgSize[1] ?? 0;
                    } else {
                        throw new \openrtb\Exceptions\ValidationException('Native Img Size Is Not Exist');
//                        $this->_no_bidding_return();
                    }

                    $bValid = $this->_validation_size($sImgType, $nW, $nH);

                    $oImg->set('url', $this->_get_ad_url($sImgType, $nW, $nH));
                    $oAsset->set('img', $oImg);
                    break;

                case $asset->get('video') :
                    $bRequired = $asset->get('video')->get('required');

                    $oVideo = new \openrtb\NativeAdResponse\Video();
                    $oVideo->set('vasttag', $this->_get_adm("video"));
                    $oAsset->set('video', $oVideo);
                    break;

                case $asset->get('data') :
                    $bRequired = $asset->get('data')->get('required');

                    $oData = new \openrtb\NativeAdResponse\Data();
                    $oData->set('value', "Data Field");
                    $oAsset->set('data', $oData);
                    break;

                case $asset->get('link') :

                    $oLink = new \openrtb\NativeAdResponse\Link();
                    break;

                default :
                    break;
            }

            if(!$bValid && !$bRequired) continue;
            if(!$bValid) $this->_no_bid_return();

            $aAssetsResponse[] = $oAsset;
        }

        $oNativeResponse->set('assets', $aAssetsResponse);

        // Link
        $oLink = new \openrtb\NativeAdResponse\Link();
        $oLink->set('url', $this->sRedirectUrl);                // Partner 사이트로 이동
        $oNativeResponse->set('link', $oLink);

        // EventTrackers
        $aEventTrackers = $oNativeRequest->get('eventtrackers');

        if(!empty($aEventTrackers)) {
            $aEventTrackersResponse = [];

            foreach($aEventTrackers as $event_tracker) {
                $oEventTracker = new \openrtb\NativeAdResponse\EventTrackers();

                $oEventTracker->set('event', $event_tracker->get('event'));
                $oEventTracker->set('method', $event_tracker->get('event'));

                $aEventTrackersResponse[] = $oEventTracker;
            }
            $oNativeResponse->set('eventtrackers', $aEventTrackersResponse);
        }

        /*
                $oNativeResponse->set('assetsurl', '');
                $oNativeResponse->set('dcourl', '');
                $oNativeResponse->set('imptrackers', '');
                $oNativeResponse->set('jstrackers', '');
                $oNativeResponse->set('eventtrackers', '');
                $oNativeResponse->set('privacy', '');
        */
        return $oNativeResponse->getDataAsJson();

    }

    // wmin, hmin으로 사이즈 찾기
    protected function _search_image_size($type, $min_width, $min_height) {

        $arr = ($type=="banner") ? self::BANNER_SIZE : self::ICON_SIZE;

        $aFindSize = array_filter($arr, function($aSize) use($min_width, $min_height) {
            return ($aSize[0] >= $min_width && $aSize[1] >= $min_height);
        });

        return array_shift($aFindSize);
    }

    // 현재 소재로 사용가능한 사이즈 체크
    protected function _validation_size($type, $width, $height) {
        $arr = ($type == "banner") ? self::BANNER_SIZE : self::ICON_SIZE;
        foreach($arr as $aSize) {
            if($aSize[0] == $width && $aSize[1] == $height) {
                return true;
            }
        }
        return false;
    }

    // Ad 소재 Url
    protected function _get_ad_url($type, $width, $height) {

        return $this->sAdImgUrl . "/{$type}_{$width}_{$height}";
    }

    // 정의해놓은 admarkup 불러오기
    protected function _get_adm($type, $width=0, $height=0) {
        $nAdformatId= ($type == "banner") ? 1 : (($type == "video") ? 2 : 3);

        $this->db   = $this->load->database('admixer', TRUE);    // 리포트는 SlaveDb를 바라보도록

        $sQuery     = "SELECT * FROM admixer_dsp.adm_sample WHERE 1 AND adformat_id = ? AND width = ? AND height = ?";
        $aResult    = $this->db->query($sQuery, [$nAdformatId, $width, $height])->row_array();

        return preg_replace('/\r\n|\r|\n/', '', $aResult['adm']);
    }

    // Return HTTP 204 No Content 반환
    protected function _no_bid_return() {
        header("HTTP/1.0 204 No Content");
        exit;
    }

    // 노출 측정
    public function imp_tracking() {
        $aParam = $this->input->get();

        if(empty($aParam['bid_id']) || empty($aParam['size_cd'])) {
            return "Empty Parameters";
        }

        $sYmd = date('Ymd');
        $sYmdh = date('YmdH');
        $this->db   = $this->load->database('admixer', TRUE);    // 리포트는 SlaveDb를 바라보도록

        $sQuery = "
            INSERT INTO admixer_dsp.report_rtb (bid_id, ymdh, ymd, size_cd, win) 
            VALUES (?, ?, ?, ?, 1)
              ON DUPLICATE KEY UPDATE win = win + 1
            ";
        $this->db->query($sQuery, [$aParam['bid_id'], $sYmdh, $sYmd, $aParam['size_cd']]);

        return "OK";
    }

    // 클릭 측정
    public function click_tracking() {

        $aParam = $this->input->get();
        if(empty($aParam['bid_id']) || empty($aParam['size_cd'])) return "Empty Parameters";

        $sYmd = date('Ymd');
        $sYmdh = date('YmdH');
        $this->db   = $this->load->database('admixer', TRUE);    // 리포트는 SlaveDb를 바라보도록

        $sQuery = "
            INSERT INTO admixer_dsp.report_rtb (bid_id, ymdh, ymd, size_cd, click) 
            VALUES (?, ?, ?, ?, 1)
              ON DUPLICATE KEY UPDATE click = click + 1
            ";
        $this->db->query($sQuery, [$aParam['bid_id'], $sYmdh, $sYmd, $aParam['size_cd']]);

        return "OK";
    }

}