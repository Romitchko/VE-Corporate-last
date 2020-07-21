<?php

namespace App\Entity;

use Serializable;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\UserRepository;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @UniqueEntity(fields={"username"}, message="There is already an account with this username")
 */
class User Implements UserInterface,\Serializable 
/* Pour que l’utilisateur soit sauvegardé au niveau de la session, 
le User doit implémenter l’interface avec « \Serializable ». */
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

    /**
     * @ORM\Column(type="string", length=255)
     * Assert\NotBlank()
     * Assert\Email()
     */
    private $email;


    
    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    // ...
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    /**
     * Set the value of roles
     *
     * @return  self
     */ 
    public function setRoles($roles)
    {
        $this->roles = $roles;

        return $this;
    }
    

    /**
     * @ORM\Column(type="boolean")
     */
    private $isVerified = false;


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

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
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
    public function serialize() /* methode pour sauvegarder le user dans la session 
    et transforme l'objet en chaine */
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
    /* inverse de serialize, convertit la chaine en objet */
    /* passe en @param les informations qui ont pu être serialisés */
    {
        list ( 
            $this->id,
            $this->username,
            $this->password
        ) = unserialize($serialized, ['allowed_classes' => false]);
        /* allowed classes permet de ne pas instancier les classes si elles dans serialized */
    }

    public function isVerified(): bool
    {
        return $this->isVerified;
    }

    public function setIsVerified(bool $isVerified): self
    {
        $this->isVerified = $isVerified;

        return $this;
    }


   

    
}
