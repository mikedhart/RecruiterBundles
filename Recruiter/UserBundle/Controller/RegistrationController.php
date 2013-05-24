<?php

namespace Recruiter\UserBundle\Controller;

use Recruiter\CommonBundle\Entity\Upload;
use Symfony\Component\HttpFoundation\RedirectResponse;
use FOS\UserBundle\Controller\RegistrationController as BaseController;
use Symfony\Component\Translation\Loader\CsvFileLoader;
use Recruiter\UserBundle\Entity\User;
use Recruiter\RecruitBundle\Entity\Recruit;
use Recruiter\RecruitBundle\Entity\JobType;
use Recruiter\RecruitBundle\Entity\Skill;
use Recruiter\EmployerBundle\Entity\Employer;
use Recruiter\EmployerBundle\Entity\EmployerUser;
use Recruiter\CommonBundle\Entity\Address;
use Recruiter\RecruitBundle\Entity\PortfolioEntry;

class RegistrationController extends BaseController
{
    public function importAction()
    {
        $em = $this->container->get("doctrine")->getEntityManager();
        $file = fopen(__DIR__ . "/cvs.csv", "r");

        while($row = fgetcsv($file)) {
            $user = $em->getRepository("RecruiterUserBundle:User")->findOneBy(array("email" => $row[0]));

            if ($user instanceof User) {
                $recruit = $user->getRecruit();

                if ($recruit instanceof Recruit) {
                    $up = new Upload();
                    $type = $em->getRepository("RecruiterCommonBundle:UploadType")->findOneBy(array("upload_type_name" => "cv"));
                    $em->persist($recruit);
                    $em->persist($up);

                    $up->setRecruit($recruit);
                    $up->setUploadType($type);
                    $up->setUploadFileName($row[1]);
                    $up->setUploadFileSize(0);
                    $up->setUploadFileType("file");
                    $up->setUploadCreatedAt(time());

                    $em->flush();
                    unset($user);
                    unset($recruit);
                }
            }
        }

        die("done");
    }
	/*public function importAction()
	{
 		$em = $this->container->get("doctrine")->getEntityManager();
		$file = fopen(__DIR__ . "/links.csv", "r");
		
		while($row = fgetcsv($file)) {
			$user = $em->getRepository("RecruiterUserBundle:User")->findOneBy(array("email" => $row[0]));
			$recruit = $user->getRecruit();
			
			if ($recruit instanceof Recruit) {
				$em->persist($recruit);
				$pe = new PortfolioEntry();
				$pe->setPortfolioItemHref($row[1]);
				$pe->setPortfolioItemName(str_replace("\N", "", $row[2]));
				$pe->setPortfolioItemBrief(strip_tags($row[3]));
				$pe->setRecruit($recruit);
				$recruit->addPortfolioEntry($pe);
				$em->flush();
				unset($user);
				unset($recruit);
			}
		}
		
		die("done");
	}*/
// 	/*public function importAction()
// 	{
// 		/*$handler = $this->container->get('fos_user.user_manager');
// 		$em = $this->container->get("doctrine")->getEntityManager();
// 		$channel = $em->getRepository("RecruiterCommonBundle:Channel")->findOneBy(array("channel_name" => "crus"));
// 		$file = fopen(__DIR__ . "/recruits.csv", "r");
// 		while($row = fgetcsv($file)) {
// 			$user = new User();
// 			$user->setFirstName($row[1]);
// 			$user->setLastName($row[2]);
// 			$user->setUsername($row[5]);
// 			$user->setEmail($row[5]);
// 			$user->setPlainPassword($row[4]);
// 			$user->addRole("ROLE_RECRUIT");
// 			$user->setEnabled(true);
// 			$handler->updateUser($user);
			
			
// 			$recruit = new Recruit();
// 			$em->persist($recruit);
// 			$location = $em->getRepository("RecruiterCommonBundle:Location")->find($row[10]);
// 			$recruit->setRecruitPersonalStatement(strip_tags($row[12]));
// 			$recruit->setChannel($channel);
// 			$recruit->setUser($user);
// 			$recruit->setLocation($location);
// 			$recruit->setRecruitJobTitle($row[3]);
// 			$recruit->setRecruitPhoneNumber($row[6]);
// 			$em->flush();
// 			//var_dump($row);die;
// 		}*/
		
		
// 		/*$em = $this->container->get("doctrine")->getEntityManager();
// 		$userRepo = $em->getRepository("RecruiterUserBundle:User");
// 		$jobTypeRepo = $em->getRepository("RecruiterRecruitBundle:JobType");
// 		$file = fopen(__DIR__ . "/job_types.csv", "r");
		
// 		while($row = fgetcsv($file)) {
// 			// var_dump($row);die;
// 			$u = $userRepo->findOneBy(array("first_name" => $row[1], "last_name" => $row[2]));
			
// 			if ($u instanceof User) {
// 				$r = $u->getRecruit();
				
// 				if ($r instanceof Recruit) {
// 					$em->persist($r);
// 					$jt = $jobTypeRepo->find($row[0]);
					
// 					if ($jt instanceof JobType) {
// 						$em->persist($jt);
						
// 						if (!$r->getJobTypes()->contains($jt)) {
// 							$r->addJobType($jt);
// 						}
						
// 						$em->flush();
// 					}
// 				}
// 			}
// 		}*/
		
// 		/*$em = $this->container->get("doctrine")->getEntityManager();
// 		$userRepo = $em->getRepository("RecruiterUserBundle:User");
// 		$skillRepo = $em->getRepository("RecruiterRecruitBundle:Skill");
// 		$file = fopen(__DIR__ . "/skills.csv", "r");
		
// 		while($row = fgetcsv($file)) {
// 			// var_dump($row);die;
// 			$u = $userRepo->findOneBy(array("first_name" => $row[1], "last_name" => $row[2]));
				
// 			if ($u instanceof User) {
// 				$r = $u->getRecruit();
		
// 				if ($r instanceof Recruit) {
// 					$em->persist($r);
// 					$jt = $skillRepo->find($row[0]);
						
// 					if ($jt instanceof Skill) {
// 						$em->persist($jt);
		
// 						if (!$r->getSkills()->contains($jt)) {
// 							$r->addSkill($jt);
// 						}
		
// 						$em->flush();
// 					}
// 				}
// 			}
// 		}*/
		
// 		$em = $this->container->get("doctrine")->getEntityManager();
// 		$handler = $this->container->get('fos_user.user_manager');
// 		// $channel = $em->getRepository("RecruiterCommonBundle:Channel")->findOneBy(array("channel_name" => "crus"));
// 		$file = fopen(__DIR__ . "/employers.csv", "r");
// 		while($row = fgetcsv($file)) {
// 			$user = $em->getRepository("RecruiterUserBundle:User")->findOneBy(array("email" => $row[5]));
			
// 			if (!$user) {
// 				$user = new User();
// 			}
			
// 			$user->setFirstName($row[2]);
// 			$user->setLastName($row[3]);
// 			$user->setUsername($row[5]);
// 			$user->setEmail($row[5]);
// 			$user->setPlainPassword($row[4]);
// 			$user->addRole("ROLE_EMPLOYER");
// 			$user->setEnabled(true);
// 			$handler->updateUser($user);
			
// 			$employerUser = new EmployerUser();
// 			$employer = new Employer();
// 			$address = new Address();
			
// 			$em->persist($employer);
// 			$em->persist($employerUser);
// 			$em->persist($address);
			
// 			$address->setAddress1($row[7]);
// 			$address->setAddress2($row[8]);
// 			$address->setTown($row[9]);
// 			$address->setPostcode($row[10]);
// 			$address->setCountry("uk");
// 			$address->setCounty("");
			
// 			$employerUser->setPrimaryContact(true);
// 			$employerUser->setUser($user);
// 			$employerUser->setEmployer($employer);
// 			$employerUser->setOwner(true);
			
// 			$employer->setEmployerName($row[1]);
// 			$employer->setEmployerDescription("");
// 			$employer->setAddress($address);
			
// 			$em->flush();
			
			
// 		}
// 		var_dump("jkkj");die;
// 	}*/
	
	public function registerAction()
	{
		$form = $this->container->get('fos_user.registration.form');
		$formHandler = $this->container->get('fos_user.registration.form.handler');
		$confirmationEnabled = $this->container->getParameter('fos_user.registration.confirmation.enabled');
	
		$process = $formHandler->process($confirmationEnabled);
		
		if ($process) {
			$user = $form->getData();
	
			$authUser = false;
			if ($confirmationEnabled) {
				$this->container->get('session')->set('fos_user_send_confirmation_email/email', $user->getEmail());
				$route = 'fos_user_registration_check_email';
			} else {
				$authUser = true;
				//$route = 'fos_user_registration_confirmed';
				$route = 'recruiter_user_define_role';
			}
	
			$this->setFlash('fos_user_success', 'registration.flash.user_created');
			$url = $this->container->get('router')->generate($route);
			$response = new RedirectResponse($url);
	
			if ($authUser) {
				$this->authenticateUser($user, $response);
			}
	
			return $response;
		}
	
		return $this->container->get('templating')->renderResponse('FOSUserBundle:Registration:register.html.'.$this->getEngine(), array(
				'form' => $form->createView(),
				'csrf_token' => $this->getCsrfToken()
		));
	}
	
	private function getCsrfToken()
	{
		return $this->container->get('form.csrf_provider')->generateCsrfToken('authenticate');
	}
}