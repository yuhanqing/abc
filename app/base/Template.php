<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/7/19
 * Time: 10:01
 */

namespace app\base;

class Template
{
    protected static $apppath = null;
    private $vars = array();
    private $file;
    private $css;

    //创建一个构造方法，来验证各个目录是否存在
    public function __construct()
    {
        if (!is_dir(TPL_DIR)) {
            exit('ERROR：模板目录不存在！请手工设置！');
        }

        $this->init();
    }

    public function run($assign, $file)
    {
        $this->vars = $assign;
        $this->file = $file;
        $this->css  = substr($this->file, 0, -4);

        $this->display();
    }

    //display()方法
    public function display()
    {
        //设置模板的路径
        $tplFile = TPL_DIR . $this->file;
        $header  = TPL_DIR . 'header.php';
        $footer  = TPL_DIR . 'footer.php';
        //判断模板是否存在
        if (!file_exists($tplFile) && !file_exists($header) && !file_exists($footer)) {
            exit('ERROR：模板文件不存在！');
        }

        include $header;
        require $tplFile;
        include $footer;
    }

    private function init()
    {
        self::$apppath = substr(realpath(dirname("./")), 0, -5);
        include 'Autoload.php';
        $Autoload = new Autoload();
        $Autoload->addNamespace("app", self::$apppath."/app/");
        $Autoload->register();
    }
}
