<?php

require_once 'vendor/autoload.php';

(new Dotenv\Dotenv(__DIR__))->load();
(new \Dykyi\Application((bool)getenv('app.debug')))->sendNotification();