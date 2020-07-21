<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{

    /**
     * @var UserPasswordEncoderInterface
     */
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    { /* création encoder via UserPasswordEncoderInterface et initialisation */
        $this->encoder = $encoder;
    }



    public function load(ObjectManager $manager)
    {   /* creation new user */
        $user = new User();
        $user->setUsername('********');
        $user->setEmail('contact@vitis-epicuria.com');
        $user->setPassword($this->encoder->encodePassword($user, '********'));
        $user->setRoles(['ROLE_ADMIN']);
        $manager->persist($user);
        $manager->flush();
    }
}
