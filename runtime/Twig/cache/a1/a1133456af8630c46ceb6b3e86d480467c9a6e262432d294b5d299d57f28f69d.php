<?php

/* index.html */
class __TwigTemplate_35284d0a831a4643c16bf4171a13f7b3142f78b23d0ac5f150879464e36f538e extends yii\twig\Template
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
        echo "<table title=\"优惠券列表\" id=\"listdata\" class=\"easyui-datagrid\" data-options=\"toolbar:'#tb-user',rownumbers:true,singleSelect:true,pagination:true,method:'get',url:'";
        echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url("/coupon/index"), "html", null, true);
        echo "',rownumbers: false\">
    <thead>
    <tr>
        <th data-options=\"field:'id',align:'center'\" width=\"50\">ID</th>
        <th data-options=\"field:'name', align:'center'\" width=\"150\">优惠券名称</th>
        <th data-options=\"field:'type_name', align:'center'\" width=\"150\">优惠券类型</th>
        <th data-options=\"field:'valid_time', align:'center'\" width=\"350\">优惠券有效期</th>
        <th data-options=\"field:'num', align:'center'\" width=\"100\">生成数量</th>
        <th data-options=\"field:'receive_limit', align:'center'\" width=\"100\">领取限制</th>
        <th data-options=\"field:'send_num', align:'center'\" width=\"100\">发出数量</th>
        <th data-options=\"field:'left_num', align:'center'\" width=\"100\">剩余数量</th>
        <th data-options=\"field:'status', align:'center'\" width=\"100\">优惠券状态</th>
        <th data-options=\"field:'create_time', align:'center'\" width=\"150\">创建时间</th>
    </tr>
    </thead>
</table>

<div id=\"tb-user\" style=\"height:auto\">
    <div>
        <a href=\"javascript:void(0)\" class=\"easyui-linkbutton\" data-options=\"iconCls:'icon-add',plain:true\" onclick=\"javascript:\$('#choose_type').dialog('open')\">新增优惠券</a>
        <a href=\"javascript:void(0)\" class=\"easyui-linkbutton\" data-options=\"iconCls:'icon-edit',plain:true\" onclick=\"edit()\">详情</a>
        <a href=\"javascript:void(0)\" class=\"easyui-linkbutton\" data-options=\"iconCls:'icon-view',plain:true\" onclick=\"view()\">明细</a>
    </div>
</div>

<div class=\"easyui-window\" data-options=\"closed:true,\" id=\"dlg-view\" title=\"新增优惠券\" style=\"width:750px;height: auto\" modal=\"true\">
    <iframe id=\"coupon-edit\" frameborder=\"0\" style=\"width:786px;height: 640px;\" scrolling=\"yes\"></iframe>
</div>

<!--新增优惠券-->
<!-- 选择优惠券类型 -->
<div id=\"choose_type\" title=\"选择优惠券类型\" class=\"easyui-dialog\" style=\"width:250px;height:auto;padding:10px 20px\" modal=\"true\" closed=\"true\" buttons=\"#dlg-buttons-choose\" >
    <ul id=\"coupon_type\" class=\"tree\">
        <li style=\"list-style: none;text-align: center;height: 40px;border: 1px solid ;margin: 15px;line-height:40px;cursor: pointer;\" value=\"1\">代金券</li>
        <li style=\"list-style: none;text-align: center;height: 40px;border: 1px solid ;margin: 15px;line-height:40px;cursor: pointer;\" value=\"2\">折扣券</li>
        <li style=\"list-style: none;text-align: center;height: 40px;border: 1px solid ;margin: 15px;line-height:40px;cursor: pointer;\" value=\"3\">礼品券</li>
    </ul>
</div>


<div id=\"dlg-buttons-choose\" style=\"text-align:center;padding:5px\">
    <a class=\"easyui-linkbutton\" iconCls=\"icon-ok\" onclick=\"choose()\">确定</a>
    <a class=\"easyui-linkbutton\" iconCls=\"icon-cancel\" onclick=\"javascript:\$('#choose_type').dialog('close')\">取消</a>
</div>

";
    }

    // line 51
    public function block_js($context, array $blocks = array())
    {
        // line 52
        echo "<script type=\"text/javascript\">
    \$(function(){
        \$(\"#coupon_type li\").click(function(){
            \$(this).addClass('tree-node-selected').siblings().removeClass('tree-node-selected');
        })
    })
    function choose(){
        var type_id = \$(\".tree-node-selected\").attr('value');
        \$('#coupon-edit').prop('src',  'add?type_id=' + type_id);
        \$('#dlg-view').window('open');
    }
    function edit() {
        var selRow = \$('#listdata').treegrid('getSelected');
        if (!selRow) {
            \$.messager.alert('错误','请选择优惠券');
            return false;
        }
        \$('#coupon-edit').prop('src',  '/coupon/edit?id=' + selRow.id);
        \$('#dlg-view').window('open');
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
        return array (  86 => 52,  83 => 51,  32 => 4,  29 => 3,  11 => 1,);
    }
}
/* {% extends '@app/views/base.html' %}*/
/* */
/* {% block main %}*/
/* <table title="优惠券列表" id="listdata" class="easyui-datagrid" data-options="toolbar:'#tb-user',rownumbers:true,singleSelect:true,pagination:true,method:'get',url:'{{ url('/coupon/index') }}',rownumbers: false">*/
/*     <thead>*/
/*     <tr>*/
/*         <th data-options="field:'id',align:'center'" width="50">ID</th>*/
/*         <th data-options="field:'name', align:'center'" width="150">优惠券名称</th>*/
/*         <th data-options="field:'type_name', align:'center'" width="150">优惠券类型</th>*/
/*         <th data-options="field:'valid_time', align:'center'" width="350">优惠券有效期</th>*/
/*         <th data-options="field:'num', align:'center'" width="100">生成数量</th>*/
/*         <th data-options="field:'receive_limit', align:'center'" width="100">领取限制</th>*/
/*         <th data-options="field:'send_num', align:'center'" width="100">发出数量</th>*/
/*         <th data-options="field:'left_num', align:'center'" width="100">剩余数量</th>*/
/*         <th data-options="field:'status', align:'center'" width="100">优惠券状态</th>*/
/*         <th data-options="field:'create_time', align:'center'" width="150">创建时间</th>*/
/*     </tr>*/
/*     </thead>*/
/* </table>*/
/* */
/* <div id="tb-user" style="height:auto">*/
/*     <div>*/
/*         <a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-add',plain:true" onclick="javascript:$('#choose_type').dialog('open')">新增优惠券</a>*/
/*         <a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-edit',plain:true" onclick="edit()">详情</a>*/
/*         <a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-view',plain:true" onclick="view()">明细</a>*/
/*     </div>*/
/* </div>*/
/* */
/* <div class="easyui-window" data-options="closed:true," id="dlg-view" title="新增优惠券" style="width:750px;height: auto" modal="true">*/
/*     <iframe id="coupon-edit" frameborder="0" style="width:786px;height: 640px;" scrolling="yes"></iframe>*/
/* </div>*/
/* */
/* <!--新增优惠券-->*/
/* <!-- 选择优惠券类型 -->*/
/* <div id="choose_type" title="选择优惠券类型" class="easyui-dialog" style="width:250px;height:auto;padding:10px 20px" modal="true" closed="true" buttons="#dlg-buttons-choose" >*/
/*     <ul id="coupon_type" class="tree">*/
/*         <li style="list-style: none;text-align: center;height: 40px;border: 1px solid ;margin: 15px;line-height:40px;cursor: pointer;" value="1">代金券</li>*/
/*         <li style="list-style: none;text-align: center;height: 40px;border: 1px solid ;margin: 15px;line-height:40px;cursor: pointer;" value="2">折扣券</li>*/
/*         <li style="list-style: none;text-align: center;height: 40px;border: 1px solid ;margin: 15px;line-height:40px;cursor: pointer;" value="3">礼品券</li>*/
/*     </ul>*/
/* </div>*/
/* */
/* */
/* <div id="dlg-buttons-choose" style="text-align:center;padding:5px">*/
/*     <a class="easyui-linkbutton" iconCls="icon-ok" onclick="choose()">确定</a>*/
/*     <a class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#choose_type').dialog('close')">取消</a>*/
/* </div>*/
/* */
/* {% endblock %}*/
/* */
/* {% block js %}*/
/* <script type="text/javascript">*/
/*     $(function(){*/
/*         $("#coupon_type li").click(function(){*/
/*             $(this).addClass('tree-node-selected').siblings().removeClass('tree-node-selected');*/
/*         })*/
/*     })*/
/*     function choose(){*/
/*         var type_id = $(".tree-node-selected").attr('value');*/
/*         $('#coupon-edit').prop('src',  'add?type_id=' + type_id);*/
/*         $('#dlg-view').window('open');*/
/*     }*/
/*     function edit() {*/
/*         var selRow = $('#listdata').treegrid('getSelected');*/
/*         if (!selRow) {*/
/*             $.messager.alert('错误','请选择优惠券');*/
/*             return false;*/
/*         }*/
/*         $('#coupon-edit').prop('src',  '/coupon/edit?id=' + selRow.id);*/
/*         $('#dlg-view').window('open');*/
/*     }*/
/* </script>*/
/* {% endblock %}*/
