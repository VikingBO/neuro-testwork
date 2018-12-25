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

class log
{
    private static $file = '../logs.txt';

    public static function set_log($text = '')
    {
        $result = false;

        if (empty($text)) {
            $text = "Здесь почему то нет данных но кто-то пытался записать лог\n";
        }

        if (file_put_contents(self::$file, $text, FILE_APPEND | LOCK_EX)) {
            $result = true;
        }

        return $result;
    }
}