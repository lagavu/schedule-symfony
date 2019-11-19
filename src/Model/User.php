<?php

namespace App\Model;


use App\Model\EmployeeHolidays;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="user_users")
 */
class User
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var ArrayCollection|EmployeeHolidays[]
     * @ORM\OneToMany(targetEntity="App\Model\EmployeeHolidays", mappedBy="user", orphanRemoval=true, cascade={"all"})
     */
    private $holiday;

    /**
     * @ORM\Column(type="time")
     */
    private $morning_work_hours_from;

    /**
     * @ORM\Column(type="time")
     */
    private $morning_work_hours_before;

    /**
     * @ORM\Column(type="time")
     */
    private $afternoon_work_hours_from;

    /**
     * @ORM\Column(type="time")
     */
    private $afternoon_work_hours_before;

    public function __construct()
    {
        $this->holiday = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|EmployeeHolidays[]
     */
    public function getHoliday(): Collection
    {
        return $this->holiday;
    }

    public function addHoliday(EmployeeHolidays $holiday): self
    {
        if (!$this->holiday->contains($holiday)) {
            $this->holiday[] = $holiday;
            $holiday->setUser($this);
        }

        return $this;
    }

    public function removeHoliday(EmployeeHolidays $holiday): self
    {
        if ($this->holiday->contains($holiday)) {
            $this->holiday->removeElement($holiday);
            // set the owning side to null (unless already changed)
            if ($holiday->getUser() === $this) {
                $holiday->setUser(null);
            }
        }

        return $this;
    }

    public function getMorningWorkHoursFrom(): ?\DateTimeInterface
    {
        return $this->morning_work_hours_from;
    }

    public function setMorningWorkHoursFrom(\DateTimeInterface $morning_work_hours_from): self
    {
        $this->morning_work_hours_from = $morning_work_hours_from;

        return $this;
    }

    public function getMorningWorkHoursBefore(): ?\DateTimeInterface
    {
        return $this->morning_work_hours_before;
    }

    public function setMorningWorkHoursBefore(\DateTimeInterface $morning_work_hours_before): self
    {
        $this->morning_work_hours_before = $morning_work_hours_before;

        return $this;
    }

    public function getAfternoonWorkHoursFrom(): ?\DateTimeInterface
    {
        return $this->afternoon_work_hours_from;
    }

    public function setAfternoonWorkHoursFrom(\DateTimeInterface $afternoon_work_hours_from): self
    {
        $this->afternoon_work_hours_from = $afternoon_work_hours_from;

        return $this;
    }

    public function getAfternoonWorkHoursBefore(): ?\DateTimeInterface
    {
        return $this->afternoon_work_hours_before;
    }

    public function setAfternoonWorkHoursBefore(\DateTimeInterface $afternoon_work_hours_before): self
    {
        $this->afternoon_work_hours_before = $afternoon_work_hours_before;

        return $this;
    }
}