<?php

/*
 * Generated File.
 * Swagger Codegen Specific build
 * 
 */

namespace Controllers;

/**
 * Controller for all function requiring users use, user need to be connected
 * for use these function
 *
 * @author patrick
 */
class UserApiController extends ApiController
{
    /**
     * Get information from my account.
     * params :
     *
     * @author CodeGen
     */
    public function usersGet($request, $response, $args)
    {
        $id = $this->ci['user_id'];
        $sql = "SELECT * from users WHERE id = ?";
        $data = $this->db->fetchAssoc($sql, [$id]);
        return $response->withJSON($data);
    }
}
