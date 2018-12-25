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
 * Date: 25.12.2018
 */

class routing_controller
{
    private $db;

    public function __construct()
    {
        $this->db = new db();
    }

    /**
     * Возвращаем все доступные маршруты из базы
     *
     * @return false|string
     */
    public function start()
    {
        $query = 'SELECT * FROM routing AS r ORDER BY r.`add_time` ASC';

        $result = $this->db->select($query);

        return json_encode($result);
    }

    /**
     *  Очищаем базу от старых (больше 2 минут) и добавленных не в ручную маршрутов
     */
    public function clear()
    {
        $this->db->delete("DELETE FROM `routing` WHERE `hand_made` = 0 AND `add_time` < '" . date('d.m.Y H:i',time() + (60*2)) . "'");
    }

    /**
     * Проверяем есть ли добавленные записи и если есть выводим их из БД
     *
     * @param $data
     * @return false|string
     */
    public function check($data)
    {
        $this->clear();

        $query = 'SELECT * FROM `routing`
                  WHERE `id` > ' . $data['number'] . '
                  ORDER BY `add_time` DESC';

        $result = $this->db->select($query);

        return json_encode($result);
    }

    /**
     * Добавляем рандомный маршрут автоматом каждые 7 секунд
     *
     * @return false|string
     */
    public function add()
    {
        $params = [
            'name' => 'какое то название',
            'number' => rand(1,5000),
            'route' => 'какой то маршрут'
        ];

        $query = "INSERT INTO `neuro_testwork`.`routing` (`name`, `number`, `route`, `hand_made`) 
                  VALUES ('{$params['name']}', {$params['number']},  '{$params['route']}', '0')";

        $result = $this->db->insert($query);

        return json_encode($result);
    }

    /**
     * Ручное добавление маршрута
     *
     * @param $params
     * @return false|string
     */
    public function hand_add($params)
    {
        $result = [];

        $query = "INSERT INTO `neuro_testwork`.`routing` (`name`, `number`, `route`, `hand_made`) 
                  VALUES ('{$params['name']}', {$params['number']},  '{$params['route']}', '1')";

        if ($this->db->insert($query)) {
            $result['answer'] = 'success';
        } else {
            $result['answer'] = 'error';
        }

        return json_encode($result);
    }
}