<?php

namespace App\Controller;

use App\Entity\Articles;
use App\Repository\ArticlesRepository;
use App\Notification\ContactNotification;
use Doctrine\ORM\EntityManagerInterface; 
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BlogController extends AbstractController
{

    private $repository;

    public function __construct(ArticlesRepository $repository, EntityManagerInterface $entitymanager)
    {
        $this->repository = $repository;
        $this->entitymanager = $entitymanager;
    }

    /**
     * @Route("/Blog", name="blog.index")
     * param PropertyRepository $repository
     * @return Response
     */
    public function index(PaginatorInterface $paginator, Request $request): Response
    {

        $articles = $paginator->paginate(
            $this->repository->findAllVisibleQuery(),
            $request->query->getInt('page', 1),
            4
        );
        // $articles = $this->repository->FindLatest();
        return $this->render('pages/blog.html.twig', [
            'Articles' => $articles,
            'menu_actif3' => 'blog'    
        ]);
            
    }
    /**
     * @Route("/Blog/{slug}-{id}", name="blog.show", requirements={"slug": "[a-z0-9\-]*"})
     * @param Articles $articles
     * @return Response
     */

    public function show(Articles $articles, string $slug): Response
    {
        if ($articles->getSlug() !== $slug) {
            return $this->redirectToRoute('blog.show', [
                'id' => $articles->getId(),
                'slug' => $articles->getSlug()
            ], 301);
        }
        return $this->render('pages/show.html.twig', [
            'articles' => $articles, 
            'menu_actif3' => 'blog' 
        ]);
    }
    

}

?>