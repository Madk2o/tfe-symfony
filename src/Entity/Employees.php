<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Employees
 *
 * @ORM\Table(name="employees", indexes={@ORM\Index(name="IFK_EmployeeReportsTo", columns={"ReportsTo"})})
 * @ORM\Entity
 */
class Employees
{
    /**
     * @var int
     *
     * @ORM\Column(name="EmployeeId", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $employeeid;

    /**
     * @var string
     *
     * @ORM\Column(name="LastName", type="string", length=255, nullable=false)
     */
    private $lastname;

    /**
     * @var string
     *
     * @ORM\Column(name="FirstName", type="string", length=255, nullable=false)
     */
    private $firstname;

    /**
     * @var string|null
     *
     * @ORM\Column(name="Title", type="string", length=255, nullable=true)
     */
    private $title;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="BirthDate", type="datetime", nullable=true)
     */
    private $birthdate;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="HireDate", type="datetime", nullable=true)
     */
    private $hiredate;

    /**
     * @var string|null
     *
     * @ORM\Column(name="Address", type="string", length=255, nullable=true)
     */
    private $address;

    /**
     * @var string|null
     *
     * @ORM\Column(name="City", type="string", length=255, nullable=true)
     */
    private $city;

    /**
     * @var string|null
     *
     * @ORM\Column(name="State", type="string", length=255, nullable=true)
     */
    private $state;

    /**
     * @var string|null
     *
     * @ORM\Column(name="Country", type="string", length=255, nullable=true)
     */
    private $country;

    /**
     * @var string|null
     *
     * @ORM\Column(name="PostalCode", type="string", length=255, nullable=true)
     */
    private $postalcode;

    /**
     * @var string|null
     *
     * @ORM\Column(name="Phone", type="string", length=255, nullable=true)
     */
    private $phone;

    /**
     * @var string|null
     *
     * @ORM\Column(name="Fax", type="string", length=255, nullable=true)
     */
    private $fax;

    /**
     * @var string|null
     *
     * @ORM\Column(name="Email", type="string", length=255, nullable=true)
     */
    private $email;

    /**
     * @var \Employees
     *
     * @ORM\ManyToOne(targetEntity="Employees")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ReportsTo", referencedColumnName="EmployeeId")
     * })
     */
    private $reportsto;

    public function getEmployeeid(): ?int
    {
        return $this->employeeid;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getBirthdate(): ?\DateTimeInterface
    {
        return $this->birthdate;
    }

    public function setBirthdate(?\DateTimeInterface $birthdate): self
    {
        $this->birthdate = $birthdate;

        return $this;
    }

    public function getHiredate(): ?\DateTimeInterface
    {
        return $this->hiredate;
    }

    public function setHiredate(?\DateTimeInterface $hiredate): self
    {
        $this->hiredate = $hiredate;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(?string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(?string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getState(): ?string
    {
        return $this->state;
    }

    public function setState(?string $state): self
    {
        $this->state = $state;

        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(?string $country): self
    {
        $this->country = $country;

        return $this;
    }

    public function getPostalcode(): ?string
    {
        return $this->postalcode;
    }

    public function setPostalcode(?string $postalcode): self
    {
        $this->postalcode = $postalcode;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(?string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getFax(): ?string
    {
        return $this->fax;
    }

    public function setFax(?string $fax): self
    {
        $this->fax = $fax;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getReportsto(): ?self
    {
        return $this->reportsto;
    }

    public function setReportsto(?self $reportsto): self
    {
        $this->reportsto = $reportsto;

        return $this;
    }


}
