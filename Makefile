PORT ?= 8080

setup: install-env composer-install generate-app-key

start:
	 php artisan serve --host 0.0.0.0 --port=$(PORT)

composer-install:
	composer install

composer-validate:
	composer validate

lint:
	composer exec --verbose phpcs -- --standard=PSR12 app tests

test:
	php artisan test

test-coverage:
	composer exec --verbose phpunit tests -- --coverage-clover build/logs/clover.xml

install-env:
	php -r "file_exists('.env') || copy('.env.example', '.env');"

generate-app-key:
	php artisan key:generate --ansi
