<?php

namespace Recruiter\PagesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Recruiter\UserBundle\Entity\User;

class DefaultController extends Controller
{
	private function getCsrfToken()
	{
		return $this->container->get('form.csrf_provider')->generateCsrfToken('authenticate');	
	}
	
	private function redirectToProfile()
	{
		if ($this->getUser()->hasRole("ROLE_EMPLOYER")) {
			$route = "recruiter_employer_homepage";
		} elseif ($this->getUser()->hasRole("ROLE_RECRUIT")) {
			$route = "recruiter_recruit_homepage";
		} elseif ($this->getUser()->hasRole("ROLE_ADMIN")) {
			$route = "recruiter_admin_panel_homepage";
		} else {
			$route = "fos_user_security_logout";
		}
		
		return $this->redirect($this->generateUrl($route));
	}
	
    public function indexAction()
    {
    	if ($this->getUser() instanceof User) {
    		return $this->redirectToProfile();	
    	}
    	
        return $this->render('RecruiterPagesBundle:Default:index.html.twig', array("csrf_token" => $this->getCsrfToken()));
    }
    
    public function termsAction()
    {   	 
    	return $this->render('RecruiterPagesBundle:Default:terms.html.twig', array("csrf_token" => $this->getCsrfToken()));
    }
    
    public function aboutAction()
    {
    	return $this->render('RecruiterPagesBundle:Default:about.html.twig', array("csrf_token" => $this->getCsrfToken()));
    }
    
    public function employersAction()
    {
    	return $this->render('RecruiterPagesBundle:Default:employers.html.twig', array("csrf_token" => $this->getCsrfToken()));
    }
    
    public function freelancersAction()
    {
    	return $this->render('RecruiterPagesBundle:Default:freelancers.html.twig', array("csrf_token" => $this->getCsrfToken()));
    }
    
    public function pricingAction()
    {
    	return $this->render('RecruiterPagesBundle:Default:pricing.html.twig', array("csrf_token" => $this->getCsrfToken()));
    }
    
    public function contactAction()
    {
    	return $this->render('RecruiterPagesBundle:Default:contact.html.twig', array("csrf_token" => $this->getCsrfToken()));
    }
}
