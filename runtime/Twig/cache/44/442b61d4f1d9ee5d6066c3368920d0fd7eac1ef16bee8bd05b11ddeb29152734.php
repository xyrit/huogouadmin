<?php

/* topic.html */
class __TwigTemplate_2a501bed8be33f1a2a2d2b21ba5ecbe4b59364800a1cc5f22484b84a2781ecfa extends yii\twig\Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("@app/views/base.html", "topic.html", 1);
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
        echo "<div class=\"search\">
    <span>加精
        <select class=\"easyui-combobox\" id=\"digest\" name=\"digest\" data-options=\"required:true, panelHeight:'auto'\">
            <option value=\"2\">全部</option>
            <option value=\"1\">已加精</option>
            <option value=\"0\">未加精</option>
        </select>
    </span>
    <span>今日话题
        <select class=\"easyui-combobox\" id=\"today\" name=\"today\" data-options=\"required:true, panelHeight:'auto'\">
            <option value=\"0\">全部</option>
            <option value=\"1\">今日</option>
        </select>
    </span>
    <span>审核状态
        <select class=\"easyui-combobox\" id=\"verify_status\" name=\"status\" data-options=\"required:true, panelHeight:'auto'\">
            <option value=\"3\">全部</option>
            <option value=\"0\">待审核</option>
            <option value=\"1\">已通过</option>
            <option value=\"2\">未通过</option>
        </select>
    </span>
    <span>
        <input class=\"easyui-datetimebox\" style=\"width:200px\" name=\"startTime\" id=\"startTime\"> 到
        <input class=\"easyui-datetimebox\" style=\"width:200px\" name=\"endTime\" id=\"endTime\">
    </span>
    <a href=\"javascript:void(0);\" onclick=\"reloadgrid();\" class=\"easyui-linkbutton\" iconCls=\"icon-search\">搜索</a>
</div>

<table id=\"listdata\"  class=\"easyui-datagrid\" title=\"话题列表\" data-options=\"toolbar:'#tb-user',singleSelect:true,pagination:true,method:'get',url:'";
        // line 33
        echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url("group/topic"), "html", null, true);
        echo "'\">
    <thead>
    <tr>
        <th data-options=\"field:'id', width:50, align:'center'\">ID</th>
        <th data-options=\"field:'subject', width:300, align:'center'\">标题</th>
        <th data-options=\"field:'username', width:200, align:'center'\" formatter=\"formatUsername\">用户</th>
        <th data-options=\"field:'group_id', width:100, align:'center'\">所属圈子</th>
        <th data-options=\"field:'view_count', width:50, align:'center'\">浏览次数</th>
        <th data-options=\"field:'comment_count', width:50, align:'center'\">回复次数</th>
        <th data-options=\"field:'top', width:100, align:'center'\" formatter=\"formatTop\">是否置顶</th>
        <th data-options=\"field:'digest', width:100, align:'center'\" formatter=\"formatDigest\">是否精华</th>
        <th data-options=\"field:'status', width:100, align:'center'\" formatter=\"formatVerify\">是否审核</th>
        <th data-options=\"field:'created_at', width:150, align:'center'\">创建时间</th>
    </tr>
    </thead>
</table>

<div id=\"tb-user\" style=\"height:auto\">
    <div>
        <a href=\"javascript:void(0)\" class=\"easyui-linkbutton\" data-options=\"iconCls:'icon-view',plain:true\" onclick=\"view()\">查看内容</a>
        ";
        // line 53
        if (((isset($context["edit"]) ? $context["edit"] : null) == 1)) {
            // line 54
            echo "        <a href=\"javascript:void(0)\" class=\"easyui-linkbutton\" data-options=\"iconCls:'icon-edit',plain:true\" onclick=\"edit()\">编辑</a>
        ";
        }
        // line 56
        echo "        ";
        if (((isset($context["verify"]) ? $context["verify"] : null) == 1)) {
            // line 57
            echo "        <a href=\"javascript:void(0)\" class=\"easyui-linkbutton\" data-options=\"iconCls:'icon-edit',plain:true\"
           onclick=\"verify()\">审核</a>
        ";
        }
        // line 60
        echo "        ";
        if (((isset($context["del_topic"]) ? $context["del_topic"] : null) == 1)) {
            // line 61
            echo "        <a href=\"javascript:void(0)\" class=\"easyui-linkbutton\" data-options=\"iconCls:'icon-cancel',plain:true\" onclick=\"del()\">删除</a>
        ";
        }
        // line 63
        echo "    </div>
</div>

<div id=\"dlg_content\" class=\"easyui-window\" title=\"编辑话题\" data-options=\"closed:true,modal:true\" style=\"width:860px;height:700px;padding:10px\">
    <iframe id=\"topic-info\" frameborder=\"0\" style=\"width:840px;height:690px\" scrolling=\"no\"></iframe>
</div>

<div id=\"dlg_con\" class=\"easyui-window\" title=\"话题内容\" data-options=\"closed:true,modal:true\" style=\"width:760px;height:590px;padding:10px\">
    <div id=\"content\"></div>
</div>

<div id=\"dlg_verify\" class=\"easyui-window\" title=\"审核\" data-options=\"closed:true,modal:true\" style=\"width:400px;height:200px;padding:10px\" >
    <table cellpadding=\"5\">
        <tr>
            <td style=\"width: 100px\">审核</td>
            <td>
                <select class=\"easyui-combobox\" name=\"status\" id=\"status\" data-options=\"panelHeight:'auto'\">
                    <option value=\"1\">通过</option>
                    <option value=\"2\">不通过</option>
                </select>
            </td>
        </tr>
    </table>
    <div style=\"text-align:center;padding:5px;margin-top:20px;\">
        <a class=\"easyui-linkbutton\" iconCls=\"icon-ok\" onclick=\"save()\">确定</a>
        <a class=\"easyui-linkbutton\" iconCls=\"icon-cancel\" onclick=\"javascript:\$('#dlg_verify').dialog('close')\">取消</a>
    </div>
</div>

";
    }

    // line 94
    public function block_js($context, array $blocks = array())
    {
        // line 95
        echo "<script charset=\"utf-8\" src=\"";
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "params", array()), "skinUrl", array()), "html", null, true);
        echo "/js/kindeditor-4.1.10/kindeditor-all-min.js\"></script>
<script>
    function reloadgrid(){
        var queryParams = \$('#listdata').datagrid('options').queryParams;
        queryParams.digest\t= \$('#digest').combobox(\"getValue\");
        queryParams.today = \$('#today').combobox(\"getValue\");
        queryParams.start = \$('#startTime').datetimebox('getValue');
        queryParams.end = \$('#endTime').datetimebox('getValue');
        queryParams.status = \$('#verify_status').combobox(\"getValue\");
        \$('#listdata').datagrid('options').queryParams = queryParams;
        \$(\"#listdata\").datagrid('reload');
    }

    function view(){
        var selRow = \$('#listdata').datagrid('getSelected');
        if (!selRow) {
            \$.messager.alert('错误','请选择一个话题');
            return false;
        }

        \$.post('/group/topic-mess', {'id':selRow.id}, function(data){
            \$('#content').html(data);
            \$('#dlg_con').window('open');
        })
    }

    function save(){
        var selRow = \$('#listdata').datagrid('getSelected');
        var status = \$('#status').combobox('getValue');
        \$.get('/group/verify', {'id':selRow.id, 'status':status}, function(data){
            if (data == 1) {
                \$.messager.alert('成功', '审核成功');
                setTimeout(function(){location.reload();}, 2000);
            } else {
                \$.messager.alert('错误', '审核失败', 'error');
            }
        })
    }

    function verify(){
        var selRow = \$('#listdata').datagrid('getSelected');
        if (!selRow) {
            \$.messager.alert('错误','请选择一个话题');
            return false;
        }
        if(selRow.status != 0){
            \$.messager.alert('错误','请选择待审核话题');
            return false;
        }
        \$('#dlg_verify').window('open');
    }

    function del(){
        var selRow = \$('#listdata').datagrid('getSelected');
        if (!selRow) {
            \$.messager.alert('错误','请选择一个话题');
            return false;
        }

        \$.messager.confirm('Confirm', '确定删除该帖子吗？，删除后该贴子下的回帖也会一起删除', function(r) {
            if (r) {
                \$.post(\"";
        // line 156
        echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url("group/del-topic"), "html", null, true);
        echo "\", {'id':selRow.id}, function(data) {
                    if (data.error) {
                        \$.messager.alert('错误', data.message, 'error');
                    } else {
                        \$.messager.alert('成功', data.message);
                        setTimeout(function(){location.reload();}, 2000);
                    }
                }, 'json');
            }
        });
    }

    function edit(){
        var selRow = \$('#listdata').datagrid('getSelected');
        if (!selRow) {
            \$.messager.alert('错误','请选择一个话题');
            return false;
        }
        \$('#topic-info').prop('src',  '/group/topic-edit?id=' + selRow.id);
        \$('#dlg_content').window('open');
    }

    function formatUsername(val, row){
        result = '';
        if (row.phone) {
            result += '昵称：' + row.nickname + '<br/>';
        }
        if (row.phone) {
            result += '手机号：' + row.phone + '<br/>';
        }
        if (row.email) {
            result += '邮箱：' + row.email;
        }

        return result;
    }
    function formatTop(val, row){
        if(val == 0) return '未置顶';
        else return '已置顶';
    }
    function formatDigest(val, row){
        if(val == 0) return '未加精';
        else return '已加精';
    }
    function formatVerify(val, row){
        if(val == 1) return '已通过';
        else if(val == 2) return '<span style=\"color:dodgerblue\">未通过</span>';
        else if(val == 0) return '<span style=\"color:red\">待审核</span>'
    }
</script>
";
    }

    public function getTemplateName()
    {
        return "topic.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  208 => 156,  143 => 95,  140 => 94,  107 => 63,  103 => 61,  100 => 60,  95 => 57,  92 => 56,  88 => 54,  86 => 53,  63 => 33,  32 => 4,  29 => 3,  11 => 1,);
    }
}
/* {% extends '@app/views/base.html' %}*/
/* */
/* {% block main %}*/
/* <div class="search">*/
/*     <span>加精*/
/*         <select class="easyui-combobox" id="digest" name="digest" data-options="required:true, panelHeight:'auto'">*/
/*             <option value="2">全部</option>*/
/*             <option value="1">已加精</option>*/
/*             <option value="0">未加精</option>*/
/*         </select>*/
/*     </span>*/
/*     <span>今日话题*/
/*         <select class="easyui-combobox" id="today" name="today" data-options="required:true, panelHeight:'auto'">*/
/*             <option value="0">全部</option>*/
/*             <option value="1">今日</option>*/
/*         </select>*/
/*     </span>*/
/*     <span>审核状态*/
/*         <select class="easyui-combobox" id="verify_status" name="status" data-options="required:true, panelHeight:'auto'">*/
/*             <option value="3">全部</option>*/
/*             <option value="0">待审核</option>*/
/*             <option value="1">已通过</option>*/
/*             <option value="2">未通过</option>*/
/*         </select>*/
/*     </span>*/
/*     <span>*/
/*         <input class="easyui-datetimebox" style="width:200px" name="startTime" id="startTime"> 到*/
/*         <input class="easyui-datetimebox" style="width:200px" name="endTime" id="endTime">*/
/*     </span>*/
/*     <a href="javascript:void(0);" onclick="reloadgrid();" class="easyui-linkbutton" iconCls="icon-search">搜索</a>*/
/* </div>*/
/* */
/* <table id="listdata"  class="easyui-datagrid" title="话题列表" data-options="toolbar:'#tb-user',singleSelect:true,pagination:true,method:'get',url:'{{  url('group/topic')}}'">*/
/*     <thead>*/
/*     <tr>*/
/*         <th data-options="field:'id', width:50, align:'center'">ID</th>*/
/*         <th data-options="field:'subject', width:300, align:'center'">标题</th>*/
/*         <th data-options="field:'username', width:200, align:'center'" formatter="formatUsername">用户</th>*/
/*         <th data-options="field:'group_id', width:100, align:'center'">所属圈子</th>*/
/*         <th data-options="field:'view_count', width:50, align:'center'">浏览次数</th>*/
/*         <th data-options="field:'comment_count', width:50, align:'center'">回复次数</th>*/
/*         <th data-options="field:'top', width:100, align:'center'" formatter="formatTop">是否置顶</th>*/
/*         <th data-options="field:'digest', width:100, align:'center'" formatter="formatDigest">是否精华</th>*/
/*         <th data-options="field:'status', width:100, align:'center'" formatter="formatVerify">是否审核</th>*/
/*         <th data-options="field:'created_at', width:150, align:'center'">创建时间</th>*/
/*     </tr>*/
/*     </thead>*/
/* </table>*/
/* */
/* <div id="tb-user" style="height:auto">*/
/*     <div>*/
/*         <a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-view',plain:true" onclick="view()">查看内容</a>*/
/*         {% if(edit == 1) %}*/
/*         <a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-edit',plain:true" onclick="edit()">编辑</a>*/
/*         {% endif %}*/
/*         {% if(verify == 1) %}*/
/*         <a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-edit',plain:true"*/
/*            onclick="verify()">审核</a>*/
/*         {% endif %}*/
/*         {% if(del_topic == 1) %}*/
/*         <a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-cancel',plain:true" onclick="del()">删除</a>*/
/*         {% endif %}*/
/*     </div>*/
/* </div>*/
/* */
/* <div id="dlg_content" class="easyui-window" title="编辑话题" data-options="closed:true,modal:true" style="width:860px;height:700px;padding:10px">*/
/*     <iframe id="topic-info" frameborder="0" style="width:840px;height:690px" scrolling="no"></iframe>*/
/* </div>*/
/* */
/* <div id="dlg_con" class="easyui-window" title="话题内容" data-options="closed:true,modal:true" style="width:760px;height:590px;padding:10px">*/
/*     <div id="content"></div>*/
/* </div>*/
/* */
/* <div id="dlg_verify" class="easyui-window" title="审核" data-options="closed:true,modal:true" style="width:400px;height:200px;padding:10px" >*/
/*     <table cellpadding="5">*/
/*         <tr>*/
/*             <td style="width: 100px">审核</td>*/
/*             <td>*/
/*                 <select class="easyui-combobox" name="status" id="status" data-options="panelHeight:'auto'">*/
/*                     <option value="1">通过</option>*/
/*                     <option value="2">不通过</option>*/
/*                 </select>*/
/*             </td>*/
/*         </tr>*/
/*     </table>*/
/*     <div style="text-align:center;padding:5px;margin-top:20px;">*/
/*         <a class="easyui-linkbutton" iconCls="icon-ok" onclick="save()">确定</a>*/
/*         <a class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg_verify').dialog('close')">取消</a>*/
/*     </div>*/
/* </div>*/
/* */
/* {% endblock %}*/
/* */
/* {% block js %}*/
/* <script charset="utf-8" src="{{ app.params.skinUrl }}/js/kindeditor-4.1.10/kindeditor-all-min.js"></script>*/
/* <script>*/
/*     function reloadgrid(){*/
/*         var queryParams = $('#listdata').datagrid('options').queryParams;*/
/*         queryParams.digest	= $('#digest').combobox("getValue");*/
/*         queryParams.today = $('#today').combobox("getValue");*/
/*         queryParams.start = $('#startTime').datetimebox('getValue');*/
/*         queryParams.end = $('#endTime').datetimebox('getValue');*/
/*         queryParams.status = $('#verify_status').combobox("getValue");*/
/*         $('#listdata').datagrid('options').queryParams = queryParams;*/
/*         $("#listdata").datagrid('reload');*/
/*     }*/
/* */
/*     function view(){*/
/*         var selRow = $('#listdata').datagrid('getSelected');*/
/*         if (!selRow) {*/
/*             $.messager.alert('错误','请选择一个话题');*/
/*             return false;*/
/*         }*/
/* */
/*         $.post('/group/topic-mess', {'id':selRow.id}, function(data){*/
/*             $('#content').html(data);*/
/*             $('#dlg_con').window('open');*/
/*         })*/
/*     }*/
/* */
/*     function save(){*/
/*         var selRow = $('#listdata').datagrid('getSelected');*/
/*         var status = $('#status').combobox('getValue');*/
/*         $.get('/group/verify', {'id':selRow.id, 'status':status}, function(data){*/
/*             if (data == 1) {*/
/*                 $.messager.alert('成功', '审核成功');*/
/*                 setTimeout(function(){location.reload();}, 2000);*/
/*             } else {*/
/*                 $.messager.alert('错误', '审核失败', 'error');*/
/*             }*/
/*         })*/
/*     }*/
/* */
/*     function verify(){*/
/*         var selRow = $('#listdata').datagrid('getSelected');*/
/*         if (!selRow) {*/
/*             $.messager.alert('错误','请选择一个话题');*/
/*             return false;*/
/*         }*/
/*         if(selRow.status != 0){*/
/*             $.messager.alert('错误','请选择待审核话题');*/
/*             return false;*/
/*         }*/
/*         $('#dlg_verify').window('open');*/
/*     }*/
/* */
/*     function del(){*/
/*         var selRow = $('#listdata').datagrid('getSelected');*/
/*         if (!selRow) {*/
/*             $.messager.alert('错误','请选择一个话题');*/
/*             return false;*/
/*         }*/
/* */
/*         $.messager.confirm('Confirm', '确定删除该帖子吗？，删除后该贴子下的回帖也会一起删除', function(r) {*/
/*             if (r) {*/
/*                 $.post("{{ url('group/del-topic') }}", {'id':selRow.id}, function(data) {*/
/*                     if (data.error) {*/
/*                         $.messager.alert('错误', data.message, 'error');*/
/*                     } else {*/
/*                         $.messager.alert('成功', data.message);*/
/*                         setTimeout(function(){location.reload();}, 2000);*/
/*                     }*/
/*                 }, 'json');*/
/*             }*/
/*         });*/
/*     }*/
/* */
/*     function edit(){*/
/*         var selRow = $('#listdata').datagrid('getSelected');*/
/*         if (!selRow) {*/
/*             $.messager.alert('错误','请选择一个话题');*/
/*             return false;*/
/*         }*/
/*         $('#topic-info').prop('src',  '/group/topic-edit?id=' + selRow.id);*/
/*         $('#dlg_content').window('open');*/
/*     }*/
/* */
/*     function formatUsername(val, row){*/
/*         result = '';*/
/*         if (row.phone) {*/
/*             result += '昵称：' + row.nickname + '<br/>';*/
/*         }*/
/*         if (row.phone) {*/
/*             result += '手机号：' + row.phone + '<br/>';*/
/*         }*/
/*         if (row.email) {*/
/*             result += '邮箱：' + row.email;*/
/*         }*/
/* */
/*         return result;*/
/*     }*/
/*     function formatTop(val, row){*/
/*         if(val == 0) return '未置顶';*/
/*         else return '已置顶';*/
/*     }*/
/*     function formatDigest(val, row){*/
/*         if(val == 0) return '未加精';*/
/*         else return '已加精';*/
/*     }*/
/*     function formatVerify(val, row){*/
/*         if(val == 1) return '已通过';*/
/*         else if(val == 2) return '<span style="color:dodgerblue">未通过</span>';*/
/*         else if(val == 0) return '<span style="color:red">待审核</span>'*/
/*     }*/
/* </script>*/
/* {% endblock %}*/
