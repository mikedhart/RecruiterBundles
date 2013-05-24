<?php
// src/Acme/UserBundle/Entity/User.php

namespace Recruiter\UserBundle\Entity;

use FOS\UserBundle\Entity\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Recruiter\RecruitBundle\Entity\Recruit;
use Recruiter\EmployerBundle\Entity\Employer;

/**
 * @ORM\Entity
 * @ORM\Table(name="users")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * @ORM\OneToOne(targetEntity="Recruiter\RecruitBundle\Entity\Recruit", mappedBy="user")
     * @var Recruit
     */
    private $recruit;
    
    /**
     * @ORM\OneToOne(targetEntity="Recruiter\EmployerBundle\Entity\EmployerUser", mappedBy="user")
     * @var EmployerUser
     */
    private $employer_user;
    
    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $first_name = "";
    
    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $last_name = "";

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set recruit
     *
     * @param \Recruiter\RecruitBundle\Entity\Recruit $recruit
     * @return User
     */
    public function setRecruit(\Recruiter\RecruitBundle\Entity\Recruit $recruit = null)
    {
        $this->recruit = $recruit;
    
        return $this;
    }

    /**
     * Get recruit
     *
     * @return \Recruiter\RecruitBundle\Entity\Recruit 
     */
    public function getRecruit()
    {
        return $this->recruit;
    }

    /**
     * Set employer_user
     *
     * @param \Recruiter\EmployerBundle\Entity\EmployerUser $employerUser
     * @return User
     */
    public function setEmployerUser(\Recruiter\EmployerBundle\Entity\EmployerUser $employerUser = null)
    {
        $this->employer_user = $employerUser;
    
        return $this;
    }

    /**
     * Get employer_user
     *
     * @return \Recruiter\EmployerBundle\Entity\EmployerUser 
     */
    public function getEmployerUser()
    {
        return $this->employer_user;
    }

    /**
     * Set first_name
     *
     * @param string $firstName
     * @return User
     */
    public function setFirstName($firstName)
    {
        $this->first_name = $firstName;
    
        return $this;
    }

    /**
     * Get first_name
     *
     * @return string 
     */
    public function getFirstName()
    {
        return $this->first_name;
    }

    /**
     * Set last_name
     *
     * @param string $lastName
     * @return User
     */
    public function setLastName($lastName)
    {
        $this->last_name = $lastName;
    
        return $this;
    }

    /**
     * Get last_name
     *
     * @return string 
     */
    public function getLastName()
    {
        return $this->last_name;
    }
    
    public function __toString()
    {
    	return $this->getFirstName() . " " . $this->getLastName();
    }
}