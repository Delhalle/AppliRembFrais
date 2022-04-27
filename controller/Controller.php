<?php

namespace App\controller;

use App\model\entity\{Utilisateur, Action, Table, LogEvenement};
use App\model\repository\{ActionRepository, TableRepository, LogEvenementRepository};

abstract class Controller
{
	protected function __construct()
	{
	}
	public function render(string $nomVue, array $lesDonnees = [])
	{
		if (file_exists(ROOT . "/view/$nomVue.php") == true) {
			extract($lesDonnees);
			ob_start();
			require_once(ROOT . '/view/' . $nomVue . '.php');
			$content = ob_get_clean();
			require_once(ROOT . '/view/template.php');
		} else {
			http_response_code(404);
			echo ("<h2> Vue $nomVue indisponible</h2>");
		}
	}
	public function insertInLogs($informations)
	{
		$unActionRepository = new ActionRepository();
		$leIdAction = $unActionRepository->getIdByLibelle(new Action(null, $informations[0]));

		$unTableRepository = new TableRepository();
		$leIdTable = $unTableRepository->getIdByNom(new Table(null, $informations[1]));

		$leLogEvenement = new LogEvenement(
			null,
			$_SERVER['REMOTE_ADDR'],
			date('Y-m-d H:i:s'),
			$informations[2],
			new Utilisateur($informations[3]),
			new Action($leIdAction, null),
			new Table($leIdTable, null)
		);

		$unLogEvenementRepository = new logEvenementRepository();
		$leResult = $unLogEvenementRepository->insertLog($leLogEvenement);
	}
}
