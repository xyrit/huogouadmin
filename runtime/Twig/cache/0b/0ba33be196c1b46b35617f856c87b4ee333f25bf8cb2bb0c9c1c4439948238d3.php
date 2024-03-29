<?php

/* index.html */
class __TwigTemplate_cdc526abd962adbf3063ae409afe0004e9052e507ac3c834c4ba69c7592d6f39 extends yii\twig\Template
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
        echo "<style>
    .datagrid-btable tr{height: 64px!important;}
</style>
<div class=\"search\">
    <span>商品名称 <input class=\"easyui-textbox\" type=\"text\"  name=\"account\" id=\"name\"></span>
    <span>商品编号 <input class=\"easyui-textbox\" type=\"text\"  name=\"bn\" id=\"bn\" style=\"width:100px;\"></span>
    <span>商品分类
        <input class=\"easyui-combotree\" name=\"cat_id\" id=\"cat_id\" data-options=\"url:'";
        // line 11
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
    <span>晒单
        <select class=\"easyui-combobox\" id=\"allow_share\" name=\"allow_share\" data-options=\"panelHeight:'auto'\">
            <option value=\"all\">所有</option>
            <option value=\"1\">是</option>
            <option value=\"0\">否</option>
        </select>
    </span>
    <span>限购
        <select class=\"easyui-combobox\" id=\"limit_num\" name=\"limit_num\" data-options=\"panelHeight:'auto'\">
            <option value=\"all\">所有</option>
            <option value=\"1\">是</option>
            <option value=\"0\">否</option>
        </select>
    </span>
    <span>十倍专区
        <select class=\"easyui-combobox\" id=\"buy_unit\" name=\"buy_unit\" data-options=\"panelHeight:'auto'\">
            <option value=\"all\">所有</option>
            <option value=\"10\">是</option>
            <option value=\"0\">否</option>
        </select>
    </span>
    <a href=\"javascript:void(0);\" onclick=\"reloadgrid();\" class=\"easyui-linkbutton\" iconCls=\"icon-search\">搜索</a>
</div>

<table id=\"listdata\" class=\"easyui-datagrid\" title=\"商品列表\"
       data-options=\"
            toolbar:'#tb-user',
            rownumbers:true,
            singleSelect:true,
            pagination:true,
            method:'get',
            url:'";
        // line 52
        echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url("product/index", array("status" => (isset($context["status"]) ? $context["status"] : null))), "html", null, true);
        echo "',
            rownumbers: false,
            nowrap:false
        \">
    <thead>
        <tr>
            <!--<th data-options=\"field:'ck', checkbox: true\">-->
            <th data-options=\"field:'id', width:80, align:'center'\">商品ID</th>
            <th data-options=\"field:'bn', width:80, align:'center'\">商品编号</th>
            <th data-options=\"field:'picture', width:66\" formatter=\"formatPicture\">&nbsp;</th>
            <th data-options=\"field:'name', width:500\" formatter=\"formatName\">商品名称</th>
            <th data-options=\"field:'allow_share', width:80, align:'center'\" formatter=\"formatShare\">是否可晒单</th>
            <th data-options=\"field:'cat_name', width:100, align:'center'\">商品分类</th>
            <th data-options=\"field:'price', width:100, align:'center'\">伙购价</th>
            <th data-options=\"field:'limit_num', width:80, align:'center'\">限购次数</th>
            <th data-options=\"field:'buy_unit', width:80, align:'center'\" formatter=\"formatBuyUnit\">十倍专区</th>
            <th data-options=\"field:'period_number', width:80, align:'center',sortable:true\">伙购期数</th>
            <th data-options=\"field:'store', width:80, align:'center'\">总期数</th>
            <th data-options=\"field:'total', width:80, align:'center',sortable:true\">库存</th>
            <th data-options=\"field:'marketable', width:50, align:'center'\" formatter=\"formatStatus\">状态</th>
            <th data-options=\"field:'is_recommend', width:50, align:'center'\" formatter=\"formatRecommend\">推荐</th>
            <th data-options=\"field:'created_at', width:180, sortable:true\" formatter=\"formatTime\">创建时间</th>
        </tr>
    </thead>
</table>

<div id=\"tb-user\" style=\"height:auto\">
    <div>
        <a href=\"javascript:void(0)\" class=\"easyui-linkbutton\" data-options=\"iconCls:'icon-add',plain:true\" onclick=\"add()\">新增</a>
        <a href=\"javascript:void(0)\" class=\"easyui-linkbutton\" data-options=\"iconCls:'icon-edit',plain:true\" onclick=\"edit()\">编辑</a>
        <a href=\"javascript:void(0)\" class=\"easyui-linkbutton\" data-options=\"iconCls:'icon-ok',plain:true\" onclick=\"up()\">上架</a>
        <a href=\"javascript:void(0)\" class=\"easyui-linkbutton\" data-options=\"iconCls:'icon-no',plain:true\" onclick=\"down()\">下架</a>
        <a href=\"javascript:void(0)\" class=\"easyui-linkbutton\" data-options=\"iconCls:'icon-redo',plain:true\" onclick=\"del()\">删除</a>
    </div>
</div>

<div id=\"dlg-add\" class=\"easyui-window\" title=\"新增商品\" style=\"width:1242px;height:750px;padding:10px;overflow:hidden;\" data-options=\"
            iconCls:'icon-save',
            closed:true,
            modal:true,
            onResize:function(){
                \$(this).window('hcenter');
            }\">
    <iframe width=\"100%\" height=\"100%\" frameborder=\"0\" id=\"add_iframe\">
    </iframe>
</div>

<div id=\"dlg-edit\" class=\"easyui-window\" title=\"编辑商品\" style=\"width:1242px;height:750px;padding:10px;overflow:hidden;\" data-options=\"
            iconCls:'icon-save',
            closed:true,
            modal:true,
            onResize:function(){
                \$(this).window('hcenter');
            }\">
    <iframe width=\"100%\" height=\"100%\" frameborder=\"0\" id=\"edit_iframe\">
    </iframe>
</div>

";
    }

    // line 112
    public function block_js($context, array $blocks = array())
    {
        // line 113
        echo "<script>
    function reloadgrid(){
        var queryParams = \$('#listdata').datagrid('options').queryParams;
        queryParams.name = \$('#name').val();
        queryParams.bn\t= \$('#bn').val();
        queryParams.cat_id\t= \$('#cat_id').combobox('getValue');
        queryParams.marketable\t= \$('#marketable').combobox('getValue');
        queryParams.allow_share\t= \$('#allow_share').combobox('getValue');
        queryParams.limit_num\t= \$('#limit_num').combobox('getValue');
        queryParams.buy_unit\t= \$('#buy_unit').combobox('getValue');
        \$('#listdata').datagrid('options').queryParams = queryParams;
        \$(\"#listdata\").datagrid('reload');
    }

    //格式化
    function formatPicture(val, row) {
        product_url = createGoodsUrl(row.id);
        product_image_url = createGoodsImgUrl(row.picture, photoSize[0], photoSize[0]);
        return '<a target=\"_blank\" href=\"'+product_url+'\"><img src=\"'+product_image_url+'\"></a>';
    }

    function formatName(val, row) {
        product_url = createGoodsUrl(row.id);
        product_image_url = createGoodsImgUrl(row.picture, photoSize[0], photoSize[0]);
        return '<a target=\"_blank\" href=\"'+product_url+'\">'+val+'</a>';
    }

    function formatBuyUnit(val, row) {
        if (val==1) {
            return '否';
        } else if (val==10) {
            return '<span style=\"color:red;\">是</span>';
        }
        return '未知';
    }

    function formatStatus(val, row) {
        if (val == 0) {
            return '下架';
        } else if (val == 1) {
            return '上架';
        } else if (val == 2) {
            return '新增';
        }
    }

    function formatShare(val, row) {
        if (val == 1) {
            return '是';
        } else if (val == 0) {
            return '否';
        }
    }

    function formatRecommend(val, row) {
        if (val == 1) {
            return '是';
        } else if (val == 0) {
            return '否';
        }
    }

    function formatTime(val, row) {
        var newDate_attend = new Date();
        newDate_attend.setTime(val * 1000);
        var my_create_time_attend=newDate_attend.format('yyyy-MM-dd hh:mm:ss');
        return my_create_time_attend;
    }

    //操作
    function add() {
        \$('#add_iframe').prop('src', \"";
        // line 184
        echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url("product/add"), "html", null, true);
        echo "\");
        \$('#dlg-add').window('open');
    }

    function edit() {
        var selRow = \$('#listdata').datagrid('getSelected');
        if (!selRow) {
            \$.messager.alert('错误','请选择商品');
            return false;
        }
        \$('#edit_iframe').prop('src', \"";
        // line 194
        echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url("product/edit"), "html", null, true);
        echo "\" + '?id=' + selRow.id);
        \$('#dlg-edit').window('open');
    }

    function up() {
        var selRow = \$('#listdata').datagrid('getSelected');
        if (!selRow) {
            \$.messager.alert('错误','请选择商品');
            return false;
        }

        if (selRow.marketable == 1) {
            \$.messager.alert('错误','该商品已上架');
            return false;
        }

        \$.messager.confirm('Confirm', '确认上架吗?', function(r){
            if (r){
                \$.post(\"";
        // line 212
        echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url("/product/market"), "html", null, true);
        echo "\", {'id':selRow.id, 'market':1}, function(data) {
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

    function down() {
        var selRow = \$('#listdata').datagrid('getSelected');
        if (!selRow) {
            \$.messager.alert('错误','请选择商品');
            return false;
        }
        console.log(selRow.marketable);
        if (selRow.marketable == 0) {
            \$.messager.alert('错误','该商品已下架');
            return false;
        }

        \$.messager.confirm('Confirm', '确认下架吗?', function(r){
            if (r){
                \$.post(\"";
        // line 238
        echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url("/product/market"), "html", null, true);
        echo "\", {'id':selRow.id, 'market':0}, function(data) {
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

    function del() {
        var selRow = \$('#listdata').datagrid('getSelected');
        if (!selRow) {
            \$.messager.alert('错误','请选择商品');
            return false;
        }

        if (selRow.marketable != 2) {
            \$.messager.alert('错误','只有新增商品才能删除');
            return false;
        }

        \$.messager.confirm('Confirm', '确认删除吗?', function(r) {
            if (r) {
                \$.post(\"";
        // line 264
        echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url("/product/del"), "html", null, true);
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

    function sort(type, order) {

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
        return array (  316 => 264,  287 => 238,  258 => 212,  237 => 194,  224 => 184,  151 => 113,  148 => 112,  85 => 52,  41 => 11,  32 => 4,  29 => 3,  11 => 1,);
    }
}
/* {% extends '@app/views/base.html' %}*/
/* */
/* {% block main %}*/
/* <style>*/
/*     .datagrid-btable tr{height: 64px!important;}*/
/* </style>*/
/* <div class="search">*/
/*     <span>商品名称 <input class="easyui-textbox" type="text"  name="account" id="name"></span>*/
/*     <span>商品编号 <input class="easyui-textbox" type="text"  name="bn" id="bn" style="width:100px;"></span>*/
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
/*     <span>晒单*/
/*         <select class="easyui-combobox" id="allow_share" name="allow_share" data-options="panelHeight:'auto'">*/
/*             <option value="all">所有</option>*/
/*             <option value="1">是</option>*/
/*             <option value="0">否</option>*/
/*         </select>*/
/*     </span>*/
/*     <span>限购*/
/*         <select class="easyui-combobox" id="limit_num" name="limit_num" data-options="panelHeight:'auto'">*/
/*             <option value="all">所有</option>*/
/*             <option value="1">是</option>*/
/*             <option value="0">否</option>*/
/*         </select>*/
/*     </span>*/
/*     <span>十倍专区*/
/*         <select class="easyui-combobox" id="buy_unit" name="buy_unit" data-options="panelHeight:'auto'">*/
/*             <option value="all">所有</option>*/
/*             <option value="10">是</option>*/
/*             <option value="0">否</option>*/
/*         </select>*/
/*     </span>*/
/*     <a href="javascript:void(0);" onclick="reloadgrid();" class="easyui-linkbutton" iconCls="icon-search">搜索</a>*/
/* </div>*/
/* */
/* <table id="listdata" class="easyui-datagrid" title="商品列表"*/
/*        data-options="*/
/*             toolbar:'#tb-user',*/
/*             rownumbers:true,*/
/*             singleSelect:true,*/
/*             pagination:true,*/
/*             method:'get',*/
/*             url:'{{ url('product/index', {'status': status}) }}',*/
/*             rownumbers: false,*/
/*             nowrap:false*/
/*         ">*/
/*     <thead>*/
/*         <tr>*/
/*             <!--<th data-options="field:'ck', checkbox: true">-->*/
/*             <th data-options="field:'id', width:80, align:'center'">商品ID</th>*/
/*             <th data-options="field:'bn', width:80, align:'center'">商品编号</th>*/
/*             <th data-options="field:'picture', width:66" formatter="formatPicture">&nbsp;</th>*/
/*             <th data-options="field:'name', width:500" formatter="formatName">商品名称</th>*/
/*             <th data-options="field:'allow_share', width:80, align:'center'" formatter="formatShare">是否可晒单</th>*/
/*             <th data-options="field:'cat_name', width:100, align:'center'">商品分类</th>*/
/*             <th data-options="field:'price', width:100, align:'center'">伙购价</th>*/
/*             <th data-options="field:'limit_num', width:80, align:'center'">限购次数</th>*/
/*             <th data-options="field:'buy_unit', width:80, align:'center'" formatter="formatBuyUnit">十倍专区</th>*/
/*             <th data-options="field:'period_number', width:80, align:'center',sortable:true">伙购期数</th>*/
/*             <th data-options="field:'store', width:80, align:'center'">总期数</th>*/
/*             <th data-options="field:'total', width:80, align:'center',sortable:true">库存</th>*/
/*             <th data-options="field:'marketable', width:50, align:'center'" formatter="formatStatus">状态</th>*/
/*             <th data-options="field:'is_recommend', width:50, align:'center'" formatter="formatRecommend">推荐</th>*/
/*             <th data-options="field:'created_at', width:180, sortable:true" formatter="formatTime">创建时间</th>*/
/*         </tr>*/
/*     </thead>*/
/* </table>*/
/* */
/* <div id="tb-user" style="height:auto">*/
/*     <div>*/
/*         <a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-add',plain:true" onclick="add()">新增</a>*/
/*         <a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-edit',plain:true" onclick="edit()">编辑</a>*/
/*         <a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-ok',plain:true" onclick="up()">上架</a>*/
/*         <a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-no',plain:true" onclick="down()">下架</a>*/
/*         <a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-redo',plain:true" onclick="del()">删除</a>*/
/*     </div>*/
/* </div>*/
/* */
/* <div id="dlg-add" class="easyui-window" title="新增商品" style="width:1242px;height:750px;padding:10px;overflow:hidden;" data-options="*/
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
/* <div id="dlg-edit" class="easyui-window" title="编辑商品" style="width:1242px;height:750px;padding:10px;overflow:hidden;" data-options="*/
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
/* {% endblock %}*/
/* */
/* {% block js %}*/
/* <script>*/
/*     function reloadgrid(){*/
/*         var queryParams = $('#listdata').datagrid('options').queryParams;*/
/*         queryParams.name = $('#name').val();*/
/*         queryParams.bn	= $('#bn').val();*/
/*         queryParams.cat_id	= $('#cat_id').combobox('getValue');*/
/*         queryParams.marketable	= $('#marketable').combobox('getValue');*/
/*         queryParams.allow_share	= $('#allow_share').combobox('getValue');*/
/*         queryParams.limit_num	= $('#limit_num').combobox('getValue');*/
/*         queryParams.buy_unit	= $('#buy_unit').combobox('getValue');*/
/*         $('#listdata').datagrid('options').queryParams = queryParams;*/
/*         $("#listdata").datagrid('reload');*/
/*     }*/
/* */
/*     //格式化*/
/*     function formatPicture(val, row) {*/
/*         product_url = createGoodsUrl(row.id);*/
/*         product_image_url = createGoodsImgUrl(row.picture, photoSize[0], photoSize[0]);*/
/*         return '<a target="_blank" href="'+product_url+'"><img src="'+product_image_url+'"></a>';*/
/*     }*/
/* */
/*     function formatName(val, row) {*/
/*         product_url = createGoodsUrl(row.id);*/
/*         product_image_url = createGoodsImgUrl(row.picture, photoSize[0], photoSize[0]);*/
/*         return '<a target="_blank" href="'+product_url+'">'+val+'</a>';*/
/*     }*/
/* */
/*     function formatBuyUnit(val, row) {*/
/*         if (val==1) {*/
/*             return '否';*/
/*         } else if (val==10) {*/
/*             return '<span style="color:red;">是</span>';*/
/*         }*/
/*         return '未知';*/
/*     }*/
/* */
/*     function formatStatus(val, row) {*/
/*         if (val == 0) {*/
/*             return '下架';*/
/*         } else if (val == 1) {*/
/*             return '上架';*/
/*         } else if (val == 2) {*/
/*             return '新增';*/
/*         }*/
/*     }*/
/* */
/*     function formatShare(val, row) {*/
/*         if (val == 1) {*/
/*             return '是';*/
/*         } else if (val == 0) {*/
/*             return '否';*/
/*         }*/
/*     }*/
/* */
/*     function formatRecommend(val, row) {*/
/*         if (val == 1) {*/
/*             return '是';*/
/*         } else if (val == 0) {*/
/*             return '否';*/
/*         }*/
/*     }*/
/* */
/*     function formatTime(val, row) {*/
/*         var newDate_attend = new Date();*/
/*         newDate_attend.setTime(val * 1000);*/
/*         var my_create_time_attend=newDate_attend.format('yyyy-MM-dd hh:mm:ss');*/
/*         return my_create_time_attend;*/
/*     }*/
/* */
/*     //操作*/
/*     function add() {*/
/*         $('#add_iframe').prop('src', "{{ url('product/add') }}");*/
/*         $('#dlg-add').window('open');*/
/*     }*/
/* */
/*     function edit() {*/
/*         var selRow = $('#listdata').datagrid('getSelected');*/
/*         if (!selRow) {*/
/*             $.messager.alert('错误','请选择商品');*/
/*             return false;*/
/*         }*/
/*         $('#edit_iframe').prop('src', "{{ url('product/edit') }}" + '?id=' + selRow.id);*/
/*         $('#dlg-edit').window('open');*/
/*     }*/
/* */
/*     function up() {*/
/*         var selRow = $('#listdata').datagrid('getSelected');*/
/*         if (!selRow) {*/
/*             $.messager.alert('错误','请选择商品');*/
/*             return false;*/
/*         }*/
/* */
/*         if (selRow.marketable == 1) {*/
/*             $.messager.alert('错误','该商品已上架');*/
/*             return false;*/
/*         }*/
/* */
/*         $.messager.confirm('Confirm', '确认上架吗?', function(r){*/
/*             if (r){*/
/*                 $.post("{{ url('/product/market') }}", {'id':selRow.id, 'market':1}, function(data) {*/
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
/*     function down() {*/
/*         var selRow = $('#listdata').datagrid('getSelected');*/
/*         if (!selRow) {*/
/*             $.messager.alert('错误','请选择商品');*/
/*             return false;*/
/*         }*/
/*         console.log(selRow.marketable);*/
/*         if (selRow.marketable == 0) {*/
/*             $.messager.alert('错误','该商品已下架');*/
/*             return false;*/
/*         }*/
/* */
/*         $.messager.confirm('Confirm', '确认下架吗?', function(r){*/
/*             if (r){*/
/*                 $.post("{{ url('/product/market') }}", {'id':selRow.id, 'market':0}, function(data) {*/
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
/*     function del() {*/
/*         var selRow = $('#listdata').datagrid('getSelected');*/
/*         if (!selRow) {*/
/*             $.messager.alert('错误','请选择商品');*/
/*             return false;*/
/*         }*/
/* */
/*         if (selRow.marketable != 2) {*/
/*             $.messager.alert('错误','只有新增商品才能删除');*/
/*             return false;*/
/*         }*/
/* */
/*         $.messager.confirm('Confirm', '确认删除吗?', function(r) {*/
/*             if (r) {*/
/*                 $.post("{{ url('/product/del') }}", {'id':selRow.id}, function(data) {*/
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
/*     function sort(type, order) {*/
/* */
/*     }*/
/* </script>*/
/* {% endblock %}*/
/* */
/* */
