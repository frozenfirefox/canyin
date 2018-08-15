/****
    写一个列表页的组件,注册vue全局组件
    有四个参数
    1.data 传入数据
    2.name 这是标题
    3.fname 要展示的th中的头
    4.field 这是要遍历的字段

    3和4数量必须对等，3对应汉字   4一般对应数据库字段名

*******/

Vue.component('modal-list', {
    props: ['data', 'name', 'fname', 'filed'],
    template: '#modal-list-template',
});