<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Subject;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;


class SubjectController extends Controller
{

    /**
     * Show a subject entry
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $subject = $em->getRepository('AppBundle:Subject')->find($id);

        if (!$subject) {
            throw $this->createNotFoundException('Unable to find subject.');
        }

        $students=$this->getDoctrine()
            ->getRepository("AppBundle:Student")
            ->findAll();

        return $this->render('AppBundle:Subject:index.html.twig', array(
            'subject'      => $subject,
            'students' => $students,
        ));
    }

    /**
     * @Route("/subjects/",name="subject_list")
     */
    public function listAction()
    {
        $subjects=$this->getDoctrine()
            ->getRepository("AppBundle:Subject")
            ->findAll();

        return $this->render('AppBundle:Subject:index.html.twig',array(
            'subjects' => $subjects,
        ));

    }

    /**
     * @Route("/subjects/create",name="subject_create")
     */
    public function createAction(Request $request)
    {
        $subject=new Subject;
        $form=$this->createFormBuilder($subject)
            ->add('name', TextType::class,array("label"=> "Subject name",'attr' => array(
                'class' =>"form-control"
            )))
            ->add('description', TextType::class,array("label"=> "Subject description",'attr' => array(
                'class' =>"form-control"
            )))
            ->add('image', TextType::class,array("label"=> "Subject image",'attr' => array(
                'class' =>"form-control"
            )))
            ->add('submit', SubmitType::class,array('label'=> 'Create subject','attr' => array(
                'class' => 'btn btn-primary',
                'style' => 'margin-bottom: 15px; margin-top: 30px')))
            ->getForm();
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $name=$form['name']->getData();
            $description=$form['description']->getData();
            $image=$form['image']->getData();

            $subject->setName($name);
            $subject->setDescription($description);
            $image->setImage($image);

            $em=$this->getDoctrine()->getManager();
            $em->persist($subject);
            $em->flush();

            $this->addFlash(
                'notice',
                'Subject added'
            );
            return $this->redirectToRoute("subject_list");

        }
        return $this->render("AppBundle:Subject:create.html.twig",array(
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/subjects/edit/{id}",name="subject_edit")
     */
    public function editAction($id,Request $request)
    {

        $subject=$this->getDoctrine()
            ->getRepository("AppBundle:Subject")->find($id);

        $form=$this
            ->createFormBuilder($subject)
            ->add('name',TextType::class,array("attr" => array(
                'class' => 'form-control',
            )))
            ->add('description',TextType::class,array("attr" => array(
                'class' => 'form-control',
            )))
            ->add('image', TextType::class,array("label"=> "Event image",'attr' => array(
                'class' =>"form-control"
            )))
            ->add('submit',SubmitType::class,array("label" => "Edit subject","attr" => array(
                'class' => 'btn btn-primary',
                'style' => 'margin-top: 30px'
            )))->getForm();
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $name=$form['name']->getData();
            $description=$form['description']->getData();
            $image=$form['image']->getData();

            $em=$this->getDoctrine()->getManager();
            $subject=$em->getRepository("AppBundle:Subject")->find($id);

            $subject->setName($name);
            $subject->setDescription($description);
            $subject->setImage($image);

            $em->flush();

            $this->addFlash(
                'notice',
                'Subject edited'
            );
            return $this->redirectToRoute("subject_list");
        }
        return $this->render("AppBundle:Subject:edit.html.twig",array(
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/subjects/delete/{id}",name="subject_delete")
     */
    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $subject = $em->getRepository('AppBundle:Subject')->find($id);
        $em->remove($subject);
        $em->flush();

        $this->addFlash(
            'notice',
            'Subject deleted'
        );
        return $this->redirectToRoute("subject_list");
    }



}
