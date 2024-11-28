<?php
class Acceso
{
    private $email;
    private $clave;
    private $codigo;
    private $nombre;

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

    public function setCodigoSala($codigo)
    {
        $this->codigo = $codigo;
    }

    public function getCodigoSala()
    {
        return $this->codigo;
    }

    public function setClaveConfirmada($clave)
    {
        $this->clave = $clave;
    }

    public function getClaveConfirmada()
    {
        return $this->clave;
    }

    public function setNombre($nombre){
        $this->nombre = $nombre;
    }

    public function getNombre(){
        return $this->nombre;
    }
}
