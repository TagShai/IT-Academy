<?php

namespace AppBundle\Controller;

use AppBundle\Repository\CompanyRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class MainController extends Controller
{
    /**
     * @Route("/")
     */
    public function indexAction()
    {

        $events = $this->getDoctrine()->getManager();
        $query = $events->createQuery('SELECT e FROM AppBundle:Event e ORDER BY e.id DESC')
            ->setMaxResults(3);
        $events = $query->getResult();

        $subjects=$this->getDoctrine()
            ->getRepository("AppBundle:Subject")
            ->findAll();

        $companies=$this->getDoctrine()
            ->getRepository("AppBundle:Company")
            ->findAll();

        return $this->render('AppBundle:Main:index.html.twig', array(
            // ...
            'events' => $events,
            'companies' => $companies,
            'subjects' => $subjects,
        ));
    }

    /**
     * @Route("/profile/")
     */
    public function profileAction()
    {

        $students=$this->getDoctrine()
            ->getRepository("AppBundle:Student")
            ->findAll();

        $teachers=$this->getDoctrine()
            ->getRepository("AppBundle:Teacher")
            ->findAll();

/*        $lessons=$this->getDoctrine()
            ->getRepository("AppBundle:Lesson")
            ->findAll();*/

        return $this->render('@FOSUser/Profile/show.html.twig', array(
            // ...
            'students' => $students,
            //'lessons' => $lessons,
            'teachers' => $teachers,
        ));
    }

}
