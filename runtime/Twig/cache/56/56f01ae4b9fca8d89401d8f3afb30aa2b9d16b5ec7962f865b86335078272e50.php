<?php

/* index.html */
class __TwigTemplate_5e72d178fe387beb393af7422289396ac6536034d10739767a71a9514744581e extends yii\twig\Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("@app/views/base.html", "index.html", 1);
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
<table id=\"listdata\"  class=\"easyui-datagrid\" title=\"圈子列表\" data-options=\"toolbar:'#tb-user',singleSelect:true,pagination:true,method:'get',url:'";
        // line 5
        echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url("group/index"), "html", null, true);
        echo "',pageSize:20\">
    <thead>
    <tr>
        <th data-options=\"field:'id', width:50, align:'center'\">ID</th>
        <th data-options=\"field:'name', width:100, align:'center'\">圈子名称</th>
        <th data-options=\"field:'adminuser', width:130, align:'center'\">管理员</th>
        <th data-options=\"field:'intro', width:500, align:'center'\">简介</th>
        <th data-options=\"field:'notice', width:300, align:'center'\">公告</th>
        <th data-options=\"field:'user_count', width:100, align:'center'\">成员</th>
        <th data-options=\"field:'topic_count', width:50, align:'center'\">帖子数</th>
        <th data-options=\"field:'verify_status', width:100, align:'center'\" formatter=\"formatVerify\">话题帖子审核</th>
        <th data-options=\"field:'group_closed', width:100, align:'center'\" formatter=\"formatJoin\">可加入</th>
        <th data-options=\"field:'topic_closed', width:100, align:'center'\" formatter=\"formatTopic\">可发帖</th>
        <th data-options=\"field:'comment_closed', width:100, align:'center'\" formatter=\"formatComment\">可回复</th>
    </tr>
    </thead>
</table>

<div id=\"tb-user\" style=\"height:auto\">
    <div>
        ";
        // line 25
        if (((isset($context["edit"]) ? $context["edit"] : null) == 1)) {
            // line 26
            echo "            <a href=\"javascript:void(0)\" class=\"easyui-linkbutton\" data-options=\"iconCls:'icon-edit',plain:true\" onclick=\"edit()\">编辑</a>
        ";
        }
        // line 28
        echo "    </div>
</div>

<div id=\"dlg-edit\" title=\"编辑圈子\" class=\"easyui-dialog\" style=\"width:450px;height:auto;padding:10px 20px\" modal=\"true\" closed=\"true\" buttons=\"#dlg-buttons-edit\">
    ";
        // line 32
        echo $this->getAttribute((isset($context["html"]) ? $context["html"] : null), "beginForm", array(0 => "", 1 => "post", 2 => array("class" => "am-form am-form-horizontal", "id" => "editForm")), "method");
        echo "
    <table cellpadding=\"5\">
        <tr>
            <td>圈子名称</td>
            <td><input class=\"easyui-textbox\" type=\"text\" name=\"Group[name]\" data-options=\"required:true\"></td>
        </tr>
        <tr>
            <td>圈主</td>
            <td><input class=\"easyui-textbox\" type=\"text\" name=\"Group[adminuser]\" data-options=\"required:true\"></td>
        </tr>
        <tr>
            <td>关闭圈子</td>
            <td>
                <select class=\"easyui-combobox\" name=\"Group[group_closed]\">
                    <option value=\"0\">是</option>
                    <option value=\"1\">否</option>
                </select>
            </td>
        </tr>
        <tr>
            <td>会员可发帖</td>
            <td>
                <select class=\"easyui-combobox\" name=\"Group[topic_closed]\">
                    <option value=\"0\">是</option>
                    <option value=\"1\">否</option>
                </select>
            </td>
        </tr>
        <tr>
            <td>话题可评论</td>
            <td>
                <select class=\"easyui-combobox\" name=\"Group[comment_closed]\">
                    <option value=\"0\">是</option>
                    <option value=\"1\">否</option>
                </select>
            </td>
        </tr>
        <tr>
            <td>话题回帖需审核</td>
            <td>
                <select class=\"easyui-combobox\" name=\"Group[verify_status]\">
                    <option value=\"0\">是</option>
                    <option value=\"1\">否</option>
                </select>
            </td>
        </tr>
        <tr>
            <td>圈子介绍</td>
            <td><input class=\"easyui-textbox\" type=\"text\" name=\"Group[intro]\" data-options=\"required:true\"></td>
        </tr>
        <tr>
            <td>圈子公告</td>
            <td><input class=\"easyui-textbox\" type=\"text\" name=\"Group[notice]\"></td>
        </tr>
        <tr>
            <td></td>
            <td><input type=\"submit\" onclick=\"save()\"></td>
        </tr>
    </table>
    ";
        // line 91
        echo $this->getAttribute((isset($context["html"]) ? $context["html"] : null), "endForm", array(), "method");
        echo "
</div>

";
    }

    // line 96
    public function block_js($context, array $blocks = array())
    {
        // line 97
        echo "<script>
    function save(){
        var selRow = \$('#listdata').datagrid('getSelected');
        var url = '/group/edit?id='+selRow.id;
        var form = 'editForm';
        \$('#' + form).form({
            url: url,
            onSubmit:function(){
                return \$(this).form('enableValidation').form('validate');
            },
            success: function (data) {
                data = eval('(' + data + ')');
                if (data.error == 0) {
                    \$.messager.alert('成功', data.message);
                    setTimeout(function(){window.location.href=\"/group/index\"; }, 2000);
                } else {
                    \$.messager.alert('失败', data.message, 'error');
                }
            }
        });
        \$('#' + form).submit();
    }

    function edit(){
        var selRow = \$('#listdata').datagrid('getSelected');
        if (!selRow) {
            \$.messager.alert('错误','请选择一个圈子');
            return false;
        }
        \$('#dlg-edit').form('load',{
            'Group[name]' : selRow.name,
            'Group[adminuser]' : selRow.adminuser,
            'Group[group_closed]' : selRow.group_closed,
            'Group[topic_closed]' : selRow.topic_closed,
            'Group[comment_closed]' : selRow.comment_closed,
            'Group[verify_status]' : selRow.verify_status,
            'Group[intro]' : selRow.intro,
            'Group[notice]' : selRow.notice
        });
        \$('#dlg-edit').window('open');
    }

    function formatComment(val){
        if(val == 0){
            return '可回复';
        }else{
            return '<span color=\"red\">不可回复</span>';
        }
    }

    function formatVerify(val){
        if(val == 0) return '需审核';
        else return '不需审核';
    }

    function formatTopic(val){
        if(val == 0){
            return '会员可发帖';
        }else{
            return '<span color=\"red\">会员不可发帖</span>';
        }
    }

    function formatJoin(val){
        if(val == 0){
            return '会员可加入';
        }else{
            return '<span color=\"red\">会员不可加入</span>';
        }
    }
</script>
";
    }

    public function getTemplateName()
    {
        return "index.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  143 => 97,  140 => 96,  132 => 91,  70 => 32,  64 => 28,  60 => 26,  58 => 25,  35 => 5,  32 => 4,  29 => 3,  11 => 1,);
    }
}
/* {% extends '@app/views/base.html' %}*/
/* */
/* {% block main %}*/
/* */
/* <table id="listdata"  class="easyui-datagrid" title="圈子列表" data-options="toolbar:'#tb-user',singleSelect:true,pagination:true,method:'get',url:'{{  url('group/index')}}',pageSize:20">*/
/*     <thead>*/
/*     <tr>*/
/*         <th data-options="field:'id', width:50, align:'center'">ID</th>*/
/*         <th data-options="field:'name', width:100, align:'center'">圈子名称</th>*/
/*         <th data-options="field:'adminuser', width:130, align:'center'">管理员</th>*/
/*         <th data-options="field:'intro', width:500, align:'center'">简介</th>*/
/*         <th data-options="field:'notice', width:300, align:'center'">公告</th>*/
/*         <th data-options="field:'user_count', width:100, align:'center'">成员</th>*/
/*         <th data-options="field:'topic_count', width:50, align:'center'">帖子数</th>*/
/*         <th data-options="field:'verify_status', width:100, align:'center'" formatter="formatVerify">话题帖子审核</th>*/
/*         <th data-options="field:'group_closed', width:100, align:'center'" formatter="formatJoin">可加入</th>*/
/*         <th data-options="field:'topic_closed', width:100, align:'center'" formatter="formatTopic">可发帖</th>*/
/*         <th data-options="field:'comment_closed', width:100, align:'center'" formatter="formatComment">可回复</th>*/
/*     </tr>*/
/*     </thead>*/
/* </table>*/
/* */
/* <div id="tb-user" style="height:auto">*/
/*     <div>*/
/*         {% if(edit == 1) %}*/
/*             <a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-edit',plain:true" onclick="edit()">编辑</a>*/
/*         {% endif %}*/
/*     </div>*/
/* </div>*/
/* */
/* <div id="dlg-edit" title="编辑圈子" class="easyui-dialog" style="width:450px;height:auto;padding:10px 20px" modal="true" closed="true" buttons="#dlg-buttons-edit">*/
/*     {{ html.beginForm('', 'post', {'class':'am-form am-form-horizontal', 'id':'editForm'}) | raw }}*/
/*     <table cellpadding="5">*/
/*         <tr>*/
/*             <td>圈子名称</td>*/
/*             <td><input class="easyui-textbox" type="text" name="Group[name]" data-options="required:true"></td>*/
/*         </tr>*/
/*         <tr>*/
/*             <td>圈主</td>*/
/*             <td><input class="easyui-textbox" type="text" name="Group[adminuser]" data-options="required:true"></td>*/
/*         </tr>*/
/*         <tr>*/
/*             <td>关闭圈子</td>*/
/*             <td>*/
/*                 <select class="easyui-combobox" name="Group[group_closed]">*/
/*                     <option value="0">是</option>*/
/*                     <option value="1">否</option>*/
/*                 </select>*/
/*             </td>*/
/*         </tr>*/
/*         <tr>*/
/*             <td>会员可发帖</td>*/
/*             <td>*/
/*                 <select class="easyui-combobox" name="Group[topic_closed]">*/
/*                     <option value="0">是</option>*/
/*                     <option value="1">否</option>*/
/*                 </select>*/
/*             </td>*/
/*         </tr>*/
/*         <tr>*/
/*             <td>话题可评论</td>*/
/*             <td>*/
/*                 <select class="easyui-combobox" name="Group[comment_closed]">*/
/*                     <option value="0">是</option>*/
/*                     <option value="1">否</option>*/
/*                 </select>*/
/*             </td>*/
/*         </tr>*/
/*         <tr>*/
/*             <td>话题回帖需审核</td>*/
/*             <td>*/
/*                 <select class="easyui-combobox" name="Group[verify_status]">*/
/*                     <option value="0">是</option>*/
/*                     <option value="1">否</option>*/
/*                 </select>*/
/*             </td>*/
/*         </tr>*/
/*         <tr>*/
/*             <td>圈子介绍</td>*/
/*             <td><input class="easyui-textbox" type="text" name="Group[intro]" data-options="required:true"></td>*/
/*         </tr>*/
/*         <tr>*/
/*             <td>圈子公告</td>*/
/*             <td><input class="easyui-textbox" type="text" name="Group[notice]"></td>*/
/*         </tr>*/
/*         <tr>*/
/*             <td></td>*/
/*             <td><input type="submit" onclick="save()"></td>*/
/*         </tr>*/
/*     </table>*/
/*     {{ html.endForm() | raw }}*/
/* </div>*/
/* */
/* {% endblock %}*/
/* */
/* {% block js %}*/
/* <script>*/
/*     function save(){*/
/*         var selRow = $('#listdata').datagrid('getSelected');*/
/*         var url = '/group/edit?id='+selRow.id;*/
/*         var form = 'editForm';*/
/*         $('#' + form).form({*/
/*             url: url,*/
/*             onSubmit:function(){*/
/*                 return $(this).form('enableValidation').form('validate');*/
/*             },*/
/*             success: function (data) {*/
/*                 data = eval('(' + data + ')');*/
/*                 if (data.error == 0) {*/
/*                     $.messager.alert('成功', data.message);*/
/*                     setTimeout(function(){window.location.href="/group/index"; }, 2000);*/
/*                 } else {*/
/*                     $.messager.alert('失败', data.message, 'error');*/
/*                 }*/
/*             }*/
/*         });*/
/*         $('#' + form).submit();*/
/*     }*/
/* */
/*     function edit(){*/
/*         var selRow = $('#listdata').datagrid('getSelected');*/
/*         if (!selRow) {*/
/*             $.messager.alert('错误','请选择一个圈子');*/
/*             return false;*/
/*         }*/
/*         $('#dlg-edit').form('load',{*/
/*             'Group[name]' : selRow.name,*/
/*             'Group[adminuser]' : selRow.adminuser,*/
/*             'Group[group_closed]' : selRow.group_closed,*/
/*             'Group[topic_closed]' : selRow.topic_closed,*/
/*             'Group[comment_closed]' : selRow.comment_closed,*/
/*             'Group[verify_status]' : selRow.verify_status,*/
/*             'Group[intro]' : selRow.intro,*/
/*             'Group[notice]' : selRow.notice*/
/*         });*/
/*         $('#dlg-edit').window('open');*/
/*     }*/
/* */
/*     function formatComment(val){*/
/*         if(val == 0){*/
/*             return '可回复';*/
/*         }else{*/
/*             return '<span color="red">不可回复</span>';*/
/*         }*/
/*     }*/
/* */
/*     function formatVerify(val){*/
/*         if(val == 0) return '需审核';*/
/*         else return '不需审核';*/
/*     }*/
/* */
/*     function formatTopic(val){*/
/*         if(val == 0){*/
/*             return '会员可发帖';*/
/*         }else{*/
/*             return '<span color="red">会员不可发帖</span>';*/
/*         }*/
/*     }*/
/* */
/*     function formatJoin(val){*/
/*         if(val == 0){*/
/*             return '会员可加入';*/
/*         }else{*/
/*             return '<span color="red">会员不可加入</span>';*/
/*         }*/
/*     }*/
/* </script>*/
/* {% endblock %}*/
/* */
