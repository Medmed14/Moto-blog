<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
// on appelle le Model et l'entité


use App\Model\Driver;



class BikeController extends AbstractController{

    /**
     * @Route("/accueil", name="app_accueil")
     */
    public function accueil(): Response
    {   
        // $motos = [
        //     ["id"=>001, "marque"=>"Royal Enfield", "modele"=>"classic", "pays"=>"Inde"],
        //     ["id"=>002, "marque"=>"Triumph", "modele"=>"bonneville", "pays"=>"UK"],
        //     ["id"=>003, "marque"=>"Honda", "modele"=>"cb750Four", "pays"=>"Japon"],
        //     ["id"=>004, "marque"=>"Yamaha", "modele"=>"sr400", "pays"=>"Japon"]

        // ];

        $driver = new Driver();
        $motos = $driver->getMotos();

        return $this->render('home/accueil.html.twig',["tabMotos"=>$motos]);
    }

    /**
     * @Route("/contact", name="app_contact")
     */
    public function contact(): Response
    {
        $img = "panigale2.jpg";
        return $this->render('home/contact.html.twig',['moto'=>$img]);
    }

    /**
     * @Route("/add", name="app_add")
     */
    // public function add(){

    //     $em = $this->getDoctrine()->getManager(); // on recupere doctrine puis getManager qui permet d'ajouter l'objet a doctrine et doctrine va ensuite l'insérer dans la bdd
        
    //     $bike1 = new Bike();
    //     $bike1->setMarque("Royal Enfield");
    //     $bike1->setModele("Classic 500");
    //     $bike1->setPays("Inde");
    //     $bike1->setPrix(4000);
    //     $bike1->setDescription("Royal Enfield est la moto la plus connue en Inde.");

    //     $bike2 = new Bike();
    //     $bike2->setMarque("Yamaha");
    //     $bike2->setModele("sr400");
    //     $bike2->setPays("Japon");
    //     $bike2->setPrix(3000);
    //     $bike2->setDescription("Yamaha sr400 est un roadster mid size, monocylindre, mondialement connu.");

    //     $bike3 = new Bike();
    //     $bike3->setMarque("Triumph");
    //     $bike3->setModele("bonneville");
    //     $bike3->setPays("Angleterre");
    //     $bike3->setPrix(8000);
    //     $bike3->setDescription("Moto anglaise mythique.");

    //     $em->persist($bike1);
    //     $em->persist($bike2);
    //     $em->persist($bike3);

    //     $em->flush();

    //     return new Response("Motos ajoutées!");

    // }

    /**
     * @Route("/list",name="app_list")
     */
    // public function getBikes(){
    //     $repo = $this->getDoctrine()->getRepository(Bike::class);
    //     $moto = $repo->findAll();
    //     // dd($motos); //dd() methode pour dumper (copier la data brute)
    //     return $this->render("home/list.html.twig", ["tabMotos"=>$moto]);
    // }

     /**
     * @Route("/edit/{id}", name="app_edit")
     */
 


     /*
      3eme methode
     */
    // public function editBike(Bike, $moto){
    //     dd($moto);
    //     return;

    // }

     /**
     * @Route("/delete/{id}", name="app_delete")
     */
   
}