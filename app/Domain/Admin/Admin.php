<?php

namespace App\Domain\Admin;

use Doctrine\ORM\Mapping AS ORM;
use App\Domain\Auth\Authenticatable;
use App\Domain\User\User;

/**
 * @ORM\Entity
 * @ORM\Table(name="admins")
 */
class Admin extends User
{

    use Authenticatable;

    /**
     * @ORM\Column(type="string")
     */
    protected $name;

    /**
     * @ORM\Column(type="string", unique=true)
     */
    protected $email;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    protected $office;

    /**
     * @ORM\Column(type="boolean", options={"default" = false}, nullable=true)
     */
    protected $receiveMailNotifications = false;

    /**
     * Get the e-mail address where password reset links are sent.
     *
     * @return string
     */
    public function getEmailForPasswordReset()
    {
        return $this->email;
    }

    public function setOffice($office)
    {
        $this->office = $office;
        return $this;
    }

    public function getOffice()
    {
        return $this->office;
    }

    public function wantReceiveMailNotifications()
    {
        return $this->receiveMailNotifications;
    }

    public function setReceiveMailNotifications($receiveMailNotifications)
    {
        $this->receiveMailNotifications = (bool) $receiveMailNotifications;
        return $this;
    }

    /**
     * Send the password reset notification.
     *
     * @param  string $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        // TODO: Implement sendPasswordResetNotification() method.
    }
}