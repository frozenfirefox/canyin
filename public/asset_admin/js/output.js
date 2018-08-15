$(document).ready(function(){
    var vue = new Vue({
        el : '#change',
        delimiters: ['${', '}'],
        data: {
            item : '200000',
            name : '沃天科技',
            address : '天津市南开区白堤路科技中心108号',
            phone : '4002452323',
            data: [],
        },
        ready: function(){
            console.log('快执行啊  ! ');
        },
    });
});