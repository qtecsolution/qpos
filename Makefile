setup:
	@make docker-up-build
	@make composer-install
	@make set-permissions
	@make setup-env
	@make generate-key
	@make migrate-fresh-seed
	@make npm-install-build
	@make npm-run-dev

docker-stop:
	docker compose stop

docker-up-build:
	docker compose up -d --build

composer-install:
	docker exec qpos-app bash -c "composer install"

composer-update:
	docker exec qpos-app bash -c "composer update"

set-permissions:
	docker exec qpos-app bash -c "chmod -R 777 /var/www/storage"
	docker exec qpos-app bash -c "chmod -R 777 /var/www/bootstrap"

setup-env:
	docker exec qpos-app bash -c "cp .env.docker .env"

npm-install-build:
	docker exec qpos-node bash -c "npm install"
	docker exec qpos-node bash -c "npm run build:docker"

npm-run-dev:
	docker exec qpos-node bash -c "npm run dev:docker"

npm-run-build:
	docker exec qpos-node bash -c "npm run build:docker"

generate-key:
	docker exec qpos-app bash -c "php artisan key:generate"

migrate-fresh-seed:
	docker exec qpos-app bash -c "php artisan migrate:fresh --seed"
