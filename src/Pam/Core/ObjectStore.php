<?php

namespace App\Pam\Core;

use App\Shared\Api\PamException;
use App\Shared\Fixtures\Entity\LabObject;
use Doctrine\ORM\EntityManagerInterface;

/** Small persistent document store for the local simulator, never a production vault. */
final class ObjectStore
{
    public function __construct(public readonly EntityManagerInterface $em)
    {
    }

    /** @return list<array<string, mixed>> */
    public function all(string $kind): array
    {
        return array_map(static fn (LabObject $o): array => $o->data, $this->em->getRepository(LabObject::class)->findBy(['kind' => $kind], ['id' => 'ASC']));
    }

    /** @return array<string, mixed> */
    public function get(string $kind, string $id): array
    {
        foreach ($this->all($kind) as $row) {
            foreach (['id', 'username', 'safeName', 'safeUrlId', 'groupName', 'platformID', 'ID'] as $key) {
                if (isset($row[$key]) && 0 === strcasecmp((string) $row[$key], $id)) {
                    return $row;
                }
            }
        }
        throw new PamException(404, 'PAMMOCK404', 'Requested object does not exist.');
    }

    /** @param array<string, mixed> $data */
    public function save(string $kind, array $data): void
    {
        $id = $kind.'.'.$data['id'];
        $object = $this->em->find(LabObject::class, $id);
        if (null === $object) {
            $object = new LabObject($id, $kind, $data);
            $this->em->persist($object);
        }
        $object->data = $data;
        $this->em->flush();
    }

    public function delete(string $kind, string $id): void
    {
        $row = $this->get($kind, $id);
        $object = $this->em->find(LabObject::class, $kind.'.'.$row['id']);
        $this->em->remove($object);
        $this->em->flush();
    }

    public function nextId(string $kind): int
    {
        $ids = array_map(static fn (array $row): int => (int) $row['id'], $this->all($kind));

        return max([0, ...$ids]) + 1;
    }

    public function unique(string $kind, string $field, string $value, ?string $except = null): void
    {
        foreach ($this->all($kind) as $row) {
            if ((string) $row['id'] !== $except && 0 === strcasecmp((string) ($row[$field] ?? ''), $value)) {
                throw new PamException(409, 'PAMMOCK409', 'An object with this name already exists.');
            }
        }
    }
}
