<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Section;
use App\Repository\SectionRepository;



 
class ProjectController extends AbstractController
{
       
    private $entityManager;
    private $sectionRepository;
    public function __construct(EntityManagerInterface $em, SectionRepository $sectionRepository)
    {
        $this->entityManager = $em;
        $this->sectionRepository = $sectionRepository;
    }
     /**
     * @Route("Mise-A-Jour-Projects", name="mise_a_jour_projects", methods={"POST"})
     */
    public function mise_a_jour_projects(Request $request): Response
    {
        $this->sectionRepository
            
            ->setTitre($request->get('titre'))
            ->setDescription($request->get('description'))
            ->setContenu($request->get('contenu'))
            ->setImage($request->get('image'))
            ->setBouton($request->get('bouton'))
            ->setType($request->get('type'));
        $this->entityManager->flush();

        return $this->redirectToRoute("project");
    }
    
    /**
     * @Route("Mise-A-Jour-Projects", name="get_mise_a_jour_projects", methods={"GET"})
     */
    public function get_mise_a_jour_Projects(): Response
    {
        return $this->render('project/index.html.twig', [
            "section" =>   $this->sectionRepository->find(1),
        ]);
    }

}
