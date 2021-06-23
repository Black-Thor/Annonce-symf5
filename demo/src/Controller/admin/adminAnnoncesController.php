<?php 
namespace  App\Controller\admin;

use App\Entity\NewAnnonces;
use App\Form\AnnoncesType;

use App\Repository\NewAnnoncesRepository ;
use Doctrine\ORM\EntityManagerInterface;

use Symfony\Component\HttpFoundation\Request;
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
    public function __construct(NewAnnoncesRepository $repository, EntityManagerInterface $em)
    {
        $this-> repository = $repository ;
        $this-> em = $em ;
        
        
    }

    /**
     *  @return Response
     * @Route("/admin" , name="admin.annonces.index")
     *
     */
    public function index(): Response
    {
      $annonces =  $this->repository->findAll(); 
      return $this->render('admin/index.html.twig', compact('annonces')) ;
    }

    /**
     * @Route ("/admin" , name ="admin.annonces.new)
     */
    public function new(Request $request)
    {
        $annonces = new annonces() ;
        $form = $this->createForm(AnnoncesType::class, $annonces) ;

        $form->handleRequest($request) ;

        if ($form->isSubmitted() && $form->isValid()) {
            $this ->em->persist($annonces);
            $this->em->flush();
            return $this->redirectToRoute('admin.annonces.index') ;
        }
        return $this->render('admin/new.html.twig', [
            'annonces' => $annonces ,
            'form' => $form -> createView()
        ] );
    }
    /**
     *  @return Response
     * @Route("/admin/{id}" , name="admin.annonces.edit")
     *
     */
    public function edit(NewAnnonces $annonces, Request $request)
    {
        $form = $this->createForm(AnnoncesType::class, $annonces) ;
        $form->handleRequest($request) ;
        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->flush();
            return $this->redirectToRoute('admin.annonces.index') ;
        }
        return $this->render('admin/edit.html.twig', [
           'annonces' => $annonces ,
           'form' => $form -> createView()
        ] );
    }
}