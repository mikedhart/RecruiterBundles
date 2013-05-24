<?php

namespace Recruiter\UserBundle\Controller;

use Symfony\Component\DependencyInjection\ContainerAware;
use Symfony\Component\HttpFoundation\RedirectResponse;

class ProfileController extends ContainerAware
{
	public function showAction()
	{
		return new RedirectResponse("/");
	}
}