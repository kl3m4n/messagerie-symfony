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
        $usr->setUsername('Clement');
        $usr->setEmail('clement.ramos@gmail.com');
        $usr->setPassword('motdepasse');
        $usr->setPhoto('default.png');
        
        $manager->persist($usr);

        $grp = new Groupe();
        $grp->setNom('Groupe 1');
        $grp->setPhoto('default.png');
        $grp->setDate(new \DateTime('now'));

        $manager->persist($grp);


        for($i = 0; $i < 10; $i++) {
            $msg = new Message();
            $msg->setGroupe($grp);
            $msg->setUser($usr);
            $msg->setContent("Ceci est le contenu du message numéro " . $i);
            $msg->setDate(new \DateTime('now'));
            $msg->setState(1);

            $manager->persist($msg);
        }

        $manager->flush();
    }
}
