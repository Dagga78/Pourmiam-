<?php

/*
 * Generated File.
 * Swagger Codegen Specific build
 * 
 */

namespace Controllers;

/**
 * Description of DishApiController
 *
 * @author patrick
 */
class DishApiController extends ApiController
{


    /**
     * function dishCreate:
     * params :
     *  dish: \\Models\Dish
     * @author CodeGen
     */
    public function dishGetByRestaurant($request, $response, $args)
    {

        if (empty($args['id'])) {
            throw new \Exceptions\MissingParameterException();
        }

        $id = ($args['id']);
        $Plats = $this->db->fetchAll("SELECT * FROM Plats INNER JOIN Restaurant_has_plats ON Plats.id = Restaurant_has_plats.idPlats where Restaurant_has_plats.idRestaurant = ?", [$id]);

        if (empty($Plats)) {
            throw new \Exceptions\NotFoundException();
        }
        return $response->withJSON($Plats);

    }

# end of operations block
}
