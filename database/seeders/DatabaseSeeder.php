<?php

namespace Database\Seeders;

use App\Models\Area;
use App\Models\Rol;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        /*
         * Crear áreas predeterminadas
         */
        $areas = [
            'Administración',
            'Ventas',
            'Calidad',
            'Producción'
        ];

        foreach ($areas as $area) {
            Area::create(['nombre' => $area]);
        }

        /*
         * Crear roles predeterminados
         */
        $roles = [
            'Profesional de proyectos - Desarrollador',
            'Gerente estratégico',
            'Auxiliar administrativo'
        ];

        foreach ($roles as $area) {
            Rol::create(['nombre' => $area]);
        }
    }
}
