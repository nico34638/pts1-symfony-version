<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ArticleRepository;
use App\Entity\Article;

class ArticleController extends AbstractController
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
     * @Route("/article", name="article.index")
     */
    public function index()
    {
        $articles = $this->articleRepository->findAllArticle();
        return $this->render('article/index.html.twig', [
            'controller_name' => 'ArticleController',
            'articles' => $articles,
        ]);
    }

    /**
     *@Route("/article/{slug}-{id}", name="article.show", requirements={"slug": "[a-z0-9\-]*"})
     *@return Response
     */
    public function show(Article $article, string $slug): Response
    {
      if($article->getSlug() !== $slug)
      {
        return $this->redirectToRoute('article.show',[
          'id' => $article->getId(),
          'slug' => $article->getSlug()
        ], 301);
      }

      $propositions = $this->articleRepository->findTrois();

      return $this->render('article/show.html.twig', [
          'article' => $article,
          'propositions' => $propositions,
          'current_menu' => 'article'
      ]);
    }


}
