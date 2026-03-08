<?php
declare(strict_types=1);

namespace App\Test\TestCase\Command;

use Cake\Console\TestSuite\ConsoleIntegrationTestTrait;
use Cake\TestSuite\TestCase;
use Cake\Http\Client;
// CORRECCIÓN: Usar el Response del Client, no el del Server
use Cake\Http\Client\Response;

class ImportPokemonsCommandTest extends TestCase
{
    use ConsoleIntegrationTestTrait;

    protected $fixtures =[
        'app.Pokemons',
    ];

    public function setUp(): void
    {
        parent::setUp();
        $this->useCommandRunner();
    }

    public function testExecuteHaceLlamadasAlApiGuardaDatos(): void
    {
        // 1. Preparamos respuestas simuladas (Mocks)
        $jsonResponse = json_encode([
            'id' => 25,
            'name' => 'pikachu',
            'height' => 4,
            'weight' => 60,
            'types' =>[
                ['type' =>['name' => 'electric']]
            ]
        ]);

        // Usando el array de configuración correcto para el Client\Response
        $mockResponse = new Response([], $jsonResponse);
        $mockResponse = $mockResponse->withStatus(200);

        Client::addMockResponse('GET', 'https://pokeapi.co/api/v2/pokemon/1', $mockResponse);

        // Mockeamos la 2 hasta la 50 con errores (404)
        $notFoundResponse = (new Response([]))->withStatus(404);
        for ($i = 2; $i <= 50; $i++) {
             Client::addMockResponse('GET', "https://pokeapi.co/api/v2/pokemon/{$i}", $notFoundResponse);
        }

        // 2. Ejecutamos el comando
        $this->exec('import_pokemons');

        // 3. Aserciones de Consola
        $this->assertExitCode(0);
        $this->assertOutputContains('Iniciando conexión con PokeAPI');
        $this->assertOutputContains('[#1] pikachu guardado.');

        // 4. Aserciones de Base de Datos
        $pokemonsTable = $this->getTableLocator()->get('Pokemons');
        $pikachu = $pokemonsTable->find()->where(['name' => 'pikachu'])->first();

        $this->assertNotNull($pikachu);
        $this->assertEquals(60, $pikachu->weight);
        $this->assertEquals('electric', $pikachu->types);
    }
}
