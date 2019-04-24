<?php


namespace App\Controller;

use App\Entity\Artiste;
use App\Form\ArtisteFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ArtisteController extends AbstractController
{
    /**
     * @param Artiste $artist
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showArtist(Artiste $artist)
    {
        // Renvoi des artistes à la vue
        return $this->render(
            'artist/showArtist.html.twig',
            [
                'artist'=>$artist,
            ]
        );
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function newArtist(Request $request): Response
    {
        $artist = new Artiste();
        $formArtist = $this->createForm(ArtisteFormType::class, $artist);
        $formArtist->handleRequest($request);

        if ($formArtist->isSubmitted() && $formArtist->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($artist);
            $entityManager->flush();
            $this->addFlash('success', 'Votre profil Artiste est créé !');

            /*return $this->redirectToRoute('app_home');*/
            return $this->redirectToRoute('app_home', ['slug' => $artist->getSlug()]);
        }



        return $this->render(
            'artist/newArtist.html.twig',
            ['formArtist'=> $formArtist->createView()]
        );
    }

    /**
     * @param Artiste $artist
     * @param Request $request
     * @return Response
     */
    public function editArtist(Artiste $artist, Request $request): Response
    {
        $formArtist = $this->createForm(ArtisteFormType::class, $artist);
        $formArtist->handleRequest($request);

        if ($formArtist->isSubmitted() && $formArtist->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->flush();
            $this->addFlash('success', 'Votre profil Artiste est modifié !');

            /*return $this->redirectToRoute('app_home');*/
            return $this->redirectToRoute('app_home', ['slug' => $artist->getSlug()]);
        }

        return $this->render(
            'artist/editArtist.html.twig',
            ['formEditArtist'=> $formArtist->createView()]
        );
    }

    /**
     * @param Artiste $artiste
     * @return Response
     */
    public function deleteArtist(Artiste $artiste): Response
    {
        //Récupération du manager
        $manager = $this->getDoctrine()->getManager();
        //Suppression de l'artiste
        $manager->remove($artiste);
        $manager->flush();
        //Redirection de la liste des artistes
        return $this->redirectToRoute('app_home');
    }
}
