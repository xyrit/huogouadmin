<?php

/* edit-image.html */
class __TwigTemplate_1efa53f94e6ddbd5beeee1fa61fe1f64a21e37b6d86faad922c75ed290d148b7 extends yii\twig\Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("@app/views/base.html", "edit-image.html", 1);
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
                        <select id=\"image-from\" name=\"from\">
                            <option value=\"1\" ";
        // line 12
        if (($this->getAttribute((isset($context["model"]) ? $context["model"] : null), "from", array()) == "1")) {
            echo "selected";
        }
        echo ">伙购网</option>
                            <option value=\"2\" ";
        // line 13
        if (($this->getAttribute((isset($context["model"]) ? $context["model"] : null), "from", array()) == "2")) {
            echo "selected";
        }
        echo ">滴滴夺宝</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>图片:</td>
                    <td><input class=\"easyui-filebox\" name=\"picture\" data-options=\"prompt:'选择图片'\"><img src=\"";
        // line 19
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["model"]) ? $context["model"] : null), "content", array()), "image_src", array()), "html", null, true);
        echo "\" width=\"40\" height=\"40\"></td>
                </tr>
                <tr>
                    <td>图片链接:</td>
                    <td><input class=\"easyui-textbox\" type=\"text\" name=\"content[image_link]\" value=\"";
        // line 23
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["model"]) ? $context["model"] : null), "content", array()), "image_link", array()), "html", null, true);
        echo "\"></td>
                </tr>
                <tr>
                    <td>文件描述:</td>
                    <td><input class=\"easyui-textbox\" type=\"text\" name=\"content[image_title]\"  data-options=\"required:true\" value=\"";
        // line 27
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["model"]) ? $context["model"] : null), "content", array()), "image_title", array()), "html", null, true);
        echo "\"></td>
                </tr>
                <tr>
                    <td>开始时间:</td>
                    <td><input class=\"easyui-datetimebox\" type=\"text\" name=\"content[start_time]\" value=\"";
        // line 31
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["model"]) ? $context["model"] : null), "content", array()), "start_time", array()), "html", null, true);
        echo "\"></td>
                </tr>
                <tr>
                    <td>结束时间:</td>
                    <td><input class=\"easyui-datetimebox\" type=\"text\" name=\"content[end_time]\" value=\"";
        // line 35
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["model"]) ? $context["model"] : null), "content", array()), "end_time", array()), "html", null, true);
        echo "\"></td>
                </tr>
                <tr>
                    <td>系统:</td>
                    <td><input type=\"radio\" name=\"system\" value=\"android\" ";
        // line 39
        if (($this->getAttribute((isset($context["model"]) ? $context["model"] : null), "system", array()) == "android")) {
            echo "checked";
        }
        echo ">Android<input type=\"radio\" name=\"system\" value=\"ios\" ";
        if (($this->getAttribute((isset($context["model"]) ? $context["model"] : null), "system", array()) == "ios")) {
            echo "checked";
        }
        echo ">Ios</td>
                </tr>
                <tr>
                    <td>是否启用:</td>
                    <td><input type=\"checkbox\" name=\"status\" value=\"1\"  ";
        // line 43
        if (($this->getAttribute((isset($context["model"]) ? $context["model"] : null), "status", array()) == "1")) {
            echo "checked";
        }
        echo "></td>
                </tr>
            </table>
        </table>
    ";
        // line 47
        echo $this->getAttribute((isset($context["html"]) ? $context["html"] : null), "endForm", array(), "method");
        echo "
    <div style=\"text-align:center;padding:5px\">
        <a href=\"javascript:void(0)\" class=\"easyui-linkbutton\" onclick=\"submitForm()\">提交</a>
    </div>
</div>
";
    }

    // line 54
    public function block_js($context, array $blocks = array())
    {
        // line 55
        echo "<script>
    function submitForm()
    {
        \$('#submitForm').form({
            url: '/app/edit?type=image&id='+\"";
        // line 59
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["model"]) ? $context["model"] : null), "id", array()), "html", null, true);
        echo "\",
            onSubmit: function(param){
                var isValid = \$(this).form('validate');
                if (!isValid){
                    \$.messager.progress('close');\t// 如果表单是无效的则隐藏进度条
                }
                return isValid;\t// 返回false终止表单提交
            },
            success: function (data) {
                data = eval('(' + data + ')');
                if (data.error == 0) {
                    \$.messager.alert('成功', data.message);
                    setTimeout(function(){parent.location.reload()}, 2000);
                } else {
                    \$.messager.alert('失败', data.message);
                    return false;
                }
            }
        });
        \$('#submitForm').submit();
    }
</script>
";
    }

    public function getTemplateName()
    {
        return "edit-image.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  138 => 59,  132 => 55,  129 => 54,  119 => 47,  110 => 43,  97 => 39,  90 => 35,  83 => 31,  76 => 27,  69 => 23,  62 => 19,  51 => 13,  45 => 12,  35 => 5,  32 => 4,  29 => 3,  11 => 1,);
    }
}
/* {% extends '@app/views/base.html' %}*/
/* */
/* {% block main %}*/
/* <div>*/
/*     {{ html.beginForm('', 'post', {'class':'am-form am-form-horizontal', 'id':'submitForm', 'enctype':"multipart/form-data"}) | raw }}*/
/*         <table cellpadding="5">*/
/*             <table cellpadding="5">*/
/*                 <tr>*/
/*                     <td>站点</td>*/
/*                     <td>*/
/*                         <select id="image-from" name="from">*/
/*                             <option value="1" {% if model.from=="1" %}selected{% endif %}>伙购网</option>*/
/*                             <option value="2" {% if model.from=="2" %}selected{% endif %}>滴滴夺宝</option>*/
/*                         </select>*/
/*                     </td>*/
/*                 </tr>*/
/*                 <tr>*/
/*                     <td>图片:</td>*/
/*                     <td><input class="easyui-filebox" name="picture" data-options="prompt:'选择图片'"><img src="{{ model.content.image_src }}" width="40" height="40"></td>*/
/*                 </tr>*/
/*                 <tr>*/
/*                     <td>图片链接:</td>*/
/*                     <td><input class="easyui-textbox" type="text" name="content[image_link]" value="{{ model.content.image_link }}"></td>*/
/*                 </tr>*/
/*                 <tr>*/
/*                     <td>文件描述:</td>*/
/*                     <td><input class="easyui-textbox" type="text" name="content[image_title]"  data-options="required:true" value="{{ model.content.image_title }}"></td>*/
/*                 </tr>*/
/*                 <tr>*/
/*                     <td>开始时间:</td>*/
/*                     <td><input class="easyui-datetimebox" type="text" name="content[start_time]" value="{{ model.content.start_time }}"></td>*/
/*                 </tr>*/
/*                 <tr>*/
/*                     <td>结束时间:</td>*/
/*                     <td><input class="easyui-datetimebox" type="text" name="content[end_time]" value="{{ model.content.end_time }}"></td>*/
/*                 </tr>*/
/*                 <tr>*/
/*                     <td>系统:</td>*/
/*                     <td><input type="radio" name="system" value="android" {% if(model.system == 'android') %}checked{% endif %}>Android<input type="radio" name="system" value="ios" {% if(model.system == 'ios') %}checked{% endif %}>Ios</td>*/
/*                 </tr>*/
/*                 <tr>*/
/*                     <td>是否启用:</td>*/
/*                     <td><input type="checkbox" name="status" value="1"  {% if(model.status == '1') %}checked{% endif %}></td>*/
/*                 </tr>*/
/*             </table>*/
/*         </table>*/
/*     {{ html.endForm() | raw }}*/
/*     <div style="text-align:center;padding:5px">*/
/*         <a href="javascript:void(0)" class="easyui-linkbutton" onclick="submitForm()">提交</a>*/
/*     </div>*/
/* </div>*/
/* {% endblock %}*/
/* */
/* {% block js %}*/
/* <script>*/
/*     function submitForm()*/
/*     {*/
/*         $('#submitForm').form({*/
/*             url: '/app/edit?type=image&id='+"{{ model.id }}",*/
/*             onSubmit: function(param){*/
/*                 var isValid = $(this).form('validate');*/
/*                 if (!isValid){*/
/*                     $.messager.progress('close');	// 如果表单是无效的则隐藏进度条*/
/*                 }*/
/*                 return isValid;	// 返回false终止表单提交*/
/*             },*/
/*             success: function (data) {*/
/*                 data = eval('(' + data + ')');*/
/*                 if (data.error == 0) {*/
/*                     $.messager.alert('成功', data.message);*/
/*                     setTimeout(function(){parent.location.reload()}, 2000);*/
/*                 } else {*/
/*                     $.messager.alert('失败', data.message);*/
/*                     return false;*/
/*                 }*/
/*             }*/
/*         });*/
/*         $('#submitForm').submit();*/
/*     }*/
/* </script>*/
/* {% endblock %}*/
