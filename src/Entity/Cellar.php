<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\CellarRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CellarRepository::class)]
#[ApiResource(
    collectionOperations: [
        'post' => [
            'openapi_context' => [
                'security' => [['bearerAuth' => []]]
            ]
        ],
        'get' => [
            'security' => '(is_granted("ROLE_ADMIN")) or (object.getOwner() === user)',
            'openapi_context' => [
                'security' => [['bearerAuth' => []]]
            ]
        ]
    ],
    security: 'is_granted("ROLE_USER")'
)]
class Cellar
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'integer')]
    private $ordinateLength;

    #[ORM\Column(type: 'integer')]
    private $abscissaLength;

    #[ORM\ManyToOne(targetEntity: User::class, cascade: ['persist'], inversedBy: 'cellars')]
    #[ORM\JoinColumn(nullable: false)]
    private $owner;

    #[ORM\Column(type: 'datetime_immutable')]
    private $createdAt;

    #[ORM\Column(type: 'datetime_immutable')]
    private $updatedAt;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $name;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOrdinateLength(): ?int
    {
        return $this->ordinateLength;
    }

    public function setOrdinateLength(int $ordinateLength): self
    {
        $this->ordinateLength = $ordinateLength;

        return $this;
    }

    public function getAbscissaLength(): ?int
    {
        return $this->abscissaLength;
    }

    public function setAbscissaLength(int $abscissaLength): self
    {
        $this->abscissaLength = $abscissaLength;

        return $this;
    }

    public function getOwner(): ?User
    {
        return $this->owner;
    }

    public function setOwner(?User $owner): self
    {
        $this->owner = $owner;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeImmutable $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
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
}
