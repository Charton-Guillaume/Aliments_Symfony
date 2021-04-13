<?php

namespace App\DataFixtures;

use App\Entity\Aliment;
use App\Entity\Categorie;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker;

class AlimentFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        //initialisation de faker
        $faker = Faker\Factory::create('fr_FR');

        //generer un ensemble d'aliments
        for($i=0;$i<50;$i++){

            //generer une reference de categorie aleatoire

            $categorieReference = sprintf('categorie.%d', $faker->numberBetween(0,4));

            $aliment = new Aliment();
            $aliment->setNom($faker->word());
            $aliment->setImage($faker->imageUrl(300,200));
            $aliment->setPrix($faker->randomFloat(2,0,100));
            $aliment->setCalorie($faker->randomNumber(3));
            $aliment->setGlucide($faker->randomFloat(2,0,800));
            $aliment->setLipide($faker->randomFloat(2,0,800));
            $aliment->setProteine($faker->randomFloat(2,0,800));
            $aliment->setCreatedAt($faker->dateTimeBetween('-6 months'));
            $aliment->setCategorie($this->getReference($categorieReference));
            $manager->persist($aliment);
        }

        $manager->flush();
    }
    public function getDependencies()
    {
        return [CategorieFixtures::class];
    }
}
