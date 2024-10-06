<?php
class Sala
{
    private $codigoSala;
    private $nombreSala;


    public function setCodigoSala($codigoSala)
    {
        $this->codigoSala = $codigoSala;
    }

    public function getCodigoSala()
    {
        return $this->codigoSala;
    }


    public function setNombreSala($nombreSala)
    {
        $this->nombreSala = $nombreSala;
    }

    public function getNombreSala()
    {
        return $this->nombreSala;
    }
}
