<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Subject
 *
 * @ORM\Table(name="subject")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\SubjectRepository")
 */
class Subject
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
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=20)
     */
    protected $image;

    /*
     * @ORM\OneToMany(targetEntity="groupe", mappedBy="subject")
     */
    private $groupes;



    public function __construct()
    {

        //$this->groupes = new ArrayCollection();
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
     * @return Subject
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



    /*
     * Add groupe
     *
     * @param \AppBundle\Entity\groupe $groupe
     *
     * @return Subject
     */
/*    public function addGroupe(\AppBundle\Entity\groupe $groupe)
    {
        $this->groupes[] = $groupe;

        return $this;
    }*/

    /*
     * Remove groupe
     *
     * @param \AppBundle\Entity\groupe $groupe
     */
/*    public function removeGroupe(\AppBundle\Entity\groupe $groupe)
    {
        $this->groupes->removeElement($groupe);
    }*/

    /*
     * Get groupes
     *
     * @return \Doctrine\Common\Collections\Collection
     */
/*    public function getGroupes()
    {
        return $this->groupes;
    }*/

}
