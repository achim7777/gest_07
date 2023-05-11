<?php

namespace App\DataFixtures;

use App\Factory\EnseignantFactory;
use App\Factory\EtudiantsFactory;
use App\Factory\FliereFactory;
use App\Factory\ModuleFactory;
use App\Factory\NoteFactory;
use App\Factory\SemestreFactory;
use App\Factory\UserFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);
        EnseignantFactory::createMany(25);
        EtudiantsFactory::createMany(25);
        FliereFactory::createMany(25);
        ModuleFactory::createMany(25);
        NoteFactory::createMany(25);
        SemestreFactory::createMany(25);
        UserFactory::createOne();

        $manager->flush();
    }
}
