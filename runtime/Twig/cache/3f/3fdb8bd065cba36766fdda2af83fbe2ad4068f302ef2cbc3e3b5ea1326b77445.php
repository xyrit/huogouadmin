<?php

/* index.html */
class __TwigTemplate_97716e7cd3559b6e874fc4ca6f28844b155c89d7d86f37537ddccd24bc1dc144 extends yii\twig\Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("@app/views/base.html", "index.html", 1);
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
    <span>用户<input class=\"easyui-textbox\" type=\"text\" name=\"account\" id=\"account\"></span>
    <span>获奖订单<input class=\"easyui-textbox\" type=\"text\" name=\"orderid\" id=\"orderid\"></span>
    <a href=\"javascript:void(0);\" onclick=\"reloadgrid();\" class=\"easyui-linkbutton\" iconCls=\"icon-search\">搜索</a>
    <a href=\"javascript:void(0);\" class=\"easyui-linkbutton\" onclick=\"dataexcel();\">导出</a>
</div>

<table id=\"listdata\" class=\"easyui-datagrid\" title=\"虚拟物品列表\" data-options=\"toolbar:'#tb-user',singleSelect:true,pagination:true,method:'get',url:'";
        // line 15
        echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url("virtual/index"), "html", null, true);
        echo "',nowrap:false,rownumbers: false\">
    <thead>
    <tr>
        <th data-options=\"field:'id', width:150, align:'center'\">编号</th>
        <th data-options=\"field:'uid', width:180, align:'center'\" formatter=\"formatUsername\">用户</th>
        <th data-options=\"field:'orderid', width:180, align:'center'\">获奖订单id</th>
        <th data-options=\"field:'par_value',width:100, align:'center'\">面值</th>
        <th data-options=\"field:'card', width:180, align:'center'\">卡号</th>
        <th data-options=\"field:'create_time', width:180, align:'center'\">获取时间</th>
        <th data-options=\"field:'width', width:150, align:'center'\" formatter=\"formatStatus\">是否查看卡密</th>
        <th data-options=\"field:'update_time', width:180, align:'center'\" >更新时间</th>
    </tr>
    </thead>
</table>

";
    }

    // line 32
    public function block_js($context, array $blocks = array())
    {
        // line 33
        echo "<script>
    function dataexcel(){
        var start_time = \$('#startTime').datetimebox('getValue');
        var end_time = \$('#endTime').datetimebox('getValue');
        var orderid = \$('#orderid').val();
        var account = \$('#account').val();
        window.location.href=\"/virtual/index?excel=virtual&start_time=\"+start_time+'&end_time='+end_time+'&orderid='+orderid+'&account='+account;
    }

    function reloadgrid(){
        var queryParams = \$('#listdata').datagrid('options').queryParams;
        queryParams.startTime = \$('#startTime').datetimebox('getValue');
        queryParams.endTime\t= \$('#endTime').datetimebox('getValue');
        queryParams.account = \$('#account').val();
        queryParams.orderid = \$('#orderid').val();
        \$('#listdata').datagrid('options').queryParams = queryParams;
        \$(\"#listdata\").datagrid('reload');
    }

    function formatUsername(val, row)
    {
        if(val.email == null ) return val.phone;
        if(val.phone == null) return val.email;
        if(val.email != null && val.phone != null) return val.phone + '<br />' + val.email;
    }

    function formatStatus(val, row)
    {
        if(val == 0) return '否';
        else return '是';
    }

</script>
";
    }

    public function getTemplateName()
    {
        return "index.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  68 => 33,  65 => 32,  45 => 15,  32 => 4,  29 => 3,  11 => 1,);
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
/*     <span>用户<input class="easyui-textbox" type="text" name="account" id="account"></span>*/
/*     <span>获奖订单<input class="easyui-textbox" type="text" name="orderid" id="orderid"></span>*/
/*     <a href="javascript:void(0);" onclick="reloadgrid();" class="easyui-linkbutton" iconCls="icon-search">搜索</a>*/
/*     <a href="javascript:void(0);" class="easyui-linkbutton" onclick="dataexcel();">导出</a>*/
/* </div>*/
/* */
/* <table id="listdata" class="easyui-datagrid" title="虚拟物品列表" data-options="toolbar:'#tb-user',singleSelect:true,pagination:true,method:'get',url:'{{  url('virtual/index')}}',nowrap:false,rownumbers: false">*/
/*     <thead>*/
/*     <tr>*/
/*         <th data-options="field:'id', width:150, align:'center'">编号</th>*/
/*         <th data-options="field:'uid', width:180, align:'center'" formatter="formatUsername">用户</th>*/
/*         <th data-options="field:'orderid', width:180, align:'center'">获奖订单id</th>*/
/*         <th data-options="field:'par_value',width:100, align:'center'">面值</th>*/
/*         <th data-options="field:'card', width:180, align:'center'">卡号</th>*/
/*         <th data-options="field:'create_time', width:180, align:'center'">获取时间</th>*/
/*         <th data-options="field:'width', width:150, align:'center'" formatter="formatStatus">是否查看卡密</th>*/
/*         <th data-options="field:'update_time', width:180, align:'center'" >更新时间</th>*/
/*     </tr>*/
/*     </thead>*/
/* </table>*/
/* */
/* {% endblock %}*/
/* */
/* {% block js %}*/
/* <script>*/
/*     function dataexcel(){*/
/*         var start_time = $('#startTime').datetimebox('getValue');*/
/*         var end_time = $('#endTime').datetimebox('getValue');*/
/*         var orderid = $('#orderid').val();*/
/*         var account = $('#account').val();*/
/*         window.location.href="/virtual/index?excel=virtual&start_time="+start_time+'&end_time='+end_time+'&orderid='+orderid+'&account='+account;*/
/*     }*/
/* */
/*     function reloadgrid(){*/
/*         var queryParams = $('#listdata').datagrid('options').queryParams;*/
/*         queryParams.startTime = $('#startTime').datetimebox('getValue');*/
/*         queryParams.endTime	= $('#endTime').datetimebox('getValue');*/
/*         queryParams.account = $('#account').val();*/
/*         queryParams.orderid = $('#orderid').val();*/
/*         $('#listdata').datagrid('options').queryParams = queryParams;*/
/*         $("#listdata").datagrid('reload');*/
/*     }*/
/* */
/*     function formatUsername(val, row)*/
/*     {*/
/*         if(val.email == null ) return val.phone;*/
/*         if(val.phone == null) return val.email;*/
/*         if(val.email != null && val.phone != null) return val.phone + '<br />' + val.email;*/
/*     }*/
/* */
/*     function formatStatus(val, row)*/
/*     {*/
/*         if(val == 0) return '否';*/
/*         else return '是';*/
/*     }*/
/* */
/* </script>*/
/* {% endblock %}*/
