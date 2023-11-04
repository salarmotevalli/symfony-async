start: stop 
	docker-compose up -d
	cd ./server
	symfony server:start -d

stop: docker_down _cd_server symfony_down

docker_down:
	docker-compose down

symfony_down: _cd_server
	symfony server:stop

consume:
	cd server && symfony console messenger:consume async -vv
	

_cd_server:
	cd ./server

