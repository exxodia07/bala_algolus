<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Contact;
use App\Repository\ContactRepository;
use App\Repository\SectionRepository;

class HomeController extends AbstractController
{
    private $contactRepository;
    private $sectionRepository;
    public function __construct(ContactRepository $contactRepository ,sectionRepository $sectionRepository)
    {
        $this->contactRepository = $contactRepository;
        $this->sectionRepository = $sectionRepository;
    }
    /**
     * @Route("/home", name="home")
     */
    public function index(): Response
    {
        return $this->render('root/home.html.twig');
    }

    /**
     * @Route("/work", name="work")
     */
    public function work(): Response
    {
        return $this->render('root/project.html.twig');
    }

    /**
     * @Route("/about", name="about")
     */
    public function about(): Response
    {
        return $this->render('root/about.html.twig');
    }

    /**
     * @Route("/services", name="services")
     */
    public function services(): Response
    {
        return $this->render('root/services.html.twig');
    }

    /**
     * @Route("/Blog", name="blog")
     */

    public function blog(): Response
    {
        return $this->render('root/blog.html.twig', [
            'sections' => $this->sectionRepository->findby(
                ['type'=>'blog'],
                ['type'=>'ASC'],
            )
        ]);
    }


    /**
     * @Route("/Contact", name="contactt")      
     */
    public function contact(): Response
    {
        return $this->render('root/contact.html.twig', [
            'contact' => $this->contactRepository->find(1),
        ]);
    }
}
