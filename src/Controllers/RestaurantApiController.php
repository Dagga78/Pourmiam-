<?php

/*
 * Generated File.
 * Swagger Codegen Specific build
 * 
 */

namespace Controllers;

/**
 * Description of RestaurantApiController
 *
 * @author patrick
 */
class RestaurantApiController extends ApiController
{


    /**
     * function restaurantFind:
     * params :
     *  city: string
     *  name: string
     * @author CodeGen
     */
    public function restaurantFind($request, $response, $args)
    {

        $params = $request->getQueryParams();


        if (empty($params['city'])) {
            throw new \Exceptions\MissingParameterException();
        } else {
            // Ville coché
            $ville = filter_var($params['city'], FILTER_SANITIZE_STRING);
            if (empty($params['idBudget'])) {

                if (empty($params['Type_cuisine.id'])) {

                    //Juste ville coché
                    $data = $this->db->fetchAll("select * from Restaurant inner join Budget on Restaurant.Budget= Budget.idbudget inner join Type_cuisine on Restaurant.Type_cuisine = Type_cuisine.idTypecuisine where Restaurant.city = ?", [$ville]);

                } else {
                    $type = filter_var($params['Type_cuisine.id'], FILTER_SANITIZE_STRING);
                    // Ville + type sans budget
                    $data = $this->db->fetchAll("select * from Restaurant inner join Budget on Restaurant.Budget= Budget.idbudget inner join Type_cuisine on Restaurant.Type_cuisine = Type_cuisine.idTypecuisine where Restaurant.Type_cuisine = ?", [$type], "And Restaurant.city = ?", [$ville]);

                }
            } else {
                // budget coché
                $budget = filter_var($params['idBudget'], FILTER_SANITIZE_STRING);
                if (empty($params['Type_cuisine.id'])) {

                    // budget + ville
                    $data = $this->db->fetchAll("select * from Restaurant inner join Budget on Restaurant.Budget= Budget.idbudget inner join Type_cuisine on Restaurant.Type_cuisine = Type_cuisine.idTypecuisine where Restaurant.city = ?", [$ville], "AND Restaurant.Budget = ?", [$budget]);


                } else {
                    // Type coché
                    $type = filter_var($params['Type_cuisine.id'], FILTER_SANITIZE_STRING);
                    //budget + ville + type
                    $data = $this->db->fetchAll("select * from Restaurant inner join Budget on Restaurant.Budget= Budget.idbudget inner join Type_cuisine on Restaurant.Type_cuisine = Type_cuisine.idTypecuisine where Restaurant.Type_cuisine = ?", [$type], "And Restaurant.city = ?", [$ville], "AND Restaurant.Budget = ?", [$budget]);
                }
            }
        }

        if (empty($data)) {


        } else {
            return $response->withJSON($data);
        }

        if (empty($params['Type_cuisine.id'])) {

        }
        $type = filter_var($params['Type_cuisine.id'], FILTER_SANITIZE_STRING);
        $data = $this->db->fetchAssoc("SELECT * FROM Restaurant INNER JOIN Restaurant_has_Type_cuisine ON Restaurant.idRestaurant = Restaurant_has_Type_cuisine.idRestaurant where Restaurant_has_Type_cuisine.idType_cuisine = ?", [$type]);
        if (empty($data)) {

        } else {
            return $response->withJSON($data);
        }

    }

    public function restaurantGet($request, $response, $args)
    {

        if (empty($args['id'])) {
            throw new \Exceptions\MissingParameterException();
        }
        $id = $args['id'];
        $sql = "SELECT * from restaurant WHERE idRestaurant = ?";
        $data = $this->db->fetchAssoc($sql, [$id]);
        if (empty($data)) {
            throw new \Exceptions\NotFoundException;
        }

        return $response->withJSON($data);
    }

    public function restaurantUp($request, $response, $args)
    {

        if (empty($args['id'])) {
            throw new \Exceptions\MissingParameterException();
        }
        $id = $args['id'];
        $sql = "SELECT * from restaurant WHERE idRestaurant = ?";
        $data = $this->db->fetchAssoc($sql, [$id]);
        if (empty($data)) {
            throw new \Exceptions\NotFoundException;
        }
        $newdata = $data['positif'] + 1;
        return $this->db->update('Restaurant', array(
            'name' => $data['name'],
            'Adresse' => $data['Adresse'],
            'city' => $data ['city'],
            'positif' => $newdata,
            'negatif' => $data['negatif']),
            array('idRestaurant' => $id)
        );
    }

    public function restaurantDown($request, $response, $args)
    {

        if (empty($args['id'])) {
            throw new \Exceptions\MissingParameterException();
        }
        $id = $args['id'];
        $sql = "SELECT * from restaurant WHERE idRestaurant = ?";
        $data = $this->db->fetchAssoc($sql, [$id]);
        if (empty($data)) {
            throw new \Exceptions\NotFoundException;
        }
        $newdata = $data['negatif'] + 1;
        return $this->db->update('Restaurant', array(
            'name' => $data['name'],
            'Adresse' => $data['Adresse'],
            'city' => $data ['city'],
            'positif' => $data['positif'],
            'negatif' => $newdata),
            array('idRestaurant' => $id)
        );
    }


}
