<?php

/* storage-list.html */
class __TwigTemplate_46ed67e8ee2ab9866253c563c9adf399a8f1997ea06324e1a51fca0b0cab8c39 extends yii\twig\Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("@app/views/base.html", "storage-list.html", 1);
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
    <span>操作人<input class=\"easyui-combobox\"  id=\"stored_admin_id\" data-options=\"url:'";
        // line 9
        echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url("employee/admin-list"), "html", null, true);
        echo "',method:'get', valueField: 'id',textField: 'real_name',panelHeight:'auto'\" editable=\"true\"></span>
    <span>入库时间<input type=\"text\"  id=\"sstart\" class=\"easyui-datetimebox\" ></span>
    <span>到<input type=\"text\" id=\"send\" class=\"easyui-datetimebox\" ></span>
    <a href=\"javascript:void(0);\" onclick=\"reloadgrid();\" class=\"easyui-linkbutton\" iconCls=\"icon-search\">搜索</a>
</div>

<table id=\"listdata\" class=\"easyui-datagrid\" title=\"商品列表\" data-options=\"toolbar:'#tb-user',rownumbers:true,singleSelect:true,pagination:true,method:'get', url:'";
        // line 15
        echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url("purchase/store"), "html", null, true);
        echo "',rownumbers: false\">
    <thead>
    <tr>
        <th data-options=\"field:'id', width:80, align:'center'\">订单编号</th>
        <th data-options=\"field:'admin_name', width:100, align:'center'\">创建人</th>
        <th data-options=\"field:'created_at', width:200, align:'center'\" formatter=\"formatTime\">创建时间</th>
        <th data-options=\"field:'status', width:100, align:'center'\" formatter=\"formatStatus\">订单状态</th>
        <th data-options=\"field:'stored_admin_name', width:100, align:'center'\">操作人</th>
        <th data-options=\"field:'stored_at', width:150\" formatter=\"formatTime\">操作时间</th>
    </tr>
    </thead>
</table>

<div id=\"tb-user\" style=\"height:auto\">
    <div>
        ";
        // line 30
        if (((isset($context["view"]) ? $context["view"] : null) == 1)) {
            // line 31
            echo "        <a href=\"javascript:void(0)\" class=\"easyui-linkbutton\" data-options=\"iconCls:'icon-view',plain:true\" onclick=\"view()\">查看详情</a>
        ";
        }
        // line 33
        echo "    </div>
</div>

<div class=\"easyui-window\" id=\"store_view\" title=\"采购订单\" style=\"width:1000px;height: 700px;\" data-options=\"closed:true,modal:true\">
    <iframe width=\"100%\" height=\"100%\" frameborder=\"0\" id=\"add_iframe\"></iframe>
</div>

";
    }

    // line 42
    public function block_js($context, array $blocks = array())
    {
        // line 43
        echo "<script>
    function reloadgrid(){
        var queryParams = \$('#listdata').datagrid('options').queryParams;
        queryParams.id\t= \$('#id').val();
        queryParams.admin_id\t= \$('#admin_id').combobox('getValue');
        queryParams.stored_admin_id\t= \$('#stored_admin_id').combobox('getValue');
        queryParams.sstart\t= \$('#sstart').datetimebox('getValue');
        queryParams.send\t= \$('#send').datetimebox('getValue');
        queryParams.cstart\t= \$('#cstart').datetimebox('getValue');
        queryParams.cend\t= \$('#cend').datetimebox('getValue');
        \$('#listdata').datagrid('options').queryParams = queryParams;
        \$(\"#listdata\").datagrid('reload');
    }

    function view(){
        var selRow = \$('#listdata').datagrid('getSelected');
        if (!selRow) {
            \$.messager.alert('错误','请选择商品');
            return false;
        }
        \$('#add_iframe').prop('src', \"";
        // line 63
        echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url("purchase/enter-store"), "html", null, true);
        echo "\" + '?id=' + selRow.id);
        \$('#store_view').window('open');
    }

    function formatStatus(val, row){
        if(val == 0) return '<span color=\"red\">待审核</span>';
        else if(val == 1 && row.stored_at == 0) return '<span style=\"color:red\">待入库</span>';
        else if(val == 1 && row.stored_at != 0) return '已入库';
        else if(val == 2) return '未通过';
    }

</script>
";
    }

    public function getTemplateName()
    {
        return "storage-list.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  111 => 63,  89 => 43,  86 => 42,  75 => 33,  71 => 31,  69 => 30,  51 => 15,  42 => 9,  36 => 6,  32 => 4,  29 => 3,  11 => 1,);
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
/*     <span>操作人<input class="easyui-combobox"  id="stored_admin_id" data-options="url:'{{ url('employee/admin-list') }}',method:'get', valueField: 'id',textField: 'real_name',panelHeight:'auto'" editable="true"></span>*/
/*     <span>入库时间<input type="text"  id="sstart" class="easyui-datetimebox" ></span>*/
/*     <span>到<input type="text" id="send" class="easyui-datetimebox" ></span>*/
/*     <a href="javascript:void(0);" onclick="reloadgrid();" class="easyui-linkbutton" iconCls="icon-search">搜索</a>*/
/* </div>*/
/* */
/* <table id="listdata" class="easyui-datagrid" title="商品列表" data-options="toolbar:'#tb-user',rownumbers:true,singleSelect:true,pagination:true,method:'get', url:'{{ url('purchase/store') }}',rownumbers: false">*/
/*     <thead>*/
/*     <tr>*/
/*         <th data-options="field:'id', width:80, align:'center'">订单编号</th>*/
/*         <th data-options="field:'admin_name', width:100, align:'center'">创建人</th>*/
/*         <th data-options="field:'created_at', width:200, align:'center'" formatter="formatTime">创建时间</th>*/
/*         <th data-options="field:'status', width:100, align:'center'" formatter="formatStatus">订单状态</th>*/
/*         <th data-options="field:'stored_admin_name', width:100, align:'center'">操作人</th>*/
/*         <th data-options="field:'stored_at', width:150" formatter="formatTime">操作时间</th>*/
/*     </tr>*/
/*     </thead>*/
/* </table>*/
/* */
/* <div id="tb-user" style="height:auto">*/
/*     <div>*/
/*         {% if(view == 1) %}*/
/*         <a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-view',plain:true" onclick="view()">查看详情</a>*/
/*         {% endif %}*/
/*     </div>*/
/* </div>*/
/* */
/* <div class="easyui-window" id="store_view" title="采购订单" style="width:1000px;height: 700px;" data-options="closed:true,modal:true">*/
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
/*         queryParams.stored_admin_id	= $('#stored_admin_id').combobox('getValue');*/
/*         queryParams.sstart	= $('#sstart').datetimebox('getValue');*/
/*         queryParams.send	= $('#send').datetimebox('getValue');*/
/*         queryParams.cstart	= $('#cstart').datetimebox('getValue');*/
/*         queryParams.cend	= $('#cend').datetimebox('getValue');*/
/*         $('#listdata').datagrid('options').queryParams = queryParams;*/
/*         $("#listdata").datagrid('reload');*/
/*     }*/
/* */
/*     function view(){*/
/*         var selRow = $('#listdata').datagrid('getSelected');*/
/*         if (!selRow) {*/
/*             $.messager.alert('错误','请选择商品');*/
/*             return false;*/
/*         }*/
/*         $('#add_iframe').prop('src', "{{ url('purchase/enter-store') }}" + '?id=' + selRow.id);*/
/*         $('#store_view').window('open');*/
/*     }*/
/* */
/*     function formatStatus(val, row){*/
/*         if(val == 0) return '<span color="red">待审核</span>';*/
/*         else if(val == 1 && row.stored_at == 0) return '<span style="color:red">待入库</span>';*/
/*         else if(val == 1 && row.stored_at != 0) return '已入库';*/
/*         else if(val == 2) return '未通过';*/
/*     }*/
/* */
/* </script>*/
/* {% endblock %}*/
