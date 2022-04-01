<?php

namespace App\Controller;

use App\Entity\MediaTypes;
use App\Form\MediaTypesType;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/media/types')]
class MediaTypesController extends AbstractController
{
    #[Route('/', name: 'media_types_index', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager,Request $request, PaginatorInterface $paginator): Response
    {
        $mediaTypes = $entityManager
            ->getRepository(MediaTypes::class)
            ->findAll();
            $mediaTypespag = $paginator->paginate(
                $mediaTypes, // Requête contenant les données à paginer (ici nos articles)
                $request->query->getInt('page', 1), // Numéro de la page en cours, passé dans l'URL, 1 si aucune page
                6 // Nombre de résultats par page
            );
        return $this->render('media_types/index.html.twig', [
            'media_types' => $mediaTypespag,
        ]);
    }

    #[Route('/new', name: 'media_types_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $mediaType = new MediaTypes();
        $form = $this->createForm(MediaTypesType::class, $mediaType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($mediaType);
            $entityManager->flush();

            return $this->redirectToRoute('media_types_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('media_types/new.html.twig', [
            'media_type' => $mediaType,
            'form' => $form,
        ]);
    }

    #[Route('/{mediatypeid}', name: 'media_types_show', methods: ['GET'])]
    public function show(MediaTypes $mediaType): Response
    {
        return $this->render('media_types/show.html.twig', [
            'media_type' => $mediaType,
        ]);
    }

    #[Route('/{mediatypeid}/edit', name: 'media_types_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, MediaTypes $mediaType, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(MediaTypesType::class, $mediaType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('media_types_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('media_types/edit.html.twig', [
            'media_type' => $mediaType,
            'form' => $form,
        ]);
    }

    #[Route('/{mediatypeid}', name: 'media_types_delete', methods: ['POST'])]
    public function delete(Request $request, MediaTypes $mediaType, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$mediaType->getMediatypeid(), $request->request->get('_token'))) {
            $entityManager->remove($mediaType);
            $entityManager->flush();
        }

        return $this->redirectToRoute('media_types_index', [], Response::HTTP_SEE_OTHER);
    }
}
