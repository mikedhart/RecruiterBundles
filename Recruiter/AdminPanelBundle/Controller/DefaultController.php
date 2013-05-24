<?php

namespace Recruiter\AdminPanelBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
    	$em = $this->getDoctrine()->getEntityManager();

       	$latestRecruits = $em->getRepository('RecruiterRecruitBundle:Recruit')->fetchLatest();
    	$latestEmployers = $em->getRepository('RecruiterEmployerBundle:Employer')->fetchLatest();
    	$totalRecruits = $em->getRepository('RecruiterRecruitBundle:Recruit')->countAll();
    	$totalEmployers = $em->getRepository('RecruiterEmployerBundle:Employer')->countAll();
    	$totalRecruitsThisWeek = $em->getRepository('RecruiterRecruitBundle:Recruit')->countAll(strtotime('last sunday'));
    	$totalEmployersThisWeek = $em->getRepository('RecruiterEmployerBundle:Employer')->countAll(strtotime('last sunday'));
    	
        return $this->render(
        		'RecruiterAdminPanelBundle:Default:index.html.twig',
        		array(
        			'recruits' => $latestRecruits, 
        			'employers' => $latestEmployers,
        			'total_recruits' => $totalRecruits,
        			'total_employers' => $totalEmployers,
        			'total_recruits_this_week' => $totalRecruitsThisWeek,
        			'total_employers_this_week' => $totalEmployersThisWeek
        		)
        );
    }
}
