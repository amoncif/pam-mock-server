<?php

namespace App\Pam\Authentication\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'pam_user')]
class PamUser
{
    #[ORM\Id, ORM\Column(length: 80)]
    public string $username;
    #[ORM\Column(length: 20)]
    public string $provider;
    #[ORM\Column(length: 255)]
    public string $passwordHash;
    #[ORM\Column(length: 20)]
    public string $state = 'active';
    #[ORM\Column(length: 80)]
    public string $persona;

    public function __construct(string $username, string $provider, string $passwordHash, string $persona, string $state = 'active')
    {
        $this->username = $username;
        $this->provider = $provider;
        $this->passwordHash = $passwordHash;
        $this->persona = $persona;
        $this->state = $state;
    }
}
