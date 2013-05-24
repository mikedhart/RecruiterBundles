<?php

namespace Recruiter\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class RecruiterUserBundle extends Bundle
{
	public function getParent()
	{
		return 'FOSUserBundle';
	}
}
