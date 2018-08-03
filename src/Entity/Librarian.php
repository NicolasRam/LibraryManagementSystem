<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 *
 * @ORM\MappedSuperclass()
 *
 * @ORM\Entity(repositoryClass="LibrarianRepository")
 */
class Librarian extends User
{
    public function __construct() {
        $this->roles = [ self::ROLE_LIBRARIAN ];
    }
}
