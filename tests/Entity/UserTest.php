<?php
/**
 * Created by PhpStorm.
 * User: moulaye
 * Date: 25/07/18
 * Time: 21:23
 */

namespace App\Tests\Entity;


use App\Entity\User;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoder;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserTest extends TestCase
{
    /**
     * @var UserPasswordEncoderInterface
     */
    private $encoder;

    public function __construct() { }

    public function testUserCanBeCreated()
    {
        $user = new User();
        $this->assertInstanceOf(User::class, $user);
    }

    public function testUserIntegrity(  )
    {
        $user = new User( ['ROLE_SUPER_USER'] );

        $encodePassword = $this->encoder->encodePassword($user, '123456789');

        $user->setFirstName( 'Moulaye' );
        $user->setLastName( 'Cissé' );
        $user->setEmail( 'moulaye.c@gmail.com' );
        $user->setPassword( $encodePassword );

        $this->assertSame( ['ROLE_SUPER_USER'], $user->getRoles() );
        $this->assertSame( 'Moulaye', $user->getFirstName() );
        $this->assertSame( 'Cissé', $user->getLastName() );
        $this->assertSame( 'moulaye.c@gmail.com', $user->getEmail() );
        $this->assertSame( $encodePassword, $user->getPassword() );
    }
}