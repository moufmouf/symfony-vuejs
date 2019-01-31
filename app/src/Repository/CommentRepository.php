<?php
namespace App\Repository;


use App\Entity\Comment;
use App\Entity\Post;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\Query;

class CommentRepository
{
    private $managerRegistry;

    public function __construct(ManagerRegistry $managerRegistry)
    {
        $this->managerRegistry = $managerRegistry;
    }

    /*public function findByPost(Post $post)
    {
        return $this->getManager()
            ->createQuery(
                'SELECT c FROM App\\Entity\\Comment c JOIN c.post p WHERE p.id = :post_id'
            )
            ->setParameter('post_id', $post->getId())
            ->getResult();
    }*/

    public function findByPost(Post $post): Query
    {
        return $this->getManager()
            ->createQuery(
                'SELECT c FROM App\\Entity\\Comment c JOIN c.post p WHERE p.id = :post_id'
            )
            ->setParameter('post_id', $post->getId());
    }

    protected function getManager(): \Doctrine\ORM\EntityManager
    {
        return $this->managerRegistry->getManagerForClass(Comment::class);
    }
}
