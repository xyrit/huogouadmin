<?php

/* index.html */
class __TwigTemplate_cc38e2b421f38d3a5a90477fd629c7a56be6a2e22c910d9ac74ee564f70f377b extends yii\twig\Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("@app/views/base.html", "index.html", 1);
        $this->blocks = array(
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
    public function block_main($context, array $blocks = array())
    {
        // line 4
        echo "<div class=\"search\">
    <span>注册时间
        <input class=\"easyui-datetimebox\" style=\"width:200px\" name=\"startTime\" id=\"startTime\"> 到
        <input class=\"easyui-datetimebox\" style=\"width:200px\" name=\"endTime\" id=\"endTime\">
    </span>&nbsp;
    <span>状态
        <select class=\"easyui-combobox\" id=\"status\" name=\"status\" data-options=\"required:true, panelHeight:'auto'\">
            <option value=\"all\">所有</option>
            <option value=\"0\">正常</option>
            <option value=\"1\">冻结</option>
        </select>
    </span>&nbsp;
    <span>会员名/昵称 <input class=\"easyui-textbox\" type=\"text\" name=\"account\" id=\"account\"></span>&nbsp;
    <span>站点
        <select class=\"easyui-combobox\" id=\"from\" name=\"from\" data-options=\"required:true,panelHeight:'auto'\">
            <option value=\"all\">所有</option>
            <option value=\"1\">伙购网</option>
            <option value=\"2\">滴滴夺宝</option>
        </select>
    </span>
    <span>等级
        <select class=\"easyui-combobox\" id=\"level\" name=\"level\" data-options=\"required:true, panelHeight:'auto'\">
            <option value=\"all\">所有</option>
            <option value=\"1\">新兵</option>
            <option value=\"2\">少将</option>
            <option value=\"3\">中将</option>
            <option value=\"4\">上将</option>
            <option value=\"5\">大将</option>
            <option value=\"6\">元帅</option>
        </select>
    </span>&nbsp;
    <span>上级 <input class=\"easyui-textbox\" type=\"text\" name=\"superior\" id=\"superior\"></span>&nbsp;
    <a href=\"javascript:void(0);\" onclick=\"reloadgrid();\" class=\"easyui-linkbutton\" iconCls=\"icon-search\">搜索</a>
    <a href=\"javascript:void(0);\" class=\"easyui-linkbutton\" onclick=\"dataexcel();\">导出</a>
</div>

<table id=\"listdata\" class=\"easyui-datagrid\" title=\"会员列表\"
       data-options=\"toolbar:'#tb-user',singleSelect:true,pagination:true,method:'get',url:'";
        // line 41
        echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url("member/index"), "html", null, true);
        echo "',pageSize: 20\">
    <thead>
    <tr>
        <th data-options=\"field:'ck', checkbox: true\">
        <th data-options=\"field:'username', width:200, align:'center'\" formatter=\"formatName\">会员名</th>
        <th data-options=\"field:'nickname', width:120, align:'center'\">昵称</th>
        <th data-options=\"field:'money', width:100, align:'center'\">账户余额</th>
        <th data-options=\"field:'point', width:100, align:'center'\">福分余额</th>
        <th data-options=\"field:'commission', width:100, align:'center'\" formatter=\"formatCommission\">佣金余额</th>
        <th data-options=\"field:'superior', width:100, align:'center'\" formatter=\"formatSuperior\">上级</th>
        <th data-options=\"field:'invite_num', width:100, align:'center'\">邀请人数</th>
        <th data-options=\"field:'level', width:100, align:'center'\">等级</th>
        <th data-options=\"field:'total_payment', width:100, align:'center'\">消费金额</th>
        <th data-options=\"field:'total_order', width:100, align:'center'\">中奖次数</th>
        <th data-options=\"field:'status', width:100, align:'center'\" formatter=\"formatStatus\">状态</th>
        <th data-options=\"field:'reg_terminal', width:100, align:'center'\">终端</th>
        <th data-options=\"field:'reg_ip', width:100, align:'center'\">注册区域</th>
        <th data-options=\"field:'created_at', width:180\" formatter=\"formatTime\">注册时间</th>
        <th data-options=\"field:'updated_at', width:180\" formatter=\"formatTime\">最近登录时间</th>
    </tr>
    </thead>
</table>

<div id=\"tb-user\" style=\"height:auto\">
    <div>
        ";
        // line 66
        if (((isset($context["view"]) ? $context["view"] : null) == 1)) {
            // line 67
            echo "        <a href=\"javascript:void(0)\" class=\"easyui-linkbutton\" data-options=\"iconCls:'icon-add',plain:true\"
           onclick=\"view()\">查看</a>
        ";
        }
        // line 70
        echo "        ";
        if (((isset($context["edit"]) ? $context["edit"] : null) == 1)) {
            // line 71
            echo "        <a href=\"javascript:void(0)\" class=\"easyui-linkbutton\" data-options=\"iconCls:'icon-edit',plain:true\"
           onclick=\"edit()\">编辑</a>
        ";
        }
        // line 74
        echo "        ";
        if (((isset($context["status"]) ? $context["status"] : null) == 1)) {
            // line 75
            echo "        <a href=\"javascript:void(0)\" class=\"easyui-linkbutton\" data-options=\"iconCls:'icon-ok',plain:true\"
           onclick=\"status(0)\">解冻</a>
        ";
        }
        // line 78
        echo "        ";
        if (((isset($context["status"]) ? $context["status"] : null) == 1)) {
            // line 79
            echo "        <a href=\"javascript:void(0)\" class=\"easyui-linkbutton\" data-options=\"iconCls:'icon-no',plain:true\"
           onclick=\"status(1)\">冻结</a>
        ";
        }
        // line 82
        echo "        ";
        if (((isset($context["send"]) ? $context["send"] : null) == 1)) {
            // line 83
            echo "        <a href=\"javascript:void(0)\" class=\"easyui-linkbutton\" data-options=\"iconCls:'icon-redo',plain:true\"
           onclick=\"send()\">发站内信</a>
        ";
        }
        // line 86
        echo "    </div>
</div>

<!--查看会员-->
<div id=\"dlg-view\" class=\"easyui-window\" title=\"查看会员\" style=\"width:1400px;height:750px;padding:10px;\" data-options=\"
            iconCls:'icon-save',
            closed:true,
            modal:true,
            onClose: onClose,
            onResize:function(){
                \$(this).window('hcenter');
            }\">
    <iframe width=\"100%\" height=\"100%\" frameborder=\"0\" id=\"view_iframe\"></iframe>
</div>
<!--查看会员-->

<!--编辑会员-->
<div id=\"dlg-edit\" title=\"编辑会员\" class=\"easyui-dialog\" style=\"width:350px;height:auto;padding:10px 20px\" modal=\"true\"
     closed=\"true\" buttons=\"#dlg-buttons-edit\">
    ";
        // line 105
        echo $this->getAttribute((isset($context["html"]) ? $context["html"] : null), "beginForm", array(0 => "", 1 => "post", 2 => array("class" => "am-form am-form-horizontal", "id" => "editForm")), "method");
        echo "
    <table cellpadding=\"5\">
        <tr>
            <td>昵称</td>
            <td><input class=\"easyui-textbox\" type=\"text\" name=\"User[nickname]\"></td>
        </tr>
        <tr>
            <td>手机号</td>
            <td><input class=\"easyui-textbox\" type=\"text\" name=\"User[phone]\" validType=\"phone\"></td>
        </tr>
        <tr>
            <td>邮箱</td>
            <td><input class=\"easyui-textbox\" type=\"text\" name=\"User[email]\" validType=\"email\"></td>
        </tr>
        <tr>
            <td>密码</td>
            <td><input class=\"easyui-textbox\" type=\"password\" name=\"User[password]\"></td>
        </tr>
    </table>
    ";
        // line 124
        echo $this->getAttribute((isset($context["html"]) ? $context["html"] : null), "endForm", array(), "method");
        echo "
</div>

<div id=\"dlg-buttons-edit\" style=\"text-align:center;padding:5px\">
    <a class=\"easyui-linkbutton\" iconCls=\"icon-ok\" onclick=\"save('edit')\">确定</a>
    <a class=\"easyui-linkbutton\" iconCls=\"icon-cancel\" onclick=\"javascript:\$('#dlg-edit').dialog('close')\">取消</a>
</div>
<!--编辑会员-->

<!--发送站内信-->
<div id=\"dlg-send\" title=\"发送站内信\" class=\"easyui-dialog\" style=\"width:600px;height:auto;padding:10px 20px\" modal=\"true\"
     closed=\"true\" buttons=\"#dlg-buttons-send\">
    ";
        // line 136
        echo $this->getAttribute((isset($context["html"]) ? $context["html"] : null), "beginForm", array(0 => "", 1 => "post", 2 => array("class" => "am-form am-form-horizontal", "id" => "sendForm")), "method");
        echo "
    <table cellpadding=\"5\">
        <tr>
            <td>昵称</td>
            <td id=\"nickname_send\"></td>
        </tr>
        <tr>
            <td>手机号</td>
            <td id=\"phone_send\"></td>
        </tr>
        <tr>
            <td>邮箱</td>
            <td id=\"email_send\"></td>
        </tr>
        <tr>
            <td>内容</td>
            <td><textarea id=\"content\" name=\"content\" style=\"width: 400px; height: 200px\"></textarea>可输入200个字</td>
        </tr>
    </table>
    <input type=\"hidden\" name=\"id\" id=\"id\">
    ";
        // line 156
        echo $this->getAttribute((isset($context["html"]) ? $context["html"] : null), "endForm", array(), "method");
        echo "
</div>
<!--发送站内信-->
<div id=\"dlg-buttons-send\" style=\"text-align:center;padding:5px\">
    <a class=\"easyui-linkbutton\" iconCls=\"icon-ok\" onclick=\"sendMsg()\">确定</a>
    <a class=\"easyui-linkbutton\" iconCls=\"icon-cancel\" onclick=\"javascript:\$('#dlg-send').dialog('close')\">取消</a>
</div>
<!--编辑会员-->

";
    }

    // line 167
    public function block_script($context, array $blocks = array())
    {
        // line 168
        echo "<script type=\"text/javascript\">
    function reloadgrid() {
        var queryParams = \$('#listdata').datagrid('options').queryParams;
        queryParams.account = \$('#account').val();
        queryParams.startTime = \$('#startTime').datetimebox('getValue');
        queryParams.endTime = \$('#endTime').datetimebox('getValue');
        queryParams.level = \$('#level').combobox('getValue');
        queryParams.from = \$('#from').combobox('getValue');
        queryParams.superior = \$('#superior').val();
        queryParams.status = \$('#status').combobox('getValue');
        \$('#listdata').datagrid('options').queryParams = queryParams;
        \$(\"#listdata\").datagrid('reload');
    }

    //格式化
    function formatName(val, row) {
        result = '';

        if (row.phone) {
            result += '手机号：' + row.phone + '<br />';
        }
        if (row.email) {
            result += '邮箱：' + row.email;
        }

        return result;
    }
    function formatStatus(val, row) {
        if (val == 0) {
            return '正常';
        } else {
            return '冻结';
        }
    }
    function formatSuperior(val, row) {
        return val == null ? '无' : val;
    }
    function formatTime(val, row) {
        var newDate_attend = new Date();
        newDate_attend.setTime(val * 1000);
        var my_create_time_attend=newDate_attend.format('yyyy-MM-dd hh:mm:ss');
        return my_create_time_attend;
    }

    function formatCommission(val, row) {
        return val / 100;
    }

    function onClose() {
        \$('#view_tabs').find('iframe').each(function (i, v) {
            \$(this).prop('src', '');
        })
    }

    function view() {
        var selRow = \$('#listdata').datagrid('getSelections');
        if (selRow.length != 1) {
            \$.messager.alert('错误', '请选择一个会员');
            return false;
        }
        selRow = selRow[0];

        \$('#view_iframe').prop('src', \"";
        // line 230
        echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url("member/view"), "html", null, true);
        echo "\" + '?id=' + selRow.id);
        \$('#dlg-view').window('open');
    }

    function edit() {
        var selRow = \$('#listdata').datagrid('getSelections');
        if (selRow.length != 1) {
            \$.messager.alert('错误', '请选择一个会员');
            return false;
        }
        selRow = selRow[0];
        \$('#dlg-edit').form('load', {
            'User[nickname]': selRow.nickname,
            'User[phone]': selRow.phone,
            'User[email]': selRow.email,
            'User[password]': selRow.password,
        });
        \$('#dlg-edit').window('open');
    }

    function save(flag) {
        if (flag == 'edit') {
            var selRow = \$('#listdata').datagrid('getSelected');
            var url = '/member/edit?id=' + selRow.id;
            var form = 'editForm';
        }

        \$('#' + form).form({
            url: url,
            onSubmit: function () {
                return \$(this).form('enableValidation').form('validate');
            },
            success: function (data) {
                data = eval('(' + data + ')');
                if (data.error == 0) {
                    \$.messager.alert('成功', data.message);
                    //window.location.href = '/auth/index';
                    \$('#dlg-' + flag).window('close');
                    reloadgrid();
                } else {
                    \$.messager.alert('失败', data.message, 'error');
                }
            }
        });
        \$('#' + form).submit();
    }

    function status(flag) {
        var selRow = \$('#listdata').treegrid('getSelections');
        if (selRow.length == 0) {
            \$.messager.alert('错误', '请选择会员');
            return false;
        }

        var ids = new Array();
        \$.each(selRow, function (i, v) {
            ids.push(v.id);
        });
        id = ids.join(',');

        \$.messager.confirm('Confirm', '您确定' + (flag == 0 ? \"启用\" : \"冻结\") + '该账号', function (r) {
            if (r) {
                \$.post(\"";
        // line 292
        echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url("member/change-status"), "html", null, true);
        echo "\", {id: id, status: flag}, function (data) {
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

    function send() {
        var selRow = \$('#listdata').datagrid('getSelections');
        if (selRow.length != 1) {
            \$.messager.alert('错误', '请选择一个会员');
            return false;
        }
        selRow = selRow[0];
        nickname = selRow.nickname == null ? '无' : selRow.nickname;
        phone = selRow.phone == null ? '无' : selRow.phone;
        email = selRow.email == null ? '无' : selRow.email;
        \$('#content').val('');
        \$('#id').val(selRow.id);
        \$('#nickname_send').html(nickname);
        \$('#phone_send').html(phone);
        \$('#email_send').html(email);
        \$('#dlg-send').window('open');
    }

    function sendMsg() {
        \$.messager.confirm('Confirm', '确定发送站内信吗？', function (r) {
            if (r) {
                \$('#sendForm').form({
                    url: \"";
        // line 326
        echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url("member/send-message"), "html", null, true);
        echo "\",
                    onSubmit: function () {
                        if (\$('#content').val() == '') {
                            return false;
                        }
                        return true;
                    },
                    success: function (data) {
                        data = eval('(' + data + ')');
                        if (data.error == 0) {
                            \$.messager.alert('成功', data.message);
                            \$('#dlg-send').window('close');
                            reloadgrid();
                        } else {
                            \$.messager.alert('失败', data.message, 'error');
                        }
                    }
                });
                \$('#sendForm').submit();
            }
        });
    }

    function dataexcel() {
        var account = \$('#account').val();
        var startTime = \$('#startTime').datetimebox('getValue');
        var endTime = \$('#endTime').datetimebox('getValue');
        var level = \$('#level').combobox('getValue');
        var from = \$('#from').combobox('getValue');
        var superior = \$('#superior').val();
        var status = \$('#status').combobox('getValue');

        if (status == undefined) status = 'all';
        var sub = \$('#sub').val();
        var url = \"/member/index?excel=member&account=\" + account + '&startTime=' + startTime + '&endTime=' + endTime + '&level=' + level + '&from=' + from + '&status=' + status + '&superior=' + superior;
        window.location.href = url;
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
        return array (  402 => 326,  365 => 292,  300 => 230,  236 => 168,  233 => 167,  219 => 156,  196 => 136,  181 => 124,  159 => 105,  138 => 86,  133 => 83,  130 => 82,  125 => 79,  122 => 78,  117 => 75,  114 => 74,  109 => 71,  106 => 70,  101 => 67,  99 => 66,  71 => 41,  32 => 4,  29 => 3,  11 => 1,);
    }
}
/* {% extends '@app/views/base.html' %}*/
/* */
/* {% block main %}*/
/* <div class="search">*/
/*     <span>注册时间*/
/*         <input class="easyui-datetimebox" style="width:200px" name="startTime" id="startTime"> 到*/
/*         <input class="easyui-datetimebox" style="width:200px" name="endTime" id="endTime">*/
/*     </span>&nbsp;*/
/*     <span>状态*/
/*         <select class="easyui-combobox" id="status" name="status" data-options="required:true, panelHeight:'auto'">*/
/*             <option value="all">所有</option>*/
/*             <option value="0">正常</option>*/
/*             <option value="1">冻结</option>*/
/*         </select>*/
/*     </span>&nbsp;*/
/*     <span>会员名/昵称 <input class="easyui-textbox" type="text" name="account" id="account"></span>&nbsp;*/
/*     <span>站点*/
/*         <select class="easyui-combobox" id="from" name="from" data-options="required:true,panelHeight:'auto'">*/
/*             <option value="all">所有</option>*/
/*             <option value="1">伙购网</option>*/
/*             <option value="2">滴滴夺宝</option>*/
/*         </select>*/
/*     </span>*/
/*     <span>等级*/
/*         <select class="easyui-combobox" id="level" name="level" data-options="required:true, panelHeight:'auto'">*/
/*             <option value="all">所有</option>*/
/*             <option value="1">新兵</option>*/
/*             <option value="2">少将</option>*/
/*             <option value="3">中将</option>*/
/*             <option value="4">上将</option>*/
/*             <option value="5">大将</option>*/
/*             <option value="6">元帅</option>*/
/*         </select>*/
/*     </span>&nbsp;*/
/*     <span>上级 <input class="easyui-textbox" type="text" name="superior" id="superior"></span>&nbsp;*/
/*     <a href="javascript:void(0);" onclick="reloadgrid();" class="easyui-linkbutton" iconCls="icon-search">搜索</a>*/
/*     <a href="javascript:void(0);" class="easyui-linkbutton" onclick="dataexcel();">导出</a>*/
/* </div>*/
/* */
/* <table id="listdata" class="easyui-datagrid" title="会员列表"*/
/*        data-options="toolbar:'#tb-user',singleSelect:true,pagination:true,method:'get',url:'{{  url('member/index')}}',pageSize: 20">*/
/*     <thead>*/
/*     <tr>*/
/*         <th data-options="field:'ck', checkbox: true">*/
/*         <th data-options="field:'username', width:200, align:'center'" formatter="formatName">会员名</th>*/
/*         <th data-options="field:'nickname', width:120, align:'center'">昵称</th>*/
/*         <th data-options="field:'money', width:100, align:'center'">账户余额</th>*/
/*         <th data-options="field:'point', width:100, align:'center'">福分余额</th>*/
/*         <th data-options="field:'commission', width:100, align:'center'" formatter="formatCommission">佣金余额</th>*/
/*         <th data-options="field:'superior', width:100, align:'center'" formatter="formatSuperior">上级</th>*/
/*         <th data-options="field:'invite_num', width:100, align:'center'">邀请人数</th>*/
/*         <th data-options="field:'level', width:100, align:'center'">等级</th>*/
/*         <th data-options="field:'total_payment', width:100, align:'center'">消费金额</th>*/
/*         <th data-options="field:'total_order', width:100, align:'center'">中奖次数</th>*/
/*         <th data-options="field:'status', width:100, align:'center'" formatter="formatStatus">状态</th>*/
/*         <th data-options="field:'reg_terminal', width:100, align:'center'">终端</th>*/
/*         <th data-options="field:'reg_ip', width:100, align:'center'">注册区域</th>*/
/*         <th data-options="field:'created_at', width:180" formatter="formatTime">注册时间</th>*/
/*         <th data-options="field:'updated_at', width:180" formatter="formatTime">最近登录时间</th>*/
/*     </tr>*/
/*     </thead>*/
/* </table>*/
/* */
/* <div id="tb-user" style="height:auto">*/
/*     <div>*/
/*         {% if view == 1 %}*/
/*         <a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-add',plain:true"*/
/*            onclick="view()">查看</a>*/
/*         {% endif %}*/
/*         {% if edit == 1 %}*/
/*         <a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-edit',plain:true"*/
/*            onclick="edit()">编辑</a>*/
/*         {% endif %}*/
/*         {% if status == 1 %}*/
/*         <a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-ok',plain:true"*/
/*            onclick="status(0)">解冻</a>*/
/*         {% endif %}*/
/*         {% if status == 1 %}*/
/*         <a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-no',plain:true"*/
/*            onclick="status(1)">冻结</a>*/
/*         {% endif %}*/
/*         {% if send == 1 %}*/
/*         <a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-redo',plain:true"*/
/*            onclick="send()">发站内信</a>*/
/*         {% endif %}*/
/*     </div>*/
/* </div>*/
/* */
/* <!--查看会员-->*/
/* <div id="dlg-view" class="easyui-window" title="查看会员" style="width:1400px;height:750px;padding:10px;" data-options="*/
/*             iconCls:'icon-save',*/
/*             closed:true,*/
/*             modal:true,*/
/*             onClose: onClose,*/
/*             onResize:function(){*/
/*                 $(this).window('hcenter');*/
/*             }">*/
/*     <iframe width="100%" height="100%" frameborder="0" id="view_iframe"></iframe>*/
/* </div>*/
/* <!--查看会员-->*/
/* */
/* <!--编辑会员-->*/
/* <div id="dlg-edit" title="编辑会员" class="easyui-dialog" style="width:350px;height:auto;padding:10px 20px" modal="true"*/
/*      closed="true" buttons="#dlg-buttons-edit">*/
/*     {{ html.beginForm('', 'post', {'class':'am-form am-form-horizontal', 'id':'editForm'}) | raw }}*/
/*     <table cellpadding="5">*/
/*         <tr>*/
/*             <td>昵称</td>*/
/*             <td><input class="easyui-textbox" type="text" name="User[nickname]"></td>*/
/*         </tr>*/
/*         <tr>*/
/*             <td>手机号</td>*/
/*             <td><input class="easyui-textbox" type="text" name="User[phone]" validType="phone"></td>*/
/*         </tr>*/
/*         <tr>*/
/*             <td>邮箱</td>*/
/*             <td><input class="easyui-textbox" type="text" name="User[email]" validType="email"></td>*/
/*         </tr>*/
/*         <tr>*/
/*             <td>密码</td>*/
/*             <td><input class="easyui-textbox" type="password" name="User[password]"></td>*/
/*         </tr>*/
/*     </table>*/
/*     {{ html.endForm() | raw }}*/
/* </div>*/
/* */
/* <div id="dlg-buttons-edit" style="text-align:center;padding:5px">*/
/*     <a class="easyui-linkbutton" iconCls="icon-ok" onclick="save('edit')">确定</a>*/
/*     <a class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg-edit').dialog('close')">取消</a>*/
/* </div>*/
/* <!--编辑会员-->*/
/* */
/* <!--发送站内信-->*/
/* <div id="dlg-send" title="发送站内信" class="easyui-dialog" style="width:600px;height:auto;padding:10px 20px" modal="true"*/
/*      closed="true" buttons="#dlg-buttons-send">*/
/*     {{ html.beginForm('', 'post', {'class':'am-form am-form-horizontal', 'id':'sendForm'}) | raw }}*/
/*     <table cellpadding="5">*/
/*         <tr>*/
/*             <td>昵称</td>*/
/*             <td id="nickname_send"></td>*/
/*         </tr>*/
/*         <tr>*/
/*             <td>手机号</td>*/
/*             <td id="phone_send"></td>*/
/*         </tr>*/
/*         <tr>*/
/*             <td>邮箱</td>*/
/*             <td id="email_send"></td>*/
/*         </tr>*/
/*         <tr>*/
/*             <td>内容</td>*/
/*             <td><textarea id="content" name="content" style="width: 400px; height: 200px"></textarea>可输入200个字</td>*/
/*         </tr>*/
/*     </table>*/
/*     <input type="hidden" name="id" id="id">*/
/*     {{ html.endForm() | raw }}*/
/* </div>*/
/* <!--发送站内信-->*/
/* <div id="dlg-buttons-send" style="text-align:center;padding:5px">*/
/*     <a class="easyui-linkbutton" iconCls="icon-ok" onclick="sendMsg()">确定</a>*/
/*     <a class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg-send').dialog('close')">取消</a>*/
/* </div>*/
/* <!--编辑会员-->*/
/* */
/* {% endblock %}*/
/* */
/* {% block script %}*/
/* <script type="text/javascript">*/
/*     function reloadgrid() {*/
/*         var queryParams = $('#listdata').datagrid('options').queryParams;*/
/*         queryParams.account = $('#account').val();*/
/*         queryParams.startTime = $('#startTime').datetimebox('getValue');*/
/*         queryParams.endTime = $('#endTime').datetimebox('getValue');*/
/*         queryParams.level = $('#level').combobox('getValue');*/
/*         queryParams.from = $('#from').combobox('getValue');*/
/*         queryParams.superior = $('#superior').val();*/
/*         queryParams.status = $('#status').combobox('getValue');*/
/*         $('#listdata').datagrid('options').queryParams = queryParams;*/
/*         $("#listdata").datagrid('reload');*/
/*     }*/
/* */
/*     //格式化*/
/*     function formatName(val, row) {*/
/*         result = '';*/
/* */
/*         if (row.phone) {*/
/*             result += '手机号：' + row.phone + '<br />';*/
/*         }*/
/*         if (row.email) {*/
/*             result += '邮箱：' + row.email;*/
/*         }*/
/* */
/*         return result;*/
/*     }*/
/*     function formatStatus(val, row) {*/
/*         if (val == 0) {*/
/*             return '正常';*/
/*         } else {*/
/*             return '冻结';*/
/*         }*/
/*     }*/
/*     function formatSuperior(val, row) {*/
/*         return val == null ? '无' : val;*/
/*     }*/
/*     function formatTime(val, row) {*/
/*         var newDate_attend = new Date();*/
/*         newDate_attend.setTime(val * 1000);*/
/*         var my_create_time_attend=newDate_attend.format('yyyy-MM-dd hh:mm:ss');*/
/*         return my_create_time_attend;*/
/*     }*/
/* */
/*     function formatCommission(val, row) {*/
/*         return val / 100;*/
/*     }*/
/* */
/*     function onClose() {*/
/*         $('#view_tabs').find('iframe').each(function (i, v) {*/
/*             $(this).prop('src', '');*/
/*         })*/
/*     }*/
/* */
/*     function view() {*/
/*         var selRow = $('#listdata').datagrid('getSelections');*/
/*         if (selRow.length != 1) {*/
/*             $.messager.alert('错误', '请选择一个会员');*/
/*             return false;*/
/*         }*/
/*         selRow = selRow[0];*/
/* */
/*         $('#view_iframe').prop('src', "{{ url('member/view') }}" + '?id=' + selRow.id);*/
/*         $('#dlg-view').window('open');*/
/*     }*/
/* */
/*     function edit() {*/
/*         var selRow = $('#listdata').datagrid('getSelections');*/
/*         if (selRow.length != 1) {*/
/*             $.messager.alert('错误', '请选择一个会员');*/
/*             return false;*/
/*         }*/
/*         selRow = selRow[0];*/
/*         $('#dlg-edit').form('load', {*/
/*             'User[nickname]': selRow.nickname,*/
/*             'User[phone]': selRow.phone,*/
/*             'User[email]': selRow.email,*/
/*             'User[password]': selRow.password,*/
/*         });*/
/*         $('#dlg-edit').window('open');*/
/*     }*/
/* */
/*     function save(flag) {*/
/*         if (flag == 'edit') {*/
/*             var selRow = $('#listdata').datagrid('getSelected');*/
/*             var url = '/member/edit?id=' + selRow.id;*/
/*             var form = 'editForm';*/
/*         }*/
/* */
/*         $('#' + form).form({*/
/*             url: url,*/
/*             onSubmit: function () {*/
/*                 return $(this).form('enableValidation').form('validate');*/
/*             },*/
/*             success: function (data) {*/
/*                 data = eval('(' + data + ')');*/
/*                 if (data.error == 0) {*/
/*                     $.messager.alert('成功', data.message);*/
/*                     //window.location.href = '/auth/index';*/
/*                     $('#dlg-' + flag).window('close');*/
/*                     reloadgrid();*/
/*                 } else {*/
/*                     $.messager.alert('失败', data.message, 'error');*/
/*                 }*/
/*             }*/
/*         });*/
/*         $('#' + form).submit();*/
/*     }*/
/* */
/*     function status(flag) {*/
/*         var selRow = $('#listdata').treegrid('getSelections');*/
/*         if (selRow.length == 0) {*/
/*             $.messager.alert('错误', '请选择会员');*/
/*             return false;*/
/*         }*/
/* */
/*         var ids = new Array();*/
/*         $.each(selRow, function (i, v) {*/
/*             ids.push(v.id);*/
/*         });*/
/*         id = ids.join(',');*/
/* */
/*         $.messager.confirm('Confirm', '您确定' + (flag == 0 ? "启用" : "冻结") + '该账号', function (r) {*/
/*             if (r) {*/
/*                 $.post("{{ url('member/change-status') }}", {id: id, status: flag}, function (data) {*/
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
/*     function send() {*/
/*         var selRow = $('#listdata').datagrid('getSelections');*/
/*         if (selRow.length != 1) {*/
/*             $.messager.alert('错误', '请选择一个会员');*/
/*             return false;*/
/*         }*/
/*         selRow = selRow[0];*/
/*         nickname = selRow.nickname == null ? '无' : selRow.nickname;*/
/*         phone = selRow.phone == null ? '无' : selRow.phone;*/
/*         email = selRow.email == null ? '无' : selRow.email;*/
/*         $('#content').val('');*/
/*         $('#id').val(selRow.id);*/
/*         $('#nickname_send').html(nickname);*/
/*         $('#phone_send').html(phone);*/
/*         $('#email_send').html(email);*/
/*         $('#dlg-send').window('open');*/
/*     }*/
/* */
/*     function sendMsg() {*/
/*         $.messager.confirm('Confirm', '确定发送站内信吗？', function (r) {*/
/*             if (r) {*/
/*                 $('#sendForm').form({*/
/*                     url: "{{ url('member/send-message') }}",*/
/*                     onSubmit: function () {*/
/*                         if ($('#content').val() == '') {*/
/*                             return false;*/
/*                         }*/
/*                         return true;*/
/*                     },*/
/*                     success: function (data) {*/
/*                         data = eval('(' + data + ')');*/
/*                         if (data.error == 0) {*/
/*                             $.messager.alert('成功', data.message);*/
/*                             $('#dlg-send').window('close');*/
/*                             reloadgrid();*/
/*                         } else {*/
/*                             $.messager.alert('失败', data.message, 'error');*/
/*                         }*/
/*                     }*/
/*                 });*/
/*                 $('#sendForm').submit();*/
/*             }*/
/*         });*/
/*     }*/
/* */
/*     function dataexcel() {*/
/*         var account = $('#account').val();*/
/*         var startTime = $('#startTime').datetimebox('getValue');*/
/*         var endTime = $('#endTime').datetimebox('getValue');*/
/*         var level = $('#level').combobox('getValue');*/
/*         var from = $('#from').combobox('getValue');*/
/*         var superior = $('#superior').val();*/
/*         var status = $('#status').combobox('getValue');*/
/* */
/*         if (status == undefined) status = 'all';*/
/*         var sub = $('#sub').val();*/
/*         var url = "/member/index?excel=member&account=" + account + '&startTime=' + startTime + '&endTime=' + endTime + '&level=' + level + '&from=' + from + '&status=' + status + '&superior=' + superior;*/
/*         window.location.href = url;*/
/*     }*/
/* </script>*/
/* {% endblock %}*/
