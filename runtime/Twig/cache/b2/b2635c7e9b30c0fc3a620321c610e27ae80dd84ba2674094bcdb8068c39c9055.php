<?php

/* list.html */
class __TwigTemplate_8bbd4a58bb4e5b2cb6f0d96c629f468ef018a2a63b84c09010729e0c66216c22 extends yii\twig\Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("@app/views/base.html", "list.html", 1);
        $this->blocks = array(
            'main' => array($this, 'block_main'),
            'script' => array($this, 'block_script'),
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
";
        // line 5
        if (((isset($context["type"]) ? $context["type"] : null) != 4)) {
            // line 6
            echo "<table id=\"listdata\" class=\"easyui-datagrid\" title=\"任务列表\" data-options=\"toolbar:'#tb-user',singleSelect:false,pagination:true,method:'get',url:'";
            echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url("user-task/list", array("type" => (isset($context["type"]) ? $context["type"] : null))), "html", null, true);
            echo "',pageSize: 20\">
    <thead>
    <tr>
        <th data-options=\"field:'date', width:200, align:'center'\">时间</th>
        <th data-options=\"field:'count', width:200, align:'center'\">参与人数</th>
    </tr>
    </thead>
</table>
<div id=\"tb-user\" style=\"height:auto\">
    <div>
        <a href=\"javascript:void(0)\" class=\"easyui-linkbutton\" data-options=\"iconCls:'icon-edit',plain:true\" onclick=\"view()\">查看详情</a>
    </div>
</div>
";
        } else {
            // line 20
            echo "<div class=\"easyui-tabs\" style=\"padding:10px;height: 750px;\" id=\"view_tabs\">
    <div title=\"称号\" style=\"padding:10px;\" >
        <iframe width=\"100%\" height=\"100%\" frameborder=\"0\" id=\"glory_iframe\" src=\"";
            // line 22
            echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url("user-task/glory-list"), "html", null, true);
            echo "\"></iframe>
    </div>
    <div title=\"等级\" style=\"padding:10px;\">
        <iframe width=\"100%\" height=\"100%\" frameborder=\"0\" id=\"level_iframe\"></iframe>
    </div>
    <div title=\"充值\" style=\"padding:10px;\">
        <iframe width=\"100%\" height=\"100%\" frameborder=\"0\" id=\"grow_iframe\"></iframe>
    </div>
</div>
";
        }
        // line 32
        echo "
<div id=\"dlg-view\" class=\"easyui-window\" title=\"查看详情\" style=\"width:1242px;height:600px;padding:10px;overflow:hidden;\" data-options=\"
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

    // line 46
    public function block_script($context, array $blocks = array())
    {
        // line 47
        echo "<script type=\"text/javascript\">
    function view() {
        var selRow = \$('#listdata').datagrid('getSelected');
        if (!selRow) {
            \$.messager.alert('错误','请选择一行');
            return false;
        }
        \$('#view_iframe').prop('src', \"";
        // line 54
        echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url("user-task/detail"), "html", null, true);
        echo "\"+'?date='+selRow.date+'&type='+selRow.type+'&level='+selRow.level+'&cate='+selRow.cate+'&num='+selRow.num);
        \$('#dlg-view').window('open');
    }

    \$('#view_tabs').tabs({
        onSelect: function(title, index){
            switch (title) {
                case '称号':
                    break;
                case '等级':
                    \$('#level_iframe').prop('src', \"";
        // line 64
        echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url("user-task/level-list"), "html", null, true);
        echo "\");
                    break;
                case '充值':
                    \$('#grow_iframe').prop('src', \"";
        // line 67
        echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url("user-task/grow-list"), "html", null, true);
        echo "\");
                    break;
            }
        }
    });
</script>
";
    }

    public function getTemplateName()
    {
        return "list.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  119 => 67,  113 => 64,  100 => 54,  91 => 47,  88 => 46,  72 => 32,  59 => 22,  55 => 20,  37 => 6,  35 => 5,  32 => 4,  29 => 3,  11 => 1,);
    }
}
/* {% extends '@app/views/base.html' %}*/
/*   */
/* {% block main %}*/
/* */
/* {% if type != 4 %}*/
/* <table id="listdata" class="easyui-datagrid" title="任务列表" data-options="toolbar:'#tb-user',singleSelect:false,pagination:true,method:'get',url:'{{  url('user-task/list', {'type': type})}}',pageSize: 20">*/
/*     <thead>*/
/*     <tr>*/
/*         <th data-options="field:'date', width:200, align:'center'">时间</th>*/
/*         <th data-options="field:'count', width:200, align:'center'">参与人数</th>*/
/*     </tr>*/
/*     </thead>*/
/* </table>*/
/* <div id="tb-user" style="height:auto">*/
/*     <div>*/
/*         <a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-edit',plain:true" onclick="view()">查看详情</a>*/
/*     </div>*/
/* </div>*/
/* {% else %}*/
/* <div class="easyui-tabs" style="padding:10px;height: 750px;" id="view_tabs">*/
/*     <div title="称号" style="padding:10px;" >*/
/*         <iframe width="100%" height="100%" frameborder="0" id="glory_iframe" src="{{ url('user-task/glory-list') }}"></iframe>*/
/*     </div>*/
/*     <div title="等级" style="padding:10px;">*/
/*         <iframe width="100%" height="100%" frameborder="0" id="level_iframe"></iframe>*/
/*     </div>*/
/*     <div title="充值" style="padding:10px;">*/
/*         <iframe width="100%" height="100%" frameborder="0" id="grow_iframe"></iframe>*/
/*     </div>*/
/* </div>*/
/* {% endif %}*/
/* */
/* <div id="dlg-view" class="easyui-window" title="查看详情" style="width:1242px;height:600px;padding:10px;overflow:hidden;" data-options="*/
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
/* {% block script %}*/
/* <script type="text/javascript">*/
/*     function view() {*/
/*         var selRow = $('#listdata').datagrid('getSelected');*/
/*         if (!selRow) {*/
/*             $.messager.alert('错误','请选择一行');*/
/*             return false;*/
/*         }*/
/*         $('#view_iframe').prop('src', "{{ url('user-task/detail') }}"+'?date='+selRow.date+'&type='+selRow.type+'&level='+selRow.level+'&cate='+selRow.cate+'&num='+selRow.num);*/
/*         $('#dlg-view').window('open');*/
/*     }*/
/* */
/*     $('#view_tabs').tabs({*/
/*         onSelect: function(title, index){*/
/*             switch (title) {*/
/*                 case '称号':*/
/*                     break;*/
/*                 case '等级':*/
/*                     $('#level_iframe').prop('src', "{{ url('user-task/level-list') }}");*/
/*                     break;*/
/*                 case '充值':*/
/*                     $('#grow_iframe').prop('src', "{{ url('user-task/grow-list') }}");*/
/*                     break;*/
/*             }*/
/*         }*/
/*     });*/
/* </script>*/
/* {% endblock %}*/
