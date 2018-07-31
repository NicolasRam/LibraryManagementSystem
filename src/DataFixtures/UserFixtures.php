<?php
/**
 * Created by PhpStorm.
 * User: moulaye
 * Date: 24/07/18
 * Time: 16:50
 */

namespace App\DataFixtures;


use App\Entity\Admin;
use App\Entity\Author;
use App\Entity\Librarian;
use App\Entity\Member;
use App\Entity\SuperAdmin;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture implements OrderedFixtureInterface
{
    /**
     * @var UserPasswordEncoderInterface
     */
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder ) {

        $this->encoder = $encoder;
    }

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $user = new User();

        $user->setFirstName( 'Moulaye' );
        $user->setLastName( 'Cissé' );
        $user->setEmail( 'moulaye.c@gmail.com' );
        $user->setRoles( [User::ROLE_SUPER_ADMIN] );
        $encoded = $this->encoder->encodePassword($user, '123456789');
        $user->setPassword( $encoded );

        $manager->persist($user);

        $superAdminUser = new SuperAdmin();

        $superAdminUser->setFirstName( 'SuperAdmin' );
        $superAdminUser->setLastName( 'SuperAdmin' );
        $superAdminUser->setEmail( 'superadmin@superadmin.com' );
        $encoded = $this->encoder->encodePassword($superAdminUser, '123456789');
        $superAdminUser->setPassword( $encoded );

        $manager->persist($superAdminUser);

        $adminUser = new Admin();

        $adminUser->setFirstName( 'Admin' );
        $adminUser->setLastName( 'Admin' );
        $adminUser->setEmail( 'admin@admin.com' );
        $encoded = $this->encoder->encodePassword($adminUser, '123456789');
        $adminUser->setPassword( $encoded );

        $manager->persist($adminUser);

        $librarianUser = new Librarian();

        $librarianUser->setFirstName( 'Librarian' );
        $librarianUser->setLastName( 'Librarian' );
        $librarianUser->setEmail( 'librarian@librarian.com' );
        $encoded = $this->encoder->encodePassword($librarianUser, '123456789');
        $librarianUser->setPassword( $encoded );

        $manager->persist($librarianUser);

        $memberUser = new Member();

        $memberUser->setFirstName( 'Member' );
        $memberUser->setLastName( 'Member' );
        $memberUser->setEmail( 'member@member.com' );
        $encoded = $this->encoder->encodePassword($memberUser, '123456789');
        $memberUser->setPassword( $encoded );

        $manager->persist($memberUser);

        $manager->flush();
    }

    /**
     * Get the order of this fixture
     *
     * @return integer
     */
    public function getOrder()
    {
        return 1;
    }
}