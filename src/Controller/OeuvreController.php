<?php


namespace App\Controller;

use App\Entity\Comment;
use App\Entity\Oeuvre;
use App\Form\CommentFormType;
use App\Form\CreateArtType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class OeuvreController extends AbstractController
{

    /**
     * @param Oeuvre $oeuvre
     * @param Request $request
     * @return Response
     */
    public function show(Oeuvre $oeuvre, Request $request)
    {
        //création du formulaire pour l'ajout de commentaire
        $commentForm = $this->createFormComment($oeuvre);

        //Gestion de l'ajout du commentaire
        $commentForm->handleRequest($request); //Récupère le POST
        if ($commentForm->isSubmitted() && $commentForm->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($commentForm->getData());
            $entityManager->flush();
            $commentForm = $this->createFormComment($request);
        }

        return $this->render(
            'oeuvre/show.html.twig',
            [
                'oeuvre'=>$oeuvre,
                'commentForm'=> $commentForm->createView() //on ajoute la Méthode createView à la variable $commentForm
            ]
        );
    }

    /**
     * @param Oeuvre $oeuvre
     * @return \Symfony\Component\Form\FormInterface
     */
    private function createFormComment(Oeuvre $oeuvre)
    {
        // Création d'un nouveau formulaire
        $comment = new Comment(); //instanciation de la classe
        $comment->setOeuvre($oeuvre); //
        return $this->createForm(CommentFormType::class, $comment);
    }


    /**
     * @param Request $request
     * @return Response
     */
    public function new(Request $request): Response
    {
        $oeuvre = new Oeuvre();
        $form = $this->createForm(CreateArtType::class, $oeuvre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($oeuvre);
            $entityManager->flush();
            $this->addFlash('success', 'Votre ajout est validé !');

            /*return $this->redirectToRoute('app_home');*/
            return $this->redirectToRoute('app_show', ['slug' => $oeuvre->getSlug()]);
        }

        return $this->render(
            'oeuvre/new.html.twig',
            ['createForm'=> $form->createView()]
        );
    }

    /**
     * @param Oeuvre $oeuvre
     * @param Request $request
     * @return Response
     */
    public function editOeuvre(Oeuvre $oeuvre, Request $request): Response
    {
        $form = $this->createForm(CreateArtType::class, $oeuvre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->flush();
            $this->addFlash('success', 'Votre Oeuvre est modifié !');

            /*return $this->redirectToRoute('app_home');*/
            return $this->redirectToRoute('app_home', ['slug' => $oeuvre->getSlug()]);
        }

        return $this->render(
            'oeuvre/edit.html.twig',
            ['formEditOeuvre'=> $form->createView()]
        );
    }

    /**
     * @param Oeuvre $oeuvre
     * @return Response
     */
    public function deleteOeuvre(Oeuvre $oeuvre): Response
    {
        //Récupération du manager
        $manager = $this->getDoctrine()->getManager();
        //Suppression de l'artiste
        $manager->remove($oeuvre);
        $manager->flush();
        //Redirection de la liste des artistes
        return $this->redirectToRoute('app_home');
    }
}
