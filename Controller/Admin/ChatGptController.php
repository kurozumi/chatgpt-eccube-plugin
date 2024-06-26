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

namespace Plugin\ChatGpt\Controller\Admin;

use Eccube\Controller\AbstractController;
use Eccube\Util\CacheUtil;
use Eccube\Util\StringUtil;
use Orhanerday\OpenAi\OpenAi;
use Plugin\ChatGpt\Entity\ChatGpt;
use Plugin\ChatGpt\Form\Type\Admin\ChatGptType;
use Plugin\ChatGpt\Repository\ChatGptRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/%eccube_admin_route%/chat_gpt")
 */
class ChatGptController extends AbstractController
{
    /**
     * @var OpenAi
     */
    private OpenAi $openAi;

    /**
     * @var ChatGptRepository
     */
    private ChatGptRepository $chatGptRepository;

    public function __construct(OpenAi $openAi, ChatGptRepository $chatGptRepository)
    {
        $this->openAi = $openAi;
        $this->chatGptRepository = $chatGptRepository;
    }

    /**
     * @param Request $request
     * @param CacheUtil $cacheUtil
     *
     * @return array|\Symfony\Component\HttpFoundation\RedirectResponse
     *
     * @throws \Exception
     *
     * @Route("/config", name="admin_chat_gpt_config")
     *
     * @Template("@ChatGpt/admin/config.twig")
     */
    public function config(Request $request, CacheUtil $cacheUtil)
    {
        $chatGpt = $this->chatGptRepository->get();
        $form = $this->createForm(ChatGptType::class, $chatGpt);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var ChatGpt $chatGpt */
            $chatGpt = $form->getData();
            $this->entityManager->persist($chatGpt);
            $this->entityManager->flush();

            $envFile = $this->getParameter('kernel.project_dir').'/.env';
            $env = file_get_contents($envFile);

            $env = StringUtil::replaceOrAddEnv($env, [
                'OPENAI_API_KEY' => $chatGpt->getApiKey(),
            ]);

            file_put_contents($envFile, $env);

            $cacheUtil->clearCache();

            $this->addSuccess('登録しました。', 'admin');

            return $this->redirectToRoute('admin_chat_gpt_config');
        }

        return [
            'form' => $form->createView(),
        ];
    }

    /**
     * @param Request $request
     *
     * @return Response
     *
     * @throws \Exception
     *
     * @Route("/product", name="admin_chat_gpt_product", methods={"POST"})
     */
    public function product(Request $request): Response
    {
        $this->isTokenValid();

        /** @var ChatGpt $chatGpt */
        $chatGpt = $this->chatGptRepository->get(ChatGpt::ID);

        $content = json_decode($request->getContent(), true);

        $messages = [
            [
                'role' => 'user',
                'content' => $content['prompt'],
            ],
        ];
        if (null !== $chatGpt->getProduct()) {
            $messages[] = [
                'role' => 'system',
                'content' => $chatGpt->getProduct(),
            ];
        }

        $chat = $this->openAi->chat([
            'model' => $chatGpt->getModel(),
            'messages' => $messages,
        ]);

        return new Response($chat);
    }

    /**
     * @param Request $request
     *
     * @return Response
     *
     * @throws \Exception
     *
     * @Route("/news", name="admin_chat_gpt_news", methods={"POST"})
     */
    public function news(Request $request): Response
    {
        $this->isTokenValid();

        /** @var ChatGpt $chatGpt */
        $chatGpt = $this->chatGptRepository->get(ChatGpt::ID);

        $content = json_decode($request->getContent(), true);

        $messages = [
            [
                'role' => 'user',
                'content' => $content['prompt'],
            ],
        ];
        if (null !== $chatGpt->getProduct()) {
            $messages[] = [
                'role' => 'system',
                'content' => $chatGpt->getNews(),
            ];
        }

        $chat = $this->openAi->chat([
            'model' => $chatGpt->getModel(),
            'messages' => $messages,
        ]);

        return new Response($chat);
    }
}
