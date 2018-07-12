<?php

/* allcomment.html */
class __TwigTemplate_f0a80b30fc84aeede8daa9e1a09ed1a7538f801f3ed7e018a7573038d4c5d48f extends yii\twig\Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("@app/views/base.html", "allcomment.html", 1);
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
    <span>评论时间
        <input class=\"easyui-datetimebox\" style=\"width:200px\" name=\"startTime\" id=\"startTime\"> 到
        <input class=\"easyui-datetimebox\" style=\"width:200px\" name=\"endTime\" id=\"endTime\">
    </span>
    <span>用户<input class=\"easyui-textbox\" type=\"text\" name=\"account\" id=\"account\"></span>
    <span>状态
        <select class=\"easyui-combobox\" id=\"status\" name=\"status\" data-options=\"required:true, panelHeight:'auto'\">
            <option value=\"all\">所有</option>
            <option value=\"0\">未通过</option>
            <option value=\"1\">通过</option>
        </select>
    </span>&nbsp;
    <a href=\"javascript:void(0);\" onclick=\"reloadgrid();\" class=\"easyui-linkbutton\" iconCls=\"icon-search\">搜索</a>
</div>

<table id=\"listdata\" class=\"easyui-datagrid\" title=\"评论列表\" data-options=\"toolbar:'#tb-user',singleSelect:false,pagination:true,method:'get',url:'";
        // line 21
        echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url("share/all-comment"), "html", null, true);
        echo "',nowrap:false,pageSize:20\">
    <thead>
    <tr>
        <th data-options=\"field:'ck', checkbox: true\">
        <th data-options=\"field:'id', width:80, align:'center'\">ID</th>
        <th data-options=\"field:'name', width:150, align:'center'\" formatter=\"formatName\">会员名</th>
        <th data-options=\"field:'content', width:450, align:'center'\">评论内容</th>
        <th data-options=\"field:'reply_num', width:100, align:'center'\" formatter=\"formatReply\">回复次数</th>
        <th data-options=\"field:'status', width:100, align:'center'\" formatter=\"formatStatus\">审核状态</th>
        <th data-options=\"field:'created_at', width:200, align:'center'\" formatter=\"formatTime\">评论时间</th>
    </tr>
    </thead>
</table>
<div id=\"tb-user\" style=\"height:auto\">
    <div>
        <a href=\"javascript:void(0)\" class=\"easyui-linkbutton\" data-options=\"iconCls:'icon-tip',plain:true\" onclick=\"reply()\">回复</a>
        <a href=\"javascript:void(0)\" class=\"easyui-linkbutton\" data-options=\"iconCls:'icon-no',plain:true\" onclick=\"del()\">删除</a>
        <a href=\"javascript:void(0)\" class=\"easyui-linkbutton\" data-options=\"iconCls:'icon-redo',plain:true\" onclick=\"approve()\">批量审核</a>
    </div>
</div>

<div id=\"dlg-reply-list\" class=\"easyui-window\" title=\"回复列表\" style=\"width:1098px;height:700px;padding:10px;overflow:hidden;\" data-options=\"
            iconCls:'icon-save',
            closed:true,
            modal:true,
            onClose: onClose,
            onResize:function(){
                \$(this).window('hcenter');
            }\">
    <iframe width=\"100%\" height=\"100%\" frameborder=\"0\" id=\"reply_list_iframe\"></iframe>
</div>

<div id=\"dlg-reply\" class=\"easyui-window\" title=\"回复\" style=\"width:830px;height:230px;padding:10px;overflow:hidden;\" data-options=\"
            iconCls:'icon-save',
            closed:true,
            modal:true,
            onClose: onClose,
            onResize:function(){
                \$(this).window('hcenter');
            }\">
    <textarea id=\"editor\"></textarea>
</div>

";
    }

    // line 66
    public function block_js($context, array $blocks = array())
    {
        // line 67
        echo "<script src=\"";
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "params", array()), "skinUrl", array()), "html", null, true);
        echo "/js/keditor/kindeditor-min.js\" type=\"text/javascript\"></script>
<script src=\"";
        // line 68
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "params", array()), "skinUrl", array()), "html", null, true);
        echo "/js/keditor/lang/zh_CN.js\" type=\"text/javascript\"></script>
<script>
    function reloadgrid(){
        var queryParams = \$('#listdata').datagrid('options').queryParams;
        queryParams.startTime = \$('#startTime').datetimebox('getValue');
        queryParams.endTime\t= \$('#endTime').datetimebox('getValue');
        queryParams.account = \$('#account').val();
        queryParams.status = \$('#status').combobox('getValue');
        \$('#listdata').datagrid('options').queryParams = queryParams;
        \$(\"#listdata\").datagrid('reload');
    }

    function formatReply(val, row) {
        if (row.new_tips) {
            return '<span style=\"color:red\">' + val + '</span>';
        } else {
            return val;
        }
    }

    function formatStatus(val, row) {
        if (val == 1) {
            return '通过';
        } else {
            return '未通过';
        }
    }

    \$('#listdata').datagrid({
        onClickCell: function(index,field,value){
            if (field === 'reply_num') {
                \$('#listdata').datagrid('selectRow', index);
                var row = \$('#listdata').datagrid('getSelected');
                \$('#reply_list_iframe').prop('src', \"";
        // line 101
        echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url("share/reply-list"), "html", null, true);
        echo "\" + '?id=' + row.id);
                \$('#dlg-reply-list').window('open');
            } else if (field === 'status') {
                \$('#listdata').datagrid('selectRow', index);
                var selRow = \$('#listdata').datagrid('getSelected');
                \$.messager.confirm('Confirm', value == 1 ? '确认审核不通过吗？' : '确认审核通过吗？', function(r) {
                    if (r) {
                        \$.post(\"";
        // line 108
        echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url("share/approve-comment"), "html", null, true);
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

    function onClose() {
        \$('#reply_list_iframe').prop('src', '');
    }

    var content = '';

    function reply() {
        var selRow = \$('#listdata').datagrid('getSelected');
        if (!selRow) {
            \$.messager.alert('错误','请选择一行');
            return false;
        }
        var editor = KindEditor.create('#editor', {
            resizeType : 0,
            allowPreviewEmoticons : true,
            allowImageUpload : false,
            items : ['emoticons'],
            themeType : 'simple',
            pasteType : 1,
            width : '750px',
            height : '130px',
            afterChange : function(){
                var textNum = this.count('text');
                if (textNum > 150) {
                    \$('#edit-submit').addClass('dis');
                    KindEditor('#edit-count').html('<span>已超过' + (textNum - 150) + '个字了，请适当删除部分内容</span>');
                }else{
                    \$('#edit-submit').removeClass();
                    KindEditor('#edit-count').html('<span>' + this.count('text') + '</span>/150');
                    content = this.text();
                }
            },
            layout: '<div class=\"container\"><i><em></em></i><div class=\"edit\"></div><div class=\"toolbar\"></div><div class=\"edit-info\"><div id=\"edit-count\">0/150</div><a href=\"javascript:;\" id=\"edit-submit\" onclick=\"commit()\">提交</a></div><div class=\"statusbar\"></div></div>'
        });
        \$('#dlg-reply').window('open');
    }

    function commit() {
        var row = \$('#listdata').datagrid('getSelected');
        \$.post('/share/comment-reply', {share_comment_id: row.id, content: filterContent(content), user_id: 4}, function(data) {
            if (data.error) {
                \$.messager.alert('错误', data.message, 'error');
            } else {
                \$.messager.alert('成功', data.message);
                window.location.reload();
            }
        });
    }

    function filterContent(content){
        content = content.replace(/\\r\\n/ig, \"\").replace(/\\r/ig, \"\").replace(/\\n/ig, \"\").replace(/<br[^>]*>/ig, \"[br]\").replace(/<img[^>]*src=\\\"[\\w:\\.\\/]+\\/([\\d]{1,2})\\.gif\\\"[^>]*>/ig, \"[s:\$1]\").replace(/<a[^>]*href=[\\'\\\"\\s]?([^\\s\\'\\\"]*)[^>]*>(.+?)<\\/a>/ig, \"[url=\$1]\$2[/url]\").replace(/<[^>]*?>/ig, \"\").replace(/&nbsp;/ig, \" \").replace(/&amp;/ig, \"&\").replace(/&lt;/ig, \"<\").replace(/&gt;/ig, \">\")

        return content;
    }

    function del() {
        var selRow = \$('#listdata').treegrid('getSelections');
        if (selRow.length == 0) {
            \$.messager.alert('错误','请选择评论');
            return false;
        }

        var ids = new Array();
        \$.each(selRow, function(i, v) {
            ids.push(v.id);
        });
        id = ids.join(',');

        \$.messager.confirm('Confirm', '确认删除吗?', function(r) {
            if (r) {
                \$.get(\"";
        // line 192
        echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url("share/delete-comment"), "html", null, true);
        echo "\", {id:id}, function(data) {
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

    function approve() {
        var selRow = \$('#listdata').treegrid('getSelections');
        if (selRow.length == 0) {
            \$.messager.alert('错误','请选择评论');
            return false;
        }

        var ids = new Array();
        \$.each(selRow, function(i, v) {
            ids.push(v.id);
        });
        id = ids.join(',');

        \$.messager.confirm('Confirm', '您确定批量审核吗？', function(r) {
            if (r) {
                \$.post(\"";
        // line 219
        echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url("share/approve-comment"), "html", null, true);
        echo "\", {id: id}, function(data) {
                    if (data.error == 0) {
                        \$.messager.alert('成功', data.message);
                        reloadgrid();
                    } else {
                        \$.messager.alert('失败', data.message, 'error');
                    }
                })
            }
        });
    }

</script>
";
    }

    public function getTemplateName()
    {
        return "allcomment.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  270 => 219,  240 => 192,  153 => 108,  143 => 101,  107 => 68,  102 => 67,  99 => 66,  51 => 21,  32 => 4,  29 => 3,  11 => 1,);
    }
}
/* {% extends '@app/views/base.html' %}*/
/* */
/* {% block main %}*/
/* */
/* <div class="search">*/
/*     <span>评论时间*/
/*         <input class="easyui-datetimebox" style="width:200px" name="startTime" id="startTime"> 到*/
/*         <input class="easyui-datetimebox" style="width:200px" name="endTime" id="endTime">*/
/*     </span>*/
/*     <span>用户<input class="easyui-textbox" type="text" name="account" id="account"></span>*/
/*     <span>状态*/
/*         <select class="easyui-combobox" id="status" name="status" data-options="required:true, panelHeight:'auto'">*/
/*             <option value="all">所有</option>*/
/*             <option value="0">未通过</option>*/
/*             <option value="1">通过</option>*/
/*         </select>*/
/*     </span>&nbsp;*/
/*     <a href="javascript:void(0);" onclick="reloadgrid();" class="easyui-linkbutton" iconCls="icon-search">搜索</a>*/
/* </div>*/
/* */
/* <table id="listdata" class="easyui-datagrid" title="评论列表" data-options="toolbar:'#tb-user',singleSelect:false,pagination:true,method:'get',url:'{{ url('share/all-comment')}}',nowrap:false,pageSize:20">*/
/*     <thead>*/
/*     <tr>*/
/*         <th data-options="field:'ck', checkbox: true">*/
/*         <th data-options="field:'id', width:80, align:'center'">ID</th>*/
/*         <th data-options="field:'name', width:150, align:'center'" formatter="formatName">会员名</th>*/
/*         <th data-options="field:'content', width:450, align:'center'">评论内容</th>*/
/*         <th data-options="field:'reply_num', width:100, align:'center'" formatter="formatReply">回复次数</th>*/
/*         <th data-options="field:'status', width:100, align:'center'" formatter="formatStatus">审核状态</th>*/
/*         <th data-options="field:'created_at', width:200, align:'center'" formatter="formatTime">评论时间</th>*/
/*     </tr>*/
/*     </thead>*/
/* </table>*/
/* <div id="tb-user" style="height:auto">*/
/*     <div>*/
/*         <a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-tip',plain:true" onclick="reply()">回复</a>*/
/*         <a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-no',plain:true" onclick="del()">删除</a>*/
/*         <a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-redo',plain:true" onclick="approve()">批量审核</a>*/
/*     </div>*/
/* </div>*/
/* */
/* <div id="dlg-reply-list" class="easyui-window" title="回复列表" style="width:1098px;height:700px;padding:10px;overflow:hidden;" data-options="*/
/*             iconCls:'icon-save',*/
/*             closed:true,*/
/*             modal:true,*/
/*             onClose: onClose,*/
/*             onResize:function(){*/
/*                 $(this).window('hcenter');*/
/*             }">*/
/*     <iframe width="100%" height="100%" frameborder="0" id="reply_list_iframe"></iframe>*/
/* </div>*/
/* */
/* <div id="dlg-reply" class="easyui-window" title="回复" style="width:830px;height:230px;padding:10px;overflow:hidden;" data-options="*/
/*             iconCls:'icon-save',*/
/*             closed:true,*/
/*             modal:true,*/
/*             onClose: onClose,*/
/*             onResize:function(){*/
/*                 $(this).window('hcenter');*/
/*             }">*/
/*     <textarea id="editor"></textarea>*/
/* </div>*/
/* */
/* {% endblock %}*/
/* */
/* {% block js %}*/
/* <script src="{{ app.params.skinUrl }}/js/keditor/kindeditor-min.js" type="text/javascript"></script>*/
/* <script src="{{ app.params.skinUrl }}/js/keditor/lang/zh_CN.js" type="text/javascript"></script>*/
/* <script>*/
/*     function reloadgrid(){*/
/*         var queryParams = $('#listdata').datagrid('options').queryParams;*/
/*         queryParams.startTime = $('#startTime').datetimebox('getValue');*/
/*         queryParams.endTime	= $('#endTime').datetimebox('getValue');*/
/*         queryParams.account = $('#account').val();*/
/*         queryParams.status = $('#status').combobox('getValue');*/
/*         $('#listdata').datagrid('options').queryParams = queryParams;*/
/*         $("#listdata").datagrid('reload');*/
/*     }*/
/* */
/*     function formatReply(val, row) {*/
/*         if (row.new_tips) {*/
/*             return '<span style="color:red">' + val + '</span>';*/
/*         } else {*/
/*             return val;*/
/*         }*/
/*     }*/
/* */
/*     function formatStatus(val, row) {*/
/*         if (val == 1) {*/
/*             return '通过';*/
/*         } else {*/
/*             return '未通过';*/
/*         }*/
/*     }*/
/* */
/*     $('#listdata').datagrid({*/
/*         onClickCell: function(index,field,value){*/
/*             if (field === 'reply_num') {*/
/*                 $('#listdata').datagrid('selectRow', index);*/
/*                 var row = $('#listdata').datagrid('getSelected');*/
/*                 $('#reply_list_iframe').prop('src', "{{ url('share/reply-list') }}" + '?id=' + row.id);*/
/*                 $('#dlg-reply-list').window('open');*/
/*             } else if (field === 'status') {*/
/*                 $('#listdata').datagrid('selectRow', index);*/
/*                 var selRow = $('#listdata').datagrid('getSelected');*/
/*                 $.messager.confirm('Confirm', value == 1 ? '确认审核不通过吗？' : '确认审核通过吗？', function(r) {*/
/*                     if (r) {*/
/*                         $.post("{{ url('share/approve-comment') }}", {'id':selRow.id}, function(data) {*/
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
/*     function onClose() {*/
/*         $('#reply_list_iframe').prop('src', '');*/
/*     }*/
/* */
/*     var content = '';*/
/* */
/*     function reply() {*/
/*         var selRow = $('#listdata').datagrid('getSelected');*/
/*         if (!selRow) {*/
/*             $.messager.alert('错误','请选择一行');*/
/*             return false;*/
/*         }*/
/*         var editor = KindEditor.create('#editor', {*/
/*             resizeType : 0,*/
/*             allowPreviewEmoticons : true,*/
/*             allowImageUpload : false,*/
/*             items : ['emoticons'],*/
/*             themeType : 'simple',*/
/*             pasteType : 1,*/
/*             width : '750px',*/
/*             height : '130px',*/
/*             afterChange : function(){*/
/*                 var textNum = this.count('text');*/
/*                 if (textNum > 150) {*/
/*                     $('#edit-submit').addClass('dis');*/
/*                     KindEditor('#edit-count').html('<span>已超过' + (textNum - 150) + '个字了，请适当删除部分内容</span>');*/
/*                 }else{*/
/*                     $('#edit-submit').removeClass();*/
/*                     KindEditor('#edit-count').html('<span>' + this.count('text') + '</span>/150');*/
/*                     content = this.text();*/
/*                 }*/
/*             },*/
/*             layout: '<div class="container"><i><em></em></i><div class="edit"></div><div class="toolbar"></div><div class="edit-info"><div id="edit-count">0/150</div><a href="javascript:;" id="edit-submit" onclick="commit()">提交</a></div><div class="statusbar"></div></div>'*/
/*         });*/
/*         $('#dlg-reply').window('open');*/
/*     }*/
/* */
/*     function commit() {*/
/*         var row = $('#listdata').datagrid('getSelected');*/
/*         $.post('/share/comment-reply', {share_comment_id: row.id, content: filterContent(content), user_id: 4}, function(data) {*/
/*             if (data.error) {*/
/*                 $.messager.alert('错误', data.message, 'error');*/
/*             } else {*/
/*                 $.messager.alert('成功', data.message);*/
/*                 window.location.reload();*/
/*             }*/
/*         });*/
/*     }*/
/* */
/*     function filterContent(content){*/
/*         content = content.replace(/\r\n/ig, "").replace(/\r/ig, "").replace(/\n/ig, "").replace(/<br[^>]*>/ig, "[br]").replace(/<img[^>]*src=\"[\w:\.\/]+\/([\d]{1,2})\.gif\"[^>]*>/ig, "[s:$1]").replace(/<a[^>]*href=[\'\"\s]?([^\s\'\"]*)[^>]*>(.+?)<\/a>/ig, "[url=$1]$2[/url]").replace(/<[^>]*?>/ig, "").replace(/&nbsp;/ig, " ").replace(/&amp;/ig, "&").replace(/&lt;/ig, "<").replace(/&gt;/ig, ">")*/
/* */
/*         return content;*/
/*     }*/
/* */
/*     function del() {*/
/*         var selRow = $('#listdata').treegrid('getSelections');*/
/*         if (selRow.length == 0) {*/
/*             $.messager.alert('错误','请选择评论');*/
/*             return false;*/
/*         }*/
/* */
/*         var ids = new Array();*/
/*         $.each(selRow, function(i, v) {*/
/*             ids.push(v.id);*/
/*         });*/
/*         id = ids.join(',');*/
/* */
/*         $.messager.confirm('Confirm', '确认删除吗?', function(r) {*/
/*             if (r) {*/
/*                 $.get("{{ url('share/delete-comment') }}", {id:id}, function(data) {*/
/*                     if (data.error) {*/
/*                         $.messager.alert('错误', data.message, 'error');*/
/*                     } else {*/
/*                         $.messager.alert('成功', data.message);*/
/*                         reloadgrid();*/
/*                     }*/
/*                 }, 'json');*/
/*             }*/
/*         });*/
/*     }*/
/* */
/*     function approve() {*/
/*         var selRow = $('#listdata').treegrid('getSelections');*/
/*         if (selRow.length == 0) {*/
/*             $.messager.alert('错误','请选择评论');*/
/*             return false;*/
/*         }*/
/* */
/*         var ids = new Array();*/
/*         $.each(selRow, function(i, v) {*/
/*             ids.push(v.id);*/
/*         });*/
/*         id = ids.join(',');*/
/* */
/*         $.messager.confirm('Confirm', '您确定批量审核吗？', function(r) {*/
/*             if (r) {*/
/*                 $.post("{{ url('share/approve-comment') }}", {id: id}, function(data) {*/
/*                     if (data.error == 0) {*/
/*                         $.messager.alert('成功', data.message);*/
/*                         reloadgrid();*/
/*                     } else {*/
/*                         $.messager.alert('失败', data.message, 'error');*/
/*                     }*/
/*                 })*/
/*             }*/
/*         });*/
/*     }*/
/* */
/* </script>*/
/* {% endblock %}*/
/* */
/* */
