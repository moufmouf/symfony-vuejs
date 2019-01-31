<?php


namespace App\Controller;


use App\Entity\Post;
use App\Repository\PostRepository;
use TheCodingMachine\GraphQLite\Annotations\Query;

class PostController
{
    /**
     * @var PostRepository
     */
    private $postRepository;

    public function __construct(PostRepository $postRepository)
    {
        $this->postRepository = $postRepository;
    }
    
    /**
     * @Query()
     * @return Post[]
     */
    public function getPosts(?string $search): array
    {
        return $this->postRepository->findAllFilterBySearch($search);
    }
}
