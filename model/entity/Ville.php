<?php
namespace App\Model\Entity;

class Ville
{
	private ?int $numInsee;
	private ?string $codePostal;
	private ?string $nomVille;

	public function __construct($numInsee, $codePostal, $nomVille)
	{
		$this->numInsee = $numInsee;
		$this->codePostal = $codePostal;
        $this->nomVille = $nomVille;
	}
    public function getNumInsee()
	{
		return $this->numInsee;
	}
	public function setNumInsee($numInsee)
	{
		$this->numInsee = $numInsee;
	}
    public function getCodePostal()
	{
		return $this->codePostal;
	}
	public function setCodePostal($codePostal)
	{
		$this->codePostal = $codePostal;
	}
    public function getNomVille()
	{
		return $this->nomVille;
	}
	public function setNomVille($nomVille)
	{
		$this->nomVille = $nomVille;
	}
}