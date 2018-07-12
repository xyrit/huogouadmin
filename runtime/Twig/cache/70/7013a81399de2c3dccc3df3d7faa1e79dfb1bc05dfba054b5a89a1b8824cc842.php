<?php

/* index.html */
class __TwigTemplate_544a7ceebe91b3cd2c51c775a4698afe5ed5cf885fb6429d86788910fecfa01e extends yii\twig\Template
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
        echo "<table title=\"注册礼包配置\" id=\"listdata\" class=\"easyui-datagrid\" data-options=\"toolbar:'#tb-user'\"></table>
<div id=\"tb-user\" style=\"height:auto\">
    ";
        // line 6
        echo $this->getAttribute((isset($context["html"]) ? $context["html"] : null), "beginForm", array(0 => "", 1 => "post", 2 => array("class" => "am-form am-form-horizontal", "id" => "addForm")), "method");
        echo "
    <table cellSpacing=10>
        <tr>
            <th>活动状态</th>
            <td colspan=\"2\">
                <select class=\"easyui-combobox\" name=\"status\" style=\"height: auto;\">
                    <option value=\"0\" ";
        // line 12
        if (($this->getAttribute((isset($context["config"]) ? $context["config"] : null), "status", array()) == 0)) {
            echo "selected=\"selected\" ";
        }
        echo ">关闭</option>
                    <option value=\"1\" ";
        // line 13
        if (($this->getAttribute((isset($context["config"]) ? $context["config"] : null), "status", array()) == 1)) {
            echo "selected=\"selected\" ";
        }
        echo ">开启</option>
                </select>
            </td>
        </tr>
        <tr>
            <th>活动起止日期</th>
            <td colspan=\"2\"><input class=\"easyui-datetimebox\" type=\"text\" id=\"starttime\" name=\"starttime\"
                                   formatter=\"formatTime\" value=\"";
        // line 20
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["config"]) ? $context["config"] : null), "starttime", array()), "html", null, true);
        echo "\">到<input
                    class=\"easyui-datetimebox\" type=\"text\" id=\"endtime\" name=\"endtime\" formatter=\"formatTime\"
                    value=\"";
        // line 22
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["config"]) ? $context["config"] : null), "endtime", array()), "html", null, true);
        echo "\"></td>
        </tr>
        <tr>
            <td colspan=\"3\">
                <div id=\"dlg-buttons-add\" style=\"text-align:center;padding:5px\">
                    <a class=\"easyui-linkbutton\" iconCls=\"icon-ok\" onclick=\"save()\">保存</a>
                </div>
            </td>
        </tr>
    </table>
    ";
        // line 32
        echo $this->getAttribute((isset($context["html"]) ? $context["html"] : null), "endForm", array(), "method");
        echo "
</div>
";
    }

    // line 36
    public function block_js($context, array $blocks = array())
    {
        // line 37
        echo "<script type=\"text/javascript\">
    function save() {
        \$(\"#addForm\").form('submit', {
            success: function (data) {
                data = eval(\"(\" + data + \")\");
                if (data.code == 100) {
                    \$.messager.alert('保存成功', '保存成功', 'success');
                } else {
                    \$.messager.alert('保存失败', '保存失败', 'fail');
                }
            }
        })
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
        return array (  91 => 37,  88 => 36,  81 => 32,  68 => 22,  63 => 20,  51 => 13,  45 => 12,  36 => 6,  32 => 4,  29 => 3,  11 => 1,);
    }
}
/* {% extends '@app/views/base.html' %}*/
/* */
/* {% block main %}*/
/* <table title="注册礼包配置" id="listdata" class="easyui-datagrid" data-options="toolbar:'#tb-user'"></table>*/
/* <div id="tb-user" style="height:auto">*/
/*     {{ html.beginForm('','post',{'class':'am-form am-form-horizontal', 'id':'addForm'}) | raw }}*/
/*     <table cellSpacing=10>*/
/*         <tr>*/
/*             <th>活动状态</th>*/
/*             <td colspan="2">*/
/*                 <select class="easyui-combobox" name="status" style="height: auto;">*/
/*                     <option value="0" {% if config.status== 0 %}selected="selected" {% endif %}>关闭</option>*/
/*                     <option value="1" {% if config.status== 1 %}selected="selected" {% endif %}>开启</option>*/
/*                 </select>*/
/*             </td>*/
/*         </tr>*/
/*         <tr>*/
/*             <th>活动起止日期</th>*/
/*             <td colspan="2"><input class="easyui-datetimebox" type="text" id="starttime" name="starttime"*/
/*                                    formatter="formatTime" value="{{ config.starttime }}">到<input*/
/*                     class="easyui-datetimebox" type="text" id="endtime" name="endtime" formatter="formatTime"*/
/*                     value="{{ config.endtime }}"></td>*/
/*         </tr>*/
/*         <tr>*/
/*             <td colspan="3">*/
/*                 <div id="dlg-buttons-add" style="text-align:center;padding:5px">*/
/*                     <a class="easyui-linkbutton" iconCls="icon-ok" onclick="save()">保存</a>*/
/*                 </div>*/
/*             </td>*/
/*         </tr>*/
/*     </table>*/
/*     {{ html.endForm() | raw }}*/
/* </div>*/
/* {% endblock %}*/
/* */
/* {% block js %}*/
/* <script type="text/javascript">*/
/*     function save() {*/
/*         $("#addForm").form('submit', {*/
/*             success: function (data) {*/
/*                 data = eval("(" + data + ")");*/
/*                 if (data.code == 100) {*/
/*                     $.messager.alert('保存成功', '保存成功', 'success');*/
/*                 } else {*/
/*                     $.messager.alert('保存失败', '保存失败', 'fail');*/
/*                 }*/
/*             }*/
/*         })*/
/*     }*/
/* </script>*/
/* {% endblock %}*/
