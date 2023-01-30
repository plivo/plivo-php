.PHONY: build test

build:
	docker-compose up --build --remove-orphans

test:
	docker exec -it $$CONTAINER /bin/bash -c "/usr/src/app/vendor/bin/phpunit --verbose tests"