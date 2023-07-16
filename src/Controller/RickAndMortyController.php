<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

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
    public function listCharacters(){

        $characters = [
            [
                "name"=>"Rick",
                "species"=>"Alien",
                "image"=>"https://rickandmortyapi.com/api/character/avatar/14.jpeg",
                "gender"=>"Male",
    
    
    
            ],
            [
                "name"=>"Million Ants",
                "species"=>"Animal",
                "image"=>"https://rickandmortyapi.com/api/character/avatar/226.jpeg",
                "gender"=>"Male",
    
    
    
            ],
            [
                "name"=>"Ricktiminus Sancheziminius",
                "species"=>"Human",
                "image"=>"https://rickandmortyapi.com/api/character/avatar/294.jpeg",
                "gender"=>"Male",
    
    
    
            ],

        ];
        return $this->render("Characters/listcharacters.html.twig",["characters"=>$characters]);

    }


}