<?php

namespace App\Controller;

use App\Entity\Section;
use App\Form\SectionType;
use App\Repository\SectionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;




 
class SectionController extends AbstractController
{

    /*
     * had route katdik l la page dial sections w katreturnilk ga3 les sections li kaynin f la base se donnée
     * */
    /**
     * @Route("/section", name="section_table")
     */

    public function index()
    {
        $section = $this->getDoctrine()->getRepository(Section::class)->findAll();
        return $this->render('section/index.html.twig', [
            'sections' => $section,
        ]);


    }

    /*
     * had route katdik l la page fin tzid section jdida
     * */
    /**
     * @Route("/addsection", name="add_section")
     */
    public function addSection()
    {
        return $this->render('section/new.html.twig');
    }

    /*
     * had route bach tmodifyi la section
     * */
    /**
     * @Route("/updatesection", name="update_section")
     */
    public function updateSection()
    {
        return $this->render('section/edit.html.twig');
    }

    /*
     * had route tdik l show section
     * */
    /**
     * @Route("/showsection/{id}", name="show_section")
     */
    public function showSection($id)
    {
        $section = $this->getDoctrine()->getRepository(Section::class)->find($id);
        return $this->render('section/show.html.twig', [
            'section' => $section,
        ]);
    }
}
