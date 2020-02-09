<h1 align="center">Welcome to messagerie-symfony 👋</h1>

> Little WhatsApp in Symfony, it's an school project.

## Installation

#### Files

```sh
git clone https://github.com/MENT3/messagerie-symfony.git
cd messagerie-symfony
composer install
```

Edit [.env](https://github.com/MENT3/messagerie-symfony/blob/master/.env) at line 32 if you are not working on Mac. Juste change the port

#### Database

To configure the database execute this

```sh
php bin/console doctrine:database:create
php bin/console make:migration
php bin/console doctrine:migrations:migrate
php bin/console doctrine:fixtures:load
```

## Usage

```sh
# On project directory run this
php -S localhost:8080 -t public
```

**And click [here](http://localhost:8080/)**

## Author

👤 **Clément RAMOS LAGE**

* Github: [@MENT3](https://github.com/MENT3)

👤 **Samy LACOMBE**

* Github: [@boite2chocolat](https://github.com/boite2chocolat)

👤 **Victor SEDAROS**

* Github: [@victorsed](https://github.com/victorsed)

## Show your support

Give a ⭐️ if this project helped you!
