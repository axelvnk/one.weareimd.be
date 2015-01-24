<?php

class DeployController extends BaseController
{

    public function index()
    {
        SSH::into('production')->run(array(
            'cd /home/one.weareimd.be/one.weareimd.be',
            'git stash',
            'git pull github master',
            'php composer.phar dump-autoload',
            'php artisan migrate --force'
        ), function ($line) {
            echo $line . PHP_EOL;
        });
    }

}
