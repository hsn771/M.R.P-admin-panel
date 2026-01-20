<?php

namespace App\Classes;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Env;

class sslSms {
    private $api_token;
    
    private $domain;
    
    public function __construct()
    {
        $this->api_token = config('services.ssl.api_token', env('SSL_API_TOKEN', 'Muktodhara-146494ef-3fc0-4c09-98bc-b0a764b4b921'));
        $this->domain = config('services.ssl.domain', env('SSL_DOMAIN', 'https://smsplus.sslwireless.com'));
    }
    
    /**
     * @param $msisdn
     * @param $messageBody
     * @param $csmsId (Unique)
     */
    public function singleSms($msisdn, $messageBody, $csmsId, $sid = null){
        $sid = $sid ?? config('services.ssl.sid', env('SSL_SID', 'CKCLBDNONMASK')); 
        $params = [
            "api_token" => $this->api_token,
            "sid" => $sid,
            "msisdn" => $msisdn,
            "sms" => $messageBody,
            "csms_id" => $csmsId
        ];
        $url = trim($this->domain, '/')."/api/v3/send-sms";
        $params = json_encode($params);
    
        return $this->callApi($url, $params);
    }
    
    /**
     * @param $msisdns
     * @param $messageBody
     * @param $batchCsmsId
     */
    public function bulkSms($msisdns, $messageBody, $batchCsmsId, $sid = null){
        $sid = $sid ?? config('services.ssl.sid', env('SSL_SID', 'CKCLBDNONMASK'));
        $params = [
            "api_token" => $this->api_token,
            "sid" => $sid,
            "msisdn" => $msisdns,
            "sms" => $messageBody,
            "batch_csms_id" => $batchCsmsId
        ];
        $url = trim($this->domain, '/')."/api/v3/send-sms/bulk";
        $params = json_encode($params);
    
        return $this->callApi($url, $params);
    }
    
    /**
     * @param $messageData
     */
    public function dynamicSms($messageData, $sid = null){
        $sid = $sid ?? config('services.ssl.sid', env('SSL_SID', 'CKCLBDNONMASK'));
        $params = [
            "api_token" => $this->api_token,
            "sid" => $sid,
            "sms" => $messageData,
        ];
        $params = json_encode($params);
        $url = trim($this->domain, '/')."/api/v3/send-sms/dynamic";
        return $this->callApi($url, $params);
    }
    
    
    public function callApi($url, $params){
        $ch = curl_init(); // Initialize cURL
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($params),
            'accept:application/json'
        ));
    
        $response = curl_exec($ch);
    
        curl_close($ch);
        //Log::info($response);
        return json_decode($response);
    }
}

