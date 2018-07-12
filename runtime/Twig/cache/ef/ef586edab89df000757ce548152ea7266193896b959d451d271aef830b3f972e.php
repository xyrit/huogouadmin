<?php

/* view.html */
class __TwigTemplate_315b573d54d02bfb92fa031f5416d2094436e42336cdfda31ab0c40b53cde134 extends yii\twig\Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("@app/views/base.html", "view.html", 1);
        $this->blocks = array(
            'css' => array($this, 'block_css'),
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
    public function block_css($context, array $blocks = array())
    {
        // line 4
        echo "<style>
    td {
        border: 1px solid #C1DAD7;
        background: #fff;
        font-size: 11px;
        padding: 6px 6px 6px 12px;
        color: #4f6b72;
    }

    td label {
        background-color: #dddddd;
        width: 100px;
        height: 35px;
        border-collapse: collapse;
    }

    td .alt {
        background: #F5FAFA;
        color: #797268;
    }

    .box span {
        font-size: 12px;
        padding: 6px 6px 6px 12px;
        color: #4f6b72;
    }

    .good {
        border-collapse: collapse;
    }

    .panel-body div {
        padding: 10px 0;
    }

</style>
";
    }

    // line 42
    public function block_main($context, array $blocks = array())
    {
        // line 43
        echo "<div title=\"Basic Window\" style=\"padding:5px;height:auto\" class=\"box\">
    <div style=\"padding: 10px 0;\">
        <span>订单状态：";
        // line 45
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["detail"]) ? $context["detail"] : null), "status_name", array()), "html", null, true);
        echo "</span><span>订单编号：";
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["detail"]) ? $context["detail"] : null), "id", array()), "html", null, true);
        echo "</span><span>订单生成时间：";
        echo twig_escape_filter($this->env, twig_date_format_filter($this->env, $this->getAttribute((isset($context["detail"]) ? $context["detail"] : null), "create_time", array()), "Y-m-d H:i:s"), "html", null, true);
        echo "</span>
    </div>

    <table class=\"good\">
        <tr>
            <td>商品名称</td>
            <td>商品面额</td>
            <td>商品编码</td>
            <td>商品品牌</td>
            <td>伙购价</td>
            <td>购买大小</td>
            <td>当前期号</td>
            <td>是否是虚拟商品</td>
            <td>发货方式</td>
        </tr>

        <tr>
            <td>";
        // line 62
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["goodInfo"]) ? $context["goodInfo"] : null), "name", array()), "html", null, true);
        echo "</td>
            <td>";
        // line 63
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["goodInfo"]) ? $context["goodInfo"] : null), "face_value", array()), "html", null, true);
        echo "</td>
            <td>";
        // line 64
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["goodInfo"]) ? $context["goodInfo"] : null), "bn", array()), "html", null, true);
        echo "</td>
            <td>";
        // line 65
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["goodInfo"]) ? $context["goodInfo"] : null), "brand_id", array()), "html", null, true);
        echo "</td>
            <td>￥";
        // line 66
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["goodInfo"]) ? $context["goodInfo"] : null), "price", array()), "html", null, true);
        echo "</td>
            <td> ";
        // line 67
        if (($this->getAttribute((isset($context["detail"]) ? $context["detail"] : null), "size", array()) == 1)) {
            echo " 大 ";
        } else {
            echo "小";
        }
        echo "</td>
            <td>";
        // line 68
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["periodinfo"]) ? $context["periodinfo"] : null), "period_no", array()), "html", null, true);
        echo "</td>
            <td>";
        // line 69
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["goodInfo"]) ? $context["goodInfo"] : null), "is_virtual", array()), "html", null, true);
        echo "</td>
            <td>";
        // line 70
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["goodInfo"]) ? $context["goodInfo"] : null), "delivery_id", array()), "html", null, true);
        echo "</td>
        </tr>
    </table>

    <table style=\"display: block\" cellpadding=\"5\">
        <tr>
            <td><label>订单号：</label>";
        // line 76
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["detail"]) ? $context["detail"] : null), "id", array()), "html", null, true);
        echo "</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>

        <tr>
            <td>商品分类：";
        // line 84
        echo twig_escape_filter($this->env, (isset($context["cat_name"]) ? $context["cat_name"] : null), "html", null, true);
        echo "</td>
            <td>发货方式：";
        // line 85
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["goodInfo"]) ? $context["goodInfo"] : null), "delivery_id", array()), "html", null, true);
        echo "</td>
            <td>商品价格：￥";
        // line 86
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["goodInfo"]) ? $context["goodInfo"] : null), "price", array()), "html", null, true);
        echo "</td>
            <td></td>
            <td></td>

        </tr>
        <tr>
            <td>中奖码：";
        // line 92
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["periodinfo"]) ? $context["periodinfo"] : null), "lucky_code", array()), "html", null, true);
        echo "</td>
            <td>会员：";
        // line 93
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["detail"]) ? $context["detail"] : null), "user_id", array()), "username", array()), "html", null, true);
        echo "</td>
            <td>桌号：";
        // line 94
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["detail"]) ? $context["detail"] : null), "desk_id", array()), "html", null, true);
        echo "</td>
            <td>期数：";
        // line 95
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["detail"]) ? $context["detail"] : null), "period_id", array()), "html", null, true);
        echo "</td>
            <td>开奖时间：";
        // line 96
        echo twig_escape_filter($this->env, twig_date_format_filter($this->env, $this->getAttribute((isset($context["periodinfo"]) ? $context["periodinfo"] : null), "end_time", array()), "Y-m-d H:i:s"), "html", null, true);
        echo "</td>
        </tr>
        <tr>
            <td>会员手机号：";
        // line 99
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["user"]) ? $context["user"] : null), "phone", array()), "html", null, true);
        echo "</td>
            <td>会员邮箱：";
        // line 100
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["user"]) ? $context["user"] : null), "email", array()), "html", null, true);
        echo "</td>
            <td>平台:";
        // line 101
        if (($this->getAttribute((isset($context["user"]) ? $context["user"] : null), "from", array()) == 1)) {
            echo " 伙购平台 ";
        } else {
            echo "滴滴平台";
        }
        echo "</td>
            <td></td>
            <td></td>
        </tr>
    </table>
</div>
<br/>
<div class=\"desc\">
    ";
        // line 109
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["desc"]) ? $context["desc"] : null));
        foreach ($context['_seq'] as $context["key"] => $context["item"]) {
            // line 110
            echo "    ";
            echo twig_escape_filter($this->env, $this->getAttribute($context["item"], "desc", array()), "html", null, true);
            echo "----";
            echo twig_escape_filter($this->env, $this->getAttribute($context["item"], "time", array()), "html", null, true);
            echo " <br>
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['key'], $context['item'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 112
        echo "    <textarea class=\"in_desc\"></textarea>
</div>
<div><input type=\"button\" class=\"savedesc\" value=\"保存备注\"></div>
";
        // line 115
        if ((($this->getAttribute((isset($context["detail"]) ? $context["detail"] : null), "status", array()) == 3) && ($this->getAttribute((isset($context["detail"]) ? $context["detail"] : null), "confirm", array()) == 1))) {
            // line 116
            echo "<a href=\"javascript:void(0)\" class=\"easyui-linkbutton get-status\" data-id=\"all\" id=\"send-show\"
   onclick=\"deliver()\">发货</a>
<a href=\"javascript:void(0)\" class=\"easyui-linkbutton get-status\" data-id=\"all\" onclick=\"refuse()\">驳回</a>
";
        }
    }

    // line 121
    public function block_script($context, array $blocks = array())
    {
        // line 122
        echo "<script>
    var status = \"";
        // line 123
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["detail"]) ? $context["detail"] : null), "status", array()), "html", null, true);
        echo "\";
    var id = \"";
        // line 124
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["detail"]) ? $context["detail"] : null), "id", array()), "html", null, true);
        echo "\";
    var exchange = \"";
        // line 125
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["detail"]) ? $context["detail"] : null), "is_exchange", array()), "html", null, true);
        echo "\";

    \$('#address-show').click(function () {
        \$('#address-info').prop('src', '/win/address?id=' + id);
        \$('#address').window('open');
    })

    \$('#deliver-show').click(function () {
        if (exchange != 0) \$('#deliver-info').prop('src', '/win/deliver?id=' + id + '&exchange=' + exchange + '&type=special');
        else \$('#deliver-info').prop('src', '/win/deliver?id=' + id + '&type=special');
        \$('#deliver').window('open');
    })

    //    \$('#send-show').click(function () {
    //        if (exchange != 0) \$('#send-info').prop('src', '/win/send?id=' + id + '&exchange=' + exchange);
    //        else \$('#send-info').prop('src', '/win/send?id=' + id);
    //        \$('#send').window('open');
    //    })
    function deliver() {
        var id = \"";
        // line 144
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["detail"]) ? $context["detail"] : null), "id", array()), "html", null, true);
        echo "\";
        \$.post('/pkorder/deliver', {'id': id}, function (data) {
            //data = eval('(' + data + ')');
            if (data.error == 0) {
                alert(data.message)
                //    \$.messager.alert('成功', data.message);
                // setTimeout(function(){window.parent.window.load();window.parent.window.reloadgrid();}, 2000);
            } else {
                alert(data.message)
                //    \$.messager.alert(data.message);
                return false;
            }
        })
    }
    \$('.savedesc').click(function () {
        var desc = \$('.in_desc').val();
        var id = \"";
        // line 160
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["detail"]) ? $context["detail"] : null), "id", array()), "html", null, true);
        echo "\";
        \$.post('/pkorder/save-desc', {'id': id, 'desc': desc}, function (data) {
            alert(data.message);
            if (data.error == 0) {
                location.reload();
            }
        })
    })
    function refuse() {
        var id = \"";
        // line 169
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["detail"]) ? $context["detail"] : null), "id", array()), "html", null, true);
        echo "\";
        \$.post('/pkorder/refuse', {'id': id}, function (data) {
            alert(data.message);
            if (data.error == 0) {
                location.reload();
            }
        })
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
        return array (  319 => 169,  307 => 160,  288 => 144,  266 => 125,  262 => 124,  258 => 123,  255 => 122,  252 => 121,  244 => 116,  242 => 115,  237 => 112,  226 => 110,  222 => 109,  207 => 101,  203 => 100,  199 => 99,  193 => 96,  189 => 95,  185 => 94,  181 => 93,  177 => 92,  168 => 86,  164 => 85,  160 => 84,  149 => 76,  140 => 70,  136 => 69,  132 => 68,  124 => 67,  120 => 66,  116 => 65,  112 => 64,  108 => 63,  104 => 62,  80 => 45,  76 => 43,  73 => 42,  33 => 4,  30 => 3,  11 => 1,);
    }
}
/* {% extends '@app/views/base.html' %}*/
/* */
/* {% block css %}*/
/* <style>*/
/*     td {*/
/*         border: 1px solid #C1DAD7;*/
/*         background: #fff;*/
/*         font-size: 11px;*/
/*         padding: 6px 6px 6px 12px;*/
/*         color: #4f6b72;*/
/*     }*/
/* */
/*     td label {*/
/*         background-color: #dddddd;*/
/*         width: 100px;*/
/*         height: 35px;*/
/*         border-collapse: collapse;*/
/*     }*/
/* */
/*     td .alt {*/
/*         background: #F5FAFA;*/
/*         color: #797268;*/
/*     }*/
/* */
/*     .box span {*/
/*         font-size: 12px;*/
/*         padding: 6px 6px 6px 12px;*/
/*         color: #4f6b72;*/
/*     }*/
/* */
/*     .good {*/
/*         border-collapse: collapse;*/
/*     }*/
/* */
/*     .panel-body div {*/
/*         padding: 10px 0;*/
/*     }*/
/* */
/* </style>*/
/* {% endblock %}*/
/* */
/* {% block main %}*/
/* <div title="Basic Window" style="padding:5px;height:auto" class="box">*/
/*     <div style="padding: 10px 0;">*/
/*         <span>订单状态：{{detail.status_name}}</span><span>订单编号：{{ detail.id }}</span><span>订单生成时间：{{ detail.create_time|date('Y-m-d H:i:s') }}</span>*/
/*     </div>*/
/* */
/*     <table class="good">*/
/*         <tr>*/
/*             <td>商品名称</td>*/
/*             <td>商品面额</td>*/
/*             <td>商品编码</td>*/
/*             <td>商品品牌</td>*/
/*             <td>伙购价</td>*/
/*             <td>购买大小</td>*/
/*             <td>当前期号</td>*/
/*             <td>是否是虚拟商品</td>*/
/*             <td>发货方式</td>*/
/*         </tr>*/
/* */
/*         <tr>*/
/*             <td>{{goodInfo.name}}</td>*/
/*             <td>{{goodInfo.face_value}}</td>*/
/*             <td>{{ goodInfo.bn }}</td>*/
/*             <td>{{ goodInfo.brand_id }}</td>*/
/*             <td>￥{{ goodInfo.price }}</td>*/
/*             <td> {% if detail.size==1 %} 大 {% else %}小{% endif %}</td>*/
/*             <td>{{ periodinfo.period_no}}</td>*/
/*             <td>{{ goodInfo.is_virtual}}</td>*/
/*             <td>{{ goodInfo.delivery_id}}</td>*/
/*         </tr>*/
/*     </table>*/
/* */
/*     <table style="display: block" cellpadding="5">*/
/*         <tr>*/
/*             <td><label>订单号：</label>{{ detail.id }}</td>*/
/*             <td></td>*/
/*             <td></td>*/
/*             <td></td>*/
/*             <td></td>*/
/*         </tr>*/
/* */
/*         <tr>*/
/*             <td>商品分类：{{cat_name}}</td>*/
/*             <td>发货方式：{{ goodInfo.delivery_id}}</td>*/
/*             <td>商品价格：￥{{ goodInfo.price }}</td>*/
/*             <td></td>*/
/*             <td></td>*/
/* */
/*         </tr>*/
/*         <tr>*/
/*             <td>中奖码：{{ periodinfo.lucky_code}}</td>*/
/*             <td>会员：{{ detail.user_id.username }}</td>*/
/*             <td>桌号：{{ detail.desk_id }}</td>*/
/*             <td>期数：{{ detail.period_id }}</td>*/
/*             <td>开奖时间：{{ periodinfo.end_time | date('Y-m-d H:i:s')}}</td>*/
/*         </tr>*/
/*         <tr>*/
/*             <td>会员手机号：{{ user.phone}}</td>*/
/*             <td>会员邮箱：{{ user.email}}</td>*/
/*             <td>平台:{% if user.from==1 %} 伙购平台 {% else %}滴滴平台{% endif %}</td>*/
/*             <td></td>*/
/*             <td></td>*/
/*         </tr>*/
/*     </table>*/
/* </div>*/
/* <br/>*/
/* <div class="desc">*/
/*     {% for key,item in desc %}*/
/*     {{item.desc}}----{{item.time}} <br>*/
/*     {% endfor %}*/
/*     <textarea class="in_desc"></textarea>*/
/* </div>*/
/* <div><input type="button" class="savedesc" value="保存备注"></div>*/
/* {% if(detail.status == 3 and detail.confirm == 1) %}*/
/* <a href="javascript:void(0)" class="easyui-linkbutton get-status" data-id="all" id="send-show"*/
/*    onclick="deliver()">发货</a>*/
/* <a href="javascript:void(0)" class="easyui-linkbutton get-status" data-id="all" onclick="refuse()">驳回</a>*/
/* {% endif %}*/
/* {% endblock %}*/
/* {% block script %}*/
/* <script>*/
/*     var status = "{{ detail.status }}";*/
/*     var id = "{{ detail.id }}";*/
/*     var exchange = "{{ detail.is_exchange }}";*/
/* */
/*     $('#address-show').click(function () {*/
/*         $('#address-info').prop('src', '/win/address?id=' + id);*/
/*         $('#address').window('open');*/
/*     })*/
/* */
/*     $('#deliver-show').click(function () {*/
/*         if (exchange != 0) $('#deliver-info').prop('src', '/win/deliver?id=' + id + '&exchange=' + exchange + '&type=special');*/
/*         else $('#deliver-info').prop('src', '/win/deliver?id=' + id + '&type=special');*/
/*         $('#deliver').window('open');*/
/*     })*/
/* */
/*     //    $('#send-show').click(function () {*/
/*     //        if (exchange != 0) $('#send-info').prop('src', '/win/send?id=' + id + '&exchange=' + exchange);*/
/*     //        else $('#send-info').prop('src', '/win/send?id=' + id);*/
/*     //        $('#send').window('open');*/
/*     //    })*/
/*     function deliver() {*/
/*         var id = "{{detail.id}}";*/
/*         $.post('/pkorder/deliver', {'id': id}, function (data) {*/
/*             //data = eval('(' + data + ')');*/
/*             if (data.error == 0) {*/
/*                 alert(data.message)*/
/*                 //    $.messager.alert('成功', data.message);*/
/*                 // setTimeout(function(){window.parent.window.load();window.parent.window.reloadgrid();}, 2000);*/
/*             } else {*/
/*                 alert(data.message)*/
/*                 //    $.messager.alert(data.message);*/
/*                 return false;*/
/*             }*/
/*         })*/
/*     }*/
/*     $('.savedesc').click(function () {*/
/*         var desc = $('.in_desc').val();*/
/*         var id = "{{detail.id}}";*/
/*         $.post('/pkorder/save-desc', {'id': id, 'desc': desc}, function (data) {*/
/*             alert(data.message);*/
/*             if (data.error == 0) {*/
/*                 location.reload();*/
/*             }*/
/*         })*/
/*     })*/
/*     function refuse() {*/
/*         var id = "{{detail.id}}";*/
/*         $.post('/pkorder/refuse', {'id': id}, function (data) {*/
/*             alert(data.message);*/
/*             if (data.error == 0) {*/
/*                 location.reload();*/
/*             }*/
/*         })*/
/*     }*/
/* */
/* </script>*/
/* */
/* {% endblock %}*/
