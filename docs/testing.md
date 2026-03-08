# 🧪 Estrategia de Pruebas (TDD)

El proyecto incluye pruebas de integración rigurosas para garantizar la estabilidad de las reglas de negocio del Laboratorio.

Para ejecutar los tests:
`vendor/bin/phpunit`

### Cobertura:
1. **Controladores (`PokemonsControllerTest`):** Verifica que los filtros inyectados por parámetros GET (Query Strings) realmente actúen sobre el motor de búsqueda en la BD de pruebas.
2. **Consola y Servicios (`ImportPokemonsCommandTest`):** Asegura que la ingesta procese correctamente arreglos JSON. Utilizamos `Client::addMockResponse()` para interceptar las llamadas a la PokeAPI, previniendo cuellos de botella en la red durante la ejecución de los tests (Evita Test Flakiness).