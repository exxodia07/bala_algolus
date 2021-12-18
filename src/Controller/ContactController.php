<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Contact;
use App\Repository\ContactRepository;

class ContactController extends AbstractController
{
    private $entityManager;
    private $contactRepository;
    public function __construct(EntityManagerInterface $em, ContactRepository $contactRepository)
    {
        $this->entityManager = $em;
        $this->contactRepository = $contactRepository;
    }

    /**
     * @Route("Mise-A-Jour-Contacts", name="mise_a_jour_contacts", methods={"POST"})
     */
    public function mise_a_jour_contacts(Request $request): Response
    {
        $this->contactRepository
            ->find(1)
            ->setEmail($request->get('email'))
            ->setPhone($request->get('phone'))
            ->setAddress($request->get('address'));
        $this->entityManager->flush();

        return $this->redirectToRoute("contactt");
    }

    /**
     * @Route("Mise-A-Jour-Contacts", name="get_mise_a_jour_contacts", methods={"GET"})
     */
    public function get_mise_a_jour_contacts(): Response
    {
        return $this->render('dash/index.html.twig', [
            "section" =>   $this->contactRepository->find(1),
            'contact' => $this->contactRepository->find(1),
        ]);
    }
}
