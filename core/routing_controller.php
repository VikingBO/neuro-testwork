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

    public function start()
    {
        $query = 'SELECT * FROM routing AS r ORDER BY r.`add_time` ASC';

        $result = $this->db->select($query);

        return json_encode($result);
    }

    public function clear()
    {
        $this->db->delete('DELETE FROM `routing` WHERE `add_time` < ' . (time() + (60*2)));
    }

    public function check($last_number)
    {
        $query = 'SELECT * FROM `routing`
                  WHERE `id` > ' . $last_number . '
                  ORDER BY `add_time` DESC';

        $result = $this->db->select($query);

        return json_encode($result);
    }

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