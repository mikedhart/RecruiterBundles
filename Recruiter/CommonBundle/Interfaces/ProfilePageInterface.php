<?php

namespace Recruiter\CommonBundle\Interfaces;

interface ProfilePageInterface
{
	/**
	 * Load the required data for this profile and make it publically
	 * available via the getData method.
	 * 
	 * @return void
	 */
	public function loadData();
	
	/**
	 * Return the data for this profile.
	 * 
	 * @return Recruiter\CommonBundle\Entity\ProfilePageComponent[]
	 */
	public function getData();
}