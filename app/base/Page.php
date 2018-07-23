<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/7/23
 * Time: 13:55
 */

namespace app\base;

class Page
{
    private $total;
    private $pageSize;
    private $limit;
    private $page;
    private $pageNum;
    private $url;

    //构造方法初始化
    public function __construct($total, $pageSize)
    {
        $this->total = $total;
        $this->pageSize = $pageSize;
        $this->pageNum = ceil($this->total / $this->pageSize);
        $this->page = $this->setPage();
        $this->limit = "LIMIT ".($this->page-1)*$this->pageSize.",$this->pageSize";
        $this->url = $this->setUrl();
    }

    public function __get($_key)
    {
        return $this->$_key;
    }

    //获取当前页码
    private function setPage()
    {
        if (!empty($_GET['page'])) {
            if ($_GET['page'] > 0) {
                if ($_GET['page'] > $this->pageNum) {
                    return $this->pageNum;
                } else {
                    return $_GET['page'];
                }
            } else {
                return 1;
            }
        } else {
            return 1;
        }
    }

    private function setUrl()
    {
        $url = $_SERVER["REQUEST_URI"];
        $par = parse_url($url);
        if (isset($par['query'])) {
            parse_str($par['query'], $query);
            unset($query['page']);
            $url = $par['path'].'?'.http_build_query($query);
        }
        return $url;
    }

    //数字目录
    private function pageList()
    {
        $pageList = '[ <a href="'.$this->url.'&page=1">1</a> ]';
        for ($i=2; $i<=$this->pageNum; $i++) {
            $pageList .= '[ <a href="'.$this->url.'&page='.$i.'">'.$i.'</a> ]';
        }
        return $pageList;
    }

    //首页
    private function first()
    {
        return ' <a href="'.$this->url.'">首页</a> ';
    }

    //上一页
    private function prev()
    {
        return ' <a href="'.$this->url.'&page='.($this->page-1).'">上一页</a> ';
    }

    //下一页
    private function next()
    {
        return ' <a href="'.$this->url.'&page='.($this->page+1).'">下一页</a> ';
    }

    //尾页
    private function last()
    {
        return ' <a href="'.$this->url.'&page='.$this->pageNum.'">尾页</a> ';
    }

    //分页信息
    public function showPage()
    {
        $page  = $this->pageList();
        $page .= $this->first();
        $page .= $this->prev();
        $page .= $this->next();
        $page .= $this->last();
        return $page;
    }
}
