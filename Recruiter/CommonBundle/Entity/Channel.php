<?php

namespace Recruiter\CommonBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;

use Doctrine\ORM\Mapping as ORM;

/**
 * Channel
 *
 * @ORM\Table(name="channels")
 * @ORM\Entity
 */
class Channel
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
     * @ORM\Column(name="channel_name", type="string", length=20)
     */
    private $channel_name;
    
    public function __construct()
    {
    	$this->recruits = new ArrayCollection();
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
     * Set channel_name
     *
     * @param string $channelName
     * @return Channel
     */
    public function setChannelName($channelName)
    {
        $this->channel_name = $channelName;
    
        return $this;
    }

    /**
     * Get channel_name
     *
     * @return string 
     */
    public function getChannelName()
    {
        return $this->channel_name;
    }

    /**
     * Add recruits
     *
     * @param \Recruiter\RecruitBundle\Entity\Recruit $recruits
     * @return Channel
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
}