<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Article;
use App\Repository\ArticleRepository;

class HomeController extends AbstractController
{
    /**
     *@var ArticleRepository
     */
    private $articleRepository;

    public function __construct(ArticleRepository $articleRepository)
    {
        $this->articleRepository = $articleRepository;
    }

    /**
     * @Route("/", name="home")
     */
    public function index()
    {
        $articles = $this->articleRepository->fintLatest();
        return $this->render('home/index.html.twig', [
            'articles' => $articles,
            'controller_name' => 'HomeController'
        ]);
    }
    /**
     * @Route("/saveurlc", name="saveURLC")
     */
    public function saveURLC()
    {
        $articles = $this->articleRepository->fintLatest();
        return $this->render('home/index.html.twig', [
            'articles' => $articles,
            'controller_name' => 'HomeController'
        ]);
    }

}
