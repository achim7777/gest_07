<?php

namespace App\Controller;

use App\Entity\Enseignant;
use App\Form\EnseignantType;
use App\Repository\EnseignantRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EnseignantController extends AbstractController
{
    /**
     * @param EnseignantRepository $repository
     * @param PaginatorInterface $paginator
     * @param Request $request
     * @return Response
     */

    #[Route('/enseignant', name: 'app_enseignant', methods: ['GET'])]
    public function index(EnseignantRepository $repository, PaginatorInterface $paginator,
    Request $request): Response
    {
        $enseignant = $paginator->paginate(
            $repository->findAll(),
            $request->query->getInt('page', 1), 12
        );
        return $this->render('enseignant/index.html.twig', [
            'enseignant' => $enseignant
        ]);
    }

    /**
     * @param Request $request
     * @param EntityManagerInterface $manager
     * @return Response
     */
    #[Route('/enseignant/new', name: 'app_enseignant_new',methods:
        ['GET', 'POST'])]
    public function new(
        Request $request,
        EntityManagerInterface $manager
    ): Response
    {
        $enseignant = new Enseignant();
        $form = $this->createForm(EnseignantType::class, $enseignant);

        $form->handleRequest($request);
        if ($form->isSubmitted()  && $form->isValid()) {
        $enseignant =  $form->getData();

        $manager->persist($enseignant);
        $manager->flush();

        $this->addFlash(
            'success',
            'Votre enseignant a été créer avec succès'
        );

        return $this->redirectToRoute('app_enseignant');

        }

        return $this->render('enseignant/new.html.twig', [
            'form' => $form -> createView()
        ]);
    }

    /**
     * @param Enseignant $enseignant
     * @param Request $request
     * @param EntityManagerInterface $manager
     * @return Response
     */
    #[Route('/enseignant/edit/{id}', name: 'app_enseignant_edit',methods:
    ['GET', 'POST'])]
    public function edit(Enseignant $enseignant, Request $request,
        EntityManagerInterface $manager) : Response
    {
        $form = $this->createForm(EnseignantType::class, $enseignant);

        $form->handleRequest($request);
        if ($form->isSubmitted()  && $form->isValid()) {
            $enseignant =  $form->getData();

            $manager->persist($enseignant);
            $manager->flush();

            $this->addFlash(
                'success',
                'Votre enseignant a été modifié avec succès'
            );

            return $this->redirectToRoute('app_enseignant');

        }

        return  $this->render('enseignant/edit.html.twig', [
            'form' => $form->createView()
        ]);
    }

    #[Route('/enseignant/delete/{id}', name: 'app_enseignant_delete',
        methods: ['GET'])]
    public function delete(EntityManagerInterface $manager,
        Enseignant $enseignant) : Response
    {
        $manager ->remove($enseignant);
        $manager ->flush();

        $this->addFlash(
            'success',
            'Votre enseignant a été suprimé avec succès'
        );

        return $this -> redirectToRoute('app_enseignant');
    }
}
