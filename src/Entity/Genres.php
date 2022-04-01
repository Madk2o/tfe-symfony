<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Genres
 *
 * @ORM\Table(name="genres")
 * @ORM\Entity
 */
class Genres
{
    /**
     * @var int
     *
     * @ORM\Column(name="GenreId", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $genreid;

    /**
     * @var string|null
     *
     * @ORM\Column(name="Name", type="string", length=255, nullable=true)
     */
    private $name;

    public function getGenreid(): ?int
    {
        return $this->genreid;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }
    public function __toString() {
        return $this->name;
    }

}
