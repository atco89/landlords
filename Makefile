include ./.env

start:
	$(MAKE) kill clean certs install

kill:
	docker kill $$(docker ps -q)

clean:
	docker system prune -a -f --volumes

certs:
	if [ -d $(CERTS_DIR) ]; \
		then rm -rf $(CERTS_DIR); \
	fi

	mkdir -m 0777 $(CERTS_DIR)

	openssl req \
		-x509 \
		-nodes \
		-days 365 \
		-newkey rsa:4096 \
		-keyout "$(CERTS_DIR)/server.key" \
		-out "$(CERTS_DIR)/server.crt" \
		-config "$(CURDIR)/docker/web/config/openssl.cnf"

	chmod -R 0777 $(CURDIR)

install:
	chmod -R 0777 $(CURDIR)
	docker-compose -f ./docker/docker-compose.yaml up -d --build
	chmod -R 0777 $(CURDIR)

git-config:
	cd "$(CURDIR)/src" && \
	git config user.name $(GIT_NAME) && \
	git config user.email $(GIT_EMAIL) && \
	git config core.filemode false

push:
	git add .
	git commit -m "[`date +'%Y-%m-%d'`] - work in progress."
	git push

status:
	@echo "**************************************************"
	docker ps -a
	@echo "**************************************************"
	docker images
	@echo "**************************************************"
	docker volume ls
	@echo "**************************************************"

php:
	docker exec -it php-fpm bash

db:
	docker exec -it database bash