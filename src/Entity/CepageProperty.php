<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\CepagePropertyRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CepagePropertyRepository::class)]
#[ApiResource(
    collectionOperations: [
        'get' => [
            'openapi_context' => [
                'security' => [['bearerAuth' => []]]
            ]
        ],
        'post' => [
            'openapi_context' => [
                'security' => [['bearerAuth' => []]]
            ]
        ]
    ],
    itemOperations: [
        'get' => [
            'openapi_context' => [
                'security' => [['bearerAuth' => []]]
            ]
        ],
        'put' => [
            'openapi_context' => [
                'security' => [['bearerAuth' => []]]
            ]
        ],
        'delete' => [
            'openapi_context' => [
                'security' => [['bearerAuth' => []]]
            ]
        ],
    ],
    security: 'is_granted("ROLE_USER")'
)]
class CepageProperty
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\ManyToOne(targetEntity: Cepage::class)]
    #[ORM\JoinColumn(nullable: false)]
    private $cepage;

    #[ORM\Column(type: 'float')]
    private $percent;

    #[ORM\ManyToOne(targetEntity: Wine::class, inversedBy: 'cepageProperties')]
    #[ORM\JoinColumn(nullable: false)]
    private $wine;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCepage(): ?Cepage
    {
        return $this->cepage;
    }

    public function setCepage(?Cepage $cepage): self
    {
        $this->cepage = $cepage;

        return $this;
    }

    public function getPercent(): ?float
    {
        return $this->percent;
    }

    public function setPercent(float $percent): self
    {
        $this->percent = $percent;

        return $this;
    }

    public function getWine(): ?Wine
    {
        return $this->wine;
    }

    public function setWine(?Wine $wine): self
    {
        $this->wine = $wine;

        return $this;
    }
}
