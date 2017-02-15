<?php
namespace App\Custom\Facades;

use Illuminate\Support\Facades\Facade;

class Tm extends Facade
{
    protected static function getFacadeAccessor() {
        return 'Tm';
    }
}