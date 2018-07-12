function addContent(req){
    if(req == 'packet'){
        var packetId = $('#packets').combobox('getValue');
        var packetName = $('#packets').combobox('getText');
        if (!packetId) {
            $.messager.alert('错误','请选择红包');
        }
    }else if(req == 'money' || req == 'point'){
        var name = $('#'+req+'_name').textbox('getValue');
        if(name % 1 !== 0){
            $.messager.alert('错误', '必须为数字', 'error');
            return;
        }
    }else{
        var name = $('#'+req+'_name').textbox('getValue');
        if(name == ''){
            $.messager.alert('错误', '名称不能为空', 'error');
            return;
        }
    }

    $('#'+req).siblings('.button').css('display', 'none');
    $('#content .goods-name').remove();
    if(req == 'packet'){
        $('#content').append('<p class="goods-name" data-type="'+req+'"><span>'+packetId+'</span>&nbsp;&nbsp;'+packetName+'<a href="javascript:void(0);" onclick="del(this)">删除</a></p>');
    }else{
        $('#content').append('<p class="goods-name" data-type="'+req+'"><span>'+name+'</span>&nbsp;&nbsp;<a href="javascript:void(0);" onclick="del(this)">删除</a></p>');
    }

    $('#dlg-'+req).window('close');
}

function clearForm(){
    $('#lottery-form').form('clear');
}

function addReward(req){
    if(req == 0){
        $('#dlg-goods').window('open');
    }else if(req == 1){
        $('#packet_content').html('');
        $('#packets').combobox({
            url:"../active/packet-list",
            method:'get',
            valueField: 'id',
            textField: 'name',
            onSelect: function(packet) {
                $.get("../active/packet-detail", {'id': packet.id}, function(data) {
                    $('#packet_content').html('');
                    var strHtml = '<table cellpadding="5"';
                    $.each(data, function(i, v) {
                        strHtml += '<tr><td>' + v.name + '</td>';
                        strHtml += '<td>' + v.desc + '</td></tr>';
                    });
                    strHtml += '</table>';
                    $.parser.parse($(strHtml).appendTo('#packet_content'));
                });
            }
        });
        $('#dlg-packet').window('open');
    }else if(req == 2){
        $('#dlg-thank').window('open');
    }else if(req == 3){
        $('#dlg-money').window('open');
    }else if(req == 4){
        $('#dlg-point').window('open');
    }
}

function submitRewardForm(){
    $('#reward-form').form({
        onSubmit: function(param){
            var isValid = $(this).form('validate');
            if (!isValid){
                $.messager.progress('close');	// 如果表单是无效的则隐藏进度条
            }
            var json = {};
            var jsonLen = 0;
            $(".goods-name").each(function(k){
                json[k] = $(this).children('span').html();
                jsonLen ++;
            });
            var jsonArr = JSON.stringify(json);
            if(jsonLen == 0) $.messager.alert('失败', '奖品不能为空');
            param.content = jsonArr;
            if($('#goods').css('display') == 'block') param.type = 2;
            else if($('#packet').css('display') == 'block') param.type = 1;
            else if($('#thank').css('display') == 'block') param.type = 3;
            else if($('#money').css('display') == 'block') param.type = 4;
            else if($('#point').css('display') == 'block') param.type = 5;
            return isValid;	// 返回false终止表单提交
        },
        success: function (data) {
            data = eval('(' + data + ')');
            if (data.error == 0) {
                $.messager.alert('成功', data.message);
                $('#rewards').append('<p class="reward-name" data="'+data.id+'"><span>'+data.name+'</span>&nbsp;&nbsp;<a href="javascript:void(0);" onclick="delReward(this)">删除</a></p>');
                setTimeout(function(){$('#dlg-add').window('close');}, 2000);
            } else {
                $.messager.alert('失败', data.message);
                return false;
            }
        }
    });
    $('#reward-form').submit();
}

function submitLotteryForm(){
    $('#lottery-form').form({
        onSubmit: function(param){
            var isValid = $(this).form('validate');
            if (!isValid){
                $.messager.progress('close');	// 如果表单是无效的则隐藏进度条
            }
            var json = {};
            var jsonLen = 0;
            $(".reward-name").each(function(k){
                json[k] = $(this).attr('data');
                jsonLen ++;
            });
            var jsonArr = JSON.stringify(json);
            if(jsonLen == 0) $.messager.alert('失败', '奖品不能为空');
            param.content = jsonArr;
            return isValid;	// 返回false终止表单提交
        },
        success: function (data) {
            data = eval('(' + data + ')');
            if (data.error == 0) {
                $.messager.alert('成功', data.message);
                setTimeout(function(){parent.location.reload();}, 2000);
            } else {
                $.messager.alert('失败', data.message);
                return false;
            }
        }
    });
    $('#lottery-form').submit();
}


/*
function addGoods(){
    var name = $('#name').textbox('getValue');
    if(name == ''){
        $.messager.alert('错误', '实物名称不能为空', 'error');
        return;
    }
    $('#content').append('<p class="goods-name"><span>'+name+'</span>&nbsp;&nbsp;<a href="javascript:void(0);" onclick="del(this)">删除</a></p>');
    $('#name').textbox('setValue', '');
    $('#dlg-goods').window('close');
    $('#packet').css('display','none');
    $('#thank').css('display','none');
}*/
/*

function addThank(){
    var name = $('#thank_name').textbox('getValue');
    if(name == ''){
        $.messager.alert('错误', '名称不能为空', 'error');
        return;
    }
    $('#content').append('<p class="goods-name"><span>'+name+'</span>&nbsp;&nbsp;<a href="javascript:void(0);" onclick="del(this)">删除</a></p>');
    $('#name').textbox('setValue', '');
    $('#dlg-thank').window('close');
    $('#packet').css('display','none');
    $('#actual').css('display','none');
}
*/

function del(nowP){
    $(nowP).parent().remove();
}

//添加奖品
function add(req){
    if(req == 0){
        $('#dlg-goods').window('open');
    }else if(req == 1){
        alert(333);
    }
}

function clearRewardForm(){
    $('#reward-form').form('clear');
}