<?php

namespace App\Shared\Fixtures\Entity;

use Doctrine\ORM\Mapping as ORM;

/** Seed data only. No API resources or domain behavior are exposed. */
#[ORM\Entity]
#[ORM\Table(name: 'lab_object')]
class LabObject
{
    #[ORM\Id, ORM\Column(length: 100)]
    public string $id;
    #[ORM\Column(length: 30)]
    public string $kind;
    /** @var array<string, mixed> */
    #[ORM\Column(type: 'json')]
    public array $data;

    /** @param array<string, mixed> $data */
    public function __construct(string $id, string $kind, array $data)
    {
        $this->id = $id;
        $this->kind = $kind;
        $this->data = $data;
    }
}
