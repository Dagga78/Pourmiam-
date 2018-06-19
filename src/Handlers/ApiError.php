<?php

namespace Handlers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Log\LoggerInterface;

final class ApiError extends \Slim\Handlers\Error
{

    protected $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function __invoke(Request $request, Response $response, \Exception $exception)
    {
        $this->logStrategy($request, $exception);

        $status = $exception->getCode() ?: 500;

        $errObj['code'] = $exception->getCode();
        $errObj['error'] = $exception->getMessage();
        $errObj['method'] = $request->getMethod();

        if ($exception instanceof \Exceptions\MissingParameterException) {
            $errObj['error'] = $exception->getErrors();
        }

        if ($exception instanceof \Exceptions\HttpException) {
            return $response->withStatus($status, $exception->getMessage())
                            ->withHeader("Content-type", "application/json")
                            ->withHeader('Access-Control-Allow-Origin', '*')->withHeader('Access-Control-Allow-Headers',
                    'X-Requested-With, Content-Type, Accept, Origin, Authorization, cache-control, if-modified-since, Pragma')
                            ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
                            ->withJSON($errObj);
        }

        return $response->withStatus(500)->withHeader("Content-type", "application/json")->withJSON($errObj);
    }

    private function logStrategy($request, $exception)
    {

        switch ((int)substr($exception->getCode(), 0, 2)) {
            case 4:
                $this->logger->notice($exception->getMessage());
            break;

            case 5:
                $this->logger->critical($exception->getMessage());
            break;

            case 2:
            default:
                $this->logger->info($exception->getMessage());
            break;
        }
    }
}
