## Setup

### Creating Database

- Create new MySql Database
    - Encoding: utf8mb4
    - Collation: utf8mb4_unicode_ci


### Copy .env.example -> .env
- All keys should be fine to be left the same unless you have a different mysql setup

### php artisan key:generate
### composer install
### php artisan migrate
### Valet/php artisan serve/homestead
- any of these should work fine. just make sure you update APP_URL in .env accordingly

### API Docs

- API Docs will be located at {APP_URL}/docs

### Tests
- phpunit

### Insomnia
- I've included an import file for Insomnia. The JSON file is located here: `insomnia-ping-api-docs.json`
    - You can manage environment and set your base url as well as the bearer token that's you receive after registering a user and authenticating them
