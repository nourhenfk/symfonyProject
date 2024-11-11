<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Projet;
use App\Entity\Association;

class ProjetController extends AbstractController
{
    #[Route('/projet', name: 'projet_index')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        // Affichage de tous les projets
        $projets = $entityManager->getRepository(Projet::class)->findAll();
        return $this->render('projet/index.html.twig', ['projets' => $projets]);
    }

    #[Route('/projet/{id}', name: 'projet_show', requirements: ['id' => '\d+'])]
    public function show(int $id, EntityManagerInterface $entityManager): Response
    {
        // Affichage d'un projet par ID
        $projet = $entityManager->getRepository(Projet::class)->find($id);
        return $this->render('projet/show.html.twig', ['projet' => $projet]);
    }

    #[Route('/projet/new', name: 'projet_new', methods: ['GET', 'POST'])]
    public function create(Request $request, EntityManagerInterface $entityManager): Response
    {
        // Créer un nouveau projet
        if ($request->isMethod('POST')) {
            $projet = new Projet();
            $projet->setTitre($request->request->get('titre'));
            $projet->setDescription($request->request->get('description'));
            $projet->setDateDebut(new \DateTime($request->request->get('date_debut')));
            $projet->setDateFin(new \DateTime($request->request->get('date_fin')));
            $entityManager->persist($projet);
            $entityManager->flush();

            return $this->redirectToRoute('projet_index');
        }

        return $this->render('projet/new.html.twig');
    }

    #[Route('/projet/{id}/edit', name: 'projet_edit', methods: ['GET', 'POST'], requirements: ['id' => '\d+'])]
    public function edit(Request $request, int $id, EntityManagerInterface $entityManager): Response
    {
        // Modifier un projet existant
        $projet = $entityManager->getRepository(Projet::class)->find($id);
        if ($request->isMethod('POST')) {
            $projet->setTitre($request->request->get('titre'));
            $projet->setDescription($request->request->get('description'));
            $entityManager->flush();

            return $this->redirectToRoute('projet_show', ['id' => $id]);
        }

        return $this->render('projet/edit.html.twig', ['projet' => $projet]);
    }

    #[Route('/projet/{id}/delete', name: 'projet_delete', methods: ['POST'], requirements: ['id' => '\d+'])]
    public function delete(int $id, EntityManagerInterface $entityManager): Response
    {
        // Supprimer un projet
        $projet = $entityManager->getRepository(Projet::class)->find($id);
        $entityManager->remove($projet);
        $entityManager->flush();

        return $this->redirectToRoute('projet_index');
    }
}
