<?php
/**
 * Created by PhpStorm.
 * User: Chi-DT
 * Date: 01/06/2017
 * Time: 13:48
 */

namespace Blog;


class Module
{
    public function getConfig()
    {
        return include __DIR__.'/../config/module.config.php';
    }
}