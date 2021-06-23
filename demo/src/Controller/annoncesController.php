<?php 
namespace App\Controller ; 
use Symfony\Component\HttpFoundation\Response;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class annoncesController extends AbstractController
{

    public function index() : Response
    {
        return $this->render('annonces/home.html.twig', [
            'current_menu' => 'properties'
        ]) ;
    }
}