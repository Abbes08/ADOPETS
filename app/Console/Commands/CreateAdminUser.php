<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class CreateAdminUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:admin';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Crea el usuario administrador para la aplicación';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $admin = User::where('email', 'adminadopets@gmail.com')->first();

        if (!$admin) {
            User::create([
                'name' => 'Administrador',
                'surname' => 'Principal',
                'gender' => 'Masculino',
                'phone' => '1234567890',
                'address' => 'Dirección de ejemplo',
                'email' => 'adminadopets@gmail.com',
                'password' => Hash::make('12345678'), // Cambia 'adminpassword' por una contraseña segura
                'role' => 'admin',
                'is_active' => true,
            ]);

            $this->info('Usuario administrador creado correctamente.');
        } else {
            $this->info('El usuario administrador ya existe.');
        }

        return 0;
    }
}
