<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Categoria;

class CategoriasPruebasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categorias = [
            ['nombre' => 'Hematología',       'icono' => 'fas fa-tint'],
            ['nombre' => 'Química Sanguínea', 'icono' => 'fas fa-flask'],
            ['nombre' => 'Inmunología',       'icono' => 'fas fa-shield-virus'],
            ['nombre' => 'Microbiología',     'icono' => 'fas fa-bacteria'],
            ['nombre' => 'Uroanálisis',       'icono' => 'fas fa-vial'],
            ['nombre' => 'Coprología',        'icono' => 'fas fa-dna'],
            ['nombre' => 'Hormonas',          'icono' => 'fas fa-chart-line'],
            ['nombre' => 'Coagulación',       'icono' => 'fas fa-hourglass-half'],
            ['nombre' => 'Marcadores Cardíacos', 'icono' => 'fas fa-heartbeat'],
            ['nombre' => 'Perfiles Especiales', 'icono' => 'fas fa-clipboard-list'],
        ];

        foreach ($categorias as $i => $c) {
            Categoria::firstOrCreate(
                ['slug' => Str::slug($c['nombre'])],
                [
                    'nombre'      => $c['nombre'],
                    'icono'       => $c['icono'],
                    'orden'       => $i + 1,
                    'activa'      => true,
                ]
            );
        }
    }
}
