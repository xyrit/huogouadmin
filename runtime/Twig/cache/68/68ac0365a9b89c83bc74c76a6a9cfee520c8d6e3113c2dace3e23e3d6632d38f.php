<?php

/* purchase-verify-list.html */
class __TwigTemplate_799c8b04bde530b6c0ba0385e94e563dfe642f852c6dd0ae6c7e5cd825fe4b75 extends yii\twig\Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("@app/views/base.html", "purchase-verify-list.html", 1);
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
    <span>订单编号 <input class=\"easyui-textbox\" type=\"text\" id=\"id\"></span>
    <span>创建人 <input class=\"easyui-combobox\" id=\"admin_id\" data-options=\"url:'";
        // line 6
        echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url("employee/admin-list"), "html", null, true);
        echo "',method:'get', valueField: 'id',textField: 'real_name',panelHeight:'auto'\" editable=\"true\"></span>
    <span>创建时间<input id=\"cstart\" class=\"easyui-datetimebox\" ></span>
    <span>到<input id=\"cend\" class=\"easyui-datetimebox\" ></span>
    <a href=\"javascript:void(0);\" onclick=\"reloadgrid();\" class=\"easyui-linkbutton\" iconCls=\"icon-search\">搜索</a>
</div>

<table id=\"listdata\" class=\"easyui-datagrid\" title=\"采购待审核列表\" data-options=\"toolbar:'#tb-user',rownumbers:true,singleSelect:true,pagination:true,method:'get', url:'";
        // line 12
        echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url("finance/purchase-verify-list"), "html", null, true);
        echo "',rownumbers: false\">
    <thead>
    <tr>
        <th data-options=\"field:'id', width:80, align:'center'\">订单编号</th>
        <th data-options=\"field:'money', width:80, align:'center'\">金额</th>
        <th data-options=\"field:'admin_id', width:100, align:'center'\">创建人</th>
        <th data-options=\"field:'created_at', width:200, align:'center'\">创建时间</th>
        <th data-options=\"field:'status', width:100, align:'center'\">订单状态</th>
    </tr>
    </thead>
</table>

<div id=\"tb-user\" style=\"height:auto\">
    <div>
        <a href=\"javascript:void(0)\" class=\"easyui-linkbutton\" data-options=\"iconCls:'icon-view',plain:true\" onclick=\"view()\">查看详情</a>
    </div>
</div>

<div class=\"easyui-window\" id=\"store_view\" title=\"采购详情\" style=\"width:1000px;height: 700px;\" data-options=\"closed:true,modal:true\">
    <iframe width=\"100%\" height=\"100%\" frameborder=\"0\" id=\"add_iframe\"></iframe>
</div>

";
    }

    // line 36
    public function block_js($context, array $blocks = array())
    {
        // line 37
        echo "<script>
    function reloadgrid(){
        var queryParams = \$('#listdata').datagrid('options').queryParams;
        queryParams.id\t= \$('#id').val();
        queryParams.admin_id\t= \$('#admin_id').combobox('getValue');
        queryParams.cstart\t= \$('#cstart').datetimebox('getValue');
        queryParams.cend\t= \$('#cend').datetimebox('getValue');
        \$('#listdata').datagrid('options').queryParams = queryParams;
        \$(\"#listdata\").datagrid('reload');
    }

    function view(){
        var selRow = \$('#listdata').datagrid('getSelected');
        if (!selRow) {
            \$.messager.alert('错误','请选择采购订单');
            return false;
        }
        \$('#add_iframe').prop('src', \"";
        // line 54
        echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url("finance/purchase-verify-view"), "html", null, true);
        echo "\" + '?id=' + selRow.id);
        \$('#store_view').window('open');
    }

</script>
";
    }

    public function getTemplateName()
    {
        return "purchase-verify-list.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  94 => 54,  75 => 37,  72 => 36,  45 => 12,  36 => 6,  32 => 4,  29 => 3,  11 => 1,);
    }
}
/* {% extends '@app/views/base.html' %}*/
/* */
/* {% block main %}*/
/* <div class="search">*/
/*     <span>订单编号 <input class="easyui-textbox" type="text" id="id"></span>*/
/*     <span>创建人 <input class="easyui-combobox" id="admin_id" data-options="url:'{{ url('employee/admin-list') }}',method:'get', valueField: 'id',textField: 'real_name',panelHeight:'auto'" editable="true"></span>*/
/*     <span>创建时间<input id="cstart" class="easyui-datetimebox" ></span>*/
/*     <span>到<input id="cend" class="easyui-datetimebox" ></span>*/
/*     <a href="javascript:void(0);" onclick="reloadgrid();" class="easyui-linkbutton" iconCls="icon-search">搜索</a>*/
/* </div>*/
/* */
/* <table id="listdata" class="easyui-datagrid" title="采购待审核列表" data-options="toolbar:'#tb-user',rownumbers:true,singleSelect:true,pagination:true,method:'get', url:'{{ url('finance/purchase-verify-list') }}',rownumbers: false">*/
/*     <thead>*/
/*     <tr>*/
/*         <th data-options="field:'id', width:80, align:'center'">订单编号</th>*/
/*         <th data-options="field:'money', width:80, align:'center'">金额</th>*/
/*         <th data-options="field:'admin_id', width:100, align:'center'">创建人</th>*/
/*         <th data-options="field:'created_at', width:200, align:'center'">创建时间</th>*/
/*         <th data-options="field:'status', width:100, align:'center'">订单状态</th>*/
/*     </tr>*/
/*     </thead>*/
/* </table>*/
/* */
/* <div id="tb-user" style="height:auto">*/
/*     <div>*/
/*         <a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-view',plain:true" onclick="view()">查看详情</a>*/
/*     </div>*/
/* </div>*/
/* */
/* <div class="easyui-window" id="store_view" title="采购详情" style="width:1000px;height: 700px;" data-options="closed:true,modal:true">*/
/*     <iframe width="100%" height="100%" frameborder="0" id="add_iframe"></iframe>*/
/* </div>*/
/* */
/* {% endblock %}*/
/* */
/* {% block js %}*/
/* <script>*/
/*     function reloadgrid(){*/
/*         var queryParams = $('#listdata').datagrid('options').queryParams;*/
/*         queryParams.id	= $('#id').val();*/
/*         queryParams.admin_id	= $('#admin_id').combobox('getValue');*/
/*         queryParams.cstart	= $('#cstart').datetimebox('getValue');*/
/*         queryParams.cend	= $('#cend').datetimebox('getValue');*/
/*         $('#listdata').datagrid('options').queryParams = queryParams;*/
/*         $("#listdata").datagrid('reload');*/
/*     }*/
/* */
/*     function view(){*/
/*         var selRow = $('#listdata').datagrid('getSelected');*/
/*         if (!selRow) {*/
/*             $.messager.alert('错误','请选择采购订单');*/
/*             return false;*/
/*         }*/
/*         $('#add_iframe').prop('src', "{{ url('finance/purchase-verify-view') }}" + '?id=' + selRow.id);*/
/*         $('#store_view').window('open');*/
/*     }*/
/* */
/* </script>*/
/* {% endblock %}*/
