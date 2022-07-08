J'espère que ce travail, même s'il n'est pas complet, sera à la hauteur.
J'ai appris beaucoup de choses sur laravel grace à cet accomplissement et je pense que je vais l'utiliser dans mes futurs projets personnels.

Version de Mysql : 8.0.29
Version de PHP : 7.3.21
Version de Laravel : 9.x
librairie HubSpot API : https://github.com/HubSpot/hubspot-api-php

Pour initialiser le projet il faut rentrer ces commandes : 
1. "composer install"
2. "npm install"
3. "cp .env.example .env"
4. Mettre à jour les donnes dans le fichier .env pour connecter la base de données
5. "php artisan key:generate"
6. "php artisan migrate"

7. "npm run watch"
8. "php artisan serv"

Les données sont des données générer aléatoirement, pour ce faire il faut rentrer dans 'Tinger' :
9. "php artisan tinker
10. "App\Models\CompaniesDetails::factory()->count(10)->create()"

Et voila :)