<?php

namespace App\Pam\Authentication\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'pam_session')]
class PamSession
{
    #[ORM\Id, ORM\Column(length: 64)]
    public string $tokenHash;
    #[ORM\ManyToOne(targetEntity: PamUser::class), ORM\JoinColumn(name: 'username', referencedColumnName: 'username', nullable: false, onDelete: 'CASCADE')]
    public PamUser $user;
    #[ORM\Column(length: 20)]
    public string $provider;
    #[ORM\Column]
    public int $createdAt;
    #[ORM\Column]
    public int $expiresAt;
    #[ORM\Column]
    public int $lastActivity;
    #[ORM\Column(nullable: true)]
    public ?int $connectionNumber = null;

    public function __construct(string $token, PamUser $user, string $provider, int $now, int $ttl, ?int $connectionNumber)
    {
        $this->tokenHash = hash('sha256', $token);
        $this->user = $user;
        $this->provider = $provider;
        $this->createdAt = $now;
        $this->lastActivity = $now;
        $this->expiresAt = $now + $ttl;
        $this->connectionNumber = $connectionNumber;
    }
}
