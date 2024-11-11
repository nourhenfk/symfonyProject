<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Utilisateur;

class UtilisateurController extends AbstractController
{
    #[Route('/utilisateur', name: 'utilisateur_index')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        // Affichage de tous les utilisateurs
        $utilisateurs = $entityManager->getRepository(Utilisateur::class)->findAll();
        return $this->render('utilisateur/index.html.twig', ['utilisateurs' => $utilisateurs]);
    }

    #[Route('/utilisateur/{id}', name: 'utilisateur_show', requirements: ['id' => '\d+'])]
    public function show(int $id, EntityManagerInterface $entityManager): Response
    {
        // Affichage d'un profil utilisateur par ID
        $utilisateur = $entityManager->getRepository(Utilisateur::class)->find($id);
        return $this->render('utilisateur/show.html.twig', ['utilisateur' => $utilisateur]);
    }

    #[Route('/utilisateur/new', name: 'utilisateur_new', methods: ['GET', 'POST'])]
    public function create(Request $request, EntityManagerInterface $entityManager): Response
    {
        // Créer un nouvel utilisateur
        if ($request->isMethod('POST')) {
            $utilisateur = new Utilisateur();
            $utilisateur->setNom($request->request->get('nom'));
            $utilisateur->setPrenom($request->request->get('prenom'));
            $utilisateur->setEmail($request->request->get('email'));
            $utilisateur->setMotPasse($request->request->get('motPasse'));
            $utilisateur->setRole($request->request->get('role'));
            $entityManager->persist($utilisateur);
            $entityManager->flush();

            return $this->redirectToRoute('utilisateur_index');
        }

        return $this->render('utilisateur/new.html.twig');
    }

    #[Route('/utilisateur/{id}/edit', name: 'utilisateur_edit', methods: ['GET', 'POST'], requirements: ['id' => '\d+'])]
    public function edit(Request $request, int $id, EntityManagerInterface $entityManager): Response
    {
        // Modifier un utilisateur existant
        $utilisateur = $entityManager->getRepository(Utilisateur::class)->find($id);
        if ($request->isMethod('POST')) {
            $utilisateur->setNom($request->request->get('nom'));
            $utilisateur->setPrenom($request->request->get('prenom'));
            $utilisateur->setEmail($request->request->get('email'));
            $utilisateur->setMotPasse($request->request->get('motPasse'));
            $entityManager->flush();

            return $this->redirectToRoute('utilisateur_show', ['id' => $id]);
        }

        return $this->render('utilisateur/edit.html.twig', ['utilisateur' => $utilisateur]);
    }

    #[Route('/utilisateur/{id}/delete', name: 'utilisateur_delete', methods: ['POST'], requirements: ['id' => '\d+'])]
    public function delete(int $id, EntityManagerInterface $entityManager): Response
    {
        // Supprimer un utilisateur
        $utilisateur = $entityManager->getRepository(Utilisateur::class)->find($id);
        $entityManager->remove($utilisateur);
        $entityManager->flush();

        return $this->redirectToRoute('utilisateur_index');
    }
}
