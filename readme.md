# URL Shortener API

Welcome to my URL shortener api.

## Prerequsites

I use [Docker](https://www.docker.com/products/docker) to administer this test.

### Technology

- PHP > 7.0.
- NGINX web server
- Postgres database
    - Postgres connection details:
        - host: `postgres`
        - port: `5432`
        - dbname: `urlshortener`
        - username: `urlshortener`
        - password: `urlshortener`

## Instructions - dev environment

1) Clone this repository.

2) Install and run by script (OR go to step 3)

```
sh install.sh
sh run.sh
```

3) Follow these instructions (if you don't want to run the shell scripts above):

- Copy `config.env.example` to a new file called: `config.env`
- Configure the ENV params into `config.env` file, primarily the `API_URL="http://192.168.150.100/"`
- Up the docker containers: `docker-compose up -d`
- Go to workspace container to run install commands: `docker-compose exec workspace bash`
    - Inside `workspace` container, run:
        - `composer install`
        - `vendor/bin/doctrine orm:schema-tool:update --force`
        - `vendor/bin/doctrine orm:generate-proxies`

**Important:**

If you want to up just the postgres container, run: `docker-compose up -d postgres`.

If you want to up all the containers except postgres, run: `docker-compose up -d nginx php-fpm`

### API Endpoints

| Method      | URL                 | Description            |
| ---         | ---                 | ---                    |
| GET         | `/urls/{hash}'      | Redirect short url     |
| GET         | `/stats'            | Get stats of all urls  |
| GET         | `/stats/{id}'       | Get stats of one url   |
| DELETE      | `/urls/{id}'        | Delete one url         |
| POST        | `/users/{id}/urls'  | Create one url by user |
| GET         | `/users/{id}/stats' | Get stats of user urls |
| POST        | `/users'            | Create an user         |
| DELETE      | `/users/{id}'       | Delete an user         |

---

## Interesting

Check for PSR2 standard running:

```
docker-compose exec workspace bash
vendor/bin/phpcs resources src --standard=PSR2
```

Thank you!
