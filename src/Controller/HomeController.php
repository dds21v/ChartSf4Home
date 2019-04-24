<?php


namespace App\Controller;

use App\Repository\ArtisteRepository;
use App\Repository\MuseumRepository;
use App\Repository\OeuvreRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{

    /**
     * @param OeuvreRepository $repository
     * @param ArtisteRepository $artisteRepository
     * @param MuseumRepository $museumRepository
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function home(OeuvreRepository $repository, ArtisteRepository $artisteRepository, MuseumRepository $museumRepository)
    {
        // Récupération de tous les articles
        $arts = $repository->findAll();
        $artist = $artisteRepository->findAll();
        $museum= $museumRepository->findAll();
        // Renvoi des articles à la vue
        return $this->render('home.html.twig', [
            'arts'=>$arts,
            'artists' => $artist,
            'museums' => $museum
        ]);
    }



    /*public function home(): Response
    {
        // Récupération du Repository
        $repository = $this->getDoctrine()->getRepository(Article::class);
        // Récupération de tout les articles
        $articles = $repository->findAll();
        // Renvoi des articles à la vue
        return $this->render(
            'home.html.twig',
            [
                'articles'=>$articles
            ]
        );
    }
    /**
     * @param string $slug
     * @return Response
     */
    /*
    public function show(string $slug): Response
    {
        // Récupération du Repository
        $repository = $this->getDoctrine()->getRepository(Article::class);
        // Récupération de tout les articles
        $article = $repository->findOneBy([
            'slug'=> $slug
        ]);
        // Renvoi des articles à la vue
        return $this->render(
            'article/show.html.twig',
            [
                'article'=>$article
            ]
        );
    }
    */
}
