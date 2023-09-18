<?php

namespace App\DataFixtures;

use App\Entity\ContractType;
use App\Entity\Offer;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class AppFixtures extends Fixture
{
  private const CONTRACT_TYPES = ["CDI", "CDD", "Intérim"];
  private const NB_OFFERS = 50;

  public function load(ObjectManager $manager): void
  {
    $faker = Factory::create('fr_FR');

    $contractTypes = [];

    foreach (self::CONTRACT_TYPES as $contractTypeName) {
      $contractType = new ContractType();
      $contractType->setName($contractTypeName);
      $manager->persist($contractType);
      $contractTypes[] = $contractType;
    }

    for ($i = 0; $i < self::NB_OFFERS; $i++) {
      $offer = new Offer();
      $offer
        ->setTitle($faker->jobTitle())
        ->setContent($faker->realText(500))
        ->setPublicationDate($faker->dateTimeBetween('-1 year'))
        ->setContractType($faker->randomElement($contractTypes));

      $manager->persist($offer);
    }

    $manager->flush();
  }
}
