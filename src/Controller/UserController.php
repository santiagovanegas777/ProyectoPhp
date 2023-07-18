<?php

namespace App\Controller;

use App\Entity\Episode;
use App\Entity\Character;
use App\Entity\User;
use App\Form\CharacterType;
use App\Form\UserType;
use App\Manager\CharacterManager;
use ContainerBioASsa\getSecurity_Command_UserPasswordHashService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class UserController extends AbstractController{
     
    #[Route("/insert/user", name:"insertUser")]

    public function insertUser(EntityManagerInterface $doctrine, Request $request, UserPasswordHasherInterface $clave) {

       $form=$this-> createForm(UserType::class);
       $form->handleRequest($request);

       if($form->isSubmitted()and $form->isValid()){
        $user=$form->getData();
       $password = $user->getPassword();
       $passwordClave = $clave->hashPassword($user, $password);
       $user->setPassword($passwordClave);
        $doctrine->persist($user);
        $doctrine->flush();
        return $this->redirectToRoute('listCharacters');


       }

       return $this->render('Characters/insertCharacter.html.twig', ['characterForm'=>$form]);
    
} 

#[Route("/insert/admin", name:"insertAdmin")]

public function insertAdmin(EntityManagerInterface $doctrine, Request $request, UserPasswordHasherInterface $clave) {

   $form=$this-> createForm(UserType::class);
   $form->handleRequest($request);

   if($form->isSubmitted()and $form->isValid()){
    $user=$form->getData();
   $password = $user->getPassword();
   $passwordClave = $clave->hashPassword($user, $password);
   $user->setPassword($passwordClave);
   $user->setRoles(["ROLE_ADMIN","ROLE_USER"]);
    $doctrine->persist($user);
    $doctrine->flush();
    return $this->redirectToRoute('listCharacters');


   }

   return $this->render('Characters/insertCharacter.html.twig', ['characterForm'=>$form]);

} 
}