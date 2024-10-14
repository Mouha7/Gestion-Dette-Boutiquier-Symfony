<?php

namespace App\Controller;

use App\Entity\Client;
use App\Form\ClientType;
use App\Form\ClientSearchType;
use App\Entity\ClientSearchDTO;
use App\Repository\ClientRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ClientController extends AbstractController
{
    #[Route('/client', name: 'app_client', methods: ['GET', 'POST'])]
    public function index(ClientRepository $clientRepository, Request $request, EntityManagerInterface $entityManager): Response
    {
        // Formulaire de recherche
        $searchDTO = new ClientSearchDTO();
        $searchForm = $this->createForm(ClientSearchType::class, $searchDTO);
        $searchForm->handleRequest($request);

        // Pagination
        $page = $request->query->getInt('page', 1);
        $limit = 2; // Nombre d'éléments par page

        // Récupération des clients (avec ou sans recherche)
        if ($searchForm->isSubmitted() && $searchForm->isValid()) {
            $clients = $clientRepository->searchBySurnameOrTel(
                $searchDTO->getSearchTerm(),
                $page,
                $limit
            );
            $totalClients = $clientRepository->countSearchResults($searchDTO->getSearchTerm());
        } else {
            $clients = $clientRepository->findBy([], ['createAt' => 'DESC'], $limit, ($page - 1) * $limit);
            $totalClients = $clientRepository->count([]);
        }

        $maxPages = ceil($totalClients / $limit);

        // Formulaire de création de client
        $newClient = new Client();
        $clientForm = $this->createForm(ClientType::class, $newClient);
        $clientForm->handleRequest($request);

        if ($clientForm->isSubmitted() && $clientForm->isValid()) {
            $newClient->setCreateAt(new \DateTimeImmutable());
            $newClient->setUpdateAt(new \DateTimeImmutable());
            $entityManager->persist($newClient);
            $entityManager->flush();

            $this->addFlash('success', 'Client créé avec succès.');
            return $this->redirectToRoute('app_client');
        }

        return $this->render('client/index.html.twig', [
            'controller_name' => 'ClientController',
            'searchForm' => $searchForm->createView(),
            'clientForm' => $clientForm->createView(),
            'datas' => $clients,
            'currentPage' => $page,
            'maxPages' => $maxPages,
        ]);
    }
}