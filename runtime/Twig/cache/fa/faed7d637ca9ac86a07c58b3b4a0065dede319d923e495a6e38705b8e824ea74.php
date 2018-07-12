<?php

/* view.html */
class __TwigTemplate_41653ea09db77365870d6f8bdd821d998b9dc1a98635365f1802ce25f44fd42e extends yii\twig\Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("@app/views/base.html", "view.html", 1);
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
        echo "<style>
    table { cellspacing: 5px;border-collapse:collapse; }
    table tr td {word-break: break-all; padding: 13px; width: 230px;}
    table tr td:first-child{ width: 100px; display: inline-block;}
    table tr.tsTr{border-top: 1px solid #ccc;border-bottom: 1px solid #ccc;}
    table tr.tsTr td,table tr.tsTr td div,table tr.tsTr td p{ width: 230px;vertical-align: bottom; overflow: hidden;}
    .easyui-linkbutton{ padding: 0 20px;}
    /*table tr td:nth-child(1) { width: 660px; word-break: break-all; }*/
</style>
";
        // line 13
        echo $this->getAttribute((isset($context["html"]) ? $context["html"] : null), "beginForm", array(0 => "", 1 => "post", 2 => array("class" => "am-form am-form-horizontal", "id" => "detailForm")), "method");
        echo "
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
    <tr>
        <td>订单号</td><td>";
        // line 16
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["orderInfo"]) ? $context["orderInfo"] : null), "order_no", array()), "html", null, true);
        echo "</td>
    </tr>
    <tr>
        <td>商品名称</td><td>";
        // line 19
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["productInfo"]) ? $context["productInfo"] : null), "name", array()), "html", null, true);
        echo "</td>
    </tr>
    <tr>
        <td>商品分类</td><td>";
        // line 22
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["categoryInfo"]) ? $context["categoryInfo"] : null), "name", array()), "html", null, true);
        echo "</td>
    </tr>
    <tr>
        <td>伙购价格</td><td>￥";
        // line 25
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["productInfo"]) ? $context["productInfo"] : null), "price", array()), "html", null, true);
        echo "</td>
    </tr>
    <tr>
        <td>会员名</td><td>";
        // line 28
        if (($this->getAttribute((isset($context["userInfo"]) ? $context["userInfo"] : null), "phone", array()) && $this->getAttribute((isset($context["userInfo"]) ? $context["userInfo"] : null), "email", array()))) {
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["userInfo"]) ? $context["userInfo"] : null), "phone", array()), "html", null, true);
            echo "  ";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["userInfo"]) ? $context["userInfo"] : null), "email", array()), "html", null, true);
        } else {
            echo twig_escape_filter($this->env, (($this->getAttribute((isset($context["userInfo"]) ? $context["userInfo"] : null), "phone", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute((isset($context["userInfo"]) ? $context["userInfo"] : null), "phone", array()), $this->getAttribute((isset($context["userInfo"]) ? $context["userInfo"] : null), "email", array()))) : ($this->getAttribute((isset($context["userInfo"]) ? $context["userInfo"] : null), "email", array()))), "html", null, true);
        }
        echo "</td>
    </tr>
    <tr>
        <td>状态</td><td>";
        // line 31
        if (($this->getAttribute((isset($context["shareTopicInfo"]) ? $context["shareTopicInfo"] : null), "is_pass", array()) == 0)) {
            echo "待审核</a>";
        } elseif (($this->getAttribute((isset($context["shareTopicInfo"]) ? $context["shareTopicInfo"] : null), "is_pass", array()) == 1)) {
            echo "完成";
        } elseif (($this->getAttribute((isset($context["shareTopicInfo"]) ? $context["shareTopicInfo"] : null), "is_pass", array()) == 2)) {
            echo "未通过";
        }
        echo "</td>
    </tr>
    ";
        // line 33
        if (($this->getAttribute((isset($context["shareTopicInfo"]) ? $context["shareTopicInfo"] : null), "is_pass", array()) == 2)) {
            // line 34
            echo "    <tr>
        <td>原因</td><td>";
            // line 35
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["shareTopicInfo"]) ? $context["shareTopicInfo"] : null), "note", array()), "html", null, true);
            echo "</td>
    </tr>
    ";
        }
        // line 38
        echo "    <tr>
        <td>晒单时间</td><td>";
        // line 39
        echo twig_escape_filter($this->env, twig_date_format_filter($this->env, $this->getAttribute((isset($context["shareTopicInfo"]) ? $context["shareTopicInfo"] : null), "created_at", array()), "Y-m-d H:i:s"), "html", null, true);
        echo "</td>
    </tr>
    ";
        // line 41
        if (($this->getAttribute((isset($context["shareTopicInfo"]) ? $context["shareTopicInfo"] : null), "is_pass", array()) != 0)) {
            // line 42
            echo "    <tr>
        <td>是否显示</td><td>";
            // line 43
            if (($this->getAttribute((isset($context["shareTopicInfo"]) ? $context["shareTopicInfo"] : null), "is_show", array()) == 1)) {
                echo "是";
            } else {
                echo "否";
            }
            echo "</td>
    </tr>
    <tr>
        <td>审核人</td><td>";
            // line 46
            echo twig_escape_filter($this->env, (isset($context["admin"]) ? $context["admin"] : null), "html", null, true);
            echo "</td>
    </tr>
    <tr>
        <td>审核时间</td><td>";
            // line 49
            echo twig_escape_filter($this->env, twig_date_format_filter($this->env, $this->getAttribute((isset($context["shareTopicInfo"]) ? $context["shareTopicInfo"] : null), "checked_at", array()), "Y-m-d H:i:s"), "html", null, true);
            echo "</td>
    </tr>
    ";
        }
        // line 52
        echo "    <!--<tr><td colspan=\"2\"><hr/></td></tr>-->
    <!--<tr>-->
        <!--<td>晒单图片</td>-->
        <!--<td style=\"width: 650px\">-->
            <!--";
        // line 56
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["pictures"]) ? $context["pictures"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["pic"]) {
            echo "-->
            <!--<div style=\" display: inline-block; padding-bottom: 30px; position: relative;\">-->
                <!--<img src=\"";
            // line 58
            echo twig_escape_filter($this->env, $this->getAttribute($context["pic"], "url", array()), "html", null, true);
            echo "\" class=\"picture\" style=\"width: 200px; display:inline-block\" share_topic_id=\"";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["shareTopicInfo"]) ? $context["shareTopicInfo"] : null), "id", array()), "html", null, true);
            echo "\" basename=\"";
            echo twig_escape_filter($this->env, $this->getAttribute($context["pic"], "basename", array()), "html", null, true);
            echo "\">-->
                <!--<span style=\"position: absolute; left:80px; bottom:12px;\">-->
                <!--";
            // line 60
            if (($this->getAttribute($context["pic"], "main", array()) == 1)) {
                echo "主图";
            }
            echo "-->
                <!--";
            // line 61
            if (($this->getAttribute($context["pic"], "roll", array()) == 1)) {
                echo " 滚动图";
            }
            echo "-->
                <!--";
            // line 62
            if (($this->getAttribute($context["pic"], "recommend", array()) == 1)) {
                echo " 推荐图";
            }
            echo "-->
                <!--</span>-->
            <!--</div>-->
            <!--";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['pic'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 65
        echo "-->
        <!--</td>-->
    <!--</tr>-->
    <!--<tr>-->
        <!--&lt;!&ndash;<td rowspan=\"";
        // line 69
        echo twig_escape_filter($this->env, (isset($context["pictures_num"]) ? $context["pictures_num"] : null), "html", null, true);
        echo "\">晒单图片</td>&ndash;&gt;-->
        <!--<td rowspan=\"2\">晒单图片</td>-->
    <!--</tr>-->
    <tr class=\"tsTr\">
        <td style=\"padding-top: 100px;\">晒单图片</td>
    ";
        // line 74
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["pictures"]) ? $context["pictures"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["pic"]) {
            // line 75
            echo "        <td>
            <div style=\" display: inline-block; padding-bottom: 30px; position: relative;\">
                <img src=\"";
            // line 77
            echo twig_escape_filter($this->env, $this->getAttribute($context["pic"], "url", array()), "html", null, true);
            echo "\" class=\"picture\" width=\"100%\" style=\"display:inline-block\" share_topic_id=\"";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["shareTopicInfo"]) ? $context["shareTopicInfo"] : null), "id", array()), "html", null, true);
            echo "\" basename=\"";
            echo twig_escape_filter($this->env, $this->getAttribute($context["pic"], "basename", array()), "html", null, true);
            echo "\">
                <span style=\"position: absolute; left:80px; bottom:12px;\">
                ";
            // line 79
            if (($this->getAttribute($context["pic"], "main", array()) == 1)) {
                echo "主图";
            }
            // line 80
            echo "                ";
            if (($this->getAttribute($context["pic"], "roll", array()) == 1)) {
                echo " 滚动图";
            }
            // line 81
            echo "                ";
            if (($this->getAttribute($context["pic"], "recommend", array()) == 1)) {
                echo " 推荐图";
            }
            // line 82
            echo "                </span>
            </div>
            <p><span>排序：</span><input style=\"width: 50px;\" class=\"easyui-numberbox\" type=\"text\" name=\"Pic[";
            // line 84
            echo twig_escape_filter($this->env, $this->getAttribute($context["pic"], "basename", array()), "html", null, true);
            echo "][order]\" data-options=\"min:0,precision:0,required:true\" value=\"";
            echo twig_escape_filter($this->env, $this->getAttribute($context["pic"], "order", array()), "html", null, true);
            echo "\"><input name=\"Pic[";
            echo twig_escape_filter($this->env, $this->getAttribute($context["pic"], "basename", array()), "html", null, true);
            echo "][is_show]\" type=\"radio\" class=\"easyui-validatebox\" ";
            if (($this->getAttribute($context["pic"], "is_show", array()) == 1)) {
                echo "checked";
            }
            echo " value=\"1\" onclick=\"showPic('";
            echo twig_escape_filter($this->env, $this->getAttribute($context["pic"], "basename", array()), "html", null, true);
            echo "', 1)\"><span>显示</span><input name=\"Pic[";
            echo twig_escape_filter($this->env, $this->getAttribute($context["pic"], "basename", array()), "html", null, true);
            echo "][is_show]\" type=\"radio\" class=\"easyui-validatebox\" ";
            if (($this->getAttribute($context["pic"], "is_show", array()) == 0)) {
                echo "checked";
            }
            echo " value=\"0\" onclick=\"showPic('";
            echo twig_escape_filter($this->env, $this->getAttribute($context["pic"], "basename", array()), "html", null, true);
            echo "', 0)\"><span>隐藏</span></p>
        </td>
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['pic'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 87
        echo "    </tr>
    <tr>
        <td>获奖感言</td><td>";
        // line 89
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["shareTopicInfo"]) ? $context["shareTopicInfo"] : null), "content", array()), "html", null, true);
        echo "</td>
    </tr>
    ";
        // line 91
        if (($this->getAttribute((isset($context["shareTopicInfo"]) ? $context["shareTopicInfo"] : null), "is_pass", array()) != 1)) {
            // line 92
            echo "    <tr>
        <td>审核</td>
        <td>
            <input name=\"is_pass\" type=\"radio\" class=\"easyui-validatebox\" checked value=\"1\">通过
            <input name=\"is_pass\" type=\"radio\" class=\"easyui-validatebox\" value=\"2\" ";
            // line 96
            if (($this->getAttribute((isset($context["shareTopicInfo"]) ? $context["shareTopicInfo"] : null), "is_pass", array()) == 2)) {
                echo "disabled";
            }
            echo ">驳回
        </td>
    </tr>
    <tr class=\"pass\">
        <td>奖励积分</td>
        <td>
            <select class=\"easyui-combobox\" name=\"point\" data-options=\"panelHeight:'auto', required:true\">
                <option value=\"400\">400</option>
                <option value=\"500\">500</option>
                <option value=\"600\">600</option>
                <option value=\"700\">700</option>
                <option value=\"800\">800</option>
                <option value=\"900\">900</option>
                <option value=\"1000\">1000</option>
                <option value=\"1100\">1100</option>
                <option value=\"1200\">1200</option>
                <option value=\"1300\">1300</option>
                <option value=\"1400\">1400</option>
                <option value=\"1500\">1500</option>
            </select>
        </td>
    </tr>
    <tr class=\"pass\">
        <td>推荐</td>
        <td>
            <input name=\"is_recommend\" type=\"radio\" class=\"easyui-validatebox\" checked value=\"0\">否
            <input name=\"is_recommend\" type=\"radio\" class=\"easyui-validatebox\" value=\"1\">是
        </td>
    </tr>
    <tr class=\"pass\">
        <td>精华</td>
        <td>
            <input name=\"is_digest\" type=\"radio\" class=\"easyui-validatebox\" checked value=\"0\">否
            <input name=\"is_digest\" type=\"radio\" class=\"easyui-validatebox\" value=\"1\">是
        </td>
    </tr>
    <tr class=\"pass\">
        <td>是否显示</td>
        <td>
            <input name=\"is_show\" type=\"radio\" class=\"easyui-validatebox\" value=\"0\">否
            <input name=\"is_show\" type=\"radio\" class=\"easyui-validatebox\" checked value=\"1\">是
        </td>
    </tr>
    <tr class=\"no_pass\">
        <td>拒绝原因</td>
        <td>
            <select class=\"easyui-combobox\" data-options=\"panelHeight:'auto', onSelect: noteOnselect, required:true\">
                <option value=\"图片不清晰\">图片不清晰</option>
                <option value=\"获奖感言与获奖商品不一致\">获奖感言与获奖商品不一致</option>
                <option value=\"图片与获奖商品不一致\">图片与获奖商品不一致</option>
                <option value=\"其他\">其他</option>
            </select>
        </td>
    </tr>
    <tr class=\"other\">
        <td></td>
        <td>
            <input class=\"easyui-textbox\" type=\"text\" id=\"note\" name=\"note\" data-options=\"required:true\" value=\"图片不清晰\">
        </td>
    </tr>
    <tr>
        <td>&nbsp;</td>
        <td>
            <a style=\"margin-right: 20px;\" href=\"javascript:void(0)\" class=\"easyui-linkbutton\" onclick=\"submitForm()\">确定</a>
            <a href=\"javascript:void(0)\" class=\"easyui-linkbutton\" onclick=\"clearForm()\">取消</a>
        </td>
    </tr>
    ";
        }
        // line 164
        echo "</table>
";
        // line 165
        echo $this->getAttribute((isset($context["html"]) ? $context["html"] : null), "endForm", array(), "method");
        echo "

<div id=\"dlg-edit\" class=\"easyui-window\" title=\"编辑图片\" style=\"width:650px;height:700px;padding:10px;overflow:hidden;\" data-options=\"
            iconCls:'icon-save',
            closed:true,
            modal:true,
            onClose: onClose,
            onResize:function(){
                \$(this).window('hcenter');
            }\">
    <iframe width=\"100%\" height=\"100%\" frameborder=\"0\" id=\"edit_iframe\"></iframe>
</div>

";
    }

    // line 180
    public function block_js($context, array $blocks = array())
    {
        // line 181
        echo "<script>
    \$(function() {
        \$('.no_pass').hide();
        \$('.other').hide();

        \$(\"input:radio[name='is_pass']\").change(function () {
            if (\$(this).val() == 1) {
                \$('.pass').show();
                \$('.no_pass').hide();
                \$('.other').hide();
            } else {
                \$('.pass').hide();
                \$('.no_pass').show();
                \$('.other').hide();
            }
        });

        \$('img').on('click', function() {
            \$('#edit_iframe').prop('src', \"";
        // line 199
        echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url("share/show-picture"), "html", null, true);
        echo "\" + '?id=' + \$(this).attr('share_topic_id') + '&basename=' + \$(this).attr('basename'));
            \$('#dlg-edit').window('open');
        });
    })

    function noteOnselect(newValue, oldValue) {
        if (newValue.value == '其他') {
            \$('.other').show();
            \$('#note').textbox('setValue', '');
        } else {
            \$('.other').hide();
            \$('#note').textbox('setValue', newValue.value);
        }
    }

    function submitForm() {
        \$('#detailForm').form({
            url: '/share/view?id=' + \"";
        // line 216
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["shareTopicInfo"]) ? $context["shareTopicInfo"] : null), "id", array()), "html", null, true);
        echo "\",
            onSubmit:function(){
                result = \$(this).form('enableValidation').form('validate');
            },
            success: function (data) {
                data = eval('(' + data + ')');
                if (data.error == 0) {
                    \$.messager.alert('成功', data.message);
                    setTimeout(function(){
                        window.parent.window.reloadgrid();
                        window.parent.window.closeDigView();
                    }, 1000);
                } else {
                    \$.messager.alert('失败', data.message, 'error');
                }
            }
        });
        \$('#detailForm').submit();
    }

    function onClose() {
        \$('#edit_iframe').prop('src', '');
        window.parent.window.reloadgrid();
    }

    function showPic(basename, is_show) {
        if (basename) {
            \$.get(\"";
        // line 243
        echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url("share/show-pic"), "html", null, true);
        echo "\", {'is_show':is_show, 'basename':basename}, function(data) {
            }, 'json');
        }
    }
</script>
";
    }

    public function getTemplateName()
    {
        return "view.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  448 => 243,  418 => 216,  398 => 199,  378 => 181,  375 => 180,  357 => 165,  354 => 164,  281 => 96,  275 => 92,  273 => 91,  268 => 89,  264 => 87,  237 => 84,  233 => 82,  228 => 81,  223 => 80,  219 => 79,  210 => 77,  206 => 75,  202 => 74,  194 => 69,  188 => 65,  176 => 62,  170 => 61,  164 => 60,  155 => 58,  148 => 56,  142 => 52,  136 => 49,  130 => 46,  120 => 43,  117 => 42,  115 => 41,  110 => 39,  107 => 38,  101 => 35,  98 => 34,  96 => 33,  85 => 31,  73 => 28,  67 => 25,  61 => 22,  55 => 19,  49 => 16,  43 => 13,  32 => 4,  29 => 3,  11 => 1,);
    }
}
/* {% extends '@app/views/base.html' %}*/
/* */
/* {% block main %}*/
/* <style>*/
/*     table { cellspacing: 5px;border-collapse:collapse; }*/
/*     table tr td {word-break: break-all; padding: 13px; width: 230px;}*/
/*     table tr td:first-child{ width: 100px; display: inline-block;}*/
/*     table tr.tsTr{border-top: 1px solid #ccc;border-bottom: 1px solid #ccc;}*/
/*     table tr.tsTr td,table tr.tsTr td div,table tr.tsTr td p{ width: 230px;vertical-align: bottom; overflow: hidden;}*/
/*     .easyui-linkbutton{ padding: 0 20px;}*/
/*     /*table tr td:nth-child(1) { width: 660px; word-break: break-all; }*//* */
/* </style>*/
/* {{ html.beginForm('', 'post', {'class':'am-form am-form-horizontal', 'id':'detailForm'}) | raw }}*/
/* <table border="0" cellspacing="0" cellpadding="0">*/
/*     <tr>*/
/*         <td>订单号</td><td>{{ orderInfo.order_no }}</td>*/
/*     </tr>*/
/*     <tr>*/
/*         <td>商品名称</td><td>{{ productInfo.name }}</td>*/
/*     </tr>*/
/*     <tr>*/
/*         <td>商品分类</td><td>{{ categoryInfo.name }}</td>*/
/*     </tr>*/
/*     <tr>*/
/*         <td>伙购价格</td><td>￥{{ productInfo.price }}</td>*/
/*     </tr>*/
/*     <tr>*/
/*         <td>会员名</td><td>{% if userInfo.phone and userInfo.email %}{{ userInfo.phone }}  {{ userInfo.email }}{% else %}{{ userInfo.phone|default(userInfo.email) }}{% endif %}</td>*/
/*     </tr>*/
/*     <tr>*/
/*         <td>状态</td><td>{% if shareTopicInfo.is_pass == 0 %}待审核</a>{% elseif shareTopicInfo.is_pass == 1 %}完成{% elseif shareTopicInfo.is_pass == 2 %}未通过{% endif %}</td>*/
/*     </tr>*/
/*     {% if shareTopicInfo.is_pass == 2 %}*/
/*     <tr>*/
/*         <td>原因</td><td>{{ shareTopicInfo.note }}</td>*/
/*     </tr>*/
/*     {% endif %}*/
/*     <tr>*/
/*         <td>晒单时间</td><td>{{ shareTopicInfo.created_at|date('Y-m-d H:i:s') }}</td>*/
/*     </tr>*/
/*     {% if shareTopicInfo.is_pass != 0 %}*/
/*     <tr>*/
/*         <td>是否显示</td><td>{% if shareTopicInfo.is_show == 1 %}是{% else %}否{% endif %}</td>*/
/*     </tr>*/
/*     <tr>*/
/*         <td>审核人</td><td>{{ admin }}</td>*/
/*     </tr>*/
/*     <tr>*/
/*         <td>审核时间</td><td>{{ shareTopicInfo.checked_at|date('Y-m-d H:i:s') }}</td>*/
/*     </tr>*/
/*     {% endif %}*/
/*     <!--<tr><td colspan="2"><hr/></td></tr>-->*/
/*     <!--<tr>-->*/
/*         <!--<td>晒单图片</td>-->*/
/*         <!--<td style="width: 650px">-->*/
/*             <!--{% for pic in pictures %}-->*/
/*             <!--<div style=" display: inline-block; padding-bottom: 30px; position: relative;">-->*/
/*                 <!--<img src="{{ pic.url }}" class="picture" style="width: 200px; display:inline-block" share_topic_id="{{ shareTopicInfo.id }}" basename="{{ pic.basename }}">-->*/
/*                 <!--<span style="position: absolute; left:80px; bottom:12px;">-->*/
/*                 <!--{% if pic.main == 1 %}主图{% endif %}-->*/
/*                 <!--{% if pic.roll == 1 %} 滚动图{% endif %}-->*/
/*                 <!--{% if pic.recommend == 1 %} 推荐图{% endif %}-->*/
/*                 <!--</span>-->*/
/*             <!--</div>-->*/
/*             <!--{% endfor %}-->*/
/*         <!--</td>-->*/
/*     <!--</tr>-->*/
/*     <!--<tr>-->*/
/*         <!--&lt;!&ndash;<td rowspan="{{ pictures_num }}">晒单图片</td>&ndash;&gt;-->*/
/*         <!--<td rowspan="2">晒单图片</td>-->*/
/*     <!--</tr>-->*/
/*     <tr class="tsTr">*/
/*         <td style="padding-top: 100px;">晒单图片</td>*/
/*     {% for pic in pictures %}*/
/*         <td>*/
/*             <div style=" display: inline-block; padding-bottom: 30px; position: relative;">*/
/*                 <img src="{{ pic.url }}" class="picture" width="100%" style="display:inline-block" share_topic_id="{{ shareTopicInfo.id }}" basename="{{ pic.basename }}">*/
/*                 <span style="position: absolute; left:80px; bottom:12px;">*/
/*                 {% if pic.main == 1 %}主图{% endif %}*/
/*                 {% if pic.roll == 1 %} 滚动图{% endif %}*/
/*                 {% if pic.recommend == 1 %} 推荐图{% endif %}*/
/*                 </span>*/
/*             </div>*/
/*             <p><span>排序：</span><input style="width: 50px;" class="easyui-numberbox" type="text" name="Pic[{{ pic.basename }}][order]" data-options="min:0,precision:0,required:true" value="{{ pic.order }}"><input name="Pic[{{ pic.basename }}][is_show]" type="radio" class="easyui-validatebox" {% if pic.is_show == 1 %}checked{% endif %} value="1" onclick="showPic('{{ pic.basename }}', 1)"><span>显示</span><input name="Pic[{{ pic.basename }}][is_show]" type="radio" class="easyui-validatebox" {% if pic.is_show == 0 %}checked{% endif %} value="0" onclick="showPic('{{ pic.basename }}', 0)"><span>隐藏</span></p>*/
/*         </td>*/
/*     {% endfor %}*/
/*     </tr>*/
/*     <tr>*/
/*         <td>获奖感言</td><td>{{ shareTopicInfo.content }}</td>*/
/*     </tr>*/
/*     {% if shareTopicInfo.is_pass != 1 %}*/
/*     <tr>*/
/*         <td>审核</td>*/
/*         <td>*/
/*             <input name="is_pass" type="radio" class="easyui-validatebox" checked value="1">通过*/
/*             <input name="is_pass" type="radio" class="easyui-validatebox" value="2" {% if shareTopicInfo.is_pass == 2 %}disabled{% endif %}>驳回*/
/*         </td>*/
/*     </tr>*/
/*     <tr class="pass">*/
/*         <td>奖励积分</td>*/
/*         <td>*/
/*             <select class="easyui-combobox" name="point" data-options="panelHeight:'auto', required:true">*/
/*                 <option value="400">400</option>*/
/*                 <option value="500">500</option>*/
/*                 <option value="600">600</option>*/
/*                 <option value="700">700</option>*/
/*                 <option value="800">800</option>*/
/*                 <option value="900">900</option>*/
/*                 <option value="1000">1000</option>*/
/*                 <option value="1100">1100</option>*/
/*                 <option value="1200">1200</option>*/
/*                 <option value="1300">1300</option>*/
/*                 <option value="1400">1400</option>*/
/*                 <option value="1500">1500</option>*/
/*             </select>*/
/*         </td>*/
/*     </tr>*/
/*     <tr class="pass">*/
/*         <td>推荐</td>*/
/*         <td>*/
/*             <input name="is_recommend" type="radio" class="easyui-validatebox" checked value="0">否*/
/*             <input name="is_recommend" type="radio" class="easyui-validatebox" value="1">是*/
/*         </td>*/
/*     </tr>*/
/*     <tr class="pass">*/
/*         <td>精华</td>*/
/*         <td>*/
/*             <input name="is_digest" type="radio" class="easyui-validatebox" checked value="0">否*/
/*             <input name="is_digest" type="radio" class="easyui-validatebox" value="1">是*/
/*         </td>*/
/*     </tr>*/
/*     <tr class="pass">*/
/*         <td>是否显示</td>*/
/*         <td>*/
/*             <input name="is_show" type="radio" class="easyui-validatebox" value="0">否*/
/*             <input name="is_show" type="radio" class="easyui-validatebox" checked value="1">是*/
/*         </td>*/
/*     </tr>*/
/*     <tr class="no_pass">*/
/*         <td>拒绝原因</td>*/
/*         <td>*/
/*             <select class="easyui-combobox" data-options="panelHeight:'auto', onSelect: noteOnselect, required:true">*/
/*                 <option value="图片不清晰">图片不清晰</option>*/
/*                 <option value="获奖感言与获奖商品不一致">获奖感言与获奖商品不一致</option>*/
/*                 <option value="图片与获奖商品不一致">图片与获奖商品不一致</option>*/
/*                 <option value="其他">其他</option>*/
/*             </select>*/
/*         </td>*/
/*     </tr>*/
/*     <tr class="other">*/
/*         <td></td>*/
/*         <td>*/
/*             <input class="easyui-textbox" type="text" id="note" name="note" data-options="required:true" value="图片不清晰">*/
/*         </td>*/
/*     </tr>*/
/*     <tr>*/
/*         <td>&nbsp;</td>*/
/*         <td>*/
/*             <a style="margin-right: 20px;" href="javascript:void(0)" class="easyui-linkbutton" onclick="submitForm()">确定</a>*/
/*             <a href="javascript:void(0)" class="easyui-linkbutton" onclick="clearForm()">取消</a>*/
/*         </td>*/
/*     </tr>*/
/*     {% endif %}*/
/* </table>*/
/* {{ html.endForm() | raw }}*/
/* */
/* <div id="dlg-edit" class="easyui-window" title="编辑图片" style="width:650px;height:700px;padding:10px;overflow:hidden;" data-options="*/
/*             iconCls:'icon-save',*/
/*             closed:true,*/
/*             modal:true,*/
/*             onClose: onClose,*/
/*             onResize:function(){*/
/*                 $(this).window('hcenter');*/
/*             }">*/
/*     <iframe width="100%" height="100%" frameborder="0" id="edit_iframe"></iframe>*/
/* </div>*/
/* */
/* {% endblock %}*/
/* */
/* {% block js %}*/
/* <script>*/
/*     $(function() {*/
/*         $('.no_pass').hide();*/
/*         $('.other').hide();*/
/* */
/*         $("input:radio[name='is_pass']").change(function () {*/
/*             if ($(this).val() == 1) {*/
/*                 $('.pass').show();*/
/*                 $('.no_pass').hide();*/
/*                 $('.other').hide();*/
/*             } else {*/
/*                 $('.pass').hide();*/
/*                 $('.no_pass').show();*/
/*                 $('.other').hide();*/
/*             }*/
/*         });*/
/* */
/*         $('img').on('click', function() {*/
/*             $('#edit_iframe').prop('src', "{{ url('share/show-picture') }}" + '?id=' + $(this).attr('share_topic_id') + '&basename=' + $(this).attr('basename'));*/
/*             $('#dlg-edit').window('open');*/
/*         });*/
/*     })*/
/* */
/*     function noteOnselect(newValue, oldValue) {*/
/*         if (newValue.value == '其他') {*/
/*             $('.other').show();*/
/*             $('#note').textbox('setValue', '');*/
/*         } else {*/
/*             $('.other').hide();*/
/*             $('#note').textbox('setValue', newValue.value);*/
/*         }*/
/*     }*/
/* */
/*     function submitForm() {*/
/*         $('#detailForm').form({*/
/*             url: '/share/view?id=' + "{{ shareTopicInfo.id }}",*/
/*             onSubmit:function(){*/
/*                 result = $(this).form('enableValidation').form('validate');*/
/*             },*/
/*             success: function (data) {*/
/*                 data = eval('(' + data + ')');*/
/*                 if (data.error == 0) {*/
/*                     $.messager.alert('成功', data.message);*/
/*                     setTimeout(function(){*/
/*                         window.parent.window.reloadgrid();*/
/*                         window.parent.window.closeDigView();*/
/*                     }, 1000);*/
/*                 } else {*/
/*                     $.messager.alert('失败', data.message, 'error');*/
/*                 }*/
/*             }*/
/*         });*/
/*         $('#detailForm').submit();*/
/*     }*/
/* */
/*     function onClose() {*/
/*         $('#edit_iframe').prop('src', '');*/
/*         window.parent.window.reloadgrid();*/
/*     }*/
/* */
/*     function showPic(basename, is_show) {*/
/*         if (basename) {*/
/*             $.get("{{ url('share/show-pic') }}", {'is_show':is_show, 'basename':basename}, function(data) {*/
/*             }, 'json');*/
/*         }*/
/*     }*/
/* </script>*/
/* {% endblock %}*/
/* */
/* */
