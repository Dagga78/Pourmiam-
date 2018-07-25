<?php

/*
 * Generated File.
 * Swagger Codegen Specific build
 * 
 */

namespace Controllers;

/**
 * Description of ComentaryApiController
 *
 * @author patrick
 */
class ComentaryApiController extends ApiController{


/**
 * function comentaryCreate:
 * params :
 *  comentary: \\Models\Comentary
 * @author CodeGen
 */
    public function comentaryCreate($request, $response, $args) {

        $body = $request->getParsedBody();

        if (empty($body['Commentaire'])) {
            throw new \Exceptions\MissingParameterException();
        }
        $comentary = $body['Commentaire'];
        if (empty($body['Nom'])){
           $username = "Anonyme";
        }else{
            $username = $body['Nom'];
        }
        $insertValues = [
            "Nom" => $username,
            "Commentaire" => $comentary,

        ];
        return $this->db->insert('Avis', $insertValues);


}


/**
 * function comentaryFind:
 * params :
 *  idrestaurant: int
 * @author CodeGen
 */
    public function comentaryFind($request, $response, $args) {

        $queryParams = $request->getQueryParams();
        $idrestaurant = $queryParams['idrestaurant'];

        if (empty($idrestaurant))
        {
           throw new \Exceptions\MissingParameterException();
        }
        else
        {
            $response->$this->db->fetchAll("select * from Restaurant inner join Restaurant on Avis.Restaurant= Restaurant.idRestaurant  where Restaurant.idRestaurant = ?", $idrestaurant);
            if (empty($response)) {
                throw new \Exceptions\NotFoundException;
            }
            return $response->withJSON();
        }


    }
}
