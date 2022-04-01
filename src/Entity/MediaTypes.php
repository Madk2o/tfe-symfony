<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MediaTypes
 *
 * @ORM\Table(name="media_types")
 * @ORM\Entity
 */
class MediaTypes
{
    /**
     * @var int
     *
     * @ORM\Column(name="MediaTypeId", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $mediatypeid;

    /**
     * @var string|null
     *
     * @ORM\Column(name="Name", type="string", length=255, nullable=true)
     */
    private $name;

    public function getMediatypeid(): ?int
    {
        return $this->mediatypeid;
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
