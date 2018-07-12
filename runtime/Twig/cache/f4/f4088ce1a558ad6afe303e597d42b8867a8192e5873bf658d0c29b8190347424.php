<?php

/* index.html */
class __TwigTemplate_49c9e19a6732ee3ec40320cf0d4a9f88908879bc28496b9cf1e08ee813362596 extends yii\twig\Template
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
        echo "
<div class=\"search\">
    <span>订单编号
        <input class=\"easyui-textbox\" type=\"text\" name=\"orderId\" id=\"orderId\">
    </span>
    <span>创建人
        <select class=\"easyui-combobox\" id=\"adminId\" editable=\"true\" style=\"width:100px;\" data-options=\"url: '";
        // line 10
        echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url("/employee/list"), "html", null, true);
        echo "', valueField: 'id', textField: 'name'\"></select>
    </span>
    <span>创建时间
        <input class=\"easyui-datetimebox\" style=\"width:200px\" name=\"startTime\" id=\"startTime\"> 到
        <input class=\"easyui-datetimebox\" style=\"width:200px\" name=\"endTime\" id=\"endTime\">
    </span>
    <a href=\"javascript:void(0);\" onclick=\"reloadgrid();\" class=\"easyui-linkbutton\" iconCls=\"icon-search\">搜索</a>
</div>

<table id=\"listdata\"  class=\"easyui-datagrid\" title=\"采购订单列表\" data-options=\"toolbar:'#tb-user',singleSelect:true,pagination:true,method:'get',url:'";
        // line 19
        echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url("purchase/index"), "html", null, true);
        echo "',mode:'local',pageSize:20\">
    <thead>
    <tr>
        <th data-options=\"field:'id', width:150, align:'center'\">订单编号</th>
        <th data-options=\"field:'money', width:100, align:'center'\">订单金额</th>
        <th data-options=\"field:'admin_name', width:100, align:'center'\">创建人</th>
        <th data-options=\"field:'created_at', width:180, align:'center'\" formatter=\"formatTime\">创建时间</th>
        <th data-options=\"field:'status', width:100, align:'center'\" formatter=\"formatStatus\">订单状态</th>
        <th data-options=\"field:'approved_name', width:100, align:'center'\">审核人</th>
        <th data-options=\"field:'note', width:100, align:'center'\">备注</th>
    </tr>
    </thead>
</table>

<div id=\"tb-user\" style=\"height:auto\">
    <div>
        ";
        // line 35
        if (((isset($context["add"]) ? $context["add"] : null) == 1)) {
            // line 36
            echo "        <a href=\"javascript:void(0)\" class=\"easyui-linkbutton\" data-options=\"iconCls:'icon-add',plain:true\" onclick=\"add()\">新增</a>
        ";
        }
        // line 38
        echo "        ";
        if (((isset($context["edit"]) ? $context["edit"] : null) == 1)) {
            // line 39
            echo "        <a href=\"javascript:void(0)\" class=\"easyui-linkbutton\" data-options=\"iconCls:'icon-edit',plain:true\" onclick=\"edit()\">编辑</a>
        ";
        }
        // line 41
        echo "        ";
        if (((isset($context["view"]) ? $context["view"] : null) == 1)) {
            // line 42
            echo "        <a href=\"javascript:void(0)\" class=\"easyui-linkbutton\" data-options=\"iconCls:'icon-tip',plain:true\" onclick=\"view()\">详情</a>
        ";
        }
        // line 44
        echo "        ";
        if (((isset($context["del"]) ? $context["del"] : null) == 1)) {
            // line 45
            echo "        <!--<a href=\"javascript:void(0)\" class=\"easyui-linkbutton\" data-options=\"iconCls:'icon-no',plain:true\" onclick=\"del()\">删除</a>-->
        ";
        }
        // line 47
        echo "    </div>
</div>

<div id=\"dlg-add\" class=\"easyui-window\" title=\"新增采购订单\" style=\"width:1198px;height:750px;padding:10px;overflow:hidden;\" data-options=\"
            iconCls:'icon-save',
            closed:true,
            modal:true,
            onResize:function(){
                \$(this).window('hcenter');
            }\">
    <iframe width=\"100%\" height=\"100%\" frameborder=\"0\" id=\"add_iframe\">
    </iframe>
</div>

<div id=\"dlg-edit\" class=\"easyui-window\" title=\"编辑采购订单\" style=\"width:1198px;height:750px;padding:10px;overflow:hidden;\" data-options=\"
            iconCls:'icon-save',
            closed:true,
            modal:true,
            onResize:function(){
                \$(this).window('hcenter');
            }\">
    <iframe width=\"100%\" height=\"100%\" frameborder=\"0\" id=\"edit_iframe\">
    </iframe>
</div>

<div id=\"dlg-view\" class=\"easyui-window\" title=\"采购订单详情\" style=\"width:1198px;height:750px;padding:10px;overflow:hidden;\" data-options=\"
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

    // line 85
    public function block_js($context, array $blocks = array())
    {
        // line 86
        echo "<script>
    function reloadgrid(){
        var queryParams = \$('#listdata').datagrid('options').queryParams;
        queryParams.orderId = \$('#orderId').val();
        queryParams.adminId = \$('#adminId').combobox('getValue');
        queryParams.startTime = \$('#startTime').datetimebox('getValue');
        queryParams.endTime\t= \$('#endTime').datetimebox('getValue');
        \$('#listdata').datagrid('options').queryParams = queryParams;
        \$(\"#listdata\").datagrid('reload');
    }

    function formatStatus(val, row) {
        if (val == 0) {
            return '提交待审';
        } else if (val == 1) {
            return '审核通过';
        } else if (val == 2) {
            return '审核不通过';
        }
    }

    function add() {
        \$('#add_iframe').prop('src', \"";
        // line 108
        echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url("purchase/add"), "html", null, true);
        echo "\");
        \$('#dlg-add').window('open');
    }

    function edit() {
        var selRow = \$('#listdata').datagrid('getSelected');
        if (!selRow) {
            \$.messager.alert('错误','请选择一行');
            return false;
        }
        \$('#edit_iframe').prop('src', \"";
        // line 118
        echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url("purchase/edit"), "html", null, true);
        echo "\" + '?id=' + selRow.id);
        \$('#dlg-edit').window('open');
    }

    function view() {
        var selRow = \$('#listdata').datagrid('getSelected');
        if (!selRow) {
            \$.messager.alert('错误','请选择一行');
            return false;
        }
        \$('#view_iframe').prop('src', \"";
        // line 128
        echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url("purchase/view"), "html", null, true);
        echo "\" + '?id=' + selRow.id);
        \$('#dlg-view').window('open');
    }

    function del() {
        var selRow = \$('#listdata').datagrid('getSelected');
        if (!selRow) {
            \$.messager.alert('错误','请选择一行');
            return false;
        }

        \$.messager.confirm('Confirm', '确认删除吗?', function(r) {
            if (r) {
                \$.post(\"";
        // line 141
        echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url("supplier/del"), "html", null, true);
        echo "\", {'id':selRow.id}, function(data) {
                    if (data.error) {
                        \$.messager.alert('错误', data.message, 'error');
                    } else {
                        \$.messager.alert('成功', data.message);
                        reloadgrid();
                    }
                }, 'json');
            }
        });
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
        return array (  207 => 141,  191 => 128,  178 => 118,  165 => 108,  141 => 86,  138 => 85,  98 => 47,  94 => 45,  91 => 44,  87 => 42,  84 => 41,  80 => 39,  77 => 38,  73 => 36,  71 => 35,  52 => 19,  40 => 10,  32 => 4,  29 => 3,  11 => 1,);
    }
}
/* {% extends '@app/views/base.html' %}*/
/* */
/* {% block main %}*/
/* */
/* <div class="search">*/
/*     <span>订单编号*/
/*         <input class="easyui-textbox" type="text" name="orderId" id="orderId">*/
/*     </span>*/
/*     <span>创建人*/
/*         <select class="easyui-combobox" id="adminId" editable="true" style="width:100px;" data-options="url: '{{ url('/employee/list') }}', valueField: 'id', textField: 'name'"></select>*/
/*     </span>*/
/*     <span>创建时间*/
/*         <input class="easyui-datetimebox" style="width:200px" name="startTime" id="startTime"> 到*/
/*         <input class="easyui-datetimebox" style="width:200px" name="endTime" id="endTime">*/
/*     </span>*/
/*     <a href="javascript:void(0);" onclick="reloadgrid();" class="easyui-linkbutton" iconCls="icon-search">搜索</a>*/
/* </div>*/
/* */
/* <table id="listdata"  class="easyui-datagrid" title="采购订单列表" data-options="toolbar:'#tb-user',singleSelect:true,pagination:true,method:'get',url:'{{  url('purchase/index')}}',mode:'local',pageSize:20">*/
/*     <thead>*/
/*     <tr>*/
/*         <th data-options="field:'id', width:150, align:'center'">订单编号</th>*/
/*         <th data-options="field:'money', width:100, align:'center'">订单金额</th>*/
/*         <th data-options="field:'admin_name', width:100, align:'center'">创建人</th>*/
/*         <th data-options="field:'created_at', width:180, align:'center'" formatter="formatTime">创建时间</th>*/
/*         <th data-options="field:'status', width:100, align:'center'" formatter="formatStatus">订单状态</th>*/
/*         <th data-options="field:'approved_name', width:100, align:'center'">审核人</th>*/
/*         <th data-options="field:'note', width:100, align:'center'">备注</th>*/
/*     </tr>*/
/*     </thead>*/
/* </table>*/
/* */
/* <div id="tb-user" style="height:auto">*/
/*     <div>*/
/*         {% if add == 1 %}*/
/*         <a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-add',plain:true" onclick="add()">新增</a>*/
/*         {% endif %}*/
/*         {% if edit == 1 %}*/
/*         <a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-edit',plain:true" onclick="edit()">编辑</a>*/
/*         {% endif %}*/
/*         {% if view == 1 %}*/
/*         <a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-tip',plain:true" onclick="view()">详情</a>*/
/*         {% endif %}*/
/*         {% if del == 1 %}*/
/*         <!--<a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-no',plain:true" onclick="del()">删除</a>-->*/
/*         {% endif %}*/
/*     </div>*/
/* </div>*/
/* */
/* <div id="dlg-add" class="easyui-window" title="新增采购订单" style="width:1198px;height:750px;padding:10px;overflow:hidden;" data-options="*/
/*             iconCls:'icon-save',*/
/*             closed:true,*/
/*             modal:true,*/
/*             onResize:function(){*/
/*                 $(this).window('hcenter');*/
/*             }">*/
/*     <iframe width="100%" height="100%" frameborder="0" id="add_iframe">*/
/*     </iframe>*/
/* </div>*/
/* */
/* <div id="dlg-edit" class="easyui-window" title="编辑采购订单" style="width:1198px;height:750px;padding:10px;overflow:hidden;" data-options="*/
/*             iconCls:'icon-save',*/
/*             closed:true,*/
/*             modal:true,*/
/*             onResize:function(){*/
/*                 $(this).window('hcenter');*/
/*             }">*/
/*     <iframe width="100%" height="100%" frameborder="0" id="edit_iframe">*/
/*     </iframe>*/
/* </div>*/
/* */
/* <div id="dlg-view" class="easyui-window" title="采购订单详情" style="width:1198px;height:750px;padding:10px;overflow:hidden;" data-options="*/
/*             iconCls:'icon-save',*/
/*             closed:true,*/
/*             modal:true,*/
/*             onResize:function(){*/
/*                 $(this).window('hcenter');*/
/*             }">*/
/*     <iframe width="100%" height="100%" frameborder="0" id="view_iframe">*/
/*     </iframe>*/
/* </div>*/
/* */
/* {% endblock %}*/
/* */
/* {% block js %}*/
/* <script>*/
/*     function reloadgrid(){*/
/*         var queryParams = $('#listdata').datagrid('options').queryParams;*/
/*         queryParams.orderId = $('#orderId').val();*/
/*         queryParams.adminId = $('#adminId').combobox('getValue');*/
/*         queryParams.startTime = $('#startTime').datetimebox('getValue');*/
/*         queryParams.endTime	= $('#endTime').datetimebox('getValue');*/
/*         $('#listdata').datagrid('options').queryParams = queryParams;*/
/*         $("#listdata").datagrid('reload');*/
/*     }*/
/* */
/*     function formatStatus(val, row) {*/
/*         if (val == 0) {*/
/*             return '提交待审';*/
/*         } else if (val == 1) {*/
/*             return '审核通过';*/
/*         } else if (val == 2) {*/
/*             return '审核不通过';*/
/*         }*/
/*     }*/
/* */
/*     function add() {*/
/*         $('#add_iframe').prop('src', "{{ url('purchase/add') }}");*/
/*         $('#dlg-add').window('open');*/
/*     }*/
/* */
/*     function edit() {*/
/*         var selRow = $('#listdata').datagrid('getSelected');*/
/*         if (!selRow) {*/
/*             $.messager.alert('错误','请选择一行');*/
/*             return false;*/
/*         }*/
/*         $('#edit_iframe').prop('src', "{{ url('purchase/edit') }}" + '?id=' + selRow.id);*/
/*         $('#dlg-edit').window('open');*/
/*     }*/
/* */
/*     function view() {*/
/*         var selRow = $('#listdata').datagrid('getSelected');*/
/*         if (!selRow) {*/
/*             $.messager.alert('错误','请选择一行');*/
/*             return false;*/
/*         }*/
/*         $('#view_iframe').prop('src', "{{ url('purchase/view') }}" + '?id=' + selRow.id);*/
/*         $('#dlg-view').window('open');*/
/*     }*/
/* */
/*     function del() {*/
/*         var selRow = $('#listdata').datagrid('getSelected');*/
/*         if (!selRow) {*/
/*             $.messager.alert('错误','请选择一行');*/
/*             return false;*/
/*         }*/
/* */
/*         $.messager.confirm('Confirm', '确认删除吗?', function(r) {*/
/*             if (r) {*/
/*                 $.post("{{ url('supplier/del') }}", {'id':selRow.id}, function(data) {*/
/*                     if (data.error) {*/
/*                         $.messager.alert('错误', data.message, 'error');*/
/*                     } else {*/
/*                         $.messager.alert('成功', data.message);*/
/*                         reloadgrid();*/
/*                     }*/
/*                 }, 'json');*/
/*             }*/
/*         });*/
/*     }*/
/* */
/* </script>*/
/* {% endblock %}*/
/* */
/* */
