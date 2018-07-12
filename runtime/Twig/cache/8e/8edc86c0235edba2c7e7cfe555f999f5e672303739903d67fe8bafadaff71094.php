<?php

/* index.html */
class __TwigTemplate_09914c39178eb3a4a2744b5d6e2167200c5ba807ae19e1fc78b958445110f66e extends yii\twig\Template
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
    <span>原始单号
        <input class=\"easyui-textbox\" type=\"text\" name=\"order\" id=\"order\">
    </span>
    <span>状态
        <select class=\"easyui-combobox\" id=\"status\" name=\"status\" data-options=\"required:true, panelHeight:'auto'\">
            <option value=\"all\">所有</option>
            <option value=\"1\">已提交</option>
            <option value=\"2\">审核通过</option>
            <option value=\"3\">审核未通过</option>
        </select>
    </span>
    <a href=\"javascript:void(0);\" onclick=\"reloadgrid();\" class=\"easyui-linkbutton\" iconCls=\"icon-search\">搜索</a>
</div>

<table id=\"listdata\"  class=\"easyui-datagrid\" title=\"申请列表\" data-options=\"toolbar:'#tb-user',singleSelect:true,pagination:true,method:'get',url:'";
        // line 27
        echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url("/money/index"), "html", null, true);
        echo "',mode:'local',pageSize:20\">
    <thead>
    <tr>
        <th data-options=\"field:'id', width:50, align:'center'\">序号</th>
        <th data-options=\"field:'name', width:200, align:'center'\" formatter=\"formatName\">会员</th>
        <th data-options=\"field:'money', width:100, align:'center'\" formatter=\"formatMoney\">金额</th>
        <th data-options=\"field:'reason', width:200, align:'center'\">原因</th>
        <th data-options=\"field:'order', width:100, align:'center'\">原始单号</th>
        <th data-options=\"field:'status', width:100, align:'center'\" formatter=\"formatStatus\">状态</th>
        <th data-options=\"field:'created_at', width:180, align:'center'\" formatter=\"formatTime\">申请时间</th>
    </tr>
    </thead>
</table>

<div id=\"tb-user\" style=\"height:auto\">
    <div>
        ";
        // line 43
        if (((isset($context["add"]) ? $context["add"] : null) == 1)) {
            // line 44
            echo "        <a href=\"javascript:void(0)\" class=\"easyui-linkbutton\" data-options=\"iconCls:'icon-add',plain:true\" onclick=\"add()\">新增</a>
        ";
        }
        // line 46
        echo "        ";
        if (((isset($context["edit"]) ? $context["edit"] : null) == 1)) {
            // line 47
            echo "        <a href=\"javascript:void(0)\" class=\"easyui-linkbutton\" data-options=\"iconCls:'icon-edit',plain:true\" onclick=\"edit()\">编辑</a>
        ";
        }
        // line 49
        echo "        <a href=\"javascript:void(0)\" class=\"easyui-linkbutton\" data-options=\"iconCls:'icon-tip',plain:true\" onclick=\"view()\">查看</a>
        ";
        // line 50
        if (((isset($context["financeApprove"]) ? $context["financeApprove"] : null) == 1)) {
            // line 51
            echo "        <a href=\"javascript:void(0)\" class=\"easyui-linkbutton\" data-options=\"iconCls:'icon-edit',plain:true\" onclick=\"financeApprove('open')\">财务审核</a>
        ";
        }
        // line 53
        echo "    </div>
</div>

<!--新增余额调整-->
<div id=\"dlg-add\" title=\"新增余额调整\" class=\"easyui-dialog\" style=\"width:350px;height:auto;padding:10px 20px\" modal=\"true\" closed=\"true\" buttons=\"#dlg-buttons-add\">
    ";
        // line 58
        echo $this->getAttribute((isset($context["html"]) ? $context["html"] : null), "beginForm", array(0 => "", 1 => "post", 2 => array("class" => "am-form am-form-horizontal", "id" => "addForm")), "method");
        echo "
    <table cellpadding=\"5\">
        <tr>
            <td>会员</td>
            <td><input class=\"easyui-textbox\" type=\"text\" data-options=\"required:true, prompt:'请输入会员手机号或邮箱', onChange: onChange\"></td>
        </tr>
        <tr>
            <td>当前余额</td>
            <td><input class=\"easyui-textbox\" type=\"text\" id=\"add_before_money\" data-options=\"readonly: true\"></td>
        </tr>
        <tr>
            <td>操作</td>
            <td>
                <input name=\"AdjustBalance[type]\" type=\"radio\" class=\"easyui-validatebox\" value=\"0\">增加
                <input name=\"AdjustBalance[type]\" type=\"radio\" class=\"easyui-validatebox\" value=\"1\">扣除
            </td>
        </tr>
        <tr>
            <td></td>
            <td>
                <input class=\"easyui-textbox\" type=\"text\" name=\"AdjustBalance[money]\" data-options=\"required:true\">
            </td>
        </tr>
        <tr>
            <td>调整原因</td>
            <td>
                <select class=\"easyui-combobox\" data-options=\"panelHeight:'auto', onSelect:onSelect,required:true\">
                    <option value=\"充值未到账\">充值未到账</option>
                    <option value=\"已扣款购买失败\">已扣款购买失败</option>
                    <option value=\"其他\">其他</option>
                </select>
            </td>
        </tr>
        <tr class=\"other\">
            <td></td>
            <td>
                <input class=\"easyui-textbox reason\" type=\"text\" name=\"AdjustBalance[reason]\" data-options=\"required:true\">
            </td>
        </tr>
        <tr>
            <td>原始单号</td>
            <td>
                <input class=\"easyui-textbox\" type=\"text\" name=\"AdjustBalance[order]\" data-options=\"required:true\">
            </td>
        </tr>
        <tr>
            <td>备注</td>
            <td>
                <textarea name=\"AdjustBalance[note]\" style=\"width: 173px; height: 100px\"></textarea>
            </td>
        </tr>
        <input type=\"hidden\" name=\"AdjustBalance[user_id]\" id=\"add_user_id\">
    </table>
    ";
        // line 111
        echo $this->getAttribute((isset($context["html"]) ? $context["html"] : null), "endForm", array(), "method");
        echo "
</div>

<div id=\"dlg-buttons-add\" style=\"text-align:center;padding:5px\">
    <a class=\"easyui-linkbutton\" iconCls=\"icon-ok\" onclick=\"save('add')\">确定</a>
    <a class=\"easyui-linkbutton\" iconCls=\"icon-cancel\" onclick=\"javascript:\$('#dlg-add').dialog('close')\">取消</a>
</div>
<!--新增余额调整-->

<!--编辑余额调整-->
<div id=\"dlg-edit\" title=\"编辑余额调整\" class=\"easyui-dialog\" style=\"width:350px;height:auto;padding:10px 20px\" modal=\"true\" closed=\"true\" buttons=\"#dlg-buttons-edit\">
    ";
        // line 122
        echo $this->getAttribute((isset($context["html"]) ? $context["html"] : null), "beginForm", array(0 => "", 1 => "post", 2 => array("class" => "am-form am-form-horizontal", "id" => "editForm")), "method");
        echo "
    <table cellpadding=\"5\">
        <tr>
            <td>会员</td>
            <td><input class=\"easyui-textbox\" type=\"text\" id=\"edit_account\" data-options=\"readonly: true\"></td>
        </tr>
        <tr>
            <td>当前余额</td>
            <td><input class=\"easyui-textbox\" type=\"text\" id=\"before_money\" data-options=\"readonly: true\"></td>
        </tr>
        <tr>
            <td>操作</td>
            <td>
                <input name=\"AdjustBalance[type]\" type=\"radio\" class=\"easyui-validatebox\" value=\"0\">增加
                <input name=\"AdjustBalance[type]\" type=\"radio\" class=\"easyui-validatebox\" value=\"1\">扣除
            </td>
        </tr>
        <tr>
            <td></td>
            <td>
                <input class=\"easyui-textbox\" type=\"text\" name=\"AdjustBalance[money]\" data-options=\"required:true\">
            </td>
        </tr>
        <tr>
            <td>调整原因</td>
            <td>
                <select class=\"easyui-combobox\" id=\"edit_reason\" data-options=\"panelHeight:'auto', onSelect:onSelect,required:true\">
                    <option value=\"充值未到账\">充值未到账</option>
                    <option value=\"已扣款购买失败\">已扣款购买失败</option>
                    <option value=\"其他\">其他</option>
                </select>
            </td>
        </tr>
        <tr class=\"other\">
            <td></td>
            <td>
                <input class=\"easyui-textbox reason\" type=\"text\" name=\"AdjustBalance[reason]\" data-options=\"required:true\">
            </td>
        </tr>
        <tr>
            <td>原始单号</td>
            <td>
                <input class=\"easyui-textbox\" type=\"text\" name=\"AdjustBalance[order]\" data-options=\"required:true\">
            </td>
        </tr>
        <tr>
            <td>备注</td>
            <td>
                <textarea name=\"AdjustBalance[note]\" style=\"width: 173px; height: 100px\"></textarea>
            </td>
        </tr>
        <input type=\"hidden\" name=\"AdjustBalance[user_id]\" class=\"user_id\">
    </table>
    ";
        // line 175
        echo $this->getAttribute((isset($context["html"]) ? $context["html"] : null), "endForm", array(), "method");
        echo "
</div>

<div id=\"dlg-buttons-edit\" style=\"text-align:center;padding:5px\">
    <a class=\"easyui-linkbutton\" iconCls=\"icon-ok\" onclick=\"save('edit')\">确定</a>
    <a class=\"easyui-linkbutton\" iconCls=\"icon-cancel\" onclick=\"javascript:\$('#dlg-edit').dialog('close')\">取消</a>
</div>
<!--编辑余额调整-->

<!--查看余额调整-->
<div id=\"dlg-view\" title=\"查看余额调整\" class=\"easyui-dialog\" style=\"width:450px;height:auto;padding:10px 20px\" modal=\"true\" closed=\"true\">
    <table cellpadding=\"5\">
        <tr>
            <td style=\"width: 100px\">会员</td>
            <td id=\"view_account\"></td>
        </tr>
        <tr>
            <td>当前余额</td>
            <td id=\"view_money\"></td>
        </tr>
        <tr>
            <td>操作</td>
            <td id=\"view_type\"></td>
        </tr>
        <tr>
            <td>调整原因</td>
            <td id=\"view_reason\"></td>
        </tr>
        <tr>
            <td>原始单号</td>
            <td id=\"view_order\"></td>
        </tr>
        <tr>
            <td>备注</td>
            <td id=\"view_note\"></td>
        </tr>
        <tr>
            <td>提交人</td>
            <td id=\"view_name\"></td>
        </tr>
        <tr>
            <td>提交日期</td>
            <td id=\"view_time\"></td>
        </tr>
        <tr>
            <td>状态</td>
            <td id=\"view_status\"></td>
        </tr>
        <tr class=\"view_approve\">
            <td>审核人</td>
            <td id=\"view_approve_name\"></td>
        </tr>
        <tr class=\"view_approve\">
            <td>审核时间</td>
            <td id=\"view_approve_time\"></td>
        </tr>
    </table>
</div>
<!--查看余额调整-->

<!--财务审核-->
<div id=\"dlg-finance-approve\" title=\"财务审核\" class=\"easyui-dialog\" style=\"width:450px;height:auto;padding:10px 20px\" modal=\"true\" closed=\"true\" buttons=\"#dlg-buttons-finance-approve\">
    ";
        // line 237
        echo $this->getAttribute((isset($context["html"]) ? $context["html"] : null), "beginForm", array(0 => "", 1 => "post", 2 => array("class" => "am-form am-form-horizontal", "id" => "financeApproveForm")), "method");
        echo "
    <table cellpadding=\"5\">
        <tr>
            <td style=\"width: 100px\">审核</td>
            <td>
                <select class=\"easyui-combobox\" name=\"status\" data-options=\"panelHeight:'auto', onSelect:approveOnSelect,required:true\">
                    <option value=\"2\">审核通过</option>
                    <option value=\"3\">审核不通过</option>
                </select>
            </td>
        </tr>
        <tr id=\"approve_fail\">
            <td>不通过原因</td>
            <td>
                <textarea name=\"fail_reason\" id=\"fail_reason\" style=\"width: 260px; height: 100px\"></textarea>
            </td>
        </tr>
    </table>
    ";
        // line 255
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

    // line 264
    public function block_js($context, array $blocks = array())
    {
        // line 265
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

    function onSelect(record) {
        if (record.value == '其他') {
            \$('.other').show();
            \$('.reason').textbox('setValue', '');
        } else {
            \$('.other').hide();
            \$('.reason').textbox('setValue', record.value);
        }
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
        if (val == 1) {
            return '已提交';
        } else if (val == 2) {
            return '审核通过';
        } else {
            return '审核未通过';
        }
    }

    function formatMoney(val, row) {
        if (row.type == 0) {
            return '+' + row.money;
        } else {
            return '-' + row.money;
        }
    }

    function add() {
        \$('#addForm').form('clear');
        \$('#dlg-add').window('open');
        \$('.other').hide();
    }

    function edit() {
        var selRow = \$('#listdata').datagrid('getSelected');
        if (!selRow) {
            \$.messager.alert('错误','请选择余额申请');
            return false;
        }

        \$('#editForm').form('clear');
        if (selRow.reason == '充值未到账' || selRow.reason == '已扣款购买失败') {
            \$('#edit_reason').combobox('setValue', selRow.reason);
            \$('.other').hide();
        } else {
            \$('#edit_reason').combobox('setValue', '其他');
            \$('.other').show();
        }

        \$.get('/money/user-info', {'id': selRow.user_id}, function(data) {
            if (data.error == 0) {
                \$('#before_money').textbox('setValue', data.message['money']);
                if (selRow.phone) {
                    \$('#edit_account').textbox('setValue', selRow.phone);
                } else {
                    \$('#edit_account').textbox('setValue', selRow.email);
                }
            } else {
                \$.messager.alert('错误', data.message);
                return false;
            }
        });

        \$('#dlg-edit').form('load',{
            'AdjustBalance[type]' : selRow.type,
            'AdjustBalance[money]' : selRow.money,
            'AdjustBalance[reason]' : selRow.reason,
            'AdjustBalance[order]' : selRow.order,
            'AdjustBalance[note]' : selRow.note,
            'AdjustBalance[user_id]': selRow.user_id
        });
        \$('#dlg-edit').window('open');
    }

    function save(flag) {
        if (flag == 'edit') {
            var selRow = \$('#listdata').datagrid('getSelected');
            var url = '/money/edit?id=' + selRow.id;
            var form = 'editForm';
        } else if (flag == 'add') {
            var url = '/money/add';
            var form = 'addForm';
        }

        \$('#' + form).form({
            url: url,
            onSubmit:function(){
                return \$(this).form('enableValidation').form('validate');
            },
            success: function (data) {
                data = eval('(' + data + ')');
                if (data.error == 0) {
                    \$.messager.alert('成功', data.message);
                    \$('#dlg-' + flag).window('close');
                    reloadgrid();
                } else {
                    \$.messager.alert('失败', data.message, 'error');
                }
            }
        });
        \$('#' + form).submit();
    }

    function view() {
        var selRow = \$('#listdata').treegrid('getSelected');
        if (!selRow) {
            \$.messager.alert('错误','请选择余额调整');
            return false;
        }

        \$('#view_account').html(formatName(0, selRow));
        \$.get('/money/user-info', {'id': selRow.user_id}, function(data) {
            if (data.error == 0) {
                \$('#view_money').html(data.message['money']);
            } else {
                \$.messager.alert('错误', data.message);
                return false;
            }
        });
        if (selRow.type == 0) {
            \$('#view_type').html('+' + selRow.money);
        } else {
            \$('#view_type').html('-' + selRow.money);
        }
        \$('#view_reason').html(selRow.reason);
        \$('#view_order').html(selRow.order);
        \$('#view_note').html(selRow.note);
        \$('#view_name').html(selRow.admin_name);
        \$('#view_time').html(formatTime(selRow.created_at, selRow));
        if (selRow.status == 1) {
            \$('#view_status').html('已提交');
            \$('.view_approve').hide();
        } else {
            if (selRow.status == 2) {
                \$('#view_status').html('审核通过');
            } else {
                \$('#view_status').html('审核未通过');
            }
            \$('#view_approve_name').html(selRow.approve_admin_name);
            \$('#view_approve_time').html(formatTime(selRow.updated_at, selRow));
            \$('.view_approve').show();
        }

        \$('#dlg-view').window('open');
    }

    function approveOnSelect(newValue, oldValue) {
        if (newValue.value == 3) {
            \$('#approve_fail').show();
        } else {
            \$('#fail_reason').empty();
            \$('#approve_fail').hide();
        }
    }

    function financeApprove(action) {
        var selRow = \$('#listdata').datagrid('getSelected');
        if (!selRow) {
            \$.messager.alert('错误','请选择余额申请');
            return false;
        }
        if (selRow.status != 1) {
            \$.messager.alert('错误','该申请已审核');
            return false;
        }
        if (action == 'open') {
            \$('#approve_fail').hide();
            \$('#dlg-finance-approve').window('open');
        } else if (action == 'submit') {
            var selRow = \$('#listdata').datagrid('getSelected');
            var url = '/money/finance-approve?id=' + selRow.id;

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
        return array (  332 => 265,  329 => 264,  317 => 255,  296 => 237,  231 => 175,  175 => 122,  161 => 111,  105 => 58,  98 => 53,  94 => 51,  92 => 50,  89 => 49,  85 => 47,  82 => 46,  78 => 44,  76 => 43,  57 => 27,  32 => 4,  29 => 3,  11 => 1,);
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
/*     <span>原始单号*/
/*         <input class="easyui-textbox" type="text" name="order" id="order">*/
/*     </span>*/
/*     <span>状态*/
/*         <select class="easyui-combobox" id="status" name="status" data-options="required:true, panelHeight:'auto'">*/
/*             <option value="all">所有</option>*/
/*             <option value="1">已提交</option>*/
/*             <option value="2">审核通过</option>*/
/*             <option value="3">审核未通过</option>*/
/*         </select>*/
/*     </span>*/
/*     <a href="javascript:void(0);" onclick="reloadgrid();" class="easyui-linkbutton" iconCls="icon-search">搜索</a>*/
/* </div>*/
/* */
/* <table id="listdata"  class="easyui-datagrid" title="申请列表" data-options="toolbar:'#tb-user',singleSelect:true,pagination:true,method:'get',url:'{{  url('/money/index')}}',mode:'local',pageSize:20">*/
/*     <thead>*/
/*     <tr>*/
/*         <th data-options="field:'id', width:50, align:'center'">序号</th>*/
/*         <th data-options="field:'name', width:200, align:'center'" formatter="formatName">会员</th>*/
/*         <th data-options="field:'money', width:100, align:'center'" formatter="formatMoney">金额</th>*/
/*         <th data-options="field:'reason', width:200, align:'center'">原因</th>*/
/*         <th data-options="field:'order', width:100, align:'center'">原始单号</th>*/
/*         <th data-options="field:'status', width:100, align:'center'" formatter="formatStatus">状态</th>*/
/*         <th data-options="field:'created_at', width:180, align:'center'" formatter="formatTime">申请时间</th>*/
/*     </tr>*/
/*     </thead>*/
/* </table>*/
/* */
/* <div id="tb-user" style="height:auto">*/
/*     <div>*/
/*         {% if add == 1 %}*/
/*         <a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-add',plain:true" onclick="add()">新增</a>*/
/*         {% endif %}*/
/*         {% if edit == 1 %}*/
/*         <a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-edit',plain:true" onclick="edit()">编辑</a>*/
/*         {% endif %}*/
/*         <a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-tip',plain:true" onclick="view()">查看</a>*/
/*         {% if financeApprove == 1 %}*/
/*         <a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-edit',plain:true" onclick="financeApprove('open')">财务审核</a>*/
/*         {% endif %}*/
/*     </div>*/
/* </div>*/
/* */
/* <!--新增余额调整-->*/
/* <div id="dlg-add" title="新增余额调整" class="easyui-dialog" style="width:350px;height:auto;padding:10px 20px" modal="true" closed="true" buttons="#dlg-buttons-add">*/
/*     {{ html.beginForm('', 'post', {'class':'am-form am-form-horizontal', 'id':'addForm'}) | raw }}*/
/*     <table cellpadding="5">*/
/*         <tr>*/
/*             <td>会员</td>*/
/*             <td><input class="easyui-textbox" type="text" data-options="required:true, prompt:'请输入会员手机号或邮箱', onChange: onChange"></td>*/
/*         </tr>*/
/*         <tr>*/
/*             <td>当前余额</td>*/
/*             <td><input class="easyui-textbox" type="text" id="add_before_money" data-options="readonly: true"></td>*/
/*         </tr>*/
/*         <tr>*/
/*             <td>操作</td>*/
/*             <td>*/
/*                 <input name="AdjustBalance[type]" type="radio" class="easyui-validatebox" value="0">增加*/
/*                 <input name="AdjustBalance[type]" type="radio" class="easyui-validatebox" value="1">扣除*/
/*             </td>*/
/*         </tr>*/
/*         <tr>*/
/*             <td></td>*/
/*             <td>*/
/*                 <input class="easyui-textbox" type="text" name="AdjustBalance[money]" data-options="required:true">*/
/*             </td>*/
/*         </tr>*/
/*         <tr>*/
/*             <td>调整原因</td>*/
/*             <td>*/
/*                 <select class="easyui-combobox" data-options="panelHeight:'auto', onSelect:onSelect,required:true">*/
/*                     <option value="充值未到账">充值未到账</option>*/
/*                     <option value="已扣款购买失败">已扣款购买失败</option>*/
/*                     <option value="其他">其他</option>*/
/*                 </select>*/
/*             </td>*/
/*         </tr>*/
/*         <tr class="other">*/
/*             <td></td>*/
/*             <td>*/
/*                 <input class="easyui-textbox reason" type="text" name="AdjustBalance[reason]" data-options="required:true">*/
/*             </td>*/
/*         </tr>*/
/*         <tr>*/
/*             <td>原始单号</td>*/
/*             <td>*/
/*                 <input class="easyui-textbox" type="text" name="AdjustBalance[order]" data-options="required:true">*/
/*             </td>*/
/*         </tr>*/
/*         <tr>*/
/*             <td>备注</td>*/
/*             <td>*/
/*                 <textarea name="AdjustBalance[note]" style="width: 173px; height: 100px"></textarea>*/
/*             </td>*/
/*         </tr>*/
/*         <input type="hidden" name="AdjustBalance[user_id]" id="add_user_id">*/
/*     </table>*/
/*     {{ html.endForm() | raw }}*/
/* </div>*/
/* */
/* <div id="dlg-buttons-add" style="text-align:center;padding:5px">*/
/*     <a class="easyui-linkbutton" iconCls="icon-ok" onclick="save('add')">确定</a>*/
/*     <a class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg-add').dialog('close')">取消</a>*/
/* </div>*/
/* <!--新增余额调整-->*/
/* */
/* <!--编辑余额调整-->*/
/* <div id="dlg-edit" title="编辑余额调整" class="easyui-dialog" style="width:350px;height:auto;padding:10px 20px" modal="true" closed="true" buttons="#dlg-buttons-edit">*/
/*     {{ html.beginForm('', 'post', {'class':'am-form am-form-horizontal', 'id':'editForm'}) | raw }}*/
/*     <table cellpadding="5">*/
/*         <tr>*/
/*             <td>会员</td>*/
/*             <td><input class="easyui-textbox" type="text" id="edit_account" data-options="readonly: true"></td>*/
/*         </tr>*/
/*         <tr>*/
/*             <td>当前余额</td>*/
/*             <td><input class="easyui-textbox" type="text" id="before_money" data-options="readonly: true"></td>*/
/*         </tr>*/
/*         <tr>*/
/*             <td>操作</td>*/
/*             <td>*/
/*                 <input name="AdjustBalance[type]" type="radio" class="easyui-validatebox" value="0">增加*/
/*                 <input name="AdjustBalance[type]" type="radio" class="easyui-validatebox" value="1">扣除*/
/*             </td>*/
/*         </tr>*/
/*         <tr>*/
/*             <td></td>*/
/*             <td>*/
/*                 <input class="easyui-textbox" type="text" name="AdjustBalance[money]" data-options="required:true">*/
/*             </td>*/
/*         </tr>*/
/*         <tr>*/
/*             <td>调整原因</td>*/
/*             <td>*/
/*                 <select class="easyui-combobox" id="edit_reason" data-options="panelHeight:'auto', onSelect:onSelect,required:true">*/
/*                     <option value="充值未到账">充值未到账</option>*/
/*                     <option value="已扣款购买失败">已扣款购买失败</option>*/
/*                     <option value="其他">其他</option>*/
/*                 </select>*/
/*             </td>*/
/*         </tr>*/
/*         <tr class="other">*/
/*             <td></td>*/
/*             <td>*/
/*                 <input class="easyui-textbox reason" type="text" name="AdjustBalance[reason]" data-options="required:true">*/
/*             </td>*/
/*         </tr>*/
/*         <tr>*/
/*             <td>原始单号</td>*/
/*             <td>*/
/*                 <input class="easyui-textbox" type="text" name="AdjustBalance[order]" data-options="required:true">*/
/*             </td>*/
/*         </tr>*/
/*         <tr>*/
/*             <td>备注</td>*/
/*             <td>*/
/*                 <textarea name="AdjustBalance[note]" style="width: 173px; height: 100px"></textarea>*/
/*             </td>*/
/*         </tr>*/
/*         <input type="hidden" name="AdjustBalance[user_id]" class="user_id">*/
/*     </table>*/
/*     {{ html.endForm() | raw }}*/
/* </div>*/
/* */
/* <div id="dlg-buttons-edit" style="text-align:center;padding:5px">*/
/*     <a class="easyui-linkbutton" iconCls="icon-ok" onclick="save('edit')">确定</a>*/
/*     <a class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg-edit').dialog('close')">取消</a>*/
/* </div>*/
/* <!--编辑余额调整-->*/
/* */
/* <!--查看余额调整-->*/
/* <div id="dlg-view" title="查看余额调整" class="easyui-dialog" style="width:450px;height:auto;padding:10px 20px" modal="true" closed="true">*/
/*     <table cellpadding="5">*/
/*         <tr>*/
/*             <td style="width: 100px">会员</td>*/
/*             <td id="view_account"></td>*/
/*         </tr>*/
/*         <tr>*/
/*             <td>当前余额</td>*/
/*             <td id="view_money"></td>*/
/*         </tr>*/
/*         <tr>*/
/*             <td>操作</td>*/
/*             <td id="view_type"></td>*/
/*         </tr>*/
/*         <tr>*/
/*             <td>调整原因</td>*/
/*             <td id="view_reason"></td>*/
/*         </tr>*/
/*         <tr>*/
/*             <td>原始单号</td>*/
/*             <td id="view_order"></td>*/
/*         </tr>*/
/*         <tr>*/
/*             <td>备注</td>*/
/*             <td id="view_note"></td>*/
/*         </tr>*/
/*         <tr>*/
/*             <td>提交人</td>*/
/*             <td id="view_name"></td>*/
/*         </tr>*/
/*         <tr>*/
/*             <td>提交日期</td>*/
/*             <td id="view_time"></td>*/
/*         </tr>*/
/*         <tr>*/
/*             <td>状态</td>*/
/*             <td id="view_status"></td>*/
/*         </tr>*/
/*         <tr class="view_approve">*/
/*             <td>审核人</td>*/
/*             <td id="view_approve_name"></td>*/
/*         </tr>*/
/*         <tr class="view_approve">*/
/*             <td>审核时间</td>*/
/*             <td id="view_approve_time"></td>*/
/*         </tr>*/
/*     </table>*/
/* </div>*/
/* <!--查看余额调整-->*/
/* */
/* <!--财务审核-->*/
/* <div id="dlg-finance-approve" title="财务审核" class="easyui-dialog" style="width:450px;height:auto;padding:10px 20px" modal="true" closed="true" buttons="#dlg-buttons-finance-approve">*/
/*     {{ html.beginForm('', 'post', {'class':'am-form am-form-horizontal', 'id':'financeApproveForm'}) | raw }}*/
/*     <table cellpadding="5">*/
/*         <tr>*/
/*             <td style="width: 100px">审核</td>*/
/*             <td>*/
/*                 <select class="easyui-combobox" name="status" data-options="panelHeight:'auto', onSelect:approveOnSelect,required:true">*/
/*                     <option value="2">审核通过</option>*/
/*                     <option value="3">审核不通过</option>*/
/*                 </select>*/
/*             </td>*/
/*         </tr>*/
/*         <tr id="approve_fail">*/
/*             <td>不通过原因</td>*/
/*             <td>*/
/*                 <textarea name="fail_reason" id="fail_reason" style="width: 260px; height: 100px"></textarea>*/
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
/*     function onSelect(record) {*/
/*         if (record.value == '其他') {*/
/*             $('.other').show();*/
/*             $('.reason').textbox('setValue', '');*/
/*         } else {*/
/*             $('.other').hide();*/
/*             $('.reason').textbox('setValue', record.value);*/
/*         }*/
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
/*         if (val == 1) {*/
/*             return '已提交';*/
/*         } else if (val == 2) {*/
/*             return '审核通过';*/
/*         } else {*/
/*             return '审核未通过';*/
/*         }*/
/*     }*/
/* */
/*     function formatMoney(val, row) {*/
/*         if (row.type == 0) {*/
/*             return '+' + row.money;*/
/*         } else {*/
/*             return '-' + row.money;*/
/*         }*/
/*     }*/
/* */
/*     function add() {*/
/*         $('#addForm').form('clear');*/
/*         $('#dlg-add').window('open');*/
/*         $('.other').hide();*/
/*     }*/
/* */
/*     function edit() {*/
/*         var selRow = $('#listdata').datagrid('getSelected');*/
/*         if (!selRow) {*/
/*             $.messager.alert('错误','请选择余额申请');*/
/*             return false;*/
/*         }*/
/* */
/*         $('#editForm').form('clear');*/
/*         if (selRow.reason == '充值未到账' || selRow.reason == '已扣款购买失败') {*/
/*             $('#edit_reason').combobox('setValue', selRow.reason);*/
/*             $('.other').hide();*/
/*         } else {*/
/*             $('#edit_reason').combobox('setValue', '其他');*/
/*             $('.other').show();*/
/*         }*/
/* */
/*         $.get('/money/user-info', {'id': selRow.user_id}, function(data) {*/
/*             if (data.error == 0) {*/
/*                 $('#before_money').textbox('setValue', data.message['money']);*/
/*                 if (selRow.phone) {*/
/*                     $('#edit_account').textbox('setValue', selRow.phone);*/
/*                 } else {*/
/*                     $('#edit_account').textbox('setValue', selRow.email);*/
/*                 }*/
/*             } else {*/
/*                 $.messager.alert('错误', data.message);*/
/*                 return false;*/
/*             }*/
/*         });*/
/* */
/*         $('#dlg-edit').form('load',{*/
/*             'AdjustBalance[type]' : selRow.type,*/
/*             'AdjustBalance[money]' : selRow.money,*/
/*             'AdjustBalance[reason]' : selRow.reason,*/
/*             'AdjustBalance[order]' : selRow.order,*/
/*             'AdjustBalance[note]' : selRow.note,*/
/*             'AdjustBalance[user_id]': selRow.user_id*/
/*         });*/
/*         $('#dlg-edit').window('open');*/
/*     }*/
/* */
/*     function save(flag) {*/
/*         if (flag == 'edit') {*/
/*             var selRow = $('#listdata').datagrid('getSelected');*/
/*             var url = '/money/edit?id=' + selRow.id;*/
/*             var form = 'editForm';*/
/*         } else if (flag == 'add') {*/
/*             var url = '/money/add';*/
/*             var form = 'addForm';*/
/*         }*/
/* */
/*         $('#' + form).form({*/
/*             url: url,*/
/*             onSubmit:function(){*/
/*                 return $(this).form('enableValidation').form('validate');*/
/*             },*/
/*             success: function (data) {*/
/*                 data = eval('(' + data + ')');*/
/*                 if (data.error == 0) {*/
/*                     $.messager.alert('成功', data.message);*/
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
/*     function view() {*/
/*         var selRow = $('#listdata').treegrid('getSelected');*/
/*         if (!selRow) {*/
/*             $.messager.alert('错误','请选择余额调整');*/
/*             return false;*/
/*         }*/
/* */
/*         $('#view_account').html(formatName(0, selRow));*/
/*         $.get('/money/user-info', {'id': selRow.user_id}, function(data) {*/
/*             if (data.error == 0) {*/
/*                 $('#view_money').html(data.message['money']);*/
/*             } else {*/
/*                 $.messager.alert('错误', data.message);*/
/*                 return false;*/
/*             }*/
/*         });*/
/*         if (selRow.type == 0) {*/
/*             $('#view_type').html('+' + selRow.money);*/
/*         } else {*/
/*             $('#view_type').html('-' + selRow.money);*/
/*         }*/
/*         $('#view_reason').html(selRow.reason);*/
/*         $('#view_order').html(selRow.order);*/
/*         $('#view_note').html(selRow.note);*/
/*         $('#view_name').html(selRow.admin_name);*/
/*         $('#view_time').html(formatTime(selRow.created_at, selRow));*/
/*         if (selRow.status == 1) {*/
/*             $('#view_status').html('已提交');*/
/*             $('.view_approve').hide();*/
/*         } else {*/
/*             if (selRow.status == 2) {*/
/*                 $('#view_status').html('审核通过');*/
/*             } else {*/
/*                 $('#view_status').html('审核未通过');*/
/*             }*/
/*             $('#view_approve_name').html(selRow.approve_admin_name);*/
/*             $('#view_approve_time').html(formatTime(selRow.updated_at, selRow));*/
/*             $('.view_approve').show();*/
/*         }*/
/* */
/*         $('#dlg-view').window('open');*/
/*     }*/
/* */
/*     function approveOnSelect(newValue, oldValue) {*/
/*         if (newValue.value == 3) {*/
/*             $('#approve_fail').show();*/
/*         } else {*/
/*             $('#fail_reason').empty();*/
/*             $('#approve_fail').hide();*/
/*         }*/
/*     }*/
/* */
/*     function financeApprove(action) {*/
/*         var selRow = $('#listdata').datagrid('getSelected');*/
/*         if (!selRow) {*/
/*             $.messager.alert('错误','请选择余额申请');*/
/*             return false;*/
/*         }*/
/*         if (selRow.status != 1) {*/
/*             $.messager.alert('错误','该申请已审核');*/
/*             return false;*/
/*         }*/
/*         if (action == 'open') {*/
/*             $('#approve_fail').hide();*/
/*             $('#dlg-finance-approve').window('open');*/
/*         } else if (action == 'submit') {*/
/*             var selRow = $('#listdata').datagrid('getSelected');*/
/*             var url = '/money/finance-approve?id=' + selRow.id;*/
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
/* */
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
