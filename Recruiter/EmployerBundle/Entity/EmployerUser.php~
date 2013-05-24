<?php

namespace Recruiter\EmployerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * EmployerUser
 *
 * @ORM\Table(name="employer_user")
 * @ORM\Entity
 */
class EmployerUser
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var boolean
     *
     * @ORM\Column(name="owner", type="boolean")
     */
    private $owner;

    /**
     * @var boolean
     *
     * @ORM\Column(name="primary_contact", type="boolean")
     */
    private $primary_contact;

    /**
     * @ORM\OneToOne(targetEntity="Recruiter\UserBundle\Entity\User", inversedBy="employer_user")
     * @var User
     */
    private $user;
    
    /**
     * @ORM\ManyToOne(targetEntity="Employer", inversedBy="employer_users")
     * @var Employer
     */
    private $employer;
    
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
     * Set owner
     *
     * @param boolean $owner
     * @return EmployerUser
     */
    public function setOwner($owner)
    {
        $this->owner = $owner;
    
        return $this;
    }

    /**
     * Get owner
     *
     * @return boolean 
     */
    public function getOwner()
    {
        return $this->owner;
    }

    /**
     * Set primary_contact
     *
     * @param boolean $primaryContact
     * @return EmployerUser
     */
    public function setPrimaryContact($primaryContact)
    {
        $this->primary_contact = $primaryContact;
    
        return $this;
    }

    /**
     * Get primary_contact
     *
     * @return boolean 
     */
    public function getPrimaryContact()
    {
        return $this->primary_contact;
    }

    /**
     * Set user
     *
     * @param \Recruiter\UserBundle\Entity\User $user
     * @return EmployerUser
     */
    public function setUser(\Recruiter\UserBundle\Entity\User $user = null)
    {
        $this->user = $user;
    
        return $this;
    }

    /**
     * Get user
     *
     * @return \Recruiter\UserBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set employer
     *
     * @param \Recruiter\EmployerBundle\Entity\Employer $employer
     * @return EmployerUser
     */
    public function setEmployer(\Recruiter\EmployerBundle\Entity\Employer $employer = null)
    {
        $this->employer = $employer;
    
        return $this;
    }

    /**
     * Get employer
     *
     * @return \Recruiter\EmployerBundle\Entity\Employer 
     */
    public function getEmployer()
    {
        return $this->employer;
    }
}