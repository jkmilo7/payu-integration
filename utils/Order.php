<?php

class Order {
    private $payu_order_id;
    private $transaction_id;
    private $reference;
    private $description;
    private $value;
    private $user_id;

    public function __construct($data) {
        $this->payu_order_id = $data['payu_order_id'];
        $this->transaction_id = $data['transaction_id'];
        $this->reference = $data['reference'];
        $this->description = $data['description'];
        $this->value = $data['value'];
        $this->user_id = $data['user_id'];
    }

    // Métodos para obtener información de la orden si es necesario
    public function getPayuOrderId() {
        return $this->payu_order_id;
    }

    public function getTransactionId() {
        return $this->transaction_id;
    }

    public function getReference() {
        return $this->reference;
    }

    public function getDescription() {
        return $this->description;
    }

    public function getValue() {
        return $this->value;
    }

    public function getUserId() {
        return $this->user_id;
    }

    public function setPayuOrderId($payu_order_id) {
        $this->payu_order_id = $payu_order_id;
    }

    public function setTransactionId($transaction_id) {
        $this->transaction_id = $transaction_id;
    }

}

?>