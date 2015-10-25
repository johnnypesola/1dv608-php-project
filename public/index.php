<?php
/**
 * Created by jopes
 * Date: 2015-10-13
 * Time: 13:20
 */

print_r($_GET);

echo '<br>';

require_once '../app/init.php';

$app = new \controller\AppCtrl();