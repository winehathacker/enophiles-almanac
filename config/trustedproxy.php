<?php

use Illuminate\Http\Request;

$envTrustedHeader = env('APP_TRUSTED_HEADER') ?: 'HEADER_X_FORWARDED_ALL';

return [
    // Dynamically determine the trust proxy constant. This should be one of the constant names defined in Request.
    // For Heroku this should be HEADER_X_FORWARDED_AWS_ELB, for example
    'headers' =>  constant(Request::class . '::' . $envTrustedHeader),
    'proxies' => env('APP_TRUSTED_PROXY', null),
];
