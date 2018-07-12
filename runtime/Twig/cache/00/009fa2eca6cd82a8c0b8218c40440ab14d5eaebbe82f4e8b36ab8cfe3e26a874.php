<?php

/* edit.html */
class __TwigTemplate_7f4dcd9c3847559ebed131eff67687396104a15458387429ae72cb36e144f5e7 extends yii\twig\Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("@app/views/base.html", "edit.html", 1);
        $this->blocks = array(
            'css' => array($this, 'block_css'),
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
    public function block_css($context, array $blocks = array())
    {
        // line 4
        echo $this->getAttribute((isset($context["html"]) ? $context["html"] : null), "beginForm", array(0 => "", 1 => "post", 2 => array("class" => "am-form am-form-horizontal", "id" => "addForm", "enctype" => "multipart/form-data")), "method");
        echo "
<table cellpadding=\"5\">
    <tr>
        <td>类型</td>
        <td>
            <select class=\"easyui-combobox\" name=\"key\" data-options=\"panelHeight:'auto',disabled:true\" id=\"key\">
                <option value=\"richdayconfig\">日榜</option>
                <!--<option value=\"richweekconfig\">周榜</option>-->
                <option value=\"richmonthconfig\">月榜</option>
            </select>
        </td>
    </tr>
    <tr>
        <td>添加奖项</td>
        <td id=\"content\">
            <!--<input type=\"button\" value=\"添加奖励\" onclick=\"\$('#dlg-add-reward').dialog('open')\">-->
            ";
        // line 20
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["rewards"]) ? $context["rewards"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
            // line 21
            echo "            <p class=\"reward-name\" data-rank=\"";
            echo twig_escape_filter($this->env, $this->getAttribute($context["item"], "rank", array()), "html", null, true);
            echo "\" data-name=\"";
            echo twig_escape_filter($this->env, $this->getAttribute($context["item"], "name", array()), "html", null, true);
            echo "\" data-type=\"";
            echo twig_escape_filter($this->env, $this->getAttribute($context["item"], "type", array()), "html", null, true);
            echo "\" id=\"";
            echo twig_escape_filter($this->env, $this->getAttribute($context["item"], "rank", array()), "html", null, true);
            echo "\" data-picture=\"";
            echo twig_escape_filter($this->env, $this->getAttribute($context["item"], "picture", array()), "html", null, true);
            echo "\"><span>第";
            echo twig_escape_filter($this->env, $this->getAttribute($context["item"], "rank", array()), "html", null, true);
            echo "名  ";
            echo twig_escape_filter($this->env, $this->getAttribute($context["item"], "name", array()), "html", null, true);
            echo "</span> <a href=\"javascript:void(0);\" onclick=\"editReward('";
            echo twig_escape_filter($this->env, $this->getAttribute($context["item"], "rank", array()), "html", null, true);
            echo "', '";
            echo twig_escape_filter($this->env, $this->getAttribute($context["item"], "type", array()), "html", null, true);
            echo "', '";
            echo twig_escape_filter($this->env, $this->getAttribute($context["item"], "name", array()), "html", null, true);
            echo "', '";
            echo twig_escape_filter($this->env, $this->getAttribute($context["item"], "picture", array()), "html", null, true);
            echo "')\">修改</a><!-- <a href=\"javascript:void(0);\" onclick=\"delReward(this)\">删除</a>--></p>
            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 23
        echo "        </td>
    </tr>
    <tr>
        <td></td>
        <td><a class=\"easyui-linkbutton\" iconCls=\"icon-ok\" onclick=\"save()\">确定</a></td>
    </tr>
</table>
";
        // line 30
        echo $this->getAttribute((isset($context["html"]) ? $context["html"] : null), "endForm", array(), "method");
        echo "

<div id=\"dlg-edit\" title=\"修改奖励\" class=\"easyui-dialog\" style=\"width:350px;height:auto;padding:10px 20px;\" modal=\"true\" closed=\"true\">
";
        // line 33
        echo $this->getAttribute((isset($context["html"]) ? $context["html"] : null), "beginForm", array(0 => "", 1 => "post", 2 => array("class" => "am-form am-form-horizontal", "id" => "editRewardForm", "enctype" => "multipart/form-data")), "method");
        echo "
<table cellpadding=\"5\">
    <tr>
        <td>排名</td>
        <td>
            <select class=\"easyui-combobox\" name=\"rank\" data-options=\"panelHeight:'auto',disabled:true\" id=\"rank\">
                <option value=\"1\">第一名</option>
                <option value=\"2\">第二名</option>
                <option value=\"3\">第三名</option>
                <option value=\"4\">第四名</option>
                <option value=\"5\">第五名</option>
                <option value=\"6\">第六名</option>
                <option value=\"7\">第七名</option>
                <option value=\"8\">第八名</option>
                <option value=\"9\">第九名</option>
                <option value=\"10\">第十名</option>
                <option value=\"11-50\">第十一名到第五十名</option>
                <option value=\"51-100\">第五十一名到第一百名</option>
            </select>
        </td>
    </tr>
    <tr>
        <td>类型</td>
        <td>
            <select class=\"easyui-combobox\" name=\"type\" data-options=\"panelHeight:'auto'\" id=\"type\">
                <option value=\"1\">实物</option>
                <option value=\"2\">现金</option>
                <option value=\"3\">返现</option>
                <option value=\"4\">红包</option>
            </select>
        </td>
    </tr>
    <tr>
        <td>奖品</td>
        <td><input class=\"easyui-textbox\" name=\"reward\" class=\"reward\" id=\"reward\"/></td>
    </tr>
    <tr>
        <td>奖品图片</td>
        <td><input class=\"easyui-filebox\" name=\"file\" class=\"picture\" id=\"picture\"/></td>
    </tr>
    <tr>
        <td></td>
        <td><a href=\"javascript:void(0)\" class=\"easyui-linkbutton\" onclick=\"submitRewardForm()\" style=\"width: 80px;\">确定</a></td>
    </tr>
</table>
    ";
        // line 78
        echo $this->getAttribute((isset($context["html"]) ? $context["html"] : null), "endForm", array(), "method");
        echo "
</div>
";
    }

    // line 82
    public function block_js($context, array $blocks = array())
    {
        // line 83
        echo "<script>
    \$('#picture').filebox({
        onChange: function(n, o){
            if(n != '' && n != o){
                \$('#editRewardForm').form({
                    url: '";
        // line 88
        echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url("rich/upload"), "html", null, true);
        echo "',
                    onSubmit: function(param){
                    },
                    success: function (data) {
                        \$('#picture').attr('data-id', data);
                    }
                });
                \$('#editRewardForm').submit();
            }
        }
    })

    function save()
    {
        \$('#addForm').form({
            url: '";
        // line 103
        echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url("rich/edit-reward"), "html", null, true);
        echo "' + '?type=' + '";
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["model"]) ? $context["model"] : null), "key", array()), "html", null, true);
        echo "',
            onSubmit: function(param){
                var isValid = \$(this).form('validate');
                if (!isValid){
                    \$.messager.progress('close');\t// 如果表单是无效的则隐藏进度条
                }
                var json = {};
                \$(\".reward-name\").each(function(k){
                    var rank = \$(this).attr('data-rank');
                    var type = \$(this).attr('data-type');
                    var name = \$(this).attr('data-name');
                    var picture = \$(this).attr('data-picture');
                    json[k] = {'rank':rank, 'type':type, 'name':name, 'picture':picture};
                });
                var jsonArr = JSON.stringify(json);
                //console.log(jsonArr);
                param.content = jsonArr;
                return isValid;\t// 返回false终止表单提交
            },
            success: function (data) {
                data = eval('(' + data + ')');
                if (data.error == 0) {
                    \$.messager.alert('成功', data.message);
                    setTimeout(function(){parent.location.reload();}, 2000);
                } else {
                    \$.messager.alert('失败', data.message);
                    return false;
                }
            }
        });
        \$('#addForm').submit();
    }

    \$(function(){
        \$('#key').combobox('setValue', '";
        // line 137
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["model"]) ? $context["model"] : null), "key", array()), "html", null, true);
        echo "')
    })

    function editReward(rank, type, name, picture){
        \$('#dlg-edit').dialog('open');
        \$('#rank').combobox('setValue', rank);
        \$('#type').combobox('setValue', type);
        \$('#reward').textbox('setValue', name);
        \$('#picture').filebox('setValue', picture)
        \$('#picture').attr('data-id', picture);
    }

    function submitRewardForm()
    {
        var type = \$('#type').combobox('getValue');
        var name = \$('#reward').textbox('getValue');
        var rank = \$('#rank').combobox('getValue');
        var picture = \$('#picture').attr('data-id');

        //var picture = \$('#picture').filebox('getValue');
        if(type != 1){
            if(parseInt(name) != name){
                \$.messager.alert('错误','奖品必须为整数');
                return false;
            }
        }
        \$('#'+rank).attr('data-name', name);
        \$('#'+rank).attr('data-type', type);
        \$('#'+rank).attr('data-picture', picture);

        /*\$('#content').append('<p class=\"goods-name\" data-rank=\"'+rank+'\" data-name=\"'+name+'\" data-type=\"'+type+'\">第'+rank+'名  <span>'+name+'</span>&nbsp;&nbsp;<a href=\"javascript:void(0);\" onclick=\"del(this)\">删除</a></p>');*/
        \$('#dlg-edit').dialog('close');
    }
</script>
";
    }

    public function getTemplateName()
    {
        return "edit.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  221 => 137,  182 => 103,  164 => 88,  157 => 83,  154 => 82,  147 => 78,  99 => 33,  93 => 30,  84 => 23,  55 => 21,  51 => 20,  32 => 4,  29 => 3,  11 => 1,);
    }
}
/* {% extends '@app/views/base.html' %}*/
/* */
/* {% block css %}*/
/* {{ html.beginForm('', 'post', {'class':'am-form am-form-horizontal', 'id':'addForm','enctype':"multipart/form-data"}) | raw }}*/
/* <table cellpadding="5">*/
/*     <tr>*/
/*         <td>类型</td>*/
/*         <td>*/
/*             <select class="easyui-combobox" name="key" data-options="panelHeight:'auto',disabled:true" id="key">*/
/*                 <option value="richdayconfig">日榜</option>*/
/*                 <!--<option value="richweekconfig">周榜</option>-->*/
/*                 <option value="richmonthconfig">月榜</option>*/
/*             </select>*/
/*         </td>*/
/*     </tr>*/
/*     <tr>*/
/*         <td>添加奖项</td>*/
/*         <td id="content">*/
/*             <!--<input type="button" value="添加奖励" onclick="$('#dlg-add-reward').dialog('open')">-->*/
/*             {% for item in rewards %}*/
/*             <p class="reward-name" data-rank="{{ item.rank }}" data-name="{{ item.name }}" data-type="{{ item.type }}" id="{{  item.rank }}" data-picture="{{ item.picture }}"><span>第{{ item.rank }}名  {{ item.name }}</span> <a href="javascript:void(0);" onclick="editReward('{{ item.rank }}', '{{ item.type }}', '{{ item.name }}', '{{ item.picture }}')">修改</a><!-- <a href="javascript:void(0);" onclick="delReward(this)">删除</a>--></p>*/
/*             {% endfor %}*/
/*         </td>*/
/*     </tr>*/
/*     <tr>*/
/*         <td></td>*/
/*         <td><a class="easyui-linkbutton" iconCls="icon-ok" onclick="save()">确定</a></td>*/
/*     </tr>*/
/* </table>*/
/* {{ html.endForm() | raw }}*/
/* */
/* <div id="dlg-edit" title="修改奖励" class="easyui-dialog" style="width:350px;height:auto;padding:10px 20px;" modal="true" closed="true">*/
/* {{ html.beginForm('', 'post', {'class':'am-form am-form-horizontal', 'id':'editRewardForm','enctype':"multipart/form-data"}) | raw }}*/
/* <table cellpadding="5">*/
/*     <tr>*/
/*         <td>排名</td>*/
/*         <td>*/
/*             <select class="easyui-combobox" name="rank" data-options="panelHeight:'auto',disabled:true" id="rank">*/
/*                 <option value="1">第一名</option>*/
/*                 <option value="2">第二名</option>*/
/*                 <option value="3">第三名</option>*/
/*                 <option value="4">第四名</option>*/
/*                 <option value="5">第五名</option>*/
/*                 <option value="6">第六名</option>*/
/*                 <option value="7">第七名</option>*/
/*                 <option value="8">第八名</option>*/
/*                 <option value="9">第九名</option>*/
/*                 <option value="10">第十名</option>*/
/*                 <option value="11-50">第十一名到第五十名</option>*/
/*                 <option value="51-100">第五十一名到第一百名</option>*/
/*             </select>*/
/*         </td>*/
/*     </tr>*/
/*     <tr>*/
/*         <td>类型</td>*/
/*         <td>*/
/*             <select class="easyui-combobox" name="type" data-options="panelHeight:'auto'" id="type">*/
/*                 <option value="1">实物</option>*/
/*                 <option value="2">现金</option>*/
/*                 <option value="3">返现</option>*/
/*                 <option value="4">红包</option>*/
/*             </select>*/
/*         </td>*/
/*     </tr>*/
/*     <tr>*/
/*         <td>奖品</td>*/
/*         <td><input class="easyui-textbox" name="reward" class="reward" id="reward"/></td>*/
/*     </tr>*/
/*     <tr>*/
/*         <td>奖品图片</td>*/
/*         <td><input class="easyui-filebox" name="file" class="picture" id="picture"/></td>*/
/*     </tr>*/
/*     <tr>*/
/*         <td></td>*/
/*         <td><a href="javascript:void(0)" class="easyui-linkbutton" onclick="submitRewardForm()" style="width: 80px;">确定</a></td>*/
/*     </tr>*/
/* </table>*/
/*     {{ html.endForm() | raw }}*/
/* </div>*/
/* {% endblock %}*/
/* */
/* {% block js %}*/
/* <script>*/
/*     $('#picture').filebox({*/
/*         onChange: function(n, o){*/
/*             if(n != '' && n != o){*/
/*                 $('#editRewardForm').form({*/
/*                     url: '{{ url("rich/upload") }}',*/
/*                     onSubmit: function(param){*/
/*                     },*/
/*                     success: function (data) {*/
/*                         $('#picture').attr('data-id', data);*/
/*                     }*/
/*                 });*/
/*                 $('#editRewardForm').submit();*/
/*             }*/
/*         }*/
/*     })*/
/* */
/*     function save()*/
/*     {*/
/*         $('#addForm').form({*/
/*             url: '{{ url("rich/edit-reward") }}' + '?type=' + '{{ model.key }}',*/
/*             onSubmit: function(param){*/
/*                 var isValid = $(this).form('validate');*/
/*                 if (!isValid){*/
/*                     $.messager.progress('close');	// 如果表单是无效的则隐藏进度条*/
/*                 }*/
/*                 var json = {};*/
/*                 $(".reward-name").each(function(k){*/
/*                     var rank = $(this).attr('data-rank');*/
/*                     var type = $(this).attr('data-type');*/
/*                     var name = $(this).attr('data-name');*/
/*                     var picture = $(this).attr('data-picture');*/
/*                     json[k] = {'rank':rank, 'type':type, 'name':name, 'picture':picture};*/
/*                 });*/
/*                 var jsonArr = JSON.stringify(json);*/
/*                 //console.log(jsonArr);*/
/*                 param.content = jsonArr;*/
/*                 return isValid;	// 返回false终止表单提交*/
/*             },*/
/*             success: function (data) {*/
/*                 data = eval('(' + data + ')');*/
/*                 if (data.error == 0) {*/
/*                     $.messager.alert('成功', data.message);*/
/*                     setTimeout(function(){parent.location.reload();}, 2000);*/
/*                 } else {*/
/*                     $.messager.alert('失败', data.message);*/
/*                     return false;*/
/*                 }*/
/*             }*/
/*         });*/
/*         $('#addForm').submit();*/
/*     }*/
/* */
/*     $(function(){*/
/*         $('#key').combobox('setValue', '{{ model.key }}')*/
/*     })*/
/* */
/*     function editReward(rank, type, name, picture){*/
/*         $('#dlg-edit').dialog('open');*/
/*         $('#rank').combobox('setValue', rank);*/
/*         $('#type').combobox('setValue', type);*/
/*         $('#reward').textbox('setValue', name);*/
/*         $('#picture').filebox('setValue', picture)*/
/*         $('#picture').attr('data-id', picture);*/
/*     }*/
/* */
/*     function submitRewardForm()*/
/*     {*/
/*         var type = $('#type').combobox('getValue');*/
/*         var name = $('#reward').textbox('getValue');*/
/*         var rank = $('#rank').combobox('getValue');*/
/*         var picture = $('#picture').attr('data-id');*/
/* */
/*         //var picture = $('#picture').filebox('getValue');*/
/*         if(type != 1){*/
/*             if(parseInt(name) != name){*/
/*                 $.messager.alert('错误','奖品必须为整数');*/
/*                 return false;*/
/*             }*/
/*         }*/
/*         $('#'+rank).attr('data-name', name);*/
/*         $('#'+rank).attr('data-type', type);*/
/*         $('#'+rank).attr('data-picture', picture);*/
/* */
/*         /*$('#content').append('<p class="goods-name" data-rank="'+rank+'" data-name="'+name+'" data-type="'+type+'">第'+rank+'名  <span>'+name+'</span>&nbsp;&nbsp;<a href="javascript:void(0);" onclick="del(this)">删除</a></p>');*//* */
/*         $('#dlg-edit').dialog('close');*/
/*     }*/
/* </script>*/
/* {% endblock %}*/
