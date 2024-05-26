<?php

namespace Tests;

use App\Models\User;
use Illuminate\Contracts\Console\Kernel;
use Illuminate\Foundation\Application;
use Laravel\Sanctum\Sanctum;

trait CreatesApplication
{
    /**
     * Creates the application.
     */
    public function createApplication(): Application
    {
        $app = require __DIR__.'/../bootstrap/app.php';

        $app->make(Kernel::class)->bootstrap();

        return $app;
    }

    public function createUser($args = [])
    {
        return User::factory()->create($args);    
    }

    public function actAsUser()
    {
        Sanctum::actingAs($user = $this->createUser());
        return $user;
    }
}
