<?php

namespace AppliRembFraisControle\controller;

use AppliRembFraisControle\model\repository\{PaysRepository};
use AppliRembFraisControle\controller\Controller;

class PaysController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }



    public function getLesPaysListeDer()
    {
        session_start();

        $lesPays = new PaysRepository();

        $lesPays = $lesPays->getLesPays();

        $this->render("pays/listeDerPays", array("title" => "Liste des pays ", "lesPays" => $lesPays));

        return $lesPays;
    }
}
