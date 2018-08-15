<?php

namespace App\Traits\Admin;

trait ActionButtonTrait
{
    /**
     * @param $actionModel string 模型
     * @return string
     */
    public function editButton($actionModel,$id = null)
    {

        if (!empty($id)){
            $this->id = $id;
        }

        if (auth('admin')->user()->can("{$actionModel}.edit")){
            return "<a href='".url('admin').'/'.$actionModel.'/'.$this->id."/edit'><button type='button' class='btn btn-success btn-xs'><i class='fa fa-pencil'> 编辑</i></button></a> ";
        }
        return '';
    }

    public function deleteButton($actionModel,$id = null)
    {
        if (!empty($id)){
            $this->id = $id;
        }
        if (auth('admin')->user()->can("{$actionModel}.delete")){
            //增加是否为回收站删除功能
            $this->dash = ($this->dash)?:0;
            $context = ($this->dash)?'永久删除':'删除';
            $button  = "";
            $button .= "<a href='javascript:;' data-id='".$this->id."' class='btn btn-danger btn-xs destroy'>";
            $button .= "<i class='fa fa-trash'> ".$context."</i>";
            $button .= "<form action='".url('admin/'.$actionModel.'/'.$this->id)."' method='POST'  name='delete_item_".$this->id."'  style='display:none'>";
            $button .= "<input type='hidden' name='is_dash' value='".$this->dash."'>";
            $button .= method_field('DELETE').csrf_field();
            $button .= '</form></a> ';
            return $button;
        }
        return '';
    }

    public function viewButton($actionModel, $id = null){
        if (!empty($id)){
            $this->id = $id;
        }
        if (auth('admin')->user()->can("{$actionModel}.info")){
            $button = "";
            $button .= "<a target='_blank' href='".url('admin/'.$actionModel.'/info/id/'.$this->id)."' class='btn btn-success btn-xs'>";
            $button .= "<i class='fa fa-eye'> 查看</i>";
            $button .= "</a>";
            return $button;
        }
        return '';
    }

    public function getActionButtons($actionModel,$id = null, $isInfo = false)
    {
        if($isInfo){
            return $this->editButton($actionModel,$id).$this->deleteButton($actionModel,$id).$this->viewButton($actionModel,$id);
        }else{
            return $this->editButton($actionModel,$id).$this->deleteButton($actionModel,$id);
        }

    }
}