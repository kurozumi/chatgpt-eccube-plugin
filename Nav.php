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

namespace Plugin\ChatGpt;

use Eccube\Common\EccubeNav;

class Nav implements EccubeNav
{
    /**
     * @return array[]
     */
    public static function getNav(): array
    {
        return [
            'chat_gpt' => [
                'name' => 'ChatGpt',
                'icon' => 'fa-comment',
                'children' => [
                    'chat_gpt_config' => [
                        'name' => '設定',
                        'icon' => 'fa-cog',
                        'url' => 'admin_chat_gpt_config',
                    ],
                ],
            ],
        ];
    }
}
