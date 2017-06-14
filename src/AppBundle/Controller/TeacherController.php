<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Teacher;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;

class TeacherController extends Controller
{
    /**
     * @Route("/teachers",name="teacher_list")
     */
    public function listAction()
    {
            $teachers=$this->getDoctrine()
                ->getRepository("AppBundle:Teacher")
                ->findAll();
            return $this->render('AppBundle:Teacher:index.html.twig',array(
                'teachers' => $teachers,

            ));
    }

    /**
     * @Route("/teachers/create",name="teacher_create")
     */
    public function createAction(Request $request)
    {
        $teacher=new Teacher;
        $form=$this->createFormBuilder($teacher)
            ->add('lname', TextType::class,array("label"=> "Last name",'attr' => array(
                'class' =>"form-control"
            )))
            ->add('fname', TextType::class,array("label"=> "First name",'attr' => array(
                'class' =>"form-control"
            )))

            ->add('mname', TextType::class,array("label"=> "Middle name",'attr' => array(
                'class' =>"form-control"
            )))
            ->add('subject', EntityType::class, array(
                'class' => 'AppBundle:Subject',
                'choice_label' => 'name',
                'placeholder' => 'Choose your subject',
                'attr'=>array(
                    "class" => "form-control",
                )))
            ->add('submit', SubmitType::class,array('label'=> 'Create teacher','attr' => array(
                'class' => 'btn btn-primary',
                'style' => 'margin-bottom: 15px; margin-top: 30px')))
            ->getForm();
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $fname=$form['fname']->getData();
            $lname=$form['lname']->getData();
            $mname=$form['mname']->getData();
            $subject=$form['subject']->getData();
            $teacher->setFname($fname);
            $teacher->setLname($lname);
            $teacher->setMname($mname);
            $teacher->setSubject($subject);

            $em=$this->getDoctrine()->getManager();
            $em->persist($teacher);
            $em->flush();

            $this->addFlash(
                'notice',
                'Teacher added'
            );
            return $this->redirectToRoute("teacher_list");

        }
        return $this->render("AppBundle:Teacher:create.html.twig",array(
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/teachers/edit/{id}",name="teacher_edit")
     */
    public function editAction($id,Request $request)
    {
        $teacher=$this->getDoctrine()
            ->getRepository("AppBundle:Teacher")->find($id);


        $form=$this->createFormBuilder($teacher)
            ->add('lname', TextType::class,array("label"=> "Last name",'attr' => array(
                'class' =>"form-control"
            )))
            ->add('fname', TextType::class,array("label"=> "First name",'attr' => array(
                'class' =>"form-control"
            )))

            ->add('mname', TextType::class,array("label"=> "Middle name",'attr' => array(
                'class' =>"form-control"
            )))
            ->add('subject', EntityType::class, array(
                'class' => 'AppBundle:Subject',
                'choice_label' => 'name',
                'placeholder' => 'Choose your subject',
                'attr'=>array(
                    "class" => "form-control",
                )))
            ->add('submit', SubmitType::class,array('label'=> 'Edit teacher','attr' => array(
                'class' => 'btn btn-primary',
                'style' => 'margin-bottom: 15px; margin-top: 30px')))
            ->getForm();
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $fname=$form['fname']->getData();
            $lname=$form['lname']->getData();
            $mname=$form['mname']->getData();
            $subject=$form['subject']->getData();
            $em=$this->getDoctrine()->getManager();
            $teacher=$em->getRepository("AppBundle:Teacher")->find($id);


            $teacher->setFname($fname);
            $teacher->setLname($lname);
            $teacher->setMname($mname);
            $teacher->setSubject($subject);

            $em->flush();

            $this->addFlash(
                'notice',
                'Teacher edited'
            );
            return $this->redirectToRoute("teacher_list");
        }
        return $this->render("AppBundle:Teacher:edit.html.twig",array(
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/teachers/delete/{id}",name="teacher_delete")
     */
    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $teacher = $em->getRepository('AppBundle:Teacher')->find($id);
        $em->remove($teacher);
        $em->flush();

        $this->addFlash(
            'notice',
            'Teacher deleted'
        );
        return $this->redirectToRoute("teacher_list");
    }


    /**
     * @Route("/events/teacher/{id}",name="teacher_events_list")
     */
    public function teacherEventsAction($id, Request $request){
        $events=$this->getDoctrine()
            ->getRepository("AppBundle:Event")
            ->findByTeacher($id);
        return $this->render('AppBundle:Event:index.html.twig',array(
            'events' => $events,

        ));
    }
}
