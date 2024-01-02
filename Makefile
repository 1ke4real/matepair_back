SHELL := /bin/bash
build:
	docker compose build --no-cache
start:
	docker compose up --pull always -d --wait
stop:
	docker compose down --remove-orphans