<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
// Crear un usuario de ejemplo
User::create([
    'first_name' => 'Juan',
    'second_name' => 'Carlos',
    'first_lastname' => 'López',
    'second_lastname' => 'Rodrigez',
    'email' => 'juan@gmail.com',
    'password' => Hash::make('juanjuan01'),
    'rol' => 'superUsuario',
    'document_type' => 'Cedula de Ciudadania',
    'identification_number' => '123456789',
    'social_reason' => 'Sigacon SAS',
    'trade_name' => 'ABC S.A.S.',
    'physical_address' => 'Calle 123 #45-67',
    'phone' => '1234567',
    'cellphone' => '987654321',
    'autoretenedor_renta' => 'Si',
    'autoretenedor_iva' => 'Si',
    'autoretenedor_ica' => 'Si',
    'responsable_iva' => 'Si',
    'declarante_rsts' => 'Si',
    'declarante_renta' => 'Si',
    'country_id' => 1,
    'state_id' => 1,
    'city_id' => 1,
]);
    }
}

//Es para poblar la tabla user con un usuario.