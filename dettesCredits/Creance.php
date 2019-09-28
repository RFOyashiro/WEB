<?php
/**
 * Created by PhpStorm.
 * User: Links
 * Date: 01/12/2016
 * Time: 21:53
 */

require_once "bd-proc.php";

class Creance {
    private $nomEndette;
    private $nomCreancier;
    private $montant;

    function __construct($ende, $crea, $mont) {
        $this->nomEndette = $ende;
        $this->nomCreancier = $crea;
        $this->montant = $mont;
    }

    public function enregistrement(){
        addCreance($this->nomEndette, $this->nomCreancier, $this->montant);
    }
}