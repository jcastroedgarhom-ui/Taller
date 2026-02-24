<?php

use App\Models\User;
use App\Models\Cliente;

require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$user = User::find(5);
$client = Cliente::find(18);

if ($user && $client) {
    echo "Linking User ID {$user->id} ({$user->name}) to Client ID {$client->id}...\n";
    $client->user_id = $user->id;
    $client->save();
    echo "Successfully linked!\n";

    // Verification
    $user->refresh();
    if ($user->cliente && $user->cliente->id === $client->id) {
        echo "Verification PASSED: User->cliente returns Client ID {$client->id}\n";
    }
    else {
        echo "Verification FAILED\n";
    }
}
else {
    echo "Error: User or Client not found.\n";
}
