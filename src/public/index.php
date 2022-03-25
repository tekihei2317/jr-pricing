<?php

use Slim\Factory\AppFactory;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Tekihei2317\Core\Domain\Ticket;
use Tekihei2317\Core\Domain\Station;
use Tekihei2317\Core\Domain\Destination;
use Tekihei2317\Core\UseCases\CalculateFare;
use Tekihei2317\Core\Subdomain\Model\Date;

require __DIR__ . '/../../vendor/autoload.php';

$app = AppFactory::create();

$app->get('/', function (Request $request, Response $response) {
    $payload = json_encode(['hello' => 'world']);
    $response->getBody()->write($payload);

    return $response;
});

$app->get('/jr-pricing/apply', function (Request $request, Response $response) {
    $shinosaka = new Destination(
        station: Station::Shinosaka,
        distance: 553,
        baseFare: 8910,
        expressFare: 5490,
    );
    $ticket = new Ticket(
        isAdult: true,
        destination: $shinosaka,
        isOneWay: true,
        isHikari: true,
        isReservedSeat: true,
        departureDate: Date::createFromString('2022-04-01'),
    );

    $action = new CalculateFare();
    $price = $action->run($ticket);

    $response->getBody()->write(json_encode(['price' => $price]));

    return $response;
});

$app->run();
