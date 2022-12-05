[![Codacy Badge](https://app.codacy.com/project/badge/Grade/bdf55bf93b1342f69e8adfaafb83eb29)](https://www.codacy.com/gh/fabienVernieres/SnowTricks/dashboard?utm_source=github.com&utm_medium=referral&utm_content=fabienVernieres/SnowTricks&utm_campaign=Badge_Grade)

# Projet Symfony

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
Date : novembre 2022

## Technologies

Cette application est optimisée pour PHP 8.1.12

Une base données MYSQL est requise.

Cette application utilise le framework Symfony.

Le frontend est réalisé avec le framework Boostrap.

## Installation

Téléchargez le dossier ZIP du code ou cloner le dépôt sur votre périphérique.

```text
#Le contenu sera directement téléchargé dans le répertoire projet

git clone https://github.com/fabienVernieres/SnowTricks.git projet

#Le contenu sera téléchargé dans le dossier où vous vous situez

git clone https://github.com/fabienVernieres/SnowTricks.git .
```

Faîtes une copie du fichier `.env` à la racine du projet nommée `.env.local`. Configurez vos variables d'environnement tel que la connexion à la base de données ou votre serveur SMTP ou adresse mail.

```text
DATABASE_URL="mysql://root:password@127.0.0.1:3306/dbname?serverVersion=8"
```

Il est également nécessaire d'installer `composer` sur le serveur. Un fichier `composer.json` comportant les dépendances nécessaires est disponible à la racine du projet.

Tapez ensuite la commande suivante sur votre terminal:

```text
composer install
```

## Prise en main

Création de la base de données avec la commande suivante:

```text
php bin/console doctrine:database:create
```

Mise à jour de la base de données:

```text
php bin/console doctrine:migrations:migrate
```

Chargement d'un jeu de données test :

```text
php bin/console doctrine:fixtures:load
```

Lancement du serveur Symfony:

```text
symfony server:start -d
```

Le site est maintenant accessible à l'adresse: localhost:8000
