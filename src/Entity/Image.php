<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 *
 * @ORM\MappedSuperclass()
 * @ORM\Entity(repositoryClass="App\Repository\ImageRepository")
 */
class Image extends File
{
}
