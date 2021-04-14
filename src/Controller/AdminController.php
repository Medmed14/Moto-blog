<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
// on appelle le Model et l'entité

use App\Entity\Bike;


use App\Repository\BikeRepository;

class AdminController extends AbstractController{

    

    

    /**
     * @Route("/list",name="app_list")
     */
    public function getBikes(){
        $repo = $this->getDoctrine()->getRepository(Bike::class);
        $moto = $repo->findAll();
        // dd($motos); //dd() methode pour dumper (copier la data brute)
        return $this->render("admin/list.html.twig", ["tabMotos"=>$moto]);
    }

     /**
     * @Route("/edit/{id}", name="app_edit")
     */                                         
    public function editBikes(Bike $moto, Request $request){ //methode 3
        // // $moto = $this->getDoctrine()->getRepository(Bike::class)->find($id); //methode 1
        // $moto = $bikeRepo->find($id); //deuxieme methode
        // dd($moto); // equivalent du var_dump, nous retourne le contenu de l'element selectionné
        // methode de gestion de formulaires avec Request
        $form = $this->createFormBuilder($moto)
        ->add('marque')
        ->add('modele')
        ->add('pays')
        ->add('prix')
        ->add('description')
        ->getForm();

        // dd($moto); test de contenu

        return $this->render('admin/edit.html.twig', [
            'form_bike'=>$form->createView()
        ]);

    }


     /*
      3eme methode
     */
    // public function editBike() BikeRepository, $bikeRepo){ // methode 2
    //     dd($moto);
    //     return;

    // }

     /**
     * @Route("/delete/{id}", name="app_delete")
     */
    public function deleteBikes($id){
        $em = $this->getDoctrine()->getManager();
        $moto = $em->getRepository(Bike::class)->find($id);
        if(!$moto){ // si la moto n'exite pas
            throw $this->createNotFoundException(
                'Acune moto ne correspond a votre demande'
            );
        }
        $em->remove($moto); //methode remove pour supprimer
        $em->flush();

        return $this->redirectToRoute("app_list");

    }
}