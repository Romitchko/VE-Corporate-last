<?php

namespace App\Entity;

use Serializable;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\UserRepository;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 */
class User Implements UserInterface,\Serializable
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $password;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }


    /**
     * Returns the roles granted to the user.
     * 
     *  public function getRoles() 
     *      {
     *          return array('ROLE_USER');
     *      }
     * 
     * @return (Role|string|null[] The user roles)
     */
    public function getRoles()
    {
        return ['ROLE_ADMIN'];
    }


    /**
     *  Returns the salt that was originally used to encode the password.
     * 
     * This can return null if the password was not encoded using salt.
     * 
     * @return string|null The Salt
     */
    public function getSalt()
    {
        return null;
    }


    /**
     * Removes sensitive data from the user.
     * 
     * This is important if, at any giver point, sensitive information like
     * the plain-text password is stored on this object.
     */
    public function eraseCredentials()
    { }

    /**
     * String representation of object
     * @return string the string representation of the object or null
     * @since 5.1.0
     */
    public function serialize()
    {
        return serialize([
            $this->id,
            $this->username,
            $this->password
        ]);
    }

    /**
     * Construct the object 
     * @param string $serialized <p>
     * The string representation of the object.
     * <p>
     * @return void
     * @since 5.1.0
     */
    public function unserialize($serialized)
    {
        list (
            $this->id,
            $this->username,
            $this->password
        ) = unserialize($serialized, ['allowed_classes' => false]);
    }
}