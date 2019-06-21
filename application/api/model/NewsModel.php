<?php

namespace app\api\model;

use think\Model;

class NewsModel extends Model
{
    protected $name = 'news';
    protected $pk = 'id';
    protected $resultSetType = 'collection';

    public function edit($newsId, $data)
    {
        return $this->where('isDelete', '=', 0)->where('id', '=', $newsId)->update($data);
    }

    public function getByPage($pageIndex, $pageSize)
    {
        $config = [
            'list_rows' => $pageSize,
            'page' => $pageIndex
        ];
        return $this->alias('n')
            ->join('zb_news_category nc', 'n.categoryId = nc.id')
            ->where('n.isDelete', '=', 0)
            ->where('n.isShow','=',1)
            ->field('n.id,n.categoryId,nc.name as categoryName,n.title,n.keywords,n.description,n.content,n.imgUrl,n.createTime,n.createBy,n.updateTime,n.updateBy')
            ->paginate(null, false, $config);
    }

    public function getDetail($newsId)
    {
        return $this->alias('n')
            ->join('zb_news_category nc', 'n.categoryId = nc.id')
            ->where('n.isDelete', '=', 0)
            ->where('n.id', '=', $newsId)
            ->field('n.id,n.categoryId,nc.name as categoryName,n.title,n.keywords,n.description,n.content,n.imgUrl,n.createTime,n.createBy,n.updateTime,n.updateBy')
            ->find();
    }

    public function getNewsByCateIdPage($categoryId, $pageIndex, $pageSize)
    {
        $config = [
            'list_rows' => $pageSize,
            'page' => $pageIndex
        ];
        return $this->where('categoryId', '=', $categoryId)->where('isShow', '=', 1)
            ->where('isDelete', '=', 0)->paginate(null, false, $config);
    }
}