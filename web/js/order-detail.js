$('#view-tabs').tabs({
    onSelect : function(title, index){
        if(index == 0){
            $('#address-info').prop('src',  '/win/address?id=' + id);
            $('#address-info').show();
        }
    }
})

function saveAddress(){
    var form = 'address-form';
    var url = '/win/address?id='+id;
    $('#' + form).form({
        url: url,
        onSubmit:function(){
            return $(this).form('enableValidation').form('validate');
        },
        success: function (data) {
            data = eval('(' + data + ')');
            if (data.error == 0) {
                $.messager.alert('成功', data.message);
                setTimeout(function(){location.reload();parent.location.reload()}, 2000);
            } else {
                $.messager.alert('失败', data.message, 'error');
            }
        }
    });
    $('#' + form).submit();
}

$.extend($.fn.validatebox.defaults.rules, {
    phoneRex: {
        validator: function(value){
            var rex=/^1[3-8]+\d{9}$/;
            var rex2=/^((0\d{2,3})-)(\d{7,8})(-(\d{3,}))?$/;
            if(rex.test(value)||rex2.test(value))
            {
                return true;
            }else
            {
                return false;
            }

        },
        message: '请输入正确电话或手机格式'
    }
});

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
}
