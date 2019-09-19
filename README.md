# Popup!

projet 3wa :

La banque d'image socialement connectée.

##########################################################################################################################

1/ Paramètrer le fichier "Configuration(àModifier).class.php" avec vos identifiant/mot de passe de connexion 
à votre serveur local/distant, et le renommer "Configuration.class.php".

2/ Créer la base de donnée en important le fichier "dbPopup.sql" (structure de la table sans les données).

3/ Créer manuellement un administrateur dans la table de données correspondante (Administrateurs.sql) et 
penser à crypter le mot de passe (password_hash).

4/ utiliser le site et partager des photos en haute qualité (jusqu'à 15Mo). 

Attention, généralement la configuration de PHP sur un serveur local a des performances limitées, pouvant être 
très inférieures que sur un serveur distant. 
Dans ce cas, il peut être intéressant de configurer un fichier .htaccess ou l'on modifie localement certaines 
caractéristiques (ex: post_max-size, upload_max_filesize, etc. ), à placer à l'endroit concerné pour l'execution du 
traitement de fichier par php (upload d'un fichier volumineux, création de thumbnails à la volée, etc...).

5/ L'administrateur doit se connecter pour vérifier que les photos partagées par les utilisateurs sont appropriées.
L'administrateur doit choisir la catégorie, la date de publication, et de publier la photo sur le site ou de la supprimer 
du serveur.


##########################################################################################################################


Info : L'objectif était de réaliser un site de partage de photos en haute qualité, en se concentrant principalement 
sur les langages standards sans l'utilisation de framework ou librairie. 

La fonctionnalité principale, l'upload de photo, a été réalisée en JavaScript standard, sans l'utilisation de librairie tel 
que JQUERY ou autres.

JQUERY a été utilisé pour l'affichage des photos grâce au pluggin Masonry, ainsi que pour le pluggin Infinite-scroll qui 
permet de charger automatiquement la page suivante lorsque le scroll arrive en bas de page.

Il y a plusieurs axes d'améliorations possible : 
- la possibilité de liker une photo, la commenter, créer des collections. 
- Ajouter des tags permettant d'améliorer le système de catégories. 
- Ajouter un système de recherche de photos par mots-clés/tags.
- Ajouter la possibilité de connecter différents réseaux sociaux.
- Surement beaucoups d'autres...
