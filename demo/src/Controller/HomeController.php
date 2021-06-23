<?php 
namespace App\Controller ; 

use App\Repository\NewAnnoncesRepository ; 
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route; 
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
        
    /**
     * index
     *
     * @param  mixed $repository
     * @return Response
     */

    public function index(NewAnnoncesRepository $repository) : Response    
    {
        $annonces = $repository->findAll(); 
    
        return  $this->render('pages/home.html.twig', [
            'annonces' =>  $annonces 
        ]) ;
    }
}