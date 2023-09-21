<?php

namespace App\Entity;

use App\Repository\ApplicationRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ApplicationRepository::class)]
class Application
{
  #[ORM\Id]
  #[ORM\GeneratedValue]
  #[ORM\Column]
  private ?int $id = null;

  #[ORM\Column(length: 255)]
  #[Assert\NotBlank]
  #[Assert\Length(min: 3)]
  private ?string $lastname = null;

  #[ORM\Column(length: 255)]
  #[Assert\NotBlank]
  #[Assert\Length(min: 3)]
  private ?string $firstname = null;

  #[ORM\Column(length: 255)]
  private ?string $city = null;

  #[ORM\Column(length: 255)]
  #[Assert\Email]
  private ?string $email = null;

  #[ORM\ManyToOne(inversedBy: 'applications')]
  #[ORM\JoinColumn(nullable: false)]
  private ?Offer $offer = null;

  public function getId(): ?int
  {
    return $this->id;
  }

  public function getLastname(): ?string
  {
    return $this->lastname;
  }

  public function setLastname(string $lastname): static
  {
    $this->lastname = $lastname;

    return $this;
  }

  public function getFirstname(): ?string
  {
    return $this->firstname;
  }

  public function setFirstname(string $firstname): static
  {
    $this->firstname = $firstname;

    return $this;
  }

  public function getCity(): ?string
  {
    return $this->city;
  }

  public function setCity(string $city): static
  {
    $this->city = $city;

    return $this;
  }

  public function getEmail(): ?string
  {
    return $this->email;
  }

  public function setEmail(string $email): static
  {
    $this->email = $email;

    return $this;
  }

  public function getOffer(): ?Offer
  {
    return $this->offer;
  }

  public function setOffer(?Offer $offer): static
  {
    $this->offer = $offer;

    return $this;
  }
}
