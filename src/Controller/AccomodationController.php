<?php

namespace App\Controller;

use App\Entity\Accomodation;
use App\Entity\Booking;
use App\Entity\User;
use App\Form\AccomodationType;
use App\Form\BookingType;
use App\Repository\AccomodationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

/**
 * @Route("/accomodation")
 */
class AccomodationController extends AbstractController
{
    /**
     * @Route("/newAccomodation", name="newAccomodation", methods={"GET"})
     */
    public function recupBooking(Request $request, AccomodationRepository $accomodationRepository): Response
    {
        // Création d'une réservation
        $accomodation = $request->query->get('Accomodation');
        $date_start = $request->query->get('date-start');
        $date_end = $request->query->get('date-end');

        //if($this->getUser() != $request->getUser()){
        //    throw $this->createAccessDeniedException('Veuillez vous inscrire pour réserver une date');
        //}

        var_dump($date_start);
        if($date_start ){

            $booking = new Booking();

            $user = $this->getUser();

            $booking->setUser($user);
            $booking->setAccomodation( $accomodationRepository->find($accomodation));
            $booking->setDateStart( new \DateTime($date_start));

            $booking->setDateEnd(new \DateTime($date_end));

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($booking);
            $entityManager->flush();
        }

        return $this->render('accomodation/index.html.twig', [
            'accomodations' => $accomodationRepository->findAll(),
        ]);

    }

     /**
     /* @Route("/", name="accomodation_index")
     */
    public function index(AccomodationRepository $accomodationRepository): Response
    {
        return $this->render('accomodation/index.html.twig', [
            'accomodations' => $accomodationRepository->findAll(),
        ]);
    }
    /**
    /* @Route("/all", name="accomodation_all" )
     */
    public function page2(AccomodationRepository $accomodationRepository): Response
    {
        return $this->render('accomodation/all.html.twig', [
            'accomodations' => $accomodationRepository->findAll(),
        ]);
    }


    /**
     * @Route("/new", name="accomodation_new", methods={"GET","POST"})
     */

    public function new(Request $request, SluggerInterface $slugger): Response
    {
        $accomodation = new Accomodation();

        $form = $this->createForm(AccomodationType::class, $accomodation);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $pictureFile = $form->get('pictureFile')->getData();

            if ($pictureFile) {
                $originalFilename = pathinfo($pictureFile->getClientOriginalName(), PATHINFO_FILENAME);

                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename . '-' . uniqid() . '.' . $pictureFile->guessExtension();

                try {
                    $pictureFile->move(
                        "uploads/", $newFilename
                    );
                }
                catch (FileException $e) {

                }
                $accomodation->setPhoto($newFilename);
            }

            $accomodation = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($accomodation);
            $entityManager->flush();

            return $this->redirectToRoute('accomodation_index');
        }

        return $this->render('accomodation/new.html.twig', [
            'accomodation' => $accomodation,
            'form' => $form->createView(),
        ]);
    }


    /**
    * @Route("/{id}", name="accomodation_show", methods={"GET"})
     */
    public function show(Accomodation $accomodation): Response
    {
        return $this->render('accomodation/show.html.twig', [
            'accomodation' => $accomodation,
        ]);
    }


    /**
     * @Route("/new", name="accomodation_new", methods={"GET"})
    */
    public function accomodations(Accomodation $accomodation): Response
    {
        return $this->render('accomodation/new.html.twig', [
            'accomodation' => $accomodation,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="accomodation_edit", methods={"GET","POST"})
    */

    public function edit(Request $request, Accomodation $accomodation): Response
    {
        $form = $this->createForm(AccomodationType::class, $accomodation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('accomodation_index');
        }

        return $this->render('accomodation/edit.html.twig', [
            'accomodation' => $accomodation,
            'form' => $form->createView(),
        ]);
    }


    /**
    * @Route("/{id}", name="accomodation_delete", methods={"DELETE"})
    */

    public function delete(Request $request, Accomodation $accomodation): Response
    {
        if ($this->isCsrfTokenValid('delete'.$accomodation->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($accomodation);
            $entityManager->flush();
        }

        return $this->redirectToRoute('accomodation_index');
    }



}
