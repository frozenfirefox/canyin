/****
    写一个列表页的组件,注册vue全局组件
    有四个参数
    1.data 传入数据
    2.name 这是标题
    3.form [{'id':'id值'},{'name':'姓名'}]

*******/

Vue.component('modal-edit', {
    props: ['data', 'name', 'form', 'url'],
    template: '#modal-edit-template',
});