# Projet S5 : Développement d’un site web de gestion de fiches académiques

Lors de ce projet en tant qu’étudiants en Licence Professionnelle DASI, notre objectif était de réaliser un site web en PHP, permettant à des étudiants 
de gérer des fiches personnelles concernant leur parcours académique.

Technologies utilisées: `PHP`, `HTML5`, `CSS3`, `Bootstrap`

## Conception 

### Diagramme de classe
![dg](https://user-images.githubusercontent.com/74917307/182885489-130e136e-a221-40d7-baa5-89efc54bb3bd.png)

Concernant le code du site web, nous avons créé une classe “DB” qui gère tout ce qui est relatif avec la base de donnée, 
nous avons aussi deux objets PHP qui sont “Fiche Académique” et “Étudiant” qui servent à collecter les données et alléger le code. 

Grâce à ses objets et à la classe DB, aucune requête n’est présente dans le code, il suffit d’appeler les différentes méthodes créées dans la classe ‘DB’ et dans les objets 
“Fiche Académique” et “Étudiant”, comme nous pouvons le voir dans le diagramme de classe ci-dessus.

Concernant l’insertion des images de profil de chaque utilisateur, nous avons choisi d’héberger dans la base de données seulement le chemin d’accès à l’image. 
Nous avons également renommé chaque  image à l’aide d’un nom généré aléatoirement pour éviter que que plusieurs photos aient le même nom et s’écrasent.

## Fonctionnement de l'application

![schema](https://user-images.githubusercontent.com/74917307/182884985-a50d8097-07b8-40a1-ac30-4d9599c2abdb.png)

Notre site web fonctionne avec une classe, une base de données composée de deux tables, Étudiant et Fiche et de 6 pages sur lesquelles l’utilisateur peut naviguer.

Nos fichier se sépare en 5 catégories : 
  - Un dossier classe qui contient les fichiers .inc qui fonctionne avec la classe DB
  - Les fichiers nommés avec la nomenclature _verification qui servent pour les vérifications des formulaires de connexion et d’inscription.
  - Les autres fichier sont les pages sur lesquelles les utilisateurs peuvent naviguer	
  - Un dossier css qui contient tout le style des pages du site web
  - Un dossier image qui contient les photos de profil de tous les utilisateurs
  - Un dossier js qui contient les fichiers javascripts

### Les fonctionnalités de l’application
  - Un utilisateur peut se connecter à l’aide de son adresse email ainsi que de son mot de passe.
  - Un utilisateur peut s’inscrire
  - Un utilisateur peut accéder à sa page de profil
  - Un utilisateur peut Ajouter une ou plusieurs fiches académiques
  - Un utilisateur peut Supprimer/Modifier une ou plusieurs fiches académiques
  - Un utilisateur peut consulter l’ensemble de ses fiches académiques ainsi que les trier par date de début/ date de fin, formation, niveau, nom d’établissement


## Présentation

### Page de connexion

![connexion](https://user-images.githubusercontent.com/74917307/182883610-52304c2e-bfb1-417f-af55-29ddb604d2f6.PNG)

### Page inscription

![inscription](https://user-images.githubusercontent.com/74917307/182883719-9140d8ac-efef-45a7-9d5a-17f4e43a2135.PNG)

### Page de profil

![todoP](https://user-images.githubusercontent.com/74917307/182883094-d6a327da-1b07-41cf-8ae6-d10c1390d20c.PNG)

### Ajout d'une fiche 

![AddFiche](https://user-images.githubusercontent.com/74917307/182884385-364f7697-250a-4076-8c75-252c2e5048f3.PNG)

### Visuel des fiches acadèmiques

![visuF](https://user-images.githubusercontent.com/74917307/182883050-76d18a20-987b-4e04-aba8-62c3bdca6f51.PNG)

![visuHover](https://user-images.githubusercontent.com/74917307/182883071-7a148922-b271-4b98-88f9-505d6d1b50b2.PNG)
