<?php

/* count.html */
class __TwigTemplate_ef64df81e648e0013849b776b1f7295248ead08badc4cee94a3d493bde21bfe9 extends yii\twig\Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("@app/views/base.html", "count.html", 1);
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
        echo "
<div class=\"search\">
    <span>开始时间<input type=\"text\" name=\"start_time\" id=\"start_time\" class=\"easyui-datetimebox\"></span>
    <span>结束时间<input type=\"text\" name=\"end_time\" id=\"end_time\" class=\"easyui-datetimebox\"></span>
    <span>状态
        <select name=\"status\" id=\"status\" class=\"easyui-combobox\">
            <option value=\"0\">全部</option>
            <option value=\"1\">成功</option>
            <option value=\"2\">失败</option>
        </select>
    </span>
    <span>订单号<input class=\"easyui-textbox\" type=\"text\" name=\"id\" id=\"id\"></span>
    <span>用户<input class=\"easyui-textbox\" type=\"text\" name=\"content\" id=\"content\"></span>
    <a href=\"javascript:void(0);\" onclick=\"reloadgrid();\" class=\"easyui-linkbutton\" iconCls=\"icon-search\">搜索</a>
    <a href=\"javascript:void(0);\" class=\"easyui-linkbutton\" onclick=\"dataexcel();\">导出</a>
    <span>总计：<b id=\"total\"></b> &nbsp;实际金额：<b id=\"money\"></b> &nbsp;福分：<b id=\"point\"></b></span>
</div>

<table id=\"listdata\"  class=\"easyui-datagrid\" title=\"支付订单\" data-options=\"showFooter:true,toolbar:'#tb-user',rownumbers:false,singleSelect:true,pagination:true,method:'get',url:'";
        // line 22
        echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url("order/count"), "html", null, true);
        echo "',onLoadSuccess: OnloadSuccess,pageSize:20\">
    <thead>
    <tr>
        <th data-options=\"field:'id', width:200, align:'center'\">订单号</th>
        <th data-options=\"field:'phone', width:100, align:'center'\">会员手机</th>
        <th data-options=\"field:'email', width:150, align:'center'\">会员邮箱</th>
        <th data-options=\"field:'total', width:150, align:'center'\">总金额</th>
        <th data-options=\"field:'money', width:150, align:'center'\">实际支付金额</th>
        <th data-options=\"field:'point', width:100, align:'center'\">支付福分</th>
        <th data-options=\"field:'redpack', width:100, align:'center'\">红包抵扣额度</th>
        <th data-options=\"field:'payment', width:150, align:'center'\">支付方式</th>
        <th data-options=\"field:'source', width:200, align:'center'\">支付来源</th>
        <th data-options=\"field:'buy_time', width:200, align:'center'\">时间</th>
    </tr>
    </thead>
</table>

<div id=\"tb-user\" style=\"height:auto\">
    <div>
        <a href=\"javascript:void(0)\" class=\"easyui-linkbutton\" data-options=\"iconCls:'icon-add',plain:true\" onclick=\"append()\">新增</a>
        <a href=\"javascript:void(0)\" class=\"easyui-linkbutton\" data-options=\"iconCls:'icon-edit',plain:true\" onclick=\"editUser()\">编辑</a>
        <a href=\"javascript:void(0)\" class=\"easyui-linkbutton\" data-options=\"iconCls:'icon-ok',plain:true\" onclick=\"setSta(1)\">启用</a>
        <a href=\"javascript:void(0)\" class=\"easyui-linkbutton\" data-options=\"iconCls:'icon-no',plain:true\" onclick=\"setSta(0)\">停用</a>
    </div>
</div>

";
    }

    // line 50
    public function block_js($context, array $blocks = array())
    {
        // line 51
        echo "<script src=\"";
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "params", array()), "skinUrl", array()), "html", null, true);
        echo "/js/laydate/laydate.js\"></script>
<script>
    function OnloadSuccess(){
        var total = \$('#listdata').datagrid('getData').count;
        \$('#total').html(total.total);
        \$('#money').html(total.totalMoney);
        \$('#point').html(total.totalPoint);
    }

    function dataexcel(){
        var start_time = \$('#start_time').datetimebox('getValue');
        var end_time = \$('#end_time').datetimebox('getValue');
        var id = \$('#id').val();
        var content = \$('#content').val();
        var status = \$('#status').combobox('getValue');
        window.location.href=\"/order/count?excel=count&start_time=\"+start_time+'&end_time='+end_time+'&id='+id+'&content='+content+'&status='+status;
    }

    function reloadgrid(){
        var queryParams = \$('#listdata').datagrid('options').queryParams;
        queryParams.start_time = \$('#start_time').datetimebox('getValue');
        queryParams.end_time = \$('#end_time').datetimebox('getValue');
        queryParams.id = \$('#id').val();
        queryParams.content = \$('#content').val();
        queryParams.status = \$('#status').combobox('getValue');
        \$('#listdata').datagrid('options').queryParams = queryParams;
        \$(\"#listdata\").datagrid('reload');
    }
</script>
";
    }

    public function getTemplateName()
    {
        return "count.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  86 => 51,  83 => 50,  52 => 22,  32 => 4,  29 => 3,  11 => 1,);
    }
}
/* {% extends '@app/views/base.html' %}*/
/* */
/* {% block main %}*/
/* */
/* <div class="search">*/
/*     <span>开始时间<input type="text" name="start_time" id="start_time" class="easyui-datetimebox"></span>*/
/*     <span>结束时间<input type="text" name="end_time" id="end_time" class="easyui-datetimebox"></span>*/
/*     <span>状态*/
/*         <select name="status" id="status" class="easyui-combobox">*/
/*             <option value="0">全部</option>*/
/*             <option value="1">成功</option>*/
/*             <option value="2">失败</option>*/
/*         </select>*/
/*     </span>*/
/*     <span>订单号<input class="easyui-textbox" type="text" name="id" id="id"></span>*/
/*     <span>用户<input class="easyui-textbox" type="text" name="content" id="content"></span>*/
/*     <a href="javascript:void(0);" onclick="reloadgrid();" class="easyui-linkbutton" iconCls="icon-search">搜索</a>*/
/*     <a href="javascript:void(0);" class="easyui-linkbutton" onclick="dataexcel();">导出</a>*/
/*     <span>总计：<b id="total"></b> &nbsp;实际金额：<b id="money"></b> &nbsp;福分：<b id="point"></b></span>*/
/* </div>*/
/* */
/* <table id="listdata"  class="easyui-datagrid" title="支付订单" data-options="showFooter:true,toolbar:'#tb-user',rownumbers:false,singleSelect:true,pagination:true,method:'get',url:'{{  url('order/count')}}',onLoadSuccess: OnloadSuccess,pageSize:20">*/
/*     <thead>*/
/*     <tr>*/
/*         <th data-options="field:'id', width:200, align:'center'">订单号</th>*/
/*         <th data-options="field:'phone', width:100, align:'center'">会员手机</th>*/
/*         <th data-options="field:'email', width:150, align:'center'">会员邮箱</th>*/
/*         <th data-options="field:'total', width:150, align:'center'">总金额</th>*/
/*         <th data-options="field:'money', width:150, align:'center'">实际支付金额</th>*/
/*         <th data-options="field:'point', width:100, align:'center'">支付福分</th>*/
/*         <th data-options="field:'redpack', width:100, align:'center'">红包抵扣额度</th>*/
/*         <th data-options="field:'payment', width:150, align:'center'">支付方式</th>*/
/*         <th data-options="field:'source', width:200, align:'center'">支付来源</th>*/
/*         <th data-options="field:'buy_time', width:200, align:'center'">时间</th>*/
/*     </tr>*/
/*     </thead>*/
/* </table>*/
/* */
/* <div id="tb-user" style="height:auto">*/
/*     <div>*/
/*         <a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-add',plain:true" onclick="append()">新增</a>*/
/*         <a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-edit',plain:true" onclick="editUser()">编辑</a>*/
/*         <a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-ok',plain:true" onclick="setSta(1)">启用</a>*/
/*         <a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-no',plain:true" onclick="setSta(0)">停用</a>*/
/*     </div>*/
/* </div>*/
/* */
/* {% endblock %}*/
/* */
/* {% block js %}*/
/* <script src="{{ app.params.skinUrl }}/js/laydate/laydate.js"></script>*/
/* <script>*/
/*     function OnloadSuccess(){*/
/*         var total = $('#listdata').datagrid('getData').count;*/
/*         $('#total').html(total.total);*/
/*         $('#money').html(total.totalMoney);*/
/*         $('#point').html(total.totalPoint);*/
/*     }*/
/* */
/*     function dataexcel(){*/
/*         var start_time = $('#start_time').datetimebox('getValue');*/
/*         var end_time = $('#end_time').datetimebox('getValue');*/
/*         var id = $('#id').val();*/
/*         var content = $('#content').val();*/
/*         var status = $('#status').combobox('getValue');*/
/*         window.location.href="/order/count?excel=count&start_time="+start_time+'&end_time='+end_time+'&id='+id+'&content='+content+'&status='+status;*/
/*     }*/
/* */
/*     function reloadgrid(){*/
/*         var queryParams = $('#listdata').datagrid('options').queryParams;*/
/*         queryParams.start_time = $('#start_time').datetimebox('getValue');*/
/*         queryParams.end_time = $('#end_time').datetimebox('getValue');*/
/*         queryParams.id = $('#id').val();*/
/*         queryParams.content = $('#content').val();*/
/*         queryParams.status = $('#status').combobox('getValue');*/
/*         $('#listdata').datagrid('options').queryParams = queryParams;*/
/*         $("#listdata").datagrid('reload');*/
/*     }*/
/* </script>*/
/* {% endblock %}*/
/* */
/* */
