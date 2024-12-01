<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {
        // Buat roles
        $roles = [
            ['name' => 'Admin', 'slug' => 'admin'],
            ['name' => 'Kasir', 'slug' => 'cashier'],
            ['name' => 'Gudang', 'slug' => 'warehouse'],
        ];

        foreach ($roles as $role) {
            Role::create($role);
        }

        // Buat permissions
        $permissions = [
            // Produk
            ['name' => 'Lihat Produk', 'slug' => 'view-products'],
            ['name' => 'Tambah Produk', 'slug' => 'create-products'],
            ['name' => 'Edit Produk', 'slug' => 'edit-products'],
            ['name' => 'Hapus Produk', 'slug' => 'delete-products'],
            
            // Kategori
            ['name' => 'Kelola Kategori', 'slug' => 'manage-categories'],
            
            // Stok
            ['name' => 'Lihat Stok', 'slug' => 'view-stock'],
            ['name' => 'Adjust Stok', 'slug' => 'adjust-stock'],
            
            // Laporan
            ['name' => 'Lihat Laporan', 'slug' => 'view-reports'],
        ];

        foreach ($permissions as $permission) {
            Permission::create($permission);
        }
    }
} 