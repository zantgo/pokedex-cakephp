Este proyecto es una infraestructura técnica diseñada para el laboratorio del Profesor Oak. Permite analizar datos de la **PokeAPI**, persistirlos en una base de datos local y aplicar filtros avanzados de peso, tipo y dimensiones.

## 🚀 Tecnologías y Arquitectura
- **Framework:** CakePHP 4.x (PHP 7.4)
- **Base de Datos:** MariaDB 10.6
- **Contenerización:** Docker & Docker Compose
- **Automatización:** GNU Make

---

## 💻 Requisitos Previos
-[Docker & Docker Compose](https://docs.docker.com/get-docker/)
- [Git](https://git-scm.com/)
- **Make** (Preinstalado en Linux/Mac).

### ⚠️ Nota para usuarios de Windows
Este proyecto utiliza un `Makefile` y configuraciones de permisos basadas en Unix. Para una ejecución correcta en Windows, **es obligatorio el uso de [WSL2 (Windows Subsystem for Linux)](https://learn.microsoft.com/es-es/windows/wsl/install)**. 
> No se recomienda el uso de PowerShell o CMD directamente para los comandos de automatización.

---

## 🛠️ Instalación y Despliegue

### 1. Clonar el repositorio
```bash
git clone https://github.com/zantgo/cakePHP-pokedex.git
cd cakePHP-pokedex
```

### 2. Despliegue Rápido (Recomendado)
Para hacer la instalación de manera automática, ejecuta el siguiente comando. Esto se encargará de levantar los contenedores, instalar dependencias, correr las migraciones de la base de datos e importar automáticamente los primeros 50 Pokémon:
```bash
make start
```

*Si estás en Linux y tienes problemas de permisos después de la instalación, ejecuta:* `make permissions`.

### 3. ¡Accede a tu Pokédex!
Una vez que el comando termine y veas el mensaje de éxito en la terminal, abre tu navegador web y visita:
👉 **http://localhost:8080**

---

### ⚙️ Comandos Manuales (Alternativa)
Si prefieres ejecutar el proceso paso a paso en lugar de usar `make start`, puedes usar los comandos individuales:
- `make setup`: Levanta contenedores y prepara la base de datos.
- `make import`: Consume la PokeAPI y guarda los Pokémon.

---

## 🔍 Funcionalidades del Desafío

El sistema procesa y visualiza la Pokedex con los siguientes requerimientos:

1.  **Persistencia Local:** Los datos no se consultan a la API en cada carga, se sirven desde MariaDB tras la importación inicial.
2.  **Filtro de Peso:** Identifica Pokémon con peso > 30 y < 80.
3.  **Filtro de Tipo:** Identifica Pokémon de tipo `grass`.
4.  **Filtro Combinado:** Identifica Pokémon tipo `flying` con altura > 10.
5.  **Transformación (Inverted Name):** Una columna calculada que invierte el nombre del pokemon (ej: `bulbasaur` -> `ruasablub`).

---

## 📁 Estructura del Proyecto
- `docker/`: Configuraciones de los contenedores (Dockerfile).
- `src/`: Código fuente de la aplicación CakePHP.
  - `src/Command/`: Lógica de importación desde PokeAPI.
  - `src/Model/`: Entidades y Tablas (Lógica de filtros y transformaciones).
  - `src/Controller/`: Gestión de peticiones y lógica de servidor.
  - `templates/`: Vistas de la Pokedex.
- `Makefile`: Automatización de tareas de desarrollo.
