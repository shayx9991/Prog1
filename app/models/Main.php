<?php

namespace app\models;
use app\core\Model;

class Main extends Model{

    public function getNews(){
        $result = $this->db->row('SELECT F_I_SH from ishchi');
        return $result;
    }

}
