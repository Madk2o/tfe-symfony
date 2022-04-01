<?php

namespace App\Controller;
use App\Entity\Tracks;
use App\Entity\Playlists;
use App\Form\PlaylistsType;
use App\Repository\TracksRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/playlists')]
class PlaylistsController extends AbstractController
{
    #[Route('/', name: 'playlists_index', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager,Request $request, PaginatorInterface $paginator): Response
    {
        $playlists = $entityManager
            ->getRepository(Playlists::class)
            ->findAll();

            $playlistspag = $paginator->paginate(
                $playlists, // Requête contenant les données à paginer (ici nos articles)
                $request->query->getInt('page', 1), // Numéro de la page en cours, passé dans l'URL, 1 si aucune page
                6 // Nombre de résultats par page
            );

        return $this->render('playlists/index.html.twig', [
            'playlists' => $playlistspag,
        ]);
    }

    #[Route('/new', name: 'playlists_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $playlist = new Playlists();
        $form = $this->createForm(PlaylistsType::class, $playlist);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($playlist);
            $entityManager->flush();

            return $this->redirectToRoute('playlists_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('playlists/new.html.twig', [
            'playlist' => $playlist,
            'form' => $form,
        ]);
    }

    #[Route('/{playlistid}', name: 'playlists_show', methods: ['GET'])]
    public function show(Playlists $playlist): Response
    {
        return $this->render('playlists/show.html.twig', [
            'playlist' => $playlist,
        ]);
    }

    #[Route('/{playlistid}/edit', name: 'playlists_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Playlists $playlist, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(PlaylistsType::class, $playlist);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('playlists_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('playlists/edit.html.twig', [
            'playlist' => $playlist,
            'form' => $form,
        ]);
    }

    #[Route('/{playlistid}', name: 'playlists_delete', methods: ['POST'])]
    public function delete(Request $request, Playlists $playlist, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$playlist->getPlaylistid(), $request->request->get('_token'))) {
            $entityManager->remove($playlist);
            $entityManager->flush();
        }

        return $this->redirectToRoute('playlists_index', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('/getTracks/{playlistid}', name: 'playlist_tracks', methods: ['GET'])]
    public function playlisttracks(Playlists $playlistid,TracksRepository $repotrack, Request $request, PaginatorInterface $paginator): Response
    {
        $tracks=$repotrack->findTrackPlay($playlistid->getPlaylistId());
            $trackspag = $paginator->paginate(
            $tracks, // Requête contenant les données à paginer (ici nos articles)
            $request->query->getInt('page', 1), // Numéro de la page en cours, passé dans l'URL, 1 si aucune page
            6 // Nombre de résultats par page
        );

        return $this->render('tracks/index.html.twig', [
            'playlist'=> $playlistid->getName(),
            'tracks' => $trackspag
        ]);
    }

}
