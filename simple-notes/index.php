<?php

require __DIR__.'/bootstrap/autoload.php';


$app = require_once __DIR__.'/bootstrap/app.php';


$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
);

//$response->send();



echo '<h1>hello simple-note users</h1>';

$kernel->terminate($request, $response);
