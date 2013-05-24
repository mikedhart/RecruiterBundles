<?php

namespace Recruiter\EmployerBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Recruiter\CommonBundle\Entity\Location;
use Doctrine\ORM\Mapping as ORM;
use Recruiter\CommonBundle\Entity\Address;

/**
 * Employer
 *
 * @ORM\Table(name="employers")
 * @ORM\Entity(repositoryClass="Recruiter\EmployerBundle\Entity\EmployerRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Employer
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
     * @var string
     *
     * @ORM\Column(name="employer_name", type="string", length=100)
     */
    private $employer_name;

    /**
     * @var string
     *
     * @ORM\Column(name="employer_description", type="text")
     */
    private $employer_description;
    
    /**
     * @var int
     * 
     * @ORM\Column(name="employer_subscription_activation_date", type="integer")
     */
    private $employer_subscription_activation_date = 0;
    
    /**
     * @var int
     *
     * @ORM\Column(name="employer_created_at", type="integer")
     */
    private $employer_created_at = 0;
    
    /**
     * @var int
     *
     * @ORM\Column(name="employer_updated_at", type="integer")
     */
    private $employer_updated_at = 0;
    

    /**
     * @ORM\OneToMany(targetEntity="EmployerUser", mappedBy="employer")
     * @var EmployerUser
     */
    private $employer_users;
    
    /**
     * @ORM\OneToMany(targetEntity="Recruiter\CommonBundle\Entity\Upload", mappedBy="employer")
     * @var Upload
     */
    private $uploads;
    
    /**
     * @ORM\ManyToOne(targetEntity="Recruiter\CommonBundle\Entity\Location", inversedBy="employers")
     * @var Location
     */
    private $location;
    
    /**
     * @ORM\OneToOne(targetEntity="Recruiter\CommonBundle\Entity\Address", inversedBy="employer")
     * @var Address
     */
    private $address;
    
    public function __construct()
    {
    	$this->employer_users = new ArrayCollection();	
    	$this->uploads = new ArrayCollection();
    }
    
    /**
     * @ORM\PreUpdate
     */
    public function prePersist()
    {
    	if ($this->getEmployerCreatedAt() == 0) {
    		$this->setEmployerCreatedAt(time());
    	}
    	
    	$this->setEmployerUpdatedAt(time());
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
     * Set employer_name
     *
     * @param string $employerName
     * @return Employer
     */
    public function setEmployerName($employerName)
    {
        $this->employer_name = $employerName;
    
        return $this;
    }

    /**
     * Get employer_name
     *
     * @return string 
     */
    public function getEmployerName()
    {
        return $this->employer_name;
    }

    /**
     * Set employer_description
     *
     * @param string $employerDescription
     * @return Employer
     */
    public function setEmployerDescription($employerDescription)
    {
        $this->employer_description = $employerDescription;
    
        return $this;
    }

    /**
     * Get employer_description
     *
     * @return string 
     */
    public function getEmployerDescription()
    {
        return $this->employer_description;
    }

    /**
     * Add employer_users
     *
     * @param \Recruiter\EmployerBundle\Entity\EmployerUser $employerUsers
     * @return Employer
     */
    public function addEmployerUser(\Recruiter\EmployerBundle\Entity\EmployerUser $employerUsers)
    {
        $this->employer_users[] = $employerUsers;
    
        return $this;
    }

    /**
     * Remove employer_users
     *
     * @param \Recruiter\EmployerBundle\Entity\EmployerUser $employerUsers
     */
    public function removeEmployerUser(\Recruiter\EmployerBundle\Entity\EmployerUser $employerUsers)
    {
        $this->employer_users->removeElement($employerUsers);
    }

    /**
     * Get employer_users
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getEmployerUsers()
    {
        return $this->employer_users;
    }

    /**
     * Add uploads
     *
     * @param \Recruiter\CommonBundle\Entity\Upload $uploads
     * @return Employer
     */
    public function addUpload(\Recruiter\CommonBundle\Entity\Upload $uploads)
    {
        $this->uploads[] = $uploads;
    
        return $this;
    }

    /**
     * Remove uploads
     *
     * @param \Recruiter\CommonBundle\Entity\Upload $uploads
     */
    public function removeUpload(\Recruiter\CommonBundle\Entity\Upload $uploads)
    {
        $this->uploads->removeElement($uploads);
    }

    /**
     * Get uploads
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getUploads()
    {
        return $this->uploads;
    }

    /**
     * Set address
     *
     * @param \Recruiter\CommonBundle\Entity\Address $address
     * @return Employer
     */
    public function setAddress(\Recruiter\CommonBundle\Entity\Address $address = null)
    {
        $this->address = $address;
    
        return $this;
    }

    /**
     * Get address
     *
     * @return \Recruiter\CommonBundle\Entity\Address 
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set employer_subscription_expiry
     *
     * @param integer $employerSubscriptionExpiry
     * @return Employer
     */
    public function setEmployerSubscriptionExpiry($employerSubscriptionExpiry)
    {
        $this->employer_subscription_expiry = $employerSubscriptionExpiry;
    
        return $this;
    }

    /**
     * Get employer_subscription_expiry
     *
     * @return integer 
     */
    public function getEmployerSubscriptionExpiry()
    {
        return $this->employer_subscription_expiry;
    }
    
    /**
     * Does this employer have an active subsctipion?
     * 
     * @return boolean
     */
    public function hasActiveSubscription()
    {
    	return ($this->getEmployerSubscriptionExpiry() > time());
    }

    /**
     * Set employer_subscription_activation_date
     *
     * @param integer $employerSubscriptionActivationDate
     * @return Employer
     */
    public function setEmployerSubscriptionActivationDate($employerSubscriptionActivationDate)
    {
        $this->employer_subscription_activation_date = $employerSubscriptionActivationDate;
    
        return $this;
    }

    /**
     * Get employer_subscription_activation_date
     *
     * @return integer 
     */
    public function getEmployerSubscriptionActivationDate()
    {
        return $this->employer_subscription_activation_date;
    }
    
    public function __toString()
    {
    	return $this->getEmployerName();
    }

    /**
     * Set location
     *
     * @param \Recruiter\CommonBundle\Entity\Location $location
     * @return Employer
     */
    public function setLocation(\Recruiter\CommonBundle\Entity\Location $location = null)
    {
        $this->location = $location;
    
        return $this;
    }

    /**
     * Get location
     *
     * @return \Recruiter\CommonBundle\Entity\Location 
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * Set employer_created_at
     *
     * @param integer $employerCreatedAt
     * @return Employer
     */
    public function setEmployerCreatedAt($employerCreatedAt)
    {
        $this->employer_created_at = $employerCreatedAt;
    
        return $this;
    }

    /**
     * Get employer_created_at
     *
     * @return integer 
     */
    public function getEmployerCreatedAt()
    {
        return $this->employer_created_at;
    }

    /**
     * Set employer_updated_at
     *
     * @param integer $employerUpdatedAt
     * @return Employer
     */
    public function setEmployerUpdatedAt($employerUpdatedAt)
    {
        $this->employer_updated_at = $employerUpdatedAt;
    
        return $this;
    }

    /**
     * Get employer_updated_at
     *
     * @return integer 
     */
    public function getEmployerUpdatedAt()
    {
        return $this->employer_updated_at;
    }
}