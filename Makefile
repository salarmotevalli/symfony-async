include .env

build_server:
	docker build -f ./server/Dockerfile -t ${SERVER_IMAGE_NAME} .

run:
	docker-compose up -d

down:
	docker-compose down

list:
	grep '^[^#[:space:]].*:' Makefile
