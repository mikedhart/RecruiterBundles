<?php 

namespace Recruiter\PagesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class JobsController extends Controller
{
	public function indexAction($name)
	{
		return $this->render("RecruiterPagesBundle:Jobs:index.html.twig", array("name" => $name, "csrf_token" => $this->getCsrfToken()));
	}
	
	private function getCsrfToken()
	{
		return $this->container->get('form.csrf_provider')->generateCsrfToken('authenticate');
	}
}