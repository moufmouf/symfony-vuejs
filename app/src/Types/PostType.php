<?php
namespace App\Types;

use App\Entity\Comment;
use App\Repository\CommentRepository;
use Porpaginas\Doctrine\ORM\ORMQueryResult;
use TheCodingMachine\GraphQLite\Annotations\ExtendType;
use App\Entity\Post;
use TheCodingMachine\GraphQLite\Annotations\Field;

/**
 * @ExtendType(class=Post::class)
 */
class PostType
{
    /**
     * @var CommentRepository
     */
    private $commentRepository;

    public function __construct(CommentRepository $commentRepository)
    {
        $this->commentRepository = $commentRepository;
    }

    /**
     * @Field()
     * @return Comment[]
     */
    /*public function getComments(Post $post): array
    {
        return $this->commentRepository->findByPost($post);
    }*/

    /**
     * @Field()
     * @return Comment[]
     */
    /*public function getComments(Post $post, int $limit = 20, int $offset = 0): array
    {
        return $this->commentRepository->findByPost($post)
            ->setMaxResults($limit)
            ->setFirstResult($offset)
            ->getResult();
    }*/

    /**
     * @Field()
     * @return Comment[]
     */
    public function getComments(Post $post): ORMQueryResult
    {
        return new ORMQueryResult($this->commentRepository->findByPost($post));
    }
}
