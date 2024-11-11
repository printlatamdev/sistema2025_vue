<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'user.view',
            'user.store',
            'user.update',
            'user.destroy',
            'role.view',
            'role.store',
            'role.update',
            'role.destroy',
            'permission.view',
            'permission.store',
            'permission.update',
            'permission.destroy',
            'quote.view',
            'quote.store',
            'quote.update',
            'quote.destroy',
            'companies.view',
            'companies.store',
            'companies.update',
            'companies.destroy',
            'contacts.view',
            'contacts.store',
            'contacts.update',
            'contacts.destroy',
            'purchase-orders.view',
            'purchase-orders.store',
            'purchase-orders.update',
            'purchase-orders.destroy',
            'categories.view',
            'categories.store',
            'categories.update',
            'categories.destroy',
            'categories.view', 
            'categories.store',
            'categories.update',
            'categories.destroy',
        ];
        foreach ($permissions as $item) {
            Permission::create([
                'name' => $item,
                'guard_name' => 'web',
            ]);
        }
    }
}
