# docker-amp
Docker environement stack with APACHE, MYSQL, PHP



## Overview

Use **docker-compose**


### Stack Setup

* Apache version: 2.4
* PHP version: 7.1
* MySQL version: 5.7



### Environment Variables

Environment file: `.env`

* `TIME_ZONE`: Time zone, using form PHP and MySQL. 
* `APP_URL`: Url of your web app. Using for CMS/Frameweork like Wordpress, CodeIgniter, etc.
* `HTTP_PORT_EXPOSED`: Exposed port of you're web app.
* `XDEBUG`: Using `1` if you want install xdegub module, otherwise using `0`.
* `MYSQL_PASS`: MySQL root password. It's not safe use this method in production but for development it's acceptable.
* `MYSQL_PORT_EXPOSED`: Used only if you want connetc to database with external client. It's port number used for connetcting with external client like _HeidiSQL_ or _MySQL Workbench_ to create database and tables. Configure external client connetction using _host:127.0.0.1_  and _username:root_ whereas _password_ your `MYSQL_PASS` and _port_ your `MYSQL_PORT_EXPOSED` as in environment file. Don't use 3306 number otherwise it will be impossible to connect with external client. 



### Workspace

Workspace foleder: `web`

This is you WebApp folder. Put here your CMS/Framework/Sources.

For connetcting to databse with Framework or source code use `getenv()` variables (view `index.php` source).

```php
$dbhost = getenv('MYSQL_HOST');
$dbuser = getenv('MYSQL_USER');
$dbpass = getenv('MYSQL_PASS');
```


For install a CMS with wizard setup use:

* **hostname**: `mysql` 
* **database**: _what you created by external client_ 
* **username**: `root` 
* **password**: _the environment variable `MYSQL_PASS` as in environment file_ 
* **port**: `3306` _it's important to declare it!_



### Note

When stack is ready visit `http://localhost`

For show PHP info go to `http://localhost/phpinfo.php`



## Build and Run

Command for build, start, stop and remove the docker stack.

### Build

`docker-compose up -d --build`

### Remove

`docker-compose down`

### Start

`docker-compose start`

### Stop

`docker-compose stop`

