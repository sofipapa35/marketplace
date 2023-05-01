<?php

namespace App\Entity;

use App\Repository\RelativeRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RelativeRepository::class)
 */
class Relative
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Annonce::class, inversedBy="relatives1")
     */
    private $cle1;

    /**
     * @ORM\ManyToOne(targetEntity=Annonce::class, inversedBy="relatives2")
     */
    private $cle2;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCle1(): ?Annonce
    {
        return $this->cle1;
    }

    public function setCle1(?Annonce $cle1): self
    {
        $this->cle1 = $cle1;

        return $this;
    }

    public function getCle2(): ?Annonce
    {
        return $this->cle2;
    }

    public function setCle2(?Annonce $cle2): self
    {
        $this->cle2 = $cle2;

        return $this;
    }
}
