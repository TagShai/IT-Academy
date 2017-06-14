<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Student;
use AppBundle\Entity\Event;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
class EventController extends Controller
{

    /**
     * Show a event entry
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $event = $em->getRepository('AppBundle:Event')->find($id);

        if (!$event) {
            throw $this->createNotFoundException('Unable to find event.');
        }

        return $this->render('AppBundle:Event:event.html.twig', array(
            'event'      => $event,
        ));
    }

    /**
     * @Route("/events",name="event_list")
     */
    public function listAction()
    {
/*        $events=$this->getDoctrine()
            ->getRepository("AppBundle:Event")
            ->findAll();*/

        $events = $this->getDoctrine()->getManager();
        $query = $events->createQuery(
            'SELECT e FROM AppBundle:Event e ORDER BY e.id DESC'
        );
        $events = $query->getResult();

        return $this->render('AppBundle:Event:index.html.twig',array(
            'events' => $events,

        ));
    }

    /**
     * @Route("/events/create",name="event_create")
     */
    public function createAction(Request $request)
    {
        $event=new Event;
        $form=$this->createFormBuilder($event)
            ->add('topic', TextType::class,array("label"=> "Event topic",'attr' => array(
                'class' =>"form-control"
            )))
            ->add('description', TextType::class,array("label"=> "Event description",'attr' => array(
                'class' =>"form-control"
            )))
            ->add('eDate', TextType::class,array("label"=> "Date:",'required' => false,'attr' => array(
                'class' =>"form-control",

            )))
            ->add('image', TextType::class,array("label"=> "Event image",'attr' => array(
                'class' =>"form-control"
            )))

            ->add('submit', SubmitType::class,array('label'=> 'Create event','attr' => array(
                'class' => 'btn btn-primary',
                'style' => 'margin-bottom: 15px; margin-top: 30px')))
            ->getForm();
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $topic=$form['topic']->getData();
            $description=$form['description']->getData();
            $eDate=$form['eDate']->getData();
            $image=$form['image']->getData();

            $event->setTopic($topic);
            $event->setDescription($description);
            $event->setEDate($eDate);
            $event->setImage($image);


            $em=$this->getDoctrine()->getManager();
            $em->persist($event);
            $em->flush();

            $this->addFlash(
                'notice',
                'Event added'
            );
            return $this->redirectToRoute("event_list");

        }
        return $this->render("AppBundle:Event:create.html.twig",array(
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/events/edit/{id}",name="event_edit")
     */
    public function editAction($id,Request $request)
    {
        $event=$this->getDoctrine()
            ->getRepository("AppBundle:Event")->find($id);
        $form=$this->createFormBuilder($event)
            ->add('eDate',TextType::class,array("label"=> "Date of event",'attr'=>array(
                'class' => "form-control"
            )))
            ->add('topic',TextType::class,array("attr" => array(
                'class' => 'form-control',
            )))
            ->add('description',TextType::class,array("attr" => array(
                'class' => 'form-control',
            )))
            ->add('image',TextType::class,array("attr" => array(
                'class' => 'form-control',
            )))

            ->add('submit', SubmitType::class,array('label'=> 'Edit event','attr' => array(
                'class' => 'btn btn-primary',
                'style' => 'margin-bottom: 15px; margin-top: 30px')))
            ->getForm();
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $eDate=$form['eDate']->getData();
            $topic=$form['topic']->getData();
            $description=$form['description']->getData();
            $image=$form['image']->getData();

            $em=$this->getDoctrine()->getManager();
            $event=$em->getRepository("AppBundle:Event")->find($id);


            $event->setEDate($eDate);
            $event->setTopic($topic);
            $event->setDescription($description);
            $event->setImage($image);



            $em->flush();
            $this->addFlash(
                'notice',
                'Event edited'
            );
            return $this->redirectToRoute("event_list");
        }
        return $this->render("AppBundle:Event:edit.html.twig",array(
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/events/delete/{id}",name="event_delete")
     */
    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $work = $em->getRepository('AppBundle:Event')->find($id);
        $em->remove($work);
        $em->flush();

        $this->addFlash(
            'notice',
            'Event deleted'
        );
        return $this->redirectToRoute("event_list");
    }

    /*
     * @Route("/events/category/{id}",name="event_category_list")
     */
/*    public function categoryEventsAction($id, Request $request){
        $events=$this->getDoctrine()
            ->getRepository("AppBundle:Event")
            ->findByCategory($id);
        return $this->render('AppBundle:Event:index.html.twig',array(
            'events' => $events,

        ));
    }*/

    /*
     * @Route("/testwork",name="event_testwork")
     */
/*    public function testworkAction(){
        $events=$this->getDoctrine()
            ->getRepository("AppBundle:Event")
            ->findBy(
                array(
                    "isTest" => "0"
                )
            );
        return $this->render('AppBundle:Event:index.html.twig',array(
            'events' => $events,

        ));
    }*/

    /*
     * @Route("/classwork",name="event_classwork")
     */
/*    public function classworkAction(){
        $events=$this->getDoctrine()
            ->getRepository("AppBundle:Event")
            ->findBy(
                array(
                    "isTest" => "1"
                )
            );
        return $this->render('AppBundle:Event:index.html.twig',array(
            'events' => $events,

        ));
    }*/

}
