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
    public function __construct(NewAnnoncesRepository $repository, EntityManagerInterface $em)
    {
        $this->repository = $repository ;
        $this->em = $em ;
    }

    /**
     * @Route("/admin" , name="admin.annonces.index")
     */
    public function index(): Response
    {
      $annonces =  $this->repository->findAll();
      return $this->render('admin/index.html.twig', compact('annonces')) ;
    }

    /**
    * @Route ("/admin/new" , name = "admin.new")
     * {{# include ('admin/_form.html.twig' , {button: 'Ajouter' }) #}} pour charger la form retirer pour bug
     */
    public function new(Request $request)
    {

        $annonces = new NewAnnonces() ;
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
     * @Route("/admin/{id}" , name="admin.annonces.edit",  methods="GET | POST"))
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
    /**
     *
     * @Route("/admin/del-{id}" , name="admin.annonces.delete",  ))
     */

    /* CRUD symfo 35:
    methods="delete"
     * <form method="post" {{ path('admin.annonces.delete' , {id: annonces.id} ) }}" style="display: inline-block">
                        <input type="hidden" name="_method" value="DELETE">
                         <input type="hidden" name="_token" value="{{ csrf_token('delete' ~ annonces.id) }}">
                        <button class="btn btn-danger"> Supprimer </button>
                    </form>
    */
    public function delete (NewAnnonces $annonces)
    {
       /* ,Request $request
       if($this->isCsrfTokenValid('delete', $del_annonces->getId(),$del_annonces->get('_token')))
        {
             return new Response('suppresion') ;

        }*/

        $this->em->remove($annonces);
        $this->em->flush() ;
       return $this->redirectToRoute('admin.annonces.index') ;
    }
}