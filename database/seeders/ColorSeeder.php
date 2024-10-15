<?php

namespace Database\Seeders;

use App\Models\Color;
use Illuminate\Database\Seeder;

class ColorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $colors = [
            ['name' => 'Blanco', 'hex' => '#fff'],
            ['name' => 'Blanco mate', 'hex' => '#F5F5F5'],
            ['name' => 'Blanco negro', 'hex' => '#EEF7FF'],
            ['name' => 'Blanco gloss', 'hex' => '#F4F6FF'],
            ['name' => 'Blanco kraft', 'hex' => '#FAF7F0'],
            ['name' => 'Transparente', 'hex' => '#F4F6FF'],
            ['name' => 'Transparente mate', 'hex' => '#F5F7F8'],
            ['name' => 'Transparente gloss', 'hex' => '#EEEDEB'],
            ['name' => 'Satín', 'hex' => '#EEEEEE'],
            ['name' => 'Brillante', 'hex' => '#F6F5F2'],
            ['name' => 'Rojo', 'hex' => '#A91D3A'],
            ['name' => 'Negro', 'hex' => '#222831'],
            ['name' => 'Mate', 'hex' => '#31363F'],
            ['name' => 'Azul', 'hex' => '#0D92F4'],
            ['name' => 'Plateado', 'hex' => '#DBD3D3'],
            ['name' => 'Gris', 'hex' => '#F5F5F7'],
            ['name' => 'Amarillo', 'hex' => '#FFEB55'],
        ];
        foreach ($colors as $item) {
            Color::create([
                'name' => $item['name'],
                'hex' => $item['hex'],
                'description' => 'No description',
            ]);
        }
    }
}
