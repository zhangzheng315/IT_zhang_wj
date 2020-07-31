//用户的禁用启用
$('.handle').click(function () {
    let url = $(this).attr('data-url')
    let s_id = $(this).attr('f-id')
    let f_id = $(this).attr('f-id') == 1 ? 0 : 0
    let text = f_id === 1 ? '未处理' : '已处理' ;
    if (Number(s_id) === 0) {
        return;
    }
    layui.use('layer', function(){
        layer.confirm('确定进行此操作？', {
            btn: ['确定','取消'],
            time: 200000, //20s后自动关闭
        },function(index){
            $.ajax({
                type:'post',
                url:url,
                success:function(rel){
                    if(rel.status){
                        layer.msg(rel.msg, {
                            time: 2000,
                        });
                        location.reload()
                    }else{
                        layer.msg(rel.msg, {
                            time: 2000,
                        });
                    }

                }
            })
            layer.close(index);
        });
    });
});

//用户删除
$
$('.delete').click(function(){
    let url = $(this).attr('data-url')
    layui.use('layer', function(){
        layer.confirm('确定删除？', {
            btn: ['确定','取消'],
            time: 200000, //20s后自动关闭
        },function(index){
            $.ajax({
                type:'post',
                url:url,
                success:function(rel){
                    if(rel.status){
                        layer.msg(rel.msg, {
                            time: 2000,
                        });
                        location.reload()
                    }else{
                        layer.msg(rel.msg, {
                            time: 2000,
                        });
                    }
                }
            })
            layer.close(index);
        });
    })
})