<?php

namespace App\Controller;

use App\Entity\Genres;
use App\Form\GenresType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;

#[Route('/genres')]
class GenresController extends AbstractController
{
    #[Route('/', name: 'genres_index', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager,Request $request, PaginatorInterface $paginator): Response
    {
        $genres = $entityManager
            ->getRepository(Genres::class)
            ->findAll();
            $genrespag = $paginator->paginate(
                $genres, // Requête contenant les données à paginer (ici nos articles)
                $request->query->getInt('page', 1), // Numéro de la page en cours, passé dans l'URL, 1 si aucune page
                6 // Nombre de résultats par page
            );
        return $this->render('genres/index.html.twig', [
            'genres' => $genrespag,
        ]);
    }

    #[Route('/new', name: 'genres_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $genre = new Genres();
        $form = $this->createForm(GenresType::class, $genre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($genre);
            $entityManager->flush();

            return $this->redirectToRoute('genres_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('genres/new.html.twig', [
            'genre' => $genre,
            'form' => $form,
        ]);
    }

    #[Route('/{genreid}', name: 'genres_show', methods: ['GET'])]
    public function show(Genres $genre): Response
    {
        return $this->render('genres/show.html.twig', [
            'genre' => $genre,
        ]);
    }

    #[Route('/{genreid}/edit', name: 'genres_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Genres $genre, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(GenresType::class, $genre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('genres_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('genres/edit.html.twig', [
            'genre' => $genre,
            'form' => $form,
        ]);
    }

    #[Route('/{genreid}', name: 'genres_delete', methods: ['POST'])]
    public function delete(Request $request, Genres $genre, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$genre->getGenreid(), $request->request->get('_token'))) {
            $entityManager->remove($genre);
            $entityManager->flush();
        }

        return $this->redirectToRoute('genres_index', [], Response::HTTP_SEE_OTHER);
    }
}
