<?php

require_once 'vendor/autoload.php';

$job = new \Cron\Job\ShellJob();
$job->setCommand('php <<<path_to_cron_action>>>');
$job->setSchedule(new \Cron\Schedule\CrontabSchedule('0 9 * * *'));

$resolver = new \Cron\Resolver\ArrayResolver();
$resolver->addJob($job);

$cron = new \Cron\Cron();
$cron->setExecutor(new \Cron\Executor\Executor());
$cron->setResolver($resolver);

$cron->run();