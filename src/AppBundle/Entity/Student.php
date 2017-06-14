<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Student
 *
 * @ORM\Table(name="student")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\StudentRepository")
 */
class Student
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
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="address", type="string", length=255)
     */
    private $address;

    private $name;
    /**
     * Get id
     *
     * @return int
     */

    /**
     * @ORM\ManyToOne(targetEntity="Subject", inversedBy="students")
     * @ORM\JoinColumn(name="subject_id", referencedColumnName="id",onDelete="SET NULL")
     */
    private $subject;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="students")
     * @ORM\JoinColumn(name="account_id", referencedColumnName="id",onDelete="SET NULL")
     */
    private $account;

    /**
     * @ORM\OneToMany(targetEntity="Event", mappedBy="student")
     */
    private $events;
    /**
     * @var int
     *
     * @ORM\Column(name="grade", type="integer")
     */
    private $grade;
    public function __construct()
    {
        $this->events = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Student
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
     * Set email
     *
     * @param string $email
     *
     * @return Student
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set address
     *
     * @param string $address
     *
     * @return Student
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address
     *
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set subject
     *
     * @param \AppBundle\Entity\Subject $subject
     *
     * @return Student
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
     * @return Student
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
     * Set work
     *
     * @param \AppBundle\Entity\Event $work
     *
     * @return Student
     */
    public function setWork(\AppBundle\Entity\Event $work = null)
    {
        $this->work = $work;

        return $this;
    }

    /**
     * Get work
     *
     * @return \AppBundle\Entity\Event
     */
    public function getWork()
    {
        return $this->work;
    }

    /**
     * Set fname
     *
     * @param string $fname
     *
     * @return Student
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
     * @return Student
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
     * @return Student
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

    /**
     * Add work
     *
     * @param \AppBundle\Entity\Event $work
     *
     * @return Student
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
     * Set grade
     *
     * @param integer $grade
     *
     * @return Student
     */
    public function setGrade($grade)
    {
        $this->grade = $grade;

        return $this;
    }

    /**
     * Get grade
     *
     * @return integer
     */
    public function getGrade()
    {
        return $this->grade;
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
}
