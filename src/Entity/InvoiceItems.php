<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * InvoiceItems
 *
 * @ORM\Table(name="invoice_items", indexes={@ORM\Index(name="IFK_InvoiceLineInvoiceId", columns={"InvoiceId"}), @ORM\Index(name="IFK_InvoiceLineTrackId", columns={"TrackId"})})
 * @ORM\Entity
 */
class InvoiceItems
{
    /**
     * @var int
     *
     * @ORM\Column(name="InvoiceLineId", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $invoicelineid;

    /**
     * @var string
     *
     * @ORM\Column(name="UnitPrice", type="decimal", precision=10, scale=2, nullable=false)
     */
    private $unitprice;

    /**
     * @var int
     *
     * @ORM\Column(name="Quantity", type="integer", nullable=false)
     */
    private $quantity;

    /**
     * @var \Invoices
     *
     * @ORM\ManyToOne(targetEntity="Invoices")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="InvoiceId", referencedColumnName="InvoiceId")
     * })
     */
    private $invoiceid;

    /**
     * @var \Tracks
     *
     * @ORM\ManyToOne(targetEntity="Tracks")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="TrackId", referencedColumnName="TrackId")
     * })
     */
    private $trackid;

    public function getInvoicelineid(): ?int
    {
        return $this->invoicelineid;
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

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getInvoiceid(): ?Invoices
    {
        return $this->invoiceid;
    }

    public function setInvoiceid(?Invoices $invoiceid): self
    {
        $this->invoiceid = $invoiceid;

        return $this;
    }

    public function getTrackid(): ?Tracks
    {
        return $this->trackid;
    }

    public function setTrackid(?Tracks $trackid): self
    {
        $this->trackid = $trackid;

        return $this;
    }


}
