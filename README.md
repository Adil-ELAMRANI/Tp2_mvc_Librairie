TP3 - Librairie (Architecture MVC)

📜 Description du projet

Ce projet est une application web de gestion de librairie développée en PHP avec une architecture MVC.
Il permet la gestion des clients, livres et locations, avec un système de connexion sécurisé et une gestion des privilèges utilisateurs (administrateurs & clients).

---

🛠️ Technologies utilisées

Langage : PHP (OOP)
Base de données : MySQL
Framework de template : Twig
Sécurité : Sessions, hachage des mots de passe avec password_hash()
Gestion des routes : Système de routes personnalisé en PHP
Autres : AJAX, Bootstrap, CSS, JavaScript

---

📁 Structure du projet

TP3_Librairie/
│── controllers/         # Gestion des requêtes et logique métier
│── models/              # Classes gérant la base de données
│── views/               # Templates Twig pour l'affichage
│   │── layouts/         # Header, Footer, CSS partagés
│   │── client/          # Pages clients
│   │── livre/           # Pages livres
│   │── location/        # Pages locations
│   │── auth/            # Pages d'authentification
│── routes/              # Définition des routes
│── providers/           # Services auxiliaires (Validation, Auth, View)
│── public/              # Fichiers CSS, JS, images
│── config.php           # Configuration du projet
│── .htaccess            # Réécriture d’URL (Apache)
│── index.php            # Point d’entrée principal
│── composer.json        # Configuration Composer
│── database.sql         # Structure de la base de données
│── README.md            # Documentation du projet

---

⚙️ Installation du projet

1️⃣ Prérequis

XAMPP / WAMP (Apache & MySQL)
Composer (Gestion des dépendances PHP)
Git (Optionnel)
Navigateur Web

2️⃣ Installation

# Cloner le projet
git clone https://github.com/ton-profil-github/TP3_Librairie.git

# Accéder au dossier
cd TP3_Librairie

# Installer les dépendances
composer install

# Importer la base de données
mysql -u root -p < database.sql

3️⃣ Configuration

Modifier config.php avec les informations de connexion MySQL :

define('BASE', '/Tp3_Librairie');
define('ASSET', '/Tp3_Librairie/public/');
define('DB_HOST', 'localhost');
define('DB_NAME', 'librairie');
define('DB_USER', 'root');
define('DB_PASS', '');

4️⃣ Lancer le projet

Démarrer Apache et MySQL avec XAMPP/WAMP.

Accéder au projet via http://localhost/Tp3_Librairie/.

🔐 Authentification & Rôles
-------------------------------------------------------------------
Type d'utilisateur           Email                    Mot de passe
-------------------------------------------------------------------
Administrateur               admin@exemple.com        123456
-------------------------------------------------------------------
Client                       client@exemple.com       123456
-------------------------------------------------------------------

---

🚀 Fonctionnalités principales

✅ Gestion des utilisateurs

Création d’un compte utilisateur
Connexion sécurisée avec password_hash()
Gestion des rôles : Administrateur & Client
Système de session sécurisé

✅ Gestion des clients

Ajouter / Modifier / Supprimer un client
Lister tous les clients

✅ Gestion des livres

Ajouter / Modifier / Supprimer un livre
Afficher la liste des livres

✅ Gestion des locations

Créer une location (client-livre)
Supprimer une location
Voir l’historique des locations

✅ Sécurité & Logs

Vérification des sessions
Journalisation des actions
Système de logs pour les administrateurs

---

🗄️ Base de données

Table user : Gestion des utilisateurs
Table client : Gestion des clients
Table livre : Gestion des livres
Table location : Gestion des emprunts
Table privilege : Gestion des privilèges des utilisateurs

---

📧 Contact
Nom : Adil Mostapha EL AMRANI
Email : c2395866@cmaisonneuve.qc.ca
GitHub : https://github.com/Adil-ELAMRANI/TP3_Librairie.git
webdev : ....