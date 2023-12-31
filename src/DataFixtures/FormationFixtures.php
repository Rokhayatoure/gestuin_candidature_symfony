<?php

namespace App\DataFixtures;

use App\Entity\Formation;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
;

class FormationFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i = 0; $i < 10; $i++) {
           $formation = new Formation;
           $formation->setnomformation('nom:' . $i);
          $formation->setdescription('description : ' . $i);
          $formation->setDureFormation($i);
          $dateDebut = new \DateTime("2023-01-01");
          $dateDebut->modify('+' . $i . ' days');
        //   $formation->setDatedebut($dateDebut);
         
           $manager->persist( $formation);
        }


        $manager->flush();
    }
}
