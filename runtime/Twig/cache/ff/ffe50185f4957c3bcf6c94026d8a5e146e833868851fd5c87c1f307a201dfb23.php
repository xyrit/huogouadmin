<?php

/* list.html */
class __TwigTemplate_86731dcf0f762f0f4a5684030ca1ed2d5416ca57da269c9497c14aaead60d629 extends yii\twig\Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("@app/views/base.html", "list.html", 1);
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
<div id=\"tb-user\" style=\"height:auto\">
    <div>
        <a href=\"javascript:void(0)\" class=\"easyui-linkbutton\" data-options=\"iconCls:'icon-edit',plain:true\"
           onclick=\"edit()\">查看</a>
    </div>
</div>

<table id=\"listdata\" class=\"easyui-datagrid\" title=\"虚拟物品列表\"
       data-options=\"toolbar:'#tb-user',singleSelect:true,pagination:true,method:'get',url:'";
        // line 36
        echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url("pkorder/list"), "html", null, true);
        echo "',nowrap:false,rownumbers: false\">
    <thead>
    <tr>
        <th data-options=\"field:'id', width:150, align:'center'\">订单号</th>
        <th data-options=\"field:'productname', width:150, align:'center'\">商品名称</th>
        <th data-options=\"field:'period_no', width:150, align:'center'\">当前期号</th>
        <th data-options=\"field:'period_id', width:180, align:'center'\">期数ID</th>
        <th data-options=\"field:'size', width:180, align:'center'\" formatter=\"formatSize\">开奖结果</th>
        <th data-options=\"field:'desk_id', width:180, align:'center'\">所属桌号</th>
        <th data-options=\"field:'status', width:180, align:'center'\">订单状态</th>
        <th data-options=\"field:'nickname', width:180, align:'center'\">用户昵称</th>
        <th data-options=\"field:'ship_mobile', width:150, align:'center'\">手机号</th>
        <th data-options=\"field:'last_modified', width:180, align:'center'\" formatter=\"formatTime\">更新时间</th>
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

    // line 65
    public function block_js($context, array $blocks = array())
    {
        // line 66
        echo "<script>

    function edit() {
        var selRow = \$('#listdata').datagrid('getSelected');

        if (!selRow) {
            \$.messager.alert('错误', '请选择一个');
            return false;
        }
        \$('#edit_iframe').prop('src', \"";
        // line 75
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
        var newDate_attend = new Date();
        newDate_attend.setTime(val * 1000);
        var my_create_time_attend=newDate_attend.format('yyyy-MM-dd hh:mm:ss');
        return my_create_time_attend;
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
        return "list.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  112 => 75,  101 => 66,  98 => 65,  66 => 36,  32 => 4,  29 => 3,  11 => 1,);
    }
}
/* {% extends '@app/views/base.html' %}*/
/* */
/* {% block main %}*/
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
/* <div id="tb-user" style="height:auto">*/
/*     <div>*/
/*         <a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-edit',plain:true"*/
/*            onclick="edit()">查看</a>*/
/*     </div>*/
/* </div>*/
/* */
/* <table id="listdata" class="easyui-datagrid" title="虚拟物品列表"*/
/*        data-options="toolbar:'#tb-user',singleSelect:true,pagination:true,method:'get',url:'{{url('pkorder/list')}}',nowrap:false,rownumbers: false">*/
/*     <thead>*/
/*     <tr>*/
/*         <th data-options="field:'id', width:150, align:'center'">订单号</th>*/
/*         <th data-options="field:'productname', width:150, align:'center'">商品名称</th>*/
/*         <th data-options="field:'period_no', width:150, align:'center'">当前期号</th>*/
/*         <th data-options="field:'period_id', width:180, align:'center'">期数ID</th>*/
/*         <th data-options="field:'size', width:180, align:'center'" formatter="formatSize">开奖结果</th>*/
/*         <th data-options="field:'desk_id', width:180, align:'center'">所属桌号</th>*/
/*         <th data-options="field:'status', width:180, align:'center'">订单状态</th>*/
/*         <th data-options="field:'nickname', width:180, align:'center'">用户昵称</th>*/
/*         <th data-options="field:'ship_mobile', width:150, align:'center'">手机号</th>*/
/*         <th data-options="field:'last_modified', width:180, align:'center'" formatter="formatTime">更新时间</th>*/
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
/*         var newDate_attend = new Date();*/
/*         newDate_attend.setTime(val * 1000);*/
/*         var my_create_time_attend=newDate_attend.format('yyyy-MM-dd hh:mm:ss');*/
/*         return my_create_time_attend;*/
/*     }*/
/* */
/*     function formatSize(val, row) {*/
/*       if(val==1){*/
/*        return '大';*/
/*       }*/
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
