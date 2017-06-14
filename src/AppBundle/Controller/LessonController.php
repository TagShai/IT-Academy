<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Lesson;
use AppBundle\Repository\TeacherRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;


class LessonController extends Controller
{
    /**
     * @Route("/lessons",name="lesson_list")
     */
    public function listAction()
    {
        $lessons=$this->getDoctrine()
            ->getRepository("AppBundle:Lesson")
            ->findAll();

        $teachers=$this->getDoctrine()
            ->getRepository("AppBundle:Teacher")
            ->findAll();

        $students=$this->getDoctrine()
            ->getRepository("AppBundle:Student")
            ->findAll();

        return $this->render('AppBundle:Lesson:index.html.twig',array(
            'lessons' => $lessons,
            'teachers' => $teachers,
            'students' => $students,

        ));
    }

    /**
     * @Route("/lessons/create",name="lesson_create")
     */
    public function createAction(Request $request)
    {
        $lesson = new Lesson;
        $form=$this->createFormBuilder($lesson)
            ->add('eDate', TextType::class,array("label"=> "Date:",'required' => false,'attr' => array(
                'class' =>"form-control",
            )))
            ->add('teacher', EntityType::class, array(
                'class' => 'AppBundle:Teacher',
                'choice_label' => 'name',
                'placeholder' => 'Choose your teacher',
                'attr'=>array(
                    "class" => "form-control",
                )))
            ->add('category', EntityType::class, array(
                'class' => 'AppBundle:LessonCategory',
                'choice_label' => 'name',
                'placeholder' => 'Choose your category',
                'attr'=>array(
                    "class" => "form-control",
                )))
            ->add('isTest', TextType::class,array("label"=> "isTest:",'required' => false,'attr' => array(
                'class' =>"form-control",
            )))
            ->add('classroom', TextType::class,array("label"=> "Classroom",'attr' => array(
                'class' =>"form-control"
            )))
            ->add('submit', SubmitType::class,array('label'=> 'Create lesson','attr' => array(
                'class' => 'btn btn-primary',
                'style' => 'margin-bottom: 15px; margin-top: 30px')))
            ->getForm();
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $eDate=$form['eDate']->getData();
            $teacher=$form['teacher']->getData();
            $category=$form['category']->getData();
            $isTest=$form['isTest']->getData();
            $classroom=$form['classroom']->getData();

            $lesson->setEDate($eDate);
            $lesson->setTeacher($teacher);
            $lesson->setCategory($category);
            $lesson->setIsTest($isTest);
            $lesson->setClassroom($classroom);

            $em=$this->getDoctrine()->getManager();
            $em->persist($lesson);
            $em->flush();

            $this->addFlash(
                'notice',
                'Lesson added'
            );
            return $this->redirectToRoute("lesson_list");

        }
        return $this->render("AppBundle:Lesson:create.html.twig",array(
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/lessons/edit/{id}",name="lesson_edit")
     */
    public function editAction($id,Request $request)
    {
        $lesson=$this->getDoctrine()
            ->getRepository("AppBundle:Lesson")->find($id);


        $form=$this->createFormBuilder($lesson)
            ->add('eDate', TextType::class,array("label"=> "Date",'attr' => array(
                'class' =>"form-control"
            )))
            ->add('teacher', EntityType::class, array(
                'class' => 'AppBundle:Teacher',
                'choice_label' => 'name',
                'placeholder' => 'Choose your teacher',
                'attr'=>array(
                    "class" => "form-control",
                )))
            ->add('category', EntityType::class, array(
                'class' => 'AppBundle:LessonCategory',
                'choice_label' => 'name',
                'placeholder' => 'Choose your category',
                'attr'=>array(
                    "class" => "form-control",
                )))
            ->add('isTest', TextType::class,array("label"=> "Test",'attr' => array(
                'class' =>"form-control"
            )))
            ->add('classroom', TextType::class,array("label"=> "Classroom",'attr' => array(
                'class' =>"form-control"
            )))
            ->add('submit', SubmitType::class,array('label'=> 'Edit lesson','attr' => array(
                'class' => 'btn btn-primary',
                'style' => 'margin-bottom: 15px; margin-top: 30px')))
            ->getForm();
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $eDate=$form['eDate']->getData();
            $teacher=$form['teacher']->getData();
            $category=$form['category']->getData();
            $isTest=$form['isTest']->getData();
            $classroom=$form['classroom']->getData();

            $em=$this->getDoctrine()->getManager();
            $lesson=$em->getRepository("AppBundle:Lesson")->find($id);


            $lesson->setEDate($eDate);
            $lesson->setTeacher($teacher);
            $lesson->setCategory($category);
            $lesson->setIsTest($isTest);
            $lesson->setClassroom($classroom);

            $em->flush();

            $this->addFlash(
                'notice',
                'Lesson edited'
            );
            return $this->redirectToRoute("lesson_list");
        }
        return $this->render("AppBundle:Lesson:edit.html.twig",array(
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/lessons/delete/{id}",name="lesson_delete")
     */
    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $teacher = $em->getRepository('AppBundle:Lesson')->find($id);
        $em->remove($teacher);
        $em->flush();

        $this->addFlash(
            'notice',
            'Lesson deleted'
        );
        return $this->redirectToRoute("lesson_list");
    }
}