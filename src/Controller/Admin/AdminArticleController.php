<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Article;
use App\Repository\ArticleRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use App\Form\ArticleType;

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
     *@Route("/create", name="admin.article.new")
     *@param Request $request
     */
    public function new(Request $request)
    {
        $article = new Article();
        $form = $this->createForm(ArticleType::class, $article);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
          $this->em->persist($article);
          $this->em->flush();
          $this->addFlash('success', 'Crée avec succès');
          return $this->redirectToRoute('admin.article.index');
        }

        return $this->render('admin/article/new.html.twig',[
            'article' => $article,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/edit/{id}", name="admin.article.edit", methods="GET|POST")
     *@param Article $article
     *@param Request $request
     *@return \Symfony\Component\HttpFoundation\Response
     */
    public function edit(Article $article, Request $request)
    {
        $form = $this->createForm(ArticleType::class, $article);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
          $this->em->flush();
          $this->addFlash('success', 'Modifié avec succès');
          return $this->redirectToRoute('admin.article.index');
        }

        return $this->render('admin/article/edit.html.twig', [
            'article' => $article,
            'form' => $form->createView()
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
