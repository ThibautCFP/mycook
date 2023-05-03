<?php

namespace App\Fixtures\Providers;

use App\Entity\User;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserProvider
{
    public function __construct(
        private readonly UserPasswordHasherInterface $encoder
    ) {
    }

    /* Nous définissons notre méthode custom */
    public function randomLastName(): string
    {
        /* On liste dans un tableau les choix de catégorie */
        $lastNames = [
            'Doe',
            'Chevalier',
            'Morin',
            'Thomas',
            'Thibault',
            'Noel',
            'Renault',
            'Julien',
            'Perrot',
            'Olivier',
            'Deschamps',
            'Jacquets'
        ];

        /* On retourne un choix aléatoire dans les valeurs du tableau */
        return $lastNames[array_rand($lastNames)];
    }

    public function randomFirstName(): string
    {
        $firstNames = [
            'Thibaut',
            'Tom',
            'Alexis',
            'Alexandre',
            'Joris',
            'Alain',
            'Jean',
            'Pierre',
            'Paul',
            'Olivier',
            'Alexia',
            'Léa',
            'Margaux'
        ];

        return $firstNames[array_rand($firstNames)];
    }

    public function hashPassword(string $plainPassword): string
    {
        return $this->encoder->hashPassword(new User, $plainPassword);
    }
}
