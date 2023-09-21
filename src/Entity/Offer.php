<?php

namespace App\Entity;

use App\Repository\OfferRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OfferRepository::class)]
class Offer
{
  #[ORM\Id]
  #[ORM\GeneratedValue]
  #[ORM\Column]
  private ?int $id = null;

  #[ORM\Column(length: 255)]
  private ?string $title = null;

  #[ORM\Column(type: Types::TEXT)]
  private ?string $content = null;

  #[ORM\Column(type: Types::DATE_MUTABLE)]
  private ?\DateTimeInterface $publicationDate = null;

  #[ORM\ManyToOne(inversedBy: 'offers')]
  #[ORM\JoinColumn(nullable: false)]
  private ?ContractType $contractType = null;

  #[ORM\OneToMany(mappedBy: 'offer', targetEntity: Application::class, orphanRemoval: true)]
  private Collection $applications;

  public function __construct()
  {
      $this->applications = new ArrayCollection();
  }

  public function getId(): ?int
  {
    return $this->id;
  }

  public function getTitle(): ?string
  {
    return $this->title;
  }

  public function setTitle(string $title): static
  {
    $this->title = $title;

    return $this;
  }

  public function getContent(): ?string
  {
    return $this->content;
  }

  public function setContent(string $content): static
  {
    $this->content = $content;

    return $this;
  }

  public function getPublicationDate(): ?\DateTimeInterface
  {
    return $this->publicationDate;
  }

  public function setPublicationDate(\DateTimeInterface $publicationDate): static
  {
    $this->publicationDate = $publicationDate;

    return $this;
  }

  public function getContractType(): ?ContractType
  {
    return $this->contractType;
  }

  public function setContractType(?ContractType $contractType): static
  {
    $this->contractType = $contractType;

    return $this;
  }

  /**
   * @return Collection<int, Application>
   */
  public function getApplications(): Collection
  {
      return $this->applications;
  }

  public function addApplication(Application $application): static
  {
      if (!$this->applications->contains($application)) {
          $this->applications->add($application);
          $application->setOffer($this);
      }

      return $this;
  }

  public function removeApplication(Application $application): static
  {
      if ($this->applications->removeElement($application)) {
          // set the owning side to null (unless already changed)
          if ($application->getOffer() === $this) {
              $application->setOffer(null);
          }
      }

      return $this;
  }
}
