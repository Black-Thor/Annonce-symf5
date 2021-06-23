<?php 
namespace  App\Controller\admin;

use App\Entity\NewAnnonces;
use App\Repository\NewAnnoncesRepository ;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route; 

class adminAnnoncesController extends AbstractController
{
   
    private $repository ;

    /**
     * adminAnnoncesController constructor.
     * @param NewAnnoncesRepository $repository
     */
    public function __construct(NewAnnoncesRepository $repository)
    {
        $this -> repository = $repository ; 
    }

    /**
     * @Return Response
     * @Route("/admin" , name=="admin.annonces.index")
     *
     */
    public function index(): Response
    {
      $annonces =  $this->repository->findAll(); 
      return $this->render('admin/index.html.twig', compact('annonces')) ;
    }
    /**
     * @Return Response
     * @Route("/admin/{id}" , name=="admin.annonces.edit")
     *
     */
    public function edit(NewAnnonces $annonces)
    {
        return $this->render('admin/annonces/edit.html.twig', compact('annonces')) ;
    }
}