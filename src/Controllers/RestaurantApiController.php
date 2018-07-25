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
            $data = $this->db->fetchAll("select * from Restaurant inner join Budget on Restaurant.Budget= Budget.idbudget inner join Type_cuisine on Restaurant.Type_cuisine = Type_cuisine.idTypecuisine where Restaurant.city = ?", [$params['city']]);
            if (empty($data)) {
                throw new \Exceptions\NotFoundException;
            } else {
                return $response->withJSON($data);
            }
        }
    }


    public function restaurantGet($request, $response, $args)
    {

        if (empty($args['id'])) {
            throw new \Exceptions\MissingParameterException();
        }
        $id = $args['id'];
        $sql = "select * from Restaurant inner join Budget on Restaurant.Budget= Budget.idbudget inner join Type_cuisine on Restaurant.Type_cuisine = Type_cuisine.idTypecuisine WHERE idRestaurant = ?";
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
