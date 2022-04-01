<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Tracks
 *
 * @ORM\Table(name="tracks", indexes={@ORM\Index(name="IFK_TrackGenreId", columns={"GenreId"}), @ORM\Index(name="IFK_TrackMediaTypeId", columns={"MediaTypeId"}), @ORM\Index(name="IFK_TrackAlbumId", columns={"AlbumId"})})
 * @ORM\Entity(repositoryClass="App\Repository\TracksRepository")
 */
class Tracks
{
    /**
     * @var int
     *
     * @ORM\Column(name="TrackId", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $trackid;

    /**
     * @var string
     *
     * @ORM\Column(name="Name", type="string", length=255, nullable=false)
     */
    private $name;

    /**
     * @var string|null
     *
     * @ORM\Column(name="Composer", type="string", length=255, nullable=true)
     */
    private $composer;

    /**
     * @var int
     *
     * @ORM\Column(name="Milliseconds", type="integer", nullable=false)
     */
    private $milliseconds;

    /**
     * @var int|null
     *
     * @ORM\Column(name="Bytes", type="integer", nullable=true)
     */
    private $bytes;

    /**
     * @var string
     *
     * @ORM\Column(name="UnitPrice", type="decimal", precision=10, scale=2, nullable=false)
     */
    private $unitprice;

    /**
     * @var \Albums
     *
     * @ORM\ManyToOne(targetEntity="Albums")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="AlbumId", referencedColumnName="AlbumId")
     * })
     */
    private $albumid;

    /**
     * @var \MediaTypes
     *
     * @ORM\ManyToOne(targetEntity="MediaTypes")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="MediaTypeId", referencedColumnName="MediaTypeId")
     * })
     */
    private $mediatypeid;

    /**
     * @var \Genres
     *
     * @ORM\ManyToOne(targetEntity="Genres")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="GenreId", referencedColumnName="GenreId")
     * })
     */
    private $genreid;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Playlists", mappedBy="trackid")
     */
    private $playlistid;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->playlistid = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getTrackid(): ?int
    {
        return $this->trackid;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getComposer(): ?string
    {
        return $this->composer;
    }

    public function setComposer(?string $composer): self
    {
        $this->composer = $composer;

        return $this;
    }

    public function getMilliseconds(): ?int
    {
        return $this->milliseconds;
    }

    public function setMilliseconds(int $milliseconds): self
    {
        $this->milliseconds = $milliseconds;

        return $this;
    }

    public function getBytes(): ?int
    {
        return $this->bytes;
    }

    public function setBytes(?int $bytes): self
    {
        $this->bytes = $bytes;

        return $this;
    }

    public function getUnitprice(): ?string
    {
        return $this->unitprice;
    }

    public function setUnitprice(string $unitprice): self
    {
        $this->unitprice = $unitprice;

        return $this;
    }

    public function getAlbumid(): ?Albums
    {
        return $this->albumid;
    }

    public function setAlbumid(?Albums $albumid): self
    {
        $this->albumid = $albumid;

        return $this;
    }

    public function getMediatypeid(): ?MediaTypes
    {
        return $this->mediatypeid;
    }

    public function setMediatypeid(?MediaTypes $mediatypeid): self
    {
        $this->mediatypeid = $mediatypeid;

        return $this;
    }

    public function getGenreid(): ?Genres
    {
        return $this->genreid;
    }

    public function setGenreid(?Genres $genreid): self
    {
        $this->genreid = $genreid;

        return $this;
    }

    /**
     * @return Collection|Playlists[]
     */
    public function getPlaylistid(): Collection
    {
        return $this->playlistid;
    }

    public function addPlaylistid(Playlists $playlistid): self
    {
        if (!$this->playlistid->contains($playlistid)) {
            $this->playlistid[] = $playlistid;
            $playlistid->addTrackid($this);
        }

        return $this;
    }

    public function removePlaylistid(Playlists $playlistid): self
    {
        if ($this->playlistid->removeElement($playlistid)) {
            $playlistid->removeTrackid($this);
        }

        return $this;
    }
    public function __toString() {
        return $this->name;
    }

}
