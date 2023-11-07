include .env

build_server:
	docker build -f ./server/Dockerfile -t ${SERVER_IMAGE_NAME} .

run:
	docker-compose up -d

down:
	docker-compose down

i:
	docker-compose exec server sh -c "php bin/console doctrine:fixtures:load"

list:
	grep '^[^#[:space:]].*:' Makefile
