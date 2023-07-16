<?php

namespace App\Controller;


use App\Entity\Character;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;

use Symfony\Component\HttpFoundation\Response;

class RickAndMortyController extends AbstractController{

    #[Route("/rickandmorty")]

    public function getRickAndMorty() {

        $character =[
            "name"=>"Rick",
            "species"=>"Alien",
            "image"=>"https://rickandmortyapi.com/api/character/avatar/14.jpeg",
            "gender"=>"Male",



        ];

        return $this->render("Characters/characters.html.twig",["character"=>$character]);
    }
    #[Route("/rickandmortylist")]
    public function listCharacters(EntityManagerInterface $doctrineS){
        $repository = $doctrineS->getRepository(Character::class);
        $characters = $repository->findAll();


        
        return $this->render("Characters/listcharacters.html.twig",["characters"=>$characters]);

    }

    #[Route("new/character")]
    public function newCharacter(EntityManagerInterface $doctrineS)
    {
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


        $doctrineS->persist($character1);
        $doctrineS->persist($character2);
        $doctrineS->persist($character3);

        $doctrineS->flush();
        return new Response("characters insertados correctamente");

    



        // return new Response("Estoy en la home")
    }

}