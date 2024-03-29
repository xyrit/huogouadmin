<?php

/* mobilelist.html */
class __TwigTemplate_f1c8737213f403deab38f8cea9ebc3a165d5ba00c78beab25516ff8557ea6e18 extends yii\twig\Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("@app/views/base.html", "mobilelist.html", 1);
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
<div id=\"tb-user\" style=\"height:auto\">
    <div>
        <a href=\"javascript:void(0)\" class=\"easyui-linkbutton\" data-options=\"iconCls:'icon-edit',plain:true\"
           onclick=\"edit()\">查看</a>
        <a href=\"javascript:void(0)\" class=\"easyui-linkbutton\" data-options=\"iconCls:'icon-edit',plain:true\"
           onclick=\"addmobile()\">添加手机号</a>
    </div>
</div>
</div>
<table id=\"listdata\" class=\"easyui-datagrid\" title=\"回购订单表\"
       data-options=\"toolbar:'#tb-user',singleSelect:true,pagination:true,method:'get',url:'";
        // line 15
        echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url("jdcardbuyback/mobile-list"), "html", null, true);
        echo "',nowrap:false,rownumbers: false\">
    <thead>
    <tr>
        <th data-options=\"field:'id', width:150, align:'center'\">编号</th>
        <th data-options=\"field:'mobile', width:180, align:'center'\">回购帐号</th>
        <th data-options=\"field:'z', width:180, align:'center'\">累计张数</th>
        <th data-options=\"field:'y', width:180, align:'center'\">已付款张数</th>
        <th data-options=\"field:'n', width:180, align:'center'\">未付款张数</th>

    </tr>
    </thead>
</table>
<div id=\"dlg-edit\" class=\"easyui-window\" title=\"查看\" style=\"width:1300px;height:750px;padding:10px;overflow:hidden;\"
     data-options=\"
            iconCls:'icon-save',
            closed:true,
            modal:true,
            onResize:function(){
                \$(this).window('hcenter');
            }\">
    <iframe width=\"100%\" height=\"100%\" frameborder=\"0\" id=\"edit_iframe\">
    </iframe>
</div>
<div id=\"dlg-addmobile\" class=\"easyui-window\" title=\"添加手机号\"
     style=\"width:350px;height:auto;padding:10px 20px;overflow:hidden;\"
     data-options=\"
            iconCls:'icon-save',
            closed:true,
            modal:true,
            onResize:function(){
                \$(this).window('hcenter');
            }\">

    ";
        // line 48
        echo $this->getAttribute((isset($context["html"]) ? $context["html"] : null), "beginForm", array(0 => "/jdcardbuyback/buyback-addmobile", 1 => "post", 2 => array("class" => "am-form am-form-horizontal", "id" => "addForm")), "method");
        // line 49
        echo "
    <table cellpadding=\"5\">
        <tr>
            <td>手机号</td>
            <td><input class=\"easyui-textbox\" type=\"text\" name=\"mobile\" data-options=\"required:true\"></td>
        </tr>

    </table>
    <div class=\"dialog-button\" id=\"dlg-buttons-edit\"
         style=\"text-align: center; padding: 5px; position: relative; top: -1px; width: 326px;\">
        <input type=\"button\" class=\"addmobile\" value=\"确定\">
    </div>
</div>
";
        // line 62
        echo $this->getAttribute((isset($context["html"]) ? $context["html"] : null), "endForm", array(), "method");
        echo "

</div>

";
    }

    // line 68
    public function block_js($context, array $blocks = array())
    {
        // line 69
        echo "<script>

    function edit() {
        var selRow = \$('#listdata').datagrid('getSelected');

        if (!selRow) {
            \$.messager.alert('错误', '请选择一个');
            return false;
        }
        \$('#edit_iframe').prop('src', \"";
        // line 78
        echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url("jdcardbuyback/buyback-list"), "html", null, true);
        echo "\" + '?mobile=' + selRow.mobile);

        \$('#dlg-edit').window('open');
    }
    function addmobile() {
        \$('#dlg-addmobile').window('open');
    }

    \$('.addmobile').click(function () {
        \$.ajax({
            type: \"POST\",
            url: \"/jdcardbuyback/buyback-addmobile\",
            data: \$('#addForm').serialize(),
            dataType: \"json\",
            success: function (data) {

                if (data.error > 0) {
                    \$.messager.alert('成功', data.message);

                } else {
                    \$.messager.alert('添加失败', data.message);
                }
            },
            beforeSend: function () {

            },
            complete: function () {

            }
        });

    })



</script>
";
    }

    public function getTemplateName()
    {
        return "mobilelist.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  121 => 78,  110 => 69,  107 => 68,  98 => 62,  83 => 49,  81 => 48,  45 => 15,  32 => 4,  29 => 3,  11 => 1,);
    }
}
/* {% extends '@app/views/base.html' %}*/
/* */
/* {% block main %}*/
/* */
/* <div id="tb-user" style="height:auto">*/
/*     <div>*/
/*         <a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-edit',plain:true"*/
/*            onclick="edit()">查看</a>*/
/*         <a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-edit',plain:true"*/
/*            onclick="addmobile()">添加手机号</a>*/
/*     </div>*/
/* </div>*/
/* </div>*/
/* <table id="listdata" class="easyui-datagrid" title="回购订单表"*/
/*        data-options="toolbar:'#tb-user',singleSelect:true,pagination:true,method:'get',url:'{{url('jdcardbuyback/mobile-list')}}',nowrap:false,rownumbers: false">*/
/*     <thead>*/
/*     <tr>*/
/*         <th data-options="field:'id', width:150, align:'center'">编号</th>*/
/*         <th data-options="field:'mobile', width:180, align:'center'">回购帐号</th>*/
/*         <th data-options="field:'z', width:180, align:'center'">累计张数</th>*/
/*         <th data-options="field:'y', width:180, align:'center'">已付款张数</th>*/
/*         <th data-options="field:'n', width:180, align:'center'">未付款张数</th>*/
/* */
/*     </tr>*/
/*     </thead>*/
/* </table>*/
/* <div id="dlg-edit" class="easyui-window" title="查看" style="width:1300px;height:750px;padding:10px;overflow:hidden;"*/
/*      data-options="*/
/*             iconCls:'icon-save',*/
/*             closed:true,*/
/*             modal:true,*/
/*             onResize:function(){*/
/*                 $(this).window('hcenter');*/
/*             }">*/
/*     <iframe width="100%" height="100%" frameborder="0" id="edit_iframe">*/
/*     </iframe>*/
/* </div>*/
/* <div id="dlg-addmobile" class="easyui-window" title="添加手机号"*/
/*      style="width:350px;height:auto;padding:10px 20px;overflow:hidden;"*/
/*      data-options="*/
/*             iconCls:'icon-save',*/
/*             closed:true,*/
/*             modal:true,*/
/*             onResize:function(){*/
/*                 $(this).window('hcenter');*/
/*             }">*/
/* */
/*     {{ html.beginForm('/jdcardbuyback/buyback-addmobile', 'post', {'class':'am-form am-form-horizontal',*/
/*     'id':'addForm'}) | raw }}*/
/*     <table cellpadding="5">*/
/*         <tr>*/
/*             <td>手机号</td>*/
/*             <td><input class="easyui-textbox" type="text" name="mobile" data-options="required:true"></td>*/
/*         </tr>*/
/* */
/*     </table>*/
/*     <div class="dialog-button" id="dlg-buttons-edit"*/
/*          style="text-align: center; padding: 5px; position: relative; top: -1px; width: 326px;">*/
/*         <input type="button" class="addmobile" value="确定">*/
/*     </div>*/
/* </div>*/
/* {{ html.endForm() | raw }}*/
/* */
/* </div>*/
/* */
/* {% endblock %}*/
/* */
/* {% block js %}*/
/* <script>*/
/* */
/*     function edit() {*/
/*         var selRow = $('#listdata').datagrid('getSelected');*/
/* */
/*         if (!selRow) {*/
/*             $.messager.alert('错误', '请选择一个');*/
/*             return false;*/
/*         }*/
/*         $('#edit_iframe').prop('src', "{{ url('jdcardbuyback/buyback-list') }}" + '?mobile=' + selRow.mobile);*/
/* */
/*         $('#dlg-edit').window('open');*/
/*     }*/
/*     function addmobile() {*/
/*         $('#dlg-addmobile').window('open');*/
/*     }*/
/* */
/*     $('.addmobile').click(function () {*/
/*         $.ajax({*/
/*             type: "POST",*/
/*             url: "/jdcardbuyback/buyback-addmobile",*/
/*             data: $('#addForm').serialize(),*/
/*             dataType: "json",*/
/*             success: function (data) {*/
/* */
/*                 if (data.error > 0) {*/
/*                     $.messager.alert('成功', data.message);*/
/* */
/*                 } else {*/
/*                     $.messager.alert('添加失败', data.message);*/
/*                 }*/
/*             },*/
/*             beforeSend: function () {*/
/* */
/*             },*/
/*             complete: function () {*/
/* */
/*             }*/
/*         });*/
/* */
/*     })*/
/* */
/* */
/* */
/* </script>*/
/* {% endblock %}*/
