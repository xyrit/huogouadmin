<?php

/* app-push.html */
class __TwigTemplate_cfa3f1001009400f1fff94b11eea5c1ea199e330a09299e4c170de028ce35a32 extends yii\twig\Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("@app/views/base.html", "app-push.html", 1);
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
        echo "<div>
    ";
        // line 5
        echo $this->getAttribute((isset($context["html"]) ? $context["html"] : null), "beginForm", array(0 => "", 1 => "post", 2 => array("class" => "am-form am-form-horizontal", "id" => "submitForm", "enctype" => "multipart/form-data")), "method");
        echo "
    <table cellpadding=\"5\">
        <table cellpadding=\"5\">
            <tr>
                <td>站点</td>
                <td>
                    <select  name=\"from\">
                        <option value=\"1\" >伙购网</option>
                        <option value=\"2\" >滴滴夺宝</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>通知标题:</td>
                <td><input class=\"easyui-textbox\" type=\"text\" name=\"title\" data-options=\"required:true\"></td>
            </tr>
            <tr>
                <td>通知内容:</td>
                <td><input class=\"easyui-textbox\" type=\"text\" name=\"content\"  ></td>
            </tr>
            <tr>
                <td>后续动作:</td>
                <td>
                    <select name=\"msg_do\" id=\"msg_do\">
                        <option value=\"\">启动app</option>
                        <option value=\"product\">打开商品页面</option>
                        <option value=\"search\">打开搜索页</option>
                        <option value=\"app\">下载app</option>
                        <option value=\"url\">打开链接</option>
                    </select>
                </td>
            </tr>
            <tr id=\"productId\" style=\"display: none;\">
                <td>商品ID:</td>
                <td>
                    <input type=\"text\" name=\"productId\">
                </td>
            </tr>
            <tr>
                <td>提醒方式:</td>
                <td>
                    <input type=\"checkbox\" name=\"remindType[]\" value=\"isRing\" >通知响铃
                    <input type=\"checkbox\" name=\"remindType[]\" value=\"isVibrate\" >通知震动
                    <input type=\"checkbox\" name=\"remindType[]\" value=\"isClearable\" checked>是否可擦除
                </td>
            </tr>
            <tr>
                <td>目标平台:</td>
                <td>
                    <input type=\"checkbox\" name=\"os[]\" value=\"3\" checked>IOS
                    <input type=\"checkbox\" name=\"os[]\" value=\"4\" checked>Android
                </td>
            </tr>
        </table>
    </table>
    ";
        // line 60
        echo $this->getAttribute((isset($context["html"]) ? $context["html"] : null), "endForm", array(), "method");
        echo "
    <div style=\"padding:5px\">
        <a href=\"javascript:void(0)\" class=\"easyui-linkbutton\" onclick=\"submitForm()\">提交</a>
    </div>
</div>
";
    }

    // line 67
    public function block_js($context, array $blocks = array())
    {
        // line 68
        echo "<script>
\$(function() {
    \$('#msg_do').change(function() {
        var msg_do = \$(this).val();
        if (msg_do=='product') {
            \$('#productId').show();
        } else {

            \$('#productId').hide();
        }
    });
});

    function  submitForm()
    {
        \$('#submitForm').submit();
    }
</script>
";
    }

    public function getTemplateName()
    {
        return "app-push.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  106 => 68,  103 => 67,  93 => 60,  35 => 5,  32 => 4,  29 => 3,  11 => 1,);
    }
}
/* {% extends '@app/views/base.html' %}*/
/* */
/* {% block main %}*/
/* <div>*/
/*     {{ html.beginForm('', 'post', {'class':'am-form am-form-horizontal', 'id':'submitForm', 'enctype':"multipart/form-data"}) | raw }}*/
/*     <table cellpadding="5">*/
/*         <table cellpadding="5">*/
/*             <tr>*/
/*                 <td>站点</td>*/
/*                 <td>*/
/*                     <select  name="from">*/
/*                         <option value="1" >伙购网</option>*/
/*                         <option value="2" >滴滴夺宝</option>*/
/*                     </select>*/
/*                 </td>*/
/*             </tr>*/
/*             <tr>*/
/*                 <td>通知标题:</td>*/
/*                 <td><input class="easyui-textbox" type="text" name="title" data-options="required:true"></td>*/
/*             </tr>*/
/*             <tr>*/
/*                 <td>通知内容:</td>*/
/*                 <td><input class="easyui-textbox" type="text" name="content"  ></td>*/
/*             </tr>*/
/*             <tr>*/
/*                 <td>后续动作:</td>*/
/*                 <td>*/
/*                     <select name="msg_do" id="msg_do">*/
/*                         <option value="">启动app</option>*/
/*                         <option value="product">打开商品页面</option>*/
/*                         <option value="search">打开搜索页</option>*/
/*                         <option value="app">下载app</option>*/
/*                         <option value="url">打开链接</option>*/
/*                     </select>*/
/*                 </td>*/
/*             </tr>*/
/*             <tr id="productId" style="display: none;">*/
/*                 <td>商品ID:</td>*/
/*                 <td>*/
/*                     <input type="text" name="productId">*/
/*                 </td>*/
/*             </tr>*/
/*             <tr>*/
/*                 <td>提醒方式:</td>*/
/*                 <td>*/
/*                     <input type="checkbox" name="remindType[]" value="isRing" >通知响铃*/
/*                     <input type="checkbox" name="remindType[]" value="isVibrate" >通知震动*/
/*                     <input type="checkbox" name="remindType[]" value="isClearable" checked>是否可擦除*/
/*                 </td>*/
/*             </tr>*/
/*             <tr>*/
/*                 <td>目标平台:</td>*/
/*                 <td>*/
/*                     <input type="checkbox" name="os[]" value="3" checked>IOS*/
/*                     <input type="checkbox" name="os[]" value="4" checked>Android*/
/*                 </td>*/
/*             </tr>*/
/*         </table>*/
/*     </table>*/
/*     {{ html.endForm() | raw }}*/
/*     <div style="padding:5px">*/
/*         <a href="javascript:void(0)" class="easyui-linkbutton" onclick="submitForm()">提交</a>*/
/*     </div>*/
/* </div>*/
/* {% endblock %}*/
/* */
/* {% block js %}*/
/* <script>*/
/* $(function() {*/
/*     $('#msg_do').change(function() {*/
/*         var msg_do = $(this).val();*/
/*         if (msg_do=='product') {*/
/*             $('#productId').show();*/
/*         } else {*/
/* */
/*             $('#productId').hide();*/
/*         }*/
/*     });*/
/* });*/
/* */
/*     function  submitForm()*/
/*     {*/
/*         $('#submitForm').submit();*/
/*     }*/
/* </script>*/
/* {% endblock %}*/
