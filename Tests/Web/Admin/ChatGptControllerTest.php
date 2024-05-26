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

namespace Plugin\ChatGpt\Tests\Web\Admin;

use Eccube\Tests\Web\Admin\AbstractAdminWebTestCase;

class ChatGptControllerTest extends AbstractAdminWebTestCase
{
    public function testルーティングチェック(): void
    {
        $this->client->request('GET', $this->generateUrl('admin_chat_gpt_config'));
        self::assertTrue($this->client->getResponse()->isSuccessful());
    }
}
