<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Groupe;
use App\Entity\Message;
use App\Form\GroupeType;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class GroupeController extends AbstractController
{
    /**
     * @Route("/groupe/{id}", name="groupes")
     */
    public function groupe($id = 6) {

        // Get all messages
        $repo = $this -> getDoctrine() -> getRepository(Groupe::class);
        $messages = $repo -> find($id) -> getMessages();

        // Get all groupes of connected user
        $userId = $this -> getUser() -> getId();
        $repo = $this -> getDoctrine() -> getRepository(User::class);
        $groupes = $repo -> find($userId) -> getGroupes();

        return $this -> render('groupe/index.html.twig', [
            'groupes' => $groupes,
            'messages' => $messages
        ]);
    }

    /**
     * @Route("/new", name="new")
     */
    public function new() {

        $grp = new Groupe();

        $form = $this -> createForm(GroupeType::class, $grp);

        return $this -> render('groupe/new.html.twig',[
            'form' => $form -> createView()
        ]);
    }
}