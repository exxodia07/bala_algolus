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
    /**
 * @Route("/section")
 */

 public function index()
 {
     $section = $this->getDoctrine()->getRepository(Section::class);
   return $this->render('section/index.html.twig',[

     ]);


 }

    /**
     * @Route("/blog", name="blog_", methods={"GET"})
     */
    public function showblog(SectionRepository $sectionRepository): Response
    {
        return $this->render('section/index.html.twig', [
            'sections' => $sectionRepository->findBy(
                ['type'=>'blog'],
                ['type'=>'ASC'],
            ),
        ]);
    }

    /**
     * @Route("/service", name="service", methods={"GET"})
     */
    public function showservice(SectionRepository $sectionRepository): Response
    {
        return $this->render('section/index.html.twig', [
            'sections' => $sectionRepository->findBy(
                ['type'=>'services'],
                ['type'=>'ASC'],
            ),
        ]);
    }

    
    /**
     * @Route("/about", name="about", methods={"GET"})
     */
    public function showabout(SectionRepository $sectionRepository): Response
    {
        return $this->render('section/index.html.twig', [
            'sections' => $sectionRepository->findBy(
                ['type'=>'about'],
                ['type'=>'ASC'],
            ),
        ]);
    }

    
    /**
     * @Route("/project", name="project", methods={"GET"})
     */
    public function showproject(SectionRepository $sectionRepository): Response
    {
        return $this->render('section/index.html.twig', [
            'sections' => $sectionRepository->findBy(
                ['type'=>'project'],
                ['type'=>'ASC'],
            ),
        ]);
    }

    /**
     * @Route("/new", name="section_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $section = new Section();
        $form = $this->createForm(SectionType::class, $section);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($section);
            $entityManager->flush();

            return $this->redirectToRoute('blog_', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('section/new.html.twig', [
            'section' => $section,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="section_show", methods={"GET"})
     */
    public function show(Section $section): Response
    {
        return $this->render('section/show.html.twig', [
            'section' => $section,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="section_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Section $section, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(SectionType::class, $section);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('section_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('section/edit.html.twig', [
            'section' => $section,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="section_delete", methods={"POST"})
     */
    public function delete(Request $request, Section $section, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$section->getId(), $request->request->get('_token'))) {
            $entityManager->remove($section);
            $entityManager->flush();
        }

        return $this->redirectToRoute('section_index', [], Response::HTTP_SEE_OTHER);
    }
}
