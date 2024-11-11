<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Mission;
use App\Entity\Benevole;

class MissionController extends AbstractController
{
    #[Route('/missions', name: 'mission_index')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        // Affichage de toutes les missions
        $missions = $entityManager->getRepository(Mission::class)->findAll();
        return $this->render('mission/index.html.twig', ['missions' => $missions]);
    }

    #[Route('/mission/{id}', name: 'mission_show', requirements: ['id' => '\d+'])]
    public function show(int $id, EntityManagerInterface $entityManager): Response
    {
        // Affichage d'une mission par ID
        $mission = $entityManager->getRepository(Mission::class)->find($id);
        return $this->render('mission/show.html.twig', ['mission' => $mission]);
    }

    #[Route('/mission/apply/{id}', name: 'mission_apply', methods: ['POST'], requirements: ['id' => '\d+'])]
    public function apply(int $id, EntityManagerInterface $entityManager): Response
    {
        // Postuler à une mission
        $mission = $entityManager->getRepository(Mission::class)->find($id);
        $benevole = $this->getUser(); // Le bénévole connecté
        $mission->addBenevole($benevole);
        $entityManager->flush();

        return $this->redirectToRoute('mission_show', ['id' => $id]);
    }

    #[Route('/mission/new', name: 'mission_new', methods: ['GET', 'POST'])]
    public function create(Request $request, EntityManagerInterface $entityManager): Response
    {
        // Créer une nouvelle mission
        if ($request->isMethod('POST')) {
            $mission = new Mission();
            $mission->setTitre($request->request->get('titre'));
            $mission->setDescription($request->request->get('description'));
            $mission->setDateDebut(new \DateTime($request->request->get('date_debut')));
            $mission->setDateFin(new \DateTime($request->request->get('date_fin')));
            $entityManager->persist($mission);
            $entityManager->flush();

            return $this->redirectToRoute('mission_index');
        }

        return $this->render('mission/new.html.twig');
    }
}
