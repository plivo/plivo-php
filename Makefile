.PHONY: build test

build:
	docker-compose up --build --remove-orphans

test:
	@[ "${CONTAINER}" ] && \
		docker exec -it $$CONTAINER /bin/bash -c "/usr/src/app/vendor/bin/phpunit --verbose --bootstrap tests/bootstrap.php --testsuite resources-tests tests" || \
		/usr/src/app/vendor/bin/phpunit --verbose --bootstrap tests/bootstrap.php --testsuite resources-tests tests

run:
	@[ "${CONTAINER}" ] && \
		(docker exec -it $$CONTAINER /bin/bash -c 'cd /usr/src/app/php-sdk-test/ && php test.php') || \
		(cd /usr/src/app/php-sdk-test/ && php test.php)