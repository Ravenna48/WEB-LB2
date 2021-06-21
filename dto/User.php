<?php


class User
{
    private $name;
    private $email;
    private $password;
    private $session_id;
    private $session_time;

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email): void
    {
        $this->email = htmlspecialchars($email);
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password): void
    {
        $this->password = htmlspecialchars($password);
    }

    /**
     * @return mixed
     */
    public function getSessionId()
    {
        return $this->session_id;
    }

    /**
     * @param mixed $session_id
     */
    public function setSessionId($session_id): void
    {
        $this->session_id = $session_id;
    }

    /**
     * @return mixed
     */
    public function getSessionTime()
    {
        return $this->session_time;
    }

    /**
     * @param mixed $session_time
     */
    public function setSessionTime($session_time): void
    {
        $this->session_time = $session_time;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

}