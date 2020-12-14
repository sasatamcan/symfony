<?php

namespace App\Controller;

use App\Entity\Notes;
use App\Repository\NotesRepository;
use Doctrine\ORM\ORMException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


/**
 * Class NotesController
 * @package App\Controller
 * @Route("/note")
 */
class NotesController extends AbstractController
{
    /**
     * @var NotesRepository
     */
    private $notesRepository;

    /**
     * NotesController constructor.
     * @param NotesRepository $notesRepository
     */
    public function __construct(NotesRepository $notesRepository)
    {
        $this->notesRepository = $notesRepository;
    }

    /**
     * @Route("/remove/{note}", name="note.remove")
     * @param Notes $note
     * @return RedirectResponse
     * @throws ORMException
     */
    public function remove(Notes $note)
    {
        $this->notesRepository->remove($note);
        return $this->redirectToRoute("index");
    }

    /**
     * @Route("/detils/{id}", name="note.detils")
     * @param Notes $note
     * @return Response
     */
    public function loadPost(Notes $note): Response
    {
    return $this->render('/notes/details_note.html.twig', [
        'note' => $note
    ]);
}

}
