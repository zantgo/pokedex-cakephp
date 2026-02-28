# Comandos de automatización para el Pokedex Challenge

setup: ## Levanta el entorno por primera vez
	docker compose up -d --build
	docker compose run --rm app composer install
	docker compose run --rm app bin/cake migrations migrate
	@echo "✅ Entorno listo en http://localhost:8080"

import: ## Importa los 50 Pokémon de la PokeAPI
	docker compose run --rm app bin/cake import_pokemons

permissions: ## Corrige permisos (Solo necesario en Linux)
	sudo chown -R $$(id -u):$$(id -g) .
	chmod -R 777 src/tmp src/logs

clean: ## Detiene y limpia los contenedores
	docker compose down -v
