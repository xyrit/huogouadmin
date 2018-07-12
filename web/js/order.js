var host = window.location.host;
$(function(){
    $('.rem a:first').addClass('high');
    var status = $(this).attr('data-id');

    $('#add-address').hide();
    $('.rem a').click(function(){
        $('.rem a').removeClass('high');
        $(this).addClass('high');
        $('#status').remove();
        $('#unusual').after('<input type="hidden" name="fail" id="status" value="'+status+'">');
        var id = $(this).attr('data-id');
        if(id == 6){
            $('#reset').css('display', 'inline');
        }else{
            $('#reset').css('display', 'none');
        }
        if(id == 2 || id == 3){
            $('#prepare').css('display', 'inline');
        }else{
            $('#prepare').css('display', 'none');
        }
    })
    $('#unusualBtn').hide();
})
/*
function addAddressShow(){
    var selRow = $('#listdata').datagrid('getSelected');
    if (!selRow) {
        $.messager.alert('错误','请选择一个');
        return false;
    }
    getAreaList(0, 'prov');
    $('#dlg-address').window('open');
    $.get('/win/ship-info', {'id':selRow.id}, function(data){
        $('#ship_addr').textbox('setValue',data.ship_addr);
        $('#ship_name').textbox('setValue',data.ship_name);
        $('#ship_phone').textbox('setValue',data.ship_mobile);
        $('#ship_time').combobox('setValue',data.ship_time);
        $('#ship_area').remove();
        if(data.ship_area != null && data.ship_area != '') $('#area').after('<p id="ship_area">原地址：'+data.ship_area+'</p>');
        $('#remark').val(data.mark_text);
    })
}

function saveAddress(){
    var selRow = $('#listdata').treegrid('getSelected');
    var prov = $('#prov').find("option:selected").text();
    var city = $('#city').find("option:selected").text();
    var area = $('#area').find("option:selected").text();
    var addr = $('#ship_addr').val();
    var name = $('#ship_name').val();
    var phone = $('#ship_phone').val();
    var time = $('#ship_time').combobox('getValue');
    var remark = $('#remark').val();
    $.post('/win/ship-info', {'id':selRow.id, 'area':prov + ' ' + city + ' ' + area,'addr':addr,'name':name,'phone':phone,'time':time,'mark':remark}, function(data) {
        if (data.code != 100) {
            $.messager.alert('错误', data.msg, 'error');
        } else {
            $.messager.alert('成功', data.msg);
            setTimeout(function(){location.reload()}, 2000);
        }
    }, 'json');
}

function getAreaList(pid, select) {
    var prov = arguments[2] ? arguments[2] : 'prov';
    var city = arguments[3] ? arguments[3] : 'city';
    var area = arguments[4] ? arguments[4] : 'area';

    $.ajax({
        async: false,
        url: '/win/area-list?pid=' + pid,
        type: "GET",
        data: '',
        success: function (json) {
            if (select == prov) {
                $("#" + city).html('<option value="">-请选择-</option>');
                $("#" + area).html('<option value="">-请选择-</option>');
            } else if (select == city) {
                $("#" + area).html('<option value="">-请选择-</option>');
            }

            var strHtml = '<option value="">-请选择-</option>';
            $("#" + select).html('');
            if (json == '') {
                $("#" + select).remove();
                return;
            }

            $.each(json, function (i, v) {
                strHtml += '<option value="' + v.id + '">' + v.name + '</option>'
            });

            if ($("#" + select).length == 0) {
                $("#" + city).parent().append('<select  name="' + area + '" id="' + area + '"></select>');

            }
            $("#" + select).append(strHtml);
        }
    });
}*/

//设置异常
function setUnusual()
{
    var selRow = $('#listdata').datagrid('getSelected');
    if (!selRow) {
        $.messager.alert('错误','请选择一个');
        return false;
    }
    $('#dlg-unusual').window('open');
}

//保存异常
function saveUnusual(){
    var selRow = $('#listdata').datagrid('getSelected');
    var unusualContent = $('#unusual').val();
    var url = '/win/refuse?id=' + selRow.id;

    $('#refuseOrder').form({
        url: url,
        onSubmit:function(){
            return $(this).form('enableValidation').form('validate');
        },
        success: function (data) {
            data = eval('(' + data + ')');
            if (data.error == 0) {
                $.messager.alert('成功', data.message);
                setTimeout(function(){reloadgrid()}, 2000);
            } else {
                $.messager.alert('失败', data.message, 'error');
            }
        }
    });
    $('#refuseOrder').submit();
}

function edit(){
    var selRow = $('#listdata').datagrid('getSelected');
    if (!selRow) {
        $.messager.alert('错误','请选择一个');
        return false;
    }
    $('#add_iframe').prop('src',  'view?id=' + selRow.id);
    $('#dlg-add').window('open');
    /*
    $('#content_tabs').tabs('close', '查看订单');
    window.parent.addTab('查看订单', 'order/view?id=' + selRow.id);*/
}

function dataexcel(){
    var deliver	= $('#deliver').combobox("getValue");
    var time = $('#time_type').combobox("getValue");
    var types = $('#types').combobox("getValue");
    var startTime = $('#startTime').datetimebox('getValue');
    var endTime = $('#endTime').datetimebox('getValue');
    var prepare_userid = $('#prepare_userid').val();
    var order = $('#order').val();
    var name = $('#name').val();
    var product_name = $('#product_name').val();
    var cat_id	= $('#catlist').combobox("getValue");
    var cat_id2	= $('#catlist2').combobox("getValue");
    var from = $('#from').combobox("getValue");
    var period_no = $('#period_no').val();
    var status = $('.high').attr('data-id');
    if(status == undefined) status = 'all';
    var sub = $('#sub').val();
    var url = "/order/index?excel=order&deliver="+deliver+'&startTime='+startTime+'&endTime='+endTime+'&order='+order+'&name='+name+'&status='+status+'&types='+types+'&time='+time+'&prepare_userid='+prepare_userid+'&sub='+sub+'&product_name='+product_name+'&cat_id='+cat_id+'&cat_id2='+cat_id2+'&period_no='+period_no;
    url += '&from='+from;
    window.location.href=url;
}

function load()
{
    $('#dlg-add').window('close');
}

function reloadgrid(){
    var queryParams = $('#listdata').datagrid('options').queryParams;
    queryParams.deliver	= $('#deliver').combobox("getValue");
    queryParams.time = $('#time_type').combobox("getValue");
    queryParams.startTime = $('#startTime').datetimebox('getValue');
    queryParams.endTime = $('#endTime').datetimebox('getValue');
    queryParams.order = $('#order').val();
    queryParams.prepare_userid = $('#prepare_userid').val();
    queryParams.name = $('#name').val();
    queryParams.product_name = $('#product_name').val();
    queryParams.period_no = $('#period_no').val();
    queryParams.types = $('#types').combobox("getValue");
    queryParams.from = $('#from').combobox("getValue");
    queryParams.cat_id	= $('#catlist').combobox("getValue");
    queryParams.cat_id2	= $('#catlist2').combobox("getValue");
    queryParams.order_type	= $('#order_type').combobox("getValue");
    queryParams.sub = $('#sub').val();

    queryParams.random_param = Math.random();
    $('#listdata').datagrid('options').queryParams = queryParams;
    $("#listdata").datagrid('reload');
}

$(".get-status").click(function(){
    var status = $(this).attr('data-id');
    //window.location.reload();
    var queryParams = $('#listdata').datagrid('options').queryParams;
    queryParams.status = status;
    $('#listdata').datagrid('options').queryParams = queryParams;
    $("#listdata").datagrid('reload');
    if(status != 0 && status != 1 && status != 2 && status != 3){
        $('#add-address').hide();
    }else{
        $('#add-address').show();
    }

    if(status == 'all' || status == '6' || status == '8' || status == undefined){
        $('#unusualBtn').hide();
    }else{
        $('#unusualBtn').show();
    }
})

function getstatus(data){
    var queryParams = $('#listdata').datagrid('options').queryParams;
    queryParams.status = data;
    $('#listdata').datagrid('options').queryParams = queryParams;
    $("#listdata").datagrid('reload');
    $(this).attr('data-id', data);
}

//格式化状态
function formatStatus(val, row) {
    if (val == '异常订单') {
        return '<span style="color:red">启用</span>';
    }
}

function formatTime(val, row){
    return new Date(parseInt(val) * 1000).toLocaleString().substr(0,17);
}
