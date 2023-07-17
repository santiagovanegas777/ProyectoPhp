<?php

namespace App\DataFixtures;

use App\Entity\Character;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class CharacterFixtures extends Fixture
{

    protected $httpClient;

    public function __construct(HttpClientInterface $httpClient) 
    {
     $this->httpClient = $httpClient;
    }
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);

        for ($i=0; $i<100; $i++){

       

        $randId = rand(1, 140);

        $response = $this->httpClient->request("GET", "https://rickandmortyapi.com/api/character/$randId");

        $content = json_decode($response->getContent(), associative:true);

        $character = new Character();
        $character->setName($content['name']);
        $character->setImage(image:"https://rickandmortyapi.com/api/character/avatar/$randId.jpeg");
        $character->setSpecies($content['species']);
        $character->setGender($content['gender']);
        

        $manager->persist($character);

        $manager->flush();
     }
    }
}


