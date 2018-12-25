<?php
/**
 * Created by PhpStorm.
 * User: Pilipenko Andrey
 * Nickname: VikingBO
 * Github: https://github.com/VikingBO
 * Gitlab: https://gitlab.com/VikingBO
 * BitBucket: https://bitbucket.org/VikingBO/
 * Email: pilipenkoav@rambler.ru
 * Email: reaver-dron@yandex.ru
 * Email: pilipenkoavspb@gmail.com
 * Date: 24.12.2018
 */

require_once 'core/log.php';
require_once 'core/db.php';
require_once 'core/routing-controller.php';

if (!empty($_POST)) {

    $result = 'post query';
    log::set_log($result);
    die($result);
} else {
    $result = 'empty query';
    log::set_log($result);
    die($result);
}