<?php

/* deliver.html */
class __TwigTemplate_7ee78bdf2df1816e099b30de55c1f7653bc5cb483201b8e2b942c5ea0b6acd67 extends yii\twig\Template
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

<div title=\"Basic Window\"  style=\"padding:5px;height:auto;width:100%\" class=\"box\" id=\"deliver\">
    ";
        // line 10
        if (($this->getAttribute((isset($context["model"]) ? $context["model"] : null), "status", array()) == 2)) {
            // line 11
            echo "    ";
            echo $this->getAttribute((isset($context["html"]) ? $context["html"] : null), "beginForm", array(0 => "", 1 => "post", 2 => array("class" => "am-form am-form-horizontal", "id" => "deliver-form")), "method");
            echo "
    <table cellpadding=\"10\" style=\"font-size: 13px;\">
        <tr>
            <td>发货方式</td>
            <td>
                <select class=\"easyui-combobox\" id=\"send\" name=\"Deliver[send]\" editable=\"false\" style=\"width:100px;\" data-options=\"url: '";
            // line 16
            echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url("/win/product-deliver", array("id" => $this->getAttribute((isset($context["model"]) ? $context["model"] : null), "product_id", array()))), "html", null, true);
            echo "', valueField: 'id', textField: 'name',required:true,panelHeight:'auto'\"></select>
            </td>
        </tr>
        <tr>
            <td>选择平台</td>
            <td>
                <select name=\"Deliver[platform]\" class=\"easyui-combobox\" data-options=\"panelHeight:'auto'\" id=\"platform\" onchange=\"javascript:choose(this.value)\">
                    <option value=\"京东\">京东</option>
                    <option value=\"苏宁\">苏宁</option>
                    <option value=\"天猫\">天猫</option>
                    <option value=\"亚马逊\">亚马逊</option>
                    <option value=\"国美\">国美</option>
                    <option value=\"一号店\">一号店</option>
                    <option value=\"兑吧\">兑吧</option>
                    <option value=\"手动\">手动</option>
                </select>
            </td>
        </tr>
        <tr>
            <td>支付方式</td>
            <td>
                <select name=\"Deliver[payment]\" class=\"easyui-combobox\" id=\"payment\" data-options=\"panelHeight:'auto'\">
                    <option value=\"无\">无</option>
                    <option value=\"京东\">京东</option>
                    <option value=\"支付宝\">支付宝</option>
                    <option value=\"其他\">其他</option>
                </select>
            </td>
        </tr>
        <tr>
            <td>第三方订单号</td>
            <td><input class=\"easyui-textbox\" type=\"text\" name=\"Deliver[third_order]\" data-options=\"required:true\"></td>
        </tr>
        <tr>
            <td>成本</td>
            <td><input class=\"easyui-textbox\" type=\"text\" name=\"Deliver[price]\" data-options=\"required:true,\"></td>
        </tr>
        <tr>
            <td>规格</td>
            <td><input class=\"easyui-textbox\" type=\"text\" name=\"Deliver[standard]\" ></td>
        </tr>
        <tr>
            <td>发票</td>
            <td>
                <select name=\"Deliver[bill]\" class=\"easyui-combobox\" id=\"bill\" data-options=\"panelHeight:'auto'\">
                    <option value=\"无\">无</option>
                    <option value=\"普通发票\">普通发票</option>
                    <option value=\"专业发票\">专业发票</option>
                </select>
            </td>
        </tr>
        <tr>
            <td>发票编号</td>
            <td><input class=\"easyui-textbox\" type=\"text\" name=\"Deliver[bill_num]\" ></td>
        </tr>
        <tr>
            <td></td>
            <td>
                <input type=\"submit\" class=\"easyui-linkbutton\">
            </td>
        </tr>
    </table>
    ";
            // line 78
            echo $this->getAttribute((isset($context["html"]) ? $context["html"] : null), "endForm", array(), "method");
            echo "
    ";
        }
        // line 80
        echo "</div>
<script>
        var form = 'deliver-form';
        id = \"";
        // line 83
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["model"]) ? $context["model"] : null), "id", array()), "html", null, true);
        echo "\";
        var exId = \"";
        // line 84
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["model"]) ? $context["model"] : null), "is_exchange", array()), "html", null, true);
        echo "\";
        if(exId != 0){
            var url = '/win/deliver?id='+id+'&exchange='+exId;
        } else{
            var url = '/win/deliver?id='+id;
        }

        \$(\"#platform\").combobox({
            onChange:function(){
                var html = '';
                if (\$(this).combobox('getValue') == '兑吧') {
                    \$(this).parent().parent().nextAll().remove();
                    \$.get(\"/product/get-info\",{pid:";
        // line 96
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["model"]) ? $context["model"] : null), "product_id", array()), "html", null, true);
        echo "},function(data){
                        var perMax = 0;
                        if (data.delivery_id == 5) {
                            perMax = 200;
                        }else if (data.delivery_id == 6) {
                            perMax = 200;
                        }else if (data.delivery_id == 7) {
                            perMax = 50;
                        }
                        var money = data.face_value;
                        html += '<tr><td>兑换列表</td>';
                        html += '<td>';
                        html += '<ul id=\"duibaList\" style=\"list-style:none;margin:0;padding:0\">';
                        if (money < perMax) {
                            html += '<li>';
                            html += '兑换 <font color=\"red\">' + money + '</font> 元 <a href=\"duiba?pid=";
        // line 111
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["model"]) ? $context["model"] : null), "product_id", array()), "html", null, true);
        echo "&orderid=";
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["model"]) ? $context["model"] : null), "id", array()), "html", null, true);
        echo "&money=' + money + '&p=1\" onclick=\"javascript:return false;\">兑换</a>';
                            html += '</li>';
                        }else{
                            var need = parseInt(money / perMax);
                            var surplus = money;
                            for(i = 0 ; i < need ; i++){
                                html += '<li>';
                                html += '兑换 <font color=\"red\">' + perMax + '</font> 元 <a href=\"duiba?pid=";
        // line 118
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["model"]) ? $context["model"] : null), "product_id", array()), "html", null, true);
        echo "&orderid=";
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["model"]) ? $context["model"] : null), "id", array()), "html", null, true);
        echo "&money=' + perMax + '&p=' + (i+1) + '\" onclick=\"javascript:return false;\">兑换</a>';
                                html += '</li>';
                                surplus -= perMax;
                            }
                            if (surplus > 0) {
                                html += '<li>';
                                html += '兑换 <font color=\"red\">'+surplus+'</font> 元 <a href=\"duiba?pid=";
        // line 124
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["model"]) ? $context["model"] : null), "product_id", array()), "html", null, true);
        echo "&orderid=";
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["model"]) ? $context["model"] : null), "id", array()), "html", null, true);
        echo "&money=' + surplus + '&p=' + (need+1) + '\" onclick=\"javascript:return false;\">兑换</a>';
                                html += '</li>';
                            }
                        }
                        html += '</ul>';
                        html += '</td>';
                        html += '</tr>';
                        html += '<tr>';
                        html += '<td></td>';
                        html += '<td>';
                        html += '<input type=\"submit\" class=\"easyui-linkbutton\">';
                        html += '</td>';
                        html += '</tr>';
                        \$(\"table\").append(html);
                        \$(\"#duibaList li a\").click(function() {
                            var getUrl = \$(this).attr('href');
                            var k = \$(this).index('#duibaList li a');
                            if (getUrl) {
                                \$.get(getUrl,function(duibaInfo){
                                    if (duibaInfo.code == 100) {
                                        \$(\"#duibaList li a\").eq(k).remove();
                                        parent.\$(\"#duiba\").prop('src',duibaInfo.url);
                                        parent.\$(\"#dlg-view\").window('open');
                                    }else{
                                        \$.messager.alert('获取地址失败', '获取地址失败，请重试');
                                    }
                                },'json');
                            }
                            return false;
                        });
                    },'json')
                }else if (\$(this).combobox('getValue') == '手动') {
                    if (\$('#send').combobox('getValue') != '7') {
                        \$(this).parent().parent().nextAll().remove();
                        html += '<tr>';
                        html += '<td>转账订单号</td>';
                        html += '<td>';
                        html += '<input type=\"text\" class=\"easyui-textbox\" name=\"Deliver[third_order]\">';
                        html += '</td>';
                        html += '</tr>';
                        html += '<tr>';
                        html += '<td></td>';
                        html += '<td>';
                        html += '<input type=\"submit\" class=\"easyui-linkbutton\">';
                        html += '</td>';
                        html += '</tr>';
                        \$(\"table\").append(html);
                    }
                }
            }
        })

        \$('#' + form).form({
            url: url,
            onSubmit:function(){
                var isSubmit = 1;
                \$(\"#duibaList li a\").each(function(){
                    if (\$(this).attr('href').length > 0) {
                        \$.messager.alert('提示','兑换还未完成');
                        isSubmit = 0;
                        return false;
                    }
                });
                if (!isSubmit) {
                    return false;
                }
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
</script>
";
    }

    public function getTemplateName()
    {
        return "deliver.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  193 => 124,  182 => 118,  170 => 111,  152 => 96,  137 => 84,  133 => 83,  128 => 80,  123 => 78,  58 => 16,  49 => 11,  47 => 10,  41 => 7,  37 => 6,  33 => 5,  29 => 4,  24 => 2,  19 => 1,);
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
/* <div title="Basic Window"  style="padding:5px;height:auto;width:100%" class="box" id="deliver">*/
/*     {% if(model.status == 2) %}*/
/*     {{ html.beginForm('', 'post', {'class':'am-form am-form-horizontal', 'id':'deliver-form'}) | raw }}*/
/*     <table cellpadding="10" style="font-size: 13px;">*/
/*         <tr>*/
/*             <td>发货方式</td>*/
/*             <td>*/
/*                 <select class="easyui-combobox" id="send" name="Deliver[send]" editable="false" style="width:100px;" data-options="url: '{{ url('/win/product-deliver', {'id':model.product_id}) }}', valueField: 'id', textField: 'name',required:true,panelHeight:'auto'"></select>*/
/*             </td>*/
/*         </tr>*/
/*         <tr>*/
/*             <td>选择平台</td>*/
/*             <td>*/
/*                 <select name="Deliver[platform]" class="easyui-combobox" data-options="panelHeight:'auto'" id="platform" onchange="javascript:choose(this.value)">*/
/*                     <option value="京东">京东</option>*/
/*                     <option value="苏宁">苏宁</option>*/
/*                     <option value="天猫">天猫</option>*/
/*                     <option value="亚马逊">亚马逊</option>*/
/*                     <option value="国美">国美</option>*/
/*                     <option value="一号店">一号店</option>*/
/*                     <option value="兑吧">兑吧</option>*/
/*                     <option value="手动">手动</option>*/
/*                 </select>*/
/*             </td>*/
/*         </tr>*/
/*         <tr>*/
/*             <td>支付方式</td>*/
/*             <td>*/
/*                 <select name="Deliver[payment]" class="easyui-combobox" id="payment" data-options="panelHeight:'auto'">*/
/*                     <option value="无">无</option>*/
/*                     <option value="京东">京东</option>*/
/*                     <option value="支付宝">支付宝</option>*/
/*                     <option value="其他">其他</option>*/
/*                 </select>*/
/*             </td>*/
/*         </tr>*/
/*         <tr>*/
/*             <td>第三方订单号</td>*/
/*             <td><input class="easyui-textbox" type="text" name="Deliver[third_order]" data-options="required:true"></td>*/
/*         </tr>*/
/*         <tr>*/
/*             <td>成本</td>*/
/*             <td><input class="easyui-textbox" type="text" name="Deliver[price]" data-options="required:true,"></td>*/
/*         </tr>*/
/*         <tr>*/
/*             <td>规格</td>*/
/*             <td><input class="easyui-textbox" type="text" name="Deliver[standard]" ></td>*/
/*         </tr>*/
/*         <tr>*/
/*             <td>发票</td>*/
/*             <td>*/
/*                 <select name="Deliver[bill]" class="easyui-combobox" id="bill" data-options="panelHeight:'auto'">*/
/*                     <option value="无">无</option>*/
/*                     <option value="普通发票">普通发票</option>*/
/*                     <option value="专业发票">专业发票</option>*/
/*                 </select>*/
/*             </td>*/
/*         </tr>*/
/*         <tr>*/
/*             <td>发票编号</td>*/
/*             <td><input class="easyui-textbox" type="text" name="Deliver[bill_num]" ></td>*/
/*         </tr>*/
/*         <tr>*/
/*             <td></td>*/
/*             <td>*/
/*                 <input type="submit" class="easyui-linkbutton">*/
/*             </td>*/
/*         </tr>*/
/*     </table>*/
/*     {{ html.endForm() | raw }}*/
/*     {% endif %}*/
/* </div>*/
/* <script>*/
/*         var form = 'deliver-form';*/
/*         id = "{{ model.id }}";*/
/*         var exId = "{{ model.is_exchange }}";*/
/*         if(exId != 0){*/
/*             var url = '/win/deliver?id='+id+'&exchange='+exId;*/
/*         } else{*/
/*             var url = '/win/deliver?id='+id;*/
/*         }*/
/* */
/*         $("#platform").combobox({*/
/*             onChange:function(){*/
/*                 var html = '';*/
/*                 if ($(this).combobox('getValue') == '兑吧') {*/
/*                     $(this).parent().parent().nextAll().remove();*/
/*                     $.get("/product/get-info",{pid:{{model.product_id}}},function(data){*/
/*                         var perMax = 0;*/
/*                         if (data.delivery_id == 5) {*/
/*                             perMax = 200;*/
/*                         }else if (data.delivery_id == 6) {*/
/*                             perMax = 200;*/
/*                         }else if (data.delivery_id == 7) {*/
/*                             perMax = 50;*/
/*                         }*/
/*                         var money = data.face_value;*/
/*                         html += '<tr><td>兑换列表</td>';*/
/*                         html += '<td>';*/
/*                         html += '<ul id="duibaList" style="list-style:none;margin:0;padding:0">';*/
/*                         if (money < perMax) {*/
/*                             html += '<li>';*/
/*                             html += '兑换 <font color="red">' + money + '</font> 元 <a href="duiba?pid={{ model.product_id }}&orderid={{ model.id }}&money=' + money + '&p=1" onclick="javascript:return false;">兑换</a>';*/
/*                             html += '</li>';*/
/*                         }else{*/
/*                             var need = parseInt(money / perMax);*/
/*                             var surplus = money;*/
/*                             for(i = 0 ; i < need ; i++){*/
/*                                 html += '<li>';*/
/*                                 html += '兑换 <font color="red">' + perMax + '</font> 元 <a href="duiba?pid={{ model.product_id }}&orderid={{ model.id }}&money=' + perMax + '&p=' + (i+1) + '" onclick="javascript:return false;">兑换</a>';*/
/*                                 html += '</li>';*/
/*                                 surplus -= perMax;*/
/*                             }*/
/*                             if (surplus > 0) {*/
/*                                 html += '<li>';*/
/*                                 html += '兑换 <font color="red">'+surplus+'</font> 元 <a href="duiba?pid={{ model.product_id }}&orderid={{ model.id }}&money=' + surplus + '&p=' + (need+1) + '" onclick="javascript:return false;">兑换</a>';*/
/*                                 html += '</li>';*/
/*                             }*/
/*                         }*/
/*                         html += '</ul>';*/
/*                         html += '</td>';*/
/*                         html += '</tr>';*/
/*                         html += '<tr>';*/
/*                         html += '<td></td>';*/
/*                         html += '<td>';*/
/*                         html += '<input type="submit" class="easyui-linkbutton">';*/
/*                         html += '</td>';*/
/*                         html += '</tr>';*/
/*                         $("table").append(html);*/
/*                         $("#duibaList li a").click(function() {*/
/*                             var getUrl = $(this).attr('href');*/
/*                             var k = $(this).index('#duibaList li a');*/
/*                             if (getUrl) {*/
/*                                 $.get(getUrl,function(duibaInfo){*/
/*                                     if (duibaInfo.code == 100) {*/
/*                                         $("#duibaList li a").eq(k).remove();*/
/*                                         parent.$("#duiba").prop('src',duibaInfo.url);*/
/*                                         parent.$("#dlg-view").window('open');*/
/*                                     }else{*/
/*                                         $.messager.alert('获取地址失败', '获取地址失败，请重试');*/
/*                                     }*/
/*                                 },'json');*/
/*                             }*/
/*                             return false;*/
/*                         });*/
/*                     },'json')*/
/*                 }else if ($(this).combobox('getValue') == '手动') {*/
/*                     if ($('#send').combobox('getValue') != '7') {*/
/*                         $(this).parent().parent().nextAll().remove();*/
/*                         html += '<tr>';*/
/*                         html += '<td>转账订单号</td>';*/
/*                         html += '<td>';*/
/*                         html += '<input type="text" class="easyui-textbox" name="Deliver[third_order]">';*/
/*                         html += '</td>';*/
/*                         html += '</tr>';*/
/*                         html += '<tr>';*/
/*                         html += '<td></td>';*/
/*                         html += '<td>';*/
/*                         html += '<input type="submit" class="easyui-linkbutton">';*/
/*                         html += '</td>';*/
/*                         html += '</tr>';*/
/*                         $("table").append(html);*/
/*                     }*/
/*                 }*/
/*             }*/
/*         })*/
/* */
/*         $('#' + form).form({*/
/*             url: url,*/
/*             onSubmit:function(){*/
/*                 var isSubmit = 1;*/
/*                 $("#duibaList li a").each(function(){*/
/*                     if ($(this).attr('href').length > 0) {*/
/*                         $.messager.alert('提示','兑换还未完成');*/
/*                         isSubmit = 0;*/
/*                         return false;*/
/*                     }*/
/*                 });*/
/*                 if (!isSubmit) {*/
/*                     return false;*/
/*                 }*/
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
/* </script>*/
/* */
