<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Message;

class GroupeController extends AbstractController
{
    /**
     * @Route("/groupe", name="groupe")
     */
    public function index()
    {
        $repo = $this -> getDoctrine() -> getRepository(Message::class);
        $messages = $repo -> findAll();


        return $this->render('groupe/index.html.twig', [
            'messages' => $messages
        ]);
    }

    // public function post($id) {
    //         //1: Récupérer les données (infos, commentaire)
    //         $repo = $this -> getDoctrine() -> getRepository(Post::class);
    //         $post = $repo -> find($id);


    //         $manager = $this -> getDoctrine() -> getManager();
    //         $post = $manager -> find(Post::class,$id);



    //         //2 : Afficher la vue (avec les data transmises)
    //         return $this -> render('post/show.html.twig',['id' => $id]);

    // }
}