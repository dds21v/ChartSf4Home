<?php


namespace App\Controller;

use App\Entity\AppUser;
use App\Form\UserFormType;
use App\Repository\AppUserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    /**
     * @return Response
     */
    public function listUser(): Response
    {
        // Récupération du Repository
        $repo = $this->getDoctrine()->getRepository(AppUser::class);
        // Récupération des utilisateurs
        $users = $repo->findAll();
        // Renvoi des utilisateurs à la vue
        return $this->render('user/list.html.twig', [
            'users' => $users
        ]);
    }


    /**
     * @Route("/admin/userlist/changement-roles/{id}", name="app_user_editrole", requirements={"id"="[0-9]+"})
     * @param int $id
     * @param Request $request
     * @return Response
     */
    public function editUser(int $id, Request $request): Response
    {
        //Récupération du repository
        $repo = $this->getDoctrine()->getRepository(AppUser::class);
        //récupération des Utilisateurs
        $users= $repo->findOneBy(['id' => $id]);

        // Instanciation du formulaire
        $form = $this->createForm(UserFormType::class, $users);

        //remplir le formulaire avec les variables $_POST
        $form->handleRequest($request);

        //On vérifie que le formulaire est soumis et validé
        if ($form->isSubmitted() && $form->isValid()) {
            //récupération du manager
            $entityManager = $this->getDoctrine()->getManager();
            // Maj de la bdd
            $entityManager->flush();
            // Ajout du message flash
            $this->addFlash('success', 'Le rôle a bien été modifié !');
        }


        //renvoi des Utilisateurs à la vue
        return $this->render('user/show.html.twig', [
            'user' => $users,
            'editForm' => $form->createView()]);
    }
}
