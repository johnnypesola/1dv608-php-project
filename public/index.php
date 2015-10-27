<?php
/**
 * Created by jopes
 * Date: 2015-10-13
 * Time: 13:20
 */


$start_time = microtime(true);

require_once '../app/init.php';

$app = new \controller\AppCtrl();


$end_time = microtime(true);
$creationtime = ($end_time - $start_time);

printf("Page created in %.6f seconds.", $creationtime);