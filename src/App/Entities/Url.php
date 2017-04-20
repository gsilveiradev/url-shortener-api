<?php

namespace App\Entities;

/**
 * @Entity @Table(name="urls")
 **/
class Url
{
    /**
     * @Id
     * @Column(type="integer")
     * @GeneratedValue(strategy="IDENTITY")
     */
    protected $id;
    
    /** @Column(type="integer") **/
    protected $hits;
    
    /** @Column(type="string") **/
    protected $url;

    /** @Column(type="string") **/
    protected $hash;

    /**
     * @ManyToOne(targetEntity="App\Entities\User")
     * @JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;

    public function getId()
    {
        return $this->id;
    }

    public function getHits()
    {
        return $this->hits;
    }

    public function setHits($hits)
    {
        $this->hits = $hits;
    }

    public function getUrl()
    {
        return $this->url;
    }

    public function setUrl($url)
    {
        $this->url = $url;
    }

    public function getHash()
    {
        return $this->hash;
    }

    public function setHash($hash)
    {
        $this->hash = $hash;
    }

    public function getUser()
    {
        return $this->user;
    }

    public function setUser($user)
    {
        $this->user = $user;
    }
}
