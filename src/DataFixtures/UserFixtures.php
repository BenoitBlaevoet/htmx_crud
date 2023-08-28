<?php

namespace App\DataFixtures;

use App\Entity\UserEntity;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for ($i=0; $i<100; $i++){
            $user = new UserEntity();
            $user->setEmail('email_user_'.$i.'@example.com');
            $user->setPassword(
                substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil(10/strlen($x)) )),1,10)
            );
            $manager->persist($user);
        }

        $manager->flush();
    }
}