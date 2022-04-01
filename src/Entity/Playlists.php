<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Playlists
 *
 * @ORM\Table(name="playlists")
 * @ORM\Entity
 */
class Playlists
{
    /**
     * @var int
     *
     * @ORM\Column(name="PlaylistId", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $playlistid;

    /**
     * @var string|null
     *
     * @ORM\Column(name="Name", type="string", length=255, nullable=true)
     */
    private $name;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Tracks", inversedBy="playlistid")
     * @ORM\JoinTable(name="playlist_track",
     *   joinColumns={
     *     @ORM\JoinColumn(name="PlaylistId", referencedColumnName="PlaylistId")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="TrackId", referencedColumnName="TrackId")
     *   }
     * )
     */
    private $trackid;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->trackid = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getPlaylistid(): ?int
    {
        return $this->playlistid;
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

    /**
     * @return Collection|Tracks[]
     */
    public function getTrackid(): Collection
    {
        return $this->trackid;
    }

    public function addTrackid(Tracks $trackid): self
    {
        if (!$this->trackid->contains($trackid)) {
            $this->trackid[] = $trackid;
        }

        return $this;
    }

    public function removeTrackid(Tracks $trackid): self
    {
        $this->trackid->removeElement($trackid);

        return $this;
    }
    public function __toString() {
        return $this->name;
    }

}
