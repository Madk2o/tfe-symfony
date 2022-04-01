<?php

namespace App\Controller;

use App\Entity\Artists;
use App\Form\ArtistsType;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/artists')]
class ArtistsController extends AbstractController
{
    #[Route('/', name: 'artists_index', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager,Request $request, PaginatorInterface $paginator): Response
    {
        $artists = $entityManager
            ->getRepository(Artists::class)
            ->findAll();
            $artistspag = $paginator->paginate(
                $artists, // Requête contenant les données à paginer (ici nos articles)
                $request->query->getInt('page', 1), // Numéro de la page en cours, passé dans l'URL, 1 si aucune page
                6 // Nombre de résultats par page
            );
        return $this->render('artists/index.html.twig', [
            'artists' => $artistspag,
        ]);
    }

    #[Route('/new', name: 'artists_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $artist = new Artists();
        $form = $this->createForm(ArtistsType::class, $artist);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($artist);
            $entityManager->flush();

            return $this->redirectToRoute('artists_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('artists/new.html.twig', [
            'artist' => $artist,
            'form' => $form,
        ]);
    }

    #[Route('/{artistid}', name: 'artists_show', methods: ['GET'])]
    public function show(Artists $artist): Response
    {
        return $this->render('artists/show.html.twig', [
            'artist' => $artist,
        ]);
    }

    #[Route('/{artistid}/edit', name: 'artists_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Artists $artist, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ArtistsType::class, $artist);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('artists_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('artists/edit.html.twig', [
            'artist' => $artist,
            'form' => $form,
        ]);
    }

    #[Route('/{artistid}', name: 'artists_delete', methods: ['POST'])]
    public function delete(Request $request, Artists $artist, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$artist->getArtistid(), $request->request->get('_token'))) {
            $entityManager->remove($artist);
            $entityManager->flush();
        }

        return $this->redirectToRoute('artists_index', [], Response::HTTP_SEE_OTHER);
    }
}
