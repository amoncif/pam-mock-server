<?php

namespace App\Shared\Fixtures;

use App\Pam\Authentication\Entity\PamUser;
use App\Shared\Fixtures\Entity\LabObject;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

final class LabFixtures extends Fixture
{
    public function __construct(private readonly string $projectDir)
    {
    }

    public function load(ObjectManager $manager): void
    {
        $dataset = json_decode(file_get_contents($this->projectDir.'/fixtures/acme.json'), true, 512, JSON_THROW_ON_ERROR);
        foreach ($dataset['users'] as $u) {
            $manager->persist(new PamUser($u['username'], $u['provider'], $u['passwordHash'], $u['persona'], $u['state']));
        }
        foreach (['safes', 'platforms', 'accounts', 'memberships'] as $kind) {
            foreach ($dataset[$kind] as $item) {
                $manager->persist(new LabObject($kind.'.'.$item['id'], $kind, $item));
            }
        }
        $manager->flush();
    }
}
