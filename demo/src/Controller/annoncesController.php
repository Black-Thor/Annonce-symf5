<?php 
namespace App\Controller ; 

use App\Entity\NewAnnonces ;
use App\Form\AnnoncesType;
use App\Repository\NewAnnoncesRepository ;
use Doctrine\ORM\EntityManagerInterface;
use http\Env\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


/**
 * Class annoncesController
 * @package App\Controller
 */
class annoncesController extends AbstractController
{
    /**
     * @var PropertyRepository
     */

    private $repository ;


    /**
     * annoncesController constructor.
     * @param NewAnnoncesRepository $repository
     */
    public function __construct(NewAnnoncesRepository $repository ,  EntityManagerInterface $em)
    {
        $this -> repository = $repository ;
        $this->em = $em ;

    }
    /**
     * @return Response
     * @Route ("/annonces",name="annonces.index" )
     */
    public function index() : Response
    {
        $recupAnnonces = $this->repository->findAll();
        return $this->render('annonces/home.html.twig', [
            'current_menu' => 'properties'
        ]) ;

    }
    /**
     * @Route ("/annonces/{slug}-{id}" , name="annonces.show" , requirements = {"slug" : "[a-z0-9\-]*"})
     * @return Response
     */

    public  function show(NewAnnonces $annonces, string $slug) : Response
    {
        if ($annonces->getSLug() !== $slug) {
         return   $this->redirectToRoute('annonces.show' , [
                'id' => $annonces -> getId() ,
                'slug' => $annonces -> getSLug()
            ],301) ;
        }

        return $this->render('annonces/show.html.twig' , [
            'annonces' => $annonces,
            'current_menu' => 'properties'
        ]);
        
    }
    /**
     * @Route ("/annonces/new" , name = "annonces.new")
     */
    public function new(\Symfony\Component\HttpFoundation\Request $request)
    {

        $annonces = new NewAnnonces() ;
        $form = $this->createForm(AnnoncesType::class, $annonces) ;

        $form->handleRequest($request) ;

        if ($form->isSubmitted() && $form->isValid()) {
            $this ->em->persist($annonces);
            $this->em->flush();
            return $this->redirectToRoute('annonces.index') ;
        }
        return $this->render('admin/new.html.twig', [
            'annonces' => $annonces ,
            'form' => $form -> createView()
        ] );
    }

}