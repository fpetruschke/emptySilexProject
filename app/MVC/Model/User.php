<?php

namespace emptyProjectSilex\Model;

/**
 * User
 *
 * Represents the user
 *
 * User can be coworker and are linked to devices which they are using.
 * They can also be user of the inventory tool and have a user account if created with username and password.
 *
 * @author  Florian Petruschke <florian.petruschke@gmail.com>
 * @date    26.01.16  -  15:08
 * @version 1.0
 */
class User
{

    /**
     * @var  $id           int         ID of the user
     */
    protected $id;

    /**
     * @var  $name         string      Last name of the user
     */
    protected $name;

    /**
     * @var  $firstname    string      Firstname of the user
     */
    protected $firstname;

    /**
     * @var  $callthrough  string      Call-through of the user or the department manager
     */
    protected $callthrough;

    /**
     * @var  $username     string      Username of the user for this application
     */
    protected $username;

    /**
     * @var  $password     string      Password of the user for this application
     */
    protected $password;

    /**
     * @var  $contraction  string      Contraction of the username
     */
    protected $contraction;

    /**
     * @var  $role         int         ID of the users role
     */
    protected $role;

    /**
     * @var $email          string      E-Mail adress of the user
     */
    protected $email;

    /**
     * @var $createdBy      int         Id of the user who created this user
     */
    protected $createdBy;

    /**
     * @var $created_at     datetime    Date of the creation
     */
    protected $created_at;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * @return string
     */
    public function getContraction()
    {
        return $this->contraction;
    }

    /**
     * @return string
     */
    public function getCallthrough()
    {
        return $this->callthrough;
    }

    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @return int
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * @return string
     */
    public function getEMail()
    {
        return $this->email;
    }

    /**
     * @return int
     */
    public function getCreatedBy()
    {
        return $this->createdBy;
    }

    /**
     * @return datetime
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @param string $firstname
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;
    }

    /**
     * @param string $contraction
     */
    public function setContraction($contraction)
    {
        $this->contraction = $contraction;
    }

    /**
     * @param string $callthrough
     */
    public function setCallthrough($callthrough)
    {
        $this->callthrough = $callthrough;
    }

    /**
     * @param string $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @param int $role
     */
    public function setRole($role)
    {
        if(is_string($role)) {
            $role = intval($role);
        }
        $this->role = $role;
    }

    /**
     * @param string $email
     */
    public function setEMail($email)
    {
        $this->email = $email;
    }

    /**
     * @param int $userId
     */
    public function setCreatedBy($userId)
    {
        if(is_string($userId)) {
            $userId = intval($userId);
        }
        $this->createdBy = $userId;
    }

    /**
     * @param dateTime $datetimeOfCreation
     */
    public function setCreatedAt($datetimeOfCreation)
    {
        $this->created_at = $datetimeOfCreation;
    }
}
