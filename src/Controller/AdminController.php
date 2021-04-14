<?php

namespace App\Controller;

use App\Entity\Bike;
use App\Entity\Categories;
use App\Form\MotoType;

use Doctrine\ORM\EntityManager;
// on appelle le Model et l'entité

use App\Repository\BikeRepository;


use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

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
    public function editBikes(Bike $moto, Request $request, EntityManagerInterface $em){ //methode 3
        // // $moto = $this->getDoctrine()->getRepository(Bike::class)->find($id); //methode 1
        // $moto = $bikeRepo->find($id); //deuxieme methode
        // dd($moto); // equivalent du var_dump, nous retourne le contenu de l'element selectionné
        // methode de gestion de formulaires avec Request
        $form = $this->createFormBuilder($moto)
        ->add('marque')
        ->add('modele')
        ->add('pays')
        ->add('prix', NumberType::class)
        ->add('description', TextareaType::class)
        ->getForm();

        // dd($moto); test de contenu

        //$request va nous permettre de recuperer les données
        $form->handleRequest($request); //handleRequest pour recuperer ce qui est dans request (ce qui a ete soumis)
        if($form->isSubmitted() && $form->isValid()){
            // $updateMoto = $form->getData();
            // $em = $this->getDoctrine()->getManager(); //em est entity manager
            $em->flush();
            $this->addFlash('success', 'moto modifiée avec succès');
            return $this->redirectToRoute("app_list");

        }
        return $this->render('admin/edit.html.twig', [
            'form_bike'=>$form->createView(),
            'moto'=>$moto
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

        $this->addFlash('success', 'moto supprimée avec succès');
        return $this->redirectToRoute("app_list");

    }

         /**
     * @Route("/add", name="app_add")
     */
    public function add(Request $request){

        $moto = new Bike();
        $form = $this->createForm(MotoType::class, $moto);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($moto);
            $em->flush();

            $this->addFlash('success', 'moto ajoutée avec succès'); // on stock dans la session le message de succes
            return $this->redirectToRoute("app_list");
        }

        return $this->render('admin/add.html.twig', [
            'form'=> $form->createView() ]);
    }

    
    /////////////////////////////////////// categories ///////////////////////////////


    /**
     * @Route("/list_cat",name="app_list_cat")
     */
    public function getCategories(){
        $repo = $this->getDoctrine()->getRepository(Categories::class);
        $cat = $repo->findAll();
        //  dd($cat); //dd() methode pour dumper (copier la data brute)
        return $this->render("admin/list_cat.html.twig", ["tabCat"=>$cat]);
    }


 /**
     * @Route("/delete_cat/{id}",name="app_delete_cat")
     */
    public function deleteCategorie($id){
        $em = $this->getDoctrine()->getManager();
        $cat = $em->getRepository(Categories::class)->find($id);

        // if(!$cat){ // si la categorie n'exite pas
        //     throw $this->createNotFoundException(
        //         'Acune catégorie ne correspond a votre demande'
        //     );
        // }
        $em->remove($cat); //methode remove pour supprimer
        $em->flush();

        $this->addFlash('success', 'catégorie supprimée avec succès');
        return $this->redirectToRoute("app_list_cat");

    }
    
     /**
     * @Route("/add_cat", name="app_add_cat")
     */
    public function addCategorie(Request $request){

        $cat = new Categories();
        $form = $this->createForm(CategorieType::class, $cat);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($cat);
            $em->flush();

            $this->addFlash('success', 'catégorie ajoutée avec succès'); // on stock dans la session le message de succes
            return $this->redirectToRoute("app_list_cat");
        }

        return $this->render('admin/add.html.twig', [
            'form'=> $form->createView() ]);
    }

}