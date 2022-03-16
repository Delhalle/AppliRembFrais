<?php

namespace AppliRembFraisControle\model\entity;

use AppliRembFraisControle\model\entity\Profil;
use AppliRembFraisControle\model\entity\Fonctionnalite;

class ProfilFonct
{

	private Profil $leProfil;
	private Fonctionnalite $laFonct;

	public function __construct($leProfil, $laFonct)
	{
		$this->leProfil = $leProfil;
		$this->laFonct = $laFonct;
	}
	public function getLeProfil()
	{
		return $this->leProfil;
	}
	public function setLeProfil($leProfil)
	{
		$this->leProfil = $leProfil;
	}
	public function getLaFonct()
	{
		return $this->laFonct;
	}
	public function setLaFonct($laFonct)
	{
		$this->laFonct = $laFonct;
	}
}
