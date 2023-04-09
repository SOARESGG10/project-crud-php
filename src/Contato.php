<?php

class Contato 
{
    private $id = null;
    private $name;
    private $email;
    private $phone;

    public function __construct($name, $email, $phone)
    {
        $this->name = $name;
        $this->email = $email;
        $this->phone = $phone;
    }

    public function setId ($id) {
        $this->id = $id;
    }

    public function getId () {
        return $this->id;
    }

    public function setName ($name) {
        $this->name = $name;
    }

    public function getName () {
        return $this->name;
    }

    public function setEmail ($email) {
        $this->email = $email;
    }

    public function getEmail () {
        return $this->email;
    }

    public function getPhone () {
        return $this->phone;
    }

    public function setPhone ($phone) {
        $this->phone = $phone;
    }
}