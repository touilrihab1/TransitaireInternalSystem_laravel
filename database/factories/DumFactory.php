<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Dum>
 */
class DumFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $bureau = fake()->numberBetween(401,410);
        $regime = sprintf("%03d", fake()->numberBetween(30,50));
        $serie = sprintf("%06d", fake()->numberBetween(333,4444));
        $lettre = fake()->toUpper(fake()->randomLetter());
        $num_dum = $bureau.$regime."2023".$serie.$lettre;

        return [
            'bureau' => $bureau,
            'regime' => $regime,
            'serie' => $serie,
            'lettre' => $lettre,
            'num_dum' => $num_dum,
            // 'arrondissement' => '$arrondissement',
            'bureau_destination' => $bureau,
            'repertoire' => $rp = fake()->numberBetween(1,2),
            'type_dum' => fake()->randomElement(['Exportation' , 'Importation']),

            'date_debut' => today()->toDateTimeString(),
            'date_fin' => today()->toDateTimeString(),
            'declaration' => fake()->randomElement(['Définitive' , 'Provisionnelle']),
            'activite' => fake()->randomElement(['Industrielle' , 'Perissable']),

            'etat_dum' => 1,

            'user_id' => 1
        ];
    }
}
