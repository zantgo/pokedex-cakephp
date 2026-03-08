# Comandos de automatización para el Pokedex Challenge

start: setup import ## Levanta el entorno e importa los datos automáticamente
	@echo "=================================================="
	@echo "🎉 ¡Todo listo! Tu Pokédex está funcionando."
	@echo "👉 Visita: http://localhost:8080"
	@echo "=================================================="

setup: ## Levanta el entorno por primera vez
	docker compose up -d --build
	docker compose run --rm app composer install
	@echo "⏳ Esperando 15 segundos a que la base de datos despierte..."
	sleep 15
	docker compose run --rm app bin/cake migrations migrate

import: ## Importa los 50 Pokémon de la PokeAPI
	docker compose run --rm app bin/cake import_pokemons
	@echo "✅ Importación finalizada."

permissions: ## Corrige permisos (Solo necesario en Linux)
	sudo chown -R $$(id -u):$$(id -g) .
	chmod -R 777 src/tmp src/logs

clean: ## Detiene y limpia los contenedores
	docker compose down -v
