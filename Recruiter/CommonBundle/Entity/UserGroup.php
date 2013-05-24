<?php

namespace Recruiter\CommonBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UserGroup
 *
 * @ORM\Table(name="user_groups")
 * @ORM\Entity(repositoryClass="Recruiter\CommonBundle\Entity\UserGroupRepository")
 */
class UserGroup
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
     * @ORM\Column(name="user_group_name", type="string", length=50)
     */
    private $user_group_name;


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
     * Set user_group_name
     *
     * @param string $userGroupName
     * @return UserGroup
     */
    public function setUserGroupName($userGroupName)
    {
        $this->user_group_name = $userGroupName;
    
        return $this;
    }

    /**
     * Get user_group_name
     *
     * @return string 
     */
    public function getUserGroupName()
    {
        return $this->user_group_name;
    }
}