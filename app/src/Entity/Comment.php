<?php

namespace App\Entity;

use Carbon\Carbon;
use Doctrine\ORM\Mapping as ORM;
use TheCodingMachine\GraphQLite\Annotations\Field;
use TheCodingMachine\GraphQLite\Annotations\Type;

/**
 * @ORM\Entity
 * @ORM\Table(name="comments")
 * @ORM\HasLifecycleCallbacks
 * @Type()
 */
class Comment
{
    /**
     * @var int
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(name="string", type="string")
     */
    private $message;

    /**
     * @var \DateTime
     * @ORM\Column(name="created", type="datetime_immutable")
     */
    private $created;

    /**
     * @var \DateTime
     * @ORM\Column(name="updated", type="datetime_immutable", nullable=true)
     */
    private $updated;

    /**
     * @var Post
     * @ORM\ManyToOne(targetEntity=Post::class)
     * @ORM\JoinColumn(name="post_id", referencedColumnName="id")
     */
    private $post;

    /**
     * @var User
     * @ORM\ManyToOne(targetEntity=User::class)
     * @ORM\JoinColumn(name="author_id", referencedColumnName="id")
     */
    private $author;

    public function __construct(string $message, Post $post, User $author)
    {
        $this->message = $message;
        $this->post = $post;
        $this->author = $author;
    }

    /**
     * @ORM\PrePersist
     * @return void
     */
    public function onPrePersist(): void
    {
        $this->created = new \DateTimeImmutable();
    }

    /**
     * @ORM\PreUpdate
     * @return void
     */
    public function onPreUpdate(): void
    {
        $this->updated = new \DateTimeImmutable();
    }

    /**
     * @Field(outputType="ID")
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @Field()
     */
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * @param string $message
     * @return void
     */
    public function setMessage(string $message): void
    {
        $this->message = $message;
    }

    /**
     * @Field()
     */
    public function getCreated(): \DateTimeImmutable
    {
        return $this->created;
    }

    /**
     * @Field()
     */
    public function getUpdated(): ?\DateTimeImmutable
    {
        return $this->updated;
    }

    /**
     * @Field()
     */
    public function getPost(): Post
    {
        return $this->post;
    }

    /**
     * @Field()
     */
    public function getAuthor(): User
    {
        return $this->author;
    }
}
