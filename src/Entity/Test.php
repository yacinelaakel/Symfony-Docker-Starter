<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TestRepository")
 */
class Test {
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $lastName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    public function getId(): ?int {
        return $this->id;
    }

    public function getLastName(): ?string {
        return $this->lastName;
    }

    public function getName(): ?string {
        return $this->name;
    }

    public function setLastName(string $lastName): self {
        $this->lastName = $lastName;
        return $this;
    }

    public function setName(string $name): self {
        $this->name = $name;
        return $this;
    }
}
