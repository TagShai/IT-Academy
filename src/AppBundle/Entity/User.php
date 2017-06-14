<?php
// src/AppBundle/Entity/User.php

namespace AppBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    protected $crole;

    //protected $email;

    public function __construct()
    {
        parent::__construct();
        // your own logic
    }

    /**
     * @return mixed
     */
    public function getCrole()
    {
        return $this->crole;
    }

    /**
     * @param mixed $crole
     */
    public function setCrole($crole)
    {
        $this->crole = $crole;
    }

    /*
     * @return mixed
     */
/*    public function getEmail()
    {
        return $this->email;
    }*/

    /*
     * @param mixed $email
     */
/*    public function setEmail($email)
    {
        $this->email = $email;
    }*/

}
