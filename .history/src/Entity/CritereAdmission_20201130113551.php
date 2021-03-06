<?php

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert; 
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\CritereAdmissionRepository;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=CritereAdmissionRepository::class)
 * @ApiResource(
 * 
 * normalizationContext={"groups"={"cri_add:read"}},
 * denormalizationContext={"groups"={"cri_add:write"}},
 * 
 * )
 */
class CritereAdmission
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"cri_add:read", "brief:read", "brief:write"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"cri_add:read", "cri_add:write"})
     * @Assert\NotNull(message = "libelle du Critere Admission aubligatoire")
     */
    private $libelle;

    /**
     * @ORM\ManyToOne(targetEntity=Referentiel::class, inversedBy="crAdmission")
     */
    private $referentiel;

    /**
     * @ORM\Column(type="boolean")
     */
    private $deleted = false;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): self
    {
        $this->libelle = $libelle;

        return $this;
    }

    public function getReferentiel(): ?Referentiel
    {
        return $this->referentiel;
    }

    public function setReferentiel(?Referentiel $referentiel): self
    {
        $this->referentiel = $referentiel;

        return $this;
    }

    public function getDeleted(): ?bool
    {
        return $this->deleted;
    }

    public function setDeleted(bool $deleted): self
    {
        $this->deleted = $deleted;

        return $this;
    }
}
