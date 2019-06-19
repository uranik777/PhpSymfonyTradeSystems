<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Actions
 *
 * @ORM\Table(name="actions")
 * @ORM\Entity
 */
class Actions
{
    /**
     * @var string
     *
     * @ORM\Column(name="guid", type="string", length=36, nullable=false)
     * @ORM\Id
     */
    private $guid;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="timestamp", type="datetime", nullable=false)
     */
    private $timestamp;

    /**
     * @var int
     *
     * @ORM\Column(name="status", type="integer", nullable=false)
     */
    private $status;

    /**
     * @var string
     *
     * @ORM\Column(name="actionid", type="string", length=36, nullable=false)
     */
    private $actionid;

    /**
     * @var string
     *
     * @ORM\Column(name="userguid", type="string", length=36, nullable=false)
     */
    private $userguid;

    /**
     * @var string
     *
     * @ORM\Column(name="details", type="string", length=1024, nullable=false)
     */
    private $details;

    public function getGuid(): ?string
    {
        return $this->guid;
    }
    public function setGuid(string $guid): self
    {
        $this->guid = $guid;

        return $this;
    }

    public function getTimestamp(): ?\DateTimeInterface
    {
        return $this->timestamp;
    }

    public function setTimestamp(\DateTimeInterface $timestamp): self
    {
        $this->timestamp = $timestamp;

        return $this;
    }

    public function getStatus(): ?int
    {
        return $this->status;
    }

    public function setStatus(int $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getActionid(): ?int
    {
        return $this->actionid;
    }

    public function setActionid(string $actionid): self
    {
        $this->actionid = $actionid;

        return $this;
    }

    public function getUserguid(): ?string
    {
        return $this->userguid;
    }

    public function setUserguid(string $userguid): self
    {
        $this->userguid = $userguid;

        return $this;
    }

    public function getDetails(): ?string
    {
        return $this->details;
    }

    public function setDetails(string $details): self
    {
        $this->details = $details;

        return $this;
    }


}
