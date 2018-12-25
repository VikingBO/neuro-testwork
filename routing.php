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
require_once 'core/routing_controller.php';

if (!empty($_POST)) {
    $routing = new routing_controller();
//    $action = $_POST['action'];
//    $response = $routing->${$action}();

//    по какой-то причине не работает подстановка строки в качестве названия метода
//    решил не разбираться и пока сделать простым перебором

    switch ($_POST['action']) {
        case 'start':
            $response = $routing->start();

            break;
        case 'check':
            $routing->clear();
            $response = $routing->check($_POST['number']);

            break;
        case 'add':
            $response = $routing->add();

            break;
        case 'hand_add':
            $response = $routing->hand_add($_POST);

            break;
        default:
            break;
    }

    die($response);
} else {
    $result = 'empty query';
    log::set_log($result);
    die($result);
}