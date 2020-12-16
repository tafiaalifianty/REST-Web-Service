<h2 align="center">Bus Ticket REST API</h2>

<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://media.tenor.com/images/f561a6ff8de9dac6fe8af073360538c8/tenor.gif" width="400"></a></p>

<p align="center">
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://bus-ticket-rest-api.herokuapp.com/"><img src="https://heroku-badges.herokuapp.com/?app=bus-ticket-rest-api" alt="License"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Must Read
Saat mencoba Web Service yang sudah dideploy pada https://bus-ticket-rest-api.herokuapp.com/ mohon saat akan mencoba bagian yang membutuhkan ID Member atau User ID untuk melihat berapa User ID yang didapatkan dengan Send Request via Postman karena pada Interface tidak ditampilkan berapa User ID atau ID Member yang didapatkan dari tiap User.

## About

Bus Ticket RESTful API was developed for complete an assignment. This project was created using Laravel Framework with some add-ons like:

- JWT Authentication
- Swagger API Documentation
- Docker


## Documentation

This is the API documentation of this project:

1. Postman: <a href="https://documenter.getpostman.com/view/6501660/TVmHFfUH" target="__blank">click here</a>
2. Swagger: 
- Development: `http://localhost:8000/api/documentation`
- Live: <a href="https://bus-ticket-rest-api.herokuapp.com/api/documentation" target="__blank">click here</a>


## Prerequisites

Before you run this project in your local computer, you need to install some applications:

- Docker => `^v19.x.x` 
- Docker Compose => `^v1.26.x`


## Installation

If you want to run this project, you can follow the instructions below:

1. You need to clone the repository `$ git clone https://github.com/tafiaalifianty/REST-Web-Service.git web-service`
2. Get inside the directory `$ cd web-service`
3. Run the docker compose `$ docker-compose up -d`
4. Check the docker is running or not like below using `$ docker ps`

```
CONTAINER ID        IMAGE                  COMMAND                  CREATED             STATUS              PORTS                              NAMES
13f9c08525f4        digitalocean.com/php   "docker-php-entrypoi…"   7 hours ago         Up 7 hours          8000/tcp, 9000/tcp                 app
bd50f1caa8fd        nginx:alpine           "/docker-entrypoint.…"   7 hours ago         Up 7 hours          0.0.0.0:8000->80/tcp               webserver
7e901fe7421a        mysql:5.7.22           "docker-entrypoint.s…"   7 hours ago         Up 7 hours          3306/tcp, 0.0.0.0:3307->3307/tcp   db
```

5. Generate new key `$ docker-compose exec app php artisan key:generate`
6. Generate JWT secret key `$ docker-compose exec app php artisan jwt:secret`
7. Clear the config cache `$ docker-compose exec app php artisan config:clear`
8. Migrate the database `$ docker-compose exec app php artisan migrate`
9.  Done, you can check `http://localhost:8000` in your browser
10. If it's show Laravel Homepage, it's work!


## Generate Swagger Documentation

If you want to generate or re-generate the swagger documentation, you can use this command:

```
$ docker-compose exec app php artisan l5-swagger:generate
```


## Deploy to Heroku

If you want to deploy this project to Heroku, you can follow the instructions below:

### Create New App

1. Login to Heroku Dashboard (<a href="https://dashboard.heroku.com/" target="__blank">click here</a>)
2. Create new app
3. Go to Deploy page
4. In Deployment Method, choose GitHub
5. Connect to your GitHub account and repository
6. In Manual Deploy, click branch master and click Deploy Branch
7. If everything's ok, it'll work


### Add MySQL Database

1. Go to Resources page
2. In Add-ons search box, type `mysql` and choose ClearDB MySQL
3. Order pop up will shown, select Ignite (Free) and click Order
4. Done, you've added MySQL to your Heroku App

<strong>NOTE:</strong> You need to add credit card to your Heroku Account.


### Configure Heroku App

After deploy and add MySQL to your Heroku App, you need to configure the app. Because the environment variables in `.env` was set to default value from `.env.example`. So, we need to set the environment variable in Heroku App.

1. Go to Settings page
2. In Config Vars, click Reveal Config Vars
3. Add all environment variable from `.env` to Config Vars (ex: `APP_NAME` is the key and `Laravel` is the value)
4. If you confused with the value of the environment variables, you can see the example below
5. If you've set all environment variables to Config Vars, we need to clear the cache. Scroll up until you see More button, click that, and click Run Console
6. Type this command `php artisan config:clear` and click Run

<strong>NOTE:</strong> For `DB_HOST`, `DB_DATABASE`, `DB_USERNAME`, and `DB_PASSWORD`, you need see below:

1. See the `CLEARDB_DATABASE_URL` value (click the pencil icon to see more detail).
2. For example the value is like this:

```
mysql://ba788ac49d691d:f2e3396d@us-cdbr-east-02.cleardb.com/heroku_6a082a7fe8788e3?reconnect=true
```

3. Okay, this is the breakdown of that value:
- `DB_HOST`: `us-cdbr-east-02.cleardb.com`
- `DB_USERNAME`: `ba788ac49d691d`
- `DB_PASSWORD`: `f2e3396d`
- `DB_DATABASE`: `heroku_6a082a7fe8788e3`

4. So, there are the values for `DB_HOST`, `DB_USERNAME`, `DB_PASSWORD`, and `DB_DATABASE`.


### Migrate Database in Heroku

1. After all Config Vars was set, you can scroll up until you see More button in right top of the page
2. Click the button and click Run Console
3. Type `php artisan migrate` and click Run
4. Done, you've migrate it to your MySQL Database in Heroku App


### Done

Okay, if you have follow all the instructions above, your Heroku App was live and can be used publicly.


## Environment

### Production

```
APP_NAME=BusTicket
APP_ENV=production
APP_KEY=base64:gr9Dr9ud+7pDTd8wfNfe2YfMvlREaF6TwSf83efTfHs=
APP_DEBUG=false
APP_URL=https://bus-ticket-rest-api.herokuapp.com

...

...

DB_CONNECTION=mysql
DB_HOST=us-cdbr-east-02.cleardb.com
DB_PORT=3306
DB_DATABASE=heroku_6a082a7fe8788e3
DB_USERNAME=ba788ac49d691d
DB_PASSWORD=f2e3396d

...

...

JWT_SECRET=HpDp9GKfcqs2bIzQBCJdAGxtOUkmwHZV2J9sO8tOrR2xn8WqKJ5to3M4v3wIWkTM

L5_SWAGGER_CONST_HOST=https://bus-ticket-rest-api.herokuapp.com/api/v1
L5_SWAGGER_GENERATE_ALWAYS=true
L5_SWAGGER_GENERATE_YAML_COPY=true
```

### Development

```
APP_NAME=BusTicket
APP_ENV=local
APP_KEY=base64:gr9Dr9ud+7pDTd8wfNfe2YfMvlREaF6TwSf83efTfHs=
APP_DEBUG=true
APP_URL=http://localhost

...

...

DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=bus-ticket
DB_USERNAME=root
DB_PASSWORD=secret123456

...

...

JWT_SECRET=HpDp9GKfcqs2bIzQBCJdAGxtOUkmwHZV2J9sO8tOrR2xn8WqKJ5to3M4v3wIWkTM

L5_SWAGGER_CONST_HOST=http://localhost:8000/api/v1
L5_SWAGGER_GENERATE_ALWAYS=true
L5_SWAGGER_GENERATE_YAML_COPY=true
```


## License

&copy; 2020 All rights reserved.
This project is [MIT](https://choosealicense.com/licenses/mit/) licensed.
