# Astrology project


###### Prerequisite
docker and docker-compose


###### Instalation
 1. Run             `cp .env.example .env` 
 2. Run             `docker-compose up -d`
 3. Run composer    `docker-compose exec app composer install`
 4. Run migrations  `docker-compose exec app php artisan migrate`
 5. Run seeders     `docker-compose exec app php artisan db:seed`
 
 If on step 4 you don't have database, do this:
 1. `docker-compose exec db /bin/sh`
 2. `mysql -u root -psecret`
 2. `create schema homestead;`
 3. `exit` 
 
###### Postman Public Link
https://www.getpostman.com/collections/0b3f4bf3a8b979e24f0c
