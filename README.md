# ABDELMOUHAIMINE_ELJASSIMI_YOUDEMY
**Youdemy - Plateforme de Formation en Ligne**

**Author du Brief:** *Iliass RAIHANI*.

**Author:** *eljassimi abdelmouhaimine*.

## Links

- **GitHub Repository :** [View on GitHub](https://github.com/Youcode-Classe-E-2024-2025/ABDELMOUHAIMINE_ELJASSIMI_YOUDEMY)
- **UML Use Case :** [View on Lucid Chart](https://lucid.app/lucidchart/57e0c189-9928-4051-a894-d1c214b5d266/edit?viewport_loc=-79%2C6%2C4617%2C2038%2C0_0&invitationId=inv_91290661-4d2e-4730-8542-0552aadc5445)
- **UML Class:** [View on Lucid Chart](https://lucid.app/lucidchart/6e8b78d6-f300-49ff-b824-e193cf2fb1f4/edit?viewport_loc=-1530%2C-1517%2C2993%2C1321%2C0_0&invitationId=inv_a599da62-27f3-4d39-97db-7ba3276955af)


# Configuration et Exécution du Projet

### Prérequis
* **Node.js** et **npm** installés (téléchargez [Node.js](https://nodejs.org/)).
* **Laragon** installé (téléchargez [Laragon](https://laragon.org/download/)).

### Étapes d’installation

1. **Cloner le projet** :
   - Ouvrir un terminal et exécuter :  
     `git clone https://github.com/Youcode-Classe-E-2024-2025/ABDELMOUHAIMINE_ELJASSIMI_YOUDEMY`

2. **Placer le projet dans le dossier Laragon** :
   - Cliquez sur le bouton **Root** dans Laragon pour ouvrir le dossier `www` (par défaut, `C:\laragon\www`).
   - Le chemin de votre projet devrait être `C:\laragon\www\ABDELMOUHAIMINE_ELJASSIMI_YOUDEMY`.

3. **Configurer la base de données** :
   - Faites un click droit sur **Laragon**, puis allez dans **Tools** > **Quick Add** et téléchargez **phpMyAdmin** et **MySQL**.
   - Ouvrir **phpMyAdmin** via Laragon :
     - Dans Laragon, cliquez sur le bouton **Database** pour accéder à phpMyAdmin (username = `root` et mode de passe est vide).
     - La base de données est automatiquement créez ou vous pouvez Créez une base de données `youdemy` et importez le fichier `database.sql` (disponible dans le dossier `/database/`).


4. **Installer les dépendances Node.js** :
   - Ouvrez un terminal dans le dossier du projet cloné.
   - Exécutez :  `npm install` or `npm i`

5. **Configurer Laragon pour le serveur local** :
   - Lancez **Laragon** et démarrez les services **Apache** et **MySQL**,en Clickant sur **Start All**.


6. **Exécuter le projet** :
   - Une fois les services lancés dans Laragon, cliquez sur le bouton **Web** pour accéder à `http://localhost/ABDELMOUHAIMINE_ELJASSIMI_YOUDEMY` dans votre navigateur.



## **Contexte du projet:**

La plateforme de cours en ligne Youdemy vise à révolutionner l’apprentissage en proposant un système interactif et personnalisé pour les étudiants et les enseignants.


### Fonctionnalités principales

​

**Partie Front Office:**

​

*Visiteur:*

    Accès au catalogue des cours avec pagination.
    Recherche de cours par mots-clés.
    Création d’un compte avec le choix du rôle (Étudiant ou Enseignant).

​

*Étudiant:*

    Visualisation du catalogue des cours.
    Recherche et consultation des détails des cours (description, contenu, enseignant, etc.).
    Inscription à un cours après authentification.
    Accès à une section “Mes cours” regroupant les cours rejoints.

​

*Enseignant:*

    Ajout de nouveaux cours avec des détails tels que:
        Titre, description, contenu (vidéo ou document), tags, et catégorie.
    Gestion des cours :
        Modification, suppression et consultation des inscriptions.
    Accès à une section “Statistiques” sur les cours:
        Nombre d’étudiants inscrits, Nombre de cours, etc.

​

**Partie Back Office:**

​

*Administrateur:*

    Validation des comptes enseignants.
    Gestion des utilisateurs :
        Activation, suspension ou suppression.
    Gestion des contenus :
        Cours, catégories et tags.
    Insertion en masse de tags pour gagner en efficacité.
    Accès à des statistiques globales :
        Nombre total de cours, répartition par catégorie, Le cour avec le plus d' étudiants, Les Top 3 enseignants.

​

*Fonctionnalités Transversales:*

​

    Un cours peut contenir plusieurs tags (relation many-to-many).
    Application du concept de polymorphisme dans les méthodes suivantes : Ajouter cours et afficher cours.
    Système d’authentification et d’autorisation pour protéger les routes sensibles.
    Contrôle d’accès : chaque utilisateur ne peut accéder qu’aux fonctionnalités correspondant à son rôle.

​

*Exigences Techniques:*

​

    Respect des principes OOP (encapsulation, héritage, polymorphisme).
    Base de données relationnelle avec gestion des relations (one-to-many, many-to-many).
    Utilisation des sessions PHP pour la gestion des utilisateurs connectés.
    Système de validation des données utilisateur pour garantir la sécurité.

​

*Bonus:*

​

    Recherche avancée avec filtres (catégorie, tags, auteur).
    Statistiques avancées :
        Taux d’engagement par cours, catégories les plus populaires.
    Mise en place d’un système de notification:
        Par exemple, validation de compte enseignant ou inscription confirmée à un cours.
    Implémentation d’un système de commentaires ou d’évaluations sur les cours.
    Génération de certificats PDF de complétion pour les étudiants.
