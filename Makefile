PORT ?= 8000

start: start-server
setup: install install-env

start-server:
	 php artisan serve --port=$(PORT)

install:
	composer install

validate:
	composer validate

lint:
	composer exec --verbose phpcs -- --standard=PSR12 app tests

test:
	php artisan test

test-coverage:
	composer exec --verbose phpunit tests -- --coverage-clover build/logs/clover.xml

install-env:
	php -r "file_exists('.env') || copy('.env.example', '.env');"
