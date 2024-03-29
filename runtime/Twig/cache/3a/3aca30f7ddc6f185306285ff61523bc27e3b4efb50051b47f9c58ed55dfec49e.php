<?php

/* index.html */
class __TwigTemplate_f17dd25b73848e67c48044ecf0e4feb9f5fb0e2efb4affbc0678fa9145f574ed extends yii\twig\Template
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
<div class=\"search\">
    <span>开始时间
        <input class=\"easyui-datetimebox\" style=\"width:200px\" name=\"startTime\" id=\"startTime\"> 到
        <input class=\"easyui-datetimebox\" style=\"width:200px\" name=\"endTime\" id=\"endTime\">
    </span>
    <span>状态
        <select name=\"is_pass\" id=\"is_pass\" class=\"easyui-combobox\" data-options=\"panelHeight:'auto'\">
            <option value=\"all\">全部</option>
            <option value=\"0\">待审核</option>
            <option value=\"2\">未通过</option>
            <option value=\"1\">完成</option>
        </select>
    </span>
    <span>推荐
        <select name=\"is_recommend\" id=\"is_recommend\" class=\"easyui-combobox\" data-options=\"panelHeight:'auto'\">
            <option value=\"all\">全部</option>
            <option value=\"1\">是</option>
            <option value=\"0\">否</option>
        </select>
    </span>
    <span>用户<input class=\"easyui-textbox\" type=\"text\" name=\"account\" id=\"account\"></span>
    <a href=\"javascript:void(0);\" onclick=\"reloadgrid();\" class=\"easyui-linkbutton\" iconCls=\"icon-search\">搜索</a>
    <a href=\"javascript:void(0);\" class=\"easyui-linkbutton\" onclick=\"dataexcel();\">导出</a>
    <a href=\"javascript:void(0);\" class=\"easyui-linkbutton\" onclick=\"switchShare(";
        // line 28
        echo twig_escape_filter($this->env, (isset($context["swtich_status"]) ? $context["swtich_status"] : null), "html", null, true);
        echo ");\">";
        if (((isset($context["swtich_status"]) ? $context["swtich_status"] : null) == 1)) {
            echo "关闭";
        } else {
            echo "打开";
        }
        echo "评论审核</a>
    <a href=\"javascript:void(0);\" class=\"easyui-linkbutton\" onclick=\"allComment()\">所有回复</a>
</div>

<table id=\"listdata\" class=\"easyui-datagrid\" title=\"晒单列表\" data-options=\"toolbar:'#tb-user',singleSelect:true,pagination:true,method:'get',url:'";
        // line 32
        echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url("share"), "html", null, true);
        echo "',pageSize:20\">
    <thead>
    <tr>
        <th data-options=\"field:'id', width:80, align:'center'\">id</th>
        <th data-options=\"field:'from', width:80, align:'center'\" formatter=\"formatFrom\">来源</th>
        <th data-options=\"field:'name', width:400, align:'center'\">商品名称</th>
        <th data-options=\"field:'period_no', width:100, align:'center'\">当前期号</th>
        <th data-options=\"field:'phone', width:100, align:'center'\">会员手机</th>
        <th data-options=\"field:'email', width:100, align:'center'\">会员邮箱</th>
        <th data-options=\"field:'point', width:80, align:'center'\">奖励福分</th>
        <th data-options=\"field:'up_num', width:100, align:'center'\">羡慕</th>
        <th data-options=\"field:'comment_num', width:100, align:'center'\" formatter=\"formatComment\">回复</th>
        <th data-options=\"field:'is_recommend',width:50, align:'center'\" formatter=\"formatRecommend\">推荐</th>
        <th data-options=\"field:'is_digest', width:50, align:'center'\" formatter=\"formatDigest\">精华</th>
        <th data-options=\"field:'is_show', width:50, align:'center'\" formatter=\"formatShow\">显示</th>
        <th data-options=\"field:'is_pass', width:100, align:'center'\" formatter=\"formatPass\">状态</th>
        <th data-options=\"field:'created_at', width:200, align:'center'\" formatter=\"formatTime\">晒单时间</th>
        <th data-options=\"field:'checked_at', width:200, align:'center'\" formatter=\"formatTime\">审核时间</th>
    </tr>
    </thead>
</table>

<div id=\"tb-user\" style=\"height:auto\">
    <div>
        <a href=\"javascript:void(0)\" class=\"easyui-linkbutton\" data-options=\"iconCls:'icon-tip',plain:true\" onclick=\"view()\">查看</a>
    </div>
</div>

<div id=\"dlg-view\" class=\"easyui-window\" title=\"晒单详情\" style=\"width:1198px;height:750px;padding:10px;overflow:hidden;\" data-options=\"
            iconCls:'icon-save',
            closed:true,
            modal:true,
            onClose: onClose,
            onResize:function(){
                \$(this).window('hcenter');
            }\">
    <iframe width=\"100%\" height=\"100%\" frameborder=\"0\" id=\"view_iframe\"></iframe>
</div>

<div id=\"dlg-comment-list\" class=\"easyui-window\" title=\"评论列表\" style=\"width:1198px;height:750px;padding:10px;overflow:hidden;\" data-options=\"
            iconCls:'icon-save',
            closed:true,
            modal:true,
            onClose: onCommentListClose,
            onResize:function(){
                \$(this).window('hcenter');
            }\">
    <iframe width=\"100%\" height=\"100%\" frameborder=\"0\" id=\"comment_list_iframe\"></iframe>
</div>

<div id=\"dlg-all-comment-list\" class=\"easyui-window\" title=\"回复列表\" style=\"width:1198px;height:750px;padding:10px;overflow:hidden;\" data-options=\"
            iconCls:'icon-save',
            closed:true,
            modal:true,
            onClose: onAllCommentListClose,
            onResize:function(){
                \$(this).window('hcenter');
            }\">
    <iframe width=\"100%\" height=\"100%\" frameborder=\"0\" id=\"all_comment_list_iframe\"></iframe>
</div>

";
    }

    // line 95
    public function block_js($context, array $blocks = array())
    {
        // line 96
        echo "<script>
    function dataexcel(){
        var start_time = \$('#start_time').val();
        var end_time = \$('#end_time').val();
        var is_pass = \$('#is_pass').combobox('getValue');
        var is_recommend = \$('#is_recommend').combobox('getValue');
        var account = \$('#account').val();
        window.location.href=\"/share/index?excel=share&start_time=\"+start_time+'&end_time='+end_time+'&is_pass='+is_pass+'&is_recommend='+is_recommend+'&account='+account;
    }

    function reloadgrid(){
        var queryParams = \$('#listdata').datagrid('options').queryParams;
        queryParams.startTime = \$('#startTime').datetimebox('getValue');
        queryParams.endTime\t= \$('#endTime').datetimebox('getValue');
        queryParams.is_pass = \$('#is_pass').combobox('getValue');
        queryParams.is_recommend = \$('#is_recommend').combobox('getValue');
        queryParams.account = \$('#account').val();
        \$('#listdata').datagrid('options').queryParams = queryParams;
        \$(\"#listdata\").datagrid('reload');
    }

    \$('#listdata').datagrid({
        onClickCell: function(index,field,value){
            if (field === 'comment_num') {
                \$('#listdata').datagrid('selectRow', index);
                var selRow = \$('#listdata').datagrid('getSelected');
                \$('#comment_list_iframe').prop('src', \"";
        // line 122
        echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url("share/comment-list"), "html", null, true);
        echo "\" + '?id=' + selRow.id);
                \$('#dlg-comment-list').window('open');
            } else if (field === 'is_recommend') {
                \$('#listdata').datagrid('selectRow', index);
                var selRow = \$('#listdata').datagrid('getSelected');
                \$.messager.confirm('Confirm', value == 1 ? '确认取消推荐吗？' : '确认推荐吗？', function(r) {
                    if (r) {
                        \$.get(\"";
        // line 129
        echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url("share/set-recommend"), "html", null, true);
        echo "\", {'id':selRow.id}, function(data) {
                            if (data.error) {
                                \$.messager.alert('错误', data.message, 'error');
                            } else {
                                \$.messager.alert('成功', data.message);
                                reloadgrid();
                            }
                        }, 'json');
                    }
                });
            } else if (field === 'is_digest') {
                \$('#listdata').datagrid('selectRow', index);
                var selRow = \$('#listdata').datagrid('getSelected');
                \$.messager.confirm('Confirm', value == 1 ? '确认取消精华吗？' : '确认精华吗？', function(r) {
                    if (r) {
                        \$.get(\"";
        // line 144
        echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url("share/set-digest"), "html", null, true);
        echo "\", {'id':selRow.id}, function(data) {
                            if (data.error) {
                                \$.messager.alert('错误', data.message, 'error');
                            } else {
                                \$.messager.alert('成功', data.message);
                                reloadgrid();
                            }
                        }, 'json');
                    }
                });
            } else if (field === 'is_show') {
                \$('#listdata').datagrid('selectRow', index);
                var selRow = \$('#listdata').datagrid('getSelected');
                \$.messager.confirm('Confirm', value == 1 ? '确认隐藏吗？' : '确认显示吗？', function(r) {
                    if (r) {
                        \$.get(\"";
        // line 159
        echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url("share/set-show"), "html", null, true);
        echo "\", {'id':selRow.id}, function(data) {
                            if (data.error) {
                                \$.messager.alert('错误', data.message, 'error');
                            } else {
                                \$.messager.alert('成功', data.message);
                                reloadgrid();
                            }
                        }, 'json');
                    }
                });
            }
        }
    });

    function formatFrom(val, row) {
        if (val==1) {
            return '伙购网';
        } else if (val==2) {
            return '滴滴夺宝';
        }
    }

    function formatRecommend(val, row){
        if (val == 0) {
            return '否';
        } else {
            return '<span style=\"color:red\">是</span>';
        }
    }

    function formatDigest(val, row){
        if (val == 0) {
            return '否';
        } else {
            return '<span style=\"color:red\">是</span>';
        }
    }

    function formatShow(val, row){
        if (val == 0) {
            return '否';
        } else {
            return '<span style=\"color:red\">是</span>';
        }
    }

    function formatPass(val, row){
        if (val == 0) {
            return '<span style=\"color:red\">待审核</span>';
        } else if(val == 1) {
            return '已完成';
        }else if(val == 2){
            return '未通过';
        }
    }

    function formatComment(val, row) {
        if (row.new_tips) {
            return '<span style=\"color:red\">' + val + '</span>';
        } else {
            return val;
        }
    }

    function view() {
        var selRow = \$('#listdata').datagrid('getSelected');
        if (!selRow) {
            \$.messager.alert('错误','请选择一行');
            return false;
        }

        \$('#view_iframe').prop('src', \"";
        // line 230
        echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url("share/view"), "html", null, true);
        echo "\" + '?id=' + selRow.id);
        \$('#dlg-view').window('open');
    }

    function onClose() {
        \$('#view_iframe').prop('src', '');
    }

    function onCommentListClose() {
        \$('#comment_list_iframe').prop('src', '');
    }

    function onAllCommentListClose() {
        \$('#all_comment_list_iframe').prop('src', '');
    }

    function allComment() {
        \$('#all_comment_list_iframe').prop('src', \"";
        // line 247
        echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url("share/all-comment"), "html", null, true);
        echo "\");
        \$('#dlg-all-comment-list').window('open');
    }

    function switchShare(status) {
        \$.messager.confirm('Confirm', status == 1 ? '确认关闭吗？' : '确认打开吗？', function(r) {
            if (r) {
                \$.get(\"";
        // line 254
        echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url("share/switch"), "html", null, true);
        echo "\", function(data) {
                    if (data.error) {
                        \$.messager.alert('错误', data.message, 'error');
                    } else {
                        \$.messager.alert('成功', data.message);
                        window.location.reload();
                    }
                }, 'json');
            }
        });
    }

    function closeDigView()
    {
        \$('#dlg-view').window('close');
    }
    function formatTime(val, row) {
        var newDate_attend = new Date();
        newDate_attend.setTime(val * 1000);
        var my_create_time_attend=newDate_attend.format('yyyy-MM-dd hh:mm:ss');
        return my_create_time_attend;
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
        return array (  318 => 254,  308 => 247,  288 => 230,  214 => 159,  196 => 144,  178 => 129,  168 => 122,  140 => 96,  137 => 95,  71 => 32,  58 => 28,  32 => 4,  29 => 3,  11 => 1,);
    }
}
/* {% extends '@app/views/base.html' %}*/
/* */
/* {% block main %}*/
/* */
/* <div class="search">*/
/*     <span>开始时间*/
/*         <input class="easyui-datetimebox" style="width:200px" name="startTime" id="startTime"> 到*/
/*         <input class="easyui-datetimebox" style="width:200px" name="endTime" id="endTime">*/
/*     </span>*/
/*     <span>状态*/
/*         <select name="is_pass" id="is_pass" class="easyui-combobox" data-options="panelHeight:'auto'">*/
/*             <option value="all">全部</option>*/
/*             <option value="0">待审核</option>*/
/*             <option value="2">未通过</option>*/
/*             <option value="1">完成</option>*/
/*         </select>*/
/*     </span>*/
/*     <span>推荐*/
/*         <select name="is_recommend" id="is_recommend" class="easyui-combobox" data-options="panelHeight:'auto'">*/
/*             <option value="all">全部</option>*/
/*             <option value="1">是</option>*/
/*             <option value="0">否</option>*/
/*         </select>*/
/*     </span>*/
/*     <span>用户<input class="easyui-textbox" type="text" name="account" id="account"></span>*/
/*     <a href="javascript:void(0);" onclick="reloadgrid();" class="easyui-linkbutton" iconCls="icon-search">搜索</a>*/
/*     <a href="javascript:void(0);" class="easyui-linkbutton" onclick="dataexcel();">导出</a>*/
/*     <a href="javascript:void(0);" class="easyui-linkbutton" onclick="switchShare({{ swtich_status }});">{% if swtich_status == 1 %}关闭{% else %}打开{%  endif %}评论审核</a>*/
/*     <a href="javascript:void(0);" class="easyui-linkbutton" onclick="allComment()">所有回复</a>*/
/* </div>*/
/* */
/* <table id="listdata" class="easyui-datagrid" title="晒单列表" data-options="toolbar:'#tb-user',singleSelect:true,pagination:true,method:'get',url:'{{  url('share')}}',pageSize:20">*/
/*     <thead>*/
/*     <tr>*/
/*         <th data-options="field:'id', width:80, align:'center'">id</th>*/
/*         <th data-options="field:'from', width:80, align:'center'" formatter="formatFrom">来源</th>*/
/*         <th data-options="field:'name', width:400, align:'center'">商品名称</th>*/
/*         <th data-options="field:'period_no', width:100, align:'center'">当前期号</th>*/
/*         <th data-options="field:'phone', width:100, align:'center'">会员手机</th>*/
/*         <th data-options="field:'email', width:100, align:'center'">会员邮箱</th>*/
/*         <th data-options="field:'point', width:80, align:'center'">奖励福分</th>*/
/*         <th data-options="field:'up_num', width:100, align:'center'">羡慕</th>*/
/*         <th data-options="field:'comment_num', width:100, align:'center'" formatter="formatComment">回复</th>*/
/*         <th data-options="field:'is_recommend',width:50, align:'center'" formatter="formatRecommend">推荐</th>*/
/*         <th data-options="field:'is_digest', width:50, align:'center'" formatter="formatDigest">精华</th>*/
/*         <th data-options="field:'is_show', width:50, align:'center'" formatter="formatShow">显示</th>*/
/*         <th data-options="field:'is_pass', width:100, align:'center'" formatter="formatPass">状态</th>*/
/*         <th data-options="field:'created_at', width:200, align:'center'" formatter="formatTime">晒单时间</th>*/
/*         <th data-options="field:'checked_at', width:200, align:'center'" formatter="formatTime">审核时间</th>*/
/*     </tr>*/
/*     </thead>*/
/* </table>*/
/* */
/* <div id="tb-user" style="height:auto">*/
/*     <div>*/
/*         <a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-tip',plain:true" onclick="view()">查看</a>*/
/*     </div>*/
/* </div>*/
/* */
/* <div id="dlg-view" class="easyui-window" title="晒单详情" style="width:1198px;height:750px;padding:10px;overflow:hidden;" data-options="*/
/*             iconCls:'icon-save',*/
/*             closed:true,*/
/*             modal:true,*/
/*             onClose: onClose,*/
/*             onResize:function(){*/
/*                 $(this).window('hcenter');*/
/*             }">*/
/*     <iframe width="100%" height="100%" frameborder="0" id="view_iframe"></iframe>*/
/* </div>*/
/* */
/* <div id="dlg-comment-list" class="easyui-window" title="评论列表" style="width:1198px;height:750px;padding:10px;overflow:hidden;" data-options="*/
/*             iconCls:'icon-save',*/
/*             closed:true,*/
/*             modal:true,*/
/*             onClose: onCommentListClose,*/
/*             onResize:function(){*/
/*                 $(this).window('hcenter');*/
/*             }">*/
/*     <iframe width="100%" height="100%" frameborder="0" id="comment_list_iframe"></iframe>*/
/* </div>*/
/* */
/* <div id="dlg-all-comment-list" class="easyui-window" title="回复列表" style="width:1198px;height:750px;padding:10px;overflow:hidden;" data-options="*/
/*             iconCls:'icon-save',*/
/*             closed:true,*/
/*             modal:true,*/
/*             onClose: onAllCommentListClose,*/
/*             onResize:function(){*/
/*                 $(this).window('hcenter');*/
/*             }">*/
/*     <iframe width="100%" height="100%" frameborder="0" id="all_comment_list_iframe"></iframe>*/
/* </div>*/
/* */
/* {% endblock %}*/
/* */
/* {% block js %}*/
/* <script>*/
/*     function dataexcel(){*/
/*         var start_time = $('#start_time').val();*/
/*         var end_time = $('#end_time').val();*/
/*         var is_pass = $('#is_pass').combobox('getValue');*/
/*         var is_recommend = $('#is_recommend').combobox('getValue');*/
/*         var account = $('#account').val();*/
/*         window.location.href="/share/index?excel=share&start_time="+start_time+'&end_time='+end_time+'&is_pass='+is_pass+'&is_recommend='+is_recommend+'&account='+account;*/
/*     }*/
/* */
/*     function reloadgrid(){*/
/*         var queryParams = $('#listdata').datagrid('options').queryParams;*/
/*         queryParams.startTime = $('#startTime').datetimebox('getValue');*/
/*         queryParams.endTime	= $('#endTime').datetimebox('getValue');*/
/*         queryParams.is_pass = $('#is_pass').combobox('getValue');*/
/*         queryParams.is_recommend = $('#is_recommend').combobox('getValue');*/
/*         queryParams.account = $('#account').val();*/
/*         $('#listdata').datagrid('options').queryParams = queryParams;*/
/*         $("#listdata").datagrid('reload');*/
/*     }*/
/* */
/*     $('#listdata').datagrid({*/
/*         onClickCell: function(index,field,value){*/
/*             if (field === 'comment_num') {*/
/*                 $('#listdata').datagrid('selectRow', index);*/
/*                 var selRow = $('#listdata').datagrid('getSelected');*/
/*                 $('#comment_list_iframe').prop('src', "{{ url('share/comment-list') }}" + '?id=' + selRow.id);*/
/*                 $('#dlg-comment-list').window('open');*/
/*             } else if (field === 'is_recommend') {*/
/*                 $('#listdata').datagrid('selectRow', index);*/
/*                 var selRow = $('#listdata').datagrid('getSelected');*/
/*                 $.messager.confirm('Confirm', value == 1 ? '确认取消推荐吗？' : '确认推荐吗？', function(r) {*/
/*                     if (r) {*/
/*                         $.get("{{ url('share/set-recommend') }}", {'id':selRow.id}, function(data) {*/
/*                             if (data.error) {*/
/*                                 $.messager.alert('错误', data.message, 'error');*/
/*                             } else {*/
/*                                 $.messager.alert('成功', data.message);*/
/*                                 reloadgrid();*/
/*                             }*/
/*                         }, 'json');*/
/*                     }*/
/*                 });*/
/*             } else if (field === 'is_digest') {*/
/*                 $('#listdata').datagrid('selectRow', index);*/
/*                 var selRow = $('#listdata').datagrid('getSelected');*/
/*                 $.messager.confirm('Confirm', value == 1 ? '确认取消精华吗？' : '确认精华吗？', function(r) {*/
/*                     if (r) {*/
/*                         $.get("{{ url('share/set-digest') }}", {'id':selRow.id}, function(data) {*/
/*                             if (data.error) {*/
/*                                 $.messager.alert('错误', data.message, 'error');*/
/*                             } else {*/
/*                                 $.messager.alert('成功', data.message);*/
/*                                 reloadgrid();*/
/*                             }*/
/*                         }, 'json');*/
/*                     }*/
/*                 });*/
/*             } else if (field === 'is_show') {*/
/*                 $('#listdata').datagrid('selectRow', index);*/
/*                 var selRow = $('#listdata').datagrid('getSelected');*/
/*                 $.messager.confirm('Confirm', value == 1 ? '确认隐藏吗？' : '确认显示吗？', function(r) {*/
/*                     if (r) {*/
/*                         $.get("{{ url('share/set-show') }}", {'id':selRow.id}, function(data) {*/
/*                             if (data.error) {*/
/*                                 $.messager.alert('错误', data.message, 'error');*/
/*                             } else {*/
/*                                 $.messager.alert('成功', data.message);*/
/*                                 reloadgrid();*/
/*                             }*/
/*                         }, 'json');*/
/*                     }*/
/*                 });*/
/*             }*/
/*         }*/
/*     });*/
/* */
/*     function formatFrom(val, row) {*/
/*         if (val==1) {*/
/*             return '伙购网';*/
/*         } else if (val==2) {*/
/*             return '滴滴夺宝';*/
/*         }*/
/*     }*/
/* */
/*     function formatRecommend(val, row){*/
/*         if (val == 0) {*/
/*             return '否';*/
/*         } else {*/
/*             return '<span style="color:red">是</span>';*/
/*         }*/
/*     }*/
/* */
/*     function formatDigest(val, row){*/
/*         if (val == 0) {*/
/*             return '否';*/
/*         } else {*/
/*             return '<span style="color:red">是</span>';*/
/*         }*/
/*     }*/
/* */
/*     function formatShow(val, row){*/
/*         if (val == 0) {*/
/*             return '否';*/
/*         } else {*/
/*             return '<span style="color:red">是</span>';*/
/*         }*/
/*     }*/
/* */
/*     function formatPass(val, row){*/
/*         if (val == 0) {*/
/*             return '<span style="color:red">待审核</span>';*/
/*         } else if(val == 1) {*/
/*             return '已完成';*/
/*         }else if(val == 2){*/
/*             return '未通过';*/
/*         }*/
/*     }*/
/* */
/*     function formatComment(val, row) {*/
/*         if (row.new_tips) {*/
/*             return '<span style="color:red">' + val + '</span>';*/
/*         } else {*/
/*             return val;*/
/*         }*/
/*     }*/
/* */
/*     function view() {*/
/*         var selRow = $('#listdata').datagrid('getSelected');*/
/*         if (!selRow) {*/
/*             $.messager.alert('错误','请选择一行');*/
/*             return false;*/
/*         }*/
/* */
/*         $('#view_iframe').prop('src', "{{ url('share/view') }}" + '?id=' + selRow.id);*/
/*         $('#dlg-view').window('open');*/
/*     }*/
/* */
/*     function onClose() {*/
/*         $('#view_iframe').prop('src', '');*/
/*     }*/
/* */
/*     function onCommentListClose() {*/
/*         $('#comment_list_iframe').prop('src', '');*/
/*     }*/
/* */
/*     function onAllCommentListClose() {*/
/*         $('#all_comment_list_iframe').prop('src', '');*/
/*     }*/
/* */
/*     function allComment() {*/
/*         $('#all_comment_list_iframe').prop('src', "{{ url('share/all-comment') }}");*/
/*         $('#dlg-all-comment-list').window('open');*/
/*     }*/
/* */
/*     function switchShare(status) {*/
/*         $.messager.confirm('Confirm', status == 1 ? '确认关闭吗？' : '确认打开吗？', function(r) {*/
/*             if (r) {*/
/*                 $.get("{{ url('share/switch') }}", function(data) {*/
/*                     if (data.error) {*/
/*                         $.messager.alert('错误', data.message, 'error');*/
/*                     } else {*/
/*                         $.messager.alert('成功', data.message);*/
/*                         window.location.reload();*/
/*                     }*/
/*                 }, 'json');*/
/*             }*/
/*         });*/
/*     }*/
/* */
/*     function closeDigView()*/
/*     {*/
/*         $('#dlg-view').window('close');*/
/*     }*/
/*     function formatTime(val, row) {*/
/*         var newDate_attend = new Date();*/
/*         newDate_attend.setTime(val * 1000);*/
/*         var my_create_time_attend=newDate_attend.format('yyyy-MM-dd hh:mm:ss');*/
/*         return my_create_time_attend;*/
/*     }*/
/* </script>*/
/* {% endblock %}*/
/* */
/* */
