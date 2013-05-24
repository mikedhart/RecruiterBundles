<?php

namespace Recruiter\CommonBundle\Entity;

use Recruiter\RecruitBundle\Entity\PortfolioEntry;

use Doctrine\ORM\Mapping as ORM;
use Recruiter\RecruitBundle\Entity\Recruit;
use Recruiter\EmployerBundle\Entity\Employer;

/**
 * Upload
 *
 * @ORM\Table(name="uploads")
 * @ORM\Entity(repositoryClass="Recruiter\CommonBundle\Entity\UploadRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Upload
{
	protected $file;
	protected $path;
	
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
     * @ORM\Column(name="upload_file_name", type="string", length=100)
     */
    private $upload_file_name;

    /**
     * @var integer
     *
     * @ORM\Column(name="upload_file_size", type="integer")
     */
    private $upload_file_size;

    /**
     * @var string
     *
     * @ORM\Column(name="upload_file_type", type="string", length=20)
     */
    private $upload_file_type;

    /**
     * @var integer
     *
     * @ORM\Column(name="upload_created_at", type="integer")
     */
    private $upload_created_at;

    /**
     * @ORM\ManyToOne(targetEntity="Recruiter\RecruitBundle\Entity\Recruit", inversedBy="uploads")
     * @var Recruit
     */
    private $recruit;
    
    /**
     * @ORM\ManyToOne(targetEntity="Recruiter\EmployerBundle\Entity\Employer", inversedBy="uploads")
     * @var Employer
     */
    private $employer;
    
    /**
     * @ORM\ManyToOne(targetEntity="UploadType", inversedBy="uploads")
     * @var Upload
     */
    private $upload_type;
    
    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function preUpload()
    {
    	if (null !== $this->file) {
    		// do whatever you want to generate a unique name
    		$filename = sha1(uniqid(mt_rand(), true));
    		$filename = $filename.'.'.$this->file->guessExtension();
    		$this->path = $filename;
    		$this->setUploadFilename($filename);
    		$this->setUploadFileSize($this->file->getSize());
    		$this->setUploadFileType($this->file->getType());
    		$this->setUploadCreatedAt(time());
    	}
    }
    
    /**
     * @ORM\PostPersist()
     * @ORM\PostUpdate()
     */
    public function upload()
    {
    	if (null === $this->file) {
    		return;
    	}
    
    	// if there is an error when moving the file, an exception will
    	// be automatically thrown by move(). This will properly prevent
    	// the entity from being persisted to the database on error
    	$this->file->move($this->getUploadRootDir(), $this->path);
    
    	unset($this->file);
    }
    
    /**
     * @ORM\PostRemove()
     */
    public function removeUpload()
    {
    	if ($file = $this->getAbsolutePath()) {
    		unlink($file);
    	}
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
     * Set upload_file_name
     *
     * @param string $uploadFileName
     * @return Upload
     */
    public function setUploadFileName($uploadFileName)
    {
        $this->upload_file_name = $uploadFileName;
    
        return $this;
    }

    /**
     * Get upload_file_name
     *
     * @return string 
     */
    public function getUploadFileName()
    {
        return $this->upload_file_name;
    }

    /**
     * Set upload_file_size
     *
     * @param integer $uploadFileSize
     * @return Upload
     */
    public function setUploadFileSize($uploadFileSize)
    {
        $this->upload_file_size = $uploadFileSize;
    
        return $this;
    }

    /**
     * Get upload_file_size
     *
     * @return integer 
     */
    public function getUploadFileSize()
    {
        return $this->upload_file_size;
    }

    /**
     * Set upload_file_type
     *
     * @param string $uploadFileType
     * @return Upload
     */
    public function setUploadFileType($uploadFileType)
    {
        $this->upload_file_type = $uploadFileType;
    
        return $this;
    }

    /**
     * Get upload_file_type
     *
     * @return string 
     */
    public function getUploadFileType()
    {
        return $this->upload_file_type;
    }

    /**
     * Set upload_created_at
     *
     * @param integer $uploadCreatedAt
     * @return Upload
     */
    public function setUploadCreatedAt($uploadCreatedAt)
    {
        $this->upload_created_at = $uploadCreatedAt;
    
        return $this;
    }

    /**
     * Get upload_created_at
     *
     * @return integer 
     */
    public function getUploadCreatedAt()
    {
        return $this->upload_created_at;
    }

    /**
     * Set recruit
     *
     * @param \Recruiter\RecruitBundle\Entity\Recruit $recruit
     * @return Upload
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
     * Set employer
     *
     * @param \Recruiter\EmployerBundle\Entity\Employer $employer
     * @return Upload
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

    /**
     * Set upload_type
     *
     * @param \Recruiter\CommonBundle\Entity\UploadType $uploadType
     * @return Upload
     */
    public function setUploadType(\Recruiter\CommonBundle\Entity\UploadType $uploadType = null)
    {
        $this->upload_type = $uploadType;
    
        return $this;
    }

    /**
     * Get upload_type
     *
     * @return \Recruiter\CommonBundle\Entity\UploadType 
     */
    public function getUploadType()
    {
        return $this->upload_type;
    }
    
    public function getAbsolutePath()
    {
    	return null === $this->path
    	? null
    	: $this->getUploadRootDir().'/'.$this->path;
    }
    
    public function getWebPath()
    {
    	return '/'.$this->getUploadDir().'/'.$this->getUploadFileName();
    }
    
    protected function getUploadRootDir()
    {
    	// the absolute directory path where uploaded
    	// documents should be saved
    	return __DIR__.'/../../../../web/'.$this->getUploadDir();
    }
    
    protected function getUploadDir()
    {
    	// get rid of the __DIR__ so it doesn't screw up
    	// when displaying uploaded doc/image in the view.
    	return 'uploads/documents' . '/' . $this->getUploadType()->getUploadTypeName();
    }
    
    /*public function doUpload()
    {
    	// the file property can be empty if the field is not required
    	if (null === $this->file) {
    		return;
    	}
    
    	// use the original file name here but you should
    	// sanitize it at least to avoid any security issues
    
    	// move takes the target directory and then the
    	// target filename to move to
    	$this->file->move(
    		$this->getUploadRootDir(),
    		$this->file->getClientOriginalName()
    	);
    
    	// set the path property to the filename where you've saved the file
    	$this->path = $this->file->getClientOriginalName();
    
    	// clean up the file property as you won't need it anymore
    	$this->file = null;
    }*/

    /**
     * Set uploads
     *
     * @param \Recruiter\RecruitBundle\Entity\PortfolioEntry $uploads
     * @return Upload
     */
    public function setUploads(\Recruiter\RecruitBundle\Entity\PortfolioEntry $uploads = null)
    {
        $this->uploads = $uploads;
    
        return $this;
    }

    /**
     * Get uploads
     *
     * @return \Recruiter\RecruitBundle\Entity\PortfolioEntry 
     */
    public function getUploads()
    {
        return $this->uploads;
    }

    /**
     * Set portfolio_entry
     *
     * @param \Recruiter\RecruitBundle\Entity\PortfolioEntry $portfolioEntry
     * @return Upload
     */
    public function setPortfolioEntry(\Recruiter\RecruitBundle\Entity\PortfolioEntry $portfolioEntry = null)
    {
        $this->portfolio_entry = $portfolioEntry;
    
        return $this;
    }

    /**
     * Get portfolio_entry
     *
     * @return \Recruiter\RecruitBundle\Entity\PortfolioEntry 
     */
    public function getPortfolioEntry()
    {
        return $this->portfolio_entry;
    }
    
    public function getFile()
    {
    	return $this->file;
    }
    
    public function setFile($file)
    {
    	$this->file = $file;
    }
    
    public function getPath()
    {
    	return $this->path;
    }
    
    public function setPath($path)
    {
    	$this->path = $path;
    }
    
    public function __toString()
    {
    	return $this->getUploadFileName();
    }
}