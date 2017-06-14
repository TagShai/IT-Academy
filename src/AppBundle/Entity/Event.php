<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Event
 *
 * @ORM\Table(name="event")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\EventRepository")
 */
class Event
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
     * @ORM\Column(name="topic", type="string", length=255)
     */
    private $topic;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=20)
     */
    protected $image;

    /**
     * @var string
     *
     * @ORM\Column(name="eDate", type="string", length=255, nullable=true)
     */
    private $eDate;

    public function getId()
    {
        return $this->id;
    }

    /**
     * Set topic
     *
     * @param string $topic
     *
     * @return Subject
     */
    public function setTopic($topic)
    {
        $this->topic = $topic;

        return $this;
    }

    /**
     * Get topic
     *
     * @return string
     */
    public function getTopic()
    {
        return $this->topic;
    }

    /**
     * Set description
     *
     * @param string description
     *
     * @return Subject
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set image
     *
     * @param string $image
     */
    public function setImage($image)
    {
        $this->image = $image;
    }

    /**
     * Get image
     *
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }


    /**
     * Set date
     *
     * @param string $eDate
     *
     * @return Event
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
}
