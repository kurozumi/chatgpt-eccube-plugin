<?php

/**
 * This file is part of ChatGpt
 *
 * Copyright(c) Akira Kurozumi <info@a-zumi.net>
 *
 *  https://a-zumi.net
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Plugin\ChatGpt\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="plg_chat_gpt")
 * @ORM\Entity(repositoryClass="Plugin\ChatGpt\Repository\ChatGptRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class ChatGpt
{
    /**
     * @var int
     *
     * @ORM\Column(type="integer", options={"unsigned": true})
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string|null
     *
     * @ORM\Column(type="string", nullable=true)
     */
    private $apiKey;

    /**
     * @var string|null
     *
     * @ORM\Column(type="string", nullable=true)
     */
    private $model;

    /**
     * @var string|null
     *
     * @ORM\Column(type="text", nullable=true)
     */
    private $product;

    /**
     * @var string|null
     *
     * @ORM\Column(type="text", nullable=true)
     */
    private $news;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $apiKey
     * @return $this
     */
    public function setApiKey(string $apiKey): self
    {
        $this->apiKey = $apiKey;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getApiKey(): ?string
    {
        return $this->apiKey;
    }

    /**
     * @param string $model
     * @return $this
     */
    public function setModel(string $model): self
    {
        $this->model = $model;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getModel(): ?string
    {
        return $this->model;
    }

    /**
     * @param string|null $product
     * @return $this
     */
    public function setProduct(?string $product): self
    {
        $this->product = $product;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getProduct(): ?string
    {
        return $this->product;
    }

    /**
     * @param string|null $news
     * @return $this
     */
    public function setNews(?string $news): self
    {
        $this->news = $news;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getNews(): ?string
    {
        return $this->news;
    }
}
