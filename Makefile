PORT ?= 8080

setup: install-env install-deps build-assets generate-app-key migrate run-fill-db
setup-prod: install-deps-prod build-assets generate-app-key migrate run-fill-db

start-in-dev-mode:
	make -j 2 start run-dev

start:
	 php artisan serve --host 0.0.0.0 --port=$(PORT)

install-deps-prod:
	composer install --no-dev

install-deps:
	composer install

composer-validate:
	composer validate

composer-outdated:
	composer outdated --direct --major-only --strict

composer-unused:
	vendor/bin/composer-unused

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

build-assets:
	npm ci
	npm run build

migrate:
	php artisan migrate --force

run-dev:
	npm run dev

run-fill-db:
	php artisan db:seed --force

semgrep-offline:
	semgrep scan --config auto --severity ERROR --use-git-ignore --error

psalm:
	vendor/bin/psalm
