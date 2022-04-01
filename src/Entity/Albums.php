<?php

namespace App\Entity;

use App\Entity\Artists;
use Doctrine\ORM\Mapping as ORM;

/**
 * Albums
 *
 * @ORM\Table(name="albums", indexes={@ORM\Index(name="IFK_AlbumArtistId", columns={"ArtistId"})})
 * @ORM\Entity
 */
class Albums
{
    /**
     * @var int
     *
     * @ORM\Column(name="AlbumId", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $albumid;

    /**
     * @var string
     *
     * @ORM\Column(name="Title", type="string", length=255, nullable=false)
     */
    private $title;

    /**
     * @var \Artists
     *
     * @ORM\ManyToOne(targetEntity="Artists")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ArtistId", referencedColumnName="ArtistId")
     * })
     */
    private $artistid;

    public function getAlbumid(): ?int
    {
        return $this->albumid;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getArtistid(): ?Artists
    {
        return $this->artistid;
    }

    public function setArtistid(?Artists $artistid): self
    {
        $this->artistid = $artistid;

        return $this;
    }
    public function __toString() {
        return $this->title;
    }

}
