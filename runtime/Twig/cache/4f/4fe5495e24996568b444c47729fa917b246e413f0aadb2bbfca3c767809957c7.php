<?php

/* store_list.html */
class __TwigTemplate_9f4a4431be2543f8e22e59ca3a2ece9203adb760533e99e7067e812ef1129755 extends yii\twig\Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("@app/views/base.html", "store_list.html", 1);
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
        echo "<style>
    tr{height: 58px;}
</style>

<div class=\"search\">
    <span>商品名称 <input class=\"easyui-textbox\" type=\"text\"  name=\"account\" id=\"name\"></span>
    <span>商品编号 <input class=\"easyui-textbox\" type=\"text\"  name=\"id\" id=\"id\" style=\"width:100px;\"></span>
    <span>商品分类
        <input class=\"easyui-combotree\" name=\"cat_id\" id=\"cat_id\" data-options=\"url:'";
        // line 12
        echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url("product-category/all-list"), "html", null, true);
        echo "',method:'get'\" editable=\"true\">
    </span>
    <span>状态
        <select class=\"easyui-combobox\" id=\"marketable\" name=\"marketable\" data-options=\"panelHeight:'auto'\">
            <option value=\"all\">所有</option>
            <option value=\"1\">上架</option>
            <option value=\"0\">下架</option>
            <option value=\"2\">新增</option>
        </select>
    </span>
    <a href=\"javascript:void(0);\" onclick=\"reloadgrid();\" class=\"easyui-linkbutton\" iconCls=\"icon-search\">搜索</a>
</div>

<table id=\"listdata\" class=\"easyui-datagrid\" title=\"商品列表\" data-options=\"toolbar:'#tb-user',rownumbers:true,singleSelect:true,pagination:true,method:'get', url:'";
        // line 25
        echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url("product/store-list"), "html", null, true);
        echo "',rownumbers: false\">
    <thead>
    <tr>
        <th data-options=\"field:'id', width:80, align:'center'\">商品编号</th>
        <th data-options=\"field:'name', width:700\" formatter=\"formatName\">商品名称</th>
        <th data-options=\"field:'cat_id', width:200, align:'center'\">商品分类</th>
        <th data-options=\"field:'price', width:100, align:'center'\">伙购价</th>
        <th data-options=\"field:'total', width:100, align:'center', sortable:true\">库存</th>
        <th data-options=\"field:'created_at', width:150, sortable:true\" formatter=\"formatTime\">创建时间</th>
    </tr>
    </thead>
</table>

<div id=\"tb-user\" style=\"height:auto\">
    <div>
        <a href=\"javascript:void(0)\" class=\"easyui-linkbutton\" data-options=\"iconCls:'icon-view',plain:true\" onclick=\"view()\">查看详情</a>
        ";
        // line 41
        if (((isset($context["edit"]) ? $context["edit"] : null) == 1)) {
            // line 42
            echo "        <a href=\"javascript:void(0)\" class=\"easyui-linkbutton\" data-options=\"iconCls:'icon-edit',plain:true\" onclick=\"edit()\">修改库存</a>
        ";
        }
        // line 44
        echo "    </div>
</div>

<div class=\"easyui-dialog\" id=\"modify_total\" title=\"修改库存\" style=\"width:400px;height:300px;\" data-options=\"closed:true,modal:true\">
    <table cellpadding=\"5\">
        <tr>
            <td style=\"width:60px;\">商品名称:</td>
            <td id=\"goods_name\"></td>
        </tr>
        <tr>
            <td>商品分类:</td>
            <td id=\"cart\"></td>
        </tr>
        <tr>
            <td>库存:</td>
            <td><input type=\"text\" id=\"total\" class=\"easyui-textbox\" data-options=\"required:true\"></td>
        </tr>
    </table>
    <div style=\"padding:5px 0;margin-left:120px;margin-top:20px;\">
        <a  class=\"easyui-linkbutton\" data-options=\"iconCls:'icon-ok'\" onclick=\"save()\">修改</a>
        <a class=\"easyui-linkbutton\" data-options=\"iconCls:'icon-cancel'\" onclick=\"javascript:\$('#modify_total').dialog('close')\">取消</a>
    </div>
</div>

<div class=\"easyui-window\" id=\"store_view\" title=\"查看库存\" style=\"width:1000px;height: 700px;\" data-options=\"closed:true,modal:true\">
    <iframe width=\"100%\" height=\"100%\" frameborder=\"0\" id=\"add_iframe\"></iframe>
</div>
";
    }

    // line 73
    public function block_js($context, array $blocks = array())
    {
        // line 74
        echo "<script>
    function view(){
        var selRow = \$('#listdata').datagrid('getSelected');
        \$('#add_iframe').prop('src', \"";
        // line 77
        echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url("product/store-view"), "html", null, true);
        echo "\" + '?id=' + selRow.id);
        \$('#store_view').window('open');
    }

    function save(){
        var selRow = \$('#listdata').datagrid('getSelected');
        var total = \$('#total').textbox('getValue');
        \$.post('/product/edit-store', {'id':selRow.id, 'total':total}, function(data){
            if (data.error) {
                \$.messager.alert('错误', data.message);
            } else {
                \$.messager.alert('成功', data.message);
                setTimeout(function(){window.location.reload()}, 2000);
            }
        })
    }

    function edit(){
        var selRow = \$('#listdata').datagrid('getSelected');
        if (!selRow) {
            \$.messager.alert('错误','请选择商品');
            return false;
        }
        \$('#goods_name').text(selRow.name);
        \$('#cart').text(selRow.cat_id);
        \$('#total').textbox('setText', selRow.total);
        \$('#modify_total').window('open');
    }

    function reloadgrid(){
        var queryParams = \$('#listdata').datagrid('options').queryParams;
        queryParams.name = \$('#name').val();
        queryParams.id\t= \$('#id').val();
        queryParams.cat_id\t= \$('#cat_id').combobox('getValue');
        queryParams.marketable\t= \$('#marketable').combobox('getValue');
        \$('#listdata').datagrid('options').queryParams = queryParams;
        \$(\"#listdata\").datagrid('reload');
    }

    function formatName(val, row) {
        var product_url = createGoodsUrl(row.id);
        var product_image_url = createGoodsImgUrl(row.picture, photoSize[0], photoSize[0]);
        return '<a target=\"_blank\" href=\"'+product_url+'\" style=\"text-decoration: none;\"><img src=\"'+product_image_url+'\" class=\"thumb\">&nbsp;'+val+'</a>';
    }

    function formatTime(val, row) {
        return new Date(parseInt(val) * 1000).toLocaleString();
    }
</script>
";
    }

    public function getTemplateName()
    {
        return "store_list.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  122 => 77,  117 => 74,  114 => 73,  83 => 44,  79 => 42,  77 => 41,  58 => 25,  42 => 12,  32 => 4,  29 => 3,  11 => 1,);
    }
}
/* {% extends '@app/views/base.html' %}*/
/* */
/* {% block main %}*/
/* <style>*/
/*     tr{height: 58px;}*/
/* </style>*/
/* */
/* <div class="search">*/
/*     <span>商品名称 <input class="easyui-textbox" type="text"  name="account" id="name"></span>*/
/*     <span>商品编号 <input class="easyui-textbox" type="text"  name="id" id="id" style="width:100px;"></span>*/
/*     <span>商品分类*/
/*         <input class="easyui-combotree" name="cat_id" id="cat_id" data-options="url:'{{ url('product-category/all-list') }}',method:'get'" editable="true">*/
/*     </span>*/
/*     <span>状态*/
/*         <select class="easyui-combobox" id="marketable" name="marketable" data-options="panelHeight:'auto'">*/
/*             <option value="all">所有</option>*/
/*             <option value="1">上架</option>*/
/*             <option value="0">下架</option>*/
/*             <option value="2">新增</option>*/
/*         </select>*/
/*     </span>*/
/*     <a href="javascript:void(0);" onclick="reloadgrid();" class="easyui-linkbutton" iconCls="icon-search">搜索</a>*/
/* </div>*/
/* */
/* <table id="listdata" class="easyui-datagrid" title="商品列表" data-options="toolbar:'#tb-user',rownumbers:true,singleSelect:true,pagination:true,method:'get', url:'{{ url('product/store-list') }}',rownumbers: false">*/
/*     <thead>*/
/*     <tr>*/
/*         <th data-options="field:'id', width:80, align:'center'">商品编号</th>*/
/*         <th data-options="field:'name', width:700" formatter="formatName">商品名称</th>*/
/*         <th data-options="field:'cat_id', width:200, align:'center'">商品分类</th>*/
/*         <th data-options="field:'price', width:100, align:'center'">伙购价</th>*/
/*         <th data-options="field:'total', width:100, align:'center', sortable:true">库存</th>*/
/*         <th data-options="field:'created_at', width:150, sortable:true" formatter="formatTime">创建时间</th>*/
/*     </tr>*/
/*     </thead>*/
/* </table>*/
/* */
/* <div id="tb-user" style="height:auto">*/
/*     <div>*/
/*         <a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-view',plain:true" onclick="view()">查看详情</a>*/
/*         {% if(edit == 1) %}*/
/*         <a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-edit',plain:true" onclick="edit()">修改库存</a>*/
/*         {% endif %}*/
/*     </div>*/
/* </div>*/
/* */
/* <div class="easyui-dialog" id="modify_total" title="修改库存" style="width:400px;height:300px;" data-options="closed:true,modal:true">*/
/*     <table cellpadding="5">*/
/*         <tr>*/
/*             <td style="width:60px;">商品名称:</td>*/
/*             <td id="goods_name"></td>*/
/*         </tr>*/
/*         <tr>*/
/*             <td>商品分类:</td>*/
/*             <td id="cart"></td>*/
/*         </tr>*/
/*         <tr>*/
/*             <td>库存:</td>*/
/*             <td><input type="text" id="total" class="easyui-textbox" data-options="required:true"></td>*/
/*         </tr>*/
/*     </table>*/
/*     <div style="padding:5px 0;margin-left:120px;margin-top:20px;">*/
/*         <a  class="easyui-linkbutton" data-options="iconCls:'icon-ok'" onclick="save()">修改</a>*/
/*         <a class="easyui-linkbutton" data-options="iconCls:'icon-cancel'" onclick="javascript:$('#modify_total').dialog('close')">取消</a>*/
/*     </div>*/
/* </div>*/
/* */
/* <div class="easyui-window" id="store_view" title="查看库存" style="width:1000px;height: 700px;" data-options="closed:true,modal:true">*/
/*     <iframe width="100%" height="100%" frameborder="0" id="add_iframe"></iframe>*/
/* </div>*/
/* {% endblock %}*/
/* */
/* {% block js %}*/
/* <script>*/
/*     function view(){*/
/*         var selRow = $('#listdata').datagrid('getSelected');*/
/*         $('#add_iframe').prop('src', "{{ url('product/store-view') }}" + '?id=' + selRow.id);*/
/*         $('#store_view').window('open');*/
/*     }*/
/* */
/*     function save(){*/
/*         var selRow = $('#listdata').datagrid('getSelected');*/
/*         var total = $('#total').textbox('getValue');*/
/*         $.post('/product/edit-store', {'id':selRow.id, 'total':total}, function(data){*/
/*             if (data.error) {*/
/*                 $.messager.alert('错误', data.message);*/
/*             } else {*/
/*                 $.messager.alert('成功', data.message);*/
/*                 setTimeout(function(){window.location.reload()}, 2000);*/
/*             }*/
/*         })*/
/*     }*/
/* */
/*     function edit(){*/
/*         var selRow = $('#listdata').datagrid('getSelected');*/
/*         if (!selRow) {*/
/*             $.messager.alert('错误','请选择商品');*/
/*             return false;*/
/*         }*/
/*         $('#goods_name').text(selRow.name);*/
/*         $('#cart').text(selRow.cat_id);*/
/*         $('#total').textbox('setText', selRow.total);*/
/*         $('#modify_total').window('open');*/
/*     }*/
/* */
/*     function reloadgrid(){*/
/*         var queryParams = $('#listdata').datagrid('options').queryParams;*/
/*         queryParams.name = $('#name').val();*/
/*         queryParams.id	= $('#id').val();*/
/*         queryParams.cat_id	= $('#cat_id').combobox('getValue');*/
/*         queryParams.marketable	= $('#marketable').combobox('getValue');*/
/*         $('#listdata').datagrid('options').queryParams = queryParams;*/
/*         $("#listdata").datagrid('reload');*/
/*     }*/
/* */
/*     function formatName(val, row) {*/
/*         var product_url = createGoodsUrl(row.id);*/
/*         var product_image_url = createGoodsImgUrl(row.picture, photoSize[0], photoSize[0]);*/
/*         return '<a target="_blank" href="'+product_url+'" style="text-decoration: none;"><img src="'+product_image_url+'" class="thumb">&nbsp;'+val+'</a>';*/
/*     }*/
/* */
/*     function formatTime(val, row) {*/
/*         return new Date(parseInt(val) * 1000).toLocaleString();*/
/*     }*/
/* </script>*/
/* {% endblock %}*/
