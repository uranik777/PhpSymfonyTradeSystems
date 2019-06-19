<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Settings
 *
 * @ORM\Table(name="settings")
 * @ORM\Entity
 */
class Settings
{
    /**
     * @var string
     *
     * @ORM\Column(name="userguid", type="string", length=36, nullable=false)
     * @ORM\Id
     */
    private $userguid;

    /**
     * @var string
     *
     * @ORM\Column(name="algoritm", type="string", length=36, nullable=false)
     */
    private $algoritm;

    /**
     * @var string
     *
     * @ORM\Column(name="marketplace", type="string", length=36, nullable=false)
     */
    private $marketplace;

    /**
     * @var string
     *
     * @ORM\Column(name="apikey", type="string", length=512, nullable=false)
     */
    private $apikey;

    /**
     * @var string
     *
     * @ORM\Column(name="apisecret", type="string", length=512, nullable=false)
     */
    private $apisecret;

    public function getUserguid(): ?string
    {
        return $this->userguid;
    }

    public function getAlgoritm(): ?string
    {
        return $this->algoritm;
    }

    public function setAlgoritm(string $algoritm): self
    {
        $this->algoritm = $algoritm;

        return $this;
    }

    public function getMarketplace(): ?string
    {
        return $this->marketplace;
    }

    public function setMarketplace(string $marketplace): self
    {
        $this->marketplace = $marketplace;

        return $this;
    }

    public function getApikey(): ?string
    {
        return $this->apikey;
    }

    public function setApikey(string $apikey): self
    {
        $this->apikey = $apikey;

        return $this;
    }

    public function getApisecret(): ?string
    {
        return $this->apisecret;
    }

    public function setApisecret(string $apisecret): self
    {
        $this->apisecret = $apisecret;

        return $this;
    }

    public function setUserguid(string $userguid): self
    {
        $this->userguid = $userguid;

        return $this;
    }


}
