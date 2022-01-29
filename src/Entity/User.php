<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Action\NotFoundAction;
use App\Controller\MeController;
use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Lexik\Bundle\JWTAuthenticationBundle\Security\User\JWTUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\Annotation\Groups;


#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`user`')]
#[ApiResource(
    collectionOperations: [
        'post' => [
            'security' => 'is_granted("IS_AUTHENTICATED_ANONYMOUSLY")'
        ]
    ],
    itemOperations: [
        'get' => [
            'controller' => NotFoundAction::class,
            'openapi_context' => ['summary' => 'hidden'],
            'read' => false,
            'output' => false
        ],
        'me' => [
            'pagination_enabled' => false,
            'path' => '/me',
            'method' => 'get',
            'controller' => MeController::class,
            'read' => false,
            'openapi_context' => [
                'security' => [['bearerAuth' => []]]
            ]
        ]
    ],
    normalizationContext: ['groups' => ['read:User']],
    security: 'is_granted("ROLE_USER")'
)]
class User implements UserInterface, JWTUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    #[Groups(['read:User'])]
    private $id;

    #[ORM\Column(type: 'string', length: 180, unique: true)]
    #[Groups(['read:User'])]
    private ?string $email;

    #[ORM\Column(type: 'json')]
    #[Groups(['read:User'])]
    private array $roles = [];

    #[ORM\Column(type: 'string')]
    private string $password;

    #[ORM\OneToMany(mappedBy: 'owner', targetEntity: Cellar::class, orphanRemoval: true)]
    private $cellars;

    public function __construct()
    {
        $this->cellars = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @deprecated since Symfony 5.3, use getUserIdentifier instead
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Returning a salt is only needed, if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public static function createFromPayload($username, array $payload)
    {
        return (new User())->setId($payload['id'])->setEmail($username ?? '');
    }

    /**
     * @return Collection|Cellar[]
     */
    public function getCellars(): Collection
    {
        return $this->cellars;
    }

    public function addCellar(Cellar $cellar): self
    {
        if (!$this->cellars->contains($cellar)) {
            $this->cellars[] = $cellar;
            $cellar->setOwner($this);
        }

        return $this;
    }

    public function removeCellar(Cellar $cellar): self
    {
        if ($this->cellars->removeElement($cellar)) {
            // set the owning side to null (unless already changed)
            if ($cellar->getOwner() === $this) {
                $cellar->setOwner(null);
            }
        }

        return $this;
    }
}
