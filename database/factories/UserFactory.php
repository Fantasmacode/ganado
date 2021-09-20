<?php

namespace Database\Factories;

use App\Models\Team;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Laravel\Jetstream\Features;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nombres_usuario' => 'Mario Fernando',
            'apellidos_usuario' => 'Leiton Burgos',
            'direccion_usuario' => 'Leiton Burgos',
            'correo_usuario' => 'marioflb369@gmail.com',
            'telefono_usuario' => '+57 315 4515575',
            'clave_usuario' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'rol_usuario' => 'Administrador',
        ];
    }
}
