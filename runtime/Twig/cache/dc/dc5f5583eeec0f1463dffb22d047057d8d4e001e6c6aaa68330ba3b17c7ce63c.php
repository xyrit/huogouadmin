<?php

/* send.html */
class __TwigTemplate_70cb5bc62c745497b65e611c002259af3ee75ea93415e53b8601e23eae470b13 extends yii\twig\Template
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

<div title=\"Basic Window\"  style=\"padding:5px;height:auto;width:100%\" class=\"box\">
    ";
        // line 9
        if (($this->getAttribute((isset($context["model"]) ? $context["model"] : null), "status", array()) == 3)) {
            // line 10
            echo "    ";
            echo $this->getAttribute((isset($context["html"]) ? $context["html"] : null), "beginForm", array(0 => "", 1 => "post", 2 => array("class" => "am-form am-form-horizontal", "id" => "send-form")), "method");
            echo "
    ";
            // line 11
            if (((((($this->getAttribute((isset($context["orderModel"]) ? $context["orderModel"] : null), "send", array()) == 5) || ($this->getAttribute((isset($context["orderModel"]) ? $context["orderModel"] : null), "send", array()) == 6)) || ($this->getAttribute((isset($context["orderModel"]) ? $context["orderModel"] : null), "send", array()) == 7)) || ($this->getAttribute((isset($context["orderModel"]) ? $context["orderModel"] : null), "send", array()) == 8)) || ($this->getAttribute((isset($context["orderModel"]) ? $context["orderModel"] : null), "send", array()) == 3))) {
                // line 12
                echo "    <table cellpadding=\"10\">
        ";
                // line 13
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable((isset($context["orderlist"]) ? $context["orderlist"] : null));
                foreach ($context['_seq'] as $context["_key"] => $context["items"]) {
                    // line 14
                    echo "        <tr>
            <td>
            ";
                    // line 16
                    if (($this->getAttribute($context["items"], "audit_status", array()) == 0)) {
                        // line 17
                        echo "                <input class=\"easyui-checkbox\" type=\"checkbox\" name=\"orders[]\" value=\"";
                        echo twig_escape_filter($this->env, $this->getAttribute($context["items"], "orderid", array()), "html", null, true);
                        echo "\">
            ";
                    }
                    // line 19
                    echo "            </td>
            <td>";
                    // line 20
                    echo twig_escape_filter($this->env, $this->getAttribute($context["items"], "orderid", array()), "html", null, true);
                    echo "  (";
                    echo twig_escape_filter($this->env, $this->getAttribute($context["items"], "money", array()), "html", null, true);
                    echo "元)";
                    if (($this->getAttribute($context["items"], "audit_status", array()) == 1)) {
                        echo "通过";
                    } elseif (($this->getAttribute($context["items"], "audit_status", array()) == 2)) {
                        echo "未通过";
                    }
                    echo "</td>
        </tr>
        ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['items'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 23
                echo "        <tr>
            <td></td>
            <td>
                <input type=\"button\" value=\"通过审核\" id=\"pass\">
                <input type=\"button\" value=\"审核不通过\" id=\"refuse\">
            </td>
        </tr> 
        <tr>
            <td></td>
            <td>
                <input type=\"submit\" class=\"easyui-linkbutton\">
            </td>
        </tr>
    </table>
    ";
            } elseif ((($this->getAttribute(            // line 37
(isset($context["orderModel"]) ? $context["orderModel"] : null), "send", array()) == 13) || ($this->getAttribute((isset($context["orderModel"]) ? $context["orderModel"] : null), "send", array()) == 18))) {
                // line 38
                echo "    <table cellpadding=\"10\">
        <tr>
            <td>面值</td>
            <td><input class=\"easyui-textbox\" type=\"text\" name=\"par_value\" data-options=\"required:true\"></td>
        </tr>
        <tr>
            <td>卡号</td>
            <td><input class=\"easyui-textbox\" type=\"text\" name=\"card\" data-options=\"required:true\"></td>
        </tr>
        <tr>
            <td>密码</td>
            <td><input class=\"easyui-textbox\" type=\"text\" name=\"pwd\" data-options=\"required:true\"></td>
        </tr>
        <tr>
            <td></td>
            <td>
                <input type=\"submit\" class=\"easyui-linkbutton\">
            </td>
        </tr>
    </table>
    ";
            } else {
                // line 59
                echo "    <table cellpadding=\"10\">
        <tr>
            <td>快递公司</td>
            <td>
                <select name=\"company\" data-options=\"required:true\" class=\"easyui-combobox\">
                    ";
                // line 64
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable((isset($context["express"]) ? $context["express"] : null));
                foreach ($context['_seq'] as $context["key"] => $context["item"]) {
                    // line 65
                    echo "                    <option name=\"";
                    echo twig_escape_filter($this->env, $context["key"], "html", null, true);
                    echo "\">";
                    echo twig_escape_filter($this->env, $context["key"], "html", null, true);
                    echo "</option>
                    ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['key'], $context['item'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 67
                echo "                </select>
            </td>
        </tr>
        <tr>
            <td>快递订单号</td>
            <td><input class=\"easyui-textbox\" type=\"text\" name=\"orderNo\" data-options=\"required:true\"></td>
        </tr>
        <tr>
            <td>快递费用</td>
            <td><input class=\"easyui-textbox\" type=\"text\" name=\"cost\"></td>
        </tr>
        <tr>
            <td></td>
            <td>
                <input type=\"submit\" class=\"easyui-linkbutton\">
            </td>
        </tr>
    </table>
    ";
            }
            // line 86
            echo "    ";
            echo $this->getAttribute((isset($context["html"]) ? $context["html"] : null), "endForm", array(), "method");
            echo "
    ";
        }
        // line 88
        echo "</div>

<script>
    \$(function(){
        var form = 'send-form';
        id = \"";
        // line 93
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["model"]) ? $context["model"] : null), "id", array()), "html", null, true);
        echo "\";
        var exId = \"";
        // line 94
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["model"]) ? $context["model"] : null), "is_exchange", array()), "html", null, true);
        echo "\";
        if(exId != 0){
            var url = '/win/send?id='+id+'&exchange='+exId;
        } else{
            var url = '/win/send?id='+id;
        }

        \$(\"#pass\").click(function(){
            var orderList = \$(\"input[type=checkbox]:checked\");
            var orders = '';
            if (orderList.length > 0) {
                for (var i = 0; i < orderList.length; i++) {
                    orders += orderList[i].value+',';
                }
                \$(\"input[type=checkbox]:checked\").remove();
                orders = orders.substring(0,(orders.length-1));
                \$.get('audit',{type:'pass',orders:orders},function(aduit){
                    if (aduit.code == 100) {
                        \$.messager.alert('成功','审核成功');
                    }else{
                        \$.messager.alert('失败','审核失败');
                    }
                },'json');
            }
        })

        \$(\"#refuse\").click(function(){
            var orderList = \$(\"input[type=checkbox]:checked\");
            var orders = '';
            if (orderList.length > 0) {
                for (var i = 0; i < orderList.length; i++) {
                    orders += orderList[i].value+',';
                    \$(\"input[type=checkbox]:checked\").eq(i).remove();
                }
                orders = orders.substring(0,(orders.length-1));
                \$.get('audit',{type:'refuse',orders:orders},function(aduit){
                    if (aduit.code == 100) {
                        \$.messager.alert('成功','审核成功');
                    }else{
                        \$.messager.alert('失败','审核失败');
                    }
                },'json');
            }
        })

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
        // \$('#' + form).submit();
    })
</script>
";
    }

    public function getTemplateName()
    {
        return "send.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  192 => 94,  188 => 93,  181 => 88,  175 => 86,  154 => 67,  143 => 65,  139 => 64,  132 => 59,  109 => 38,  107 => 37,  91 => 23,  74 => 20,  71 => 19,  65 => 17,  63 => 16,  59 => 14,  55 => 13,  52 => 12,  50 => 11,  45 => 10,  43 => 9,  37 => 6,  33 => 5,  29 => 4,  24 => 2,  19 => 1,);
    }
}
/* <link rel="stylesheet" type="text/css" href="{{ app.params.skinUrl }}/js/jquery-easyui-1.4.4/themes/default/easyui.css">*/
/* <link rel="stylesheet" type="text/css" href="{{ app.params.skinUrl }}/js/jquery-easyui-1.4.4/themes/icon.css">*/
/* */
/* <script src="{{ app.params.skinUrl }}/js/jquery-easyui-1.4.4/jquery.min.js" type="text/javascript"></script>*/
/* <script src="{{ app.params.skinUrl }}/js/jquery-easyui-1.4.4/jquery.easyui.min.js" type="text/javascript"></script>*/
/* <script src="{{ app.params.skinUrl }}/js/jquery-easyui-1.4.4/locale/easyui-lang-zh_CN.js" type="text/javascript"></script>*/
/* */
/* <div title="Basic Window"  style="padding:5px;height:auto;width:100%" class="box">*/
/*     {% if(model.status == 3) %}*/
/*     {{ html.beginForm('', 'post', {'class':'am-form am-form-horizontal', 'id':'send-form'}) | raw }}*/
/*     {% if orderModel.send == 5 or orderModel.send == 6 or orderModel.send == 7 or orderModel.send == 8 or orderModel.send == 3%}*/
/*     <table cellpadding="10">*/
/*         {% for items in orderlist %}*/
/*         <tr>*/
/*             <td>*/
/*             {% if items.audit_status == 0 %}*/
/*                 <input class="easyui-checkbox" type="checkbox" name="orders[]" value="{{ items.orderid }}">*/
/*             {% endif %}*/
/*             </td>*/
/*             <td>{{ items.orderid }}  ({{ items.money }}元){% if items.audit_status== 1 %}通过{% elseif items.audit_status == 2 %}未通过{% endif %}</td>*/
/*         </tr>*/
/*         {% endfor %}*/
/*         <tr>*/
/*             <td></td>*/
/*             <td>*/
/*                 <input type="button" value="通过审核" id="pass">*/
/*                 <input type="button" value="审核不通过" id="refuse">*/
/*             </td>*/
/*         </tr> */
/*         <tr>*/
/*             <td></td>*/
/*             <td>*/
/*                 <input type="submit" class="easyui-linkbutton">*/
/*             </td>*/
/*         </tr>*/
/*     </table>*/
/*     {% elseif orderModel.send == 13 or orderModel.send == 18%}*/
/*     <table cellpadding="10">*/
/*         <tr>*/
/*             <td>面值</td>*/
/*             <td><input class="easyui-textbox" type="text" name="par_value" data-options="required:true"></td>*/
/*         </tr>*/
/*         <tr>*/
/*             <td>卡号</td>*/
/*             <td><input class="easyui-textbox" type="text" name="card" data-options="required:true"></td>*/
/*         </tr>*/
/*         <tr>*/
/*             <td>密码</td>*/
/*             <td><input class="easyui-textbox" type="text" name="pwd" data-options="required:true"></td>*/
/*         </tr>*/
/*         <tr>*/
/*             <td></td>*/
/*             <td>*/
/*                 <input type="submit" class="easyui-linkbutton">*/
/*             </td>*/
/*         </tr>*/
/*     </table>*/
/*     {% else %}*/
/*     <table cellpadding="10">*/
/*         <tr>*/
/*             <td>快递公司</td>*/
/*             <td>*/
/*                 <select name="company" data-options="required:true" class="easyui-combobox">*/
/*                     {% for key,item in express %}*/
/*                     <option name="{{ key }}">{{ key }}</option>*/
/*                     {% endfor %}*/
/*                 </select>*/
/*             </td>*/
/*         </tr>*/
/*         <tr>*/
/*             <td>快递订单号</td>*/
/*             <td><input class="easyui-textbox" type="text" name="orderNo" data-options="required:true"></td>*/
/*         </tr>*/
/*         <tr>*/
/*             <td>快递费用</td>*/
/*             <td><input class="easyui-textbox" type="text" name="cost"></td>*/
/*         </tr>*/
/*         <tr>*/
/*             <td></td>*/
/*             <td>*/
/*                 <input type="submit" class="easyui-linkbutton">*/
/*             </td>*/
/*         </tr>*/
/*     </table>*/
/*     {% endif %}*/
/*     {{ html.endForm() | raw }}*/
/*     {% endif %}*/
/* </div>*/
/* */
/* <script>*/
/*     $(function(){*/
/*         var form = 'send-form';*/
/*         id = "{{ model.id }}";*/
/*         var exId = "{{ model.is_exchange }}";*/
/*         if(exId != 0){*/
/*             var url = '/win/send?id='+id+'&exchange='+exId;*/
/*         } else{*/
/*             var url = '/win/send?id='+id;*/
/*         }*/
/* */
/*         $("#pass").click(function(){*/
/*             var orderList = $("input[type=checkbox]:checked");*/
/*             var orders = '';*/
/*             if (orderList.length > 0) {*/
/*                 for (var i = 0; i < orderList.length; i++) {*/
/*                     orders += orderList[i].value+',';*/
/*                 }*/
/*                 $("input[type=checkbox]:checked").remove();*/
/*                 orders = orders.substring(0,(orders.length-1));*/
/*                 $.get('audit',{type:'pass',orders:orders},function(aduit){*/
/*                     if (aduit.code == 100) {*/
/*                         $.messager.alert('成功','审核成功');*/
/*                     }else{*/
/*                         $.messager.alert('失败','审核失败');*/
/*                     }*/
/*                 },'json');*/
/*             }*/
/*         })*/
/* */
/*         $("#refuse").click(function(){*/
/*             var orderList = $("input[type=checkbox]:checked");*/
/*             var orders = '';*/
/*             if (orderList.length > 0) {*/
/*                 for (var i = 0; i < orderList.length; i++) {*/
/*                     orders += orderList[i].value+',';*/
/*                     $("input[type=checkbox]:checked").eq(i).remove();*/
/*                 }*/
/*                 orders = orders.substring(0,(orders.length-1));*/
/*                 $.get('audit',{type:'refuse',orders:orders},function(aduit){*/
/*                     if (aduit.code == 100) {*/
/*                         $.messager.alert('成功','审核成功');*/
/*                     }else{*/
/*                         $.messager.alert('失败','审核失败');*/
/*                     }*/
/*                 },'json');*/
/*             }*/
/*         })*/
/* */
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
/*         // $('#' + form).submit();*/
/*     })*/
/* </script>*/
/* */
