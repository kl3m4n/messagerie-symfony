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
     * @Route("/groupes", name="groupe")
     */
    public function groupes($id = '3')
    {
        $repo = $this -> getDoctrine() -> getRepository(Message::class);
        $messages = $repo -> findBy(['groupe' => $id]);

        return $this -> render('groupe/groupe.html.twig', [
            'messages' => $messages
        ]);
    }

    /**
     * @Route("/groupe/{id}", name="groupes")
     */
    public function groupe($id = 3) {

        $repo = $this -> getDoctrine() -> getRepository(Groupe::class);
        $messages = $repo -> find($id) -> getMessages();

        // dd($messages);

        $rep = $this -> getDoctrine() -> getRepository(User::class);
        $iid = $this -> getUser() -> getId();
        $groupes = $rep -> find($iid) -> getGroupes();
        
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