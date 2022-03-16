<?php
namespace App\model\repository;
//class dont on a besoin (classe Repository.php obligatoire)

use App\model\entity\Formation;

class FormationRepository extends Repository
{
    public function getLesFormations()
    {
        $lesFormations = array();
        $db = $this->dbConnect();
        $req = $db->prepare("SELECT * FROM formation order by formation");
        $req->execute();
        $lesEnregs = $req->fetchAll();
        foreach ($lesEnregs  as $enreg) {
            $uneFormation = new Formation(
                $enreg->id,
                $enreg->formation,
            );
            array_push($lesFormations, $uneFormation);
        }
        return $lesFormations;
    }
}
