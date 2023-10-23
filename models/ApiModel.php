<?php

class ApiModel {
    private $url;
    
    public function __construct($url) {
        $this->url = $url;
    }
    
    public function requestAPI($data, $endpoint) {
        try {
            $url = '';

            switch ($endpoint) {
                case 'payments':
                    $url = \Environment::getPaymentsCustomUrl();
                    break;
                case 'reports':
                    $url = \Environment::getReportsCustomUrl();
                    break;
                case 'subscriptions':
                    $url = \Environment::getSubscriptionsCustomUrl();
                    break;
                // Agrega otros casos según sea necesario
            }
        
            $payload = json_encode($data);

            //iniciamos la peticion
            $ch = curl_init($url);
            
            //attach encoded JSON string to the POST fields
            curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);

            //set the content type to application/json
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json', 'Accept:application/json'));
    
            //return response instead of outputting
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    
            //execute the POST request
            $result = curl_exec($ch);
            if ($result === false) {
                throw new Exception(curl_error($ch));
            }            
            return $result;

        } catch (Exception $e) {
            // Manejar la excepción aquí
            return "Error: " . $e->getMessage();
        }
    }
}
?>