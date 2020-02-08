<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationType;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class SecurityController extends AbstractController
{

    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/login", name="login")
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // if ($this->getUser()) {
        //     return $this->redirectToRoute('target_path');
        // }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this -> render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    /**
     * @Route("/register", name="register")
     */
    public function registration(Request $req, UserPasswordEncoderInterface $encoder) {
        $user = new User();

        $form = $this -> createForm(RegistrationType::class, $user);

        $form -> handleRequest($req);

        if($form -> isSubmitted()) {
            $hash = $encoder -> encodePassword($user, $user -> getPassword());
            $this -> entityManager -> persist($user);

            $user -> setPassword($hash);

            $img = $user -> getFile();
            // dd($img);
            $imgName = md5(uniqid()) . '.' . $img -> guessExtension();
            $img -> move($this -> getParameter('upload_directory'), $imgName);
            $user -> setImg($imgName);

            $this -> entityManager -> flush();

            $this -> addFlash('success', 'Félicitation, vous êtes désormais inscrit');
            $this -> redirectToRoute('login');
            // dd('Frr t\'abuse');
        }

        return $this -> render('security/registration.html.twig', [
            'form' => $form -> createView()
        ]);
    }

    /**
     * @Route("/logout", name="logout")
     */
    public function logout()
    {
        throw new \Exception('This method can be blank - it will be intercepted by the logout key on your firewall');
    }
}
