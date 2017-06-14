<?php

namespace AppBundle\Controller;

use AppBundle\Entity\groupe;
use AppBundle\Entity\Subject;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;

class GroupController extends Controller
{
    /**
     * @Route("/groups",name="group_list")
     */
    public function listAction()
    {
        $groups=$this->getDoctrine()
            ->getRepository("AppBundle:groupe")
            ->findAll();
        return $this->render('AppBundle:Group:index.html.twig',array(
            'groups' => $groups,

        ));
    }

    /**
     * @Route("/groups/create",name="group_create")
     */
    public function createAction(Request $request)
    {
        $group=new groupe;
        $form=$this->createFormBuilder($group)
            ->add('name', TextType::class,array('attr' => array(
                'class' =>"form-control"
            )))
            ->add('teacher', EntityType::class, array(
                'class' => 'AppBundle:Teacher',
                'choice_label' => 'name',
                'placeholder' => 'Choose your teacher',
                'attr'=>array(
                    "class" => "form-control",
                )))
            ->add('submit', SubmitType::class,array('label'=> 'Create group','attr' => array(
                'class' => 'btn btn-primary',
                'style' => 'margin-bottom: 15px; margin-top: 30px')))
            ->getForm();
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $name=$form['name']->getData();
            $teacher=$form['teacher']->getData();
            $group->setName($name);
            $group->setTeacher($teacher);

            $em=$this->getDoctrine()->getManager();
            $em->persist($group);
            $em->flush();

            $this->addFlash(
                'notice',
                'Group added'
            );

            return $this->redirectToRoute("group_list");

        }
        return $this->render("AppBundle:Group:create.html.twig",array(
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/groups/edit/{id}",name="group_edit")
     */
    public function editAction($id,Request $request)
    {
        $group=$this->getDoctrine()
            ->getRepository("AppBundle:groupe")->find($id);

        $form=$this
            ->createFormBuilder($group)
            ->add('name', TextType::class,array('attr' => array(
                'class' =>"form-control"
            )))
            ->add('teacher', EntityType::class, array(
                'class' => 'AppBundle:Teacher',
                'choice_label' => 'name',
                'attr'=>array(
                    "class" => "form-control",
                )))
            ->add('submit', SubmitType::class,array('label'=> 'Edit group','attr' => array(
                'class' => 'btn btn-primary',
                'style' => 'margin-bottom: 15px; margin-top: 30px')))
            ->getForm();
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $name=$form['name']->getData();
            $teacher=$form['teacher']->getData();
            $em=$this->getDoctrine()->getManager();
            $group=$em->getRepository("AppBundle:groupe")->find($id);

            $group->setName($name);
            $group->setTeacher($teacher);

            $em->flush();

            $this->addFlash(
                'notice',
                'Group edited'
            );
            return $this->redirectToRoute("group_list");
        }
        return $this->render("AppBundle:Group:edit.html.twig",array(
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/groups/delete/{id}",name="group_delete")
     */
    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $group = $em->getRepository('AppBundle:groupe')->find($id);
        $em->remove($group);
        $em->flush();

        $this->addFlash(
            'notice',
            'Group deleted'
        );
        return $this->redirectToRoute("group_list");
    }
    /**
     * @Route("/students/group/{id}",name="group_students_list")
     */
    public function groupStudentsAction($id,Request $request){
        $students=$this->getDoctrine()
            ->getRepository("AppBundle:Student")
            ->findByGroup($id);
        return $this->render('AppBundle:Student:index.html.twig',array(
            'students' => $students,

        ));
    }
}
