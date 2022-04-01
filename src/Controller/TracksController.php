<?php

namespace App\Controller;
use App\Entity\Artists;
use App\Entity\Tracks;
use App\Form\TracksType;
use App\Entity\Playlists;
use App\Repository\TracksRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/tracks')]
class TracksController extends AbstractController
{
    #[Route('/', name: 'tracks_index', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager,Request $request, PaginatorInterface $paginator): Response
    {
        $tracks = $entityManager
            ->getRepository(Tracks::class)
            ->findAll();

            $trackspag = $paginator->paginate(
                $tracks, // Requête contenant les données à paginer (ici nos articles)
                $request->query->getInt('page', 1), // Numéro de la page en cours, passé dans l'URL, 1 si aucune page
                6 // Nombre de résultats par page
            );
        return $this->render('tracks/index.html.twig', [
            'tracks' => $trackspag,
        ]);
    }

    #[Route('/new', name: 'tracks_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $track = new Tracks();
        $form = $this->createForm(TracksType::class, $track);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($track);
            $entityManager->flush();

            return $this->redirectToRoute('tracks_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('tracks/new.html.twig', [
            'track' => $track,
            'form' => $form,
        ]);
    }

    #[Route('/{trackid}', name: 'tracks_show', methods: ['GET'])]
    public function show(Tracks $track): Response
    {
        return $this->render('tracks/show.html.twig', [
            'track' => $track,
        ]);
    }

    #[Route('/{trackid}/edit', name: 'tracks_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Tracks $track, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(TracksType::class, $track);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('tracks_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('tracks/edit.html.twig', [
            'track' => $track,
            'form' => $form,
        ]);
    }

    #[Route('/{trackid}', name: 'tracks_delete', methods: ['POST'])]
    public function delete(Request $request, Tracks $track, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$track->getTrackid(), $request->request->get('_token'))) {
            $entityManager->remove($track);
            $entityManager->flush();
        }

        return $this->redirectToRoute('tracks_index', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('/getTracks/{playlistid}', name: 'playlist_tracks', methods: ['GET'])]
    public function playlisttracks(Playlists $playlistid,TracksRepository $repotrack, Request $request, PaginatorInterface $paginator): Response
    {
        $tracks=$repotrack->findTrackPlay($playlistid->getPlaylistId());
        $trackspag = $paginator->paginate(

            $tracks,
            $request->query->getInt('page', 1), 
            6 
        );

        return $this->render('tracks/index.html.twig', [

            'playlist'=> $playlistid->getName(),
            'tracks' => $trackspag
        ]);
    }

}
