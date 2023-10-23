<?php

class User {
    private $name;
    private $email;
    private $identification;
    private $street1;
    private $street2;
    private $city;
    private $state;
    private $postalCode;

    public function __construct($data) {
        $this->name = $data['name'];
        $this->email = $data['email'];
        $this->identification = $data['identification'];
        $this->street1 = $data['street1'];
        $this->street2 = $data['street2'];
        $this->city = $data['city'];
        $this->state = $data['state'];
        $this->postalCode = $data['postalCode'];
        $this->cellPhone = $data['cellPhone'];
    }

    // Métodos para obtener información del usuario si es necesario
    public function getName() {
        return $this->name;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getIdentification() {
        return $this->identification;
    }

    public function getStreet1() {
        return $this->street1;
    }

    public function getStreet2() {
        return $this->street2;
    }

    public function getCity() {
        return $this->city;
    }

    public function getState() {
        return $this->state;
    }

    public function getPostalCode() {
        return $this->postalCode;
    }

    public function getCellPhone() {
        return $this->cellPhone;
    }
    
}


?>