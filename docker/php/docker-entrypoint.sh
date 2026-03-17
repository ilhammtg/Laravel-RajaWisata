#!/bin/sh
set -e

# Install composer dependencies if composer.json exists
if [ -f "composer.json" ]; then
    echo "Checking for composer dependencies..."
    if [ "$APP_ENV" = "production" ]; then
        composer install --optimize-autoloader --no-dev --no-interaction
    else
        composer install --no-interaction
    fi
fi

# Run the CMD
exec "$@"
