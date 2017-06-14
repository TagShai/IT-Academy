<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * groupe
 *
 * @ORM\Table(name="groupe")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\groupeRepository")
 */
class groupe
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
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /*
     * @ORM\ManyToOne(targetEntity="Teacher", inversedBy="groupes")
     * @ORM\JoinColumn(name="teacher_id", referencedColumnName="id", onDelete="SET NULL")
     */
    //private $teacher;

    /*
     * @ORM\ManyToOne(targetEntity="Subject", inversedBy="groupes")
     * @ORM\JoinColumn(name="subject_id", referencedColumnName="id", onDelete="SET NULL")
     */
    //private $subject;

    /**
     * @ORM\OneToMany(targetEntity="Student", mappedBy="group")
     */
    private $students;

    public function __construct()
    {
        $this->students = new ArrayCollection();
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
     * @return groupe
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
        return $this->name;
    }

    /*
     * Set teacher
     *
     * @param \AppBundle\Entity\Teacher $teacher
     *
     * @return groupe
     */
/*    public function setTeacher(\AppBundle\Entity\Teacher $teacher = null)
    {
        $this->teacher = $teacher;

        return $this;
    }*/

    /*
     * Get teacher
     *
     * @return \AppBundle\Entity\Teacher
     */
/*    public function getTeacher()
    {
        return $this->teacher;
    }*/

    /*
     * Set subject
     *
     * @param \AppBundle\Entity\Subject $subject
     *
     * @return groupe
     */
/*    public function setSubject(\AppBundle\Entity\Subject $subject = null)
    {
        $this->subject = $subject;

        return $this;
    }*/

    /*
     * Get subject
     *
     * @return \AppBundle\Entity\Subject
     */
/*    public function getSubject()
    {
        return $this->subject;
    }*/

    /**
     * Add student
     *
     * @param \AppBundle\Entity\Student $student
     *
     * @return groupe
     */
    public function addStudent(\AppBundle\Entity\Student $student)
    {
        $this->students[] = $student;

        return $this;
    }

    /**
     * Remove student
     *
     * @param \AppBundle\Entity\Student $student
     */
    public function removeStudent(\AppBundle\Entity\Student $student)
    {
        $this->students->removeElement($student);
    }

    /**
     * Get students
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getStudents()
    {
        return $this->students;
    }
}
