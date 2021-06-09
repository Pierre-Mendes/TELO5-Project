<?php

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
        DB::table('users')->insert([
            'nome' => 'Administrador', 
            'cidade' => 'Uberaba', 
            'estado' => 'MG', 
            'pais' => 'Brasil', 
            'rua' => 'Av. Francisco Podboy', 
            'cep' => '00000-00', 
            'telefone' => '0000-0000', 
            'configuracao_idioma' => '0', 
            'tipo_usuario' => '0', 
            'email' => 'admin@valmont.com', 
            'password' => Hash::make('123456'), 
            'situacao' => '1', 
        ]);
    }
}
