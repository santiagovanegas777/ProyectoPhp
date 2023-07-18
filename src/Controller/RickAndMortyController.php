<?php

namespace App\Controller;

use App\Entity\Episode;
use App\Entity\Character;
use App\Form\CharacterType;
use App\Manager\CharacterManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class RickAndMortyController extends AbstractController{

    #[Route("/rickandmorty/{id}", name:"getRickAndMorty")]

    public function getRickAndMorty(EntityManagerInterface $doctrine, $id) {

        $repository = $doctrine->getRepository(Character::class);
        $character = $repository->find($id);

       

        return $this->render("Characters/characters.html.twig",["character"=>$character]);
    }
    #[Route("/rickandmortylist", name:'listCharacters')]
    public function listCharacters(EntityManagerInterface $doctrineS){
        $repository = $doctrineS->getRepository(Character::class);
        $characters = $repository->findAll();


        
        return $this->render("Characters/listcharacters.html.twig",["characters"=>$characters]);

    }
    
    #[Route("/insert/character", name:"insertCharacter")]

    public function insertCharacter(EntityManagerInterface $doctrine, Request $request, CharacterManager $manager) {

       $form=$this-> createForm(CharacterType::class);
       $form->handleRequest($request);

       if($form->isSubmitted()and $form->isValid()){
        $character=$form->getData();
        $characterImage = $form->get('characterImage')->getData();
        
            if($characterImage){

                $imageUrl = $manager->uploadImage($characterImage , $this->getParameter('kernel.project_dir').'/public/images');
               

                $character->setImage("$imageUrl");
    
            }
        $doctrine->persist($character);
        $doctrine->flush();
        return $this->redirectToRoute('listCharacters');


       }

       return $this->render('Characters/insertCharacter.html.twig', ['characterForm'=>$form]);
    
} 

    
    #[Route("edit/character/{id}", name:"editCharacter")]

    public function editCharacter(EntityManagerInterface $doctrine, Request $request, $id) {


        $repository = $doctrine->getRepository(Character::class);
        $character =$repository->find($id);

       $form=$this->createForm(CharacterType::class, $character);
       $form->handleRequest($request);
       
        if($form->isSubmitted() and $form->isValid()){
            $character = $form->getData();
            $doctrine->persist($character);
            $doctrine->flush();
            return $this->redirectToRoute('listCharacters');

        }

     
       return $this->render('Characters/insertCharacter.html.twig', ['characterForm'=>$form]);
    }

    


    #[Route("new/character")]
    public function newCharacter(EntityManagerInterface $doctrineS) {
        $character1 =  new Character ();
        $character1->setName("Rick");
        $character1->setSpecies("Alien");
        $character1->setImage("https://rickandmortyapi.com/api/character/avatar/14.jpeg");
        $character1->setGender("Male");

        $character2 =  new Character ();
        $character2->setName("Million Ants");
        $character2->setSpecies("Animal");
        $character2->setImage("https://rickandmortyapi.com/api/character/avatar/226.jpeg");
        $character2->setGender("Male");

        $character3 =  new Character ();
        $character3->setName("Ricktiminus Sancheziminius");
        $character3->setSpecies("Human");
        $character3->setImage("https://rickandmortyapi.com/api/character/avatar/294.jpeg");
        $character3->setGender("Male");


        $episode1 = new Episode();
        $episode1->setEpisode( episode:"https://rickandmortyapi.com/api/episode/13");
        $episode2 = new Episode();
        $episode2->setEpisode( episode:"https://rickandmortyapi.com/api/episode/19");

        $episode3 = new Episode();
        $episode3->setEpisode( episode:"https://rickandmortyapi.com/api/episode/14");

        $episode4 = new Episode();
        $episode4->setEpisode( episode:"https://rickandmortyapi.com/api/episode/16");


        $character3->addEpisode($episode1);
        $character3->addEpisode($episode2);
        $character1->addEpisode($episode3);


        $doctrineS->persist($character1);
        $doctrineS->persist($character2);
        $doctrineS->persist($character3);
        $doctrineS->persist($episode1);
        $doctrineS->persist($episode2);
        $doctrineS->persist($episode3);
        $doctrineS->persist($episode4);

        $doctrineS->flush();
        return new Response("characters insertados correctamente");

    



        // return new Response("Estoy en la home")
    }
}