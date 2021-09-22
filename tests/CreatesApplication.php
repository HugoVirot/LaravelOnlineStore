<?php

namespace Tests;

use Illuminate\Contracts\Console\Kernel;

trait CreatesApplication  // crée une instance de l'application pour réaliser les tests
{
    /**
     * Creates the application.
     *
     * @return \Illuminate\Foundation\Application
     */
    public function createApplication()
    {
        $app = require __DIR__.'/../bootstrap/app.php';

        $app->make(Kernel::class)->bootstrap();

        return $app;
    }
}
