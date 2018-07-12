<?php

/* upgrade.html */
class __TwigTemplate_fa289ae9b2e64f07d2067df9373ae6aef8974c8a896ac05abfb5e2b820e23845 extends yii\twig\Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("@app/views/base.html", "upgrade.html", 1);
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
        echo "<div style=\"margin:20px 0 10px 0;\"></div>

<div class=\"easyui-tabs\" style=\"width:500px;height:auto;float: left;\" >
    <span>伙购网</span>
    <div title=\"android\" style=\"padding:10px\">
        <form id=\"android_huogou\" method=\"post\">
            <table cellpadding=\"5\">
                <input type=\"hidden\" name=\"id\" value=\"";
        // line 11
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["huogouAndroidModel"]) ? $context["huogouAndroidModel"] : null), "id", array()), "html", null, true);
        echo "\">
                <input type=\"hidden\" name=\"system\" value=\"android\">
                <input type=\"hidden\" name=\"from\" value=\"1\">
                <tr>
                    <td>版本号:</td>
                    <td><input class=\"easyui-textbox\" type=\"text\" name=\"content[up_code]\" value=\"";
        // line 16
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["huogouAndroidModel"]) ? $context["huogouAndroidModel"] : null), "content", array()), "up_code", array()), "html", null, true);
        echo "\" data-options=\"required:true\"></td>
                </tr>
                <tr>
                    <td>版本名称:</td>
                    <td><input class=\"easyui-textbox\" type=\"text\" name=\"content[up_name]\" value=\"";
        // line 20
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["huogouAndroidModel"]) ? $context["huogouAndroidModel"] : null), "content", array()), "up_name", array()), "html", null, true);
        echo "\"  data-options=\"required:true\"></td>
                </tr>
                <tr>
                    <td>内容:</td>
                    <td><textarea rows=5 name=\"content[up_des]\" class=\"textarea easyui-validatebox\">";
        // line 24
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["huogouAndroidModel"]) ? $context["huogouAndroidModel"] : null), "content", array()), "up_des", array()), "html", null, true);
        echo "</textarea></td>
                </tr>
                <tr>
                    <td>下载地址:</td>
                    <td><input class=\"easyui-textbox\" name=\"content[up_file]\" value=\"";
        // line 28
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["huogouAndroidModel"]) ? $context["huogouAndroidModel"] : null), "content", array()), "up_file", array()), "html", null, true);
        echo "\"  data-options=\"required:true,validType:'url'\"></td>
                </tr>
                <tr>
                    <td>是否强制升级:</td>
                    <td><input type=\"checkbox\" name=\"content[up_isauto]\" value=\"1\" ";
        // line 32
        if (($this->getAttribute($this->getAttribute((isset($context["huogouAndroidModel"]) ? $context["huogouAndroidModel"] : null), "content", array()), "up_isauto", array()) == 1)) {
            echo "checked";
        }
        echo "></td>
                </tr>
                <tr>
                    <td>是否启用:</td>
                    <td><input type=\"checkbox\" name=\"status\" value=\"1\" ";
        // line 36
        if (($this->getAttribute((isset($context["huogouAndroidModel"]) ? $context["huogouAndroidModel"] : null), "status", array()) == 1)) {
            echo "checked";
        }
        echo "></td>
                </tr>
            </table>
        </form>
        <div style=\"text-align:center;padding:5px\">
            <a href=\"javascript:void(0)\" class=\"easyui-linkbutton\" onclick=\"submitForm('android_huogou')\">提交</a>
        </div>
    </div>
    <div title=\"ios\" style=\"padding:10px\">
        <form id=\"ios_huogou\" method=\"post\">
            <table cellpadding=\"5\">
                <input type=\"hidden\" name=\"id\" value=\"";
        // line 47
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["huogouIosModel"]) ? $context["huogouIosModel"] : null), "id", array()), "html", null, true);
        echo "\">
                <input type=\"hidden\" name=\"system\" value=\"ios\">
                <input type=\"hidden\" name=\"from\" value=\"1\">
                <tr>
                    <td style=\"width:88px;\">版本号:</td>
                    <td><input class=\"easyui-textbox\" type=\"text\" name=\"content[up_code]\"  value=\"";
        // line 52
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["huogouIosModel"]) ? $context["huogouIosModel"] : null), "content", array()), "up_code", array()), "html", null, true);
        echo "\" data-options=\"required:true\" style=\"width:171px;\"></td>
                </tr>
                <tr>
                    <td>版本名称:</td>
                    <td><input class=\"easyui-textbox\" type=\"text\" name=\"content[up_name]\"  value=\"";
        // line 56
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["huogouIosModel"]) ? $context["huogouIosModel"] : null), "content", array()), "up_name", array()), "html", null, true);
        echo "\" data-options=\"required:true\" style=\"width:171px;\"></td>
                </tr>
                <tr>
                    <td>内容:</td>
                    <td><textarea rows=5 name=\"content[up_des]\" class=\"textarea easyui-validatebox\" style=\"height:60px;width:171px;\">";
        // line 60
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["huogouIosModel"]) ? $context["huogouIosModel"] : null), "content", array()), "up_des", array()), "html", null, true);
        echo "</textarea></td>
                </tr>
                <tr>
                    <td>是否强制升级:</td>
                    <td><input type=\"checkbox\" name=\"content[up_isauto]\" value=\"1\" ";
        // line 64
        if (($this->getAttribute($this->getAttribute((isset($context["huogouIosModel"]) ? $context["huogouIosModel"] : null), "content", array()), "up_isauto", array()) == 1)) {
            echo "checked";
        }
        echo "></td>
                </tr>
                <tr>
                    <td>是否启用:</td>
                    <td><input type=\"checkbox\" name=\"status\" value=\"1\"  ";
        // line 68
        if (($this->getAttribute((isset($context["huogouIosModel"]) ? $context["huogouIosModel"] : null), "status", array()) == 1)) {
            echo "checked";
        }
        echo "></td>
                </tr>
            </table>
        </form>
        <div style=\"text-align:center;padding:5px\">
            <a href=\"javascript:void(0)\" class=\"easyui-linkbutton\" onclick=\"submitForm('ios_huogou')\">提交</a>
            <!--<a href=\"\" class=\"easyui-linkbutton\" id=\"send\">推送</a>-->
        </div>
    </div>
</div>

<div class=\"easyui-tabs\" style=\"width:500px;height:auto;float: left;margin-left: 10px;\" >
    <span>滴滴夺宝</span>
    <div title=\"android\" style=\"padding:10px\">
        <form id=\"android_didi\" method=\"post\">
            <table cellpadding=\"5\">
                <input type=\"hidden\" name=\"id\" value=\"";
        // line 84
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["didiAndroidModel"]) ? $context["didiAndroidModel"] : null), "id", array()), "html", null, true);
        echo "\">
                <input type=\"hidden\" name=\"system\" value=\"android\">
                <input type=\"hidden\" name=\"from\" value=\"2\">
                <tr>
                    <td>版本号:</td>
                    <td><input class=\"easyui-textbox\" type=\"text\" name=\"content[up_code]\" value=\"";
        // line 89
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["didiAndroidModel"]) ? $context["didiAndroidModel"] : null), "content", array()), "up_code", array()), "html", null, true);
        echo "\" data-options=\"required:true\"></td>
                </tr>
                <tr>
                    <td>版本名称:</td>
                    <td><input class=\"easyui-textbox\" type=\"text\" name=\"content[up_name]\" value=\"";
        // line 93
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["didiAndroidModel"]) ? $context["didiAndroidModel"] : null), "content", array()), "up_name", array()), "html", null, true);
        echo "\"  data-options=\"required:true\"></td>
                </tr>
                <tr>
                    <td>内容:</td>
                    <td><textarea rows=5 name=\"content[up_des]\" class=\"textarea easyui-validatebox\">";
        // line 97
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["didiAndroidModel"]) ? $context["didiAndroidModel"] : null), "content", array()), "up_des", array()), "html", null, true);
        echo "</textarea></td>
                </tr>
                <tr>
                    <td>下载地址:</td>
                    <td><input class=\"easyui-textbox\" name=\"content[up_file]\" value=\"";
        // line 101
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["didiAndroidModel"]) ? $context["didiAndroidModel"] : null), "content", array()), "up_file", array()), "html", null, true);
        echo "\"  data-options=\"required:true,validType:'url'\"></td>
                </tr>
                <tr>
                    <td>是否强制升级:</td>
                    <td><input type=\"checkbox\" name=\"content[up_isauto]\" value=\"1\" ";
        // line 105
        if (($this->getAttribute($this->getAttribute((isset($context["didiAndroidModel"]) ? $context["didiAndroidModel"] : null), "content", array()), "up_isauto", array()) == 1)) {
            echo "checked";
        }
        echo "></td>
                </tr>
                <tr>
                    <td>是否启用:</td>
                    <td><input type=\"checkbox\" name=\"status\" value=\"1\" ";
        // line 109
        if (($this->getAttribute((isset($context["didiAndroidModel"]) ? $context["didiAndroidModel"] : null), "status", array()) == 1)) {
            echo "checked";
        }
        echo "></td>
                </tr>
            </table>
        </form>
        <div style=\"text-align:center;padding:5px\">
            <a href=\"javascript:void(0)\" class=\"easyui-linkbutton\" onclick=\"submitForm('android_didi')\">提交</a>
        </div>
    </div>
    <div title=\"ios\" style=\"padding:10px\">
        <form id=\"ios_didi\" method=\"post\">
            <table cellpadding=\"5\">
                <input type=\"hidden\" name=\"id\" value=\"";
        // line 120
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["didiIosModel"]) ? $context["didiIosModel"] : null), "id", array()), "html", null, true);
        echo "\">
                <input type=\"hidden\" name=\"system\" value=\"ios\">
                <input type=\"hidden\" name=\"from\" value=\"2\">
                <tr>
                    <td style=\"width:88px;\">版本号:</td>
                    <td><input class=\"easyui-textbox\" type=\"text\" name=\"content[up_code]\"  value=\"";
        // line 125
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["didiIosModel"]) ? $context["didiIosModel"] : null), "content", array()), "up_code", array()), "html", null, true);
        echo "\" data-options=\"required:true\" style=\"width:171px;\"></td>
                </tr>
                <tr>
                    <td>版本名称:</td>
                    <td><input class=\"easyui-textbox\" type=\"text\" name=\"content[up_name]\"  value=\"";
        // line 129
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["didiIosModel"]) ? $context["didiIosModel"] : null), "content", array()), "up_name", array()), "html", null, true);
        echo "\" data-options=\"required:true\" style=\"width:171px;\"></td>
                </tr>
                <tr>
                    <td>内容:</td>
                    <td><textarea rows=5 name=\"content[up_des]\" class=\"textarea easyui-validatebox\" style=\"height:60px;width:171px;\">";
        // line 133
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["didiIosModel"]) ? $context["didiIosModel"] : null), "content", array()), "up_des", array()), "html", null, true);
        echo "</textarea></td>
                </tr>
                <tr>
                    <td>是否强制升级:</td>
                    <td><input type=\"checkbox\" name=\"content[up_isauto]\" value=\"1\" ";
        // line 137
        if (($this->getAttribute($this->getAttribute((isset($context["didiIosModel"]) ? $context["didiIosModel"] : null), "content", array()), "up_isauto", array()) == 1)) {
            echo "checked";
        }
        echo "></td>
                </tr>
                <tr>
                    <td>是否启用:</td>
                    <td><input type=\"checkbox\" name=\"status\" value=\"1\"  ";
        // line 141
        if (($this->getAttribute((isset($context["didiIosModel"]) ? $context["didiIosModel"] : null), "status", array()) == 1)) {
            echo "checked";
        }
        echo "></td>
                </tr>
            </table>
        </form>
        <div style=\"text-align:center;padding:5px\">
            <a href=\"javascript:void(0)\" class=\"easyui-linkbutton\" onclick=\"submitForm('ios_didi')\">提交</a>
            <!--<a href=\"\" class=\"easyui-linkbutton\" id=\"send\">推送</a>-->
        </div>
    </div>
</div>
";
    }

    // line 153
    public function block_js($context, array $blocks = array())
    {
        // line 154
        echo "<script>

    function submitForm(id)
    {
        \$('#'+id).form({
            url: '/app/upgrade',
            onSubmit: function(param){
                var isValid = \$(this).form('validate');
                if (!isValid){
                    \$.messager.progress('close');\t// 如果表单是无效的则隐藏进度条
                }
                return isValid;\t// 返回false终止表单提交
            },
            success: function (data) {
                data = eval('(' + data + ')');
                if (data.error == 0) {
                    \$.messager.alert('成功', data.message);
                    setTimeout(function(){location.reload();}, 2000);
                } else {
                    \$.messager.alert('失败', data.message);
                    return false;
                }
            }
        });
        \$('#'+id).submit();
    }
</script>
";
    }

    public function getTemplateName()
    {
        return "upgrade.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  280 => 154,  277 => 153,  260 => 141,  251 => 137,  244 => 133,  237 => 129,  230 => 125,  222 => 120,  206 => 109,  197 => 105,  190 => 101,  183 => 97,  176 => 93,  169 => 89,  161 => 84,  140 => 68,  131 => 64,  124 => 60,  117 => 56,  110 => 52,  102 => 47,  86 => 36,  77 => 32,  70 => 28,  63 => 24,  56 => 20,  49 => 16,  41 => 11,  32 => 4,  29 => 3,  11 => 1,);
    }
}
/* {% extends '@app/views/base.html' %}*/
/* */
/* {% block main %}*/
/* <div style="margin:20px 0 10px 0;"></div>*/
/* */
/* <div class="easyui-tabs" style="width:500px;height:auto;float: left;" >*/
/*     <span>伙购网</span>*/
/*     <div title="android" style="padding:10px">*/
/*         <form id="android_huogou" method="post">*/
/*             <table cellpadding="5">*/
/*                 <input type="hidden" name="id" value="{{huogouAndroidModel.id}}">*/
/*                 <input type="hidden" name="system" value="android">*/
/*                 <input type="hidden" name="from" value="1">*/
/*                 <tr>*/
/*                     <td>版本号:</td>*/
/*                     <td><input class="easyui-textbox" type="text" name="content[up_code]" value="{{ huogouAndroidModel.content.up_code }}" data-options="required:true"></td>*/
/*                 </tr>*/
/*                 <tr>*/
/*                     <td>版本名称:</td>*/
/*                     <td><input class="easyui-textbox" type="text" name="content[up_name]" value="{{ huogouAndroidModel.content.up_name }}"  data-options="required:true"></td>*/
/*                 </tr>*/
/*                 <tr>*/
/*                     <td>内容:</td>*/
/*                     <td><textarea rows=5 name="content[up_des]" class="textarea easyui-validatebox">{{ huogouAndroidModel.content.up_des }}</textarea></td>*/
/*                 </tr>*/
/*                 <tr>*/
/*                     <td>下载地址:</td>*/
/*                     <td><input class="easyui-textbox" name="content[up_file]" value="{{ huogouAndroidModel.content.up_file }}"  data-options="required:true,validType:'url'"></td>*/
/*                 </tr>*/
/*                 <tr>*/
/*                     <td>是否强制升级:</td>*/
/*                     <td><input type="checkbox" name="content[up_isauto]" value="1" {% if(huogouAndroidModel.content.up_isauto == 1) %}checked{%  endif %}></td>*/
/*                 </tr>*/
/*                 <tr>*/
/*                     <td>是否启用:</td>*/
/*                     <td><input type="checkbox" name="status" value="1" {% if(huogouAndroidModel.status == 1) %}checked{%  endif %}></td>*/
/*                 </tr>*/
/*             </table>*/
/*         </form>*/
/*         <div style="text-align:center;padding:5px">*/
/*             <a href="javascript:void(0)" class="easyui-linkbutton" onclick="submitForm('android_huogou')">提交</a>*/
/*         </div>*/
/*     </div>*/
/*     <div title="ios" style="padding:10px">*/
/*         <form id="ios_huogou" method="post">*/
/*             <table cellpadding="5">*/
/*                 <input type="hidden" name="id" value="{{huogouIosModel.id}}">*/
/*                 <input type="hidden" name="system" value="ios">*/
/*                 <input type="hidden" name="from" value="1">*/
/*                 <tr>*/
/*                     <td style="width:88px;">版本号:</td>*/
/*                     <td><input class="easyui-textbox" type="text" name="content[up_code]"  value="{{ huogouIosModel.content.up_code }}" data-options="required:true" style="width:171px;"></td>*/
/*                 </tr>*/
/*                 <tr>*/
/*                     <td>版本名称:</td>*/
/*                     <td><input class="easyui-textbox" type="text" name="content[up_name]"  value="{{ huogouIosModel.content.up_name }}" data-options="required:true" style="width:171px;"></td>*/
/*                 </tr>*/
/*                 <tr>*/
/*                     <td>内容:</td>*/
/*                     <td><textarea rows=5 name="content[up_des]" class="textarea easyui-validatebox" style="height:60px;width:171px;">{{ huogouIosModel.content.up_des }}</textarea></td>*/
/*                 </tr>*/
/*                 <tr>*/
/*                     <td>是否强制升级:</td>*/
/*                     <td><input type="checkbox" name="content[up_isauto]" value="1" {% if(huogouIosModel.content.up_isauto == 1) %}checked{%  endif %}></td>*/
/*                 </tr>*/
/*                 <tr>*/
/*                     <td>是否启用:</td>*/
/*                     <td><input type="checkbox" name="status" value="1"  {% if(huogouIosModel.status == 1) %}checked{%  endif %}></td>*/
/*                 </tr>*/
/*             </table>*/
/*         </form>*/
/*         <div style="text-align:center;padding:5px">*/
/*             <a href="javascript:void(0)" class="easyui-linkbutton" onclick="submitForm('ios_huogou')">提交</a>*/
/*             <!--<a href="" class="easyui-linkbutton" id="send">推送</a>-->*/
/*         </div>*/
/*     </div>*/
/* </div>*/
/* */
/* <div class="easyui-tabs" style="width:500px;height:auto;float: left;margin-left: 10px;" >*/
/*     <span>滴滴夺宝</span>*/
/*     <div title="android" style="padding:10px">*/
/*         <form id="android_didi" method="post">*/
/*             <table cellpadding="5">*/
/*                 <input type="hidden" name="id" value="{{didiAndroidModel.id}}">*/
/*                 <input type="hidden" name="system" value="android">*/
/*                 <input type="hidden" name="from" value="2">*/
/*                 <tr>*/
/*                     <td>版本号:</td>*/
/*                     <td><input class="easyui-textbox" type="text" name="content[up_code]" value="{{ didiAndroidModel.content.up_code }}" data-options="required:true"></td>*/
/*                 </tr>*/
/*                 <tr>*/
/*                     <td>版本名称:</td>*/
/*                     <td><input class="easyui-textbox" type="text" name="content[up_name]" value="{{ didiAndroidModel.content.up_name }}"  data-options="required:true"></td>*/
/*                 </tr>*/
/*                 <tr>*/
/*                     <td>内容:</td>*/
/*                     <td><textarea rows=5 name="content[up_des]" class="textarea easyui-validatebox">{{ didiAndroidModel.content.up_des }}</textarea></td>*/
/*                 </tr>*/
/*                 <tr>*/
/*                     <td>下载地址:</td>*/
/*                     <td><input class="easyui-textbox" name="content[up_file]" value="{{ didiAndroidModel.content.up_file }}"  data-options="required:true,validType:'url'"></td>*/
/*                 </tr>*/
/*                 <tr>*/
/*                     <td>是否强制升级:</td>*/
/*                     <td><input type="checkbox" name="content[up_isauto]" value="1" {% if(didiAndroidModel.content.up_isauto == 1) %}checked{%  endif %}></td>*/
/*                 </tr>*/
/*                 <tr>*/
/*                     <td>是否启用:</td>*/
/*                     <td><input type="checkbox" name="status" value="1" {% if(didiAndroidModel.status == 1) %}checked{%  endif %}></td>*/
/*                 </tr>*/
/*             </table>*/
/*         </form>*/
/*         <div style="text-align:center;padding:5px">*/
/*             <a href="javascript:void(0)" class="easyui-linkbutton" onclick="submitForm('android_didi')">提交</a>*/
/*         </div>*/
/*     </div>*/
/*     <div title="ios" style="padding:10px">*/
/*         <form id="ios_didi" method="post">*/
/*             <table cellpadding="5">*/
/*                 <input type="hidden" name="id" value="{{didiIosModel.id}}">*/
/*                 <input type="hidden" name="system" value="ios">*/
/*                 <input type="hidden" name="from" value="2">*/
/*                 <tr>*/
/*                     <td style="width:88px;">版本号:</td>*/
/*                     <td><input class="easyui-textbox" type="text" name="content[up_code]"  value="{{ didiIosModel.content.up_code }}" data-options="required:true" style="width:171px;"></td>*/
/*                 </tr>*/
/*                 <tr>*/
/*                     <td>版本名称:</td>*/
/*                     <td><input class="easyui-textbox" type="text" name="content[up_name]"  value="{{ didiIosModel.content.up_name }}" data-options="required:true" style="width:171px;"></td>*/
/*                 </tr>*/
/*                 <tr>*/
/*                     <td>内容:</td>*/
/*                     <td><textarea rows=5 name="content[up_des]" class="textarea easyui-validatebox" style="height:60px;width:171px;">{{ didiIosModel.content.up_des }}</textarea></td>*/
/*                 </tr>*/
/*                 <tr>*/
/*                     <td>是否强制升级:</td>*/
/*                     <td><input type="checkbox" name="content[up_isauto]" value="1" {% if(didiIosModel.content.up_isauto == 1) %}checked{%  endif %}></td>*/
/*                 </tr>*/
/*                 <tr>*/
/*                     <td>是否启用:</td>*/
/*                     <td><input type="checkbox" name="status" value="1"  {% if(didiIosModel.status == 1) %}checked{%  endif %}></td>*/
/*                 </tr>*/
/*             </table>*/
/*         </form>*/
/*         <div style="text-align:center;padding:5px">*/
/*             <a href="javascript:void(0)" class="easyui-linkbutton" onclick="submitForm('ios_didi')">提交</a>*/
/*             <!--<a href="" class="easyui-linkbutton" id="send">推送</a>-->*/
/*         </div>*/
/*     </div>*/
/* </div>*/
/* {% endblock %}*/
/* */
/* {% block js %}*/
/* <script>*/
/* */
/*     function submitForm(id)*/
/*     {*/
/*         $('#'+id).form({*/
/*             url: '/app/upgrade',*/
/*             onSubmit: function(param){*/
/*                 var isValid = $(this).form('validate');*/
/*                 if (!isValid){*/
/*                     $.messager.progress('close');	// 如果表单是无效的则隐藏进度条*/
/*                 }*/
/*                 return isValid;	// 返回false终止表单提交*/
/*             },*/
/*             success: function (data) {*/
/*                 data = eval('(' + data + ')');*/
/*                 if (data.error == 0) {*/
/*                     $.messager.alert('成功', data.message);*/
/*                     setTimeout(function(){location.reload();}, 2000);*/
/*                 } else {*/
/*                     $.messager.alert('失败', data.message);*/
/*                     return false;*/
/*                 }*/
/*             }*/
/*         });*/
/*         $('#'+id).submit();*/
/*     }*/
/* </script>*/
/* {% endblock %}*/
