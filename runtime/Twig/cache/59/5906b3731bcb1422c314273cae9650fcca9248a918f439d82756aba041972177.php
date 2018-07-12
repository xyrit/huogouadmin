<?php

/* order.html */
class __TwigTemplate_5ca86b54544e60497969af399711b3078118679dfcbf398a9dc9278ba4c47e0e extends yii\twig\Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("@app/views/base.html", "order.html", 1);
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
    <span>开始时间<input type=\"text\" name=\"start_time\" id=\"start_time\" class=\"easyui-datetimebox\" ></span>
    <span>结束时间<input type=\"text\" name=\"end_time\" id=\"end_time\" class=\"easyui-datetimebox\" ></span>
    <span>订单号<input class=\"easyui-textbox\" type=\"text\" name=\"orderId\" id=\"orderId\"></span>
    <span>用户<input class=\"easyui-textbox\" type=\"text\" name=\"content\" id=\"content\"></span>
    <a href=\"javascript:void(0);\" onclick=\"reloadgrid();\" class=\"easyui-linkbutton\" iconCls=\"icon-search\">搜索</a>
    <a href=\"javascript:void(0);\" class=\"easyui-linkbutton\" onclick=\"dataexcel();\">导出</a>
</div>

<table id=\"listdata\"  class=\"easyui-datagrid\" title=\"伙购列表\" data-options=\"toolbar:'#tb-user',rownumbers:false,singleSelect:true,pagination:true,method:'get',url:'";
        // line 14
        echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url("order/all-order"), "html", null, true);
        echo "',pageSize:20\">
    <thead>
    <tr>
        <th data-options=\"field:'id', width:200, align:'center'\">订单号</th>
        <th data-options=\"field:'name', width:300, align:'center'\">商品名称</th>
        <th data-options=\"field:'cat', width:100, align:'center'\">分类</th>
        <th data-options=\"field:'price', width:100, align:'center'\">价格</th>
        <th data-options=\"field:'phone', width:150, align:'center'\">会员手机</th>
        <th data-options=\"field:'email', width:150, align:'center'\">会员邮箱</th>
        <th data-options=\"field:'nums', width:50, align:'center'\">次数</th>
        <th data-options=\"field:'money', width:100, align:'center'\">金额</th>
        <th data-options=\"field:'point', width:100, align:'center'\">福分</th>
        <th data-options=\"field:'period_number', width:100, align:'center'\">期数</th>
        <th data-options=\"field:'period_no', width:100, align:'center'\">当前期号</th>
        <th data-options=\"field:'source', width:100, align:'center'\">来源</th>
        <th data-options=\"field:'created_at', width:200, align:'center'\">伙购时间</th>
    </tr>
    </thead>
</table>

";
    }

    // line 36
    public function block_js($context, array $blocks = array())
    {
        // line 37
        echo "<script>
    function dataexcel(){
        var start_time = \$('#start_time').datetimebox('getValue');
        var end_time = \$('#end_time').datetimebox('getValue');
        var orderId = \$('#orderId').val();
        var content = \$('#content').val();
        window.location.href=\"/order/all-order?excel=allorder&start_time=\"+start_time+'&end_time='+end_time+'&orderId='+orderId+'&content='+content;
    }

    function reloadgrid(){
        var queryParams = \$('#listdata').datagrid('options').queryParams;
        queryParams.start_time = \$('#start_time').datetimebox('getValue');
        queryParams.end_time = \$('#end_time').datetimebox('getValue');
        queryParams.orderId = \$('#orderId').val();
        queryParams.content = \$('#content').val();
        \$('#listdata').datagrid('options').queryParams = queryParams;
        \$(\"#listdata\").datagrid('reload');
    }
</script>
";
    }

    public function getTemplateName()
    {
        return "order.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  72 => 37,  69 => 36,  44 => 14,  32 => 4,  29 => 3,  11 => 1,);
    }
}
/* {% extends '@app/views/base.html' %}*/
/* */
/* {% block main %}*/
/* */
/* <div class="search">*/
/*     <span>开始时间<input type="text" name="start_time" id="start_time" class="easyui-datetimebox" ></span>*/
/*     <span>结束时间<input type="text" name="end_time" id="end_time" class="easyui-datetimebox" ></span>*/
/*     <span>订单号<input class="easyui-textbox" type="text" name="orderId" id="orderId"></span>*/
/*     <span>用户<input class="easyui-textbox" type="text" name="content" id="content"></span>*/
/*     <a href="javascript:void(0);" onclick="reloadgrid();" class="easyui-linkbutton" iconCls="icon-search">搜索</a>*/
/*     <a href="javascript:void(0);" class="easyui-linkbutton" onclick="dataexcel();">导出</a>*/
/* </div>*/
/* */
/* <table id="listdata"  class="easyui-datagrid" title="伙购列表" data-options="toolbar:'#tb-user',rownumbers:false,singleSelect:true,pagination:true,method:'get',url:'{{  url('order/all-order')}}',pageSize:20">*/
/*     <thead>*/
/*     <tr>*/
/*         <th data-options="field:'id', width:200, align:'center'">订单号</th>*/
/*         <th data-options="field:'name', width:300, align:'center'">商品名称</th>*/
/*         <th data-options="field:'cat', width:100, align:'center'">分类</th>*/
/*         <th data-options="field:'price', width:100, align:'center'">价格</th>*/
/*         <th data-options="field:'phone', width:150, align:'center'">会员手机</th>*/
/*         <th data-options="field:'email', width:150, align:'center'">会员邮箱</th>*/
/*         <th data-options="field:'nums', width:50, align:'center'">次数</th>*/
/*         <th data-options="field:'money', width:100, align:'center'">金额</th>*/
/*         <th data-options="field:'point', width:100, align:'center'">福分</th>*/
/*         <th data-options="field:'period_number', width:100, align:'center'">期数</th>*/
/*         <th data-options="field:'period_no', width:100, align:'center'">当前期号</th>*/
/*         <th data-options="field:'source', width:100, align:'center'">来源</th>*/
/*         <th data-options="field:'created_at', width:200, align:'center'">伙购时间</th>*/
/*     </tr>*/
/*     </thead>*/
/* </table>*/
/* */
/* {% endblock %}*/
/* */
/* {% block js %}*/
/* <script>*/
/*     function dataexcel(){*/
/*         var start_time = $('#start_time').datetimebox('getValue');*/
/*         var end_time = $('#end_time').datetimebox('getValue');*/
/*         var orderId = $('#orderId').val();*/
/*         var content = $('#content').val();*/
/*         window.location.href="/order/all-order?excel=allorder&start_time="+start_time+'&end_time='+end_time+'&orderId='+orderId+'&content='+content;*/
/*     }*/
/* */
/*     function reloadgrid(){*/
/*         var queryParams = $('#listdata').datagrid('options').queryParams;*/
/*         queryParams.start_time = $('#start_time').datetimebox('getValue');*/
/*         queryParams.end_time = $('#end_time').datetimebox('getValue');*/
/*         queryParams.orderId = $('#orderId').val();*/
/*         queryParams.content = $('#content').val();*/
/*         $('#listdata').datagrid('options').queryParams = queryParams;*/
/*         $("#listdata").datagrid('reload');*/
/*     }*/
/* </script>*/
/* {% endblock %}*/
/* */
/* */
