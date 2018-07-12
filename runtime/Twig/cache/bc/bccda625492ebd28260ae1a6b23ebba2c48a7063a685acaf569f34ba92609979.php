<?php

/* index.html */
class __TwigTemplate_f0b633bfcc3a3f8a95b35d23fe11599d62ab3d8cae8c1acd2c40697fc07d6c53 extends yii\twig\Template
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
    <span>会员
        <input class=\"easyui-textbox\" type=\"text\" name=\"account\" id=\"account\">
    </span>
    <span>申请时间
        <input class=\"easyui-datetimebox\" style=\"width:200px\" name=\"startTime\" id=\"startTime\"> 到
        <input class=\"easyui-datetimebox\" style=\"width:200px\" name=\"endTime\" id=\"endTime\">
    </span>
    <span>状态
        <select class=\"easyui-combobox\" id=\"status\" name=\"status\" data-options=\"required:true, panelHeight:'auto'\">
            <option value=\"all\">所有</option>
            <option value=\"0\">新提交</option>
            <option value=\"1\">运营审核通过</option>
            <option value=\"2\">运营审核拒绝</option>
            <option value=\"3\">财务审核通过</option>
            <option value=\"4\">财务审核拒绝</option>
        </select>
    </span>
    <a href=\"javascript:void(0);\" onclick=\"reloadgrid();\" class=\"easyui-linkbutton\" iconCls=\"icon-search\">搜索</a>
</div>

<table id=\"listdata\"  class=\"easyui-datagrid\" title=\"申请列表\" data-options=\"toolbar:'#tb-user',singleSelect:true,pagination:true,method:'get',url:'";
        // line 26
        echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url("/commission/index"), "html", null, true);
        echo "',mode:'local',pageSize:20\">
    <thead>
    <tr>
        <th data-options=\"field:'id', width:50, align:'center'\">序号</th>
        <th data-options=\"field:'user_id', width:50, align:'center'\">会员ID</th>
        <th data-options=\"field:'name', width:200, align:'center'\" formatter=\"formatName\">会员</th>
        <th data-options=\"field:'money', width:100, align:'center'\">提现金额</th>
        <th data-options=\"field:'bank', width:200, align:'center'\">开户行</th>
        <th data-options=\"field:'account', width:100, align:'center'\">户名</th>
        <th data-options=\"field:'bank_number', width:200, align:'center'\">账号</th>
        <th data-options=\"field:'phone', width:100, align:'center'\">联系电话</th>
        <th data-options=\"field:'status', width:100, align:'center'\" formatter=\"formatStatus\">状态</th>
        <th data-options=\"field:'apply_time', width:180, align:'center'\" formatter=\"formatTime\">申请时间</th>
    </tr>
    </thead>
</table>

<div id=\"tb-user\" style=\"height:auto\">
    <div>
        <a href=\"javascript:void(0)\" class=\"easyui-linkbutton\" data-options=\"iconCls:'icon-tip',plain:true\" onclick=\"view()\">查看</a>
        ";
        // line 46
        if (((isset($context["operateApprove"]) ? $context["operateApprove"] : null) == 1)) {
            // line 47
            echo "        <a href=\"javascript:void(0)\" class=\"easyui-linkbutton\" data-options=\"iconCls:'icon-edit',plain:true\" onclick=\"operateApprove('open')\">运营审核</a>
        ";
        }
        // line 49
        echo "        ";
        if (((isset($context["financeApprove"]) ? $context["financeApprove"] : null) == 1)) {
            // line 50
            echo "        <a href=\"javascript:void(0)\" class=\"easyui-linkbutton\" data-options=\"iconCls:'icon-edit',plain:true\" onclick=\"financeApprove('open')\">财务审核</a>
        ";
        }
        // line 52
        echo "    </div>
</div>

<!--查看佣金管理-->
<div id=\"dlg-view\" title=\"查看佣金管理\" class=\"easyui-dialog\" style=\"width:600px;height:auto;padding:10px 20px\" modal=\"true\" closed=\"true\">
    <table cellpadding=\"5\">
        <tr>
            <td style=\"width: 100px\">会员ID</td>
            <td id=\"view_userid\"></td>
        </tr>
        <tr>
            <td style=\"width: 100px\">会员</td>
            <td id=\"view_username\"></td>
        </tr>
        <tr>
            <td>提现金额</td>
            <td id=\"view_money\"></td>
        </tr>
        <tr>
            <td>开户行</td>
            <td id=\"view_bank\"></td>
        </tr>
        <tr>
            <td>支行</td>
            <td id=\"view_branch\"></td>
        </tr>
        <tr>
            <td>银行卡卡号</td>
            <td id=\"view_bank_number\"></td>
        </tr>
        <tr>
            <td>户名</td>
            <td id=\"view_account\"></td>
        </tr>
        <tr>
            <td>申请时间</td>
            <td id=\"view_apply_time\"></td>
        </tr>
        <tr>
            <td>状态</td>
            <td id=\"view_status\"></td>
        </tr>
        <tr id=\"view_operate_approve\">
            <td>运营审核人</td>
            <td id=\"view_operate_approve_name\"></td>
            <td>审核时间</td>
            <td id=\"view_operate_approve_time\"></td>
        </tr>
        <tr id=\"view_finance_approve\">
            <td>财务审核人</td>
            <td id=\"view_finance_approve_name\"></td>
            <td>审核时间</td>
            <td id=\"view_finance_approve_time\"></td>
        </tr>
        <tr id=\"view_note\">
            <td>备注</td>
            <td id=\"view_fail_reason\"></td>
        </tr>
    </table>
</div>
<!--查看佣金管理-->

<!--运营审核-->
<div id=\"dlg-operate-approve\" title=\"运营审核\" class=\"easyui-dialog\" style=\"width:450px;height:auto;padding:10px 20px\" modal=\"true\" closed=\"true\" buttons=\"#dlg-buttons-operate-approve\">
    ";
        // line 116
        echo $this->getAttribute((isset($context["html"]) ? $context["html"] : null), "beginForm", array(0 => "", 1 => "post", 2 => array("class" => "am-form am-form-horizontal", "id" => "operateApproveForm")), "method");
        echo "
    <table cellpadding=\"5\">
        <tr>
            <td style=\"width: 100px\">审核</td>
            <td>
                <select id=\"operateApproveSelect\" class=\"easyui-combobox\" name=\"status\" data-options=\"panelHeight:'auto', onSelect:operateApproveOnSelect,required:true\">
                    <option value=\"1\">通过</option>
                    <option value=\"2\">驳回</option>
                </select>
            </td>
        </tr>
        <tr id=\"operate_approve\">
            <td>驳回原因</td>
            <td>
                <textarea name=\"fail_reason\" id=\"operate_approve_fail_reason\" style=\"width: 260px; height: 100px\"></textarea>
            </td>
        </tr>
    </table>
    ";
        // line 134
        echo $this->getAttribute((isset($context["html"]) ? $context["html"] : null), "endForm", array(), "method");
        echo "
</div>
<div id=\"dlg-buttons-operate-approve\" style=\"text-align:center;padding:5px\">
    <a class=\"easyui-linkbutton\" iconCls=\"icon-ok\" onclick=\"operateApprove('submit')\">确定</a>
    <a class=\"easyui-linkbutton\" iconCls=\"icon-cancel\" onclick=\"javascript:\$('#dlg-operate-approve').dialog('close')\">取消</a>
</div>
<!--运营审核-->

<!--财务审核-->
<div id=\"dlg-finance-approve\" title=\"财务审核\" class=\"easyui-dialog\" style=\"width:450px;height:auto;padding:10px 20px\" modal=\"true\" closed=\"true\" buttons=\"#dlg-buttons-finance-approve\">
    ";
        // line 144
        echo $this->getAttribute((isset($context["html"]) ? $context["html"] : null), "beginForm", array(0 => "", 1 => "post", 2 => array("class" => "am-form am-form-horizontal", "id" => "financeApproveForm")), "method");
        echo "
    <table cellpadding=\"5\">
        <tr>
            <td style=\"width: 100px\">审核</td>
            <td>
                <select id=\"financeApproveSelect\" class=\"easyui-combobox\" name=\"status\" data-options=\"panelHeight:'auto', onSelect:financeApproveOnSelect,required:true\">
                    <option value=\"3\">通过</option>
                    <option value=\"4\">驳回</option>
                </select>
            </td>
        </tr>
        <tr id=\"finance_approve\">
            <td>驳回原因</td>
            <td>
                <textarea name=\"fail_reason\" id=\"finance_approve_fail_reason\" style=\"width: 260px; height: 100px\"></textarea>
            </td>
        </tr>
    </table>
    ";
        // line 162
        echo $this->getAttribute((isset($context["html"]) ? $context["html"] : null), "endForm", array(), "method");
        echo "
</div>
<div id=\"dlg-buttons-finance-approve\" style=\"text-align:center;padding:5px\">
    <a class=\"easyui-linkbutton\" iconCls=\"icon-ok\" onclick=\"financeApprove('submit')\">确定</a>
    <a class=\"easyui-linkbutton\" iconCls=\"icon-cancel\" onclick=\"javascript:\$('#dlg-finance-approve').dialog('close')\">取消</a>
</div>
<!--财务审核-->
";
    }

    // line 171
    public function block_js($context, array $blocks = array())
    {
        // line 172
        echo "<script>
    function reloadgrid(){
        var queryParams = \$('#listdata').datagrid('options').queryParams;
        queryParams.account = \$('#account').val();
        queryParams.startTime = \$('#startTime').datetimebox('getValue');
        queryParams.endTime\t= \$('#endTime').datetimebox('getValue');
        queryParams.order = \$('#order').val();
        queryParams.status\t= \$('#status').combobox('getValue');
        \$('#listdata').datagrid('options').queryParams = queryParams;
        \$(\"#listdata\").datagrid('reload');
    }

    function onChange(newValue, oldValue) {
        \$.get('/money/user-info', {'account': newValue}, function(data) {
            if (data.error == 0) {
                \$('#add_before_money').textbox('setValue', data.message['money']);
                \$('#add_user_id').val(data.message['user_id']);
            } else {
                \$.messager.alert('错误', data.message);
            }
        });
    }

    //格式化状态
    function formatStatus(val, row) {
        if (val == 0) {
            return '新提交';
        } else if (val == 1) {
            return '运营审核通过';
        } else if (val == 2) {
            return '运营审核失败';
        } else if (val == 3) {
            return '财务审核通过';
        } else if (val == 4) {
            return '财务审核失败';
        }
    }

    function formatName(val, row) {
        result = '';

        if (row.user_phone) {
            result += '手机号：' + row.user_phone + '<br />';
        }
        if (row.email) {
            result += '邮箱：' + row.email;
        }

        return result;
    }

    function view() {
        var selRow = \$('#listdata').treegrid('getSelected');
        if (!selRow) {
            \$.messager.alert('错误','请选择一行');
            return false;
        }

        \$('#view_userid').html(selRow.user_id);
        \$('#view_username').html(formatName(0, selRow));
        \$('#view_money').html(selRow.money + '元');
        \$('#view_bank').html(selRow.bank);
        \$('#view_branch').html(selRow.branch);
        \$('#view_bank_number').html(selRow.bank_number);
        \$('#view_account').html(selRow.account);
        \$('#view_apply_time').html(formatTime(selRow.apply_time, selRow));
        \$('#view_status').html(formatStatus(selRow.status, selRow));
        if (selRow.status > 0) {
            \$('#view_operate_approve').show();
            \$('#view_operate_approve_name').html(selRow.audit_user_name);
            \$('#view_operate_approve_time').html(formatTime(selRow.audit_time, selRow));
        } else {
            \$('#view_operate_approve').hide();
            \$('#view_operate_approve_name').html('');
            \$('#view_operate_approve_time').html('');
        }
        if (selRow.status > 2) {
            \$('#view_finance_approve').show();
            \$('#view_finance_approve_name').html(selRow.pass_user_name);
            \$('#view_finance_approve_time').html(formatTime(selRow.pass_time, selRow));
        } else {
            \$('#view_finance_approve').hide();
            \$('#view_finance_approve_name').html('');
            \$('#view_finance_approve_time').html('');
        }
        if (selRow.fail_reason == \"\") {
            \$('#view_note').hide();
            \$('#view_fail_reason').html('');
        } else {
            \$('#view_note').show();
            \$('#view_fail_reason').html(selRow.fail_reason);
        }

        \$('#dlg-view').window('open');
    }

    function operateApproveOnSelect(newValue, oldValue) {
        if (newValue.value == 2) {
            \$('#operate_approve').show();
        } else {
            \$('#operate_approve_fail_reason').empty();
            \$('#operate_approve').hide();
        }
    }

    function financeApproveOnSelect(newValue, oldValue) {
        if (newValue.value == 4) {
            \$('#finance_approve').show();
        } else {
            \$('#finance_approve_fail_reason').empty();
            \$('#finance_approve').hide();
        }
    }

    function operateApprove(action) {
        var selRow = \$('#listdata').datagrid('getSelected');
        if (!selRow) {
            \$.messager.alert('错误', '请选择一行');
            return false;
        }
        if (selRow.status > 0) {
            \$.messager.alert('错误', '运营审核已完成');
            return false;
        }
        if (action == 'open') {
            \$('#operateApproveSelect').combobox('setValue', 1);
            \$('#operate_approve').hide();
            \$('#dlg-operate-approve').window('open');
        } else if (action == 'submit') {
            var selRow = \$('#listdata').datagrid('getSelected');
            var url = '/commission/operate-approve?id=' + selRow.id;

            \$('#operateApproveForm').form({
                url: url,
                onSubmit:function(){
                    return \$(this).form('enableValidation').form('validate');
                },
                success: function (data) {
                    data = eval('(' + data + ')');
                    if (data.error == 0) {
                        \$.messager.alert('成功', data.message);
                        \$('#dlg-operate-approve').window('close');
                        reloadgrid();
                    } else {
                        \$.messager.alert('失败', data.message, 'error');
                    }
                }
            });
            \$('#operateApproveForm').submit();
        }
    }

    function financeApprove(action) {
        var selRow = \$('#listdata').datagrid('getSelected');
        if (!selRow) {
            \$.messager.alert('错误', '请选择一行');
            return false;
        }
        if (selRow.status == 0) {
            \$.messager.alert('错误', '请先进行运营审核');
            return false;
        }
        if (selRow.status == 2) {
            \$.messager.alert('错误', '运营审核未通过，无法进行财务审核');
            return false;
        }
        if (selRow.status == 3 || selRow.status == 4) {
            \$.messager.alert('错误', '财务审核已完成');
            return false;
        }
        if (action == 'open') {
            \$('#financeApproveSelect').combobox('setValue', 3);
            \$('#finance_approve').hide();
            \$('#dlg-finance-approve').window('open');
        } else if (action == 'submit') {
            var selRow = \$('#listdata').datagrid('getSelected');
            var url = '/commission/finance-approve?id=' + selRow.id;

            \$('#financeApproveForm').form({
                url: url,
                onSubmit:function(){
                    return \$(this).form('enableValidation').form('validate');
                },
                success: function (data) {
                    data = eval('(' + data + ')');
                    if (data.error == 0) {
                        \$.messager.alert('成功', data.message);
                        \$('#dlg-finance-approve').window('close');
                        reloadgrid();
                    } else {
                        \$.messager.alert('失败', data.message, 'error');
                    }
                }
            });
            \$('#financeApproveForm').submit();
        }
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
        return array (  228 => 172,  225 => 171,  213 => 162,  192 => 144,  179 => 134,  158 => 116,  92 => 52,  88 => 50,  85 => 49,  81 => 47,  79 => 46,  56 => 26,  32 => 4,  29 => 3,  11 => 1,);
    }
}
/* {% extends '@app/views/base.html' %}*/
/* */
/* {% block main %}*/
/* */
/* <div class="search">*/
/*     <span>会员*/
/*         <input class="easyui-textbox" type="text" name="account" id="account">*/
/*     </span>*/
/*     <span>申请时间*/
/*         <input class="easyui-datetimebox" style="width:200px" name="startTime" id="startTime"> 到*/
/*         <input class="easyui-datetimebox" style="width:200px" name="endTime" id="endTime">*/
/*     </span>*/
/*     <span>状态*/
/*         <select class="easyui-combobox" id="status" name="status" data-options="required:true, panelHeight:'auto'">*/
/*             <option value="all">所有</option>*/
/*             <option value="0">新提交</option>*/
/*             <option value="1">运营审核通过</option>*/
/*             <option value="2">运营审核拒绝</option>*/
/*             <option value="3">财务审核通过</option>*/
/*             <option value="4">财务审核拒绝</option>*/
/*         </select>*/
/*     </span>*/
/*     <a href="javascript:void(0);" onclick="reloadgrid();" class="easyui-linkbutton" iconCls="icon-search">搜索</a>*/
/* </div>*/
/* */
/* <table id="listdata"  class="easyui-datagrid" title="申请列表" data-options="toolbar:'#tb-user',singleSelect:true,pagination:true,method:'get',url:'{{  url('/commission/index')}}',mode:'local',pageSize:20">*/
/*     <thead>*/
/*     <tr>*/
/*         <th data-options="field:'id', width:50, align:'center'">序号</th>*/
/*         <th data-options="field:'user_id', width:50, align:'center'">会员ID</th>*/
/*         <th data-options="field:'name', width:200, align:'center'" formatter="formatName">会员</th>*/
/*         <th data-options="field:'money', width:100, align:'center'">提现金额</th>*/
/*         <th data-options="field:'bank', width:200, align:'center'">开户行</th>*/
/*         <th data-options="field:'account', width:100, align:'center'">户名</th>*/
/*         <th data-options="field:'bank_number', width:200, align:'center'">账号</th>*/
/*         <th data-options="field:'phone', width:100, align:'center'">联系电话</th>*/
/*         <th data-options="field:'status', width:100, align:'center'" formatter="formatStatus">状态</th>*/
/*         <th data-options="field:'apply_time', width:180, align:'center'" formatter="formatTime">申请时间</th>*/
/*     </tr>*/
/*     </thead>*/
/* </table>*/
/* */
/* <div id="tb-user" style="height:auto">*/
/*     <div>*/
/*         <a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-tip',plain:true" onclick="view()">查看</a>*/
/*         {% if operateApprove == 1 %}*/
/*         <a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-edit',plain:true" onclick="operateApprove('open')">运营审核</a>*/
/*         {% endif %}*/
/*         {% if financeApprove == 1 %}*/
/*         <a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-edit',plain:true" onclick="financeApprove('open')">财务审核</a>*/
/*         {% endif %}*/
/*     </div>*/
/* </div>*/
/* */
/* <!--查看佣金管理-->*/
/* <div id="dlg-view" title="查看佣金管理" class="easyui-dialog" style="width:600px;height:auto;padding:10px 20px" modal="true" closed="true">*/
/*     <table cellpadding="5">*/
/*         <tr>*/
/*             <td style="width: 100px">会员ID</td>*/
/*             <td id="view_userid"></td>*/
/*         </tr>*/
/*         <tr>*/
/*             <td style="width: 100px">会员</td>*/
/*             <td id="view_username"></td>*/
/*         </tr>*/
/*         <tr>*/
/*             <td>提现金额</td>*/
/*             <td id="view_money"></td>*/
/*         </tr>*/
/*         <tr>*/
/*             <td>开户行</td>*/
/*             <td id="view_bank"></td>*/
/*         </tr>*/
/*         <tr>*/
/*             <td>支行</td>*/
/*             <td id="view_branch"></td>*/
/*         </tr>*/
/*         <tr>*/
/*             <td>银行卡卡号</td>*/
/*             <td id="view_bank_number"></td>*/
/*         </tr>*/
/*         <tr>*/
/*             <td>户名</td>*/
/*             <td id="view_account"></td>*/
/*         </tr>*/
/*         <tr>*/
/*             <td>申请时间</td>*/
/*             <td id="view_apply_time"></td>*/
/*         </tr>*/
/*         <tr>*/
/*             <td>状态</td>*/
/*             <td id="view_status"></td>*/
/*         </tr>*/
/*         <tr id="view_operate_approve">*/
/*             <td>运营审核人</td>*/
/*             <td id="view_operate_approve_name"></td>*/
/*             <td>审核时间</td>*/
/*             <td id="view_operate_approve_time"></td>*/
/*         </tr>*/
/*         <tr id="view_finance_approve">*/
/*             <td>财务审核人</td>*/
/*             <td id="view_finance_approve_name"></td>*/
/*             <td>审核时间</td>*/
/*             <td id="view_finance_approve_time"></td>*/
/*         </tr>*/
/*         <tr id="view_note">*/
/*             <td>备注</td>*/
/*             <td id="view_fail_reason"></td>*/
/*         </tr>*/
/*     </table>*/
/* </div>*/
/* <!--查看佣金管理-->*/
/* */
/* <!--运营审核-->*/
/* <div id="dlg-operate-approve" title="运营审核" class="easyui-dialog" style="width:450px;height:auto;padding:10px 20px" modal="true" closed="true" buttons="#dlg-buttons-operate-approve">*/
/*     {{ html.beginForm('', 'post', {'class':'am-form am-form-horizontal', 'id':'operateApproveForm'}) | raw }}*/
/*     <table cellpadding="5">*/
/*         <tr>*/
/*             <td style="width: 100px">审核</td>*/
/*             <td>*/
/*                 <select id="operateApproveSelect" class="easyui-combobox" name="status" data-options="panelHeight:'auto', onSelect:operateApproveOnSelect,required:true">*/
/*                     <option value="1">通过</option>*/
/*                     <option value="2">驳回</option>*/
/*                 </select>*/
/*             </td>*/
/*         </tr>*/
/*         <tr id="operate_approve">*/
/*             <td>驳回原因</td>*/
/*             <td>*/
/*                 <textarea name="fail_reason" id="operate_approve_fail_reason" style="width: 260px; height: 100px"></textarea>*/
/*             </td>*/
/*         </tr>*/
/*     </table>*/
/*     {{ html.endForm() | raw }}*/
/* </div>*/
/* <div id="dlg-buttons-operate-approve" style="text-align:center;padding:5px">*/
/*     <a class="easyui-linkbutton" iconCls="icon-ok" onclick="operateApprove('submit')">确定</a>*/
/*     <a class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg-operate-approve').dialog('close')">取消</a>*/
/* </div>*/
/* <!--运营审核-->*/
/* */
/* <!--财务审核-->*/
/* <div id="dlg-finance-approve" title="财务审核" class="easyui-dialog" style="width:450px;height:auto;padding:10px 20px" modal="true" closed="true" buttons="#dlg-buttons-finance-approve">*/
/*     {{ html.beginForm('', 'post', {'class':'am-form am-form-horizontal', 'id':'financeApproveForm'}) | raw }}*/
/*     <table cellpadding="5">*/
/*         <tr>*/
/*             <td style="width: 100px">审核</td>*/
/*             <td>*/
/*                 <select id="financeApproveSelect" class="easyui-combobox" name="status" data-options="panelHeight:'auto', onSelect:financeApproveOnSelect,required:true">*/
/*                     <option value="3">通过</option>*/
/*                     <option value="4">驳回</option>*/
/*                 </select>*/
/*             </td>*/
/*         </tr>*/
/*         <tr id="finance_approve">*/
/*             <td>驳回原因</td>*/
/*             <td>*/
/*                 <textarea name="fail_reason" id="finance_approve_fail_reason" style="width: 260px; height: 100px"></textarea>*/
/*             </td>*/
/*         </tr>*/
/*     </table>*/
/*     {{ html.endForm() | raw }}*/
/* </div>*/
/* <div id="dlg-buttons-finance-approve" style="text-align:center;padding:5px">*/
/*     <a class="easyui-linkbutton" iconCls="icon-ok" onclick="financeApprove('submit')">确定</a>*/
/*     <a class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg-finance-approve').dialog('close')">取消</a>*/
/* </div>*/
/* <!--财务审核-->*/
/* {% endblock %}*/
/* */
/* {% block js %}*/
/* <script>*/
/*     function reloadgrid(){*/
/*         var queryParams = $('#listdata').datagrid('options').queryParams;*/
/*         queryParams.account = $('#account').val();*/
/*         queryParams.startTime = $('#startTime').datetimebox('getValue');*/
/*         queryParams.endTime	= $('#endTime').datetimebox('getValue');*/
/*         queryParams.order = $('#order').val();*/
/*         queryParams.status	= $('#status').combobox('getValue');*/
/*         $('#listdata').datagrid('options').queryParams = queryParams;*/
/*         $("#listdata").datagrid('reload');*/
/*     }*/
/* */
/*     function onChange(newValue, oldValue) {*/
/*         $.get('/money/user-info', {'account': newValue}, function(data) {*/
/*             if (data.error == 0) {*/
/*                 $('#add_before_money').textbox('setValue', data.message['money']);*/
/*                 $('#add_user_id').val(data.message['user_id']);*/
/*             } else {*/
/*                 $.messager.alert('错误', data.message);*/
/*             }*/
/*         });*/
/*     }*/
/* */
/*     //格式化状态*/
/*     function formatStatus(val, row) {*/
/*         if (val == 0) {*/
/*             return '新提交';*/
/*         } else if (val == 1) {*/
/*             return '运营审核通过';*/
/*         } else if (val == 2) {*/
/*             return '运营审核失败';*/
/*         } else if (val == 3) {*/
/*             return '财务审核通过';*/
/*         } else if (val == 4) {*/
/*             return '财务审核失败';*/
/*         }*/
/*     }*/
/* */
/*     function formatName(val, row) {*/
/*         result = '';*/
/* */
/*         if (row.user_phone) {*/
/*             result += '手机号：' + row.user_phone + '<br />';*/
/*         }*/
/*         if (row.email) {*/
/*             result += '邮箱：' + row.email;*/
/*         }*/
/* */
/*         return result;*/
/*     }*/
/* */
/*     function view() {*/
/*         var selRow = $('#listdata').treegrid('getSelected');*/
/*         if (!selRow) {*/
/*             $.messager.alert('错误','请选择一行');*/
/*             return false;*/
/*         }*/
/* */
/*         $('#view_userid').html(selRow.user_id);*/
/*         $('#view_username').html(formatName(0, selRow));*/
/*         $('#view_money').html(selRow.money + '元');*/
/*         $('#view_bank').html(selRow.bank);*/
/*         $('#view_branch').html(selRow.branch);*/
/*         $('#view_bank_number').html(selRow.bank_number);*/
/*         $('#view_account').html(selRow.account);*/
/*         $('#view_apply_time').html(formatTime(selRow.apply_time, selRow));*/
/*         $('#view_status').html(formatStatus(selRow.status, selRow));*/
/*         if (selRow.status > 0) {*/
/*             $('#view_operate_approve').show();*/
/*             $('#view_operate_approve_name').html(selRow.audit_user_name);*/
/*             $('#view_operate_approve_time').html(formatTime(selRow.audit_time, selRow));*/
/*         } else {*/
/*             $('#view_operate_approve').hide();*/
/*             $('#view_operate_approve_name').html('');*/
/*             $('#view_operate_approve_time').html('');*/
/*         }*/
/*         if (selRow.status > 2) {*/
/*             $('#view_finance_approve').show();*/
/*             $('#view_finance_approve_name').html(selRow.pass_user_name);*/
/*             $('#view_finance_approve_time').html(formatTime(selRow.pass_time, selRow));*/
/*         } else {*/
/*             $('#view_finance_approve').hide();*/
/*             $('#view_finance_approve_name').html('');*/
/*             $('#view_finance_approve_time').html('');*/
/*         }*/
/*         if (selRow.fail_reason == "") {*/
/*             $('#view_note').hide();*/
/*             $('#view_fail_reason').html('');*/
/*         } else {*/
/*             $('#view_note').show();*/
/*             $('#view_fail_reason').html(selRow.fail_reason);*/
/*         }*/
/* */
/*         $('#dlg-view').window('open');*/
/*     }*/
/* */
/*     function operateApproveOnSelect(newValue, oldValue) {*/
/*         if (newValue.value == 2) {*/
/*             $('#operate_approve').show();*/
/*         } else {*/
/*             $('#operate_approve_fail_reason').empty();*/
/*             $('#operate_approve').hide();*/
/*         }*/
/*     }*/
/* */
/*     function financeApproveOnSelect(newValue, oldValue) {*/
/*         if (newValue.value == 4) {*/
/*             $('#finance_approve').show();*/
/*         } else {*/
/*             $('#finance_approve_fail_reason').empty();*/
/*             $('#finance_approve').hide();*/
/*         }*/
/*     }*/
/* */
/*     function operateApprove(action) {*/
/*         var selRow = $('#listdata').datagrid('getSelected');*/
/*         if (!selRow) {*/
/*             $.messager.alert('错误', '请选择一行');*/
/*             return false;*/
/*         }*/
/*         if (selRow.status > 0) {*/
/*             $.messager.alert('错误', '运营审核已完成');*/
/*             return false;*/
/*         }*/
/*         if (action == 'open') {*/
/*             $('#operateApproveSelect').combobox('setValue', 1);*/
/*             $('#operate_approve').hide();*/
/*             $('#dlg-operate-approve').window('open');*/
/*         } else if (action == 'submit') {*/
/*             var selRow = $('#listdata').datagrid('getSelected');*/
/*             var url = '/commission/operate-approve?id=' + selRow.id;*/
/* */
/*             $('#operateApproveForm').form({*/
/*                 url: url,*/
/*                 onSubmit:function(){*/
/*                     return $(this).form('enableValidation').form('validate');*/
/*                 },*/
/*                 success: function (data) {*/
/*                     data = eval('(' + data + ')');*/
/*                     if (data.error == 0) {*/
/*                         $.messager.alert('成功', data.message);*/
/*                         $('#dlg-operate-approve').window('close');*/
/*                         reloadgrid();*/
/*                     } else {*/
/*                         $.messager.alert('失败', data.message, 'error');*/
/*                     }*/
/*                 }*/
/*             });*/
/*             $('#operateApproveForm').submit();*/
/*         }*/
/*     }*/
/* */
/*     function financeApprove(action) {*/
/*         var selRow = $('#listdata').datagrid('getSelected');*/
/*         if (!selRow) {*/
/*             $.messager.alert('错误', '请选择一行');*/
/*             return false;*/
/*         }*/
/*         if (selRow.status == 0) {*/
/*             $.messager.alert('错误', '请先进行运营审核');*/
/*             return false;*/
/*         }*/
/*         if (selRow.status == 2) {*/
/*             $.messager.alert('错误', '运营审核未通过，无法进行财务审核');*/
/*             return false;*/
/*         }*/
/*         if (selRow.status == 3 || selRow.status == 4) {*/
/*             $.messager.alert('错误', '财务审核已完成');*/
/*             return false;*/
/*         }*/
/*         if (action == 'open') {*/
/*             $('#financeApproveSelect').combobox('setValue', 3);*/
/*             $('#finance_approve').hide();*/
/*             $('#dlg-finance-approve').window('open');*/
/*         } else if (action == 'submit') {*/
/*             var selRow = $('#listdata').datagrid('getSelected');*/
/*             var url = '/commission/finance-approve?id=' + selRow.id;*/
/* */
/*             $('#financeApproveForm').form({*/
/*                 url: url,*/
/*                 onSubmit:function(){*/
/*                     return $(this).form('enableValidation').form('validate');*/
/*                 },*/
/*                 success: function (data) {*/
/*                     data = eval('(' + data + ')');*/
/*                     if (data.error == 0) {*/
/*                         $.messager.alert('成功', data.message);*/
/*                         $('#dlg-finance-approve').window('close');*/
/*                         reloadgrid();*/
/*                     } else {*/
/*                         $.messager.alert('失败', data.message, 'error');*/
/*                     }*/
/*                 }*/
/*             });*/
/*             $('#financeApproveForm').submit();*/
/*         }*/
/*     }*/
/*     function formatTime(val, row) {*/
/*         var newDate_attend = new Date();*/
/*         newDate_attend.setTime(val * 1000);*/
/*         var my_create_time_attend=newDate_attend.format('yyyy-MM-dd hh:mm:ss');*/
/*         return my_create_time_attend;*/
/*     }*/
/* */
/* </script>*/
/* {% endblock %}*/
/* */
/* */
