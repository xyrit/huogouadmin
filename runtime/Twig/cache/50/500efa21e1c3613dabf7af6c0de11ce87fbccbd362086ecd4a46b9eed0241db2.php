<?php

/* index.html */
class __TwigTemplate_ec27a1f9b1fcdf5920a4088b51ba51fde41f061a3053a362e872b935de873aa3 extends yii\twig\Template
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

    // line 2
    public function block_main($context, array $blocks = array())
    {
        // line 3
        echo "

<div id=\"tb-user\" style=\"height:auto\">
  <div>
    <a href=\"javascript:void(0)\" class=\"easyui-linkbutton\" data-options=\"iconCls:'icon-edit',plain:true\"
       onclick=\"edit()\">编辑</a>

  </div>
</div>

<table title=\"通知模版\" id=\"listdata\" class=\"easyui-datagrid\"
       data-options=\"toolbar:'#tb-user',rownumbers:true,singleSelect:true,pagination:true,method:'get',url:'";
        // line 14
        echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url("/notice/index"), "html", null, true);
        echo "',rownumbers: false\">
  <thead>
  <tr>

    <th data-options=\"field:'id', align:'center'\" width=\"100\">ID</th>
    <th data-options=\"field:'desc', align:'center'\" width=\"100\">描述</th>
    <th data-options=\"field:'ways', align:'center'\" width=\"100\">通知方式</th>
    <th data-options=\"field:'statusname', align:'center'\" width=\"100\">状态</th>
    <th data-options=\"field:'updated_at', align:'center'\" width=\"100\">更新时间</th>
    <th data-options=\"field:'op_user', align:'center'\" width=\"100\">操作人</th>

  </tr>

  </thead>
</table>

<div id=\"dlg-edit\" class=\"easyui-window\" title=\"编辑模版\" style=\"width:1242px;height:750px;padding:10px;overflow:hidden;\"
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
";
    }

    // line 43
    public function block_js($context, array $blocks = array())
    {
        // line 44
        echo "<script type=\"text/javascript\">
  \$(function () {
    \$(\"#coupon_type li\").click(function () {
      \$(this).addClass('tree-node-selected').siblings().removeClass('tree-node-selected');
    })
  })
  function choose() {
    var type_id = \$(\".tree-node-selected\").attr('value');
    \$('#coupon-edit').prop('src', 'add?type_id=' + type_id);
    \$('#dlg-view').window('open');
  }


  function edit() {
    var selRow = \$('#listdata').datagrid('getSelections');
    //console.log();return false;
    if (selRow.length != 1) {
      \$.messager.alert('错误', '请选择一个会员');
      return false;
    }
    \$('#edit_iframe').prop('src', \"";
        // line 64
        echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url("notice/edit"), "html", null, true);
        echo "\" + '?id=' + selRow[0].id);
    \$('#dlg-edit').window('open');
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
        return array (  102 => 64,  80 => 44,  77 => 43,  45 => 14,  32 => 3,  29 => 2,  11 => 1,);
    }
}
/* {% extends '@app/views/base.html' %}*/
/* {% block main %}*/
/* */
/* */
/* <div id="tb-user" style="height:auto">*/
/*   <div>*/
/*     <a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-edit',plain:true"*/
/*        onclick="edit()">编辑</a>*/
/* */
/*   </div>*/
/* </div>*/
/* */
/* <table title="通知模版" id="listdata" class="easyui-datagrid"*/
/*        data-options="toolbar:'#tb-user',rownumbers:true,singleSelect:true,pagination:true,method:'get',url:'{{ url('/notice/index') }}',rownumbers: false">*/
/*   <thead>*/
/*   <tr>*/
/* */
/*     <th data-options="field:'id', align:'center'" width="100">ID</th>*/
/*     <th data-options="field:'desc', align:'center'" width="100">描述</th>*/
/*     <th data-options="field:'ways', align:'center'" width="100">通知方式</th>*/
/*     <th data-options="field:'statusname', align:'center'" width="100">状态</th>*/
/*     <th data-options="field:'updated_at', align:'center'" width="100">更新时间</th>*/
/*     <th data-options="field:'op_user', align:'center'" width="100">操作人</th>*/
/* */
/*   </tr>*/
/* */
/*   </thead>*/
/* </table>*/
/* */
/* <div id="dlg-edit" class="easyui-window" title="编辑模版" style="width:1242px;height:750px;padding:10px;overflow:hidden;"*/
/*      data-options="*/
/*             iconCls:'icon-save',*/
/*             closed:true,*/
/*             modal:true,*/
/*             onResize:function(){*/
/*                 $(this).window('hcenter');*/
/*             }">*/
/*   <iframe width="100%" height="100%" frameborder="0" id="edit_iframe">*/
/*   </iframe>*/
/* </div>*/
/* {% endblock %}*/
/* */
/* {% block js %}*/
/* <script type="text/javascript">*/
/*   $(function () {*/
/*     $("#coupon_type li").click(function () {*/
/*       $(this).addClass('tree-node-selected').siblings().removeClass('tree-node-selected');*/
/*     })*/
/*   })*/
/*   function choose() {*/
/*     var type_id = $(".tree-node-selected").attr('value');*/
/*     $('#coupon-edit').prop('src', 'add?type_id=' + type_id);*/
/*     $('#dlg-view').window('open');*/
/*   }*/
/* */
/* */
/*   function edit() {*/
/*     var selRow = $('#listdata').datagrid('getSelections');*/
/*     //console.log();return false;*/
/*     if (selRow.length != 1) {*/
/*       $.messager.alert('错误', '请选择一个会员');*/
/*       return false;*/
/*     }*/
/*     $('#edit_iframe').prop('src', "{{ url('notice/edit')}}" + '?id=' + selRow[0].id);*/
/*     $('#dlg-edit').window('open');*/
/*   }*/
/* </script>*/
/* {% endblock %}*/
/* */
/* */
/* */
