<?php
switch ($_SERVER['REQUEST_URI']) {   
    case '/controllers/PaymentController.php/creditcard-payment':
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Recupera los datos del formulario
            $payerName = $_POST['payer_name'];
            $typeDocument = $_POST['type_document'];
            $documentNumber = $_POST['document_number'];
            $creditCardNumber = $_POST['credit_card_number'];
            $cvv = $_POST['cvv'];
            $monthExp = $_POST['month_exp'];
            $yearExp = $_POST['year_exp'];
            $fees = $_POST['fees'];
            $cellPhone = $_POST['cell-phone'];
            $paymentMethod = $_POST['payment_method'];

            


        }

        $response = [
            'status' => 'ok',
            'message' => $_POST['payer_name']
        ];
        echo json_encode($response);
    break;
}
?>