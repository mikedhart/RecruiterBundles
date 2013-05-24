<?php 

namespace Recruiter\EmployerBundle\Services;

use Gremo\SubscriptionBundle\Provider\ActivationDateProviderInterface;
use JMS\DiExtraBundle\Annotation as DI;
use Symfony\Component\Security\Core\SecurityContext;

/**
 * @DI\Service("crus_activation_provider")
 */
class ActivationProvider implements ActivationDateProviderInterface
{
	/**
	 * @var \Symfony\Component\Security\Core\SecurityContext
	 */
	private $context;

	/**
	 * @DI\InjectParams({"context" = @DI\Inject("security.context")})
	 */
	public function __construct(SecurityContext $context)
	{
		$this->context = $context;
	}

	/**
	 * @return \DateTime
	 */
	public function getActivationDate()
	{
		$user = $this->context->getToken()->getUser();
        
		return new \DateTime(date(DATE_W3C, $user->getEmployerUser()->getEmployer()->getEmployerSubscriptionActivationDate()));
	}
}