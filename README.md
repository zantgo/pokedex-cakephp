# 🧪 Pokedex Analytics Infrastructure (CakePHP)

Este proyecto es una infraestructura técnica diseñada para el laboratorio del Profesor Oak. Permite analizar datos de la **PokeAPI**, persistirlos en una base de datos local y aplicar filtros avanzados de peso, tipo y dimensiones, siguiendo un patrón MVC robusto y modular.

---

## 🚀 Tecnologías y Arquitectura
- **Framework:** CakePHP 4.x (PHP 7.4)
- **Base de Datos:** MariaDB 10.6
- **Contenerización:** Docker & Docker Compose
- **Automatización:** GNU Make

---

## 💻 Requisitos Previos
- [Docker & Docker Compose](https://docs.docker.com/get-docker/)
- [Git](https://git-scm.com/)
- **Make** (Preinstalado en Linux/Mac).

### ⚠️ Nota para usuarios de Windows
Este proyecto utiliza un `Makefile` y scripts de bash para la automatización. Para una ejecución correcta en Windows, **es obligatorio el uso de [WSL2 (Windows Subsystem for Linux)](https://learn.microsoft.com/es-es/windows/wsl/install)**. 
> No se recomienda el uso de PowerShell o CMD directamente para los comandos de automatización, ya que los permisos de archivos y los scripts de shell no son compatibles de forma nativa.

---

## 🛠️ Instalación y Despliegue

### 1. Clonar el repositorio
```bash
git clone https://github.com/zantgo/pokedex-cakephp.git
cd pokedex-cakephp
```

### 2. Despliegue Rápido (Recomendado)
Ejecuta el siguiente comando para levantar los contenedores, instalar dependencias, realizar migraciones e importar la data inicial automáticamente:
```bash
make start
```
*Si tienes problemas de permisos en Linux, ejecuta:* `make permissions`.

### 3. ¡Accede a tu Pokédex!
Una vez finalizado, visita en tu navegador:
👉 **http://localhost:8080/pokemons**

---

## 📚 Documentación Técnica
Para una comprensión profunda del sistema, consulta la carpeta `docs/`:
- **[Arquitectura del Sistema](./docs/architecture.md)**: Detalle de capas y patrón MVC.
- **[Modelo de Datos](./docs/data_model.md)**: Mutators, campos virtuales y esquema.
- **[Estrategia de Testing](./docs/testing.md)**: Guía de pruebas unitarias y de integración.

---

## 🧪 Aseguramiento de Calidad (QA)
El proyecto incluye una suite de pruebas robusta ejecutada con PHPUnit. Para validar el sistema:

```bash
docker compose run --rm app vendor/bin/phpunit
```

---

## 🔍 Funcionalidades
1. **Persistencia Local:** Ingesta automática mediante comando CLI desde la PokeAPI.
2. **Motor de Filtros:** Búsqueda dinámica basada en Finder `findOakAnalysis`.
3. **Transformación (Mutators):** Cálculos dinámicos (nombre invertido, conversión unidades cm/kg) inyectados mediante Entidades.
4. **UI Modular:** Uso de *Elements* de CakePHP (`filters.php`, `table.php`, `loader.php`) para mantener el código limpio.

---

## 📂 Estructura del Proyecto
```text
pokedex-cakephp/
├── docker/                 # Configuración de contenedores (Dockerfile)
├── docs/                   # Documentación modular (architecture, data_model, testing)
├── src/                    # Código fuente de la aplicación CakePHP
│   ├── bin/                # Ejecutables de CakePHP
│   ├── config/             # Configuración (routes.php, app.php)
│   ├── src/                # Lógica principal (Command, Controller, Model, View)
│   ├── templates/          # Vistas y Elementos modulares
│   ├── tests/              # Suite de pruebas (TestCase y Fixtures)
│   └── webroot/            # Archivos públicos (CSS/IMG)
├── Makefile                # Automatización (start, import, permissions)
└── docker-compose.yml      # Orquestación de servicios
```

---

## 🎉 ¡Mira tu Pokédex en Acción!
Para ver la lista de Pokémon importados y utilizar los filtros, ingresa a:
👉 **[http://localhost:8080/pokemons](http://localhost:8080/pokemons)**
