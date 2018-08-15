<?php

/************************************************************
            这是一个公共函数的库文件
            为了方便调等功能都可以在这里添加公共函数
            作用域 ： 全局
    @add By huiwenDuan
    @date 2018/04/08
************************************************************/
/**
 * [getCode description]
 * @param  array $str [description]
 * @return [string]       [description]
 */
function getCode($str = 123456){
    return md5($str);
}

/**
 * [toDate 编程时间]
 * @param  [integer]    $time    [description]
 * @param  [string]     $separator [日期分隔符]
 * @param  [string]     $separator_time [时间分隔符]
 * @param  [string]     $[name] [<description>]
 * @param  [boolean]    $is_need [是否需要时分秒]
 * @return [string]     [description]
 */
function toDate($time , $separator = '-',  $is_need = false, $separator_time = ':'){
    if(intval($time)){
        if($is_need){
            $timeString = date('Y'.$separator.'m'.$separator.'d H'.$separator_time.'i'.$separator_time.'s', $time);
        }else{
            $timeString = date('Y'.$separator.'m'.$separator.'d', $time);
        }
    }else{
        $timeString = '';
    }

    return $timeString;
}

/**
 * [createSnCode 生成订单号]
 * @return [type] [description]
 */
function createSnCode(){
    //第一部分数字
    $strPre = date('YmdHis', time());
    //第二部分是随机数6位
    $strNex = createSixCode();

    return $strPre.$strNex;
}

/**
 * [createSixCode 生成六位随机数 ，前后补0]
 * @return [type] [description]
 */
function createSixCode(){
    // 生成随机六位数，不足六位两边补零
    return str_pad(mt_rand(0, 999999), 6, "0", STR_PAD_BOTH);
}




/**
 * [createTicketCode 生成优惠劵编码号]
 * @return [type] [description]
 * eg:M3454321533333333
 */
function createTicketCode($type){
    //生成时间戳加大写字符一位加6位随机码  共17位
    //第一部分数字
    $strPre = date('YmdHis', time());
    //第二部分是随机数6位
    $strNex = createSixCode();
    return $type.$strPre.$strNex;

}

/**
 * deleteFile
 * @param string 带路径  到public 层
 * @return 0 1 [返回是否删除成功]
 */
function deleteFile($filename){
    $linkpath = public_path().$filename;
    if(is_file($linkpath)){
        if(unlink($linkpath)){
            $re_data = 1;
        }else{
            $re_data = 0;
        }
    }else{
        $re_data = 2;
    }

    return $re_data;
}


/**
 * 获取营业等状态
 */
function getsBusStatus(){
    $status = [
        0 => '正常营业',
        1 => '休息中',
        2 => '暂停营业',
        9 => '已删除',
    ];
    return $status;
}


/**
 * 获取现金结算方法
 */
function getsTipsType(){
    $type = [
        0 => '现结',
        1 => '月结',
    ];
    return $type;
}
/**
 * 获取有无笑脸打赏
 */
function getsSmileFlag(){
    $type = [
        0 => '有',
        1 => '无',
    ];
    return $type;
}

/**
 * 获取打赏对象类型
 */
function getTipsTarget(){
    $type = [
        0 => '订单',
        1 => '菜品',
        2 => '环境',
        3 => '服务员',
        4 => '厨师',
        5 => '物流人员',
    ];
    return $type;
}
/**
 * 获取支付方式
 */
function getPayType(){
    $type = [
        0 => '现金',
        1 => '余额',
        2 => '笑脸',
    ];
    return $type;
}
/**
 * 获取打赏状态
 */
function getTipsStatus(){
    $type = [
        0 => '未转结',
        1 => '已转结',
        2 => '取消',
        9 => '软删除',
    ];
    return $type;
}

/**
 * 获取地域
 */
function getArea($id){
    switch($id){
        case 1:
            $name = '华东';
        break;
        case 2:
            $name = '华东';
        break;
        case 3:
            $name = '华中';
        break;
        case 4:
            $name = '华北';
        break;
        case 5:
            $name = '西南';
        break;
        case 6:
            $name = '东北';
        break;
        case 7:
            $name = '西北';
        break;
        case 8:
            $name = '港澳台';
        break;
        default:
            $name = '同省';
        break;
    }

    return $name;
}

/*
 * ajax 正确返回格式
 * @param $data 返回数据
 * @param $msg 提示信息
 * @param $url 路径
 * @param string $status 状态
 * @return string
 */
function ajaxReturn($data='',$msg='',$url='',$status='success'){
    return response()->json(compact('data','msg','url','status'),JSON_UNESCAPED_UNICODE);
}

/**
 * ajax错误返回格式
 * @param $data
 * @param $msg
 * @param $url
 * @return string
 */
function ajaxErrorReturn($data='',$msg='',$url=''){
    return ajaxReturn($data,$msg,$url,'error');
}
