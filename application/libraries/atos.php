<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
 
class Atos {
    function atos()
    {
        $CI = & get_instance();
        include_once APPPATH.'third_party/PHP_WLIPG/WL/AWLMEAPI.php';
    }
    function load($mid=NULL,$OrderId=NULL,$amount=NULL,$meTransReqType=NULL,$enckey=NULL,$currencyName=NULL,$responseUrl=NULL,$atosUrl=''){
        if($mid == NULL){
            exit("Parameter(s) missing");
        }else{
            $obj = new AWLMEAPI();
            //create an object of Request Message
            $reqMsgDTO = new ReqMsgDTO();
            // PG MID
            $reqMsgDTO->setMid($mid);
            // Merchant Unique order id
            $reqMsgDTO->setOrderId($OrderId);
            //Transaction amount in paisa format
            $reqMsgDTO->setTrnAmt($amount);
            //Transaction remarks
            $reqMsgDTO->setTrnRemarks("This txn has to be done ");
            // Merchant transaction type (S/P/R)
            $reqMsgDTO->setMeTransReqType($meTransReqType);
            // Merchant encryption key
            $reqMsgDTO->setEnckey($enckey);
            // Merchant transaction currency
            $reqMsgDTO->setTrnCurrency($currencyName);
            $reqMsgDTO->setResponseUrl($responseUrl);
            $merchantRequest = "";
            $reqMsgDTO = $obj->generateTrnReqMsg($reqMsgDTO);
            if ($reqMsgDTO->getStatusDesc() == "Success"){
                $merchantRequest = $reqMsgDTO->getReqMsg();
            }
            echo '<form action="'.$atosUrl.'" method="post" name="txnSubmitFrm">
            <h4 align="center">Redirecting To Payment Please Wait..</h4>
            <h4 align="center">Please Do Not Press Back Button OR Refresh Page</h4>
            <input type="hidden" size="200" name="merchantRequest" id="merchantRequest" value="'. $merchantRequest.'"  />
            <input type="hidden" name="MID" id="MID" value="'.$reqMsgDTO->getMid().'"/>
            </form>
            <script  type="text/javascript">
                //submit the form to the worldline
                document.txnSubmitFrm.submit();
            </script>';  
        }
    }
    function atos_response($merchantResponse=NULL){
        $obj = new AWLMEAPI();
        $resMsgDTO = new ResMsgDTO();
        $reqMsgDTO = new ReqMsgDTO();
        $enc_key = "6375b97b954b37f956966977e5753ee6";
        $responseMerchant = $merchantResponse;
        return $obj->parseTrnResMsg( $responseMerchant , $enc_key );
    }
}