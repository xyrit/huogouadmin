<?php

/* index.html */
class __TwigTemplate_452a96ba066480d27b519b3c9f54b08c9c116cfd7935118868f6f8ae5ed016f0 extends yii\twig\Template
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
    <span>商品分类
        <input class=\"easyui-combotree\" name=\"cat_id\" id=\"cat_id\" data-options=\"url:'";
        // line 6
        echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url("product-category/first-level-category"), "html", null, true);
        echo "',method:'get', valueField: 'id', textField: 'text'\" editable=\"true\" style=\"width:200px;\">
    </span>
    <a href=\"javascript:void(0);\" onclick=\"reloadgrid();\" class=\"easyui-linkbutton\" iconCls=\"icon-search\">搜索</a>
</div>

<table title=\"分类列表\" id=\"listdata\" class=\"easyui-treegrid\"
       data-options=\"
                url: '";
        // line 13
        echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url("/product-category/index"), "html", null, true);
        echo "',
                method: 'get',
                rownumbers: false,
                idField: 'id',
                treeField: 'name',
                toolbar:'#tb-user',
                onAfterEdit: onAfterEdit,
                onDblClickRow: onDblClickRow,
            \">
    <thead>
    <tr>
        <th data-options=\"field:'name', editor:'text'\" width=\"220\">分类名称</th>
        <th data-options=\"field:'list_order', editor:'numberbox'\" width=\"100\" align=\"right\">排序</th>
    </tr>
    </thead>
</table>

<div id=\"tb-user\" style=\"height:auto\">
    <div>
        <a href=\"javascript:void(0)\" class=\"easyui-linkbutton\" data-options=\"iconCls:'icon-add',plain:true\" onclick=\"add()\">新增</a>
        <a href=\"javascript:void(0)\" class=\"easyui-linkbutton\" data-options=\"iconCls:'icon-redo',plain:true\" onclick=\"del()\">删除</a>
    </div>
</div>

<!--新增分类-->
<div id=\"dlg-add\" title=\"新增分类\" class=\"easyui-dialog\" style=\"width:350px;height:auto;padding:10px 20px\" modal=\"true\" closed=\"true\" buttons=\"#dlg-buttons-add\">
    ";
        // line 39
        echo $this->getAttribute((isset($context["html"]) ? $context["html"] : null), "beginForm", array(0 => "", 1 => "post", 2 => array("class" => "am-form am-form-horizontal", "id" => "addForm")), "method");
        echo "
    <table cellpadding=\"5\">
        <tr>
            <td>分类名称</td>
            <td><input class=\"easyui-textbox\" type=\"text\" name=\"ProductCategoryForm[name]\" data-options=\"required:true\"></td>
        </tr>
        <tr>
            <td>上级分类</td>
            <td><input class=\"easyui-combotree\" name=\"ProductCategoryForm[parent_id]\" id=\"parent_id\" data-options=\"url:'";
        // line 47
        echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url("product-category/all-list"), "html", null, true);
        echo "',method:'get', required: true\" editable=\"true\"></td>
        </tr>
        <tr>
            <td>排序</td>
            <td><input class=\"easyui-textbox\" type=\"text\" name=\"ProductCategoryForm[list_order]\" data-options=\"required:true\"></td>
        </tr>
    </table>
    ";
        // line 54
        echo $this->getAttribute((isset($context["html"]) ? $context["html"] : null), "endForm", array(), "method");
        echo "
</div>

<div id=\"dlg-buttons-add\" style=\"text-align:center;padding:5px\">
    <a class=\"easyui-linkbutton\" iconCls=\"icon-ok\" onclick=\"save('add')\">确定</a>
    <a class=\"easyui-linkbutton\" iconCls=\"icon-cancel\" onclick=\"javascript:\$('#dlg-add').dialog('close')\">取消</a>
</div>
<!--新增分类-->

";
    }

    // line 65
    public function block_js($context, array $blocks = array())
    {
        // line 66
        echo "<script>
    function reloadgrid(){
        var queryParams = \$('#listdata').treegrid('options').queryParams;
        if (\$('#cat_id').combobox('getValue')) queryParams.cat_id = \$('#cat_id').combobox('getValue');
        \$('#listdata').treegrid('options').queryParams = queryParams;
        \$(\"#listdata\").treegrid('load');
    }

    var editingId;
    var list_order;
    var beforeRow;
    var name;

    function onDblClickRow(row) {
        if (row.id != editingId && editingId != undefined) {
            \$('#listdata').treegrid('endEdit', editingId);
        }
        beforeRow = row;
        editingId = row.id;
        list_order = row.list_order;
        name = row.name;
        \$('#listdata').treegrid('beginEdit', editingId);
    }

    function onAfterEdit() {
        if (beforeRow && list_order && (beforeRow.list_order != list_order || beforeRow.name != name)) {
            \$.get(\"";
        // line 92
        echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url("product-category/edit"), "html", null, true);
        echo "\", {'order':beforeRow.list_order, 'name':beforeRow.name, 'id':beforeRow.id}, function(data) {}, 'json');
            beforeRow = '';
            list_order = '';
            editingId = '';
        }
    }

    \$(document).click(function(e) {
        if(!\$(e.target).is('.datagrid-editable')){
            \$('#listdata').treegrid('endEdit', editingId);
        }
    });

    function add() {
        \$('#addForm').form('clear');
        var selRow = \$('#listdata').datagrid('getSelected');
        if (selRow) {
            \$('#parent_id').combobox('select', selRow.id);
        }

        \$('#dlg-add').window('open');
    }

    function del() {
        var selRow = \$('#listdata').treegrid('getSelected');
        if (!selRow) {
            \$.messager.alert('错误','请选择分类');
            return false;
        }

        \$.messager.confirm('Confirm', '确认删除吗?', function(r) {
            if (r) {
                \$.get(\"";
        // line 124
        echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url("product-category/del"), "html", null, true);
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

    function save() {
        var url = '/product-category/add';

        \$('#addForm').form({
            url: url,
            onSubmit:function(){
                return \$(this).form('enableValidation').form('validate');
            },
            success: function (data) {
                data = eval('(' + data + ')');
                if (data.error == 0) {
                    \$.messager.alert('成功', data.message);
                    window.location.href = '/product-category';
                } else {
                    \$.messager.alert('失败', data.message, 'error');
                }
            }
        });
        \$('#addForm').submit();
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
        return array (  176 => 124,  141 => 92,  113 => 66,  110 => 65,  96 => 54,  86 => 47,  75 => 39,  46 => 13,  36 => 6,  32 => 4,  29 => 3,  11 => 1,);
    }
}
/* {% extends '@app/views/base.html' %}*/
/* */
/* {% block main %}*/
/* <div class="search">*/
/*     <span>商品分类*/
/*         <input class="easyui-combotree" name="cat_id" id="cat_id" data-options="url:'{{ url('product-category/first-level-category') }}',method:'get', valueField: 'id', textField: 'text'" editable="true" style="width:200px;">*/
/*     </span>*/
/*     <a href="javascript:void(0);" onclick="reloadgrid();" class="easyui-linkbutton" iconCls="icon-search">搜索</a>*/
/* </div>*/
/* */
/* <table title="分类列表" id="listdata" class="easyui-treegrid"*/
/*        data-options="*/
/*                 url: '{{ url('/product-category/index') }}',*/
/*                 method: 'get',*/
/*                 rownumbers: false,*/
/*                 idField: 'id',*/
/*                 treeField: 'name',*/
/*                 toolbar:'#tb-user',*/
/*                 onAfterEdit: onAfterEdit,*/
/*                 onDblClickRow: onDblClickRow,*/
/*             ">*/
/*     <thead>*/
/*     <tr>*/
/*         <th data-options="field:'name', editor:'text'" width="220">分类名称</th>*/
/*         <th data-options="field:'list_order', editor:'numberbox'" width="100" align="right">排序</th>*/
/*     </tr>*/
/*     </thead>*/
/* </table>*/
/* */
/* <div id="tb-user" style="height:auto">*/
/*     <div>*/
/*         <a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-add',plain:true" onclick="add()">新增</a>*/
/*         <a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-redo',plain:true" onclick="del()">删除</a>*/
/*     </div>*/
/* </div>*/
/* */
/* <!--新增分类-->*/
/* <div id="dlg-add" title="新增分类" class="easyui-dialog" style="width:350px;height:auto;padding:10px 20px" modal="true" closed="true" buttons="#dlg-buttons-add">*/
/*     {{ html.beginForm('', 'post', {'class':'am-form am-form-horizontal', 'id':'addForm'}) | raw }}*/
/*     <table cellpadding="5">*/
/*         <tr>*/
/*             <td>分类名称</td>*/
/*             <td><input class="easyui-textbox" type="text" name="ProductCategoryForm[name]" data-options="required:true"></td>*/
/*         </tr>*/
/*         <tr>*/
/*             <td>上级分类</td>*/
/*             <td><input class="easyui-combotree" name="ProductCategoryForm[parent_id]" id="parent_id" data-options="url:'{{ url('product-category/all-list') }}',method:'get', required: true" editable="true"></td>*/
/*         </tr>*/
/*         <tr>*/
/*             <td>排序</td>*/
/*             <td><input class="easyui-textbox" type="text" name="ProductCategoryForm[list_order]" data-options="required:true"></td>*/
/*         </tr>*/
/*     </table>*/
/*     {{ html.endForm() | raw }}*/
/* </div>*/
/* */
/* <div id="dlg-buttons-add" style="text-align:center;padding:5px">*/
/*     <a class="easyui-linkbutton" iconCls="icon-ok" onclick="save('add')">确定</a>*/
/*     <a class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg-add').dialog('close')">取消</a>*/
/* </div>*/
/* <!--新增分类-->*/
/* */
/* {% endblock %}*/
/* */
/* {% block js %}*/
/* <script>*/
/*     function reloadgrid(){*/
/*         var queryParams = $('#listdata').treegrid('options').queryParams;*/
/*         if ($('#cat_id').combobox('getValue')) queryParams.cat_id = $('#cat_id').combobox('getValue');*/
/*         $('#listdata').treegrid('options').queryParams = queryParams;*/
/*         $("#listdata").treegrid('load');*/
/*     }*/
/* */
/*     var editingId;*/
/*     var list_order;*/
/*     var beforeRow;*/
/*     var name;*/
/* */
/*     function onDblClickRow(row) {*/
/*         if (row.id != editingId && editingId != undefined) {*/
/*             $('#listdata').treegrid('endEdit', editingId);*/
/*         }*/
/*         beforeRow = row;*/
/*         editingId = row.id;*/
/*         list_order = row.list_order;*/
/*         name = row.name;*/
/*         $('#listdata').treegrid('beginEdit', editingId);*/
/*     }*/
/* */
/*     function onAfterEdit() {*/
/*         if (beforeRow && list_order && (beforeRow.list_order != list_order || beforeRow.name != name)) {*/
/*             $.get("{{ url('product-category/edit') }}", {'order':beforeRow.list_order, 'name':beforeRow.name, 'id':beforeRow.id}, function(data) {}, 'json');*/
/*             beforeRow = '';*/
/*             list_order = '';*/
/*             editingId = '';*/
/*         }*/
/*     }*/
/* */
/*     $(document).click(function(e) {*/
/*         if(!$(e.target).is('.datagrid-editable')){*/
/*             $('#listdata').treegrid('endEdit', editingId);*/
/*         }*/
/*     });*/
/* */
/*     function add() {*/
/*         $('#addForm').form('clear');*/
/*         var selRow = $('#listdata').datagrid('getSelected');*/
/*         if (selRow) {*/
/*             $('#parent_id').combobox('select', selRow.id);*/
/*         }*/
/* */
/*         $('#dlg-add').window('open');*/
/*     }*/
/* */
/*     function del() {*/
/*         var selRow = $('#listdata').treegrid('getSelected');*/
/*         if (!selRow) {*/
/*             $.messager.alert('错误','请选择分类');*/
/*             return false;*/
/*         }*/
/* */
/*         $.messager.confirm('Confirm', '确认删除吗?', function(r) {*/
/*             if (r) {*/
/*                 $.get("{{ url('product-category/del') }}", {'id':selRow.id}, function(data) {*/
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
/*     function save() {*/
/*         var url = '/product-category/add';*/
/* */
/*         $('#addForm').form({*/
/*             url: url,*/
/*             onSubmit:function(){*/
/*                 return $(this).form('enableValidation').form('validate');*/
/*             },*/
/*             success: function (data) {*/
/*                 data = eval('(' + data + ')');*/
/*                 if (data.error == 0) {*/
/*                     $.messager.alert('成功', data.message);*/
/*                     window.location.href = '/product-category';*/
/*                 } else {*/
/*                     $.messager.alert('失败', data.message, 'error');*/
/*                 }*/
/*             }*/
/*         });*/
/*         $('#addForm').submit();*/
/*     }*/
/* </script>*/
/* {% endblock %}*/
/* */
/* */
