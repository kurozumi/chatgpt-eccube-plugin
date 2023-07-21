<?php

namespace Plugin\ChatGptForEcCube\Controller\Admin;

use Eccube\Controller\AbstractController;
use Orhanerday\OpenAi\OpenAi;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/%eccube_admin_route%")
 */
class ChatGptController extends AbstractController
{
    /**
     * @var OpenAi
     */
    private $openAi;

    public function __construct(OpenAi $openAi)
    {
        $this->openAi = $openAi;
    }

    public function config()
    {

    }

    /**
     * @param Request $request
     * @return Response
     * @throws \Exception
     *
     * @Route("/product/chat_gpt", name="admin_product_chat_gpt", methods={"POST"})
     */
    public function product(Request $request): Response
    {
        $content = json_decode($request->getContent(), true);
        $chat = $this->openAi->chat([
            'model' => 'gpt-3.5.turbo',
            'message' => [
                [
                    'role' => 'system',
                    'content' => '誤字脱字を修正してください。',
                ],
                [
                    'role' => 'user',
                    'content' => $content['message'],
                ],
            ],
        ]);

        return new Response($chat);
    }

    /**
     * @param Request $request
     * @return Response
     * @throws \Exception
     *
     * @Route("/news/chat_gpt", name="admin_news_chat_gpt", methods={"POST"})
     */
    public function news(Request $request): Response
    {
        $content = json_decode($request->getContent(), true);
        $chat = $this->openAi->chat([
            'model' => 'gpt-3.5.turbo',
            'message' => [
                [
                    'role' => 'system',
                    'content' => '誤字脱字を修正してください。',
                ],
                [
                    'role' => 'user',
                    'content' => $content['message'],
                ],
            ],
        ]);

        return new Response($chat);
    }
}
