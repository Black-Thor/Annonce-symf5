<?php 
namespace App\Controller ; 

use App\Entity\NewAnnonces ; 
use App\Repository\NewAnnoncesRepository ; 

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class annoncesController extends AbstractController
{
    /**
     * @var PropertyRepository
     */

    private $repository ; 

    public function __construct(NewAnnoncesRepository $repository)
    {
        $this -> repository = $repository ; 
    }

    public function index() : Response
    {
       /* $em = $this-> getDoctrine() -> getManager() ;
        $annonces = new NewAnnonces(); 
        $annonces -> setTitle('Ma premier annonces') 
                -> setTelephone(00000000)
                -> setCodepostal(00000)
                -> setDate(\DateTime::createFromFormat('Y-m-d', "2018-09-09")) 
                -> setDescription ('mon annonces'); 

        $em->persist($annonces) ; 
        $em->flush() ; */
        //  $repository = $this->getDoctrine() ->getRepository(NewAnnonces::class) ; 

        $recup_annonces = $this-> repository -> findAll(); 
        dump($recup_annonces) ;
        return $this->render('annonces/home.html.twig', [
            'current_menu' => 'properties'
        ]) ;

    }
    /**
     * @Route ("/annonces/{slug}--{id}" , name=="annonces.show" , requirements = {"slug" : "[a-z0-9\-]*"})
     * @return Response
     */
    
     /*
    public  function show($slug , $id) : Response 
    {
        $annonces= $this->repository->find($id) ; 
        return $this->render('annonces/show.html.twig' , [
            'annonces' => $annonces,
            'current_menu' => 'properties'
        ]); 
        
    }
    */
}