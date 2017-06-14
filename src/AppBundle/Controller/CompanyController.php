<?php
/**
 * Created by PhpStorm.
 * User: Pavel
 * Date: 19.04.2017
 * Time: 2:54
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Company;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;


class CompanyController extends Controller
{

    /**
     * Show a company entry
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $company = $em->getRepository('AppBundle:Company')->find($id);

        if (!$company) {
            throw $this->createNotFoundException('Unable to find company.');
        }

        return $this->render('AppBundle:Company:index.html.twig', array(
            'company'      => $company,
        ));
    }

    /**
     * @Route("/companies/",name="company_list")
     */
    public function listAction()
    {
        $companies=$this->getDoctrine()
            ->getRepository("AppBundle:Company")
            ->findAll();

        return $this->render('AppBundle:Company:index.html.twig',array(
            'companies' => $companies,
        ));

    }

    /**
     * @Route("/",name="company_list")
     */
/*    public function listMainAction()
    {
        $companies=$this->getDoctrine()
            ->getRepository("AppBundle:Company")
            ->findAll();
        return $this->render('AppBundle:Main:index.html.twig',array(
            'companies' => $companies,
        ));

    }*/

    /**
     * @Route("/companies/create",name="company_create")
     */
    public function createAction(Request $request)
    {
        $company=new Company;
        $form=$this->createFormBuilder($company)
            ->add('name', TextType::class,array("label"=> "Company name",'attr' => array(
                'class' =>"form-control"
            )))
            ->add('description', TextType::class,array("label"=> "Company description",'attr' => array(
                'class' =>"form-control"
            )))
            ->add('site', TextType::class,array("label"=> "Company site",'attr' => array(
                'class' =>"form-control"
            )))
            ->add('image', TextType::class,array("label"=> "Company image",'attr' => array(
                'class' =>"form-control"
            )))
            ->add('submit', SubmitType::class,array('label'=> 'Create company','attr' => array(
                'class' => 'btn btn-primary',
                'style' => 'margin-bottom: 15px; margin-top: 30px')))
            ->getForm();
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $name=$form['name']->getData();
            $description=$form['description']->getData();
            $site=$form['site']->getData();
            $image=$form['image']->getData();

            $company->setName($name);
            $company->setDescription($description);
            $company->setSite($site);
            $company->setImage($image);

            $em=$this->getDoctrine()->getManager();
            $em->persist($company);
            $em->flush();

            $this->addFlash(
                'notice',
                'Company added'
            );
            return $this->redirectToRoute("company_list");

        }
        return $this->render("AppBundle:Company:create.html.twig",array(
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/companies/edit/{id}",name="company_edit")
     */
    public function editAction($id,Request $request)
    {

        $company=$this->getDoctrine()
            ->getRepository("AppBundle:Company")->find($id);

        $form=$this
            ->createFormBuilder($company)
            ->add('name',TextType::class,array("attr" => array(
                'class' => 'form-control',
            )))
            ->add('description',TextType::class,array("attr" => array(
                'class' => 'form-control',
            )))
            ->add('site',TextType::class,array("attr" => array(
                'class' => 'form-control',
            )))
            ->add('image',TextType::class,array("attr" => array(
                'class' => 'form-control',
            )))
            ->add('submit',SubmitType::class,array("label" => "Edit company","attr" => array(
                'class' => 'btn btn-primary',
                'style' => 'margin-top: 30px'
            )))->getForm();
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $name=$form['name']->getData();
            $description=$form['description']->getData();
            $site=$form['site']->getData();
            $image=$form['image']->getData();
            $em=$this->getDoctrine()->getManager();
            $company=$em->getRepository("AppBundle:Company")->find($id);

            $company->setName($name);
            $company->setDescription($description);
            $company->setSite($site);
            $company->setImage($image);

            $em->flush();

            $this->addFlash(
                'notice',
                'Company edited'
            );
            return $this->redirectToRoute("company_list");
        }
        return $this->render("AppBundle:Company:edit.html.twig",array(
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/companies/delete/{id}",name="company_delete")
     */
    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $company = $em->getRepository('AppBundle:Company')->find($id);
        $em->remove($company);
        $em->flush();

        $this->addFlash(
            'notice',
            'Company deleted'
        );
        return $this->redirectToRoute("company_list");
    }

}