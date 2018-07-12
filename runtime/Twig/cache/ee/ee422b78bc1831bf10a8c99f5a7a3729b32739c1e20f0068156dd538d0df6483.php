<?php

/* pkorders.html */
class __TwigTemplate_f37b8218f980a1795bbd9f65fca9ff6f171c25f7391717d3e027d843dca56e77 extends yii\twig\Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("@app/views/base.html", "pkorders.html", 1);
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
        echo "<div style=\"padding:5px;height:auto\">
    <a class=\"easyui-linkbutton l-btn l-btn-small l-btn-plain\"  href=\"";
        // line 5
        echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url("jdorder/orders"), "html", null, true);
        echo "\">普通订单</a>
    <a class=\"easyui-linkbutton l-btn l-btn-small l-btn-plain\" style=\"color: red\" href=\"";
        // line 6
        echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url("jdorder/pkorders"), "html", null, true);
        echo "\">PK订单</a>
</div>

<div class=\"search\">
    <span>开始时间
        <input class=\"easyui-datetimebox\" style=\"width:200px\" name=\"startTime\" id=\"startTime\"> 到
        <input class=\"easyui-datetimebox\" style=\"width:200px\" name=\"endTime\" id=\"endTime\">
    </span>
    <span>用户手机<input class=\"easyui-textbox\" type=\"text\" name=\"account\" id=\"account\"></span>
    <span>平台
    <select name=\"from\" id=\"from\">
        <option value=\"0\">全部</option>
        <option value=\"1\">伙购</option>
        <option value=\"2\">滴滴</option>
    </select></span>
    <span>状态
    <select name=\"status\" id=\"status\">
        <option value=\"0\">已中奖</option>
        <option value=\"1\">待确认</option>
        <option value=\"3\">待发货</option>
        <option value=\"4\">待收货</option>
        <option value=\"8\">已完成</option>
    </select></span>
    <span>获奖订单<input class=\"easyui-textbox\" type=\"text\" name=\"orderid\" id=\"orderid\"></span>
    <a href=\"javascript:void(0);\" onclick=\"reloadgrid();\" class=\"easyui-linkbutton\" iconCls=\"icon-search\">搜索</a>

</div>
<div class=\"datagrid-toolbar\" id=\"tb-user\" style=\"height: auto;\">
    <div>
        <a id=\"\" group=\"\" href=\"javascript:void(0)\" class=\"easyui-linkbutton l-btn l-btn-small l-btn-plain\"
           data-options=\"iconCls:'icon-edit',plain:true\" onclick=\"edit()\"><span class=\"l-btn-left l-btn-icon-left\"><span
                class=\"l-btn-text\">查看</span></span></a>
    </div>
</div>
<table id=\"listdata\" class=\"easyui-datagrid\" title=\"虚拟物品列表\"
       data-options=\"toolbar:'#tb-user',singleSelect:true,pagination:true,method:'get',url:'";
        // line 41
        echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url("jdorder/pkorders"), "html", null, true);
        echo "',nowrap:false,rownumbers: false\">
    <thead>
    <tr>
        <th data-options=\"field:'id', width:150, align:'center'\">订单号</th>
        <th data-options=\"field:'productname', width:150, align:'center'\">商品名称</th>
        <th data-options=\"field:'period_no', width:150, align:'center'\">期号</th>
        <th data-options=\"field:'period_id', width:180, align:'center'\">期数id</th>
        <th data-options=\"field:'size', width:180, align:'center'\" formatter=\"formatSize\">结果</th>
        <th data-options=\"field:'desk_id', width:180, align:'center'\">卓号</th>
        <th data-options=\"field:'status', width:180, align:'center'\">订单状态</th>
        <th data-options=\"field:'nickname', width:180, align:'center'\">用户昵称</th>
        <th data-options=\"field:'ship_mobile', width:150, align:'center'\">手机号</th>
        <th data-options=\"field:'last_modified', width:180, align:'center'\" formatter=\"formatTime\">更新时间</th>
        <th data-options=\"field:'deliver_adminname', width:180, align:'center'\">发货人</th>
        <th data-options=\"field:'deliver_time', width:180, align:'center'\" formatter=\"formatTime\">发货时间</th>
    </tr>
    </thead>
</table>
<div id=\"dlg-edit\" class=\"easyui-window\" title=\"编辑商品\" style=\"width:1242px;height:750px;padding:10px;overflow:hidden;\"
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

    // line 72
    public function block_js($context, array $blocks = array())
    {
        // line 73
        echo "<script>

    function edit() {
        var selRow = \$('#listdata').datagrid('getSelected');

        if (!selRow) {
            \$.messager.alert('错误', '请选择一个');
            return false;
        }
        \$('#edit_iframe').prop('src', \"";
        // line 82
        echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url("pkorder/view"), "html", null, true);
        echo "\" + '?id=' + selRow.id);

        \$('#dlg-edit').window('open');
    }
    function dataexcel() {
        var start_time = \$('#startTime').datetimebox('getValue');
        var end_time = \$('#endTime').datetimebox('getValue');
        var orderid = \$('#orderid').val();
        var account = \$('#account').val();
        window.location.href = \"/virtual/index?excel=virtual&start_time=\" + start_time + '&end_time=' + end_time + '&orderid=' + orderid + '&account=' + account;
    }

    function reloadgrid() {
        var queryParams = \$('#listdata').datagrid('options').queryParams;
        queryParams.startTime = \$('#startTime').datetimebox('getValue');
        queryParams.endTime = \$('#endTime').datetimebox('getValue');
        queryParams.endTime = \$('#endTime').datetimebox('getValue');
        queryParams.account = \$('#account').val();
        queryParams.orderid = \$('#orderid').val();
        queryParams.from = \$('#from').val();
        queryParams.status = \$('#status').val();
        \$('#listdata').datagrid('options').queryParams = queryParams;
        \$(\"#listdata\").datagrid('reload');
    }
    function formatTime(val, row) {
        if(val>0){
        var newDate_attend = new Date();
        newDate_attend.setTime(val * 1000);
        var my_create_time_attend=newDate_attend.format('yyyy-MM-dd hh:mm:ss');
        return my_create_time_attend;
        }else{
            return '';
        }
    }

    function formatSize(val, row) {
        if(val==1){
            return '大';
        }
        return '小';
    }
    Date.prototype.format = function(format) {
        var date = {
            \"M+\": this.getMonth() + 1,
            \"d+\": this.getDate(),
            \"h+\": this.getHours(),
            \"m+\": this.getMinutes(),
            \"s+\": this.getSeconds(),
            \"q+\": Math.floor((this.getMonth() + 3) / 3),
            \"S+\": this.getMilliseconds()
        };
        if (/(y+)/i.test(format)) {
            format = format.replace(RegExp.\$1, (this.getFullYear() + '').substr(4 - RegExp.\$1.length));
        }

        for (var k in date) {
            if (new RegExp(\"(\" + k + \")\").test(format)) {
                format = format.replace(RegExp.\$1, RegExp.\$1.length == 1
                        ? date[k] : (\"00\" + date[k]).substr((\"\" + date[k]).length));
            }
        }
        return format;
    }


</script>
";
    }

    public function getTemplateName()
    {
        return "pkorders.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  125 => 82,  114 => 73,  111 => 72,  77 => 41,  39 => 6,  35 => 5,  32 => 4,  29 => 3,  11 => 1,);
    }
}
/* {% extends '@app/views/base.html' %}*/
/* */
/* {% block main %}*/
/* <div style="padding:5px;height:auto">*/
/*     <a class="easyui-linkbutton l-btn l-btn-small l-btn-plain"  href="{{url('jdorder/orders')}}">普通订单</a>*/
/*     <a class="easyui-linkbutton l-btn l-btn-small l-btn-plain" style="color: red" href="{{url('jdorder/pkorders')}}">PK订单</a>*/
/* </div>*/
/* */
/* <div class="search">*/
/*     <span>开始时间*/
/*         <input class="easyui-datetimebox" style="width:200px" name="startTime" id="startTime"> 到*/
/*         <input class="easyui-datetimebox" style="width:200px" name="endTime" id="endTime">*/
/*     </span>*/
/*     <span>用户手机<input class="easyui-textbox" type="text" name="account" id="account"></span>*/
/*     <span>平台*/
/*     <select name="from" id="from">*/
/*         <option value="0">全部</option>*/
/*         <option value="1">伙购</option>*/
/*         <option value="2">滴滴</option>*/
/*     </select></span>*/
/*     <span>状态*/
/*     <select name="status" id="status">*/
/*         <option value="0">已中奖</option>*/
/*         <option value="1">待确认</option>*/
/*         <option value="3">待发货</option>*/
/*         <option value="4">待收货</option>*/
/*         <option value="8">已完成</option>*/
/*     </select></span>*/
/*     <span>获奖订单<input class="easyui-textbox" type="text" name="orderid" id="orderid"></span>*/
/*     <a href="javascript:void(0);" onclick="reloadgrid();" class="easyui-linkbutton" iconCls="icon-search">搜索</a>*/
/* */
/* </div>*/
/* <div class="datagrid-toolbar" id="tb-user" style="height: auto;">*/
/*     <div>*/
/*         <a id="" group="" href="javascript:void(0)" class="easyui-linkbutton l-btn l-btn-small l-btn-plain"*/
/*            data-options="iconCls:'icon-edit',plain:true" onclick="edit()"><span class="l-btn-left l-btn-icon-left"><span*/
/*                 class="l-btn-text">查看</span></span></a>*/
/*     </div>*/
/* </div>*/
/* <table id="listdata" class="easyui-datagrid" title="虚拟物品列表"*/
/*        data-options="toolbar:'#tb-user',singleSelect:true,pagination:true,method:'get',url:'{{url('jdorder/pkorders')}}',nowrap:false,rownumbers: false">*/
/*     <thead>*/
/*     <tr>*/
/*         <th data-options="field:'id', width:150, align:'center'">订单号</th>*/
/*         <th data-options="field:'productname', width:150, align:'center'">商品名称</th>*/
/*         <th data-options="field:'period_no', width:150, align:'center'">期号</th>*/
/*         <th data-options="field:'period_id', width:180, align:'center'">期数id</th>*/
/*         <th data-options="field:'size', width:180, align:'center'" formatter="formatSize">结果</th>*/
/*         <th data-options="field:'desk_id', width:180, align:'center'">卓号</th>*/
/*         <th data-options="field:'status', width:180, align:'center'">订单状态</th>*/
/*         <th data-options="field:'nickname', width:180, align:'center'">用户昵称</th>*/
/*         <th data-options="field:'ship_mobile', width:150, align:'center'">手机号</th>*/
/*         <th data-options="field:'last_modified', width:180, align:'center'" formatter="formatTime">更新时间</th>*/
/*         <th data-options="field:'deliver_adminname', width:180, align:'center'">发货人</th>*/
/*         <th data-options="field:'deliver_time', width:180, align:'center'" formatter="formatTime">发货时间</th>*/
/*     </tr>*/
/*     </thead>*/
/* </table>*/
/* <div id="dlg-edit" class="easyui-window" title="编辑商品" style="width:1242px;height:750px;padding:10px;overflow:hidden;"*/
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
/* */
/*     function edit() {*/
/*         var selRow = $('#listdata').datagrid('getSelected');*/
/* */
/*         if (!selRow) {*/
/*             $.messager.alert('错误', '请选择一个');*/
/*             return false;*/
/*         }*/
/*         $('#edit_iframe').prop('src', "{{ url('pkorder/view') }}" + '?id=' + selRow.id);*/
/* */
/*         $('#dlg-edit').window('open');*/
/*     }*/
/*     function dataexcel() {*/
/*         var start_time = $('#startTime').datetimebox('getValue');*/
/*         var end_time = $('#endTime').datetimebox('getValue');*/
/*         var orderid = $('#orderid').val();*/
/*         var account = $('#account').val();*/
/*         window.location.href = "/virtual/index?excel=virtual&start_time=" + start_time + '&end_time=' + end_time + '&orderid=' + orderid + '&account=' + account;*/
/*     }*/
/* */
/*     function reloadgrid() {*/
/*         var queryParams = $('#listdata').datagrid('options').queryParams;*/
/*         queryParams.startTime = $('#startTime').datetimebox('getValue');*/
/*         queryParams.endTime = $('#endTime').datetimebox('getValue');*/
/*         queryParams.endTime = $('#endTime').datetimebox('getValue');*/
/*         queryParams.account = $('#account').val();*/
/*         queryParams.orderid = $('#orderid').val();*/
/*         queryParams.from = $('#from').val();*/
/*         queryParams.status = $('#status').val();*/
/*         $('#listdata').datagrid('options').queryParams = queryParams;*/
/*         $("#listdata").datagrid('reload');*/
/*     }*/
/*     function formatTime(val, row) {*/
/*         if(val>0){*/
/*         var newDate_attend = new Date();*/
/*         newDate_attend.setTime(val * 1000);*/
/*         var my_create_time_attend=newDate_attend.format('yyyy-MM-dd hh:mm:ss');*/
/*         return my_create_time_attend;*/
/*         }else{*/
/*             return '';*/
/*         }*/
/*     }*/
/* */
/*     function formatSize(val, row) {*/
/*         if(val==1){*/
/*             return '大';*/
/*         }*/
/*         return '小';*/
/*     }*/
/*     Date.prototype.format = function(format) {*/
/*         var date = {*/
/*             "M+": this.getMonth() + 1,*/
/*             "d+": this.getDate(),*/
/*             "h+": this.getHours(),*/
/*             "m+": this.getMinutes(),*/
/*             "s+": this.getSeconds(),*/
/*             "q+": Math.floor((this.getMonth() + 3) / 3),*/
/*             "S+": this.getMilliseconds()*/
/*         };*/
/*         if (/(y+)/i.test(format)) {*/
/*             format = format.replace(RegExp.$1, (this.getFullYear() + '').substr(4 - RegExp.$1.length));*/
/*         }*/
/* */
/*         for (var k in date) {*/
/*             if (new RegExp("(" + k + ")").test(format)) {*/
/*                 format = format.replace(RegExp.$1, RegExp.$1.length == 1*/
/*                         ? date[k] : ("00" + date[k]).substr(("" + date[k]).length));*/
/*             }*/
/*         }*/
/*         return format;*/
/*     }*/
/* */
/* */
/* </script>*/
/* {% endblock %}*/
