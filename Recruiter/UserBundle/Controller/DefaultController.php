<?php

namespace Recruiter\UserBundle\Controller;

use Recruiter\RecruitBundle\Services\RecruitHandler;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('RecruiterUserBundle:Default:index.html.twig', array('name' => $name));
    }
    
    public function editAction()
    {
    	$request = $this->getRequest();
    	 
    	$form = $this->createFormBuilder($this->getUser())
    		->add('first_name')
    		->add('last_name')
    		->getForm()
    	;
    
    	if ($request->isMethod('POST')) {
    		$form->bind($request);
    		 
    		$em = $this->getDoctrine()->getEntityManager();
    		$em->persist($this->getUser());
    		$em->flush();
    		
    		$this->get('session')->getFlashBag()->add('success', "Your changes have been saved.");
    		
    		return $this->redirectToProfile("ROLE_RECRUIT");
    	}
    
    	$mode = ($request->isXmlHttpRequest()) ? "ajax" : "html";
    	
    	return $this->container
    		->get('templating')
    		->renderResponse('RecruiterUserBundle:Default:edit.' . $mode . '.twig', array(
    			'form' => $form->createView()
    			)
    		)
    	;
    }
    
    public function typeAction()
    {
    	$request = $this->getRequest();
    	
    	$form = $this->createFormBuilder()
    	
    		->add('role', 'choice', array(
    			'choices' => array(
    				'ROLE_EMPLOYER' => 'Employer',
    				'ROLE_RECRUIT' => 'Candidate'		
    			)		
    		))
    		
    		->getForm()
    	;
    		
    	if ($request->isMethod('POST')) {
    		$form->bind($request);
    	
    		$data = $form->getData();
    		
    		$em = $this->getDoctrine()->getEntityManager();
    		$em->persist($this->getUser());
    		$this->getUser()->addRole($data['role']);
    		$em->flush();
    		return $this->addRoleAndRedirect($data);
    	}
    
    	return $this->container
    		->get('templating')
    		->renderResponse('RecruiterUserBundle:Registration:type.html.twig', array(
    			'form' => $form->createView()
    		))
    	;
    }
    
    private function redirectToProfile($role)
    {
    	switch ($role) {
    		case 'ROLE_EMPLOYER' :
    			$route = 'recruiter_employer_homepage';
    			break;
    		case 'ROLE_RECRUIT' :
    			$route = 'recruiter_recruit_homepage';
    			break;
    		default :
    			return $this->createNotFoundException("Unknown user type");
    			break;
    	}
    	 
    	return $this->redirect($this->generateUrl($route));
    }
    
    private function addRoleAndRedirect($data)
    {
    	$em = $this->getDoctrine()->getEntityManager();
    	
    	switch ($data['role']) {
    		case 'ROLE_EMPLOYER' :
    			$route = 'recruiter_employer_homepage';
    			break;
    		case 'ROLE_RECRUIT' :
    			$route = 'recruiter_recruit_homepage';
    			$recruit = RecruitHandler::create($em, $this->getUser());
    			break;
    		default :
    			return $this->createNotFoundException("Unknown user type");
    			break;
    	}
    	
    	$em->persist($this->getUser());
    	$this->getUser()->addRole($data['role']);
    	$em->flush();
    	
    	return $this->redirectToProfile($data['role']);
    }
}
