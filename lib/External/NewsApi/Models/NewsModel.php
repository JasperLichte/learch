<?php

namespace External\NewsApi\Models;

class NewsModel
{

    /** @var Article[] */
    private $business = [];

    /** @var Article[] */
    private $entertainment = [];

    /** @var Article[] */
    private $general = [];

    /** @var Article[] */
    private $health = [];

    /** @var Article[] */
    private $science = [];

    /** @var Article[] */
    private $sports = [];

    /** @var Article[] */
    private $technology = [];


    public function getBusiness(): array
    {
        return $this->business;
    }

    public function setBusiness(array $business): void
    {
        $this->business = $business;
    }

    public function getEntertainment(): array
    {
        return $this->entertainment;
    }

    public function setEntertainment(array $entertainment): void
    {
        $this->entertainment = $entertainment;
    }

    public function getGeneral(): array
    {
        return $this->general;
    }

    public function setGeneral(array $general): void
    {
        $this->general = $general;
    }

    public function getHealth(): array
    {
        return $this->health;
    }

    public function setHealth(array $health): void
    {
        $this->health = $health;
    }

    public function getScience(): array
    {
        return $this->science;
    }

    public function setScience(array $science): void
    {
        $this->science = $science;
    }

    public function getTechnology(): array
    {
        return $this->technology;
    }

    public function setTechnology(array $technology): void
    {
        $this->technology = $technology;
    }

    public function getSports(): array
    {
        return $this->sports;
    }

    public function setSports(array $sports): void
    {
        $this->sports = $sports;
    }

}
