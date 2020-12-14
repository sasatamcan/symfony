<?php

namespace App\Repository;

use App\Entity\Notes;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Notes|null find($id, $lockMode = null, $lockVersion = null)
 * @method Notes|null findOneBy(array $criteria, array $orderBy = null)
 * @method Notes[]    findAll()
 * @method Notes[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NotesRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Notes::class);
    }

    /**
     * @param Notes $notes
     * @param User $user
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function save(Notes $notes, User $user): void
    {
        $notes->setUser($user);
        $entityManager = $this->getEntityManager();
        $entityManager->persist($notes);
        $entityManager->flush();
    }

    /**
     * @param Notes $note
     * @throws ORMException
     */
    public function remove($note): void
    {
        $entityManager = $this->getEntityManager();
        $entityManager->remove($note);
        $entityManager->flush();
    }
}
