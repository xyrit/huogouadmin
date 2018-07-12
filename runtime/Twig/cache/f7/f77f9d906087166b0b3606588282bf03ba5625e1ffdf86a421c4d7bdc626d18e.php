<?php

/* edit-public_notice.html */
class __TwigTemplate_344eb4752323f6eb36aeabbd8a8eacff4f2a1302187c3d4301c0b846e8a4cbca extends yii\twig\Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("@app/views/base.html", "edit-public_notice.html", 1);
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
        echo "
<form id=\"public_notice\" method=\"post\">
    <table cellpadding=\"5\">
        <tr>
            <td>站点</td>
            <td>
                <select id=\"image-from\" name=\"from\">
                    <option value=\"1\" ";
        // line 11
        if (($this->getAttribute((isset($context["model"]) ? $context["model"] : null), "from", array()) == "1")) {
            echo "selected";
        }
        echo ">伙购网</option>
                    <option value=\"2\" ";
        // line 12
        if (($this->getAttribute((isset($context["model"]) ? $context["model"] : null), "from", array()) == "2")) {
            echo "selected";
        }
        echo ">滴滴夺宝</option>
                </select>
            </td>
        </tr>
        <tr>
            <td>标题:</td>
            <td><input class=\"easyui-textbox\" type=\"text\" name=\"content[notice_title]\" value=\"";
        // line 18
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["model"]) ? $context["model"] : null), "content", array()), "notice_title", array()), "html", null, true);
        echo "\" data-options=\"required:true,width:200\"></td>
        </tr>
        <tr>
            <td>简介:</td>
            <td><input class=\"easyui-textbox\" type=\"text\" name=\"content[notice_desc]\" value=\"";
        // line 22
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["model"]) ? $context["model"] : null), "content", array()), "notice_desc", array()), "html", null, true);
        echo "\" data-options=\"required:true,width:400\"></td>
        </tr>
        <tr>
            <td>图标:</td>
            <td><input class=\"easyui-textbox\" type=\"text\" name=\"content[notice_icon]\"  value=\"";
        // line 26
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["model"]) ? $context["model"] : null), "content", array()), "notice_icon", array()), "html", null, true);
        echo "\" data-options=\"required:true,width:200\"></td>
        </tr>
        <tr>
            <td>类型:</td>
            <td>
                <select name=\"content[notice_type]\" data-options=\"required:true\" id=\"noticeType\">
                    <option value=\"default\" ";
        // line 32
        if (($this->getAttribute($this->getAttribute((isset($context["model"]) ? $context["model"] : null), "content", array()), "notice_type", array()) == "default")) {
            echo "selected";
        }
        echo ">默认</option>
                    <option value=\"link\" ";
        // line 33
        if (($this->getAttribute($this->getAttribute((isset($context["model"]) ? $context["model"] : null), "content", array()), "notice_type", array()) == "link")) {
            echo "selected";
        }
        echo ">打开链接</option>
                </select>
                <input type=\"text\" name=\"content[notice_link]\" style=\"display: none;width: 300px;\" value=\"";
        // line 35
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["model"]) ? $context["model"] : null), "content", array()), "notice_link", array()), "html", null, true);
        echo "\">
            </td>
        </tr>
        <tr id=\"notice_content\">
            <td>内容:</td>
            <td>
                <textarea name=\"content[notice_content]\" style=\"width: 400px;height: 300px;\">";
        // line 41
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["model"]) ? $context["model"] : null), "content", array()), "notice_content", array()), "html", null, true);
        echo "</textarea>
            </td>
        </tr>
        <tr>
            <td>时间:</td>
            <td><input class=\"easyui-datetimebox\" type=\"text\" name=\"content[notice_time]\" value=\"";
        // line 46
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["model"]) ? $context["model"] : null), "content", array()), "notice_time", array()), "html", null, true);
        echo "\"  data-options=\"required:true\" /></td>
        </tr>
        <tr>
            <td>是否显示:</td>
            <td><input type=\"checkbox\" name=\"status\" value=\"1\" ";
        // line 50
        if (($this->getAttribute((isset($context["model"]) ? $context["model"] : null), "status", array()) == "1")) {
            echo "checked";
        }
        echo "></td>
        </tr>
    </table>
</form>
<div style=\"text-align:center;padding:5px\">
    <a href=\"javascript:void(0)\" class=\"easyui-linkbutton\" onclick=\"submitForm()\">提交</a>
</div>
";
    }

    // line 59
    public function block_js($context, array $blocks = array())
    {
        // line 60
        echo "<script>

    \$(function() {
        selectNoticeTypeSel('";
        // line 63
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["model"]) ? $context["model"] : null), "content", array()), "notice_type", array()), "html", null, true);
        echo "');
    });

    var selectNoticeTypeSel = function(noticeType) {
        if (noticeType=='default') {
            \$('input[name=\"content[notice_link]\"]').hide();
            \$('#notice_content').show()
        } else if (noticeType=='link') {
            \$('input[name=\"content[notice_link]\"]').show();
            \$('#notice_content').hide()
        }
    }
    var noticeTypeSel = \$('#noticeType').combobox({
        onSelect:function(record){
            if (record.value=='default') {
                \$('input[name=\"content[notice_link]\"]').hide();
                \$('#notice_content').show()
            } else if (record.value=='link') {
                \$('input[name=\"content[notice_link]\"]').show();
                \$('#notice_content').hide()
            }
        }
    });

    function submitForm()
    {
        \$('#public_notice').form({
            url: '/app/edit?type=public_notice&id='+\"";
        // line 90
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
        \$('#public_notice').submit();
    }
</script>
";
    }

    public function getTemplateName()
    {
        return "edit-public_notice.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  170 => 90,  140 => 63,  135 => 60,  132 => 59,  118 => 50,  111 => 46,  103 => 41,  94 => 35,  87 => 33,  81 => 32,  72 => 26,  65 => 22,  58 => 18,  47 => 12,  41 => 11,  32 => 4,  29 => 3,  11 => 1,);
    }
}
/* {% extends '@app/views/base.html' %}*/
/* */
/* {% block main %}*/
/* */
/* <form id="public_notice" method="post">*/
/*     <table cellpadding="5">*/
/*         <tr>*/
/*             <td>站点</td>*/
/*             <td>*/
/*                 <select id="image-from" name="from">*/
/*                     <option value="1" {% if model.from=="1" %}selected{% endif %}>伙购网</option>*/
/*                     <option value="2" {% if model.from=="2" %}selected{% endif %}>滴滴夺宝</option>*/
/*                 </select>*/
/*             </td>*/
/*         </tr>*/
/*         <tr>*/
/*             <td>标题:</td>*/
/*             <td><input class="easyui-textbox" type="text" name="content[notice_title]" value="{{ model.content.notice_title }}" data-options="required:true,width:200"></td>*/
/*         </tr>*/
/*         <tr>*/
/*             <td>简介:</td>*/
/*             <td><input class="easyui-textbox" type="text" name="content[notice_desc]" value="{{ model.content.notice_desc }}" data-options="required:true,width:400"></td>*/
/*         </tr>*/
/*         <tr>*/
/*             <td>图标:</td>*/
/*             <td><input class="easyui-textbox" type="text" name="content[notice_icon]"  value="{{ model.content.notice_icon }}" data-options="required:true,width:200"></td>*/
/*         </tr>*/
/*         <tr>*/
/*             <td>类型:</td>*/
/*             <td>*/
/*                 <select name="content[notice_type]" data-options="required:true" id="noticeType">*/
/*                     <option value="default" {% if(model.content.notice_type == 'default') %}selected{% endif %}>默认</option>*/
/*                     <option value="link" {% if(model.content.notice_type == 'link') %}selected{% endif %}>打开链接</option>*/
/*                 </select>*/
/*                 <input type="text" name="content[notice_link]" style="display: none;width: 300px;" value="{{ model.content.notice_link }}">*/
/*             </td>*/
/*         </tr>*/
/*         <tr id="notice_content">*/
/*             <td>内容:</td>*/
/*             <td>*/
/*                 <textarea name="content[notice_content]" style="width: 400px;height: 300px;">{{ model.content.notice_content }}</textarea>*/
/*             </td>*/
/*         </tr>*/
/*         <tr>*/
/*             <td>时间:</td>*/
/*             <td><input class="easyui-datetimebox" type="text" name="content[notice_time]" value="{{ model.content.notice_time }}"  data-options="required:true" /></td>*/
/*         </tr>*/
/*         <tr>*/
/*             <td>是否显示:</td>*/
/*             <td><input type="checkbox" name="status" value="1" {% if(model.status == '1') %}checked{% endif %}></td>*/
/*         </tr>*/
/*     </table>*/
/* </form>*/
/* <div style="text-align:center;padding:5px">*/
/*     <a href="javascript:void(0)" class="easyui-linkbutton" onclick="submitForm()">提交</a>*/
/* </div>*/
/* {% endblock %}*/
/* */
/* {% block js %}*/
/* <script>*/
/* */
/*     $(function() {*/
/*         selectNoticeTypeSel('{{model.content.notice_type}}');*/
/*     });*/
/* */
/*     var selectNoticeTypeSel = function(noticeType) {*/
/*         if (noticeType=='default') {*/
/*             $('input[name="content[notice_link]"]').hide();*/
/*             $('#notice_content').show()*/
/*         } else if (noticeType=='link') {*/
/*             $('input[name="content[notice_link]"]').show();*/
/*             $('#notice_content').hide()*/
/*         }*/
/*     }*/
/*     var noticeTypeSel = $('#noticeType').combobox({*/
/*         onSelect:function(record){*/
/*             if (record.value=='default') {*/
/*                 $('input[name="content[notice_link]"]').hide();*/
/*                 $('#notice_content').show()*/
/*             } else if (record.value=='link') {*/
/*                 $('input[name="content[notice_link]"]').show();*/
/*                 $('#notice_content').hide()*/
/*             }*/
/*         }*/
/*     });*/
/* */
/*     function submitForm()*/
/*     {*/
/*         $('#public_notice').form({*/
/*             url: '/app/edit?type=public_notice&id='+"{{ model.id }}",*/
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
/*         $('#public_notice').submit();*/
/*     }*/
/* </script>*/
/* {% endblock %}*/
