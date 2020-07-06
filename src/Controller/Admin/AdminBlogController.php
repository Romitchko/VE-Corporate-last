<?php
namespace App\Controller\Admin;

use App\Entity\Articles;
use App\Form\ArticleType;
use App\Repository\ArticlesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AdminBlogController extends AbstractController
{

    /**
     * @var ArticlesRepository
     */

    private $repository;

    public function __construct(ArticlesRepository $repository, EntityManagerInterface $em)
    {
        $this->repository = $repository;
        $this->em = $em;
    }

    /**
     * @route("/admin", name="pages.adminpages.index")
     * @return Response 
     */
    public function index2(): Response
    {
        $articles = $this->repository->findAll();
        return $this->render('pages/adminpages/index.html.twig', compact('articles'));
    }

    /**
     * @Route ("/admin/article/create", name="pages.adminpages.new")
     * @return Response
     */
    public function new(Request $request)
    {
        $articles = new Articles();
        $form = $this->createForm(ArticleType::class, $articles);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->persist($articles);
            $this->em->flush();
            $this->addFlash('success', 'Article créé avec succès.');
            return $this->redirectToRoute('pages.adminpages.index');
        }
        return $this->render('pages/adminpages/new.html.twig', [
            'articles' => $articles,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/article/{id}", name="pages.adminpages.edit", methods="GET|POST")
     * @param Articles $articles
     * @param Request $request
     * @return Response
     */
    public function edit(Articles $articles, Request $request)
    {
        $form = $this->createForm(ArticleType::class, $articles);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->flush();
            $this->addFlash('success', 'Article modifié avec succès.');
            return $this->redirectToRoute('pages.adminpages.index');
        }

        return $this->render('pages/adminpages/edit.html.twig', [
            'articles' => $articles,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/article/{id}", name="pages.adminpages.delete", methods="DELETE")
     * @param Articles $articles
     * @return void
     */
    public function delete(Articles $articles, Request $request)
    {
        if ($this->isCsrfTokenValid('delete' . $articles->getId(), $request->get('_token'))) {
            $this->em->remove($articles);
            $this->em->flush();
            $this->addFlash('success', 'Article supprimé avec succès.');
        }
        return $this->redirectToRoute('pages.adminpages.index');
    }







    
}