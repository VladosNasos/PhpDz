<?php

class ApiMicroBg {

    protected $SecretKey = '';
    protected $ApiId = '';
    protected $ConnectUrl = '';
    protected $Errors = array();
    protected $ResponseEncoded = '';
    protected $jsonDecoded;
    protected $Response;

    public function __construct() {
        $this->Response = new stdClass();
        $this->Response->status = false;
        $this->Response->errors = array();
        $this->Response->data = NULL;
    }

    public function setApiId($ApiId){
        $this->ApiId = $ApiId;
    }
    public function setSecretKey($SecretKey){
        $this->SecretKey = $SecretKey;
    }
    public function setEntryPoint($Url){
        $this->ConnectUrl = $Url;
    }

    function request($functionName, $parameters = array(), $data=NULL){
        $r = new stdClass();
        $r->functionName = $functionName;
        $r->parameters = $parameters;
        $r->functionData = $data;
        $encoded = urlencode(base64_encode(json_encode($r)));
        $hash = hash_hmac('sha256', $encoded, $this->SecretKey);
        $PostFields = json_encode(array('ApiId' => $this->ApiId, 'Request' => $encoded . $hash));

        echo "Debug Info:\n";
        echo "Function Name: $functionName\n";
        echo "Parameters: " . json_encode($parameters) . "\n";
        echo "Data: " . json_encode($data) . "\n";
        echo "Encoded: $encoded\n";
        echo "Hash: $hash\n";
        echo "Post Fields: $PostFields\n";

        $ch = curl_init();
        $headers = array('Content-Type: text/html');
        curl_setopt($ch, CURLOPT_URL, $this->ConnectUrl);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $PostFields);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLINFO_HEADER_OUT, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $this->ResponseEncoded = curl_exec($ch);

        if (curl_error($ch)) {
            $this->Response->errors[] = curl_error($ch);
        } else {
            $this->Response->status = true;
        }

        $requestHeaders = curl_getinfo($ch, CURLINFO_HEADER_OUT);
        echo "Request Headers:\n" . $requestHeaders . "\n";

        curl_close($ch);

        echo "Response Encoded: $this->ResponseEncoded\n";

        if ($this->Response->status && !empty($this->ResponseEncoded)) {
            $this->Response = json_decode($this->ResponseEncoded);
        } else {
            $this->Response->status = false;
            $this->Response->errors[] = "Invalid response or empty response";
        }
        return $this->Response;
    }

    public function getPaymentTypes(){
        $response = $this->request('getPaymentTypes');
        if ($response && isset($response->status) && $response->status) {
            return $response->data;
        } else {
            return $response->errors;
        }
    }
}

// Example usage:
$api = new ApiMicroBg();
$api->setApiId('8953201720163459');
$api->setSecretKey('89032cfa9b45d9af44921b59b36e1c5ab66112d8bac69dac498534965509aea066d3f8db');
$api->setEntryPoint('https://micro.bg/ExtApps/ExternalApp/API/');
$paymentTypes = $api->getPaymentTypes();
print_r($paymentTypes);
