<?php

/* index.html */
class __TwigTemplate_339d3e8da27dd2f3acbcacd2574e6d4b8a041f8c48145b52ceacdb17ac731c04 extends yii\twig\Template
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
            echo "selected=\"selected\"";
        }
        echo " >关闭</option>
                    <option value=\"1\" ";
        // line 13
        if (($this->getAttribute((isset($context["config"]) ? $context["config"] : null), "status", array()) == 1)) {
            echo "selected=\"selected\"";
        }
        echo " >开启</option>
                </select>
            </td>
        </tr>
        <tr>
            <th>活动起止日期</th>
            <td colspan=\"2\"><input class=\"easyui-datetimebox\" type=\"text\" id=\"starttime\" name=\"starttime\" formatter=\"formatTime\" value=\"";
        // line 19
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["config"]) ? $context["config"] : null), "starttime", array()), "html", null, true);
        echo "\">到<input class=\"easyui-datetimebox\" type=\"text\" id=\"endtime\" name=\"endtime\" formatter=\"formatTime\" value=\"";
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["config"]) ? $context["config"] : null), "endtime", array()), "html", null, true);
        echo "\"></td>
        </tr>
        <tr>
            <th>活动说明</th>
            <td colspan=\"2\">
                <textarea class=\"easyui-textareabox\" name=\"intr\" rows=\"10\" cols=\"60\">";
        // line 24
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["config"]) ? $context["config"] : null), "intr", array()), "html", null, true);
        echo "</textarea>
            </td>
        </tr> 
        <tr>
            <th rowspan=\"2\">获取条件</th>
            <td width=\"60\">适用终端</td>
            <td>
                <input type=\"checkbox\" name=\"terminal[]\" value=\"0\" class=\"easyui-checkboxbox\" checked=\"checked\">全部
                <input type=\"checkbox\" name=\"terminal[]\" value=\"1\" class=\"easyui-checkboxbox\">PC
                <input type=\"checkbox\" name=\"terminal[]\" value=\"2\" class=\"easyui-checkboxbox\">微信
                <input type=\"checkbox\" name=\"terminal[]\" value=\"3\" class=\"easyui-checkboxbox\">IOS
                <input type=\"checkbox\" name=\"terminal[]\" value=\"4\" class=\"easyui-checkboxbox\">Android
                <input type=\"checkbox\" name=\"terminal[]\" value=\"5\" class=\"easyui-checkboxbox\">WAP
            </td>
        </tr>
        <tr>
            <td>适用渠道</td>
            <td>
                <input type=\"checkbox\" name=\"conduit[]\" value=\"0\" class=\"easyui-checkboxbox\" checked=\"checked\">全部
            </td>
        </tr>
        <tr>
            <th>选择红包</th>
            <td colspan=\"2\">
                <select class=\"easyui-combobox\" name=\"packet\" style=\"height: auto;\">
                    ";
        // line 49
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["packets"]) ? $context["packets"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
            // line 50
            echo "                    <option value=\"";
            echo twig_escape_filter($this->env, $this->getAttribute($context["item"], "id", array()), "html", null, true);
            echo "\" ";
            if (($this->getAttribute((isset($context["config"]) ? $context["config"] : null), "packet_id", array()) == $this->getAttribute($context["item"], "id", array()))) {
                echo "selected=\"selected\"";
            }
            echo ">";
            echo twig_escape_filter($this->env, $this->getAttribute($context["item"], "name", array()), "html", null, true);
            echo "</option>
                    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 52
        echo "                </select>                
            </td>
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
        // line 63
        echo $this->getAttribute((isset($context["html"]) ? $context["html"] : null), "endForm", array(), "method");
        echo "
</div>
";
    }

    // line 67
    public function block_js($context, array $blocks = array())
    {
        // line 68
        echo "<script type=\"text/javascript\">
    function save(){
        \$(\"#addForm\").form('submit',{
            success:function(data){
                data = eval(\"(\" + data + \")\");
                if (data.code == 100) {
                    \$.messager.alert('保存成功', '保存成功', 'success');
                }else{
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
        return array (  142 => 68,  139 => 67,  132 => 63,  119 => 52,  104 => 50,  100 => 49,  72 => 24,  62 => 19,  51 => 13,  45 => 12,  36 => 6,  32 => 4,  29 => 3,  11 => 1,);
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
/*                     <option value="0" {% if config.status == 0 %}selected="selected"{% endif %} >关闭</option>*/
/*                     <option value="1" {% if config.status == 1 %}selected="selected"{% endif %} >开启</option>*/
/*                 </select>*/
/*             </td>*/
/*         </tr>*/
/*         <tr>*/
/*             <th>活动起止日期</th>*/
/*             <td colspan="2"><input class="easyui-datetimebox" type="text" id="starttime" name="starttime" formatter="formatTime" value="{{ config.starttime }}">到<input class="easyui-datetimebox" type="text" id="endtime" name="endtime" formatter="formatTime" value="{{ config.endtime }}"></td>*/
/*         </tr>*/
/*         <tr>*/
/*             <th>活动说明</th>*/
/*             <td colspan="2">*/
/*                 <textarea class="easyui-textareabox" name="intr" rows="10" cols="60">{{ config.intr }}</textarea>*/
/*             </td>*/
/*         </tr> */
/*         <tr>*/
/*             <th rowspan="2">获取条件</th>*/
/*             <td width="60">适用终端</td>*/
/*             <td>*/
/*                 <input type="checkbox" name="terminal[]" value="0" class="easyui-checkboxbox" checked="checked">全部*/
/*                 <input type="checkbox" name="terminal[]" value="1" class="easyui-checkboxbox">PC*/
/*                 <input type="checkbox" name="terminal[]" value="2" class="easyui-checkboxbox">微信*/
/*                 <input type="checkbox" name="terminal[]" value="3" class="easyui-checkboxbox">IOS*/
/*                 <input type="checkbox" name="terminal[]" value="4" class="easyui-checkboxbox">Android*/
/*                 <input type="checkbox" name="terminal[]" value="5" class="easyui-checkboxbox">WAP*/
/*             </td>*/
/*         </tr>*/
/*         <tr>*/
/*             <td>适用渠道</td>*/
/*             <td>*/
/*                 <input type="checkbox" name="conduit[]" value="0" class="easyui-checkboxbox" checked="checked">全部*/
/*             </td>*/
/*         </tr>*/
/*         <tr>*/
/*             <th>选择红包</th>*/
/*             <td colspan="2">*/
/*                 <select class="easyui-combobox" name="packet" style="height: auto;">*/
/*                     {% for item in packets %}*/
/*                     <option value="{{ item.id }}" {% if config.packet_id == item.id %}selected="selected"{% endif %}>{{ item.name }}</option>*/
/*                     {% endfor %}*/
/*                 </select>                */
/*             </td>*/
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
/*     function save(){*/
/*         $("#addForm").form('submit',{*/
/*             success:function(data){*/
/*                 data = eval("(" + data + ")");*/
/*                 if (data.code == 100) {*/
/*                     $.messager.alert('保存成功', '保存成功', 'success');*/
/*                 }else{*/
/*                     $.messager.alert('保存失败', '保存失败', 'fail');*/
/*                 }*/
/*             }*/
/*         })*/
/*     }*/
/* </script>*/
/* {% endblock %}*/
