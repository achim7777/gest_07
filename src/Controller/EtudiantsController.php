<?php

namespace App\Controller;

use App\Entity\Etudiants;
use App\Form\EtudiantType;
use App\Repository\EtudiantsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EtudiantsController extends AbstractController
{
    /**
     * @param EtudiantsRepository $repository
     * @param PaginatorInterface $paginator
     * @param Request $request
     * @return Response
     */
    #[Route('/etudiants', name: 'app_etudiants',methods: ['GET'])]
    public function index(EtudiantsRepository $repository,
    PaginatorInterface $paginator, Request $request): Response
    {
        $etudiant = $paginator->paginate(
            $repository->findAll(),
            $request->query->getInt('page', 1), 10
        );
        return $this->render('etudiants/index.html.twig', [
            'etudiant' => $etudiant
        ]);
    }

    /**
     * @param Request $request
     * @param EntityManagerInterface $manager
     * @return Response
     */
    #[Route('/etudiant/new', name: 'app_etudiant_new',methods:
        ['GET', 'POST'])]
    public function new(
        Request $request,
        EntityManagerInterface $manager
    ): Response
    {
        $etudiant = new Etudiants();
        $form = $this->createForm(EtudiantType::class, $etudiant);

        $form->handleRequest($request);
        if ($form->isSubmitted()  && $form->isValid()) {
            $etudiant =  $form->getData();

            $manager->persist($etudiant);
            $manager->flush();

            $this->addFlash(
                'success',
                'Votre etudiant a été créer avec succès'
            );

            return $this->redirectToRoute('app_etudiants');

        }

        return $this->render('etudiants/new.html.twig', [
            'form' => $form -> createView()
        ]);
    }

    /**
     * @param Etudiants $etudiant
     * @param Request $request
     * @param EntityManagerInterface $manager
     * @return Response
     */
    #[Route('/etudiant/edit/{id}', name: 'app_etudiant_edit',methods:
        ['GET', 'POST'])]
    public function edit(Etudiants $etudiant, Request $request,
                         EntityManagerInterface $manager) : Response
    {
        $form = $this->createForm(EtudiantType::class, $etudiant);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $etudiant = $form->getData();

            $manager->persist($etudiant);
            $manager->flush();

            $this->addFlash(
                'success',
                'Votre etudiant a été modifié avec succès'
            );

            return $this->redirectToRoute('app_etudiants');

        }

        return $this->render('etudiants/edit.html.twig', [
            'form' => $form->createView()
        ]);
    }

    #[Route('/etudiant/delete/{id}', name: 'app_etudiant_delete',
        methods: ['GET'])]
    public function delete(EntityManagerInterface $manager,
                           Etudiants $etudiant) : Response
    {
        $manager ->remove($etudiant);
        $manager ->flush();

        $this->addFlash(
            'success',
            'Votre etudiant a été suprimé avec succès'
        );

        return $this -> redirectToRoute('app_etudiants');
    }
}


