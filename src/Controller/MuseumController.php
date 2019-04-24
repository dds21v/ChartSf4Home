<?php


namespace App\Controller;

use App\Entity\Museum;
use App\Form\MuseumFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class MuseumController extends AbstractController
{
    /**
     * @param Museum $mus
     * @return Response
     */
    public function showMuseum(Museum $mus)
    {
        // Renvoi des artistes à la vue
        return $this->render(
            'museum/showMus.html.twig',
            [
                'museum'=>$mus,
            ]
        );
    }


    /**
     * @param Request $request
     * @return Response
     */
    public function newMuseum(Request $request): Response
    {
        $mus= new Museum();
        $formMus = $this->createForm(MuseumFormType::class, $mus);
        $formMus->handleRequest($request);
        if ($formMus->isSubmitted() && $formMus->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($mus);
            $entityManager->flush();
            $this->addFlash('success', 'Votre profil Artiste est créé !');

            /*return $this->redirectToRoute('app_home');*/
            return $this->redirectToRoute('app_home', ['slug' => $mus->getSlug()]);
        }



        return $this->render(
            'museum/newMus.html.twig',
            ['formMus'=> $formMus->createView()]
        );
    }


    /**
     * @param Museum $mus
     * @param Request $request
     * @return Response
     */
    public function editMuseum(Museum $mus, Request $request): Response
    {
        $formMus = $this->createForm(MuseumFormType::class, $mus);
        $formMus->handleRequest($request);

        if ($formMus->isSubmitted() && $formMus->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->flush();
            $this->addFlash('success', 'Votre profil Artiste est modifié !');

            /*return $this->redirectToRoute('app_home');*/
            return $this->redirectToRoute('app_home', ['slug' => $mus->getSlug()]);
        }

        return $this->render(
            'museum/editMus.html.twig',
            ['formEditMus'=> $formMus->createView()]
        );
    }


    public function deleteMuseum(Museum $mus): Response
    {
        //Récupération du manager
        $manager = $this->getDoctrine()->getManager();
        //Suppression de l'artiste
        $manager->remove($mus);
        $manager->flush();
        //Redirection de la liste des artistes
        return $this->redirectToRoute('app_home');
    }
}
