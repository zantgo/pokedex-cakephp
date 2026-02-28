<?php
declare(strict_types=1);

namespace App\Command;

use Cake\Command\Command;
use Cake\Console\Arguments;
use Cake\Console\ConsoleIo;
use Cake\Console\ConsoleOptionParser;
use Cake\Http\Client;
use Cake\Utility\Hash;

/**
 * ImportPokemons command.
 */
class ImportPokemonsCommand extends Command
{
    /**
     * Lógica principal del comando.
     */
    public function execute(Arguments $args, ConsoleIo $io)
    {
        $io->hr();
        $io->out('🚀 Iniciando conexión con PokeAPI...');
        $io->hr();

        // 1. Acceder a la tabla 'Pokemons'
        $pokemonsTable = $this->fetchTable('Pokemons');

        // 2. Limpiar la tabla antes de importar (Evita duplicados)
        $io->warning('Limpiando base de datos actual...');
        $pokemonsTable->deleteAll([]);

        // 3. Configurar el cliente HTTP
        $http = new Client();

        // 4. Bucle para obtener los primeros 50 Pokémon
        for ($i = 1; $i <= 50; $i++) {
            $io->out("Consultando ID: {$i}...", 1, ConsoleIo::VERBOSE);

            $response = $http->get("https://pokeapi.co/api/v2/pokemon/{$i}");

            if ($response->isOk()) {
                $data = $response->getJson();

                // CORRECCIÓN AQUÍ: Usamos Hash para extraer 'name' dentro de 'type' de todos los elementos
                $typesArray = Hash::extract($data['types'], '{n}.type.name');
                $typesString = implode(', ', $typesArray);

                // Crear la entidad con los datos mapeados
                $pokemon = $pokemonsTable->newEntity([
                    'ext_id' => $data['id'],
                    'name'   => $data['name'],
                    'types'  => $typesString, // Ahora sí es un string limpio
                    'height' => $data['height'],
                    'weight' => $data['weight']
                ]);

                // Guardar en MariaDB
                if ($pokemonsTable->save($pokemon)) {
                    $io->success("✅ [#{$i}] {$data['name']} guardado.");
                } else {
                    $io->error("❌ Error al guardar el ID {$i}.");
                }
            } else {
                $io->error("❌ No se pudo obtener respuesta de la API para el ID {$i}.");
            }
        }
    }
}