<?php

namespace Recruiter\CommonBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;

use Doctrine\ORM\Mapping as ORM;

/**
 * UploadType
 *
 * @ORM\Table(name="upload_types")
 * @ORM\Entity(repositoryClass="Recruiter\CommonBundle\Entity\UploadTypeRepository")
 */
class UploadType
{
	const TYPE_PROFILE_PICTURE = "profile_picture";
	const TYPE_PORTFOLIO_PICTURE = "portfolio_picture";
	const TYPE_CV = "cv";
	
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
     * @ORM\Column(name="upload_type_name", type="string", length=100)
     */
    private $upload_type_name;

    /**
     * @ORM\OneToMany(targetEntity="Upload", mappedBy="upload_type")
     * @var Upload
     */
	private $uploads;
	
	public function __construct()
	{
		$this->uploads = new ArrayCollection();	
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
     * Set upload_type_name
     *
     * @param string $uploadTypeName
     * @return UploadType
     */
    public function setUploadTypeName($uploadTypeName)
    {
        $this->upload_type_name = $uploadTypeName;
    
        return $this;
    }

    /**
     * Get upload_type_name
     *
     * @return string 
     */
    public function getUploadTypeName()
    {
        return $this->upload_type_name;
    }

    /**
     * Add uploads
     *
     * @param \Recruiter\CommonBundle\Entity\Upload $uploads
     * @return UploadType
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
}