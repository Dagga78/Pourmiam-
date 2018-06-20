<?php

/*
 * Generated File.
 * Swagger Codegen Specific build
 *
 */

namespace Controllers;
/**
 * Controller for all function that Users doesn't need to be already connected to be used
 * @author patrick
 */
class AuthentApiController extends ApiController
{

    /**
     * function authentLogin : Authenticating a Cobiz user via email and password
     * @param $request
     * @param $response
     * @return mixed
     * @throws \Exception
     * @throws \Exceptions\InvalidCredentialsException
     * @throws \Exceptions\MissingParameterException
     * @author patrick
     */
    public function authentLogin($request, $response, $args)
    {

        $user = $this->checkUserCredantials($request);

        if (is_null($user)) {
            throw new \Exceptions\InvalidCredentialsException();
        }

        //$obj = new ApiError($this->ci->logger);

        $token = bin2hex(openssl_random_pseudo_bytes(8));

        $this->storeToken($token, $user['id']);

        return $response->withJSON([
            "token" => $token,
        ]);
    }


    /**
     * Check user credentials by email and password
     * @param $request
     * @return null
     * @throws \Exceptions\MissingParameterException
     * @author patrick
     */
    protected function checkUserCredantials($request)
    {

        $input = $request->getParsedBody();
        if (empty($input['email']) || empty($input['password'])) {
            throw new \Exceptions\MissingParameterException();
        }
        $email = filter_var($input['email'], FILTER_SANITIZE_STRING);
        $password = filter_var($input['password'], FILTER_SANITIZE_STRING);


        $user = $this->db->fetchAssoc("SELECT * FROM users WHERE email = ?", [$email]);

        return ($user && password_verify($password, $user['password'])) ? $user : null;
    }


    /**
     * Store auth_token in database
     * @param $token
     * @param $userId
     * @return mixed
     * @throws \Exception
     * @author patrick
     */
    protected function storeToken($token, $userId)
    {

        $currentDateTime = new \Datetime("now", new \DateTimeZone('Europe/Paris'));
        $currentDateTime->add(new \DateInterval('PT1H'));

        $insertValues = [
            "user_id" => $userId,
            "auth_token" => $token,
            "expiration" => $currentDateTime->format('Y-m-d H:i:s')
        ];

        return $this->db->insert('auth_tokens', $insertValues);
    }

    /**
     * Password Change Request from a Cobiz User
     * @param $request
     * @param $response
     * @param $args
     * @return mixed
     * @throws \Exception
     * @throws \Exceptions\MissingParameterException
     * @throws \Exceptions\NotFoundException
     * @author jerome
     */
    public function authentReset($request, $response, $args)
    {

        $input = $request->getParsedBody();

        if (empty($input['email'])) {
            throw new \Exceptions\MissingParameterException();
        }

        $email = filter_var($input['email'], FILTER_SANITIZE_STRING);
        $user = $this->db->fetchAssoc("SELECT id FROM users WHERE email = ?", [$email]);

        if ( !isset($user['id']) ) {
            throw new \Exceptions\NotFoundException();
        }

        $token = bin2hex(openssl_random_pseudo_bytes(8));
        $this->storeConfirmToken($token, $user['id'], 'reset');
        $this->ci->notificationHandler->notifyReset($email, $token);
        return $response;
    }

    /**
     * Store confirm_token in database
     * @param $token
     * @param $userId
     * @param $type
     * @return mixed
     * @throws \Exception
     * @author jerome
     */
    private function storeConfirmToken($token, $userId, $type)
    {

        $currentDateTime = new \Datetime("now", new \DateTimeZone('Europe/Paris'));
        $currentDateTime->add(new \DateInterval('PT1H'));

        $insertValues = [
            "user_id" => $userId,
            "token" => $token,
            "expiration" => $currentDateTime->format('Y-m-d H:i:s'),
            "type_confirm" => $type
        ];

        return $this->db->insert('confirm_tokens', $insertValues);
    }

    /**
     * Changing the password of a user who has made a request
     * @param $request
     * @param $response
     * @param $args
     * @return mixed
     * @throws \Exceptions\MissingParameterException
     * @throws \Exceptions\NotFoundException
     */
    public function authentResetconfirm($request, $response, $args)
    {
        $input = $request->getParsedBody();
        if (empty($input['password'])) {
            throw new \Exceptions\MissingParameterException();
        }

        $password = filter_var($input['password'], FILTER_SANITIZE_STRING);

        $token = $args['reset_Token'];

        $user = $this->db->fetchAssoc("SELECT user_id FROM confirm_tokens WHERE token = ? AND expiration > CURRENT_TIMESTAMP AND type_confirm = 'reset'",[$token]);
        if (empty($user)) {
            throw new \Exceptions\NotFoundException();
        }

        $this->db->update('users', array('password' => password_hash($password, PASSWORD_BCRYPT)),
            array('id' => $user['user_id']));
        return $response;
    }

    /**
     * Request to create a user Cobiz, Temporary Creation of a user with the status:
     * Is_confirmed = FALSE
     * @param $request
     * @param $response
     * @param $args
     * @return mixed
     * @throws \Exception
     * @throws \Exceptions\DuplicateResourceException
     * @throws \Exceptions\MissingParameterException
     */
    public function authentInit($request, $response, $args)
    {

        $input = $request->getParsedBody();

        if (empty($input['firstname']) || empty($input['lastname']) || empty($input['email']) ||
            empty($input['password'])) {
            throw new \Exceptions\MissingParameterException();
        }

        $firstname = filter_var($input['firstname'], FILTER_SANITIZE_STRING);
        $lastname = filter_var($input['lastname'], FILTER_SANITIZE_STRING);
        $email = filter_var($input['email'], FILTER_SANITIZE_STRING);
        $password = filter_var($input['password'], FILTER_SANITIZE_STRING);

        $user = $this->db->fetchAssoc("SELECT id FROM users WHERE email = ?", [$email]);

        if (!empty($user)) {
            throw new \Exceptions\DuplicateResourceException();
        }

        $token = bin2hex(openssl_random_pseudo_bytes(8));
        $this->storeinit($firstname, $lastname, $email, $password, $token);
        //$this->ci->notificationHandler->notifyinit($email, $token);
        return $response;
    }

    /**
     * Store a temporary users in database with status : is_confirmed = 0(FALSE)
     * @param $id
     * @param $firstname
     * @param $lastname
     * @param $email
     * @param $password
     * @param $token
     * @return mixed
     * @throws \Exception
     * @author jerome
     */
    protected function storeinit($firstname, $lastname, $email, $password, $token)
    {

        $insertValues = [
            "firstname" => $firstname,
            "lastname" => $lastname,
            "email" => $email,
            "password" => password_hash($password, PASSWORD_BCRYPT),
            "is_confirmed" => 0
        ];

        return $this->db->insert('users', $insertValues);
    }

    /**
     * Changing a user with status: is_confirmed = FALSE to is_confirmed = TRUE
     * @param $request
     * @param $response
     * @param $args
     * @return mixed
     * @throws \Exceptions\NotFoundException
     */
    public function authentinitConfirm($request, $response, $args)
    {
        $token = $args['init_Token'];

        $user
            = $this->db->fetchAssoc("SELECT user_id FROM confirm_tokens WHERE token = ? AND expiration > CURRENT_TIMESTAMP AND type_confirm = 'init'",
            [$token]);
        if (empty($user)) {
            throw new \Exceptions\NotFoundException();
        }

        $this->db->update('users', array('is_confirmed' => 1), array('id' => $user['user_id']));
        return $response;
    }

# end of operations block
}
