# 💾 Modelo de Datos y Mutators

Utilizamos una tabla única desnormalizada para máxima velocidad de lectura y filtrado.

## Esquema Físico (MariaDB)
* `id` (int, PK)
* `ext_id` (int): ID de la Pokedex Nacional.
* `name` (varchar)
* `types` (varchar): CSV plano (ej. "grass, poison").
* `height` (int): Decímetros.
* `weight` (int): Hectogramos.

## Campos Virtuales (Calculados en Runtime)
Gracias al sistema de Entidades de CakePHP, inyectamos campos en la vista que NO se guardan en la DB.
* `$pokemon->height_cm`: Retorna `height * 10`.
* `$pokemon->weight_kg`: Retorna `weight / 10`.
* `$pokemon->inverted_name`: Ejecuta `strrev()` sobre el nombre.