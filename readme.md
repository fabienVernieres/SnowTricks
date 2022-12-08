[![Codacy Badge](https://app.codacy.com/project/badge/Grade/bdf55bf93b1342f69e8adfaafb83eb29)](https://www.codacy.com/gh/fabienVernieres/SnowTricks/dashboard?utm_source=github.com&utm_medium=referral&utm_content=fabienVernieres/SnowTricks&utm_campaign=Badge_Grade)

# Projet Symfony SnowTricks

---

Projet de formation : Développez de A à Z le site communautaire SnowTricks

## Table of Contents

1. [Informations générales](#informations-generales)
2. [Technologies](#technologies)
3. [Installation](#installation)
4. [Prise en main](#prise-en-main)

## Informations générales

La démonstration du projet est disponible à cette adresse :
[snowtricks.fabienvernieres.com](https://snowtricks.fabienvernieres.com)

Auteur du projet : fabien Vernières
[fabienvernieres.com](https://fabienvernieres.com)
Date : septembre 2022

## Technologies

Projet réalisé avec le framework Symfony version 6.

Cette application est optimisée pour un serveur PHP 8.0.0

Une base données MYSQL est requise.

Le frontend est réalisé avec le framework Boostrap.

## Installation

Téléchargez le dossier ZIP du code ou cloner le dépôt sur votre périphérique.

```text
git clone https://github.com/fabienVernieres/SnowTricks.git
```

Installer `composer`

[getcomposer.org/download/](https://getcomposer.org/download/)

Puis exécutez la commande suivante:

```text
composer install
```

Créez la base de données de l'application:

```text
php bin/console doctrine:database:create
```

Modifiez le fichier `.env` à la racine du projet afin de permettre la connexion à votre base de données:

```text
DATABASE_URL="mysql://root:password@127.0.0.1:3306/dbname?serverVersion=8"
```

Effectuez une misé à jour de votre base de données:

```text
php bin/console doctrine:migrations:migrate
```

Pour créer un jeu de données:

```text
php bin/console doctrine:fixtures:load
```

Lancer le serveur Symfony:

```text
symfony server:start -d
```

Votre site est maintenant accessible à l'adresse suivante

[https://127.0.0.1:8000](https://127.0.0.1:8000)

## Prise en main

Une fois le projet installé, vous pouvez vous connecter à l'espace d'administration en utilisant le nom d'utilisateur suivant `JIMMY SWEAT` et mot de passe `123456` en suivant le lien `Connexion` dans le menu en haut à droite.
