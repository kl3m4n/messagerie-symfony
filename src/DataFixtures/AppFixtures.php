<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Entity\Groupe;
use App\Entity\Message;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);
        
        $usr = new User();
        $usr -> setUsername('Clement');
        $usr -> setRoles(['user']);
        $usr -> setEmail('clement.ramos@gmail.com');
        $usr -> setPassword('motdepasse');
        $usr -> setImg('default.png');
        
        $manager -> persist($usr);

        for($i = 0; $i < 2; $i++) {
                $grp = new Groupe();
                $grp -> setName('Groupe ' . $i);
                $grp -> setImg('default.png');
                $grp -> setDate(new \DateTime('now'));

                $manager -> persist($grp);


            for($j = 0; $j < 5; $j++) {
                $msg = new Message();
                $msg -> setGroupe($grp);
                $msg -> setUser($usr);
                $msg -> setContent("Ceci est le contenu du message numéro " . $i);
                $msg -> setDate(new \DateTime('now'));
                $msg -> setState(1);

                $manager -> persist($msg);
            }
        }
        $manager -> flush();
    }
}
