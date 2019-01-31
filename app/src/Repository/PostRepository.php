<?php


namespace App\Repository;


use App\Entity\Post;
use Doctrine\Common\Persistence\ManagerRegistry;

class PostRepository
{
    private $managerRegistry;

    public function __construct(ManagerRegistry $managerRegistry)
    {
        $this->managerRegistry = $managerRegistry;
    }

    public function findAllFilterBySearch(?string $search)
    {
        return $this->getManager()
            ->createQuery(
                'SELECT p FROM AppBundle:Product p WHERE message LIKE :search'
            )
            ->setParameter('search', '%'.$search.'%')
            ->getResult();
    }

    protected function getManager(): \Doctrine\ORM\EntityManager
    {
        return $this->managerRegistry->getManagerForClass(Post::class);
    }
}
