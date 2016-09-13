<?php
/**
 * Created by airshop development team.
 * User: Gerpis
 * Date: 4/5/2016
 * Time: 10:11 πμ
 * © airshop.gr
 */

namespace AppBundle\DataFixtures;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Nelmio\Alice\Fixtures;


class LoadFixtures implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $objects = Fixtures::load(
            __DIR__.'/fixtures.yml',
            $manager,
            [
                'providers' => [$this]
            ]
        );
    }

    public function generateSurname(){
        $surnames = [
            'Doe',
            'Nicholson',
            'Clarkson',
            'Lewis'
        ];
        return  $surnames[array_rand($surnames)];
    }
}