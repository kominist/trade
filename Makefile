test:
	vendor/bin/behat
	vendor/bin/phpunit

install:
	composer self-update
	composer install --no-progress
	mkdir -p db
	touch db/db.sqlite
	chmod -R 777 db
	bin/phpmig migrate
	bin/behat --init


