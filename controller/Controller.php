<?php

namespace AppliRembFraisControle\controller;


use AppliRembFraisControle\model\repository\{
	ActionRepository,
	TableRepository,
	LogEvenementRepository
};
use AppliRembFraisControle\model\entity\{
	Utilisateur,
	LogEvenement
};
use DateTime;


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
	public function AjoutLog($action, $table, $numEnreg)
	{

		$idUtilConnecte = $_SESSION['id'];

		$actionRepo = new ActionRepository();

		$action = $actionRepo->getIdAction($action);

		$tableRepo = new TableRepository();
		$table = $tableRepo->getIdTable($table);
		$ip = $_SERVER['REMOTE_ADDR'];
		$logRepo = new LogEvenementRepository();
		$date = new DateTime();
		$utilisateur = new Utilisateur($idUtilConnecte);
		$logEvenement = new LogEvenement(0, $ip, $date, $numEnreg, $action, $table, $utilisateur);

		$ret = $logRepo->AjoutLog($logEvenement);
		return $ret;
	}
}
