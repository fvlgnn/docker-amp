# docker-amp

A small local development stack with Apache 2.4, PHP 8.4 (FPM), and MariaDB 11.4.

> This project is intended for development. Review credentials, TLS, access controls,
> image pinning, backups, and resource limits before adapting it for production.

## Requirements

- Docker Engine or Docker Desktop with Docker Compose v2 (`docker compose`)
- GNU Make (optional)

## Quick start

```sh
cp .env.example .env
# Change DB_ROOTPASS and DB_PASS in .env
docker compose config
docker compose up -d --build
```

Open <http://localhost:8080> (or the port configured with
`HTTP_PORT_EXPOSED`). Follow the logs with `docker compose logs -f`.

The application source is bind-mounted from `src/`. The database is persisted
in `db/`, which is ignored by Git.

## Configuration

| Variable | Purpose | Example |
| --- | --- | --- |
| `XDEBUG` | Build the PHP image with Xdebug (`0` or `1`) | `0` |
| `COMPOSER` | Build the PHP image with Composer (`0` or `1`) | `0` |
| `TIME_ZONE` | MariaDB container time zone | `Europe/Rome` |
| `WEBAPP_URL` | URL exposed to the sample application | `http://localhost:8080/` |
| `HTTP_PORT_EXPOSED` | Apache port on the host | `8080` |
| `DB_PORT_EXPOSED` | MariaDB port on localhost | `3306` |
| `DB_ROOTPASS` | MariaDB root password | required |
| `DB_USER` | Application database user | `dbuser` |
| `DB_PASS` | Application database password | required |
| `DB_NAME` | Application database | `dbapp` |

Containers communicate through Compose DNS. Application code must connect to
host `db`, port `3306`; `DB_PORT_EXPOSED` is only for database clients running
on the host. The database port is bound to `127.0.0.1` and is not exposed on
all network interfaces.

## SQL initialization

To initialize a new database from SQL files, uncomment this mount in
`docker-compose.yml`:

```yaml
- ./docker/mariadb/init:/docker-entrypoint-initdb.d:ro
```

Initialization scripts run only when `db/` is empty. Existing data is never
reinitialized. Put files in the directory using lexical ordering (for example,
`000-operations.sql`, a dump, and `zzz-operations.sql`).

## Commands

```text
make install    Build and start the stack
make start      Start existing containers
make stop       Stop containers
make remove     Remove containers and the network, preserving database data
make purge      Remove containers and delete the contents of db/
make validate   Validate the resolved Compose configuration
make bash-db    Open a shell in the database container
make bash-php   Open a shell in the PHP container
make bash-web   Open a shell in the Apache container
```

The equivalent Compose commands are `docker compose up -d --build`,
`docker compose down`, `docker compose start`, `docker compose stop`, and
`docker compose config`.

## Security notes

- `.env` is ignored; commit only `.env.example` with placeholder credentials.
- PHP-FPM port 9000 remains internal because FastCGI must not be published.
- Apache and PHP logs are written to container stdout/stderr.
- Directory listing and the public `phpinfo()` page are disabled/removed.
- The sample page is diagnostic code, not a production application.
