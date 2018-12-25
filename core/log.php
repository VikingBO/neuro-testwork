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
    private static $file = __DIR__ . '/../logs.txt';

    public static function set_log($text = '')
    {
        if (empty($text)) {
            $text = "Здесь почему то нет данных но кто-то пытался записать лог";
        } else if (is_object($text)) {
            $text = (array) $text;
            $text = implode($text);
        } else if (is_array($text)) {
            $text = implode($text);
        }

        file_put_contents(self::$file, date('d.m.Y H:i', time()) . ' : ' . $text . PHP_EOL, FILE_APPEND | LOCK_EX);
    }
}