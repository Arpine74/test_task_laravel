# Test Back

## Installation

Use the package manager [composer](https://getcomposer.org/) to install project.

```bash
 composer install
```

- Copy .env.example file to .env on the root folder. You can type **copy .env.example .env** if using command prompt Windows or **cp .env.example .env** if using terminal, Ubuntu.

- Open your .env file and change the database name (DB_DATABASE) to whatever you have, username (DB_USERNAME) and password (DB_PASSWORD) field correspond to your configuration.

```bash
 php artisan key:generate
 php artisan migrate
```

## Run Project

```bash
 php artisan serve
```