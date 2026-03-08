# 🏗️ Arquitectura del Sistema (CakePHP)

Este proyecto está construido bajo el patrón MVC (Model-View-Controller) utilizando el framework CakePHP 4.x.

## Capas Principales
1. **Infraestructura (Docker):** Contenedores separados para el servidor Web (PHP 7.4/Apache) y la persistencia (MariaDB).
2. **Capa de Modelo (Entities & Tables):** 
   * `PokemonsTable`: Lógica de base de datos y métodos *Finder* personalizados para filtrado dinámico (`findOakAnalysis`).
   * `Pokemon Entity`: Manejo de *Mutators* para calcular atributos virtuales al vuelo (como la inversión del nombre o conversión de peso).
3. **Capa de Control (Controllers & Commands):**
   * `PokemonsController`: Orquesta la paginación y conecta los filtros de UI con la BD.
   * `ImportPokemonsCommand`: Script de consola CLI para ingesta de datos asíncrona mediante el `Http\Client` nativo de CakePHP.
4. **Capa de Vista (Templates):** UI modularizada utilizando `Elements` para evitar repetición de código (DRY).