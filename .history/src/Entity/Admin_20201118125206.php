<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\AdminRepository;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 * attributes={"security"="is_granted('ROLE_ADMIN')"},
 * 
 * collectionOperations={"get","post"},
 * itemOperations={"get", "put", "delete"},
 * 
 * attributes={"pagination_items_per_page"=10}
 * 
 * )
 * @ORM\Entity(repositoryClass=AdminRepository::class)
 */
class Admin extends User
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * 
     */
    private $id;

}
