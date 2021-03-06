<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\AdminRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource(
 * attributes={"security"="is_granted('ROLE_ADMIN')"},
 * 
 * collectionOperations={"get","post"},
 * itemOperations={"get", "put", "delete"},
 * 
 * normalizationContext={"groups"={"admin:read"}},
 * denormalizationContext={"groups"={"admin:write"}},
 * 
 * attributes={"pagination_items_per_page"=10}
 * )
 * @ORM\Entity(repositoryClass=AdminRepository::class)
 */
class Admin extends User
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"profile_user:read", "profile_user:write"})
     */
    private $id;

    public function getId(): ?int
    {
        return $this->id;
    }
}
