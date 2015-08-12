<?php
class module extends MY_Controller {
    function __construct(){
        parent::__construct();

        $this->input->is_cli_request() or exit("Execute via command line: php index.php migrate");
        include APPPATH . 'config/database.php';
        $this->load->helper('file');
    }

    public function cli_test(){
        $this->cli->write('Hello World!');
        $this->cli->prompt();
        $color = $this->cli->prompt('What is your favorite color?');
        $color = $this->cli->prompt('What is your favorite color?', 'white');
        $ready = $this->cli->prompt('Are you ready?', array('y','n'));
        $this->cli->write('Loading...');
        $this->cli->wait(5, true);
    }

    public function test()
    {
        echo "Choose TABLE :".PHP_EOL;
        echo PHP_EOL;
        $arrayName = array('a' => "adas",'b' => 'sdfasfsf' );
        $this->load->dbutil();
        echo '<pre>';
        var_dump($this->dbutil->list_databases());
        var_dump($this->db->list_fields('tbl_user'));
        var_dump($this->db->query('SHOW TABLES')->result());
    }

    public function get_all_table(){
        return $this->db->query('SHOW TABLES')->result();
    }

    public function mkdir($path = "uploads"){
        if(is_array($path)){
            foreach ($path as $item) {
                if(!is_dir($item))
                {
                  mkdir($item,0755,TRUE);
                  echo PHP_EOL;
                  echo 'CREATED FOLDER : '.$item;
                }
                else
                {
                    echo PHP_EOL;
                    echo 'EXIST FOLDER : '.$item;
                }
            }
        }
        else{
            if(!is_dir($path))
            {
              mkdir($path,0755,TRUE);
              echo PHP_EOL;
              echo 'CREATED FOLDER : '.$item;
            }
            else
            {
                echo PHP_EOL;
                echo 'EXIST FOLDER : '.$path;
            }
        }
        
    }

    public function read_file($file_name = 'index.php', $path = null){
        $file = "";
        if ($path) {
            $file .= $path . DIRECTORY_SEPARATOR ;
        }
        $file .= $file_name;
        $string = read_file($file);
        return $string;
    }

    public function write_file($file_name = 'test.html',$data = null ){
        if (is_array($file_name)) {
            foreach ($file_name as $file):
                if(!file_exists($file)):
                    if ( ! write_file($file, $data)):
                        echo PHP_EOL;
                        echo 'ERROR FILE : '.$file;
                    else:
                        echo PHP_EOL;
                        echo 'CREATED FILE : '.$file;
                    endif;
                else:
                    echo PHP_EOL;
                    echo 'EXIST FILE : '.$file;
                endif;
            endforeach;
        }
        else{
            //if(!file_exists($file_name)):
                if ( ! write_file($file_name, $data)):
                    echo PHP_EOL;
                    echo 'ERROR FILE : '.$file_name;
                else:
                    echo PHP_EOL;
                    echo 'UPDATED FILE : '.$file_name;
                endif;
            //else:
                //echo PHP_EOL;
                //echo 'EXIST FILE : '.$file_name;
            //endif;
        }
    }

    public function controller_content($controller_name){
        $controller = $this->read_file('controller.php', $path = APPPATH . 'cli_content');
        return str_replace('{controller_name}', $controller_name, $controller);
    }
    
    public function model_content($model_name){
        $model = $this->read_file('model.php', $path = APPPATH . 'cli_content');
        return str_replace('{model_name}', $model_name, $model);
    }


    public function create(){
        echo PHP_EOL;
        echo "TABLE LIST :".PHP_EOL;
        echo '--------------------------------';
        echo PHP_EOL;
        
        $tbl_no = array();
        foreach($this->get_all_table() as $key=>$table){
            echo $key+1 . '. ';
            echo $table->Tables_in_b_list;
            echo PHP_EOL;
            $tbl_no[] = $key+1;
        }
        
        echo '--------------------------------';
        echo PHP_EOL;
        
        echo PHP_EOL;
        echo "ENTER TABLE No. :";
        echo PHP_EOL;
        echo '--------------------------------';
        echo PHP_EOL;

        $tbl = $this->cli->prompt("", $tbl_no);
        $tbl_name = $this->get_all_table()[$tbl - 1]->Tables_in_b_list;
        echo PHP_EOL;
        echo '"' .$tbl_name .'" SELECTED';

        echo PHP_EOL;
        echo '--------------------------------';
        echo PHP_EOL;

        echo PHP_EOL;
        echo 'ENTER TABLE PREFIX : [Default: "tbl_"]';
        echo PHP_EOL;
        echo '--------------------------------';
        echo PHP_EOL;
        $tbl_prefix = $color = $this->cli->prompt('', 'tbl_');
        
        echo '"'.$tbl_prefix . '" SELECTED';
        echo PHP_EOL;
        echo '--------------------------------';
        echo PHP_EOL;

        $tbl_prefix_free = str_replace($tbl_prefix,"",$tbl_name);
        $path = APPPATH .'modules'. DIRECTORY_SEPARATOR . ucfirst( $tbl_prefix_free );
        $module = ucfirst( $tbl_prefix_free );
        $controller = ucfirst( $tbl_prefix_free . '.php' );
        $model = ucfirst( $tbl_prefix_free . '_model.php' );
        
        echo PHP_EOL;
        echo "Path     : ". $path .PHP_EOL;
        echo "Module   : ". $module .PHP_EOL;
        echo "Controle : ". $controller .PHP_EOL;
        echo "Model    : ". $model .PHP_EOL;
        
        echo PHP_EOL;
        echo '--------------------------------';
        echo PHP_EOL;

        echo PHP_EOL;
        $ready = $this->cli->prompt('ENTER "y" if everything is ok : ', array('y','n'));

        echo PHP_EOL;
        echo '--------------------------------';
        echo PHP_EOL;

        if($ready != 'y'){
            echo PHP_EOL;
            $this->cli->write('Loading...');
            echo 'Thank you';

            echo PHP_EOL;
            echo '--------------------------------';
            echo PHP_EOL;
        }
        else{
            echo PHP_EOL;
            $this->cli->write('Loading...');

            $folders = array(
                $path,
                $path . DIRECTORY_SEPARATOR . 'Config',
                $path . DIRECTORY_SEPARATOR . 'Controllers',
                $path . DIRECTORY_SEPARATOR . 'Models',
                $path . DIRECTORY_SEPARATOR . 'Views',
            );
            $this->mkdir($folders);
            echo PHP_EOL;
            
            $files = array(
                $path . DIRECTORY_SEPARATOR . 'Controllers' . DIRECTORY_SEPARATOR . $controller,
                $path . DIRECTORY_SEPARATOR . 'Models' . DIRECTORY_SEPARATOR . $model,
            );
            $this->write_file($files);
            echo PHP_EOL;
            $this->write_file($files[0], $this->controller_content( lcfirst($module)) );
            $this->write_file($files[1], $this->model_content( lcfirst($module)) );

            echo PHP_EOL;
            echo '--------------------------------';
            echo PHP_EOL;

            echo PHP_EOL;
            echo 'Module successfully generated !!';
            echo PHP_EOL;
            echo '--------------------------------';
            echo PHP_EOL;
        }




    }
}
?>