## 🌬️ AsthmaCare - Suivi et Gestion de l'Asthme

## 📖 Présentation
AsthmaCare est une application web complète conçue pour aider les personnes asthmatiques à mieux gérer leur santé respiratoire au quotidien. En tant que développeur et moi-même asthmatique, j'ai créé cette application pour résoudre un problème personnel : le manque d'outils simples et centralisés pour suivre les crises, comprendre les déclencheurs et anticiper les risques environnementaux.

## 🤔 Le problème abordé
L'asthme est une maladie chronique qui affecte des millions de personnes worldwide. Les crises peuvent être déclenchées par divers facteurs environnementaux (pollution, pollen, froid, etc.) et leur suivi est souvent fragmenté entre différents outils ou carnets papier. AsthmaCare centralise toutes ces informations et fournit des insights personnalisés.

## 🛠️ Stack Technique : 

### BACKEND et Framework:
Laravel 10 - Framework PHP robuste et élégant

Sanctum - Authentification API sécurisée

SQLite - Base de données légère et portable (fichier local)

Eloquent ORM - Gestion des données objet-relationnelle

### Frontend et Design:
Blade - Moteur de templating Laravel

TailwindCSS - Framework CSS utilitaire

Alpine.js - Interactivité côté client

Chart.js - Visualisation des données de santé

Leaflet.js - Cartographie interactive

### Base de données
SQLite - Base de données légère et portable (fichier local)

## 🔐 Authentification et Routes :
Sanctum : Gestion des tokens API pour les utilisateurs authentifiés

Breeze : Scaffolding d'authentification (login, register, logout)

Middleware personnalisé : Vérification des sessions et synchronisation

Routes API RESTful : CRUD pour les symptômes, qualité d'air et conseils

Routes Web : Pages dashboard, journal, historique, carte, etc.

## API externes :
OpenWeatherMap Air Pollution - Données qualité de l'air en temps réel

Geolocation API - Localisation de l'utilisateur

## 🚀 Fonctionnalités :
### Fonctionnalités techniques remarquables :
✅ Système d'authentification double (web + API)

✅ Middleware personnalisé pour synchroniser les sessions

✅ Validation de données robuste côté serveur

✅ Gestion des erreurs uniformisée avec formatage JSON

✅ Service Layer pour l'intégration API externe

✅ Vérification email obligatoire

✅ Protection CSRF sur les routes web

### Fonctionnalités utilisateur :
📊 Tableau de bord avec données synthétiques

📝 Journal des symptômes quotidien

📅 Historique des crises et tendances

🗺️ Carte interactive de la qualité de l'air

🌡️ Surveillance environnementale en temps réel

💡 Conseils personnalisés selon le profil

👤 Gestion de profil complète

## 🌐 Structure des Routes : 
### API Routes (protégées par Sanctum)
Qui permettront de connecter une application mobile (Expo/React Native) ou d’autres services, si jamais nous voulons évoluer.

Méthode	  Endpoint	                     Description	                Authentification
POST	  /api/register	                 Création de compte	            Non
POST	  /api/login	                 Connexion	                    Non
POST	  /api/logout	                 Déconnexion	                Oui
GET	      /api/symptomes	             Liste des symptômes	        Oui
POST	  /api/symptomes	             Créer un symptôme	            Oui
GET	      /api/symptomes/{id}	         Afficher un symptôme	        Oui
PUT	      /api/symptomes/{id}	         Mettre à jour un symptôme	    Oui
DELETE	  /api/symptomes/{id}	         Supprimer un symptôme	        Oui
GET	      /api/air-qualites	             Données qualité air	        Oui
POST	  /api/air-qualites	             Créer donnée qualité air	    Oui
GET	      /api/external/air-qualites	 Données externes (OpenWeather)	Oui
GET	      /api/conseils	                 Liste des conseils	            Oui
GET	      /api/conseils-personnalises	 Conseils personnalisés     	Oui

### Web Routes (protégées par auth + verified)
Page	                    Route	            Description	                    Authentification
Page d'accueil	            /Accueil	                                        Non
Fonctionnalités	            /features	        Présentation des features	    Non
À propos	                /about	            Page à propos	                Non
Contact	                    /contact	        Page contact	                Non
Dashboard	                /dashboard	        Tableau de bord principal	    Oui + Verified
Journal	                    /journal	        Suivi quotidien des symptômes	Oui + Verified
Historique	                /historique	        Historique des crises	        Oui + Verified
Carte	                    /carte	            Carte interactive qualité air	Oui + Verified
Qualité air	                /air-qualite	    Détails qualité air	            Oui + Verified
Conseils	                /conseils	        Recommandations santé	        Oui + Verified
Profil	                    /profile	        Gestion du compte utilisateur	Oui + Verified

## 🚀 Installation

### Prérequis : 
PHP 8.2+
Composer
Node.js et npm
MySQL 8.0+

### Étapes d'installation
1. Cloner le projet
git clone https://github.com/mimy-GMC/AsthmaCare.git
cd AsthmaCare

2. Installer les dépendances PHP
composer install

3. Installer les dépendances JavaScript
npm install

4. Configurer l'environnement
cp .env.example .env

5. Générer la clé d'application
php artisan key:generate

6. Configurer l'authentification Sanctum
php artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider"
php artisan migrate

7. Migrer la base de données
php artisan migrate

8. Seeder les données (conseils par défaut)
php artisan db:seed

9. Compiler les assets
npm run build

10. Démarrer le serveur
php artisan serve

11. lancer l'application
npm run dev

## L'application sera accessible sur http://localhost:8000

## 🔑 Configuration de l'Authentification
Après l'installation, assurez-vous de :

1. Configurer les domains Sanctum dans .env :
SANCTUM_STATEFUL_DOMAINS=localhost,127.0.0.1
SESSION_DOMAIN=localhost

2. Vérifier les CORS dans config/cors.php :
'paths' => ['api/*', 'sanctum/csrf-cookie'],
'supports_credentials' => true,

## 🌐 Navigation Web
Inscription : /register → vérification email

Connexion : /login → redirection vers /dashboard

Accès aux fonctionnalités : Toutes les routes protégées après vérification email

## 🔮 Perspectives d'Évolution :

1. Court terme (v1.1) : 
📱 Application mobile React Native/Expo

🔔 Notifications push pour pics de pollution

📄 Export PDF des données santé

📴 Mode hors-ligne partiel

2. Moyen terme (v2.0) :
🏷️ Intégration IoT (capteurs air qualité personnels)

🤖 Intelligence artificielle pour prédiction des crises

👨‍⚕️ Interface médecin-patient

💊 Synchronisation avec objets connectés (inhalateurs intelligents)

3. Long terme (v3.0+) :
👥 Plateforme communautaire (partage anonymisé de données)

🏥 Intégration avec dossiers médicaux électroniques

📊 Analyse comparative régionale/nationale

🎯 Recommandations personnalisées par machine learning

### Évolution technique :

🏗️ Microservices architecture

⚡ Cache Redis pour performances

🧪 Tests unitaires et d'intégration complets

🔄 CI/CD pipeline automatisé

🐳 Déploiement Docker/Kubernetes

🔌 OAuth2 pour connexion via réseaux sociaux

⚠️ Rate limiting avancé sur les API

📡 WebSockets pour notifications temps réel

🔢 API versioning pour maintainabilité

📚 Documentation automatique avec OpenAPI/Swagger

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## 👤 Auteur
Miryam GAKOSSO
GitHub: @mimy-GMC
Email: miryam.gakosso@ynov.com

🙏 Remerciements
- OpenWeatherMap pour leur API gratuite
- La communauté Laravel pour l'excellent framework
- Tous les testeurs et contributeurs bêta

AsthmaCare - Respirez mieux, vivez mieux 🌈