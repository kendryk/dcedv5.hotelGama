<?php

namespace App\Controller;



use App\Entity\Type;
use App\Form\TypeType;
use App\Repository\AccomodationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="homepage" )
     */
    public function index(AccomodationRepository $accomodationRepository ): Response
    {
        //Affiche dynamiquement la liste de l'ensemble des logements sur la page d'accueil
        //Afficher dynamiquement la liste des types de logements dans le formulaire de recherche de la page d'accueil

        $accomodations = $accomodationRepository->findAccomodations();


        return $this->render('default/index.html.twig', [
            'accomodations' => $accomodations,

        ]);
    }





   // /**
   // * @Route("/{id}{name}", name="homepage" methods={"GET","POST"})
   // */
   /* public function recherche( Request $request): Response
    {
        // Création d'une function récupérant les données de la page pour les ré-afficher
        //Création d'une instance de la classe Type
        $type = new Type();

        //Création le formulaire associé à la classe TypeType avec les données de $type
        $form = $this->createForm(TypeType::class, $type);

        //association des données récus lors de la requete au formulaire
        $form->handleRequest($query);

        //Vérification pour savoir si le formulaire a été envoyé et qu'il été validé
        if ($form->isSubmitted() && $form->isValid()) {

            //on récupere dans $type une instance

            $entityManager = $this->getDoctrine()->getManager();

            $entityManager->persist($type);
            $entityManager->flush();
            // redirection ves une route et maintient des parametres originaux
            return $this->redirectToRoute('homepage');
        }

        return $this->render('default/index.html.twig', [
            'type' => $type,
            'form' => $form->createView(),
        ]);
    } */






}
