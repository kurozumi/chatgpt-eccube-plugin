<?php

namespace Plugin\ChatGpt;

use Eccube\Common\EccubeNav;

class Nav implements EccubeNav
{

    public static function getNav()
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
