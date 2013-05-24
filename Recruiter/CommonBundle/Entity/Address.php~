<?php

namespace Recruiter\CommonBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Recruiter\EmployerBundle\Entity\Employer;

/**
 * Address
 *
 * @ORM\Table(name="addresses")
 * @ORM\Entity(repositoryClass="Recruiter\CommonBundle\Entity\AddressRepository")
 */
class Address
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
     * @ORM\Column(name="address_1", type="string", length=100)
     */
    private $address_1;

    /**
     * @var string
     *
     * @ORM\Column(name="address_2", type="string", length=100)
     */
    private $address_2;

    /**
     * @var string
     *
     * @ORM\Column(name="town", type="string", length=100)
     */
    private $town;

    /**
     * @var string
     *
     * @ORM\Column(name="county", type="string", length=100)
     */
    private $county;

    /**
     * @var string
     *
     * @ORM\Column(name="postcode", type="string", length=10)
     */
    private $postcode;

    /**
     * @var string
     *
     * @ORM\Column(name="country", type="string", length=50)
     */
    private $country;

    /**
     * @ORM\OneToOne(targetEntity="Recruiter\EmployerBundle\Entity\Employer", mappedBy="address")
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
     * Set address_1
     *
     * @param string $address1
     * @return Address
     */
    public function setAddress1($address1)
    {
        $this->address_1 = $address1;
    
        return $this;
    }

    /**
     * Get address_1
     *
     * @return string 
     */
    public function getAddress1()
    {
        return $this->address_1;
    }

    /**
     * Set address_2
     *
     * @param string $address2
     * @return Address
     */
    public function setAddress2($address2)
    {
        $this->address_2 = $address2;
    
        return $this;
    }

    /**
     * Get address_2
     *
     * @return string 
     */
    public function getAddress2()
    {
        return $this->address_2;
    }

    /**
     * Set town
     *
     * @param string $town
     * @return Address
     */
    public function setTown($town)
    {
        $this->town = $town;
    
        return $this;
    }

    /**
     * Get town
     *
     * @return string 
     */
    public function getTown()
    {
        return $this->town;
    }

    /**
     * Set county
     *
     * @param string $county
     * @return Address
     */
    public function setCounty($county)
    {
        $this->county = $county;
    
        return $this;
    }

    /**
     * Get county
     *
     * @return string 
     */
    public function getCounty()
    {
        return $this->county;
    }

    /**
     * Set postcode
     *
     * @param string $postcode
     * @return Address
     */
    public function setPostcode($postcode)
    {
        $this->postcode = $postcode;
    
        return $this;
    }

    /**
     * Get postcode
     *
     * @return string 
     */
    public function getPostcode()
    {
        return $this->postcode;
    }

    /**
     * Set country
     *
     * @param string $country
     * @return Address
     */
    public function setCountry($country)
    {
        $this->country = $country;
    
        return $this;
    }

    /**
     * Get country
     *
     * @return string 
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set employers
     *
     * @param \Recruiter\EmployerBundle\Entity\Employer $employers
     * @return Address
     */
    public function setEmployers(\Recruiter\EmployerBundle\Entity\Employer $employers = null)
    {
        $this->employers = $employers;
    
        return $this;
    }

    /**
     * Get employers
     *
     * @return \Recruiter\EmployerBundle\Entity\Employer 
     */
    public function getEmployers()
    {
        return $this->employers;
    }
    
    public function __toString()
    {
    	$address = $this->getAddress1() . ", ";
    	
    	if ($this->getAddress2()) {
    		$address .= $this->getAddress2() . ", ";
    	}
    	
    	$address .= $this->getTown() . ", ";
    	
    	$address .= $this->getCounty() . ", ";
    	
    	$address .= $this->getCountry();
    	
    	return $address;
    }

    /**
     * Set employer
     *
     * @param \Recruiter\EmployerBundle\Entity\Employer $employer
     * @return Address
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