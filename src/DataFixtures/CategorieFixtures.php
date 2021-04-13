<?php

namespace App\DataFixtures;

use App\Entity\Categorie;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;


class CategorieFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        //initialisation de faker
        $faker = Faker\Factory::create('fr_FR');

        //generer un ensemble de categorie
        for($i=0;$i<5;$i++){
            $categorie = new Categorie();
            $categorie->setLibelle($faker->word());
            $categorie->setImage($faker->imageUrl(300,200));
            $reference = 'categorie.'.$i;
            $this->addReference($reference,$categorie);
            $manager->persist($categorie);
        }
        $manager->flush();
    }
}
