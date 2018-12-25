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

class db
{
    private $db;
    private $dsn = 'mysql:host=localhost;dbname=neuro_testwork';
    private $login = 'root';
    private $pass = '';

    public function __construct()
    {
        try {
            $this->db = new PDO($this->dsn, $this->login, $this->pass);
            $result = 'Подключение к базе';
        } catch (Exception $e) {
            $result = 'Произошла ошибка подключения к базе данных' . $e->getMessage();
        }

        log::set_log($result);
    }

    public function select($queryString = '')
    {
        $result = $queryString;

        if (!empty($queryString)) {
            try {
                $result = $this->db->query($queryString)->fetchAll();
            } catch (Exception $e) {
                $result = [
                    'error' => $e->getMessage()
                ];
            }
        }

        log::set_log($result);
        return $result;
    }

    public function insert($queryString)
    {
        $result = $queryString;

        if (!empty($queryString)) {
            try {
                $result = $this->db->exec($queryString);
            } catch (Exception $e) {
                $result = [
                    'error' => $e->getMessage()
                ];
            }
        }

        log::set_log($result);
        return $result;
    }

    public function delete($queryString)
    {
        $result = $queryString;

        if (!empty($queryString)) {
            try {
                $result = $this->db->exec($queryString);
            } catch (Exception $e) {
                $result = [
                    'error' => $e->getMessage()
                ];
            }
        }

        log::set_log($result);
        return $result;
    }
}