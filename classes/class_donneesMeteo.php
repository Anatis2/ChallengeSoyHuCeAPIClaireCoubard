<?php

class DonneesMeteo {
    
    private $_idRequete;
    private $_dateRequete;
    private $_valeurTemperature;
    private $_valeurPression;
    private $_valeurHumidite;
    private $_valeurVent;
    private $_valeurNuages;
    
    // --------------------------------------------------- GETTERS ---------------------------------------------------------
    
    public function idRequete() {
      return $this->_idRequete;
    }
    public function dateRequete() {
      return $this->_dateRequete;
    }
    public function valeurTemperature() {
      return $this->_valeurTemperature;
    }
    public function valeurPression() {
      return $this->_valeurPression;
    }
    public function valeurHumidite() {
      return $this->_valeurHumidite;
    }
    public function valeurVent() {
      return $this->_valeurVent;
    }
    public function valeurNuages() {
      return $this->_valeurNuages;
    }
    
    // --------------------------------------------------- SETTERS ---------------------------------------------------------
    
    public function setIdRequete($idRequete) {
        $this->_idRequete = $idRequete;
    }
    
    public function setDateRequete($dateRequete) {
        $this->_dateRequete = $dateRequete;
    }
    
    public function setValeurTemperature($valeurTemperature) {
        $this->_valeurTemperature = $valeurTemperature;
    }
    
    public function setValeurPression($valeurPression) {
        $this->_valeurPression = $valeurPression;
    }
    
    public function setValeurHumidite($valeurHumidite) {
        $this->_valeurHumidite = $valeurHumidite;
    }
    
    public function setValeurVent($valeurVent) {
        $this->_valeurVent = $valeurVent;
    }
    
    public function setValeurNuages($valeurNuages) {
        $this->_valeurNuages = $valeurNuages;
    }
      
    // ----------------------------------------------------- CONSTRUCTEUR ----------------------------------------------------

    public function __construct($idRequete, $dateRequete, $valeurTemperature, $valeurPression, $valeurHumidite, $valeurVent, $valeurNuages) {
        $this->setIdRequete($idRequete);
        $this->setDateRequete($dateRequete);
        $this->setValeurTemperature($valeurTemperature);
        $this->setValeurPression($valeurPression);
        $this->setValeurHumidite($valeurHumidite);
        $this->setValeurVent($valeurVent);
        $this->setValeurNuages($valeurNuages);

    }

    
}

