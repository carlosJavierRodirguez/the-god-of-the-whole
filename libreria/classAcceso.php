<?php
class Acceso
{
    private $email;
    private $clave;

    public function setEmail($email)
    {
        $this->email = $email;
    }
    public function getEmail()
    {
        return $this->email;
    }

    public function setClave($clave)
    {
        $this->clave = $clave;
    }
    public function getClave()
    {
        return $this->clave;
    }
}
