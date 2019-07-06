<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class AbstractEntity.
 *
 * @package App\Entity
 */
abstract class AbstractEntity {
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     *
     * @var int
     */
    protected $id;

    /**
     * @return int
     */
    public function getId(): int {
        return $this->id;
    }
}
