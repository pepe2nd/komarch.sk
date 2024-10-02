# Slovenská Komora Architektúry (komarch.sk)

This is the web for komarch.sk. It is written in PHP and builds upon the Laravel framework. It uses MySQL as a database, [TNTSearch](https://github.com/teamtnt/tntsearch) for text search functionality, and Redis as transient storage for the job queue.

This readme assumes you will be using containerized services, but you can also run the application without Docker, for example using [Herd](https://herd.laravel.com)—which may be the preferred option for local development. If using Docker, see `docker-compose.yml` for the equivalent setup.

## Prerequisites

- PHP 8.2
- Composer 2
- Node 12 (higher versions don't work)
- Docker (optional, for containerized setup)

If using Herd, ensure the required PHP extensions are enabled and services like MySQL are available.

## First-time Setup

1. Clone the repository.
2. Create `.env` and `.env.testing` files (as copies of `.env.example`).
3. Configure environment variables `DB_PORT`, `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`:
   - in `.env`, use `mysql-development` from `docker-compose.yml` if using Docker.
   - in `.env.testing`, use `mysql-testing` from `docker-compose.yml` if using Docker.
   - If not using Docker, set the database connection parameters based on your local setup.
4. Start your environment:
   - **With Docker**: Run `docker-compose up`.
   - **Without Docker (e.g., Herd)**: Ensure you have MySQL and Redis services running, and connect to your local environment.
5. Run `composer install`.
6. Run `npm install`.
7. Run `php artisan storage:link`.
8. Generate app keys:
   - Run `php artisan key:generate`.
   - Run `php artisan key:generate --env=testing`.
8. Run migrations: `php artisan migrate`.
10. Import search indexes: `php artisan komarch:search:import`.
11. Run `npm run dev` to build frontend assets.

## Development


### Backpack Pro

The web app relies on [Backpack Pro](https://backpackforlaravel.com) for its CMS functionality. Make sure to configure the `auth.json` file with the necessary credentials to access Backpack Pro.

- Create an `auth.json` with credentials for the `backpack/pro` repository. See `auth.json.example` for details.

### General Development Workflow:

- Start services: `docker-compose up` (if using Docker) or start MySQL manually (if using Herd or a local setup).
- Build frontend assets: `npm run dev`.
- Start PHP development server: `php artisan serve` (optional)

## Testing

To run tests, use the following command:

```bash
php artisan test
```

Testing will use the environment configuration from your .env.testing file. Make sure to have a separate database for testing, as migrations will run before tests execute.

### Accessing the 'urad/intranet' database

In order to connect to the 'urad' DB, you'll need to set up a ssh tunnel like this:

```
ssh -N -L 3336:localhost:3336 webumenia.sk
```

Now the database will be reachable at `127.0.0.1:3336` like so:

```
URAD_DATABASE_URL="mysql://user:password@127.0.0.1:3336/intranet_komarch"
```
