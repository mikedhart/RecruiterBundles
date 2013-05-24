<?php

namespace Recruiter\CommonBundle\Services;

use Symfony\Component\Routing\Exception\InvalidParameterException;

interface ProfilePageInterface
{
	// blah
}

class ProfilePage
{
	const MODE_RECRUIT = "recruit";
	const MODE_EMPLOYER = "employer";
	
	private $validModes = array(
		self::MODE_RECRUIT, self::MODE_EMPLOYER		
	);
	
	private $mode = self::MODE_RECRUIT;
	
	public function __construct($mode)
	{
		if (!in_array($mode, $this->validModes)) {
			throw new InvalidParameterException($mode . " is not valid for this service.");
		}
	}
}