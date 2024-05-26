<?php

/*
 * This file is part of ChatGpt
 *
 * Copyright(c) Akira Kurozumi <info@a-zumi.net>
 *
 * https://a-zumi.net
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

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
     * @param int $id
     *
     * @return ChatGpt
     *
     * @throws \Exception
     */
    public function get(int $id = 1): ChatGpt
    {
        $chatGpt = $this->find($id);

        if (null === $chatGpt) {
            throw new \Exception('Config not found. id = '.$id);
        }

        return $chatGpt;
    }
}
