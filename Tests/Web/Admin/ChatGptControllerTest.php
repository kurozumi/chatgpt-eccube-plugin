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

use Eccube\Common\Constant;
use Eccube\Tests\Web\Admin\AbstractAdminWebTestCase;
use Symfony\Component\Filesystem\Filesystem;

class ChatGptControllerTest extends AbstractAdminWebTestCase
{
    public function setUp(): void
    {
        parent::setUp();

        $envFile = static::getContainer()->getParameter('kernel.project_dir').'/.env';
        $fs = new Filesystem();
        $fs->copy($envFile, $envFile.'.backup');
    }

    public function tearDown(): void
    {
        // envファイルを戻す
        $envFile = static::getContainer()->getParameter('kernel.project_dir').'/.env';
        $fs = new Filesystem();
        $fs->rename($envFile.'.backup', $envFile, true);

        parent::tearDown();
    }

    public function testルーティングチェック(): void
    {
        $this->client->request('GET', $this->generateUrl('admin_chat_gpt_config'));
        self::assertTrue($this->client->getResponse()->isSuccessful());
    }

    public function testConfig()
    {
        $envFile = static::getContainer()->getParameter('kernel.project_dir').'/.env';

        $this->client->request('POST', $this->generateUrl('admin_chat_gpt_config'), [
            'chat_gpt' => [
                'apiKey' => 'test',
                'model' => 'test',
                Constant::TOKEN_NAME => 'dummy',
            ],
        ]);

        $env = file_get_contents($envFile);
        $key = 'OPENAI_API_KEY';

        if (preg_match('/^('.$key.')=(.*)/m', $env, $matches)) {
            self::assertEquals('test', $matches[2]);
        } else {
            self::fail(sprintf('%sが見つかりませんでした。', $key));
        }
    }
}
