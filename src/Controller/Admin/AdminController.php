<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Article;
use App\Repository\ArticleRepository;


class AdminController extends AbstractController
{
    /**
     * @Route("/admin/", name="admin.index", methods="GET")
     */
    public function index(ArticleRepository $articleRepository)
    {
        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminArticleController'
        ]);
    }
}
