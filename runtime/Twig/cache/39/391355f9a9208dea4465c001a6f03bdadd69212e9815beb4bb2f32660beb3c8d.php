<?php

/* topic-edit.html */
class __TwigTemplate_2db40daf15f7feca903b44bfc24b13b2fc79806f2d567a74bbe0444f3790adc0 extends yii\twig\Template
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

<table cellpadding=\"5\">
    <tr>
        <td>话题标题</td>
        <td><input type=\"text\" name=\"subject\" value=\"";
        // line 11
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["model"]) ? $context["model"] : null), "subject", array()), "html", null, true);
        echo "\" style=\"width: 650px;\"></td>
    </tr>
    <tr>
        <td>话题内容</td>
        <td><textarea id=\"product-intro\">";
        // line 15
        echo twig_escape_filter($this->env, (isset($context["message"]) ? $context["message"] : null), "html", null, true);
        echo "</textarea></td>
    </tr>
    <tr>
        <td>是否加精</td>
        <td>
            <select class=\"easyui-combobox\" id=\"digest\" data-options=\"panelHeight:'auto',editable:false\" style=\"width:80px;\">
                <option value=\"0\">否</option>
                <option value=\"1\">是</option>
            </select>
        </td>
    </tr>
    <tr>
        <td>是否置顶</td>
        <td><select class=\"easyui-combobox\" id=\"top\" data-options=\"panelHeight:'auto',editable:false\" style=\"width:80px;\">
            <option value=\"0\">否</option>
            <option value=\"1\">是</option>
        </select></td>
    </tr>
    <tr>
        <td></td>
        <td><input type=\"button\" onclick=\"sub()\" value=\"提交\"></td>
    </tr>
</table>

<script charset=\"utf-8\" src=\"";
        // line 39
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "params", array()), "skinUrl", array()), "html", null, true);
        echo "/js/kindeditor-4.1.10/kindeditor-all-min.js\"></script>
<script>
    \$(function(){
        var editor;
        KindEditor.ready(function(K) {
            editor = K.create('#product-intro', {
                resizeType : 2,
                allowPreviewEmoticons : false,
                allowImageUpload : true,
                minHeight: 400,
                uploadJson : '/group/upload-topic-img',
                items : [
                    'emoticons','fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold', 'italic', 'underline',
                    'removeformat', '|', 'justifyleft', 'justifycenter', 'justifyright', 'insertorderedlist',
                    'insertunorderedlist', '|',  'multiimage', 'link', 'fullscreen'
                ]
            });
            editor.clickToolbar('fullscreen', function() {
                \$('body').css({
                    'height' : '100%',
                });
            });
        });

        var digest = \"";
        // line 63
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["model"]) ? $context["model"] : null), "is_digest", array()), "html", null, true);
        echo "\";
        var top = \"";
        // line 64
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["model"]) ? $context["model"] : null), "is_top", array()), "html", null, true);
        echo "\";
        \$('#top').combobox('setValue', top);
        \$('#digest').combobox('setValue', digest);
    })

    function sub(){
        var id = \"";
        // line 70
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["model"]) ? $context["model"] : null), "id", array()), "html", null, true);
        echo "\"
        var content = \$(document.getElementsByTagName('iframe')[0].contentWindow.document.body).html();
        var title = \$('input[name=subject]').val();
        var fil = filterContent(content);
        var top = \$('#top').combobox('getValue');
        var digest = \$('#digest').combobox('getValue');

        \$.post(\"";
        // line 77
        echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url("/group/topic-edit"), "html", null, true);
        echo "\", {'id':id, 'subject':title, 'content':fil, 'digest':digest, 'top':top}, function(data){
            if(data == 1){
                \$.messager.alert('成功', '修改成功');
                setTimeout(function(){location.reload();parent.location.reload()}, 2000);
            }else{
                \$.messager.alert('成功', '修改失败');
                return;
            }
        })
    }

    function filterContent(content){
        var con = content.replace(/<img[^>]*src=\\\"[\\w:\\.\\/-]+\\/([\\d]{1,2})\\.gif\\\"[^>]*>/ig, \"[s:\$1]\").replace(/<img[^>]*src=[\\'\\\"\\s]?([\\w:\\.\\/]+([\\d]{17}\\.(jpg|gif))[\\s\\'\\\"]+)[^>]*>/ig, \"[img]\$2[/img]\").replace(/<a[^>]*href=[\\'\\\"\\s]?([^\\s\\'\\\"]*)[^>]*>(.+?)<\\/a>/ig, \"[url=\$1]\$2[/url]\");

        return con;
    }
</script>";
    }

    public function getTemplateName()
    {
        return "topic-edit.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  129 => 77,  119 => 70,  110 => 64,  106 => 63,  79 => 39,  52 => 15,  45 => 11,  37 => 6,  33 => 5,  29 => 4,  24 => 2,  19 => 1,);
    }
}
/* <link rel="stylesheet" type="text/css" href="{{ app.params.skinUrl }}/js/jquery-easyui-1.4.4/themes/default/easyui.css">*/
/* <link rel="stylesheet" type="text/css" href="{{ app.params.skinUrl }}/js/jquery-easyui-1.4.4/themes/icon.css">*/
/* */
/* <script src="{{ app.params.skinUrl }}/js/jquery-easyui-1.4.4/jquery.min.js" type="text/javascript"></script>*/
/* <script src="{{ app.params.skinUrl }}/js/jquery-easyui-1.4.4/jquery.easyui.min.js" type="text/javascript"></script>*/
/* <script src="{{ app.params.skinUrl }}/js/jquery-easyui-1.4.4/locale/easyui-lang-zh_CN.js" type="text/javascript"></script>*/
/* */
/* <table cellpadding="5">*/
/*     <tr>*/
/*         <td>话题标题</td>*/
/*         <td><input type="text" name="subject" value="{{ model.subject }}" style="width: 650px;"></td>*/
/*     </tr>*/
/*     <tr>*/
/*         <td>话题内容</td>*/
/*         <td><textarea id="product-intro">{{ message }}</textarea></td>*/
/*     </tr>*/
/*     <tr>*/
/*         <td>是否加精</td>*/
/*         <td>*/
/*             <select class="easyui-combobox" id="digest" data-options="panelHeight:'auto',editable:false" style="width:80px;">*/
/*                 <option value="0">否</option>*/
/*                 <option value="1">是</option>*/
/*             </select>*/
/*         </td>*/
/*     </tr>*/
/*     <tr>*/
/*         <td>是否置顶</td>*/
/*         <td><select class="easyui-combobox" id="top" data-options="panelHeight:'auto',editable:false" style="width:80px;">*/
/*             <option value="0">否</option>*/
/*             <option value="1">是</option>*/
/*         </select></td>*/
/*     </tr>*/
/*     <tr>*/
/*         <td></td>*/
/*         <td><input type="button" onclick="sub()" value="提交"></td>*/
/*     </tr>*/
/* </table>*/
/* */
/* <script charset="utf-8" src="{{ app.params.skinUrl }}/js/kindeditor-4.1.10/kindeditor-all-min.js"></script>*/
/* <script>*/
/*     $(function(){*/
/*         var editor;*/
/*         KindEditor.ready(function(K) {*/
/*             editor = K.create('#product-intro', {*/
/*                 resizeType : 2,*/
/*                 allowPreviewEmoticons : false,*/
/*                 allowImageUpload : true,*/
/*                 minHeight: 400,*/
/*                 uploadJson : '/group/upload-topic-img',*/
/*                 items : [*/
/*                     'emoticons','fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold', 'italic', 'underline',*/
/*                     'removeformat', '|', 'justifyleft', 'justifycenter', 'justifyright', 'insertorderedlist',*/
/*                     'insertunorderedlist', '|',  'multiimage', 'link', 'fullscreen'*/
/*                 ]*/
/*             });*/
/*             editor.clickToolbar('fullscreen', function() {*/
/*                 $('body').css({*/
/*                     'height' : '100%',*/
/*                 });*/
/*             });*/
/*         });*/
/* */
/*         var digest = "{{ model.is_digest }}";*/
/*         var top = "{{ model.is_top }}";*/
/*         $('#top').combobox('setValue', top);*/
/*         $('#digest').combobox('setValue', digest);*/
/*     })*/
/* */
/*     function sub(){*/
/*         var id = "{{ model.id }}"*/
/*         var content = $(document.getElementsByTagName('iframe')[0].contentWindow.document.body).html();*/
/*         var title = $('input[name=subject]').val();*/
/*         var fil = filterContent(content);*/
/*         var top = $('#top').combobox('getValue');*/
/*         var digest = $('#digest').combobox('getValue');*/
/* */
/*         $.post("{{ url('/group/topic-edit') }}", {'id':id, 'subject':title, 'content':fil, 'digest':digest, 'top':top}, function(data){*/
/*             if(data == 1){*/
/*                 $.messager.alert('成功', '修改成功');*/
/*                 setTimeout(function(){location.reload();parent.location.reload()}, 2000);*/
/*             }else{*/
/*                 $.messager.alert('成功', '修改失败');*/
/*                 return;*/
/*             }*/
/*         })*/
/*     }*/
/* */
/*     function filterContent(content){*/
/*         var con = content.replace(/<img[^>]*src=\"[\w:\.\/-]+\/([\d]{1,2})\.gif\"[^>]*>/ig, "[s:$1]").replace(/<img[^>]*src=[\'\"\s]?([\w:\.\/]+([\d]{17}\.(jpg|gif))[\s\'\"]+)[^>]*>/ig, "[img]$2[/img]").replace(/<a[^>]*href=[\'\"\s]?([^\s\'\"]*)[^>]*>(.+?)<\/a>/ig, "[url=$1]$2[/url]");*/
/* */
/*         return con;*/
/*     }*/
/* </script>*/
