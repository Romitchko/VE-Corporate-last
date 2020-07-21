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

use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

 /**
  * Requière ROLE_ADMIN pour *tous* les controllers methods dans cette class.
  *
  * @IsGranted("ROLE_ADMIN")
  */
class AdminBlogController extends AbstractController
{

    /**
     * @var ArticlesRepository
     */

    private $repository;

    public function __construct(ArticlesRepository $repository, EntityManagerInterface $em)
    { /* ArticlesRepository = conteneur qui stock tous les articles pour les afficher puis filtre avec méthode findAll */
        /* EntityManager permet de persister et flush les articles */
        $this->repository = $repository; /* initialisation de repository*/ 
        $this->em = $em; /* initialisation de l'em */
    }

    /**
     * @route("/admin", name="pages.adminpages.index")
     * @return Response 
     */
    public function index2(): Response
    {
        $articles = $this->repository->findAll(); /* repository execute methode findAll articles */
        return $this->render('pages/adminpages/index.html.twig', compact('articles')); /* retourne page */
    }

    /**
     * @Route ("/admin/article/create", name="pages.adminpages.new")
     * @return Response
     */
    public function new(Request $request)
    {
        $articles = new Articles(); /* créer article nouveau */
        $form = $this->createForm(ArticleType::class, $articles); /* créer un form article */
        $form->handleRequest($request); /* handlerequest */

        if ($form->isSubmitted() && $form->isValid()) { /* si form soumis et valide */
            $this->em->persist($articles); /* entitymanager persiste la donnée */
            $this->em->flush(); /* entitymanager flush à la BDD */
            $this->addFlash('success', 'Article créé avec succès.'); /* message à l'user */
            return $this->redirectToRoute('pages.adminpages.index'); /* redirection user */
        }
        return $this->render('pages/adminpages/new.html.twig', [ /* rendre vue new article */
            'articles' => $articles, 
            'form' => $form->createView() /* créer la vue depuis le form */
        ]);
    }

    /**
     * @Route("/admin/article/{id}", name="pages.adminpages.edit", methods="GET|POST")
     * @param Articles $articles
     * @param Request $request
     * @return Response
     */
    public function edit(Articles $articles, Request $request) /* récuperation article */
    {
        $form = $this->createForm(ArticleType::class, $articles); /* creation du form depuis ArticleType */
        $form->handleRequest($request); /* handlerequest form */

        if ($form->isSubmitted() && $form->isValid()) { /* si form soumis et valide */
            $this->em->flush(); /* entitymanager flush a la BDD */
            $this->addFlash('success', 'Article modifié avec succès.'); /* message succès user */
            return $this->redirectToRoute('pages.adminpages.index'); /* redirect user */
        }

        return $this->render('pages/adminpages/edit.html.twig', [ /* rendre vue edit */
            'articles' => $articles,
            'form' => $form->createView() /* créer vue form */
        ]);
    }

    /**
     * @Route("/admin/article/{id}", name="pages.adminpages.delete", methods="DELETE")
     * @param Articles $articles
     * @return void
     */
    public function delete(Articles $articles, Request $request) /* fonction delete article */
    {
        if ($this->isCsrfTokenValid('delete' . $articles->getId(), $request->get('_token'))) { 
            /* si TOKEN delete est valide, recupere id article, recupere le token */
            $this->em->remove($articles); /* entitymanager methode remove */
            $this->em->flush(); /* entitymanager flush BDD */
            $this->addFlash('success', 'Article supprimé avec succès.'); /*message user succes */
        }
        return $this->redirectToRoute('pages.adminpages.index'); /* redirection user */
    }







    
}