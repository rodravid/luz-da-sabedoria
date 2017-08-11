<?php

namespace App\Infrastructure\Common;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use App\Infrastructure\Common\Traits\Paginatable;
use App\Infrastructure\Exceptions\EntityNotFoundException;

class DoctrineBaseRepository extends EntityRepository
{
    use Paginatable;

    public function findOrFail($id)
    {
        $entity = $this->find($id);

        if (! $entity) {
            throw new EntityNotFoundException('Entity not found.');
        }

        return $entity;
    }

    public function save($entity)
    {
        $this->_em->persist($entity);
        $this->_em->flush();
    }

    public function delete($entity)
    {
        $this->_em->remove($entity);
        $this->_em->flush();
        $this->_em->clear(get_class($entity));
    }

    public function setEntityManager(EntityManagerInterface $em)
    {
        $this->_em = $em;
    }

}