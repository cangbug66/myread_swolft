<?php
namespace App\Rpc\Annotations\Handlers;

interface IHandler{
    function handle($joinPoint,$ret);
    function isBefore();
}