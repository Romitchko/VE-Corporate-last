<?php
namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;

class Contact {

    /**
     * @var string|null
     * @Assert\NotBlank()
     * @Assert\Length(min=2, max=100)
     */
    private $firstname;

    /**
     * @var string|null
     * @Assert\NotBlank()
     * @Assert\Length(min=2, max=100)
     */
    private $lastname;

    /**
     * @var string|null
     * @Assert\NotBlank()
     * @Assert\Regex(
     * pattern="/[0-9]{0,14}/"     
     * )
     */
    private $phone;

    /**
     * @var string|null
     * @Assert\NotBlank()
     * @Assert\Email()
     */
    private $email;

    /**
     * @var string|null
     * @Assert\NotBlank()
     * @Assert\Length(min=10, max=350)
     */
    private $message;


    


    /**
     * @return  string|null
     */ 
    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    /**
     * @param  string|null  $firstname
     *
     * @return  Contact
     */ 
    public function setFirstname(?string $firstname): Contact
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * @return  string|null
     */ 
    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    /**
     * @param  string|null  $lastname
     *
     * @return  Contact
     */ 
    public function setLastname(?string $lastname): Contact
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Get pattern="/[0-9]{0,14}/"
     *
     * @return  string|null
     */ 
    public function getPhone(): ?string
    {
        return $this->phone;
    }

    /**
     * Set pattern="/[0-9]{0,14}/"
     *
     * @param  string|null  $phone  pattern="/[0-9]{0,14}/"
     *
     * @return  Contact
     */ 
    public function setPhone(?string $phone): Contact
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get the value of email
     *
     * @return  string|null
     */ 
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @param  string|null  $email
     *
     * @return  self
     */ 
    public function setEmail(?string $email): Contact
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of message
     *
     * @return  string|null
     */ 
    public function getMessage(): ?string
    {
        return $this->message;
    }

    /**
     * Set the value of message
     *
     * @param  string|null  $message
     *
     * @return  self
     */ 
    public function setMessage(?string $message): Contact
    {
        $this->message = $message;

        return $this;
    }
}