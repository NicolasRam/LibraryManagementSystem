<?php
/**
 * Created by PhpStorm.
 * User: moulaye
 * Date: 24/07/18
 * Time: 08:09
 */

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Class User
 *
 * @package App\Entity
 * @ORM\MappedSuperclass
 * // * @ORM\Entity( repositoryClass="App\Repository\UserRepository" )
 * @ORM\DiscriminatorColumn(name="discr", type="string")
 * @ORM\DiscriminatorMap
 * (
 *     {
 *          "Member" = "Member",
 *          "Liberian" = "Liberian",
 *          "Admin" = "Admin",
 *          "SuperAdmin" = "SuperAdmin",
 *      }
 * )
 * )
 */
//abstract class User implements UserInterface
class User implements UserInterface
{
    const ROLE_MEMBER      = 'ROLE_MEMBER';
    const ROLE_LIBRARIAN   = 'ROLE_LIBRARIAN';
    const ROLE_ADMIN       = 'ROLE_ADMIN';
    const ROLE_SUPER_ADMIN = 'ROLE_SUPER_ADMIN';

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     * @Assert\NotBlank()
     * @Assert\Length(min=4, max=50)
     */
    private $firstName;

    /**
     * @ORM\Column(type="string", length=50)
     * @Assert\NotBlank()
     * @Assert\Length(min=4, max=50)
     */
    private $lastName;

    /**
     * @ORM\Column(type="string", length=254, unique=true)
     * @Assert\NotBlank()
     * @Assert\Email()
     */
    private $email;

    /**
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @var array
     * @ORM\Column(type="simple_array")
     */
    private $roles;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\MicroBook", mappedBy="likedBy")
     */
    private $booksLiked;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\MicroBook", mappedBy="user")
     */
    private $books;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\User", mappedBy="following")
     */
    private $followers;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\User", inversedBy="followers")
     * @ORM\JoinTable(name="following",
     *     joinColumns={
     *         @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     *     },
     *     inverseJoinColumns={
     *         @ORM\JoinColumn(name="following_user_id", referencedColumnName="id")
     *     }
     * )
     */
    private $following;

    /**
     * @ORM\Column(type="string", nullable=true, length=30)
     */
    private $confirmationToken;

    /**
     * @ORM\Column(type="boolean")
     */
    private $enabled;

    public function __construct()
    {
        $this->books      = new ArrayCollection();
        $this->followers  = new ArrayCollection();
        $this->following  = new ArrayCollection();
        $this->booksLiked = new ArrayCollection();
        $this->roles      = [self::ROLE_USER];
        $this->enabled    = FALSE;
    }

    public function getRoles()
    {
        return $this->roles;
    }

    /**
     * @param array $roles
     */
    public function setRoles(array $roles): void
    {
        $this->roles = $roles;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getSalt()
    {
        return NULL;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function eraseCredentials()
    {

    }

    public function serialize()
    {
        return serialize(
            [
                $this->id,
                $this->username,
                $this->password,
                $this->enabled,
            ]
        );
    }

    public function unserialize($serialized)
    {
        list(
            $this->id, $this->username, $this->password, $this->enabled
            )
            = unserialize($serialized);
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email): void
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getFullName()
    {
        return $this->fullName;
    }

    /**
     * @param mixed $fullName
     */
    public function setFullName($fullName): void
    {
        $this->fullName = $fullName;
    }

    /**
     * @param mixed $username
     */
    public function setUsername($username): void
    {
        $this->username = $username;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password): void
    {
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getPlainPassword()
    {
        return $this->plainPassword;
    }

    /**
     * @param mixed $plainPassword
     */
    public function setPlainPassword($plainPassword): void
    {
        $this->plainPassword = $plainPassword;
    }

    /**
     * @return mixed
     */
    public function getBooks()
    {
        return $this->books;
    }

    /**
     * @return Collection
     */
    public function getFollowers()
    {
        return $this->followers;
    }

    /**
     * @return Collection
     */
    public function getFollowing()
    {
        return $this->following;
    }

    public function follow(User $userToFollow)
    {
        if ($this->getFollowing()->contains($userToFollow)) {
            return;
        }

        $this->getFollowing()->add($userToFollow);
    }

    /**
     * @return Collection
     */
    public function getBooksLiked()
    {
        return $this->booksLiked;
    }

    /**
     * @return mixed
     */
    public function getConfirmationToken()
    {
        return $this->confirmationToken;
    }

    /**
     * @param mixed $confirmationToken
     */
    public function setConfirmationToken($confirmationToken): void
    {
        $this->confirmationToken = $confirmationToken;
    }

    /**
     * @return mixed
     */
    public function getEnabled()
    {
        return $this->enabled;
    }

    /**
     * @param mixed $enabled
     */
    public function setEnabled($enabled): void
    {
        $this->enabled = $enabled;
    }

    public function isAccountNonExpired()
    {
        return TRUE;
    }

    public function isAccountNonLocked()
    {
        return TRUE;
    }

    public function isCredentialsNonExpired()
    {
        return TRUE;
    }

    public function isEnabled()
    {
        return $this->enabled;
    }

    /**
     * @return UserPreferences|null
     */
    public function getPreferences()
    {
        return $this->preferences;
    }

    /**
     * @param mixed $preferences
     */
    public function setPreferences($preferences): void
    {
        $this->preferences = $preferences;
    }
}