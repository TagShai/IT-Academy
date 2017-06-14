<?php
// src/AppBundle/Controller/RegistrationController.php

namespace AppBundle\Controller;

use FOS\UserBundle\Event\FilterUserResponseEvent;
use FOS\UserBundle\Event\FormEvent;
use FOS\UserBundle\Event\GetResponseUserEvent;
use FOS\UserBundle\FOSUserEvents;
use Symfony\Component\HttpFoundation\RedirectResponse;
use FOS\UserBundle\Controller\RegistrationController as BaseController;
use Symfony\Component\HttpFoundation\Request;

class RegistrationController extends BaseController
{
    public function registerAction(Request $request)
    {
        /** @var $formFactory FactoryInterface */
        $formFactory = $this->get('fos_user.registration.form.factory');
        /** @var $userManager UserManagerInterface */
        $userManager = $this->get('fos_user.user_manager');
        /** @var $dispatcher EventDispatcherInterface */
        $dispatcher = $this->get('event_dispatcher');

        $userManager = $this->container->get('fos_user.user_manager');
        $userlogged = $userManager->findUserByUsername($this->container->get('security.token_storage')->getToken()->getUser());

/*        if($userlogged!=null) {
            if ($userlogged->hasRole("ROLE_STUDENT") || $userlogged->hasRole("ROLE_TEACHER") || $userlogged->hasRole("ROLE_MANAGER")  ) {
                $url = $this->generateUrl('home');
                return new RedirectResponse($url);
            }
        }*/
        $user = $userManager->createUser();
        $user->setEnabled(true);

        $event = new GetResponseUserEvent($user, $request);
        $dispatcher->dispatch(FOSUserEvents::REGISTRATION_INITIALIZE, $event);

        if (null !== $event->getResponse()) {
            return $event->getResponse();
        }

        $form = $formFactory->createForm();
        $form->setData($user);

        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            if ($form->isValid()) {
                $event = new FormEvent($form, $request);
                $dispatcher->dispatch(FOSUserEvents::REGISTRATION_SUCCESS, $event);
                if($form->get('crole')->getData()=="ROLE_STUDENT") {
                    $user->addRole("ROLE_STUDENT");
                    $userManager->updateUser($user);
                }
                else if($form->get('crole')->getData()=="ROLE_TEACHER") {
                    $user->addRole("ROLE_TEACHER");
                    $userManager->updateUser($user);
                }
                else if($form->get('crole')->getData()=="ROLE_MANAGER") {
                    $user->addRole("ROLE_MANAGER");
                    $userManager->updateUser($user);
                }
                if($form->get('crole')->getData()=="ROLE_STUDENT"){

                    $student=new Student;

                    $student->setAccount($user);

                    $student->setAddress($form->get('address')->getData());
                    $student->setGrade($form->get('grade')->getData());
                    $student->setLname($form->get('lname')->getData());
                    $student->setMname($form->get('mname')->getData());
                    $student->setFname($form->get('fname')->getData());
                    $student->setEmail($form->get('email')->getData());
                    $em=$this->getDoctrine()->getManager();
                    $em->persist($student);

                }
                else if($form->get('crole')->getData()=="ROLE_TEACHER"){
                    $teacher=new Teacher;

                    $teacher->setAccount($user);

                    $teacher->setLname($form->get('lname')->getData());
                    $teacher->setMname($form->get('mname')->getData());
                    $teacher->setFname($form->get('fname')->getData());
                    $em=$this->getDoctrine()->getManager();
                    $em->persist($teacher);

                }
                /*****************************************************
                 * Add new functionality (e.g. log the registration) *
                 *****************************************************/
                $this->container->get('logger')->info(
                    sprintf("New user registration: %s", $user)
                );

                if (null === $response = $event->getResponse()) {
                    $url = $this->generateUrl('fos_user_registration_confirmed');
                    $response = new RedirectResponse($url);
                }

                $dispatcher->dispatch(FOSUserEvents::REGISTRATION_COMPLETED, new FilterUserResponseEvent($user, $request, $response));

                return $response;
            }

            $event = new FormEvent($form, $request);
            $dispatcher->dispatch(FOSUserEvents::REGISTRATION_FAILURE, $event);

            if (null !== $response = $event->getResponse()) {
                return $response;
            }
        }

        return $this->render('@FOSUser/Registration/register.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}

/*class RegistrationController extends BaseController
{
    public function registerAction(Request $request)
    {
        $formFactory = $this->get('fos_user.registration.form.factory');
        $userManager = $this->get('fos_user.user_manager');
        $dispatcher = $this->get('event_dispatcher');

        $user = $userManager->createUser();

        $user->setEnabled(true);


        $event = new GetResponseUserEvent($user, $request);
        $dispatcher->dispatch(FOSUserEvents::REGISTRATION_INITIALIZE, $event);

        if (null !== $event->getResponse()) {
            return $event->getResponse();
        }

        $form = $formFactory->createForm();

        $form->setData($user);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            if ($form->isValid()) {
                $event = new FormEvent($form, $request);
                $dispatcher->dispatch(FOSUserEvents::REGISTRATION_SUCCESS, $event);
                if($user->getCrole()=="ROLE_STUDENT"){
                $user->addRole("ROLE_STUDENT");
                }
                elseif($user->getCrole()=="ROLE_MANAGER"){
                    $user->addRole("ROLE_MANAGER");
                }
                elseif($user->getCrole()=="ROLE_TEACHER"){
                    $user->addRole("ROLE_TEACHER");
                }
                $userManager->updateUser($user);

                if (null === $response = $event->getResponse()) {
                    $url = $this->generateUrl('fos_user_registration_confirmed');
                    $response = new RedirectResponse($url);
                }

                $dispatcher->dispatch(FOSUserEvents::REGISTRATION_COMPLETED, new FilterUserResponseEvent($user, $request, $response));

                return $response;
            }

            $event = new FormEvent($form, $request);
            $dispatcher->dispatch(FOSUserEvents::REGISTRATION_FAILURE, $event);

            if (null !== $response = $event->getResponse()) {
                return $response;
            }
        }

        return $this->render('@FOSUser/Registration/register.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}*/
