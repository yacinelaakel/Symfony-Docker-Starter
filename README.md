# Pré-requis
- Docker : `sudo apt-get install -y docker.io`
- [git](https://git-scm.com/download/linux) & [git-flow](https://github.com/nvie/gitflow/wiki/Linux)
- Être déclaré comme contributeur à ce _repository_ GIT

# Ports
Les ports utilisés sont :
- le port externe 8000 pour Apache ;
- le port externe 8080 pour PhpMyAdmin.
- le port externe 8001 pour Maildev.
- le port interne 9000 pour PHP ;
- le port interne 3306 pour la base de données ;
Rappel : port externe = port accessible depuis l'hôte (par exemple depuis votre navigateur), port interne = port accessible uniquement par les conteneurs d'un même docker-compose. 
Assurez-vous d'avoir les ports **externe** de libres avant de lancer Docker !

# Étapes d'installation
1. Clonez ce _repository_ dans le dossier de votre choix :
```bash
$ git clone https://github.com/yacinelaakel/Symfony-Docker-Starter.git
```
2. Mettez-vous sur la branche `develop` :
```bash
$ git checkout develop
```
3. Vérifiez que vous avez les derniers _commits_ :
```bash
$ git pull origin develop
```
4. Initialisez le _git-flow_ :
```bash
git flow init -d
```
5. Construisez l'environnement de travail Docker :
```bash
docker-compose build --no-cache
```
6. Lancez l'environnement de travail :
```
$ docker-compose up -d
```
7. Vérifiez que l'environnement est fonctionnel aux URL suivantes :
  - APACHE : http://localhost:8000 ;
  - PHPMYADMIN: http://localhost:8080 ;
  - MAILDEV : http://localhost:8001 ;
8. Connectez-vous à l'environnement ligne de commande :
```bash
# Utilisateurs Windows
> .\go.bat

# Utilisateurs Linux
$ ./go.sh
# ou
$ sudo bash go.sh

# Directement avec la commande Docker
$ docker exec -t -i sf4_php bash
```
9. Vérifiez que vous vous trouvez bien dans le dossier `/home/wwwroot/sf4#`. C'est via cette interface que toutes les commandes en ligne doivent passer (Symfony, Composer, NPM...) **mais pas GIT** _(les commandes GIT doivent être passées directement via votre OS hors du conteneur)_.
8. Mettez à jour les dépendances :
  - Composer :
```bash
> php composer.phar install
# ou
$ composer install
```
  - npm :
```bash
$ npm install
```
9. Générez les _assets_ WebPack Encore :
```
$ npm install @symfony/webpack-encore --save-dev
```
10. Généréz le CSS et le JavaScript :
```bash
$ npm run build
```
11. Chargement des données :
  - chargez les migrations doctrine (évolutions de la structure de base) :
```bash
$ php bin/console doctrine:migrations:migrate
# ou
$ php bin/console doctrine:schema:update --dump-sql
# suivi de (si pas d'erreur)
$ php bin/console doctrine:schema:update -f
```
  - chargez les fixtures :
```bash
$ php bin/console doctrine:fixtures:load # Le drapeau --append est facultatif.
                                         # Les fixtures seront remplies au fur et mesure de la création des
                                         # classes des entités. Ce drapeau sera utile dès que vous créérez
                                         # vos propres fixtures.
```
12. Connectez-vous à l'application http://localhost:8000