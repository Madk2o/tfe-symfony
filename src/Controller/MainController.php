<?php 

namespace App\Controller;

use App\Entity\Artists;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/')]
class MainController extends AbstractController
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

}