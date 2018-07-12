<?php

/* order.html */
class __TwigTemplate_b347c6c2aa8b15c9c9c3a0f262437f0d124bd8aa5ab046fd37df95eb8f75dd14 extends yii\twig\Template
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
        echo "<table id=\"listdata\"  class=\"easyui-datagrid\" title=\"采购记录\" data-options=\"toolbar:'#tb-user',singleSelect:true,pagination:true,method:'get',url:'";
        echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url("purchase/order"), "html", null, true);
        echo "',mode:'local',pageSize:20\">
    <thead>
    <tr>
        <th data-options=\"field:'id', width:100, align:'center'\">订单编号</th>
        <th data-options=\"field:'product_name', width:200, align:'center'\">商品名称</th>
        <th data-options=\"field:'type', width:150, align:'center'\" formatter=\"formatType\">类型</th>
        <th data-options=\"field:'nums', width:100, align:'center'\">采购数量</th>
        <th data-options=\"field:'total', width:100, align:'center'\">总金额</th>
        <th data-options=\"field:'order_status', width:100, align:'center'\" formatter=\"formOrderStatus\">状态</th>
        <th data-options=\"field:'status', width:100, align:'center'\">进度</th>
        <th data-options=\"field:'last_update_time', width:200, align:'center'\">最后更新时间</th>
    </tr>
    </thead>
</table>

<div id=\"tb-user\" style=\"height:auto\">
    <div>
        <a href=\"javascript:void(0)\" class=\"easyui-linkbutton\" data-options=\"iconCls:'icon-add',plain:true\" onclick=\"view()\">详情</a>
    </div>
</div>

<div id=\"dlg-view\" class=\"easyui-window\" title=\"采购订单详情\" style=\"width:630px;height:700px;padding:10px;overflow:hidden;\" data-options=\"
            iconCls:'icon-save',
            closed:true,
            modal:true,
            onResize:function(){
                \$(this).window('hcenter');
            }\">
    <iframe width=\"100%\" height=\"100%\" frameborder=\"0\" id=\"view_iframe\">
    </iframe>
</div>
";
    }

    // line 37
    public function block_js($context, array $blocks = array())
    {
        // line 38
        echo "<script>

    function view()
    {
        var selRow = \$('#listdata').datagrid('getSelected');
        if (!selRow) {
            \$.messager.alert('错误','请选择一行');
            return false;
        }
        \$('#view_iframe').prop('src', \"";
        // line 47
        echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url("/purchase/order-view"), "html", null, true);
        echo "\" + '?id=' + selRow.id);
        \$('#dlg-view').window('open');
    }

    function formatType(val, row)
    {
        if(val == 1) return '实物';
        else if(val == 2) return '虚拟物品';
    }

    function formOrderStatus(val, row)
    {
        if(val == 0) return '未返回';
        else if(val == 1) return '成功';
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
        return array (  83 => 47,  72 => 38,  69 => 37,  32 => 4,  29 => 3,  11 => 1,);
    }
}
/* {% extends '@app/views/base.html' %}*/
/* */
/* {% block main %}*/
/* <table id="listdata"  class="easyui-datagrid" title="采购记录" data-options="toolbar:'#tb-user',singleSelect:true,pagination:true,method:'get',url:'{{  url('purchase/order')}}',mode:'local',pageSize:20">*/
/*     <thead>*/
/*     <tr>*/
/*         <th data-options="field:'id', width:100, align:'center'">订单编号</th>*/
/*         <th data-options="field:'product_name', width:200, align:'center'">商品名称</th>*/
/*         <th data-options="field:'type', width:150, align:'center'" formatter="formatType">类型</th>*/
/*         <th data-options="field:'nums', width:100, align:'center'">采购数量</th>*/
/*         <th data-options="field:'total', width:100, align:'center'">总金额</th>*/
/*         <th data-options="field:'order_status', width:100, align:'center'" formatter="formOrderStatus">状态</th>*/
/*         <th data-options="field:'status', width:100, align:'center'">进度</th>*/
/*         <th data-options="field:'last_update_time', width:200, align:'center'">最后更新时间</th>*/
/*     </tr>*/
/*     </thead>*/
/* </table>*/
/* */
/* <div id="tb-user" style="height:auto">*/
/*     <div>*/
/*         <a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-add',plain:true" onclick="view()">详情</a>*/
/*     </div>*/
/* </div>*/
/* */
/* <div id="dlg-view" class="easyui-window" title="采购订单详情" style="width:630px;height:700px;padding:10px;overflow:hidden;" data-options="*/
/*             iconCls:'icon-save',*/
/*             closed:true,*/
/*             modal:true,*/
/*             onResize:function(){*/
/*                 $(this).window('hcenter');*/
/*             }">*/
/*     <iframe width="100%" height="100%" frameborder="0" id="view_iframe">*/
/*     </iframe>*/
/* </div>*/
/* {% endblock %}*/
/* */
/* {% block js %}*/
/* <script>*/
/* */
/*     function view()*/
/*     {*/
/*         var selRow = $('#listdata').datagrid('getSelected');*/
/*         if (!selRow) {*/
/*             $.messager.alert('错误','请选择一行');*/
/*             return false;*/
/*         }*/
/*         $('#view_iframe').prop('src', "{{ url('/purchase/order-view') }}" + '?id=' + selRow.id);*/
/*         $('#dlg-view').window('open');*/
/*     }*/
/* */
/*     function formatType(val, row)*/
/*     {*/
/*         if(val == 1) return '实物';*/
/*         else if(val == 2) return '虚拟物品';*/
/*     }*/
/* */
/*     function formOrderStatus(val, row)*/
/*     {*/
/*         if(val == 0) return '未返回';*/
/*         else if(val == 1) return '成功';*/
/*     }*/
/* </script>*/
/* {% endblock %}*/
