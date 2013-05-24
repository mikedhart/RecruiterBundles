<?php

namespace Recruiter\EmployerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Recruiter\EmployerBundle\Entity\EmployerUser;
use Recruiter\EmployerBundle\Entity\Employer;

class DefaultController extends Controller
{
    public function searchAction()
    {
            if ($this->getRequest()->getMethod() === "POST") {
                    $handler = $this->get("recruiter_employer.searchhandler");
                    $handler->buildQuery($_POST);
                    $recruits = $handler->run();

                    return $this->render("RecruiterEmployerBundle:Default:search.html.twig", array("recruits" => $recruits));
            }

            return $this->redirect($this->generateUrl("recruiter_employer_homepage"));
    }
    
    public function newAction()
    {
        $employer = new Employer;
        $eu = new EmployerUser();
        
        $builder = $this->createFormBuilder($employer)
            ->add('employer_name')
            ->add('employer_description', null, array('label' => 'About your company'))
            ->getForm()
        ;
        
        if ($this->getRequest()->getMethod() === "POST") {
            $builder->bindRequest($this->getRequest());
    		$this->getDoctrine()->getEntityManager()->persist($employer);
            $this->getDoctrine()->getEntityManager()->persist($eu);

            $eu->setUser($this->getUser());
            $eu->setEmployer($employer);
            $eu->setPrimaryContact(true);
            $eu->setOwner(true);
            
            $this->getDoctrine()->getEntityManager()->flush();
            
    		$this->get('session')->getFlashBag()->add('success', "Your changes have been saved.");
    		
    		return $this->redirect($this->generateUrl('recruiter_employer_homepage'));
        }
        
        return $this->render(
            'RecruiterEmployerBundle:Default:new.html.twig', 
            array('form' => $builder->createView())
        );
    }
    
    public function payAction()
    {
        $employer = $this->getUser()->getEmployerUser()->getEmployer();
        $r = $this->getRequest();
        
        return $this->render(
            "RecruiterEmployerBundle:Default:pay.html.twig",
            array(
                "amount" => 250.00, 
                // "amount" => 1.00,
                "employer" => $employer, 
                "currency" => "GBP", 
                "return" => "http://" . $r->getHttpHost() . $this->generateUrl("recruiter_employer_homepage"),
                "business" => "Hayley.ballinger@chrysalisrecruitment.com",
                "notify_url" => "http://" . $r->getHttpHost() . $r->getBaseUrl() . "/ipn/ipn-no-notification?employer_id=" . $employer->getId()
            )
        );
    }
	
    public function indexAction()
    {
    	if (!$this->getUser()->getEmployerUser() instanceof EmployerUser) {
            return $this->redirect($this->generateUrl("recruiter_employer_new"));
        }
        
        $subscription = $this->get('gremo_subscription');
        
        if (!$this->getUser()->hasRole("ROLE_FREE_ACCOUNT")) {
	        if ($subscription->getCurrentPeriod()->getLastDate()->getTimestamp() < time()) {
	            return $this->redirect($this->generateUrl("recruiter_employer_pay"));
	        }
	        
	        if ($this->getUser()->getEmployerUser()->getEmployer()->getEmployerSubscriptionActivationDate() == 0) {
	            return $this->redirect($this->generateUrl("recruiter_employer_pay"));
	        }
        }
    	
    	$em = $this->getDoctrine()->getEntityManager();
    	$skills = $em->getRepository("RecruiterRecruitBundle:Skill")->findAll();
    	$locations = $em->getRepository("RecruiterCommonBundle:Location")->findAll();
    	$jobTypes = $em->getRepository("RecruiterRecruitBundle:JobType")->findAll();
    	
        return $this->render(
        	"RecruiterEmployerBundle:Default:index.html.twig", 
        	array("skills" => $skills, "locations" => $locations, "job_types" => $jobTypes)
        );
    }
}
