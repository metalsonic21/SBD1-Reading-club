<!-- PROJECT LOGO -->
<br />
<p align="center">
  <h3 align="center">Reading Club</h3>

  <p align="center">
    Organize meetings to discuss any book in less than a second
    <br />
    <a href="https://github.com/iSlidex/SBD1-Reading-club/tree/master/Docs"><strong>Explore the docs »</strong></a>
    <br />
  </p>
</p>



<!-- TABLE OF CONTENTS -->
## Table of Contents

- [Table of Contents](#table-of-contents)
- [About The Project](#about-the-project)
  - [Built With](#built-with)
- [Getting Started](#getting-started)
  - [Prerequisites](#prerequisites)
  - [Installation](#installation)
- [Notes](#notes)
- [Usage](#usage)



<!-- ABOUT THE PROJECT -->
## About The Project

This project uses an OLTP relational database that automates the following business processes:

1. Club administration: (includes associations with other clubs): Reading clubs management, member's maintenance (payment control) and books management
2. Meetings administration: Manage the monthly calendar of reunions, book picking, and moderator's assignation, assistance control and discussions
3. Planning and execution of acted presentations (includes cast), manage the monthly calendar of presentations and actors or presentations ratings


### Built With

* [Laravel 6](https://laravel.com/docs/6.x#installing-laravel)
* [PostgreSQL 12](https://www.enterprisedb.com/downloads/postgres-postgresql-downloads)
* [Bootstrap 4](https://getbootstrap.com/docs/4.3/getting-started/download/)
* [Vue JS](https://vuejs.org/v2/guide/installation.html)



<!-- GETTING STARTED -->
## Getting Started

To get a local copy up and running follow these simple steps.

### Prerequisites

  1. [PHP 7](https://windows.php.net/download#php-7.3)
  2. [Laravel 6](https://laravel.com/docs/6.x#installing-laravel)
  3. [PostgreSQL 12](https://www.enterprisedb.com/downloads/postgres-postgresql-downloads)
  4. [pgAdmin4](https://www.pgadmin.org/download/pgadmin-4-windows/)
  5. [Node js](https://nodejs.org/es/)


### Installation

**Windows**

1. In the project folder run the following commands on cmd

```
composer install
npm install
```

2. Create a PostgreSQL user with the following credentials
```
Username: FrankHesse
Password: metalsonic21
```

3. Under that user create a database called `ReadingClub`

4. Create a .env file in the root directory with the following content
```
APP_NAME=Laravel
APP_ENV=local
APP_KEY=base64:ZDZqmToVmeBLfsxk/G7FKtDmYerfiT36fmOhgqzWN54=
APP_DEBUG=true
APP_URL=http://localhost

LOG_CHANNEL=stack

DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=ReadingClub
DB_USERNAME=FrankHesse
DB_PASSWORD=metalsonic21

BROADCAST_DRIVER=log
CACHE_DRIVER=file
QUEUE_CONNECTION=sync
SESSION_DRIVER=file
SESSION_LIFETIME=120

REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

MAIL_DRIVER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null

AWS_ACCESS_KEY_ID=
AWS_SECRET_ACCESS_KEY=
AWS_DEFAULT_REGION=us-east-1
AWS_BUCKET=

PUSHER_APP_ID=
PUSHER_APP_KEY=
PUSHER_APP_SECRET=
PUSHER_APP_CLUSTER=mt1

MIX_PUSHER_APP_KEY="${PUSHER_APP_KEY}"
MIX_PUSHER_APP_CLUSTER="${PUSHER_APP_CLUSTER}"

```

5. Run the following commands

```
php artisan migrate
php artisan serve
```

6. In another console run the following command

```
npm run watch
```
 

## Notes
1. This project has a spanish UI
2. This project includes an ER diagram and a logic design which will be the guide to implement the database

<!-- USAGE EXAMPLES -->
## Usage
