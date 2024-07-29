<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Yego\Booking\Rides\Application\Create\RideCreator;
use Yego\Booking\Shared\Application\Create\CreateVehicleRequest;

final class RidePostController extends Controller
{

    public function __construct(private RideCreator $creator)
    {
    }


    public function __invoke(Request $request): Response
    {
        $this->creator->__invoke(
            new CreateVehicleRequest(
                (string)$request->get('id'),
                $request->get('name'),
                $request->get('lat'),
                $request->get('lng'),
                $request->get('battery'),
                $request->get('type')
            )
        );

        return new Response('', Response::HTTP_CREATED);
    }
}
