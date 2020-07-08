<?php
/**
 * Created by YupChang on 2020-01-13
 */
require_once APPPATH . "/third_party/PHPOpenRtb/PHPOpenRtb.php";

class Ad_served_v2 extends CI_Controller {

    protected const BANNER_SIZE = array(
        [320, 50], [320, 480], [300, 250], [480, 320], [320, 100], [100, 100], [150, 150], [200, 200], [728, 90], [970, 90], [160, 600], [300, 600], [120, 600], [250, 250]
    );
    // 허용 아이콘 사이즈
    protected const ICON_SIZE = array(
        [15, 15], [20, 20], [40, 40], [60, 60]
    );

    protected $oBidRequest;             //
    protected $oBidResponse;            //

    protected $sAdmixerDspUrl;          // AdmixerNasmedia Url
    protected $sClickTrackingUrl;       // 클릭 트래킹 Url
    protected $sImpTrackingUrl;         // 노출 트래킹 Url
    protected $sAdImgUrl;               // 광고 이미지 Server Url
    protected $sRedirectUrl;            // 클릭 Redirect Url
    protected $sAdDomainUrl;            // 광고주도메인 url

    protected $bTest;   // 에러 출력유무
    protected $nLogId;  // 요청응답 로그Id
    /**
     * Ad_served2 constructor.
     */
    public function __construct() {
        parent::__construct();
    }

    public function init() {
        // Init
        $this->config->load('ftp', true);
        $aFtpInfo                   = $this->config->item('ftp');

        $this->sAdmixerDspUrl       = $this->config->item('ssl_domain') . '/' . get_class($this);
        $this->sAdImgUrl            = $aFtpInfo['img']['domain'] . $aFtpInfo['img']['default_path'] . '/admixer_dsp_ad';
        $this->sClickTrackingUrl    = $this->sAdmixerDspUrl . "/click_tracking?";
        $this->sImpTrackingUrl      = $this->sAdmixerDspUrl . "/imp_tracking?";
        $this->sRedirectUrl         = "https://partner.admixer.co.kr";
        $this->sAdDomainUrl         = "http://www.nasmedia.co.kr/ko/index.do";

        $this->bTest = $this->input->get('test', false);
    }
    public function ad_req() {

        // 기본데이터 초기화
        $this->init();

        $sRawData = file_get_contents('php://input');

        if(empty($sRawData)) $this->errorMessage('Empty RawData');

        // dsp_rtb_log 테이블에 작성
        $this->nLogId = $this->_logging_ad_req($sRawData);

        $this->oBidRequest = new \openrtb\BidRequest\BidRequest();
        $this->oBidRequest->hydrate($sRawData);

        $this->oBidResponse = new \openrtb\BidResponse\BidResponse();

        $sReqId     = $this->oBidRequest->get('id');
        $oReqImp    = $this->oBidRequest->get('imp');

        if (empty($oReqImp)) {
            $this->errorMessage('Empty Request Imp Object');
        }

        $this->oBidResponse->set('id', $sReqId);
        // $this->oBidResponse->set('bidid', ''); // bid
        $this->oBidResponse->set('cur', $this->oBidRequest->get('cur')[0] ?? 'KRW'); // 요청cur은 문자배열, 응답cur은 문자

        // SeatBid 객체 생성 ex) Bidder
        $oSeatBid = new \openrtb\BidResponse\SeatBid();
        $oSeatBid->set('seat', 'admixer_nasmedia_'.uniqid());

        $oBids = [];
        foreach($oReqImp as $imp) {
            $oBid = [];
            switch (true) {
                case $imp->get('banner') :
                    $oBid = $this->_banner_ad_req($imp);
                    break;
                case $imp->get('video') :
                    $oBid = $this->_video_ad_req($imp);
                    break;
                case $imp->get('native') :
                    $oBid = $this->_native_ad_req($imp);
                    break;
                default :
                    $this->errorMessage('Invalid Imp Object');
                    break;
            }
            $oBids[] = $oBid;
        }

        $oSeatBid->set('bid', $oBids);
        $this->oBidResponse->set('seatbid', [$oSeatBid]);
        // $this->oBidResponse->set('nbr', ''); // 노출광고없을때 204 Header를 응답 nbr필요X

        $sBidResponse = $this->oBidResponse->getDataAsJson();
        $this->_logging_ad_req($sBidResponse);

        header('Content-Type: application/json');
        echo $sBidResponse;
    }

    protected function _banner_ad_req($oImp) {

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
            $this->errorMessage("Banner Request Object Size Is Not Exist");
        }

        $bValid = $this->_validation_size("banner", $nW, $nH);
        if(!$bValid) $this->errorMessage("No valid banner size found");

        // BidResponse 객체 생성
        $oBid = $this->_get_common_bid($oImp);

        $sAdm = $this->_get_adm("banner", $nW, $nH);
        $sQueryString = http_build_query(['bid_id'=> $oImp->get('id'), 'size_cd'=> $nW.'x'.$nH]);
        $sAdm = str_replace('[$IMP_TRACKING]', $this->sImpTrackingUrl . $sQueryString, $sAdm);
        $sAdm = str_replace('[$CLICK_TRACKING]', $this->sClickTrackingUrl . $sQueryString, $sAdm);

        $oBid->set('adm', $sAdm);
        $oBid->set('w', $nW);
        $oBid->set('h', $nH);

        $oExt = new \openrtb\BidResponse\Ext();

        $oExt->set('clickurl', $this->sClickTrackingUrl . $sQueryString);
        $oBid->set('ext', $oExt);

        return $oBid;

    }
    protected function _video_ad_req($oImp) {

        // BidResponse 객체 생성
        $oBid = $this->_get_common_bid($oImp);

        $sAdm = $this->_get_adm("video", 640, 360);
        // 쌤플 Adm 트래킹추가
        $sQueryString = http_build_query(['bid_id'=> $oImp->get('id'), 'size_cd'=> 'video']);
        $sAdm = str_replace('[$IMP_TRACKING]', $this->sImpTrackingUrl . $sQueryString, $sAdm);
        $sAdm = str_replace('[$CLICK_TRACKING]', $this->sClickTrackingUrl . $sQueryString, $sAdm);

        if(empty($sAdm)) {
            $this->errorMessage("Empty Vast ADM");
        }
        $oBid->set('adm', $sAdm);

        $oExt = new \openrtb\BidResponse\Ext();
        $oExt->set('bidtype', 0);
        $oBid->set('ext', $oExt);

        return $oBid;
    }
    protected function _native_ad_req($oImp) {

        $oBid = $this->_get_common_bid($oImp);

        $sNativeAdm = $oImp->get('native')->get('request');

        $sAdm = $this->_get_native_adm($oImp->get('id'), $sNativeAdm);
        $oBid->set('adm', $sAdm);

        return $oBid;
    }

    protected function _get_common_bid($oImp) {

        $oBid = new \openrtb\BidResponse\Bid();

        $sBidId = uniqid();

        $oBid->set('id', $sBidId);
        $oBid->set('impid', $oImp->get('id'));

        $nPrice = ($oImp->get('bidfloor') > 0) ? $oImp->get('bidfloor') : (mt_rand(1, 10000)/10000);
        $oBid->set('price', $nPrice);

        $oBid->set('nurl', 'http://example-dsp.com/win-notice-url&price=${AUCTION_PRICE}');
        $oBid->set('cid', 'campaign111');     // 캠페인 ID
        $oBid->set('crid', 'creative112');    // 광소소재 ID
        $oBid->set('adomain', [$this->sAdDomainUrl]);

        /* 안쓰는 설정
        $oBid->set('bundle', 0);
        $oBid->set('cat', 0);
        $oBid->set('attr', 0);
        $oBid->set('dealid', '');
        $oBid->set('adid', ''); // 낙찰된 광고Id ex) a1a4b777-b6f5-45f6-9baf-a6fac07cef15
        $oBid->set('iurl', '');
        */
        return $oBid;
    }

    // NativeRequest객체에 따른 NativeResponse객체 반환
    protected function _get_native_adm($sImpId='', $sReq='') {
        $oNativeRequest = new \openrtb\NativeAdRequest\NativeAdRequest();
        $oNativeRequest->hydrate($sReq);

        $oNativeRequest = $oNativeRequest->get('native') ?? $oNativeRequest;

        // Native 응답객체 선언 생성
        $oNative = new \openrtb\NativeAdResponse\Native();

        // Ver
        $oNative->set('ver', $oNativeRequest->get('ver'));

        // Assets
        $aAssets = $oNativeRequest->get('assets');

        $aAssetsResponse = [];
        foreach($aAssets as $asset) {
            $oAsset = new \openrtb\NativeAdResponse\Assets();
            $oAsset->set('id', $asset->get('id'));

            $bRequired = $asset->get('required')??0;
            $oAsset->set('required', $bRequired);

            $bValid = true;

            switch (true) {
                case $asset->get('title') :

                    $oReqTitle = $asset->get('title');

                    $sText = "AdmixerNasmedia";

                    $bValid = ($sText <= strlen($oReqTitle->get('len')));

                    $oTitle = new \openrtb\NativeAdResponse\Title();
                    $oTitle->set('text', $sText);
                    $oAsset->set('title', $oTitle);
                    break;

                case $asset->get('img') :

                    $oReqImg = $asset->get('img');

                    $oImg = new \openrtb\NativeAdResponse\Image();

                    $sImgType = ($oReqImg->get('type') == 3) ? 'banner' : 'icon'; // 1: Icon, 3: Main
                    // 배너 사이즈가 바로 있을때
                    if ($oReqImg->get('w') && $oReqImg->get('h')) {
                        $nW = $oReqImg->get('w');
                        $nH = $oReqImg->get('h');

                    } else if ($oReqImg->get('wmin') && $oReqImg->get('hmin')) {
                        $aImgSize = $this->_search_image_size($sImgType, $oReqImg->get('wmin'), $oReqImg->get('hmin'));
                        $nW = $aImgSize[0] ?? 0;
                        $nH = $aImgSize[1] ?? 0;
                    } else {
                        $this->errorMessage('Native Img Size Is Not Exist');
                    }

                    $bValid = $this->_validation_size($sImgType, $nW, $nH);

                    $oImg->set('url', $this->_get_ad_url($sImgType, $nW, $nH));
                    $oAsset->set('img', $oImg);
                    break;

                case $asset->get('video') :
                    $oReqVideo = $asset->get('video');

                    $oVideo = new \openrtb\NativeAdResponse\Video();
                    $oVideo->set('vasttag', $oVideo->getVastTag());
                    $oAsset->set('video', $oVideo);
                    break;

                case $asset->get('data') :

                    $oReqData = $asset->get('data');

                    $oData = new \openrtb\NativeAdResponse\Data();
                    $oData->set('label', $oData->get_type_label($oReqData->get('type')));
                    $oData->set('value', "Data Field_{$oReqData->get('type')}");
                    $oAsset->set('data', $oData);

                    break;

                default :
                    break;
            }

            if(!$bValid && !$bRequired) continue;
            if(!$bValid) {
                $this->errorMessage('Native Asset Invalid');
            }

            $aAssetsResponse[] = $oAsset;
        }

        $oNative->set('assets', $aAssetsResponse);

        // Link
        $oLink = new \openrtb\NativeAdResponse\Link();      // Asset객체 내부에 있거나 Bid객체 내부에 있거나
        $oLink->set('url', $this->sRedirectUrl);            // Partner 사이트로 이동
        $oLink->set('clicktrackers', [$this->sClickTrackingUrl . http_build_query(['bid_id'=> $sImpId, 'size_cd'=> 'native'])]);
        $oNative->set('link', $oLink);

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
            $oNative->set('eventtrackers', $aEventTrackersResponse);
        } else {

            $oNative->set('imptrackers', [$this->sImpTrackingUrl . http_build_query(['bid_id'=> $sImpId, 'size_cd'=> 'native'])]);
            $oNative->set('jstrackers', '');
        }

        /*
                $oNative->set('assetsurl', '');
                $oNative->set('dcourl', '');
                $oNative->set('privacy', '');
        */

//        var_dump($oNative); exit;

        // Native로 한번 감싸줌
        $oNativeResponse = new \openrtb\NativeAdResponse\NativeAdResponse();
        $oNativeResponse->set('native', $oNative);

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

        return $this->sAdImgUrl . "/{$type}_{$width}x{$height}.png";
    }

    // 정의해놓은 admarkup 불러오기
    protected function _get_adm($type, $width=0, $height=0) {
        $nAdformatId= ($type == "banner") ? 1 : (($type == "video") ? 2 : 3);

        $this->db   = $this->load->database('admixer', TRUE);    // 리포트는 SlaveDb를 바라보도록

        $sQuery     = "SELECT * FROM admixer_dsp.adm_sample WHERE 1 AND adformat_id = ? AND width = ? AND height = ?";
        $aResult    = $this->db->query($sQuery, [$nAdformatId, $width, $height])->row_array();

        return preg_replace('/\r\n|\r|\n/','', $aResult['adm']);
    }


    // Error 메시지 출력
    protected function errorMessage($message = "") {
        @$this->_logging_ad_req("", $message);
        if(!$this->bTest) $this->_no_bid_return();

        throw new \openrtb\Exceptions\ValidationException($message);
    }

    // Return HTTP 204 No Content 반환
    protected function _no_bid_return() {
        header("HTTP/1.0 204 No Content");
        exit;
    }

    // 요청응답 테스트하기 위한 Logging
    protected function _logging_ad_req($sContent = "", $sMsg = "") {
        $this->db   = $this->load->database('admixer', TRUE);    // 리포트는 SlaveDb를 바라보도록

        if(empty($this->nLogId)) {
            $sQuery = "INSERT INTO admixer_dsp.dsp_rtb_log (ad_req_data, req_date, remote_addr) VALUES(? ,NOW(), '{$_SERVER['REMOTE_ADDR']}')";
            $this->db->query($sQuery, array($sContent));
            return $this->db->insert_id();
        } else {
            if(!empty($sContent)) {
                $sQuery = "UPDATE admixer_dsp.dsp_rtb_log SET ad_res_data = ?, result_msg = ? WHERE log_id = ?";
                $this->db->query($sQuery, array($sContent, 'Success', $this->nLogId));
            } else {
                $sQuery = "UPDATE admixer_dsp.dsp_rtb_log SET result_msg = ? WHERE log_id = ?";
                $this->db->query($sQuery, array($sMsg, $this->nLogId));
            }
            return 1;

        }

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