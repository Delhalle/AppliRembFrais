<?php
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
}
