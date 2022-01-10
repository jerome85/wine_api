<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\WineRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: WineRepository::class)]
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
class Wine
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\Column(type: 'datetime_immutable')]
    private $createdAt;

    #[ORM\Column(type: 'datetime_immutable')]
    private $updatedAt;

    #[ORM\OneToMany(mappedBy: 'wine', targetEntity: Millesime::class, orphanRemoval: true)]
    private $millesimes;

    #[ORM\ManyToOne(targetEntity: Region::class, inversedBy: 'wines')]
    #[ORM\JoinColumn(nullable: false)]
    private $region;

    #[ORM\OneToMany(mappedBy: 'wine', targetEntity: CepageProperty::class, orphanRemoval: true)]
    private $cepageProperties;

    #[ORM\ManyToOne(targetEntity: Category::class, inversedBy: 'Wines')]
    #[ORM\JoinColumn(nullable: false)]
    private $category;

    public function __construct()
    {
        $this->millesimes = new ArrayCollection();
        $this->cepageProperties = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

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

    /**
     * @return Collection|Millesime[]
     */
    public function getMillesimes(): Collection
    {
        return $this->millesimes;
    }

    public function addMillesime(Millesime $millesime): self
    {
        if (!$this->millesimes->contains($millesime)) {
            $this->millesimes[] = $millesime;
            $millesime->setWine($this);
        }

        return $this;
    }

    public function removeMillesime(Millesime $millesime): self
    {
        if ($this->millesimes->removeElement($millesime)) {
            // set the owning side to null (unless already changed)
            if ($millesime->getWine() === $this) {
                $millesime->setWine(null);
            }
        }

        return $this;
    }

    public function getRegion(): ?Region
    {
        return $this->region;
    }

    public function setRegion(?Region $region): self
    {
        $this->region = $region;

        return $this;
    }

    /**
     * @return Collection|CepageProperty[]
     */
    public function getCepageProperties(): Collection
    {
        return $this->cepageProperties;
    }

    public function addCepageProperty(CepageProperty $cepageProperty): self
    {
        if (!$this->cepageProperties->contains($cepageProperty)) {
            $this->cepageProperties[] = $cepageProperty;
            $cepageProperty->setWine($this);
        }

        return $this;
    }

    public function removeCepageProperty(CepageProperty $cepageProperty): self
    {
        if ($this->cepageProperties->removeElement($cepageProperty)) {
            // set the owning side to null (unless already changed)
            if ($cepageProperty->getWine() === $this) {
                $cepageProperty->setWine(null);
            }
        }

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }
}
