<?php

/* winning.html */
class __TwigTemplate_96a826441d010b1049f19a36533386e1c4fec57883919b74cda544fb2fdbc578 extends yii\twig\Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("@app/views/base.html", "winning.html", 1);
        $this->blocks = array(
            'main' => array($this, 'block_main'),
            'script' => array($this, 'block_script'),
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
    <span>时间
        <input class=\"easyui-datetimebox\" style=\"width:200px\" name=\"startTime\" id=\"startTime\"> 到
        <input class=\"easyui-datetimebox\" style=\"width:200px\" name=\"endTime\" id=\"endTime\">
    </span>
    <a href=\"javascript:void(0);\" onclick=\"reloadgrid();\" class=\"easyui-linkbutton\" iconCls=\"icon-search\">搜索</a>
</div>
<table id=\"listdata\" class=\"easyui-datagrid\" title=\"中奖列表\" data-options=\"singleSelect:false,pagination:true,method:'get',url:'";
        // line 11
        echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url("member/winning", array("id" => (isset($context["id"]) ? $context["id"] : null))), "html", null, true);
        echo "',pageSize: 20\">
    <thead>
    <tr>
        <th data-options=\"field:'payment_order_id', width:200, align:'center'\">订单号</th>
        <th data-options=\"field:'goods_name', width:300, align:'center'\">商品名称</th>
        <th data-options=\"field:'category_name', width:100, align:'center'\">分类</th>
        <th data-options=\"field:'goods_price', width:100, align:'center'\">伙购价格</th>
        <th data-options=\"field:'period_number', width:50, align:'center'\">期数</th>
        <th data-options=\"field:'lucky_code', width:100, align:'center'\">伙购码</th>
        <th data-options=\"field:'status_name', width:100, align:'center'\">状态</th>
        <th data-options=\"field:'delivery', width:100, align:'center'\">发货方式</th>
        <th data-options=\"field:'user_order_time', width:180, align:'center'\" formatter=\"formatTime\">中奖时间</th>
    </tr>
    </thead>
</table>

";
    }

    // line 29
    public function block_script($context, array $blocks = array())
    {
        // line 30
        echo "<script>
    function reloadgrid(){
        var queryParams = \$('#listdata').datagrid('options').queryParams;
        queryParams.startTime = \$('#startTime').datetimebox('getValue');
        queryParams.endTime\t= \$('#endTime').datetimebox('getValue');
        \$('#listdata').datagrid('options').queryParams = queryParams;
        \$(\"#listdata\").datagrid('reload');
    }
    function formatTime(val, row) {
        var newDate_attend = new Date();
        newDate_attend.setTime(val * 1000);
        var my_create_time_attend=newDate_attend.format('yyyy-MM-dd hh:mm:ss');
        return my_create_time_attend;
    }
</script>
";
    }

    public function getTemplateName()
    {
        return "winning.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  65 => 30,  62 => 29,  41 => 11,  32 => 4,  29 => 3,  11 => 1,);
    }
}
/* {% extends '@app/views/base.html' %}*/
/* */
/* {% block main %}*/
/* <div class="search">*/
/*     <span>时间*/
/*         <input class="easyui-datetimebox" style="width:200px" name="startTime" id="startTime"> 到*/
/*         <input class="easyui-datetimebox" style="width:200px" name="endTime" id="endTime">*/
/*     </span>*/
/*     <a href="javascript:void(0);" onclick="reloadgrid();" class="easyui-linkbutton" iconCls="icon-search">搜索</a>*/
/* </div>*/
/* <table id="listdata" class="easyui-datagrid" title="中奖列表" data-options="singleSelect:false,pagination:true,method:'get',url:'{{ url('member/winning', {id: id}) }}',pageSize: 20">*/
/*     <thead>*/
/*     <tr>*/
/*         <th data-options="field:'payment_order_id', width:200, align:'center'">订单号</th>*/
/*         <th data-options="field:'goods_name', width:300, align:'center'">商品名称</th>*/
/*         <th data-options="field:'category_name', width:100, align:'center'">分类</th>*/
/*         <th data-options="field:'goods_price', width:100, align:'center'">伙购价格</th>*/
/*         <th data-options="field:'period_number', width:50, align:'center'">期数</th>*/
/*         <th data-options="field:'lucky_code', width:100, align:'center'">伙购码</th>*/
/*         <th data-options="field:'status_name', width:100, align:'center'">状态</th>*/
/*         <th data-options="field:'delivery', width:100, align:'center'">发货方式</th>*/
/*         <th data-options="field:'user_order_time', width:180, align:'center'" formatter="formatTime">中奖时间</th>*/
/*     </tr>*/
/*     </thead>*/
/* </table>*/
/* */
/* {% endblock %}*/
/* */
/* {% block script %}*/
/* <script>*/
/*     function reloadgrid(){*/
/*         var queryParams = $('#listdata').datagrid('options').queryParams;*/
/*         queryParams.startTime = $('#startTime').datetimebox('getValue');*/
/*         queryParams.endTime	= $('#endTime').datetimebox('getValue');*/
/*         $('#listdata').datagrid('options').queryParams = queryParams;*/
/*         $("#listdata").datagrid('reload');*/
/*     }*/
/*     function formatTime(val, row) {*/
/*         var newDate_attend = new Date();*/
/*         newDate_attend.setTime(val * 1000);*/
/*         var my_create_time_attend=newDate_attend.format('yyyy-MM-dd hh:mm:ss');*/
/*         return my_create_time_attend;*/
/*     }*/
/* </script>*/
/* {% endblock %}*/
