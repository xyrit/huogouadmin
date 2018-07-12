<?php

/* share.html */
class __TwigTemplate_ed5a8a7a5605b1a64bd075b5affa60c7041c82e01f55adf9b98c696d21e273d1 extends yii\twig\Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("@app/views/base.html", "share.html", 1);
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
<table id=\"listdata\" class=\"easyui-datagrid\" title=\"晒单列表\" data-options=\"singleSelect:false,pagination:true,method:'get',url:'";
        // line 11
        echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url("member/share", array("id" => (isset($context["id"]) ? $context["id"] : null))), "html", null, true);
        echo "',pageSize: 20\">
    <thead>
    <tr>
        <th data-options=\"field:'payment_order_id', width:200, align:'center'\">订单号</th>
        <th data-options=\"field:'goods_name', width:300, align:'center'\">商品名称</th>
        <th data-options=\"field:'category_name', width:100, align:'center'\">分类</th>
        <th data-options=\"field:'goods_price', width:100, align:'center'\">伙购价格</th>
        <th data-options=\"field:'period_number', width:50, align:'center'\">期数</th>
        <th data-options=\"field:'point', width:100, align:'center'\">奖励福分</th>
        <th data-options=\"field:'is_recommend', width:50, align:'center'\" formatter=\"formatRecommend\">推荐</th>
        <th data-options=\"field:'is_digest', width:50, align:'center'\" formatter=\"formatRecommend\">精华</th>
        <th data-options=\"field:'status', width:100, align:'center'\" formatter=\"formatStatus\">状态</th>
        <th data-options=\"field:'user_share_time', width:180, align:'center'\" formatter=\"formatTime\">晒单时间</th>
    </tr>
    </thead>
</table>

";
    }

    // line 30
    public function block_script($context, array $blocks = array())
    {
        // line 31
        echo "<script>
    function reloadgrid(){
        var queryParams = \$('#listdata').datagrid('options').queryParams;
        queryParams.startTime = \$('#startTime').datetimebox('getValue');
        queryParams.endTime\t= \$('#endTime').datetimebox('getValue');
        \$('#listdata').datagrid('options').queryParams = queryParams;
        \$(\"#listdata\").datagrid('reload');
    }
    function formatRecommend(val, row) {
        return val == 1 ? '是' : '否';
    }
    function formatStatus(val, row) {
        return val == 0 ? '未审核' : (val == 1 ? '审核通过' : '审核未通过');
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
        return "share.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  66 => 31,  63 => 30,  41 => 11,  32 => 4,  29 => 3,  11 => 1,);
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
/* <table id="listdata" class="easyui-datagrid" title="晒单列表" data-options="singleSelect:false,pagination:true,method:'get',url:'{{ url('member/share', {id: id}) }}',pageSize: 20">*/
/*     <thead>*/
/*     <tr>*/
/*         <th data-options="field:'payment_order_id', width:200, align:'center'">订单号</th>*/
/*         <th data-options="field:'goods_name', width:300, align:'center'">商品名称</th>*/
/*         <th data-options="field:'category_name', width:100, align:'center'">分类</th>*/
/*         <th data-options="field:'goods_price', width:100, align:'center'">伙购价格</th>*/
/*         <th data-options="field:'period_number', width:50, align:'center'">期数</th>*/
/*         <th data-options="field:'point', width:100, align:'center'">奖励福分</th>*/
/*         <th data-options="field:'is_recommend', width:50, align:'center'" formatter="formatRecommend">推荐</th>*/
/*         <th data-options="field:'is_digest', width:50, align:'center'" formatter="formatRecommend">精华</th>*/
/*         <th data-options="field:'status', width:100, align:'center'" formatter="formatStatus">状态</th>*/
/*         <th data-options="field:'user_share_time', width:180, align:'center'" formatter="formatTime">晒单时间</th>*/
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
/*     function formatRecommend(val, row) {*/
/*         return val == 1 ? '是' : '否';*/
/*     }*/
/*     function formatStatus(val, row) {*/
/*         return val == 0 ? '未审核' : (val == 1 ? '审核通过' : '审核未通过');*/
/*     }*/
/*     function formatTime(val, row) {*/
/*         var newDate_attend = new Date();*/
/*         newDate_attend.setTime(val * 1000);*/
/*         var my_create_time_attend=newDate_attend.format('yyyy-MM-dd hh:mm:ss');*/
/*         return my_create_time_attend;*/
/*     }*/
/* </script>*/
/* {% endblock %}*/
