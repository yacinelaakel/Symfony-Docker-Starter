<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User extends AbstractEntity implements UserInterface {
    /**
     * @ORM\Column(type="string", length=180, unique=true)
     *
     * @var string
     */
    private $email;

    /**
     * @ORM\Column(type="string")
     *
     * @var string The hashed password
     */
    private $password;

    /**
     * @ORM\Column(type="json")
     *
     * @var array
     */
    private $roles = [];

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void {
        // If you store any temporary, sensitive data on the user, clear it here
    }

    /**
     * @return string
     */
    public function getEmail(): string {
        return $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string {
        return $this->password;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array {
        $roles = $this->roles;
        $roles[] = 'ROLE_USER';
        return array_unique($roles);
    }

    /**
     * @see UserInterface
     */
    public function getSalt(): void {
        // This can return null if the password was not encoded using a salt.
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string {
        return $this->email;
    }

    /**
     * @param string $email
     *
     * @return $this
     */
    public function setEmail(string $email): self {
        $this->email = $email;
        return $this;
    }

    /**
     * @param string $password
     *
     * @return $this
     */
    public function setPassword(string $password): self {
        $this->password = $password;
        return $this;
    }

    /**
     * @param array $roles
     *
     * @return $this
     */
    public function setRoles(array $roles): self {
        $this->roles = $roles;
        return $this;
    }
}
