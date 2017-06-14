<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Teacher
 *
 * @ORM\Table(name="teacher")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\TeacherRepository")
 */
class Teacher
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="fname", type="string", length=255)
     */
    private $fname;

    /**
     * @var string
     *
     * @ORM\Column(name="lname", type="string", length=255)
     */
    private $lname;

    /**
     * @var string
     *
     * @ORM\Column(name="mname", type="string", length=255)
     */
    private $mname;

    /**
     * @ORM\ManyToOne(targetEntity="Subject", inversedBy="teachers")
     * @ORM\JoinColumn(name="subject_id", referencedColumnName="id",onDelete="SET NULL")
     */
    private $subject;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="teachers")
     * @ORM\JoinColumn(name="account_id", referencedColumnName="id",onDelete="SET NULL")
     */
    private $account;

    /**
     * @ORM\OneToMany(targetEntity="Event", mappedBy="teacher")
     */
    private $events;

    public function __construct()
    {

        $this->events = new ArrayCollection();
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Teacher
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->lname ." ". substr($this->fname,0,1) .".". substr($this->mname,0,1).".";
    }

    /**
     * Set subject
     *
     * @param \AppBundle\Entity\Subject $subject
     *
     * @return Teacher
     */
    public function setSubject(\AppBundle\Entity\Subject $subject = null)
    {
        $this->subject = $subject;

        return $this;
    }

    /**
     * Get subject
     *
     * @return \AppBundle\Entity\Subject
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * Set account
     *
     * @param \AppBundle\Entity\User $account
     *
     * @return Teacher
     */
    public function setAccount(\AppBundle\Entity\User $account = null)
    {
        $this->account = $account;

        return $this;
    }

    /**
     * Get account
     *
     * @return \AppBundle\Entity\User
     */
    public function getAccount()
    {
        return $this->account;
    }

    /**
     * Add work
     *
     * @param \AppBundle\Entity\Event $work
     *
     * @return Teacher
     */
    public function addWork(\AppBundle\Entity\Event $work)
    {
        $this->events[] = $work;

        return $this;
    }

    /**
     * Remove work
     *
     * @param \AppBundle\Entity\Event $work
     */
    public function removeWork(\AppBundle\Entity\Event $work)
    {
        $this->events->removeElement($work);
    }

    /**
     * Get works
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEvents()
    {
        return $this->events;
    }

    /**
     * Set fname
     *
     * @param string $fname
     *
     * @return Teacher
     */
    public function setFname($fname)
    {
        $this->fname = $fname;

        return $this;
    }

    /**
     * Get fname
     *
     * @return string
     */
    public function getFname()
    {
        return $this->fname;
    }

    /**
     * Set lname
     *
     * @param string $lname
     *
     * @return Teacher
     */
    public function setLname($lname)
    {
        $this->lname = $lname;

        return $this;
    }

    /**
     * Get lname
     *
     * @return string
     */
    public function getLname()
    {
        return $this->lname;
    }

    /**
     * Set mname
     *
     * @param string $mname
     *
     * @return Teacher
     */
    public function setMname($mname)
    {
        $this->mname = $mname;

        return $this;
    }

    /**
     * Get mname
     *
     * @return string
     */
    public function getMname()
    {
        return $this->mname;
    }
}
