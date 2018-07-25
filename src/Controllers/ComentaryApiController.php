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
class ComentaryApiController extends ApiController
{


    /**
     * function comentaryCreate:
     * params :
     *  comentary: \\Models\Comentary
     * @author CodeGen
     */
    public function comentaryCreate($request, $response, $args)
    {

        $body = $request->getParsedBody();

        if (empty($args['id'])) {
            throw new \Exceptions\MissingParameterException();
        }

        if (empty($body['Commentaire'])) {
            throw new \Exceptions\MissingParameterException();
        }
        $comentary = $body['Commentaire'];
        if (empty($body['Nom'])) {
            $username = "Anonyme";
        } else {
            $username = $body['Nom'];
        }
        $insertValues = [
            "Nom" => $username,
            "Commentaire" => $comentary,

        ];
        return $this->db->insert('Avis', $insertValues);
        $id = $this->db->fetchAssoc("select idAvis from Avis");
        
        $insertValues = [
            "idAvis" => $id,
            "idRestaurant" => $args['id']
        ];
        return $this->db->insert('Restaurant_has_Avis', $insertValues);


    }


    /**
     * function comentaryFind:
     * params :
     *  idrestaurant: int
     * @author CodeGen
     */
    public function comentaryFind($request, $response, $args)
    {

        if (empty($args['id'])) {
            throw new \Exceptions\MissingParameterException();
        }

        $Commentary = $this->db->fetchAll("select * from Avis inner join Restaurant_has_Avis on Avis.idAvis = Restaurant_has_Avis.idAvis  where Restaurant_has_Avis.idRestaurant = ?", [$args['id']]);
        if (empty($Commentary)) {
            throw new \Exceptions\NotFoundException;
        }
        return $response->withJSON($Commentary);


    }
}
