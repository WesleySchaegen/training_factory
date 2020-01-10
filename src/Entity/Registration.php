<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RegistrationRepository")
 */
class Registration
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $payment;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="registrations")
     */
    private $member;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Lesson", inversedBy="registrations")
     */
    private $lesson;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="registration")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    public function getPayment(): ?float
    {
        return $this->payment;
    }

    public function setPayment(?float $payment): self
    {
        $this->payment = $payment;

        return $this;
    }

    public function getMember(): ?member
    {
        return $this->member;
    }

    public function setMember(?member $member): self
    {
        $this->member = $member;

        return $this;
    }

    public function getLesson(): ?lesson
    {
        return $this->lesson;
    }

    public function setLesson(?lesson $lesson): self
    {
        $this->lesson = $lesson;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }


}
