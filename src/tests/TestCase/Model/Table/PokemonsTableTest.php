<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PokemonsTable;
use Cake\TestSuite\TestCase;

class PokemonsTableTest extends TestCase
{
    protected $Pokemons;

    protected $fixtures = [
        'app.Pokemons',
    ];

    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Pokemons') ? [] : ['className' => PokemonsTable::class];
        $this->Pokemons = $this->getTableLocator()->get('Pokemons', $config);
    }

    protected function tearDown(): void
    {
        unset($this->Pokemons);
        parent::tearDown();
    }

    public function testFindOakAnalysisFiltraCorrectamente(): void
    {
        // 1. Prueba: Buscar pokemon de tipo 'grass'
        $queryGrass = $this->Pokemons->find('oakAnalysis', ['type' => 'grass']);
        $resultadosGrass = $queryGrass->toArray();

        $this->assertCount(1, $resultadosGrass, 'Debería encontrar 1 pokemon tipo grass (bulbasaur)');
        $this->assertEquals('bulbasaur', $resultadosGrass[0]->name);

        // 2. Prueba: Rango de peso (Entre 10kg y 40kg)
        // Fixtures: Bulbasaur(6.9kg), Pikachu(6kg), Butterfree(32kg).
        // Filtro > 10kg y < 40kg: Solo Butterfree (32kg) debe entrar.
        $queryPeso = $this->Pokemons->find('oakAnalysis', ['min_weight' => 10, 'max_weight' => 40]);
        $resultadosPeso = $queryPeso->toArray();

        $this->assertCount(1, $resultadosPeso, 'Solo Butterfree (32kg) debería estar en el rango de 10kg a 40kg');
        $this->assertEquals('butterfree', $resultadosPeso[0]->name);
    }
}
