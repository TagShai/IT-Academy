<?php

namespace AppBundle\Controller;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Student;
use AppBundle\Entity\Event;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class StudentController extends Controller
{
    /**
     * @Route("/students",name="student_list")
     */
    public function listAction()
    {
        $students=$this->getDoctrine()
            ->getRepository("AppBundle:Student")
            ->findAll();
        return $this->render('AppBundle:Student:index.html.twig',array(
            'students' => $students,

        ));
    }

    /**
     * @Route("/students/create",name="student_create")
     */
    public function createAction(Request $request)
    {
        $student=new Student;
        $form=$this->createFormBuilder($student)
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
                'attr'=>array(
                    "class" => "form-control",
                )))
            ->add('account', EntityType::class, array(
                'class' => 'AppBundle:User',
                'choice_label' => 'id',
                'attr'=>array(
                    "class" => "form-control",
                )))
            ->add('email', EmailType::class,array('attr' => array(
                'class' =>"form-control"
            )))
            ->add('address', TextType::class,array('attr' => array(
                'class' =>"form-control"
            )))
            ->add('grade', TextType::class,array("label"=> "Grade",'attr' => array(
                'class' =>"form-control"
            )))
            ->add('submit', SubmitType::class,array('label'=> 'Create student','attr' => array(
                'class' => 'btn btn-primary',
                'style' => 'margin-bottom: 15px; margin-top: 30px')))

            ->getForm();

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $fname=$form['fname']->getData();
            $lname=$form['lname']->getData();
            $mname=$form['mname']->getData();
            $subject=$form['subject']->getData();
            $account=$form['account']->getData();
            $email=$form['email']->getData();
            $address=$form['address']->getData();

            $student->setFname($fname);
            $student->setLname($lname);
            $student->setMname($mname);
            $student->setSubject($subject);
            $student->setAccount($account);
            $student->setEmail($email);
            $student->setAddress($address);


            $em=$this->getDoctrine()->getManager();
            $em->persist($student);
            $em->flush();

            $this->addFlash(
                'notice',
                'Student added'
            );
            return $this->redirectToRoute("student_list");

        }
        return $this->render("AppBundle:Student:create.html.twig",array(
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/students/edit/{id}",name="student_edit")
     */
    public function editAction($id,Request $request)
    {
        $student=$this->getDoctrine()
            ->getRepository("AppBundle:Student")->find($id);


        $form=$this->createFormBuilder($student)
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
                'attr'=>array(
                    "class" => "form-control",
                )))
            ->add('account', EntityType::class, array(
                'class' => 'AppBundle:User',
                'choice_label' => 'id',
                'attr'=>array(
                    "class" => "form-control",
                )))
            ->add('email', EmailType::class,array('attr' => array(
                'class' =>"form-control"
            )))
            ->add('address', TextType::class,array('attr' => array(
                'class' =>"form-control"
            )))
            ->add('submit', SubmitType::class,array('label'=> 'Edit student','attr' => array(
                'class' => 'btn btn-primary',
                'style' => 'margin-bottom: 15px; margin-top: 30px')))
            ->getForm();
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $fname=$form['fname']->getData();
            $lname=$form['lname']->getData();
            $mname=$form['mname']->getData();
            $subject=$form['subject']->getData();
            $account=$form['account']->getData();
            $email=$form['email']->getData();
            $address=$form['address']->getData();

            $em=$this->getDoctrine()->getManager();
            $student=$em->getRepository("AppBundle:Student")->find($id);

            $student->setFname($fname);
            $student->setLname($lname);
            $student->setMname($mname);
            $student->setSubject($subject);
            $student->setAccount($account);
            $student->setEmail($email);
            $student->setAddress($address);


            $em->flush();

            $this->addFlash(
                'notice',
                'Student edited'
            );
            return $this->redirectToRoute("student_list");
        }
        return $this->render("AppBundle:Student:edit.html.twig",array(
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/students/delete/{id}",name="student_delete")
     */
    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $student = $em->getRepository('AppBundle:Student')->find($id);
        $em->remove($student);
        $em->flush();

        $this->addFlash(
            'notice',
            'Student deleted'
        );
        return $this->redirectToRoute("student_list");
    }


}
