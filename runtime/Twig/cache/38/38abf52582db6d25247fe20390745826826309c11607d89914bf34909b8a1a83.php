<?php

/* address.html */
class __TwigTemplate_abde155743bb308c668b9e7e901951b5c77665b31e55dc5f45d13fb636fe2a45 extends yii\twig\Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("@app/views/base.html", "address.html", 1);
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
<table id=\"listdata\" class=\"easyui-datagrid\" title=\"收货地址列表\" data-options=\"singleSelect:false,pagination:true,method:'get',url:'";
        // line 11
        echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url("member/address", array("id" => (isset($context["id"]) ? $context["id"] : null))), "html", null, true);
        echo "',pageSize: 20\">
    <thead>
    <tr>
        <th data-options=\"field:'id', width:50, align:'center'\">编号</th>
        <th data-options=\"field:'name', width:100, align:'center'\">收货人</th>
        <th data-options=\"field:'mobilephone', width:200, align:'center'\">联系方式</th>
        <th data-options=\"field:'prov', width:100, align:'center'\">省</th>
        <th data-options=\"field:'city', width:100, align:'center'\">市</th>
        <th data-options=\"field:'area', width:200, align:'center'\">区县</th>
        <th data-options=\"field:'address', width:200, align:'center'\">详细地址</th>
        <th data-options=\"field:'create', width:200, align:'center'\" formatter=\"formatTime\">更新时间</th>
    </tr>
    </thead>
</table>

";
    }

    // line 28
    public function block_script($context, array $blocks = array())
    {
        // line 29
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
        return "address.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  64 => 29,  61 => 28,  41 => 11,  32 => 4,  29 => 3,  11 => 1,);
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
/* <table id="listdata" class="easyui-datagrid" title="收货地址列表" data-options="singleSelect:false,pagination:true,method:'get',url:'{{ url('member/address', {id: id}) }}',pageSize: 20">*/
/*     <thead>*/
/*     <tr>*/
/*         <th data-options="field:'id', width:50, align:'center'">编号</th>*/
/*         <th data-options="field:'name', width:100, align:'center'">收货人</th>*/
/*         <th data-options="field:'mobilephone', width:200, align:'center'">联系方式</th>*/
/*         <th data-options="field:'prov', width:100, align:'center'">省</th>*/
/*         <th data-options="field:'city', width:100, align:'center'">市</th>*/
/*         <th data-options="field:'area', width:200, align:'center'">区县</th>*/
/*         <th data-options="field:'address', width:200, align:'center'">详细地址</th>*/
/*         <th data-options="field:'create', width:200, align:'center'" formatter="formatTime">更新时间</th>*/
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
