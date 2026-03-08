<?php
declare(strict_types=1);

namespace App\Test\TestCase\Controller;

use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;

class PokemonsControllerTest extends TestCase
{
    use IntegrationTestTrait;

    protected $fixtures = [
        'app.Pokemons',
    ];

    public function testIndexRespondeOk(): void
    {
        $this->get('/pokemons');
        $this->assertResponseOk();
        $this->assertResponseContains('Laboratorio Oak: Análisis Pokedex');
    }

    public function testFiltroTipoGrass(): void
    {
        $this->get('/pokemons?type=grass');

        $this->assertResponseOk();

        // Convertimos a array para poder usar acceso por índice [0]
        $pokemons = $this->viewVariable('pokemons')->toArray();

        $this->assertCount(1, $pokemons);
        $this->assertEquals('bulbasaur', $pokemons[0]->name);
    }

    public function testFiltroRangoPeso(): void
    {
        // Filtramos entre 5kg y 40kg.
        // Fixtures: Bulbasaur(6.9kg), Pikachu(6kg), Butterfree(32kg).
        $this->get('/pokemons?min_weight=5&max_weight=40');
        $this->assertResponseOk();

        $pokemons = $this->viewVariable('pokemons');

        // El ResultSet es iterable, el foreach es seguro sin convertir
        foreach ($pokemons as $p) {
            $pesoKg = $p->weight / 10;

            $this->assertGreaterThan(5, $pesoKg, "El peso de {$p->name} debería ser > 5kg");
            $this->assertLessThan(40, $pesoKg, "El peso de {$p->name} debería ser < 40kg");
        }
    }
}
