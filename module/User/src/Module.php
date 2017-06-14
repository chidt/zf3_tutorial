<?php
/**
 * Created by PhpStorm.
 * User: Chi-DT
 * Date: 12/06/2017
 * Time: 11:22
 */

namespace User;


class Module
{
    public function getConfig()
    {
        return include __DIR__.'/../config/module.config.php';
    }
}