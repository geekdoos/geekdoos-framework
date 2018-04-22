<?php

namespace App\Blog\Tables;

use App\Blog\Entity\Post;
use App\Framework\Database\PaginatedQuery;
use Pagerfanta\Pagerfanta;

class PostTable
{
    /**
     * @var \PDO
     */
    private $pdo;

    public function __construct(\PDO $pdo)
    {

        $this->pdo = $pdo;
    }

    /**
     * Paginate the all articles
     * @param int $maxPerPage
     * @param int $page
     * @return Pagerfanta
     */
    public function findPaginated(int $maxPerPage, int $currentPage): Pagerfanta
    {
        $paginatedQuery = new PaginatedQuery(
            $this->pdo,
            'SELECT * FROM posts ORDER BY created_at DESC ',
            'SELECT count(id) FROM posts',
            Post::class
        );
        return (new Pagerfanta($paginatedQuery))
            ->setMaxPerPage($maxPerPage)
            ->setCurrentPage($currentPage);
        /*
        return $this->pdo
            ->query('SELECT * FROM posts ORDER BY created_at DESC LIMIT 10')
            ->fetchAll();
        */
    }

    /**
     * Find an
     *
     * @param int $id
     * @return Post
     */
    public function findById(int $id) : Post
    {
        $query = $this->pdo->prepare('SELECT * FROM posts WHERE id = ?');
        $query->execute([$id]);
        $query->setFetchMode(\PDO::FETCH_CLASS, Post::class);
        return $query->fetch();
    }
}
