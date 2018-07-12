<?php

/* buybacklist.html */
class __TwigTemplate_e8619867f70b2e590eb86eb090f5dcdab4d959bba841d9bdcc82ee63544c9d28 extends yii\twig\Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("@app/views/base.html", "buybacklist.html", 1);
        $this->blocks = array(
            'main' => array($this, 'block_main'),
            'js' => array($this, 'block_js'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "@app/views/base.html";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_main($context, array $blocks = array())
    {
        // line 4
        echo "<div class=\"search\">
    <span>付款时间
        <input class=\"easyui-datetimebox\" style=\"width:200px\" name=\"startTime\" id=\"startTime\"> 到
        <input class=\"easyui-datetimebox\" style=\"width:200px\" name=\"endTime\" id=\"endTime\">
    </span>
    <span>用户手机号<input class=\"easyui-textbox\" type=\"text\" name=\"account\" id=\"account\"></span><br>
    <span>备货人<input class=\"easyui-textbox\" type=\"text\" name=\"beihuo\" id=\"beihuo\"></span>
    <span>期号<input class=\"easyui-textbox\" type=\"text\" name=\"period_no\" id=\"period_no\"></span>
    <span>订单号<input class=\"easyui-textbox\" type=\"text\" name=\"order_id\" id=\"order_id\"></span>
    <a href=\"javascript:void(0);\" onclick=\"reloadgrid();\" class=\"easyui-linkbutton\" iconCls=\"icon-search\">搜索</a>
    <a href=\"javascript:void(0);\" class=\"easyui-linkbutton\" onclick=\"dataexcel();\">导出</a>
</div>
<div id=\"tb-user\" style=\"height: auto;\">
    <div>
        <a href=\"javascript:void(0)\" class=\"easyui-linkbutton\"
           data-options=\"iconCls:'icon-edit',plain:true\" onclick=\"edit()\">查看</a>
    </div>
</div>
<table id=\"listdata\" class=\"easyui-datagrid\" title=\"回购订单表\"
       data-options=\"toolbar:'#tb-user',singleSelect:true,pagination:true,method:'get',url:'";
        // line 23
        echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url("jdcardbuyback/buyback-list"), "html", null, true);
        echo "',nowrap:false,rownumbers: false\">
    <thead>
    <tr>
        <th data-options=\"field:'order_id', width:80, align:'center'\" formatter=\"formatId\">订单编号</th>
        <th data-options=\"field:'order_type', width:80, align:'center'\" formatter=\"formatOrdertype\">订单类型</th>
        <th data-options=\"field:'period_no', width:80, align:'center'\">当前期号</th>
        <th data-options=\"field:'nickname', width:80, align:'center'\">获奖用户昵称</th>
        <th data-options=\"field:'phone', width:80, align:'center'\">获奖用户手机</th>
        <th data-options=\"field:'face_value', width:50, align:'center'\">面值</th>
        <th data-options=\"field:'pay_money', width:80, align:'center'\">伙购价格</th>
        <th data-options=\"field:'add_time', width:150, align:'center'\" formatter=\"formatTime\">回收时间</th>
        <th data-options=\"field:'pay_type', width:80, align:'center'\" formatter=\"formatType\">付款类型</th>
        <th data-options=\"field:'pay_status', width:80, align:'center'\" formatter=\"formatStatus\">付款状态</th>
        <th data-options=\"field:'pay_no', width:180, align:'center'\">流水号</th>
        <th data-options=\"field:'pay_time', width:150, align:'center'\" formatter=\"formatTime\">付款时间</th>
        <th data-options=\"field:'beihuo', width:80, align:'center'\">备货人</th>
    </tr>
    </thead>
</table>
<div id=\"dlg-edit\" class=\"easyui-window\" title=\"查看\" style=\"width:500px;height:450px;padding:10px;overflow:hidden;\"
     data-options=\"
            iconCls:'icon-save',
            closed:true,
            modal:true,
            onResize:function(){
                \$(this).window('hcenter');
            }\">
    <iframe width=\"100%\" height=\"100%\" frameborder=\"0\" id=\"edit_iframe\">
    </iframe>
</div>
";
    }

    // line 55
    public function block_js($context, array $blocks = array())
    {
        // line 56
        echo "<script>
    function edit() {
        var selRow = \$('#listdata').datagrid('getSelected');

        if (!selRow) {
            \$.messager.alert('错误', '请选择一个');
            return false;
        }
        \$('#edit_iframe').prop('src', \"";
        // line 64
        echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url("jdcardbuyback/buyback-info"), "html", null, true);
        echo "\" + '?id=' + selRow.id);
        \$('#dlg-edit').window('open');
    }

    function formatTime(val, row) {
        var newDate_attend = new Date();
        newDate_attend.setTime(val * 1000);
        var my_create_time_attend=newDate_attend.format('yyyy-MM-dd hh:mm:ss');
        return my_create_time_attend;
    }

    function formatStatus(val, row) {
        if (val == 0) {
            return '待填写信息';
        }
        if (val == 1) {
            return '已付款';
        }
        if (val == 2) {
            return '待付款';
        }
        return '未知';
    }
    function formatType(val, row) {

        //转化整形
        var type = parseInt(val);
        switch (type) {
            case 1:
                return '支付宝';
                break;
            case 2:
                return '微信';
                break;
            case 3:
                return '银行卡';
                break;
            default:
                return '未知';
        }
    }
    function formatOrdertype(val, row) {

        //转化整形
        var type = parseInt(val);
        switch (type) {
            case 0:
                return '普通';
                break;
            case 1:
                return '活动:PK场';
                break;
            default:
                return '未知';
        }
    }

    function reloadgrid() {

        var queryParams = \$('#listdata').datagrid('options').queryParams;

        queryParams.start_time = \$('#startTime').datetimebox('getValue');
        queryParams.end_time = \$('#endTime').datetimebox('getValue');
        queryParams.mobile = getUrlParam('mobile');
        queryParams.account = \$('#account').val();
        queryParams.beihuo = \$('#beihuo').val();
        queryParams.period_no = \$('#period_no').val();
        queryParams.order_id = \$('#order_id').val();
        \$('#listdata').datagrid('options').queryParams = queryParams;
        \$(\"#listdata\").datagrid('reload');
    }

    function getUrlParam(name) {
        var reg = new RegExp(\"(^|&)\" + name + \"=([^&]*)(&|\$)\");
        var r = window.location.search.substr(1).match(reg);
        if (r != null) return decodeURIComponent(r[2]);
        return null;
    }
    function formatId(val, row) {
        if (row.order_type == 1) {
            var id = 'PK' + val;
            return id;
        }
        return val;
    }
    function dataexcel() {
        var startTime = \$('#startTime').datetimebox('getValue');
        var endTime = \$('#endTime').datetimebox('getValue');
        var mobile = getUrlParam('mobile');
        var account = \$('#account').val();
        var beihuo = \$('#beihuo').val();
        var period_no = \$('#period_no').val();
        var order_id = \$('#order_id').val();
        var url = \"/jdcardbuyback/buyback-list?excel=buyback&account=\" + account + '&startTime=' + startTime + '&endTime=' + endTime + '&mobile=' + mobile;
        window.location.href = url;
    }
</script>
";
    }

    public function getTemplateName()
    {
        return "buybacklist.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  101 => 64,  91 => 56,  88 => 55,  53 => 23,  32 => 4,  29 => 3,  11 => 1,);
    }
}
/* {% extends '@app/views/base.html' %}*/
/* */
/* {% block main %}*/
/* <div class="search">*/
/*     <span>付款时间*/
/*         <input class="easyui-datetimebox" style="width:200px" name="startTime" id="startTime"> 到*/
/*         <input class="easyui-datetimebox" style="width:200px" name="endTime" id="endTime">*/
/*     </span>*/
/*     <span>用户手机号<input class="easyui-textbox" type="text" name="account" id="account"></span><br>*/
/*     <span>备货人<input class="easyui-textbox" type="text" name="beihuo" id="beihuo"></span>*/
/*     <span>期号<input class="easyui-textbox" type="text" name="period_no" id="period_no"></span>*/
/*     <span>订单号<input class="easyui-textbox" type="text" name="order_id" id="order_id"></span>*/
/*     <a href="javascript:void(0);" onclick="reloadgrid();" class="easyui-linkbutton" iconCls="icon-search">搜索</a>*/
/*     <a href="javascript:void(0);" class="easyui-linkbutton" onclick="dataexcel();">导出</a>*/
/* </div>*/
/* <div id="tb-user" style="height: auto;">*/
/*     <div>*/
/*         <a href="javascript:void(0)" class="easyui-linkbutton"*/
/*            data-options="iconCls:'icon-edit',plain:true" onclick="edit()">查看</a>*/
/*     </div>*/
/* </div>*/
/* <table id="listdata" class="easyui-datagrid" title="回购订单表"*/
/*        data-options="toolbar:'#tb-user',singleSelect:true,pagination:true,method:'get',url:'{{url('jdcardbuyback/buyback-list')}}',nowrap:false,rownumbers: false">*/
/*     <thead>*/
/*     <tr>*/
/*         <th data-options="field:'order_id', width:80, align:'center'" formatter="formatId">订单编号</th>*/
/*         <th data-options="field:'order_type', width:80, align:'center'" formatter="formatOrdertype">订单类型</th>*/
/*         <th data-options="field:'period_no', width:80, align:'center'">当前期号</th>*/
/*         <th data-options="field:'nickname', width:80, align:'center'">获奖用户昵称</th>*/
/*         <th data-options="field:'phone', width:80, align:'center'">获奖用户手机</th>*/
/*         <th data-options="field:'face_value', width:50, align:'center'">面值</th>*/
/*         <th data-options="field:'pay_money', width:80, align:'center'">伙购价格</th>*/
/*         <th data-options="field:'add_time', width:150, align:'center'" formatter="formatTime">回收时间</th>*/
/*         <th data-options="field:'pay_type', width:80, align:'center'" formatter="formatType">付款类型</th>*/
/*         <th data-options="field:'pay_status', width:80, align:'center'" formatter="formatStatus">付款状态</th>*/
/*         <th data-options="field:'pay_no', width:180, align:'center'">流水号</th>*/
/*         <th data-options="field:'pay_time', width:150, align:'center'" formatter="formatTime">付款时间</th>*/
/*         <th data-options="field:'beihuo', width:80, align:'center'">备货人</th>*/
/*     </tr>*/
/*     </thead>*/
/* </table>*/
/* <div id="dlg-edit" class="easyui-window" title="查看" style="width:500px;height:450px;padding:10px;overflow:hidden;"*/
/*      data-options="*/
/*             iconCls:'icon-save',*/
/*             closed:true,*/
/*             modal:true,*/
/*             onResize:function(){*/
/*                 $(this).window('hcenter');*/
/*             }">*/
/*     <iframe width="100%" height="100%" frameborder="0" id="edit_iframe">*/
/*     </iframe>*/
/* </div>*/
/* {% endblock %}*/
/* */
/* {% block js %}*/
/* <script>*/
/*     function edit() {*/
/*         var selRow = $('#listdata').datagrid('getSelected');*/
/* */
/*         if (!selRow) {*/
/*             $.messager.alert('错误', '请选择一个');*/
/*             return false;*/
/*         }*/
/*         $('#edit_iframe').prop('src', "{{ url('jdcardbuyback/buyback-info') }}" + '?id=' + selRow.id);*/
/*         $('#dlg-edit').window('open');*/
/*     }*/
/* */
/*     function formatTime(val, row) {*/
/*         var newDate_attend = new Date();*/
/*         newDate_attend.setTime(val * 1000);*/
/*         var my_create_time_attend=newDate_attend.format('yyyy-MM-dd hh:mm:ss');*/
/*         return my_create_time_attend;*/
/*     }*/
/* */
/*     function formatStatus(val, row) {*/
/*         if (val == 0) {*/
/*             return '待填写信息';*/
/*         }*/
/*         if (val == 1) {*/
/*             return '已付款';*/
/*         }*/
/*         if (val == 2) {*/
/*             return '待付款';*/
/*         }*/
/*         return '未知';*/
/*     }*/
/*     function formatType(val, row) {*/
/* */
/*         //转化整形*/
/*         var type = parseInt(val);*/
/*         switch (type) {*/
/*             case 1:*/
/*                 return '支付宝';*/
/*                 break;*/
/*             case 2:*/
/*                 return '微信';*/
/*                 break;*/
/*             case 3:*/
/*                 return '银行卡';*/
/*                 break;*/
/*             default:*/
/*                 return '未知';*/
/*         }*/
/*     }*/
/*     function formatOrdertype(val, row) {*/
/* */
/*         //转化整形*/
/*         var type = parseInt(val);*/
/*         switch (type) {*/
/*             case 0:*/
/*                 return '普通';*/
/*                 break;*/
/*             case 1:*/
/*                 return '活动:PK场';*/
/*                 break;*/
/*             default:*/
/*                 return '未知';*/
/*         }*/
/*     }*/
/* */
/*     function reloadgrid() {*/
/* */
/*         var queryParams = $('#listdata').datagrid('options').queryParams;*/
/* */
/*         queryParams.start_time = $('#startTime').datetimebox('getValue');*/
/*         queryParams.end_time = $('#endTime').datetimebox('getValue');*/
/*         queryParams.mobile = getUrlParam('mobile');*/
/*         queryParams.account = $('#account').val();*/
/*         queryParams.beihuo = $('#beihuo').val();*/
/*         queryParams.period_no = $('#period_no').val();*/
/*         queryParams.order_id = $('#order_id').val();*/
/*         $('#listdata').datagrid('options').queryParams = queryParams;*/
/*         $("#listdata").datagrid('reload');*/
/*     }*/
/* */
/*     function getUrlParam(name) {*/
/*         var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)");*/
/*         var r = window.location.search.substr(1).match(reg);*/
/*         if (r != null) return decodeURIComponent(r[2]);*/
/*         return null;*/
/*     }*/
/*     function formatId(val, row) {*/
/*         if (row.order_type == 1) {*/
/*             var id = 'PK' + val;*/
/*             return id;*/
/*         }*/
/*         return val;*/
/*     }*/
/*     function dataexcel() {*/
/*         var startTime = $('#startTime').datetimebox('getValue');*/
/*         var endTime = $('#endTime').datetimebox('getValue');*/
/*         var mobile = getUrlParam('mobile');*/
/*         var account = $('#account').val();*/
/*         var beihuo = $('#beihuo').val();*/
/*         var period_no = $('#period_no').val();*/
/*         var order_id = $('#order_id').val();*/
/*         var url = "/jdcardbuyback/buyback-list?excel=buyback&account=" + account + '&startTime=' + startTime + '&endTime=' + endTime + '&mobile=' + mobile;*/
/*         window.location.href = url;*/
/*     }*/
/* </script>*/
/* {% endblock %}*/
