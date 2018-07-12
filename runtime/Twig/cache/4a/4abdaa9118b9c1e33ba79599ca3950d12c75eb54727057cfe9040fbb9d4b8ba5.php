<?php

/* index.html */
class __TwigTemplate_363687f21111cbeb3dd807c056788ef5f98b2c15539b503b9a2fd9c4964305c6 extends yii\twig\Template
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
    <span>
        活动名称<input class=\"easyui-textbox\" type=\"text\" name=\"name\" id=\"name\">
    </span>
    <span>
        <select class=\"easyui-combobox\" id=\"status\" name=\"status\" data-options=\"required:true,panelHeight:'auto'\">
            <option value=\"\">全部</option>
            <option value=\"1\">正常</option>
            <option value=\"2\">停用</option>
            <option value=\"3\">已过期</option>
        </select>
    </span>
    <a href=\"javascript:void(0);\" onclick=\"reloadgrid();\" class=\"easyui-linkbutton\" iconCls=\"icon-search\">搜索</a>
</div>

<table id=\"listdata\"  class=\"easyui-datagrid\" title=\"抽奖列表\" data-options=\"toolbar:'#tb-user',singleSelect:true,pagination:true,method:'get',url:'";
        // line 20
        echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url("lottery/index"), "html", null, true);
        echo "',pageSize:20\">
    <thead>
    <tr>
        <th data-options=\"field:'id', width:200, align:'center'\">序号</th>
        <th data-options=\"field:'name', width:200, align:'center'\">活动名称</th>
        <th data-options=\"field:'time', width:300, align:'center'\">活动时间</th>
        <th data-options=\"field:'reward', width:430, align:'center'\">奖品名称/奖品内容</th>
        <th data-options=\"field:'left', width:300, align:'center'\">中奖数量/总数量</th>
        <th data-options=\"field:'status', width:100, align:'center'\" formatter=\"formatStatus\">状态</th>
    </tr>
    </thead>
</table>

<div id=\"tb-user\" style=\"height:auto\">
    <div>
        ";
        // line 35
        if (((isset($context["add"]) ? $context["add"] : null) == 1)) {
            // line 36
            echo "        <a href=\"javascript:void(0)\" class=\"easyui-linkbutton\" data-options=\"iconCls:'icon-add',plain:true\" onclick=\"add()\">配置抽奖</a>
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
        if (((isset($context["lottery"]) ? $context["lottery"] : null) == 1)) {
            // line 42
            echo "        <a href=\"javascript:void(0)\" class=\"easyui-linkbutton\" data-options=\"iconCls:'icon-view',plain:true\" onclick=\"join(1)\">中奖明细</a>
        ";
        }
        // line 44
        echo "        ";
        if (((isset($context["join"]) ? $context["join"] : null) == 1)) {
            // line 45
            echo "        <a href=\"javascript:void(0)\" class=\"easyui-linkbutton\" data-options=\"iconCls:'icon-view',plain:true\" onclick=\"join(2)\">参与明细</a>
        ";
        }
        // line 47
        echo "    </div>
</div>

<div id=\"dlg-add\" class=\"easyui-window\" title=\"配置抽奖\" style=\"width:898px;height:750px;padding:10px;\" data-options=\"iconCls:'icon-save',closed:true,modal:true,onResize:function(){ \$(this).window('hcenter');}\">
    <iframe width=\"100%\" height=\"100%\" frameborder=\"0\" id=\"add_iframe\"></iframe>
</div>

<div id=\"dlg-join\" class=\"easyui-window\" title=\"抽奖列表\" style=\"width:1050px;height:700px;padding:10px;\" data-options=\"iconCls:'icon-save',closed:true,modal:true,onResize:function(){ \$(this).window('hcenter');}\">
    <iframe width=\"100%\" height=\"100%\" frameborder=\"0\" id=\"join_iframe\"></iframe>
</div>
";
    }

    // line 59
    public function block_js($context, array $blocks = array())
    {
        // line 60
        echo "<script>
    function join(req)
    {
        var selRow = \$('#listdata').datagrid('getSelected');
        if (!selRow) {
            \$.messager.alert('错误','请至少选择一个');
            return false;
        }

        if(req == 1){
            \$('#join_iframe').prop('src', \"";
        // line 70
        echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url("lottery/lottery"), "html", null, true);
        echo "\" + '?id=' + selRow.id);
        }else if(req == 2){
            \$('#join_iframe').prop('src', \"";
        // line 72
        echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url("lottery/join"), "html", null, true);
        echo "\" + '?id=' + selRow.id);
        }

        \$('#dlg-join').window('open');
    }

    function edit(){
        var selRow = \$('#listdata').datagrid('getSelected');
        if (!selRow) {
            \$.messager.alert('错误','请至少选择一个');
            return false;
        }

        \$('#add_iframe').prop('src', \"";
        // line 85
        echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url("lottery/edit"), "html", null, true);
        echo "\" + '?id=' + selRow.id);
        \$('#dlg-add').window('open');
    }

    function formatStatus(val, row){
        if(val == 1){
            return '启用';
        } else if(val == 2){
            return '<span color=\"red\">停用</span>'
        }else if(val == 3){
            return '已过期'
        }else{
            return '未启用';
        }
    }
    function add(){
        \$('#add_iframe').prop('src',  'add');
        \$('#dlg-add').window('open');
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
        return array (  145 => 85,  129 => 72,  124 => 70,  112 => 60,  109 => 59,  95 => 47,  91 => 45,  88 => 44,  84 => 42,  81 => 41,  77 => 39,  74 => 38,  70 => 36,  68 => 35,  50 => 20,  32 => 4,  29 => 3,  11 => 1,);
    }
}
/* {% extends '@app/views/base.html' %}*/
/* */
/* {% block main %}*/
/* */
/* <div class="search">*/
/*     <span>*/
/*         活动名称<input class="easyui-textbox" type="text" name="name" id="name">*/
/*     </span>*/
/*     <span>*/
/*         <select class="easyui-combobox" id="status" name="status" data-options="required:true,panelHeight:'auto'">*/
/*             <option value="">全部</option>*/
/*             <option value="1">正常</option>*/
/*             <option value="2">停用</option>*/
/*             <option value="3">已过期</option>*/
/*         </select>*/
/*     </span>*/
/*     <a href="javascript:void(0);" onclick="reloadgrid();" class="easyui-linkbutton" iconCls="icon-search">搜索</a>*/
/* </div>*/
/* */
/* <table id="listdata"  class="easyui-datagrid" title="抽奖列表" data-options="toolbar:'#tb-user',singleSelect:true,pagination:true,method:'get',url:'{{  url('lottery/index')}}',pageSize:20">*/
/*     <thead>*/
/*     <tr>*/
/*         <th data-options="field:'id', width:200, align:'center'">序号</th>*/
/*         <th data-options="field:'name', width:200, align:'center'">活动名称</th>*/
/*         <th data-options="field:'time', width:300, align:'center'">活动时间</th>*/
/*         <th data-options="field:'reward', width:430, align:'center'">奖品名称/奖品内容</th>*/
/*         <th data-options="field:'left', width:300, align:'center'">中奖数量/总数量</th>*/
/*         <th data-options="field:'status', width:100, align:'center'" formatter="formatStatus">状态</th>*/
/*     </tr>*/
/*     </thead>*/
/* </table>*/
/* */
/* <div id="tb-user" style="height:auto">*/
/*     <div>*/
/*         {% if(add == 1) %}*/
/*         <a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-add',plain:true" onclick="add()">配置抽奖</a>*/
/*         {% endif %}*/
/*         {% if(edit == 1) %}*/
/*         <a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-edit',plain:true" onclick="edit()">编辑</a>*/
/*         {% endif %}*/
/*         {% if(lottery == 1) %}*/
/*         <a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-view',plain:true" onclick="join(1)">中奖明细</a>*/
/*         {% endif %}*/
/*         {% if(join == 1) %}*/
/*         <a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-view',plain:true" onclick="join(2)">参与明细</a>*/
/*         {% endif %}*/
/*     </div>*/
/* </div>*/
/* */
/* <div id="dlg-add" class="easyui-window" title="配置抽奖" style="width:898px;height:750px;padding:10px;" data-options="iconCls:'icon-save',closed:true,modal:true,onResize:function(){ $(this).window('hcenter');}">*/
/*     <iframe width="100%" height="100%" frameborder="0" id="add_iframe"></iframe>*/
/* </div>*/
/* */
/* <div id="dlg-join" class="easyui-window" title="抽奖列表" style="width:1050px;height:700px;padding:10px;" data-options="iconCls:'icon-save',closed:true,modal:true,onResize:function(){ $(this).window('hcenter');}">*/
/*     <iframe width="100%" height="100%" frameborder="0" id="join_iframe"></iframe>*/
/* </div>*/
/* {% endblock %}*/
/* */
/* {% block js %}*/
/* <script>*/
/*     function join(req)*/
/*     {*/
/*         var selRow = $('#listdata').datagrid('getSelected');*/
/*         if (!selRow) {*/
/*             $.messager.alert('错误','请至少选择一个');*/
/*             return false;*/
/*         }*/
/* */
/*         if(req == 1){*/
/*             $('#join_iframe').prop('src', "{{ url('lottery/lottery') }}" + '?id=' + selRow.id);*/
/*         }else if(req == 2){*/
/*             $('#join_iframe').prop('src', "{{ url('lottery/join') }}" + '?id=' + selRow.id);*/
/*         }*/
/* */
/*         $('#dlg-join').window('open');*/
/*     }*/
/* */
/*     function edit(){*/
/*         var selRow = $('#listdata').datagrid('getSelected');*/
/*         if (!selRow) {*/
/*             $.messager.alert('错误','请至少选择一个');*/
/*             return false;*/
/*         }*/
/* */
/*         $('#add_iframe').prop('src', "{{ url('lottery/edit') }}" + '?id=' + selRow.id);*/
/*         $('#dlg-add').window('open');*/
/*     }*/
/* */
/*     function formatStatus(val, row){*/
/*         if(val == 1){*/
/*             return '启用';*/
/*         } else if(val == 2){*/
/*             return '<span color="red">停用</span>'*/
/*         }else if(val == 3){*/
/*             return '已过期'*/
/*         }else{*/
/*             return '未启用';*/
/*         }*/
/*     }*/
/*     function add(){*/
/*         $('#add_iframe').prop('src',  'add');*/
/*         $('#dlg-add').window('open');*/
/*     }*/
/* </script>*/
/* {% endblock %}*/
