# Valorisation des Données Clients

Application web permettant aux commerciaux de rechercher et gérer des informations sur les entreprises clientes, développée avec Laravel, Breeze, Tailwind CSS et Alpine.js.

## 🚀 Fonctionnalités

- Recherche d'entreprises par nom, SIRET ou adresse (style Google)
- Affichage des informations détaillées des entreprises
- Système de commentaires sur les entreprises
- Système de notation des entreprises
- Interface responsive pour une utilisation mobile

## 📋 Prérequis

- PHP 8.2.8
- Composer
- Node.js et NPM
- XAMPP ou WAMP
- MySQL 8.4.1 ou supérieur
- Git

## ⚙️ Installation

1. Clonez le projet
```bash
git clone [URL_DU_REPO]
cd [NOM_DU_PROJET]
```

2. Installez les dépendances PHP
```bash
composer install
```

3. Installez les dépendances Node.js
```bash
npm install
```

4. Configurez l'environnement
```bash
cp .env.example .env
php artisan key:generate
```

5. Configurez votre base de données dans le fichier `.env` avec vos informations de connexion

6. Importez la structure de la base de données avec le fichier SQL fourni

7. Exécutez les migrations si nécessaire
```bash
php artisan migrate
```

## 🚦 Lancement du projet

1. Ouvrez deux terminaux différents

2. Dans le premier terminal, lancez :
```bash
npm run dev
```

3. Dans le second terminal, lancez :
```bash
php artisan serve
```

4. Cliquez sur le lien fourni dans le terminal (généralement http://127.0.0.1:8000) pour accéder à l'application

## 📚 Structure de la Base de Données

### Tables Principales
- `ENTREPRISE` : Stockage des informations des entreprises
  - `ENTREPRISE_ID` (Primary Key)
  - `SIREN`
  - `SIRET_SIEGE`
  - `NOM`

- `COMMENTAIRE` : Gestion des commentaires
  - `COMMENTAIRE_ID` (Primary Key)
  - `USER_ID`
  - `ENTREPRISE_ID`
  - `COMMENTAIRE` (text)

- `NOTE` : Système de notation
  - `NOTE_ID` (Primary Key)
  - `USER_ID`
  - `ENTREPRISE_ID`
  - `NOTE` (smallint)

### Tables de Liaison
- `COMMENTER` : Liaison entre commentaires et entreprises
- `NOTER` : Liaison entre notes et entreprises

### Tables Système
- `users` : Gestion des utilisateurs
- `sessions` : Gestion des sessions
- `migrations` : Suivi des migrations Laravel
- Et autres tables système Laravel

## 🛠️ Technologies utilisées

- **Backend:** Laravel avec Breeze pour l'authentification
- **Frontend:** 
  - Tailwind CSS pour le style
  - Alpine.js pour les interactions dynamiques
  - AJAX pour les requêtes asynchrones

## 🤖 Utilisation d'IA

Ce projet a été développé avec l'aide des outils d'IA suivants :
- Claude - Design et assistance technique
- ChatGPT - Design et assistance technique
- GitHub Copilot - Assistance au développement

## 🌟 Fonctionnalités implémentées

- ✅ Recherche d'entreprises
- ✅ Interface visuelle des commentaires
- ✅ Interface visuelle des notes
- ⚠️ Logique partielle pour les notes et commentaires

## ➕ Améliorations Possibles
  
Gestion des comptes clients :
Création, modification et suppression de comptes utilisateurs avec différents rôles (administrateur, commercial, etc.).
Gestion des droits d'accès aux fonctionnalités en fonction des rôles.
Possibilité pour les utilisateurs de gérer leur profil.

Amélioration du système de notation :
Affichage de la moyenne des notes par entreprise.

Gestion des erreurs :
Mise en place de messages d'erreurs plus explicites pour guider l'utilisateur en cas de problème (par exemple, lors de la soumission d'un formulaire, en cas d'erreur de connexion à la base de données, etc.).
Gestion des erreurs de validation des formulaires.

Pagination :
Ajouter une pagination pour les listes d'entreprises, de commentaires et de notes afin d'améliorer les performances et l'expérience utilisateur lorsque le nombre d'enregistrements est important.

Recherche avancée :
Permettre la recherche par plusieurs critères combinés (par exemple, par nom et par secteur d'activité).

Export des données :
Offrir la possibilité d'exporter les données des entreprises au format CSV ou Excel.

## 📫 Contact

Pour toute question ou suggestion, n'hésitez pas à ouvrir une issue sur le dépôt Git.
