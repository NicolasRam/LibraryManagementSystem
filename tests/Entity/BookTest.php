<?php
/**
 * Created by PhpStorm.
 * : nicolas
 * Date: 02/08/18
 * Time: 09:51
 */

namespace App\Tests\Entity;


use App\Entity\Book;
use PHPUnit\Framework\TestCase;
#use Symfony\Component\Security\Core\Encoder\UserPasswordEncoder;
#use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class BookTest extends TestCase
{

    public function __construct( ) {

    }

    public function testBookCanBeCreated()
    {
        $book = new Book();
        $this->assertInstanceOf(Book::class, $book);
    }

    public function testBookIntegrity(  )
    {
        $book = new Book( );

        $book->setTitle( 'Le Mépris' );
        $book->setIsbn( '9782080705259' );
        $book->setResume( 'Ricardo Molteni aime passionnément sa femme, Emilia, qu’il a épousée deux ans auparavant. Endetté par l’appartement qu’il a acheté, il doit mettre de côté ses ambitions d’écrivain et travaille comme scénariste, métier qu’il n’aime pas et qui suffit à peine à les faire vivre. Le jour où Riccardo fait la connaissance du producteur Battista et se retrouve invité dans sa villa à Capri pour adapter L’Odyssée, leurs problèmes d’argent semblent réglés. Mais à la même période, Riccardo prend conscience du fait que sa femme a cessé de l’aimer. Pressée par ses questions, Emilia finit par lui avouer la cause de ce désamour : elle le méprise…' );
        $book->setpageNumber(246);
        $book->setAuthor(1);
        $book->setPBook($Book  );
    }
}
