<?php 
namespace  App\Controller\admin;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route; 

use App\Repository\NewAnnoncesRepository ; 


class LuckyController extends AbstractController
{
   
    private $repository ; 

    public function __construct(NewAnnoncesRepository $repository)
    {
        $this -> repository = $repository ; 
    }

    /**
     * @Route("/path")
     */
    public function index(): Response
    {
      $annonces =  $this->repository->findAll(); 
      return $this->render('admin/index.html.twig', compact('annonces')) ; 
    }
}