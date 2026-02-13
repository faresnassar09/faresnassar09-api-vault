<?php


namespace FaresNassar\ApiVault\Tests;

use Orchestra\Testbench\TestCase as Orchestra;
use FaresNassar\ApiVault\ApiVaultServiceProvider; 

class TestCase extends Orchestra
{
    protected function getPackageProviders($app)
    {
        return [
            ApiVaultServiceProvider::class,
        ];
    }

    protected function getEnvironmentSetUp($app)
    {
        
 }
}