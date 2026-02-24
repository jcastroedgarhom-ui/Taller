<?php

use App\Models\User;
use App\Models\Cliente;

require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$user = User::where('name', 'Juan Perez')->first();
if ($user) {
    echo "User Found: ID " . $user->id . "\n";
    echo "Email: " . $user->email . "\n";
    $cliente = $user->cliente;
    if ($cliente) {
        echo "Client Found: ID " . $cliente->id . "\n";
    }
    else {
        echo "Client Not Found for User ID " . $user->id . "\n";
        // Check if there is a client with this email but not linked
        $potentialClient = Cliente::where('email', $user->email)->first();
        if ($potentialClient) {
            echo "Potential Client found by email: ID " . $potentialClient->id . " (User ID: " . ($potentialClient->user_id ?? 'NULL') . ")\n";
        }
    }
}
else {
    echo "User 'Juan Perez' Not Found\n";
}
