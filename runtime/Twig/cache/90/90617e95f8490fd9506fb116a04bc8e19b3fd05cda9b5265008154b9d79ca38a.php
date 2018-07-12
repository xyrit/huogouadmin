<?php

/* index.html */
class __TwigTemplate_77318cbd8a50d347de65d66e5e0d278ea5e390c731a4e9bde1cb7af19f6caf56 extends yii\twig\Template
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
        echo "  <style>
    .datagrid-btable tr{height: 64px!important;}
  </style>
  <div class=\"search\">
    <span>商品名称 <input class=\"easyui-textbox\" type=\"text\"  name=\"account\" id=\"name\"></span>
    <span>商品编号 <input class=\"easyui-textbox\" type=\"text\"  name=\"id\" id=\"id\" style=\"width:100px;\"></span>
    <span>状态
        <select class=\"easyui-combobox\" id=\"marketable\" name=\"marketable\" data-options=\"panelHeight:'auto'\">
          <option value=\"all\">所有</option>
          <option value=\"1\">上架</option>
          <option value=\"0\">下架</option>
          <option value=\"2\">新增</option>
        </select>
    </span>
    <a href=\"javascript:void(0);\" onclick=\"reloadgrid();\" class=\"easyui-linkbutton\" iconCls=\"icon-search\">搜索</a>
  </div>

  <table id=\"listdata\" class=\"easyui-datagrid\" title=\"商品列表\"
         data-options=\"
            toolbar:'#tb-user',
            rownumbers:true,
            singleSelect:true,
            pagination:true,
            method:'get',
            url:'";
        // line 28
        echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url("free-product/index", array("status" => (isset($context["status"]) ? $context["status"] : null))), "html", null, true);
        echo "',
            rownumbers: false,
            nowrap:false
        \">
    <thead>
    <tr>
      <!--<th data-options=\"field:'ck', checkbox: true\">-->
      <th data-options=\"field:'id', width:80, align:'center'\">商品编号</th>
      <th data-options=\"field:'picture', width:66\" formatter=\"formatPicture\">&nbsp;</th>
      <th data-options=\"field:'name', width:500\" formatter=\"formatName\">商品名称</th>
      <th data-options=\"field:'price', width:100, align:'center'\">伙购价</th>
      <th data-options=\"field:'total_period', width:80, align:'center',sortable:true\">伙购期数</th>
      <th data-options=\"field:'total_period', width:80, align:'center'\">总期数</th>
      <th data-options=\"field:'marketable', width:80, align:'center'\" formatter=\"formatStatus\">状态</th>
      <th data-options=\"field:'created_at', width:180, sortable:true\" formatter=\"formatTime\">创建时间</th>
    </tr>
    </thead>
  </table>

  <div id=\"tb-user\" style=\"height:auto\">
    <div>
      <a href=\"javascript:void(0)\" class=\"easyui-linkbutton\" data-options=\"iconCls:'icon-add',plain:true\" onclick=\"add()\">新增</a>
      <a href=\"javascript:void(0)\" class=\"easyui-linkbutton\" data-options=\"iconCls:'icon-edit',plain:true\" onclick=\"edit()\">编辑</a>
      <a href=\"javascript:void(0)\" class=\"easyui-linkbutton\" data-options=\"iconCls:'icon-ok',plain:true\" onclick=\"up()\">上架</a>
      <a href=\"javascript:void(0)\" class=\"easyui-linkbutton\" data-options=\"iconCls:'icon-no',plain:true\" onclick=\"down()\">下架</a>
      <a href=\"javascript:void(0)\" class=\"easyui-linkbutton\" data-options=\"iconCls:'icon-redo',plain:true\" onclick=\"del()\">删除</a>
      <a href=\"javascript:void(0)\" class=\"easyui-linkbutton\" data-options=\"iconCls:'icon-tip',plain:true\" onclick=\"lotteryRecord()\">查看开奖明细</a>
    </div>
  </div>

  <div id=\"dlg-add\" class=\"easyui-window\" title=\"新增商品\" style=\"width:1242px;height:750px;padding:10px;overflow:hidden;\" data-options=\"
            iconCls:'icon-save',
            closed:true,
            modal:true,
            onResize:function(){
                \$(this).window('hcenter');
            }\">
    <iframe width=\"100%\" height=\"100%\" frameborder=\"0\" id=\"add_iframe\">
    </iframe>
  </div>

  <div id=\"dlg-edit\" class=\"easyui-window\" title=\"编辑商品\" style=\"width:1242px;height:750px;padding:10px;overflow:hidden;\" data-options=\"
            iconCls:'icon-save',
            closed:true,
            modal:true,
            onResize:function(){
                \$(this).window('hcenter');
            }\">
    <iframe width=\"100%\" height=\"100%\" frameborder=\"0\" id=\"edit_iframe\">
    </iframe>
  </div>

";
    }

    // line 82
    public function block_js($context, array $blocks = array())
    {
        // line 83
        echo "  <script>
    function reloadgrid(){
      var queryParams = \$('#listdata').datagrid('options').queryParams;
      queryParams.name = \$('#name').val();
      queryParams.id\t= \$('#id').val();
      queryParams.marketable\t= \$('#marketable').combobox('getValue');
      \$('#listdata').datagrid('options').queryParams = queryParams;
      \$(\"#listdata\").datagrid('reload');
    }

    //格式化
    function formatPicture(val, row) {
      product_image_url = createActiveImgUrl(row.picture, 'small');
      return '<img src=\"'+product_image_url+'\" style=\"width: 60px;height:60px;\">';
    }

    function formatName(val, row) {
      return val;
    }

    function formatStatus(val, row) {
      if (val == 0) {
        return '下架';
      } else if (val == 1) {
        return '上架';
      } else if (val == 2) {
        return '新增';
      }
    }

    function formatTime(val, row) {
        var newDate_attend = new Date();
        newDate_attend.setTime(val * 1000);
        var my_create_time_attend=newDate_attend.format('yyyy-MM-dd hh:mm:ss');
        return my_create_time_attend;
    }

    //操作
    function add() {
      \$('#add_iframe').prop('src', \"";
        // line 122
        echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url("free-product/add"), "html", null, true);
        echo "\");
      \$('#dlg-add').window('open');
    }

    function edit() {
      var selRow = \$('#listdata').datagrid('getSelected');
      if (!selRow) {
        \$.messager.alert('错误','请选择商品');
        return false;
      }
      \$('#edit_iframe').prop('src', \"";
        // line 132
        echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url("free-product/edit"), "html", null, true);
        echo "\" + '?id=' + selRow.id);
      \$('#dlg-edit').window('open');
    }

    function up() {
      var selRow = \$('#listdata').datagrid('getSelected');
      if (!selRow) {
        \$.messager.alert('错误','请选择商品');
        return false;
      }

      if (selRow.marketable == 1) {
        \$.messager.alert('错误','该商品已上架');
        return false;
      }

      \$.messager.confirm('Confirm', '确认上架吗?', function(r){
        if (r){
          \$.post(\"";
        // line 150
        echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url("/free-product/market"), "html", null, true);
        echo "\", {'id':selRow.id, 'market':1}, function(data) {
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

    function down() {
      var selRow = \$('#listdata').datagrid('getSelected');
      if (!selRow) {
        \$.messager.alert('错误','请选择商品');
        return false;
      }
      console.log(selRow.marketable);
      if (selRow.marketable == 0) {
        \$.messager.alert('错误','该商品已下架');
        return false;
      }

      \$.messager.confirm('Confirm', '确认下架吗?', function(r){
        if (r){
          \$.post(\"";
        // line 176
        echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url("/free-product/market"), "html", null, true);
        echo "\", {'id':selRow.id, 'market':0}, function(data) {
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

    function del() {
      var selRow = \$('#listdata').datagrid('getSelected');
      if (!selRow) {
        \$.messager.alert('错误','请选择商品');
        return false;
      }

      if (selRow.marketable != 2) {
        \$.messager.alert('错误','只有新增商品才能删除');
        return false;
      }

      \$.messager.confirm('Confirm', '确认删除吗?', function(r) {
        if (r) {
          \$.post(\"";
        // line 202
        echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url("/free-product/del"), "html", null, true);
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

    function lotteryRecord() {
      var selRow = \$('#listdata').datagrid('getSelected');
      if (!selRow) {
        \$.messager.alert('错误','请选择商品');
        return false;
      }
      var goodsId = selRow.id;
      location.href = \"";
        // line 221
        echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url("/free-product/lottery-record"), "html", null, true);
        echo "?id=\"+goodsId;
    }

    function sort(type, order) {

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
        return array (  273 => 221,  251 => 202,  222 => 176,  193 => 150,  172 => 132,  159 => 122,  118 => 83,  115 => 82,  58 => 28,  32 => 4,  29 => 3,  11 => 1,);
    }
}
/* {% extends '@app/views/base.html' %}*/
/* */
/* {% block main %}*/
/*   <style>*/
/*     .datagrid-btable tr{height: 64px!important;}*/
/*   </style>*/
/*   <div class="search">*/
/*     <span>商品名称 <input class="easyui-textbox" type="text"  name="account" id="name"></span>*/
/*     <span>商品编号 <input class="easyui-textbox" type="text"  name="id" id="id" style="width:100px;"></span>*/
/*     <span>状态*/
/*         <select class="easyui-combobox" id="marketable" name="marketable" data-options="panelHeight:'auto'">*/
/*           <option value="all">所有</option>*/
/*           <option value="1">上架</option>*/
/*           <option value="0">下架</option>*/
/*           <option value="2">新增</option>*/
/*         </select>*/
/*     </span>*/
/*     <a href="javascript:void(0);" onclick="reloadgrid();" class="easyui-linkbutton" iconCls="icon-search">搜索</a>*/
/*   </div>*/
/* */
/*   <table id="listdata" class="easyui-datagrid" title="商品列表"*/
/*          data-options="*/
/*             toolbar:'#tb-user',*/
/*             rownumbers:true,*/
/*             singleSelect:true,*/
/*             pagination:true,*/
/*             method:'get',*/
/*             url:'{{ url('free-product/index', {'status': status}) }}',*/
/*             rownumbers: false,*/
/*             nowrap:false*/
/*         ">*/
/*     <thead>*/
/*     <tr>*/
/*       <!--<th data-options="field:'ck', checkbox: true">-->*/
/*       <th data-options="field:'id', width:80, align:'center'">商品编号</th>*/
/*       <th data-options="field:'picture', width:66" formatter="formatPicture">&nbsp;</th>*/
/*       <th data-options="field:'name', width:500" formatter="formatName">商品名称</th>*/
/*       <th data-options="field:'price', width:100, align:'center'">伙购价</th>*/
/*       <th data-options="field:'total_period', width:80, align:'center',sortable:true">伙购期数</th>*/
/*       <th data-options="field:'total_period', width:80, align:'center'">总期数</th>*/
/*       <th data-options="field:'marketable', width:80, align:'center'" formatter="formatStatus">状态</th>*/
/*       <th data-options="field:'created_at', width:180, sortable:true" formatter="formatTime">创建时间</th>*/
/*     </tr>*/
/*     </thead>*/
/*   </table>*/
/* */
/*   <div id="tb-user" style="height:auto">*/
/*     <div>*/
/*       <a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-add',plain:true" onclick="add()">新增</a>*/
/*       <a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-edit',plain:true" onclick="edit()">编辑</a>*/
/*       <a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-ok',plain:true" onclick="up()">上架</a>*/
/*       <a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-no',plain:true" onclick="down()">下架</a>*/
/*       <a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-redo',plain:true" onclick="del()">删除</a>*/
/*       <a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-tip',plain:true" onclick="lotteryRecord()">查看开奖明细</a>*/
/*     </div>*/
/*   </div>*/
/* */
/*   <div id="dlg-add" class="easyui-window" title="新增商品" style="width:1242px;height:750px;padding:10px;overflow:hidden;" data-options="*/
/*             iconCls:'icon-save',*/
/*             closed:true,*/
/*             modal:true,*/
/*             onResize:function(){*/
/*                 $(this).window('hcenter');*/
/*             }">*/
/*     <iframe width="100%" height="100%" frameborder="0" id="add_iframe">*/
/*     </iframe>*/
/*   </div>*/
/* */
/*   <div id="dlg-edit" class="easyui-window" title="编辑商品" style="width:1242px;height:750px;padding:10px;overflow:hidden;" data-options="*/
/*             iconCls:'icon-save',*/
/*             closed:true,*/
/*             modal:true,*/
/*             onResize:function(){*/
/*                 $(this).window('hcenter');*/
/*             }">*/
/*     <iframe width="100%" height="100%" frameborder="0" id="edit_iframe">*/
/*     </iframe>*/
/*   </div>*/
/* */
/* {% endblock %}*/
/* */
/* {% block js %}*/
/*   <script>*/
/*     function reloadgrid(){*/
/*       var queryParams = $('#listdata').datagrid('options').queryParams;*/
/*       queryParams.name = $('#name').val();*/
/*       queryParams.id	= $('#id').val();*/
/*       queryParams.marketable	= $('#marketable').combobox('getValue');*/
/*       $('#listdata').datagrid('options').queryParams = queryParams;*/
/*       $("#listdata").datagrid('reload');*/
/*     }*/
/* */
/*     //格式化*/
/*     function formatPicture(val, row) {*/
/*       product_image_url = createActiveImgUrl(row.picture, 'small');*/
/*       return '<img src="'+product_image_url+'" style="width: 60px;height:60px;">';*/
/*     }*/
/* */
/*     function formatName(val, row) {*/
/*       return val;*/
/*     }*/
/* */
/*     function formatStatus(val, row) {*/
/*       if (val == 0) {*/
/*         return '下架';*/
/*       } else if (val == 1) {*/
/*         return '上架';*/
/*       } else if (val == 2) {*/
/*         return '新增';*/
/*       }*/
/*     }*/
/* */
/*     function formatTime(val, row) {*/
/*         var newDate_attend = new Date();*/
/*         newDate_attend.setTime(val * 1000);*/
/*         var my_create_time_attend=newDate_attend.format('yyyy-MM-dd hh:mm:ss');*/
/*         return my_create_time_attend;*/
/*     }*/
/* */
/*     //操作*/
/*     function add() {*/
/*       $('#add_iframe').prop('src', "{{ url('free-product/add') }}");*/
/*       $('#dlg-add').window('open');*/
/*     }*/
/* */
/*     function edit() {*/
/*       var selRow = $('#listdata').datagrid('getSelected');*/
/*       if (!selRow) {*/
/*         $.messager.alert('错误','请选择商品');*/
/*         return false;*/
/*       }*/
/*       $('#edit_iframe').prop('src', "{{ url('free-product/edit') }}" + '?id=' + selRow.id);*/
/*       $('#dlg-edit').window('open');*/
/*     }*/
/* */
/*     function up() {*/
/*       var selRow = $('#listdata').datagrid('getSelected');*/
/*       if (!selRow) {*/
/*         $.messager.alert('错误','请选择商品');*/
/*         return false;*/
/*       }*/
/* */
/*       if (selRow.marketable == 1) {*/
/*         $.messager.alert('错误','该商品已上架');*/
/*         return false;*/
/*       }*/
/* */
/*       $.messager.confirm('Confirm', '确认上架吗?', function(r){*/
/*         if (r){*/
/*           $.post("{{ url('/free-product/market') }}", {'id':selRow.id, 'market':1}, function(data) {*/
/*             if (data.error) {*/
/*               $.messager.alert('错误', data.message, 'error');*/
/*             } else {*/
/*               $.messager.alert('成功', data.message);*/
/*               reloadgrid();*/
/*             }*/
/*           }, 'json');*/
/*         }*/
/*       });*/
/*     }*/
/* */
/*     function down() {*/
/*       var selRow = $('#listdata').datagrid('getSelected');*/
/*       if (!selRow) {*/
/*         $.messager.alert('错误','请选择商品');*/
/*         return false;*/
/*       }*/
/*       console.log(selRow.marketable);*/
/*       if (selRow.marketable == 0) {*/
/*         $.messager.alert('错误','该商品已下架');*/
/*         return false;*/
/*       }*/
/* */
/*       $.messager.confirm('Confirm', '确认下架吗?', function(r){*/
/*         if (r){*/
/*           $.post("{{ url('/free-product/market') }}", {'id':selRow.id, 'market':0}, function(data) {*/
/*             if (data.error) {*/
/*               $.messager.alert('错误', data.message, 'error');*/
/*             } else {*/
/*               $.messager.alert('成功', data.message);*/
/*               reloadgrid();*/
/*             }*/
/*           }, 'json');*/
/*         }*/
/*       });*/
/*     }*/
/* */
/*     function del() {*/
/*       var selRow = $('#listdata').datagrid('getSelected');*/
/*       if (!selRow) {*/
/*         $.messager.alert('错误','请选择商品');*/
/*         return false;*/
/*       }*/
/* */
/*       if (selRow.marketable != 2) {*/
/*         $.messager.alert('错误','只有新增商品才能删除');*/
/*         return false;*/
/*       }*/
/* */
/*       $.messager.confirm('Confirm', '确认删除吗?', function(r) {*/
/*         if (r) {*/
/*           $.post("{{ url('/free-product/del') }}", {'id':selRow.id}, function(data) {*/
/*             if (data.error) {*/
/*               $.messager.alert('错误', data.message, 'error');*/
/*             } else {*/
/*               $.messager.alert('成功', data.message);*/
/*               reloadgrid();*/
/*             }*/
/*           }, 'json');*/
/*         }*/
/*       });*/
/*     }*/
/* */
/*     function lotteryRecord() {*/
/*       var selRow = $('#listdata').datagrid('getSelected');*/
/*       if (!selRow) {*/
/*         $.messager.alert('错误','请选择商品');*/
/*         return false;*/
/*       }*/
/*       var goodsId = selRow.id;*/
/*       location.href = "{{ url('/free-product/lottery-record') }}?id="+goodsId;*/
/*     }*/
/* */
/*     function sort(type, order) {*/
/* */
/*     }*/
/*   </script>*/
/* {% endblock %}*/
/* */
/* */
