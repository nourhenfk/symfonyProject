<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Benevole;
use App\Entity\Mission;

class BenevoleController extends AbstractController
{
    #[Route('/benevole', name: 'benevole_index')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        // Affichage de tous les bénévoles
        $benevoles = $entityManager->getRepository(Benevole::class)->findAll();
        return $this->render('benevole/index.html.twig', ['benevoles' => $benevoles]);
    }

    #[Route('/benevole/{id}', name: 'benevole_show', requirements: ['id' => '\d+'])]
    public function show(int $id, EntityManagerInterface $entityManager): Response
    {
        // Affichage du profil d'un bénévole par ID
        $benevole = $entityManager->getRepository(Benevole::class)->find($id);
        return $this->render('benevole/show.html.twig', ['benevole' => $benevole]);
    }

    #[Route('/benevole/new', name: 'benevole_new', methods: ['GET', 'POST'])]
    public function create(Request $request, EntityManagerInterface $entityManager): Response
    {
        // Créer un nouveau bénévole
        if ($request->isMethod('POST')) {
            $benevole = new Benevole();
            $benevole->setNom($request->request->get('nom'));
            $benevole->setPrenom($request->request->get('prenom'));
            $benevole->setEmail($request->request->get('email'));
            $benevole->setMotPasse($request->request->get('motPasse'));
            $entityManager->persist($benevole);
            $entityManager->flush();

            return $this->redirectToRoute('benevole_index');
        }

        return $this->render('benevole/new.html.twig');
    }

    #[Route('/benevole/{id}/edit', name: 'benevole_edit', methods: ['GET', 'POST'], requirements: ['id' => '\d+'])]
    public function edit(Request $request, int $id, EntityManagerInterface $entityManager): Response
    {
        // Modifier un bénévole existant
        $benevole = $entityManager->getRepository(Benevole::class)->find($id);
        if ($request->isMethod('POST')) {
            $benevole->setNom($request->request->get('nom'));
            $benevole->setPrenom($request->request->get('prenom'));
            $benevole->setEmail($request->request->get('email'));
            $entityManager->flush();

            return $this->redirectToRoute('benevole_show', ['id' => $id]);
        }

        return $this->render('benevole/edit.html.twig', ['benevole' => $benevole]);
    }

    #[Route('/benevole/{id}/delete', name: 'benevole_delete', methods: ['POST'], requirements: ['id' => '\d+'])]
    public function delete(int $id, EntityManagerInterface $entityManager): Response
    {
        // Supprimer un bénévole
        $benevole = $entityManager->getRepository(Benevole::class)->find($id);
        $entityManager->remove($benevole);
        $entityManager->flush();

        return $this->redirectToRoute('benevole_index');
    }

    #[Route('/benevole/{id}/missions', name: 'benevole_missions', methods: ['GET'], requirements: ['id' => '\d+'])]
    public function listMissions(int $id, EntityManagerInterface $entityManager): Response
    {
        // Afficher toutes les missions auxquelles un bénévole a postulé
        $benevole = $entityManager->getRepository(Benevole::class)->find($id);
        $missions = $benevole->getMissions();

        return $this->render('benevole/missions.html.twig', ['missions' => $missions]);
    }
}
