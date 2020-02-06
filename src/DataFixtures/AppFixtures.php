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
        $usr1 = new User();
        $usr1 -> setUsername('to');
        // $usr -> setRoles('ROLE_USER');
        $usr1 -> setEmail('clement.ramos@gmail.com');
        $usr1 -> setPassword('$2y$13$CjtAPpz55FQhDJSGgfr7VupE15RBp9NXCqLYzxf18HJf6B9.CvooK');
        $usr1 -> setImg('default.png');
        
        $manager -> persist($usr1);

        $usr2 = new User();
        $usr2 -> setUsername('me');
        // $usr -> setRoles('ROLE_USER');
        $usr2 -> setEmail('clement@gmail.com');
        $usr2 -> setPassword('$2y$13$CjtAPpz55FQhDJSGgfr7VupE15RBp9NXCqLYzxf18HJf6B9.CvooK');
        $usr2 -> setImg('default.png');
        
        $manager -> persist($usr2);

        $grp1 = new Groupe();
        $grp1 -> setName('Les amis');
        $grp1 -> setUserP($usr1);
        $grp1 -> setImg('default.png');
        $grp1 -> setDate(new \DateTime('now'));

        $manager -> persist($grp1);

        $grp2 = new Groupe();
        $grp2 -> setName('Profs');
        $grp2 -> setUserP($usr2);
        $grp2 -> setImg('default.png');
        $grp2 -> setDate(new \DateTime('now'));

        $manager -> persist($grp2);


        for($j = 0; $j < 5; $j++) {
            $msg = new Message();
            $msg -> setGroupe($grp1);
            $msg -> setUser($usr1);
            $msg -> setContent("Ceci est le contenu du message numéro " . $j);
            $msg -> setDate(new \DateTime('now'));
            $msg -> setState(1);

            $manager -> persist($msg);
        }

        for($j = 0; $j < 8; $j++) {
            $msg = new Message();
            $msg -> setGroupe($grp2);
            $msg -> setUser($usr2);
            $msg -> setContent("Ceci est le contenu du message numéro " . $j);
            $msg -> setDate(new \DateTime('now'));
            $msg -> setState(1);

            $manager -> persist($msg);
        }
        $manager -> flush();
    }
}