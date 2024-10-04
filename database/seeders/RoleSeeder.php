<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $roles = [
            'Superadministrador',
            'Producción administración',
            'Producción planta',
            'Facturación',
            'Bodega',
            'Recepción',
        ];
        foreach ($roles as $item) {
            Role::create(['name' => $item]);
        }
    }
}
