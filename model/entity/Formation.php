<?php

namespace App\model\entity;
class Formation
{
    private ?int $id;
    private ?string $formation;
    
    public function __construct($id, $formation)
    {
        $this->id = $id;
        $this->formation = $formation;
    }

    public function getId()
	{
		return $this->id;
	}
	public function setId($id)
	{
		$this->id = $id;
	}
    public function getformation()
	{
		return $this->formation;
	}
	public function setFormation($formation)
	{
		$this->formation = $formation;
	}
}