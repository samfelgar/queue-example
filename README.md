# Queue Example

## Prerequisites

Make sure you have Docker configured on your system. That's it!

## Installation

1. Clone this repo to your local machine
2. Run `composer install` to install the project dependencies
   1. If you don't have composer installed, run the following command:

```
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v $(pwd):/var/www/html \
    -w /var/www/html \
    laravelsail/php80-composer:latest \
    composer install --ignore-platform-reqs
```

3. Run `cp .env.example .env`
4. Run `./vendor/bin/sail up -d`
5. Run `./vendor/bin/sail artisan key:generate`
6. Done!

## Running

This project has only three endpoints:

- `/dispatch` - Dispatches a payload with some extra fields
- `/dispatch/raw` - Dispatches a 'raw' payload with fewer data
- `/pop` - Returns the first available job on queue
