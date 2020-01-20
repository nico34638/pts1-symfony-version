<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Article;
use App\Repository\ArticleRepository;

/**
 * @Route("/admin/article")
 */
class AdminArticleController extends AbstractController
{
    /**
     * @Route("/", name="admin.article.index", methods="GET")
     */
    public function index(ArticleRepository $articleRepository)
    {
        return $this->render('admin/article/index.html.twig', [
            'controller_name' => 'AdminArticleController',
            'articles' => $articleRepository->findAllArticle()
        ]);
    }
}
