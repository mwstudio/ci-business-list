<?php
class Tools extends CI_Controller {

    public function message($to = 'World')
    {
        echo " Hello {$to}! ".PHP_EOL; 
        echo "test1".PHP_EOL;

        $this->load->database();
        echo "test2".PHP_EOL;

        $query = $this->db->query("SELECT * FROM test3");
        echo "test3".PHP_EOL;
        foreach ($query->result() as $row)
        {
            echo $row->pid.PHP_EOL;
            echo $row->mane.PHP_EOL;
            echo $row->title.PHP_EOL;
        }
    }
}
?>