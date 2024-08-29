# Addictiz Test

L'application permet aux utilisateurs d'uploader une ou plusieurs images.
Un back-office permet aux administrateurs de visualiser ces images et de les gérer.

## Pré-requis

Php 8
Symfony 6
Docker

## Installation
`composer install`

`npm install`

Copier le .env afin de créer un .env.local

Modifier le mot de passe, le nom de la base de données et le user dans le .env.local afin de connecter la base de données.

Dans la partie AWS :
    - S3_STORAGE_KEY= *Renseigner le nom d'utilisateur*
    - S3_STORAGE_SECRET= *Renseigner le mot de passe d'utilisateur*
    - S3_BUCKET_NAME= *Renseigner le nom du bucket*
    - S3_STORAGE_PREFIX= *Renseigner le prefix (laisser un string vide afin de stocker les    données à la racine du bucket)*
    - APP_UPLOADS_SOURCE= *Renseigner ceci : `uploads.storage.aws`*
    - S3_ENDPOINT= $Renseigner ceci : `http://127.0.0.1:9000`*

Créer la base de données : `php bin/console d:d:c`

Démarrer le serveur : `symfony serve`

Démarrer le docker : `docker-compose up -d`

## Usage

Une fois l'installation terminée, il vous faudra créer le bucket via le dashboard.
Afin d'accéder au dashboard du cloud storage, il vous suffira de cliquer sur l'url suivante : [Dashboard_Cloud_Storage] (https://127.0.0.1:9001) et d'y renseigner l'identifiant et le mot de passe précédemment renseigner dans le .env.local dans la partie AWS.
Ensuite il vous faudra créer un bucket dans l'onglet *Buckets* et y renseigné le nom que vous avez attribué précédemment dans le .env.local dans la partie AWS.

Une fois le serveur lancé, la partie utilisateur se lancera via le lien suivant : [Front_Office](https://127.0.0.1:8000).
N'importe qui pourra upload des images sans devoir être connecté.

Afin d'accéder à la partie back-office, il vous suffira d'accéder au lien suivant : [Back_Office](https://127.0.0.1:8000/back-office) et de vous créer un compte si vous n'en avez pas encore en cliquant sur le lien 'S'inscrire'.

Après votre inscription, vous serez redirigé automatiquement vers le back-office. Vous pourrez accéder à la liste des fichiers uploader, en ajouter de nouveaux, les modifier ainsi que les supprimer.

Si vous avez déjà un compte existant, en accédant au lien suivant : [Back_Office](https://127.0.0.1:8000/back-office), il vous suffira de vous connecter et vous serez redirigé automatiquement vers le back-office.

