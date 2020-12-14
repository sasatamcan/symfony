<?php

namespace App\Controller;

use App\Entity\Notes;
use App\Form\NotesType;
use App\Repository\NotesRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class MainController extends AbstractController
{
    /**
     * @var NotesRepository
     */
    private $notesRepository;

    /**
     * MainController constructor.
     * @param NotesRepository $notesRepository
     */
    public function __construct(NotesRepository $notesRepository)
    {
        $this->notesRepository = $notesRepository;
    }

    /**
     * @Route("/", name="index")
     * @param Request $request
     * @return RedirectResponse|Response
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function index(Request $request)
    {
        $user = $this->getUser();
    	$note = new Notes();
    	$form = $this->createForm(NotesType::class, $note);
    	$form->handleRequest($request);
    	if ($form->isSubmitted() && $form->isValid()) 
        {
            $this->notesRepository->save($note, $user);
            $this->addFlash('success', "Your note has been created successfully!");
            return $this->redirect($request->getUri());
        }
        $notes = $this->notesRepository->findAll();
        return $this->render('main/index.html.twig', [
            'form' => $form->createView(),
            'notes' => $notes
        ]);
    }
}
