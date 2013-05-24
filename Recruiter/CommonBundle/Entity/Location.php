<?php

namespace Recruiter\CommonBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;

use Doctrine\ORM\Mapping as ORM;
use Recruiter\RecruitBundle\Entity\Recruit;
/**
 * Location
 *
 * @ORM\Table(name="locations")
 * @ORM\Entity(repositoryClass="Recruiter\CommonBundle\Entity\LocationRepository")
 */
class Location
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
     * @ORM\Column(name="postcode", type="string", length=10)
     */
    private $postcode;

    /**
     * @var integer
     *
     * @ORM\Column(name="x", type="integer")
     */
    private $x;

    /**
     * @var integer
     *
     * @ORM\Column(name="y", type="integer")
     */
    private $y;

    /**
     * @var string
     *
     * @ORM\Column(name="district", type="string", length=50)
     */
    private $district;

    /**
     * @var integer
     *
     * @ORM\Column(name="latitude", type="integer")
     */
    private $latitude;

    /**
     * @var integer
     *
     * @ORM\Column(name="longitude", type="integer")
     */
    private $longitude;

    /**
     * @ORM\OneToMany(targetEntity="Recruiter\RecruitBundle\Entity\Recruit", mappedBy="location")
     * @var Recruit
     */
    private $recruits;
    
    /**
     * @ORM\OneToMany(targetEntity="Recruiter\EmployerBundle\Entity\Employer", mappedBy="location")
     * @var Employer
     */
    private $employers;

    public function __construct()
    {
    	$this->recruits = new ArrayCollection();
    	$this->employers = new ArrayCollection();
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
     * Set postcode
     *
     * @param string $postcode
     * @return Location
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
     * Set x
     *
     * @param integer $x
     * @return Location
     */
    public function setX($x)
    {
        $this->x = $x;
    
        return $this;
    }

    /**
     * Get x
     *
     * @return integer 
     */
    public function getX()
    {
        return $this->x;
    }

    /**
     * Set y
     *
     * @param integer $y
     * @return Location
     */
    public function setY($y)
    {
        $this->y = $y;
    
        return $this;
    }

    /**
     * Get y
     *
     * @return integer 
     */
    public function getY()
    {
        return $this->y;
    }

    /**
     * Set district
     *
     * @param string $district
     * @return Location
     */
    public function setDistrict($district)
    {
        $this->district = $district;
    
        return $this;
    }

    /**
     * Get district
     *
     * @return string 
     */
    public function getDistrict()
    {
        return $this->district;
    }

    /**
     * Set latitude
     *
     * @param integer $latitude
     * @return Location
     */
    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;
    
        return $this;
    }

    /**
     * Get latitude
     *
     * @return integer 
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * Set longitude
     *
     * @param integer $longitude
     * @return Location
     */
    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;
    
        return $this;
    }

    /**
     * Get longitude
     *
     * @return integer 
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * Add recruits
     *
     * @param \Recruiter\RecruitBundle\Entity\Recruit $recruits
     * @return Location
     */
    public function addRecruit(\Recruiter\RecruitBundle\Entity\Recruit $recruits)
    {
        $this->recruits[] = $recruits;
    
        return $this;
    }

    /**
     * Remove recruits
     *
     * @param \Recruiter\RecruitBundle\Entity\Recruit $recruits
     */
    public function removeRecruit(\Recruiter\RecruitBundle\Entity\Recruit $recruits)
    {
        $this->recruits->removeElement($recruits);
    }

    /**
     * Get recruits
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getRecruits()
    {
        return $this->recruits;
    }

    /**
     * Add employers
     *
     * @param \Recruiter\EmployerBundle\Entity\Employer $employers
     * @return Location
     */
    public function addEmployer(\Recruiter\EmployerBundle\Entity\Employer $employers)
    {
        $this->employers[] = $employers;
    
        return $this;
    }

    /**
     * Remove employers
     *
     * @param \Recruiter\EmployerBundle\Entity\Employer $employers
     */
    public function removeEmployer(\Recruiter\EmployerBundle\Entity\Employer $employers)
    {
        $this->employers->removeElement($employers);
    }

    /**
     * Get employers
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getEmployers()
    {
        return $this->employers;
    }
    
    public function __toString()
    {
    	return $this->getDistrict();
    }
}