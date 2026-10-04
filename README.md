# Stock Manager

Stock Manager est une application web de gestion de stock développée avec PHP, CodeIgniter et MySQL.

L'application permet de gérer les produits, les catégories, les entrées et sorties de stock ainsi que le suivi des mouvements et des alertes.

---

## Présentation

Stock Manager est une application de gestion de stock destinée à faciliter le suivi des produits et des mouvements de stock.

Elle permet de centraliser les informations relatives aux produits et de suivre l'évolution du stock à travers une interface web.

---

## Objectifs du projet

- Gérer les produits
- Gérer les catégories
- Enregistrer les entrées de stock
- Enregistrer les sorties de stock
- Suivre les mouvements de stock
- Gérer les alertes de stock
- Consulter les informations relatives au stock
- Faciliter la gestion quotidienne des produits

---

## Technologies utilisées

- PHP
- CodeIgniter
- MySQL
- HTML5
- CSS3
- JavaScript
- Bootstrap
- Git
- GitHub

---

## Fonctionnalités

### Authentification

- Connexion utilisateur
- Gestion des utilisateurs
- Protection des pages selon l'authentification

### Gestion des produits

- Ajouter un produit
- Modifier un produit
- Supprimer un produit
- Consulter les produits
- Associer un produit à une catégorie

### Gestion du stock

- Enregistrer une entrée de stock
- Enregistrer une sortie de stock
- Consulter les mouvements de stock
- Suivre la quantité disponible

### Gestion des catégories

- Ajouter une catégorie
- Modifier une catégorie
- Supprimer une catégorie
- Consulter les catégories

### Alertes

- Détection des produits avec un stock faible
- Affichage des alertes de stock

### Rapports

- Consultation des informations relatives au stock
- Suivi des mouvements de stock
- Génération et consultation des rapports

---

## Structure du projet

```text
StockManager/
│
├── app/
│   ├── Config/
│   ├── Controllers/
│   │   ├── Auth/
│   │   ├── Login.php
│   │   ├── Dashboard.php
│   │   ├── Product.php
│   │   ├── Stock.php
│   │   └── Report.php
│   │
│   ├── Models/
│   ├── Views/
│   └── Database/
│
├── public/
├── writable/
├── tests/
│
├── migrations/
├── sql/
│   └── stock_manager.sql
│
├── .env
├── .gitignore
├── composer.json
└── README.md
## Installation

### Prérequis

Avant de commencer, assurez-vous d'avoir installé :

- PHP 8.1 ou version supérieure
- Composer
- MySQL
- Apache
- Git
- Laragon ou XAMPP

### 1. Cloner le projet

git clone https://github.com/sergio526Hal/StockManager.git

### 2. Accéder au dossier du projet

cd StockManager

### 3. Installer les dépendances

composer install

### 4. Configurer la base de données

Créer une base de données MySQL nommée :

stock_manager

Puis importer le fichier SQL :

sql/stock_manager.sql

### 5. Configurer la connexion à la base de données

Créer ou modifier le fichier `.env` et renseigner les paramètres suivants :

database.default.hostname = localhost
database.default.database = stock_manager
database.default.username = root
database.default.password =
database.default.DBDriver = MySQLi
database.default.port = 3306

### 6. Lancer l'application

php spark serve

Puis ouvrir l'application dans le navigateur :

http://localhost:8080

---

## Installation avec Laragon

Si le projet est placé dans :

C:\laragon\www\StockManager

Démarrer Laragon puis activer :

- Apache
- MySQL

Ensuite, ouvrir l'application depuis le navigateur.

---

## Base de données

L'application utilise une base de données MySQL.

Les principales tables utilisées sont :

users
categories
products
stock
stock_movements
alerts

Le fichier SQL de la base de données est disponible dans :

sql/stock_manager.sql

---

## Lancement du projet

Pour lancer le serveur de développement CodeIgniter :

php spark serve

L'application sera accessible à l'adresse :

http://localhost:8080

---

## Captures d'écran

Des captures d'écran de l'application peuvent être ajoutées ici afin de présenter l'interface du projet.

### Page de connexion

Ajoutez ici une capture d'écran de la page de connexion.

### Tableau de bord

Ajoutez ici une capture d'écran du tableau de bord.

### Gestion des produits

Ajoutez ici une capture d'écran de la gestion des produits.

### Gestion du stock

Ajoutez ici une capture d'écran de la gestion du stock.

---

## Contexte du projet

Projet universitaire – Licence 3

Formation :

Informatique de Gestion, Génie Logiciel et Intelligence Artificielle

Type de projet :

Application web de gestion de stock

Technologies principales :

PHP, CodeIgniter et MySQL

---

## Auteur

Maminomena Halinirina Sergio

Étudiant en Licence 3 – Informatique

GitHub :

https://github.com/sergio526Hal

---

## Licence

Ce projet a été développé dans le cadre d'un projet universitaire.

Tous droits réservés à l'auteur.
