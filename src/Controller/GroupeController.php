<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Groupe;
use App\Entity\Message;
use App\Form\GroupeType;
use App\Form\MessageType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class GroupeController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/groupe/{id}", name="groupes")
     */
    public function groupe(Request $req, int $id) {
        // Get all messages
        $repo = $this -> getDoctrine() -> getRepository(Groupe::class);
        $groupe = $repo -> find($id);
        if ($groupe != null) {

            $messages = $groupe -> getMessages();

            $userGranted = $groupe -> getUsers();
            $userP = $groupe -> getUserP();

            $userId = $this -> getUser() -> getId();
            $repo = $this -> getDoctrine() -> getRepository(User::class);
            $groupes = $repo -> find($userId) -> getGroupes();

            $grpId = [];
            foreach ($groupes as $grp) {
                array_push($grpId, $grp -> getId());
            }


            if (in_array($id, $grpId)) {
                // Get all groupes of connected user
                $userId = $this -> getUser() -> getId();
                $repo = $this -> getDoctrine() -> getRepository(User::class);
                $groupes = $repo -> find($userId) -> getGroupes();
        
                // Message form
                $msg = new Message();
                $msg -> setUser($this -> getUser());
                $msg -> setDate(new \DateTime('now'));
                $msg -> setGroupe($groupe);
                $msg -> setState(1);
        
                // Create form
                $formMessage = $this -> createForm(MessageType::class, $msg);
        
                $formMessage -> handleRequest($req);
        
                if($formMessage -> isSubmitted() && $formMessage -> isValid()) {
        
                    // Persist on base
                    $this -> entityManager -> persist($msg);
                    $this -> entityManager -> flush();
        
                    return $this -> redirect($req->getUri());
                }
        
                return $this -> render('groupe/index.html.twig', [
                    'access' => true,
                    'groupes' => $groupes,
                    'messages' => $messages,
                    'formMessage' => $formMessage -> createView()
                ]);
            } else {
                $this -> addFlash('danger', 'Vous n\'avez pas le droit d\'accéder à cette conversation');
                return $this -> render('groupe/index.html.twig', [
                    'access' => false
                ]);
            }
        } else {
            $this -> addFlash('danger', 'Vous n\'avez pas le droit d\'accéder à cette conversation');
            return $this -> render('groupe/index.html.twig', [
                'access' => false
            ]);
        }
    }

    // public function accessDenied() {
    //     $this -> addFlash('danger', 'Vous n\'avez pas le droit d\'accéder à cette conversation');
    //     return $this -> render('groupe/index.html.twig', [
    //         'access' => false
    //     ]);
    // }

    /**
     * @Route("/new", name="new")
     */
    public function new(Request $req) {

                // Get all groupes of connected user
        $userId = $this -> getUser() -> getId();
        $repo = $this -> getDoctrine() -> getRepository(User::class);
        $users = $repo -> findAll();

        $grp = new Groupe();
        $grp -> setImg('default.png');
        $grp -> setDate(new \DateTime('now'));
        $grp -> setUserP($this -> getUSer());

        foreach ($users as $usr) {
            $grp -> addUser($usr);
        }
        
        // Create form
        $form = $this -> createForm(GroupeType::class, $grp);

        $form -> handleRequest($req);

        if($form -> isSubmitted() && $form -> isValid()) {

            // Persist on base
            $this -> entityManager -> persist($grp);
            $this -> entityManager -> flush();

        }

        return $this -> render('groupe/new.html.twig',[
            'form' => $form -> createView()
        ]);
    }
}