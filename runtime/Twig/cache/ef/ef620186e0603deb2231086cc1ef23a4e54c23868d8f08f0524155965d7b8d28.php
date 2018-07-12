<?php

/* modify.html */
class __TwigTemplate_faf9e1365e2d5f2829bbad2a28ef5d7e1acc1105e7425bb99ac31e89441b2529 extends yii\twig\Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"";
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "params", array()), "skinUrl", array()), "html", null, true);
        echo "/js/jquery-easyui-1.4.4/themes/default/easyui.css\">
<link rel=\"stylesheet\" type=\"text/css\" href=\"";
        // line 2
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "params", array()), "skinUrl", array()), "html", null, true);
        echo "/js/jquery-easyui-1.4.4/themes/icon.css\">

<script src=\"";
        // line 4
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "params", array()), "skinUrl", array()), "html", null, true);
        echo "/js/jquery-easyui-1.4.4/jquery.min.js\" type=\"text/javascript\"></script>
<script src=\"";
        // line 5
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "params", array()), "skinUrl", array()), "html", null, true);
        echo "/js/jquery-easyui-1.4.4/jquery.easyui.min.js\" type=\"text/javascript\"></script>
<script src=\"";
        // line 6
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "params", array()), "skinUrl", array()), "html", null, true);
        echo "/js/jquery-easyui-1.4.4/locale/easyui-lang-zh_CN.js\" type=\"text/javascript\"></script>
<script src=\"";
        // line 7
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "params", array()), "skinUrl", array()), "html", null, true);
        echo "/js/order-detail.js\" type=\"text/javascript\"></script>

<div title=\"Basic Window\"  style=\"padding:5px;height:auto;width:100%\" class=\"box\">
    ";
        // line 10
        if (($this->getAttribute((isset($context["order"]) ? $context["order"] : null), "status", array()) >= 3)) {
            // line 11
            echo "    ";
            echo $this->getAttribute((isset($context["html"]) ? $context["html"] : null), "beginForm", array(0 => "", 1 => "post", 2 => array("class" => "am-form am-form-horizontal", "id" => "modify-form")), "method");
            echo "
    <table cellpadding=\"10\">
        <tr>
            <td>发货方式</td>
            <td>
                <select name=\"Deliver[send]\" editable=\"false\"  data-options=\"url: '";
            // line 16
            echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url("/win/product-deliver", array("id" => $this->getAttribute((isset($context["order"]) ? $context["order"] : null), "product_id", array()))), "html", null, true);
            echo "', valueField: 'id', textField: 'name',required:true,panelHeight:'auto'\" style=\"width:100px;\" class=\"easyui-combobox\" id=\"send\">
                </select>
            </td>
            <td>发货平台</td>
            <td>
                <select data-am-selected name=\"Deliver[platform]\" class=\"easyui-combobox\" id=\"platform\" data-options=\"panelHeight:'auto'\">
                    <option value=\"京东\">京东</option>
                    <option value=\"苏宁\">苏宁</option>
                    <option value=\"天猫\">天猫</option>
                    <option value=\"亚马逊\">亚马逊</option>
                    <option value=\"国美\">国美</option>
                    <option value=\"一号店\">一号店</option>
                    <option value=\"其他\">其他</option>
                    <option value=\"兑吧\">兑吧</option>
                    <option value=\"手动\">手动</option>
                </select>
            </td>
        </tr>
        <tr>
            <td>第三方订单号</td>
            <td><input class=\"easyui-textbox\" type=\"text\" name=\"Deliver[third_order]\" data-options=\"required:true\" value=\"";
            // line 36
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["deliver"]) ? $context["deliver"] : null), "third_order", array()), "html", null, true);
            echo "\"></td>
            <td>成本</td>
            <td><input class=\"easyui-textbox\" type=\"text\" name=\"Deliver[price]\" data-options=\"required:true\" value=\"";
            // line 38
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["deliver"]) ? $context["deliver"] : null), "price", array()), "html", null, true);
            echo "\"></td>
        </tr>
        <tr>
            <td>规格</td>
            <td><input class=\"easyui-textbox\" type=\"text\" name=\"Deliver[standard]\"  value=\"";
            // line 42
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["deliver"]) ? $context["deliver"] : null), "standard", array()), "html", null, true);
            echo "\"></td>
            <td>发票</td>
            <td><select name=\"Deliver[bill]\" class=\"easyui-combobox\" data-options=\"panelHeight:'auto'\" id=\"bill\">
                <option value=\"无\">无</option>
                <option value=\"普通发票\">普通发票</option>
                <option value=\"专业发票\">专业发票</option>
            </select></td>
        </tr>
        <tr>
            <td>发票编号</td>
            <td><input class=\"easyui-textbox\" type=\"text\" name=\"Deliver[bill_num]\" value=\"";
            // line 52
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["deliver"]) ? $context["deliver"] : null), "bill_num", array()), "html", null, true);
            echo "\"></td>

            <td>发票时间</td>
            <td><input class=\"easyui-datetimebox\" type=\"text\" name=\"Deliver[bill_time]\" value=\"";
            // line 55
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["deliver"]) ? $context["deliver"] : null), "bill_time", array()), "html", null, true);
            echo "\"></td>
        </tr>
        ";
            // line 57
            if (($this->getAttribute((isset($context["order"]) ? $context["order"] : null), "status", array()) > 3)) {
                // line 58
                echo "        <tr>
            <td>快递公司</td>
            <td><select name=\"Deliver[deliver_company]\" class=\"easyui-combobox\" id=\"company\">
                ";
                // line 61
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable((isset($context["express"]) ? $context["express"] : null));
                foreach ($context['_seq'] as $context["key"] => $context["item"]) {
                    // line 62
                    echo "                <option value=\"";
                    echo twig_escape_filter($this->env, $context["key"], "html", null, true);
                    echo "\">";
                    echo twig_escape_filter($this->env, $context["key"], "html", null, true);
                    echo "</option>
                ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['key'], $context['item'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 64
                echo "            </select></td>
            <td>快递单号</td>
            <td>
                <input class=\"easyui-textbox\" type=\"text\" name=\"Deliver[deliver_order]\" data-options=\"required:true\" value=\"";
                // line 67
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["deliver"]) ? $context["deliver"] : null), "deliver_order", array()), "html", null, true);
                echo "\">
            </td>
        </tr>
        <tr>
            <td>快递费用</td>
            <td><input class=\"easyui-textbox\" type=\"text\" name=\"Deliver[deliver_cost]\" value=\"";
                // line 72
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["deliver"]) ? $context["deliver"] : null), "deliver_cost", array()), "html", null, true);
                echo "\"></td>
            <td></td>
            <td>

            </td>
        </tr>
        ";
            }
            // line 79
            echo "        <tr>
            <td></td>
            <td>
                <input type=\"submit\" class=\"easyui-linkbutton\" onclick=\"submitForm()\">
            </td>
        </tr>
    </table>
    ";
            // line 86
            echo $this->getAttribute((isset($context["html"]) ? $context["html"] : null), "endForm", array(), "method");
            echo "
    ";
        }
        // line 88
        echo "</div>

<script>
    \$(function(){
        var send = \"";
        // line 92
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["deliver"]) ? $context["deliver"] : null), "send", array()), "html", null, true);
        echo "\";
        var platform  = \"";
        // line 93
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["deliver"]) ? $context["deliver"] : null), "platform", array()), "html", null, true);
        echo "\";
        var bill = \"";
        // line 94
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["deliver"]) ? $context["deliver"] : null), "bill", array()), "html", null, true);
        echo "\";
        var express = \"";
        // line 95
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["deliver"]) ? $context["deliver"] : null), "deliver_company", array()), "html", null, true);
        echo "\"
        \$('#send').combobox('setValue', send);
        \$('#platform').combobox('setValue', platform);
        \$('#bill').combobox('setValue', bill);
        \$('#company').combobox('setValue', express);
    })

    function submitForm(){
        var form = 'modify-form';
        var exchange = \"";
        // line 104
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["order"]) ? $context["order"] : null), "is_exchange", array()), "html", null, true);
        echo "\";
        if(exchange != 0) var url = '/win/modify?exchange=' +exchange;
        else var url = '/win/modify?id='+\"";
        // line 106
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["order"]) ? $context["order"] : null), "id", array()), "html", null, true);
        echo "\";
        \$('#' + form).form({
            url: url,
            onSubmit:function(){
                return \$(this).form('enableValidation').form('validate');
            },
            success: function (data) {
                var data = eval('('+data+')');
                if (data.error == 0) {
                    \$.messager.alert('成功', data.message);
                    setTimeout(function(){location.reload();parent.location.reload()}, 2000);
                } else {
                    \$.messager.alert('失败', data.message, 'error');
                }
            }
        });
        \$('#' + form).submit();
    }
</script>
";
    }

    public function getTemplateName()
    {
        return "modify.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  211 => 106,  206 => 104,  194 => 95,  190 => 94,  186 => 93,  182 => 92,  176 => 88,  171 => 86,  162 => 79,  152 => 72,  144 => 67,  139 => 64,  128 => 62,  124 => 61,  119 => 58,  117 => 57,  112 => 55,  106 => 52,  93 => 42,  86 => 38,  81 => 36,  58 => 16,  49 => 11,  47 => 10,  41 => 7,  37 => 6,  33 => 5,  29 => 4,  24 => 2,  19 => 1,);
    }
}
/* <link rel="stylesheet" type="text/css" href="{{ app.params.skinUrl }}/js/jquery-easyui-1.4.4/themes/default/easyui.css">*/
/* <link rel="stylesheet" type="text/css" href="{{ app.params.skinUrl }}/js/jquery-easyui-1.4.4/themes/icon.css">*/
/* */
/* <script src="{{ app.params.skinUrl }}/js/jquery-easyui-1.4.4/jquery.min.js" type="text/javascript"></script>*/
/* <script src="{{ app.params.skinUrl }}/js/jquery-easyui-1.4.4/jquery.easyui.min.js" type="text/javascript"></script>*/
/* <script src="{{ app.params.skinUrl }}/js/jquery-easyui-1.4.4/locale/easyui-lang-zh_CN.js" type="text/javascript"></script>*/
/* <script src="{{ app.params.skinUrl }}/js/order-detail.js" type="text/javascript"></script>*/
/* */
/* <div title="Basic Window"  style="padding:5px;height:auto;width:100%" class="box">*/
/*     {% if(order.status >= 3) %}*/
/*     {{ html.beginForm('', 'post', {'class':'am-form am-form-horizontal', 'id':'modify-form'}) | raw }}*/
/*     <table cellpadding="10">*/
/*         <tr>*/
/*             <td>发货方式</td>*/
/*             <td>*/
/*                 <select name="Deliver[send]" editable="false"  data-options="url: '{{ url('/win/product-deliver', {'id':order.product_id}) }}', valueField: 'id', textField: 'name',required:true,panelHeight:'auto'" style="width:100px;" class="easyui-combobox" id="send">*/
/*                 </select>*/
/*             </td>*/
/*             <td>发货平台</td>*/
/*             <td>*/
/*                 <select data-am-selected name="Deliver[platform]" class="easyui-combobox" id="platform" data-options="panelHeight:'auto'">*/
/*                     <option value="京东">京东</option>*/
/*                     <option value="苏宁">苏宁</option>*/
/*                     <option value="天猫">天猫</option>*/
/*                     <option value="亚马逊">亚马逊</option>*/
/*                     <option value="国美">国美</option>*/
/*                     <option value="一号店">一号店</option>*/
/*                     <option value="其他">其他</option>*/
/*                     <option value="兑吧">兑吧</option>*/
/*                     <option value="手动">手动</option>*/
/*                 </select>*/
/*             </td>*/
/*         </tr>*/
/*         <tr>*/
/*             <td>第三方订单号</td>*/
/*             <td><input class="easyui-textbox" type="text" name="Deliver[third_order]" data-options="required:true" value="{{ deliver.third_order }}"></td>*/
/*             <td>成本</td>*/
/*             <td><input class="easyui-textbox" type="text" name="Deliver[price]" data-options="required:true" value="{{ deliver.price }}"></td>*/
/*         </tr>*/
/*         <tr>*/
/*             <td>规格</td>*/
/*             <td><input class="easyui-textbox" type="text" name="Deliver[standard]"  value="{{ deliver.standard }}"></td>*/
/*             <td>发票</td>*/
/*             <td><select name="Deliver[bill]" class="easyui-combobox" data-options="panelHeight:'auto'" id="bill">*/
/*                 <option value="无">无</option>*/
/*                 <option value="普通发票">普通发票</option>*/
/*                 <option value="专业发票">专业发票</option>*/
/*             </select></td>*/
/*         </tr>*/
/*         <tr>*/
/*             <td>发票编号</td>*/
/*             <td><input class="easyui-textbox" type="text" name="Deliver[bill_num]" value="{{ deliver.bill_num }}"></td>*/
/* */
/*             <td>发票时间</td>*/
/*             <td><input class="easyui-datetimebox" type="text" name="Deliver[bill_time]" value="{{ deliver.bill_time }}"></td>*/
/*         </tr>*/
/*         {% if order.status > 3 %}*/
/*         <tr>*/
/*             <td>快递公司</td>*/
/*             <td><select name="Deliver[deliver_company]" class="easyui-combobox" id="company">*/
/*                 {% for key,item in express %}*/
/*                 <option value="{{ key }}">{{ key }}</option>*/
/*                 {% endfor %}*/
/*             </select></td>*/
/*             <td>快递单号</td>*/
/*             <td>*/
/*                 <input class="easyui-textbox" type="text" name="Deliver[deliver_order]" data-options="required:true" value="{{ deliver.deliver_order }}">*/
/*             </td>*/
/*         </tr>*/
/*         <tr>*/
/*             <td>快递费用</td>*/
/*             <td><input class="easyui-textbox" type="text" name="Deliver[deliver_cost]" value="{{ deliver.deliver_cost }}"></td>*/
/*             <td></td>*/
/*             <td>*/
/* */
/*             </td>*/
/*         </tr>*/
/*         {% endif %}*/
/*         <tr>*/
/*             <td></td>*/
/*             <td>*/
/*                 <input type="submit" class="easyui-linkbutton" onclick="submitForm()">*/
/*             </td>*/
/*         </tr>*/
/*     </table>*/
/*     {{ html.endForm() | raw }}*/
/*     {% endif %}*/
/* </div>*/
/* */
/* <script>*/
/*     $(function(){*/
/*         var send = "{{ deliver.send }}";*/
/*         var platform  = "{{ deliver.platform }}";*/
/*         var bill = "{{ deliver.bill }}";*/
/*         var express = "{{ deliver.deliver_company }}"*/
/*         $('#send').combobox('setValue', send);*/
/*         $('#platform').combobox('setValue', platform);*/
/*         $('#bill').combobox('setValue', bill);*/
/*         $('#company').combobox('setValue', express);*/
/*     })*/
/* */
/*     function submitForm(){*/
/*         var form = 'modify-form';*/
/*         var exchange = "{{ order.is_exchange }}";*/
/*         if(exchange != 0) var url = '/win/modify?exchange=' +exchange;*/
/*         else var url = '/win/modify?id='+"{{ order.id }}";*/
/*         $('#' + form).form({*/
/*             url: url,*/
/*             onSubmit:function(){*/
/*                 return $(this).form('enableValidation').form('validate');*/
/*             },*/
/*             success: function (data) {*/
/*                 var data = eval('('+data+')');*/
/*                 if (data.error == 0) {*/
/*                     $.messager.alert('成功', data.message);*/
/*                     setTimeout(function(){location.reload();parent.location.reload()}, 2000);*/
/*                 } else {*/
/*                     $.messager.alert('失败', data.message, 'error');*/
/*                 }*/
/*             }*/
/*         });*/
/*         $('#' + form).submit();*/
/*     }*/
/* </script>*/
/* */
