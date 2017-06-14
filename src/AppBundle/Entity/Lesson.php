<?php
/**
 * Created by PhpStorm.
 * User: Pavel
 * Date: 19.04.2017
 * Time: 4:40
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Lesson
 *
 * @ORM\Table(name="lesson")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\LessonRepository")
 */
class Lesson
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
     * @ORM\ManyToOne(targetEntity="Teacher", inversedBy="lessons")
     * @ORM\JoinColumn(name="teacher_id", referencedColumnName="id",onDelete="SET NULL")
     */
    private $teacher;

    /**
     * @ORM\ManyToOne(targetEntity="LessonCategory", inversedBy="lessons")
     * @ORM\JoinColumn(name="lessoncategory_id", referencedColumnName="id",onDelete="SET NULL")
     */
    private $category;

    /**
     * @var bool
     * @ORM\Column(name="isTest" ,type="boolean")
     */
    private $isTest;
    /**
     * @var string
     *
     * @ORM\Column(name="eDate", type="string", length=255, nullable=true)
     */
    private $eDate;
    /**
     * @var int
     *
     * @ORM\Column(name="classroom", type="integer", nullable=true)
     */
    private $classroom;
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
     * Set teacher
     *
     * @param \AppBundle\Entity\Teacher $teacher
     *
     * @return Lesson
     */
    public function setTeacher(\AppBundle\Entity\Teacher $teacher = null)
    {
        $this->teacher = $teacher;

        return $this;
    }

    /**
     * Get teacher
     *
     * @return \AppBundle\Entity\Teacher
     */
    public function getTeacher()
    {
        return $this->teacher;
    }

    /**
     * Set category
     *
     * @param \AppBundle\Entity\LessonCategory $category
     *
     * @return Lesson
     */
    public function setCategory(\AppBundle\Entity\LessonCategory $category = null)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return \AppBundle\Entity\LessonCategory
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set isTest
     *
     * @param boolean $isTest
     *
     * @return Lesson
     */
    public function setIsTest($isTest)
    {
        $this->isTest = $isTest;

        return $this;
    }

    /**
     * Get isTest
     *
     * @return boolean
     */
    public function getIsTest()
    {
        return $this->isTest;
    }

    /**
     * Set date
     *
     * @param string $eDate
     *
     * @return Lesson
     */
    public function setEDate($eDate)
    {
        $this->eDate = $eDate;

        return $this;
    }

    /**
     * Get date
     *
     * @return string
     */
    public function getEDate()
    {
        return $this->eDate;
    }

    /**
     * Set classroom
     *
     * @param integer $classroom
     *
     * @return Lesson
     */
    public function setClassroom($classroom)
    {
        $this->classroom = $classroom;

        return $this;
    }

    /**
     * Get classroom
     *
     * @return integer
     */
    public function getClassroom()
    {
        return $this->classroom;
    }
}