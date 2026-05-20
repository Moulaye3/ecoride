EcoRide - Plateforme de Covoiturage Écologique
Description du projet
EcoRide est une plateforme de covoiturage écoresponsable qui permet aux utilisateurs de publier, rechercher et réserver des trajets en voiture tout en favorisant les véhicules peu polluants.

 Fonctionnalités principales
 Pour les visiteurs
- Page d'accueil attractive avec présentation de l'entreprise
- Recherche de trajets (ville de départ, arrivée, date)
- Liste des covoiturages disponibles avec filtres
- Vue détaillée d’un trajet

 Pour les utilisateurs inscrits
- Inscription / Connexion
- Gestion du profil
- Ajout et gestion de véhicules
- Publication de trajets
- Réservation de places (gestion des crédits)
- Historique des trajets (conducteur & passager)
- Notation et avis sur les conducteurs

 Rôles avancés
- Employé (Modérateur) : Validation / Refus des avis
- Administrateur : Dashboard statistiques, graphiques, gestion des employés et suspension de comptes

 🛠️ Stack Technique

- Backend : Laravel 11 + PHP 8.2
- Frontend : Blade + Tailwind CSS + Alpine.js
- Base de données : MySQL (relationnelle)
- Authentification : Laravel Breeze
- Autres : Middleware de rôles, Eloquent ORM, Factories & Seeders, Validation

 🚀 Installation locale
1. Cloner le projet
git clone https://github.com/Moulaye3/ecoride.git
cd ecoride

 2. Installer les dépendances
composer install
npm install && npm run dev

 3. Configuration
cp .env.example .env
php artisan key:generate

 4. Base de données
php artisan migrate --seed

 5. Lancement
php artisan serve
