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

4. Run the following commands

```
php artisan migrate
php artisan serve
```

5. In another console run the following command

```
npm run watch
```
## Issues

1. SQLSTATE[08006] [7] FATAL: password authentication failed for user frankhesse

**SOLUTION**: Go to C:\Program Files\PostgreSQL\12\data, locate the pg_hba.conf file and edit the following lines:

```
host    all             all             127.0.0.1/32            trust
host    all             all             ::1/128                 trust
host    replication     all             127.0.0.1/32            trust
host    replication     all             ::1/128                 trust
```

This allows replication connections from localhost, the method by default is md5. After making these changes shutdown the server and restart pgAdmin

2. Missing the vendor folder

**SOLUTION**: Run the following command

```
composer update
```

Then, restart pgAdmin and the server.

3. Missing driver

**SOLUTION**: Check your php.ini file and uncomment the following lines

```
;extension=pdo_pgsql
;extension=pgsql
```

## Notes
1. This project has a spanish UI
2. This project includes an ER diagram and a logic design which will be the guide to implement the database

<!-- USAGE EXAMPLES -->
## Usage