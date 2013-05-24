<?php

namespace Recruiter\EmployerBundle\Services;

use Orderly\PayPalIpnBundle\Event\PayPalEvent;
use Symfony\Component\Security\Core\SecurityContext;

class PayPalListener 
{

    private $em, $sc;

    public function __construct(\Doctrine\ORM\EntityManager $em, SecurityContext $sc) {
        $this->em = $em;
        $this->sc = $sc;
    }

    public function onIPNReceive(PayPalEvent $event) {
        $ipn = $event->getIPN();
//die($_POST["employer_id"]);
        $employer = $this->em->getRepository("RecruiterEmployerBundle:Employer")->find($_REQUEST["employer_id"]);
        //var_dump($_POST);die;
        
        $this->em->persist($employer);
        $employer->setEmployerSubscriptionActivationDate(time());
        $this->em->flush();
        // do your stuff
    }
}