<?php

/**
 * middleware invokable class implementing token authentification
 *
 * @author patrick C.
 */
class TokenAuth
{

    private $container = null;

    /**
     * middleware invokable class
     *
     * @param  \Psr\Http\Message\ServerRequestInterface $request PSR7 request
     * @param  \Psr\Http\Message\ResponseInterface $response PSR7 response
     * @param  callable $next Next middleware
     *
     * @return \Psr\Http\Message\ResponseInterface
     */

    /**
     * Si on utilise la classe en resolvable (add('TokenAuth') le container est injecté
     *
     * Sinon on utilise une instance de la classe (add(new TokenAuth($container))
     */

    public function __construct($container)
    {
        $this->container = $container;
    }

    public function __invoke($request, $response, $next)
    {
        $tokenAuth = $request->getHeaderLine('Authorization');

        if (!$tokenAuth) {
            throw new \Exceptions\ProtectionException();
        }

        $sql
            = "SELECT id, user_id from auth_tokens
                WHERE expiration > CURRENT_TIMESTAMP
                    AND auth_token = ?";

        $auth_token = $this->container['db']->fetchAssoc($sql, [$tokenAuth]);

        if (!$auth_token) {
            throw new \Exceptions\ProtectionException();
        }

        // Save current user in the container. Any class could now retreive and use it
        $this->container['user_id'] = $auth_token['user_id'];

        // Update auth_token time
        $currentDateTime = new \DateTime("now", new \DateTimeZone('Europe/Paris'));
        $currentDateTime->add(new \DateInterval('PT1H'));

        $this->container['db']->update('auth_tokens', ['expiration' => $currentDateTime->format('Y-m-d H:i:s')],
            array('id' => $auth_token['id']));

        $response = $next($request, $response);
        return $response;
    }
}
