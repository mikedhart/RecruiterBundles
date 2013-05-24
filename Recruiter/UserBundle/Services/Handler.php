<?php

namespace Recruiter\UserBundle\Services;

use Recruiter\UserBundle\Entity\User;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Security\Core\SecurityContext;

class Handler
{
	/**
	 * Holds the recruit object.
	 *
	 * @var SecurityContext
	 */
	public $securityContext;
	
	/**
	 * Holds the doctrine entity manager instance.
	 *
	 * @var EntityManager
	 */
	public $em;
	
	/**
	 * Holds the current user.
	 * 
	 * @var User
	 */
	private $user;
	
	/**
	 * Hydrates the object.
	 * 
	 * @param SecurityContext $securityContext
	 * @param EntityManager $em
	 * @return self
	 */
	public function __construct(SecurityContext $securityContext, EntityManager $em)
	{
		$this->securityContext = $securityContext;
		$this->em = $em;
		
		$this->setUser($securityContext->getToken()->getUser());
		
		return $this;
	}
	
	/**
	 * Sets the user.
	 * 
	 * @param User $user
	 */
	public function setUser(User $user)
	{
		$this->user = $user;
	}
	
	/**
	 * @return User
	 */
	public function getUser()
	{
		return $this->user;
	}
}
