<?php

namespace App\Controller;

use App\Entity\Notes;
use App\Form\NotesType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class MainController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index(Request $request)
    {
   		$em = $this->getDoctrine()->getManager();
    	$note = new Notes();
    	$form = $this->createForm(NotesType::class, $note);
    	$form->handleRequest($request);
    	if ($form->isSubmitted() && $form->isValid()) 
        {
            $data = $form->getData();
            $em->persist($note);
            $em->flush();
            return $this->redirectToRoute("index");
        }
        $notes = $em->getRepository(Notes::class)->findAll();
        return $this->render('main/index.html.twig', [
            'controller_name' => 'MainController',
            'form' => $form->createView(),
            'notes' => $notes
        ]);
    }
    /**
     * @Route("/remove/{note}", name="remove")
     */
    public function remove(Notes $note, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($note);
        $em->flush();
        return $this->redirectToRoute("index");
    }
}
