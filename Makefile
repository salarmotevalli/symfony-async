start: stop 
	docker-compose up -d
	symfony server:start -d

stop: symfony_down docker_down

docker_down:
	docker-compose down

symfony_down:
	symfony server:stop
