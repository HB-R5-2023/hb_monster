# Site d'offres d'emploi

## Points abordés

### Démarrage d'un projet

```bash
symfony new hb_monster --version=5.4 --webapp
```

### Création d'une entité

[Entité `Offer`](src/Entity/Offer.php)

### Création d'une relation `OneToMany`

[Entité `ContractType`](src/Entity/ContractType.php)

> `OneToMany`, dans ce cas, signifie "One ContractType To Many Offers"

### Création des fixtures

Avec le package ayant pour alias `orm-fixtures`, création d'un ensemble de données regroupant les types de contrats et les offres.

Fichier : [`AppFixtures.php`](src/DataFixtures/AppFixtures.php)

Utilisation de la librairie [Faker](https://fakerphp.github.io/)

### Affichage d'une liste d'offres

Pour afficher les offres, on **type-hinte** la classe [`OfferRepository`](src/Repository/OfferRepository.php) dans le contrôleur [`IndexController`](src/Controller/IndexController.php)

Symfony gère alors **l'injection** de ce service dans notre contrôleur.

Nous pouvons donc consommer les méthodes que nous propose cette classe. N'importe quelle classe de Repository propose une API adaptée pour lire de la donnée dans une table : `find`, `findAll`, `findBy`, etc...
