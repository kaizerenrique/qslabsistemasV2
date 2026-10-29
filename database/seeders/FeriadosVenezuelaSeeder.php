<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Feriado;

class FeriadosVenezuelaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Feriados fijos de Venezuela (los mismos cada año)
        $fijos = [
            ['month' => 1,  'day' => 1,  'descripcion' => 'Año Nuevo'],
            ['month' => 4,  'day' => 19, 'descripcion' => 'Declaración de la Independencia'],
            ['month' => 5,  'day' => 1,  'descripcion' => 'Día Mundial del Trabajador'],
            ['month' => 6,  'day' => 24, 'descripcion' => 'Batalla de Carabobo'],
            ['month' => 7,  'day' => 5,  'descripcion' => 'Día de la Independencia'],
            ['month' => 7,  'day' => 24, 'descripcion' => 'Natalicio de Simón Bolívar'],
            ['month' => 10, 'day' => 12, 'descripcion' => 'Día de la Resistencia Indígena'],
            ['month' => 12, 'day' => 24, 'descripcion' => 'Nochebuena'],
            ['month' => 12, 'day' => 25, 'descripcion' => 'Navidad'],
            ['month' => 12, 'day' => 31, 'descripcion' => 'Fin de Año'],
        ];

        $añoActual = (int) date('Y');
        $años = [$añoActual, $añoActual + 1];

        foreach ($años as $año) {
            foreach ($fijos as $f) {
                $fecha = sprintf('%04d-%02d-%02d', $año, $f['month'], $f['day']);

                Feriado::firstOrCreate(
                    ['fecha' => $fecha],
                    ['descripcion' => $f['descripcion'], 'activo' => true]
                );
            }
        }

        // Feriados móviles (Carnaval y Semana Santa) se agregan manualmente
        // desde el panel de Qslab cada año. Ejemplo:
        // Feriado::firstOrCreate(['fecha' => '2026-02-16'], ['descripcion' => 'Carnaval']);
        // Feriado::firstOrCreate(['fecha' => '2026-02-17'], ['descripcion' => 'Carnaval']);
    }
}
