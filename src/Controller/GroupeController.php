<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Groupe;
use App\Entity\Message;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class GroupeController extends AbstractController
{
    /**
     * @Route("/groupe/{id}", name="groupe")
     */
    public function groupe($id = '3')
    {
        $repo = $this -> getDoctrine() -> getRepository(Message::class);
        $messages = $repo -> findBy(['groupe' => $id]);

        return $this -> render('groupe/groupe.html.twig', [
            'messages' => $messages
        ]);
    }

    /**
     * @Route("/groupes", name="groupes")
     */
    public function groupes() {
        // $repo = $this -> getDoctrine() -> getRepository(Groupe::class);
        // $groupes = $repo -> findAll();

        $rep = $this->getDoctrine()->getRepository(User::class);
        $id = $this->getUser()->getId();
        $groupes = $rep -> find($id) -> getGroupes();
        
        return $this -> render('groupe/index.html.twig', [
            'groupes' => $groupes
        ]);
    }
}