<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Pokemons Controller
 *
 * Administra la lógica de visualización y filtrado para el laboratorio.
 *
 * @property \App\Model\Table\PokemonsTable $Pokemons
 */
class PokemonsController extends AppController
{
    /**
     * Configuración de la paginación.
     * Mostramos 10 por página para una lectura cómoda,
     * pero permitimos navegar por los 50.
     */
    public $paginate = [
        'limit' => 10,
        'order' => [
            'ext_id' => 'asc'
        ]
    ];

    /**
     * Método Index: El Dashboard Principal.
     *
     * Captura parámetros de la URL y los envía al buscador dinámico (Finder)
     * definido en la PokemonsTable.
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        // 1. Recoger parámetros de búsqueda desde el Frontend (Query Params)
        $filters = [
            'min_weight' => $this->request->getQuery('min_weight'),
            'max_weight' => $this->request->getQuery('max_weight'),
            'type'       => $this->request->getQuery('type'),
            'min_height' => $this->request->getQuery('min_height'),
        ];

        // 2. Preparar la consulta usando el Finder dinámico 'oakAnalysis'
        // Pasamos el array de filtros al modelo para que aplique el WHERE necesario.
        $query = $this->Pokemons->find('oakAnalysis', $filters);

        // 3. Ejecutar paginación con la consulta filtrada
        $pokemons = $this->paginate($query);

        // 4. Pasar los datos y los filtros actuales a la vista (para mantener los inputs llenos)
        $this->set(compact('pokemons', 'filters'));
    }

    /**
     * Vista de detalle (Opcional para el laboratorio)
     * Permite ver a fondo un espécimen sin posibilidad de editarlo.
     */
    public function view($id = null)
    {
        $pokemon = $this->Pokemons->get($id);
        $this->set(compact('pokemon'));
    }
}
