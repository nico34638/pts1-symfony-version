<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Article;
use App\Repository\ArticleRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
/**
 * @Route("/admin/article")
 */
class AdminArticleController extends AbstractController
{
    /**
     *@var ArticleRepository
     */
    private $articleRepository;

    /**
     *@var EntityManagerInterface
     */
    private $em;

    public function __construct(ArticleRepository $articleRepository, EntityManagerInterface $em)
    {
        $this->articleRepository = $articleRepository;
        $this->em = $em;
    }

    /**
     * @Route("/", name="admin.article.index", methods="GET")
     */
    public function index()
    {
        return $this->render('admin/article/index.html.twig', [
            'controller_name' => 'AdminArticleController',
            'articles' => $this->articleRepository->findAllArticle()
        ]);
    }

    /**
     * @Route("/edit", name="admin.article.edit", methods="GET")
     */
    public function edit()
    {
        return $this->render('admin/article/index.html.twig', [
            'articles' => $this->articleRepository->findAllArticle()
        ]);
    }

    /**
     * @Route("/{id}", name="admin.article.delete", methods="DELETE")
     */
     public function delete(Article $article, Request $request)
     {
         if($this->isCsrfTokenValid('delete' . $article->getId(), $request->get('_token')))
         {
           $this->em->remove($article);
           $this->em->flush();
           $this->addFlash('success', 'Supprimé avec succès');
         }
         return $this->redirectToRoute('admin.article.index');
     }
}
