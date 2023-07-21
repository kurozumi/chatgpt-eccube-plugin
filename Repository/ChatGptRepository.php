<?php

namespace Plugin\ChatGpt\Repository;

use Doctrine\Persistence\ManagerRegistry;
use Eccube\Repository\AbstractRepository;
use Plugin\ChatGpt\Entity\ChatGpt;

class ChatGptRepository extends AbstractRepository
{
    /**
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ChatGpt::class);
    }

    /**
     * @param $id
     * @return mixed|object|null
     */
    public function get($id = 1)
    {
        return $this->find($id);
    }
}
