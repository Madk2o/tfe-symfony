<?php

namespace App\Controller;

use App\Entity\Albums;
use App\Entity\Artists;
use App\Form\AlbumsType;
use App\Repository\AlbumsRepository;
use App\Repository\TracksRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/albums')]
class AlbumsController extends AbstractController
{
    #[Route('/', name: 'albums_index', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager,Request $request, PaginatorInterface $paginator): Response
    {
        $albums = $entityManager
            ->getRepository(Albums::class)
            ->findAll();
            $albumspag = $paginator->paginate(
                $albums, // Requête contenant les données à paginer (ici nos articles)
                $request->query->getInt('page', 1), // Numéro de la page en cours, passé dans l'URL, 1 si aucune page
                6 // Nombre de résultats par page
            );
        return $this->render('albums/index.html.twig', [
            'albums' => $albumspag,
        ]);
    }

    #[Route('/new', name: 'albums_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $album = new Albums();
        $form = $this->createForm(AlbumsType::class, $album);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($album);
            $entityManager->flush();

            return $this->redirectToRoute('albums_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('albums/new.html.twig', [
            'album' => $album,
            'form' => $form,
        ]);
    }

    #[Route('/{albumid}', name: 'albums_show', methods: ['GET'])]
    public function show(Albums $album): Response
    {
        return $this->render('albums/show.html.twig', [
            'album' => $album,
        ]);
    }

    #[Route('/{albumid}/edit', name: 'albums_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Albums $album, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(AlbumsType::class, $album);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('albums_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('albums/edit.html.twig', [
            'album' => $album,
            'form' => $form,
        ]);
    }

    #[Route('/{albumid}', name: 'albums_delete', methods: ['POST'])]
    public function delete(Request $request, Albums $album, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$album->getAlbumid(), $request->request->get('_token'))) {
            $entityManager->remove($album);
            $entityManager->flush();
        }

        return $this->redirectToRoute('albums_index', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('/getalbums/{artistid}', name: 'albums_artist', methods: ['GET'])]
    public function artist(AlbumsRepository $albums,Artists $artistid, Request $request, PaginatorInterface $paginator): Response
    {
        $albums = $albums->findBy(['artistid' => $artistid]);
        $albumspag = $paginator->paginate(
            $albums, // Requête contenant les données à paginer (ici nos articles)
            $request->query->getInt('page', 1), // Numéro de la page en cours, passé dans l'URL, 1 si aucune page
            6 // Nombre de résultats par page
        );

        return $this->render('albums/index.html.twig', [
            'albums' => $albumspag,
            'artist' => $artistid->getName(),
        ]);
    }
    #[Route('/getTracks/{albumid}/{artistid}', name: 'albums_tracks', methods: ['GET'])]
    public function getTracksByAlbum(AlbumsRepository $albums,TracksRepository $tracksRepo,Artists $artistid,Albums $albumid, Request $request, PaginatorInterface $paginator): Response
    {
        $tracks = $tracksRepo->findBy(['albumid' => $albumid]);
        $trackspag = $paginator->paginate(
            $tracks, // Requête contenant les données à paginer (ici nos articles)
            $request->query->getInt('page', 1), // Numéro de la page en cours, passé dans l'URL, 1 si aucune page
            6 // Nombre de résultats par page
        ); 

        return $this->render('tracks/index.html.twig', [
            'tracks' => $trackspag,
            'album' => $albumid->getTitle(),
            'artist' => $artistid->getName(),
        ]);
    }

}
