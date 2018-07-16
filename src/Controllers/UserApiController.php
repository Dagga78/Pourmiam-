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
        $logger = $this->ci->logger;
        $id = $this->ci['user_id'];
        $sql = "SELECT * from users WHERE id = ?";
        $data = $this->db->fetchAssoc($sql, [$id]);

        if ( empty($data)) {
            $logger->error("UserApiController usersGet ServerErrorException :" );
            throw new \Exceptions\ServerErrorException;
        }

        return $response->withJSON($data);
    }

    /**
     * function usersUpdate:
     * params :
     *  users: \\Models\Users
     *
     * @author CodeGen
     */
    public function usersUpdate($request, $response, $args)
    {
        $logger = $this->ci->logger;
        $body = $request->getParsedBody();

        $id = $this->ci['user_id'];
        $sql = "SELECT * from users WHERE id = ?";
        $data = $this->db->fetchAssoc($sql, [$id]);

        if ( empty($data) ) {
            $logger->error("UserApiController usersUpdate NotFoundException :" );
            throw new \Exceptions\NotFoundException;
        }

        $insertValues = [
            "firstname" => isset ($body['firstname']) ? filter_var($body['firstname'], FILTER_SANITIZE_STRING) :
                $data['firstname'],
            "lastname" => isset ($body['lastname']) ? filter_var($body['lastname'], FILTER_SANITIZE_STRING) :
                $data['lastname'],
            "email" => isset ($body['email']) ? filter_var($body['email'], FILTER_SANITIZE_STRING) : $data['email'],
            "password" => isset ($body['password']) ? password_hash($body['password'], PASSWORD_BCRYPT) :
                $data['password'],
            "id" => $id,
        ];

        //  Update dans le CRM d'abord
        $ret = $this->ci->CRMHandler->userUpdate($insertValues);

        if (!isset($ret->id)) {
            //  Si quelque chose s'est mal passe dans le CRM
            $logger->error("UserApiController usersUpdate KO :", [$ret] );
            throw new \Exceptions\ServerErrorException();
         } else {
            //  MaJ de la BdD
            $response = $this->db->update('users', $insertValues, ['id' => $id]);
        }


        return $response;
    }
    # end of operations block
}
