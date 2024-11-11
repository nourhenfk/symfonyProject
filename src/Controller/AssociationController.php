<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Association;
use App\Entity\Projet;

class AssociationController extends AbstractController
{
    #[Route('/association', name: 'association_index')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        // Affichage de toutes les associations
        $associations = $entityManager->getRepository(Association::class)->findAll();
        return $this->render('association/index.html.twig', ['associations' => $associations]);
    }

    #[Route('/association/{id}', name: 'association_show', requirements: ['id' => '\d+'])]
    public function show(int $id, EntityManagerInterface $entityManager): Response
    {
        // Affichage d'une association spécifique par ID
        $association = $entityManager->getRepository(Association::class)->find($id);
        return $this->render('association/show.html.twig', ['association' => $association]);
    }

    #[Route('/association/new', name: 'association_new', methods: ['GET', 'POST'])]
    public function create(Request $request, EntityManagerInterface $entityManager): Response
    {
        // Créer une nouvelle association
        if ($request->isMethod('POST')) {
            $association = new Association();
            $association->setNom($request->request->get('nom'));
            $association->setDescription($request->request->get('description'));
            $entityManager->persist($association);
            $entityManager->flush();

            return $this->redirectToRoute('association_index');
        }

        return $this->render('association/new.html.twig');
    }

    #[Route('/association/{id}/edit', name: 'association_edit', methods: ['GET', 'POST'], requirements: ['id' => '\d+'])]
    public function edit(Request $request, int $id, EntityManagerInterface $entityManager): Response
    {
        // Modifier une association existante
        $association = $entityManager->getRepository(Association::class)->find($id);
        if ($request->isMethod('POST')) {
            $association->setNom($request->request->get('nom'));
            $association->setDescription($request->request->get('description'));
            $entityManager->flush();

            return $this->redirectToRoute('association_show', ['id' => $id]);
        }

        return $this->render('association/edit.html.twig', ['association' => $association]);
    }

    #[Route('/association/{id}/delete', name: 'association_delete', methods: ['POST'], requirements: ['id' => '\d+'])]
    public function delete(int $id, EntityManagerInterface $entityManager): Response
    {
        // Supprimer une association
        $association = $entityManager->getRepository(Association::class)->find($id);
        $entityManager->remove($association);
        $entityManager->flush();

        return $this->redirectToRoute('association_index');
    }

    #[Route('/association/{id}/projects', name: 'association_projects', methods: ['GET'], requirements: ['id' => '\d+'])]
    public function listProjects(int $id, EntityManagerInterface $entityManager): Response
    {
        // Liste des projets d'une association
        $association = $entityManager->getRepository(Association::class)->find($id);
        $projects = $association->getProjets();

        return $this->render('association/projects.html.twig', ['projects' => $projects]);
    }

    #[Route('/association/project/new', name: 'association_create_project', methods: ['GET', 'POST'])]
    public function createProject(Request $request, EntityManagerInterface $entityManager): Response
    {
        // Créer un nouveau projet
        if ($request->isMethod('POST')) {
            $project = new Projet();
            $project->setTitre($request->request->get('titre'));
            $project->setDescription($request->request->get('description'));
            $entityManager->persist($project);
            $entityManager->flush();

            return $this->redirectToRoute('association_index');
        }

        return $this->render('association/create_project.html.twig');
    }
}
