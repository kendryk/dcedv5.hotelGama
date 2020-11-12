<?php

namespace App\Controller;



use App\Entity\Accomodation;
use App\Entity\MinMax;
use App\Entity\Type;
use App\Form\TypeType;
use App\Repository\AccomodationRepository;
use App\Repository\TypeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

class DefaultController extends AbstractController
{


    /**
     * @Route("/", name="homepage" )
     * @param AccomodationRepository $accomodationRepository
     * @param TypeRepository $typeRepository
     * @return Response
     */
    public function index( Request $request, AccomodationRepository $accomodationRepository, TypeRepository $typeRepository): Response
    {
        //Affiche dynamiquement la liste de l'ensemble des logements sur la page d'accueil
        //Afficher dynamiquement la liste des types de logements dans le formulaire de recherche de la page d'accueil

        $type = $request->query->get('type_name');
        $prixMin = $request->query->get('prixMin');
        $prixMax = $request->query->get('prixMax');
        $types = $typeRepository->findAll();

        if ($request->query->count() > 0) {
            $accomodations = $accomodationRepository->findByPrice($type, $prixMin, $prixMax);
        }else{
            $accomodations = $accomodationRepository->findAccomodations();
        }

        return $this->render('default/index.html.twig', [
                'accomodations' => $accomodations,
                'types' => $types,
                'typeSelected' => $type,
                'prixMin' => $prixMin,
                'prixMax' => $prixMax,
            ]);

    }






    // /**
    // * @Route("/{id}", name="homepage" methods={"GET"})
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
