<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Artists
 *
 * @ORM\Table(name="artists")
 * @ORM\Entity
 */
class Artists
{
    /**
     * @var int
     *
     * @ORM\Column(name="ArtistId", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $artistid;

    /**
     * @var string|null
     *
     * @ORM\Column(name="Name", type="string", length=255, nullable=true)
     * @Assert\Length(
     *      min = 3,
     *      max = 75,
     *      minMessage = "The artist name must contain minimum 3 caractere",
     *      maxMessage = "The artist name must contain maximum 75 caractere"
     * )
     * @Assert\NotBlank(message="Artist ne peut être vide")
     */
    private $name;

    public function getArtistid(): ?int
    {
        return $this->artistid;
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
        return $this->name();
    }

}
