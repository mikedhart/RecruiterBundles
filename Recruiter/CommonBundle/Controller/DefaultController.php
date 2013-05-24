<?php

namespace Recruiter\CommonBundle\Controller;

use Recruiter\RecruitBundle\Entity\PortfolioEntry;

use Symfony\Component\HttpFoundation\Response;

use Symfony\Component\Routing\Exception\InvalidParameterException;
use Recruiter\CommonBundle\Entity\Upload;
use Recruiter\CommonBundle\Entity\UploadType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{ 
	/**
	 * Handles uploads
	 * 
	 * @param string $mode
	 * @param string $type
	 * @throws InvalidParameterException
	 * @return Response
	 */
    public function uploadAction($mode, $type, $id)
    {
    	$handler = $this->get('recruiter_recruit.recruithandler');
    	$em = $this->getDoctrine()->getEntityManager();
    	$upload = new Upload;
    	
    	/*if ($handler->hasProfilePicture()) {
    		//$upload = $handler->getProfilePicture();
    	}*/
    	
    	$form = $this->createFormBuilder($upload)
    		->add('file')
    		->getForm()
    	;
    	
    	$uploadType = $em 	->getRepository('RecruiterCommonBundle:UploadType')
    						->findOneBy(array('upload_type_name' => $type));
    	
    	if (!$uploadType instanceof UploadType) {
    		throw new InvalidParameterException("Upload type not found");
    	}
    	
    	$upload->setUploadType($uploadType);
    	
    	switch ($mode) {
    		case "recruit" :
    			$upload->setRecruit($handler->getRecruit());
    			$route = "recruiter_recruit_homepage";
    			
    			break;
    		case "employer" :
    			$upload->setEmployer($this->getUser()->getEmployer());
    			$route = "recruiter_employer_homepage";
    			break;
    		case "portfolio" :
    			$entry = $this->getDoctrine()->getEntityManager()
    							->getRepository('RecruiterRecruitBundle:PortfolioEntry')
    								->find($id);
    							
    			if (!$entry instanceof PortfolioEntry) {
    				throw $this->createNotFoundException("Portfolio entry not found.");
    			}
    			
    			$upload->setPortfolioEntry($entry);
    			$route = "recruiter_recruit_portfolio_homepage";
    			break;
    		default :
    			throw new InvalidParameterException($mode . " is not a valid mode");
    	}
    	
    	if ($this->getRequest()->getMethod() === 'POST') {
    		$form->bindRequest($this->getRequest());
    		if ($form->isValid()) {
    			    	
    			$em->persist($upload);
    			$em->flush();
    			
    			$options = array();
    			
    			if ($id) {
    				$options["id"] = $id;
    			}
    			
    			return $this->redirect($this->generateUrl($route, $options));
    		}
    	}
    	
    	$view = ($this->getRequest()->isXmlHttpRequest()) ? "ajax" : "html";
    	
    	return $this->render('RecruiterCommonBundle:Default:upload.' . $view . '.twig', array(
    		'form' => $form->createView(),
    		'uploadType' => $type,
    		'uploadMode' => $mode,
    		'id' => $id
    	));
    }
}
