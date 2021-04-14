<?php

namespace App\Model;
use App\Entity\Moto;

class Driver{

    public function getMotos(){
        $moto1 = new Moto();
        $moto1->setId(001);
        $moto1->setMarque("Royal Enfield");
        $moto1->setModele("classic");
        $moto1->setPays("Inde");

        $moto2 = new Moto();
        $moto2->setId(002);
        $moto2->setMarque("Triumph");
        $moto2->setModele("bonneville");
        $moto2->setPays("UK");

        $moto3 = new Moto();
        $moto3->setId(003);
        $moto3->setMarque("Honda");
        $moto3->setModele("cb750Four");
        $moto3->setPays("Japon");

        $moto4 = new Moto();
        $moto4->setId(004);
        $moto4->setMarque("Yamaha");
        $moto4->setModele("sr400");
        $moto4->setPays("Japon");

        $tab_motos = [$moto1,$moto2,$moto3,$moto4];

        return $tab_motos;
    }
}