<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BookingRepository")
 */
class Booking
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $start;

    /**
     * @ORM\Column(type="date")
     */
    private $end;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $customer;

    /**
     * @ORM\Column(type="boolean")
     */
    private $cleaning;

    /**
     * @ORM\Column(type="boolean")
     */
    private $laundry;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $comments;

    /**
     * @ORM\Column(type="boolean")
     */
    private $lbc;

    /**
     * @ORM\Column(type="boolean")
     */
    private $abritel;

    /**
     * @ORM\Column(type="boolean")
     */
    private $direct;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStart(): ?\DateTimeInterface
    {
        return $this->start;
    }

    public function setStart(\DateTimeInterface $start): self
    {
        $this->start = $start;

        return $this;
    }

    public function getEnd(): ?\DateTimeInterface
    {
        return $this->end;
    }

    public function setEnd(\DateTimeInterface $end): self
    {
        $this->end = $end;

        return $this;
    }

    public function getCustomer(): ?string
    {
        return $this->customer;
    }

    public function setCustomer(string $customer): self
    {
        $this->customer = $customer;

        return $this;
    }

    public function getCleaning(): ?bool
    {
        return $this->cleaning;
    }

    public function setCleaning(bool $cleaning): self
    {
        $this->cleaning = $cleaning;

        return $this;
    }

    public function getLaundry(): ?bool
    {
        return $this->laundry;
    }

    public function setLaundry(bool $laundry): self
    {
        $this->laundry = $laundry;

        return $this;
    }

    public function getComments(): ?string
    {
        return $this->comments;
    }

    public function setComments(?string $comments): self
    {
        $this->comments = $comments;

        return $this;
    }

    public function getLbc(): ?bool
    {
        return $this->lbc;
    }

    public function setLbc(bool $lbc): self
    {
        $this->lbc = $lbc;

        return $this;
    }

    public function getAbritel(): ?bool
    {
        return $this->abritel;
    }

    public function setAbritel(bool $abritel): self
    {
        $this->abritel = $abritel;

        return $this;
    }

    public function getDirect(): ?bool
    {
        return $this->direct;
    }

    public function setDirect(bool $direct): self
    {
        $this->direct = $direct;

        return $this;
    }

}
