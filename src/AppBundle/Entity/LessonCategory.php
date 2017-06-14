<?php
/**
 * Created by PhpStorm.
 * User: Pavel
 * Date: 19.04.2017
 * Time: 12:46
 */

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * LessonCategory
 *
 * @ORM\Table(name="lesson_category")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\LessonCategoryRepository")
 */
class LessonCategory
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


    /**
     * @ORM\OneToMany(targetEntity="Lesson", mappedBy="category")
     */
    private $lessons;




    public function __construct()
    {

        $this->lessons = new ArrayCollection();
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
     * @return LessonCategory
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

    /**
     * Add teacher
     *
     * @param \AppBundle\Entity\Lesson $teacher
     *
     * @return LessonCategory
     */
    public function addTeacher(\AppBundle\Entity\Lesson $teacher)
    {
        $this->teachers[] = $teacher;

        return $this;
    }

    /**
     * Remove teacher
     *
     * @param \AppBundle\Entity\Lesson $teacher
     */
    public function removeTeacher(\AppBundle\Entity\Lesson $teacher)
    {
        $this->teachers->removeElement($teacher);
    }

    /**
     * Get teachers
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTeachers()
    {
        return $this->teachers;
    }

    /**
     * Add lesson
     *
     * @param \AppBundle\Entity\Lesson $lesson
     *
     * @return LessonCategory
     */
    public function addWork(\AppBundle\Entity\Lesson $lesson)
    {
        $this->lessons[] = $lesson;

        return $this;
    }

    /**
     * Remove lesson
     *
     * @param \AppBundle\Entity\Lesson $lesson
     */
    public function removeWork(\AppBundle\Entity\Lesson $lesson)
    {
        $this->lessons->removeElement($lesson);
    }

    /**
     * Get lessons
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getLessons()
    {
        return $this->lessons;
    }
}