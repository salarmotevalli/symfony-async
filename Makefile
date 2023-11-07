include .env

build_server:
	docker build -f ./server/Dockerfile -t ${SERVER_IMAGE_NAME} .

list:
	grep '^[^#[:space:]].*:' Makefile

