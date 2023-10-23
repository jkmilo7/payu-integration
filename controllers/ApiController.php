<?php
require_once __DIR__ . '/../models/ApiModel.php';
require_once __DIR__ . '/../utils/Environment.php';
require_once __DIR__ . '/../utils/Order.php';
require_once __DIR__ . '/../utils/User.php';

class ApiController {
    private $apiModel;
    private $apiLogin;
    private $apiKey;
    private $accountId;
    private $merchantId;
    private $country;
    private $language;
    private $test;
    private $currency;

    public function __construct(ApiModel $apiModel, $apiLogin, $apiKey, $accountId, $merchantId, $country, $language, $test, $currency) {
        $this->apiModel = $apiModel;
        $this->apiLogin = $apiLogin;
        $this->apiKey = $apiKey;
        $this->accountId = $accountId;
        $this->merchantId = $merchantId;
        $this->country = $country;
        $this->language = $language;
        $this->test = $test;
        $this->currency = $currency;        
    }

    public function setEnvironment($environment) {
        if ($environment == 'development') {
            Environment::setPaymentsCustomUrl("https://sandbox.api.payulatam.com/payments-api/4.0/service.cgi");
            Environment::setReportsCustomUrl("https://sandbox.api.payulatam.com/reports-api/4.0/service.cgi");
            Environment::setSubscriptionsCustomUrl("https://sandbox.api.payulatam.com/payments-api/rest/v4.3/");
        } else {
            Environment::setPaymentsCustomUrl("https://api.payulatam.com/payments-api/4.0/service.cgi");
            Environment::setReportsCustomUrl("https://api.payulatam.com/reports-api/4.0/service.cgi");
            Environment::setSubscriptionsCustomUrl("https://api.payulatam.com/payments-api/rest/v4.3/");
        }
    }

    public function pingAPI() {
        try {
            $data = array(
                'test' => $this->test,
                'language' => $this->language,
                'command' => 'PING',
                'merchant' => array(
                    'apiLogin' => $this->apiLogin,
                    'apiKey' => $this->apiKey
                )
            );

            $result = $this->apiModel->requestAPI($data, 'reports'); // Usa 'reports' para pingAPI
        
            return $result;

        } catch (Exception $e) {
            // Manejar la excepción aquí
            return "Error: " . $e->getMessage();
        }
    }

    public function getBankListAPI($paymentMethod, $paymentCountry) {
        try{
            $data = array(
                'test' => $this->test,
                'language' => $this->language,
                'command' => 'GET_BANKS_LIST',
                'merchant' => array(
                    'apiLogin' => $this->apiLogin,
                    'apiKey' => $this->apiKey
                ),            
                'bankListInformation'=> array(
                    'paymentMethod' => $paymentMethod,
                    'paymentCountry' => $paymentCountry
                )
            );
            
            $result = $this->apiModel->requestAPI($data, 'payments'); // Usa 'payments' para getBankListAPI
        
            return $result;
        } catch (Exception $e) {
            // Manejar la excepción aquí
            return "Error: " . $e->getMessage();
        }
    }

    public function getPaymentMethodsAPI() {
        try {
            $data = array(
                'test' => $this->test,
                'language' => $this->language,
                'command' => 'GET_PAYMENT_METHODS',
                'merchant' => array(
                    'apiLogin' => $this->apiLogin,
                    'apiKey' => $this->apiKey
                )
            );

            $result = $this->apiModel->requestAPI($data, 'payments'); // Usa 'payments' para getPaymentMethodsAPI        

            return $result;
        } catch (Exception $e) {
            // Manejar la excepción aquí
            return "Error: " . $e->getMessage();
        }
    }

    public function setCreditCardPaymentAPI($payerName, $typeDocument, $documentNumber, $creditCardNumber, $cvv, $monthExp, $yearExp, $fees, $cellPhone, $paymentMethod, $user, $order, $session, $ip, $userAgent) 
    {
        try {

            $fechaYHora = date('Y-m-d\TH:i:s.v\Z');
            $signature = md5($this->apiKey . "~" . $this->merchantId . "~" . $order->getReference() . $fechaYHora . "~" . $order->getValue() . "~" . $this->currency);
    
            $data = array(
                'language' => $this->language,
                'command' => 'SUBMIT_TRANSACTION',
                'merchant' => array(
                    'apiLogin' => $this->apiLogin,
                    'apiKey' => $this->apiKey
                ),
                'transaction' => array(
                    'order' => array(
                        'accountId'=> $this->accountId,
                        'referenceCode' => $order->getReference() . $fechaYHora,
                        'description' => $order->getDescription(),
                        'language' => $this->language,
                        'signature' => $signature,
                        //'notifyUrl' => 'http://www.payu.com/notify',
                        'additionalValues' => array(
                            'TX_VALUE' => array(
                                'value' => $order->getValue(),
                                'currency' => $this->currency
                            ),
                            // 'TX_TAX' => array(
                            //     'value' => '10378',
                            //     'currency' => $this->currency
                            // ),
                            // 'TX_TAX_RETURN_BASE' => array(
                            //     'value' => '54622',
                            //     'currency' => $this->currency
                            // )                                           
                        ),
                        'buyer' => array(
                            'merchantBuyerId' => $order->getUserId(),
                            'fullName' => $payerName,
                            'emailAddress' => $user->getEmail(),
                            'contactPhone' => $cellPhone,
                            'dniNumber' => $documentNumber,
                            'shippingAddress' => array(
                                'street1' => $user->getStreet1(),
                                'street2' => $user->getStreet2(),
                                'city' => $user->getCity(),
                                'state' => $user->getState(),
                                'country' => $country,
                                'postalCode' => $user->getPostalCode(),
                                'phone' => $cellPhone
                            )
                        )
                    ),
                    'payer' => array(
                        'merchantPayerId' => $order->getUserId(),
                        'fullName' => $payerName,
                        'emailAddress' => $user->getEmail(),
                        'contactPhone' => $cellPhone,
                        'dniNumber' => $documentNumber,
                        'billingAddress' => array(
                            'street1' => $user->getStreet1(),
                            'street2' => $user->getStreet2(),
                            'city' => $user->getCity(),
                            'state' => $user->getState(),
                            'country' => $country,
                            'postalCode' => $user->getPostalCode(),
                            'phone' => $cellPhone
                        )
                    ),
                    'creditCard' => array(
                        'number' => $creditCardNumber,
                        'securityCode' => $cvv,
                        'expirationDate' =>  $yearExp.'/'.$monthExp,
                        'name' => $payerName
                    ),
                    'extraParameters' => array(
                        'INSTALLMENTS_NUMBER' => $fees
                    ),
                    'type' => 'AUTHORIZATION_AND_CAPTURE',
                    'paymentMethod' => $paymentMethod,
                    'paymentCountry' => $country,
                    'deviceSessionId' => $session,
                    'ipAddress' => $ip,
                    'cookie' => "cookie_ed_" . time(),
                    'userAgent' => $userAgent,
                    // 'threeDomainSecure' => array(
                    //     'embedded' => false,
                    //     'eci' => '01',
                    //     'cavv' => 'AOvG5rV058/iAAWhssPUAAADFA==',
                    //     'xid' => 'Nmp3VFdWMlEwZ05pWGN3SGo4LDA=',
                    //     'directoryServerTransactionId' => '00000-70000b-5cc9-0000-000000000cb'
                    // )
                ),
                'test' => $this->test
            );
            
            $result = $this->apiModel->requestAPI($data, 'payments'); // Usa 'payments' para getPaymentMethodsAPI        

            return $result;
        } catch (Exception $e) {
            // Manejar la excepción aquí
            return "Error: " . $e->getMessage();
        }
    }

    public function setPSEPaymentAPI($bank, $payerName, $typePerson, $typeDocument, $documentNumber, $cellPhone, $user, $order, $session, $ip, $userAgent) 
    {
        try {

            $fechaYHora = date('Y-m-d\TH:i:s.v\Z');
            $signature = md5($this->apiKey . "~" . $this->merchantId . "~" . $order->getReference() . $fechaYHora . "~" . $order->getValue() . "~" . $this->currency);
        
            $data = array(
                'language' => $this->language,
                'command' => 'SUBMIT_TRANSACTION',
                'merchant' => array(
                    'apiLogin' => $this->apiLogin,
                    'apiKey' => $this->apiKey
                ),
                'transaction' => array(
                    'order' => array(
                        'accountId'=> $this->accountId,
                        'referenceCode' => $order->getReference() . $fechaYHora,
                        'description' => $order->getDescription(),
                        'language' => $this->language,
                        'signature' => $signature,
                        //'notifyUrl' => 'http://www.payu.com/notify',
                        'additionalValues' => array(
                            'TX_VALUE' => array(
                                'value' => $order->getValue(),
                                'currency' => $this->currency
                            ),
                            // 'TX_TAX' => array(
                            //     'value' => '10378',
                            //     'currency' => $this->currency
                            // ),
                            // 'TX_TAX_RETURN_BASE' => array(
                            //     'value' => '54622',
                            //     'currency' => $this->currency
                            // )                                           
                        ),
                        'buyer' => array(
                            'merchantBuyerId' => $order->getUserId(),
                            'fullName' => $payerName,
                            'emailAddress' => $user->getEmail(),
                            'contactPhone' => $cellPhone,
                            'dniNumber' => $documentNumber,
                            'shippingAddress' => array(
                                'street1' => $user->getStreet1(),
                                'street2' => $user->getStreet2(),
                                'city' => $user->getCity(),
                                'state' => $user->getState(),
                                'country' =>  $this->country,
                                'postalCode' => $user->getPostalCode(),
                                'phone' => $cellPhone
                            )
                        )
                    ),
                    'payer' => array(
                        'merchantPayerId' => $order->getUserId(),
                        'fullName' => $payerName,
                        'emailAddress' => $user->getEmail(),
                        'contactPhone' => $cellPhone,
                        'dniNumber' => $documentNumber,
                        'billingAddress' => array(
                            'street1' => $user->getStreet1(),
                            'street2' => $user->getStreet2(),
                            'city' => $user->getCity(),
                            'state' => $user->getState(),
                            'country' =>  $this->country,
                            'postalCode' => $user->getPostalCode(),
                            'phone' => $cellPhone
                        )
                    ),                    
                    'extraParameters' => array(
                        'RESPONSE_URL' => 'https://www.espacolaser.com.co/checkout',
                        'PSE_REFERENCE1' => $ip,
                        'FINANCIAL_INSTITUTION_CODE' => ( $this->test === 'true') ? '1022' : $bank,
                        'USER_TYPE' => $typePerson,
                        'PSE_REFERENCE2' => $typeDocument,
                        'PSE_REFERENCE3' => $documentNumber
                    ),
                    'type' => 'AUTHORIZATION_AND_CAPTURE',
                    'paymentMethod' => 'PSE',
                    'paymentCountry' => $this->country,
                    'deviceSessionId' => $session,
                    'ipAddress' => $ip,
                    'cookie' => "cookie_ed_" . time(),
                    'userAgent' => $userAgent                    
                ),
                'test' => $this->test
            );
            
            $result = $this->apiModel->requestAPI($data, 'payments'); // Usa 'payments' para getPaymentMethodsAPI        

            return $result;
        } catch (Exception $e) {
            // Manejar la excepción aquí
            return "Error: " . $e->getMessage();
        }
    }

    public function setCashOrBankPaymentAPI($payerName, $typeDocument, $documentNumber, $paymentMethod, $user, $order, $session, $ip, $userAgent) 
    {
        try {

            $fechaYHora = date('Y-m-d\TH:i:s.v\Z');
            $signature = md5($this->apiKey . "~" . $this->merchantId . "~" . $order->getReference() . $fechaYHora . "~" . $order->getValue() . "~" . $this->currency);
    
            $data = array(
                'language' => $this->language,
                'command' => 'SUBMIT_TRANSACTION',
                'merchant' => array(
                    'apiLogin' => $this->apiLogin,
                    'apiKey' => $this->apiKey
                ),
                'transaction' => array(
                    'order' => array(
                        'accountId'=> $this->accountId,
                        'referenceCode' => $order->getReference() . $fechaYHora,
                        'description' => $order->getDescription(),
                        'language' => $this->language,
                        'signature' => $signature,
                        'notifyUrl' => 'http://localhost:52975/',
                        'additionalValues' => array(
                            'TX_VALUE' => array(
                                'value' => $order->getValue(),
                                'currency' => $this->currency
                            ),
                            // 'TX_TAX' => array(
                            //     'value' => '10378',
                            //     'currency' => $this->currency
                            // ),
                            // 'TX_TAX_RETURN_BASE' => array(
                            //     'value' => '54622',
                            //     'currency' => $this->currency
                            // )                                           
                        ),
                        'buyer' => array(
                            'merchantBuyerId' => $order->getUserId(),
                            'fullName' => $payerName,
                            'emailAddress' => $user->getEmail(),
                            'contactPhone' => $user->getCellPhone(),
                            'dniNumber' => $documentNumber,
                            'shippingAddress' => array(
                                'street1' => $user->getStreet1(),
                                'street2' => $user->getStreet2(),
                                'city' => $user->getCity(),
                                'state' => $user->getState(),
                                'country' =>  $this->country,
                                'postalCode' => $user->getPostalCode(),
                                'phone' => $user->getCellPhone(),
                            )
                        )
                    ),
                    'payer' => array(
                        'merchantPayerId' => $order->getUserId(),
                        'fullName' => $payerName,
                        'emailAddress' => $user->getEmail(),
                        'contactPhone' => $user->getCellPhone(),
                        'dniNumber' => $documentNumber,
                        'billingAddress' => array(
                            'street1' => $user->getStreet1(),
                            'street2' => $user->getStreet2(),
                            'city' => $user->getCity(),
                            'state' => $user->getState(),
                            'country' =>  $this->country,
                            'postalCode' => $user->getPostalCode(),
                            'phone' => $user->getCellPhone(),
                        )
                    ),
                    'type' => 'AUTHORIZATION_AND_CAPTURE',
                    'paymentMethod' => $paymentMethod,
                    //'expirationDate' => date('Y-m-d\TH:i:s'),
                    'paymentCountry' => $this->country,
                    'ipAddress' => $ip
                ),
                'test' => $this->test
            );
            
            $result = $this->apiModel->requestAPI($data, 'payments'); // Usa 'payments' para getPaymentMethodsAPI        

            return $result;
        } catch (Exception $e) {
            // Manejar la excepción aquí
            return "Error: " . $e->getMessage();
        }
    }
    
}

function formatearNumeroMiles($numero) {
    return number_format($numero, 0, ',', '.');
}

?>
