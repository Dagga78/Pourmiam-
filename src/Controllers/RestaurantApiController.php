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
        }
        $ville = filter_var($params['city'], FILTER_SANITIZE_STRING);
        $data = $this->db->fetchAssoc("SELECT * FROM restaurant WHERE city = ?", [$ville]);
        if (empty($data)) {
            throw new \Exceptions\NotFoundException();
        } else {
            return $response->withJSON($data);
        }
        if (empty($params['idBudget'])) {
            throw new \Exceptions\MissingParameterException();
        }
        $budget = filter_var($params['idBudget'], FILTER_SANITIZE_STRING);
        $data = $this->db->fetchAssoc("SELECT * FROM Restaurant INNER JOIN Restaurant_has_budget ON Restaurant.idRestaurant = Restaurant_has_budget.idRestaurant where Restaurant_has_budget.idBudget = ?", [$budget]);
        if (empty($data)) {
            throw new \Exceptions\NotFoundException();
            return "ok budget";
        } else {
            return $response->withJSON($data);
        }

        $type = filter_var($params['idRestaurant'], FILTER_SANITIZE_STRING);
        $data = $this->db->fetchAssoc("SELECT * FROM Restaurant INNER JOIN Restaurant_has_Type_cuisine ON Restaurant.idRestaurant = Restaurant_has_Type_cuisine.idRestaurant where Restaurant_has_Type_cuisine.idRestaurant = ?", [$type]);
        if (empty($data)) {
            throw new \Exceptions\NotFoundException();
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
            array('idRestaurant'=> $id)
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
            array('idRestaurant'=> $id)
        );
    }







}
