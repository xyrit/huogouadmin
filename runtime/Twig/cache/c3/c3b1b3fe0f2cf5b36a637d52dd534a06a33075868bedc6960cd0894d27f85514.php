<?php

/* index.html */
class __TwigTemplate_484219702e645588cfc7f648bd4e29a5d2c40c008329f923eab4d18013bdfaa3 extends yii\twig\Template
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
        echo "<h3>日常签到</h3>
<hr />
";
        // line 6
        echo $this->getAttribute((isset($context["html"]) ? $context["html"] : null), "beginForm", array(0 => "", 1 => "post", 2 => array("id" => "sign_form")), "method");
        echo "
<span>连续签到
    <select class=\"easyui-combobox\" data-options=\"panelHeight:'auto'\" id=\"days\">
        ";
        // line 9
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(range(7, 31));
        foreach ($context['_seq'] as $context["_key"] => $context["i"]) {
            // line 10
            echo "        <option value=\"";
            echo twig_escape_filter($this->env, $context["i"], "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, $context["i"], "html", null, true);
            echo "</option>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['i'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 12
        echo "    </select>天
</span><br>
<table cellpadding=\"5\" id=\"signList\">
    ";
        // line 15
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["sign"]) ? $context["sign"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
            // line 16
            echo "    <tr>
        <td><b>第";
            // line 17
            echo twig_escape_filter($this->env, $this->getAttribute($context["item"], "days", array()), "html", null, true);
            echo "天</b></td>
        <td>送
            <select class=\"easyui-combobox\" data-options=\"panelHeight:'auto', onChange: onChange\" name=\"UserTask[";
            // line 19
            echo twig_escape_filter($this->env, $this->getAttribute($context["item"], "days", array()), "html", null, true);
            echo "][type]\" day=\"";
            echo twig_escape_filter($this->env, $this->getAttribute($context["item"], "days", array()), "html", null, true);
            echo "\">
                <option value=\"1\" ";
            // line 20
            if (($this->getAttribute($context["item"], "type", array()) == 1)) {
                echo "selected";
            }
            echo " >福分</option>
                <option value=\"2\" ";
            // line 21
            if (($this->getAttribute($context["item"], "type", array()) == 2)) {
                echo "selected";
            }
            echo " >伙购币</option>
                <option value=\"3\" ";
            // line 22
            if (($this->getAttribute($context["item"], "type", array()) == 3)) {
                echo "selected";
            }
            echo " >红包</option>
            </select>
    <span>
        ";
            // line 25
            if (($this->getAttribute($context["item"], "type", array()) == 1)) {
                // line 26
                echo "        <input class=\"easyui-textbox\" type=\"text\" name=\"UserTask[";
                echo twig_escape_filter($this->env, $this->getAttribute($context["item"], "days", array()), "html", null, true);
                echo "][num]\" value=\"";
                echo twig_escape_filter($this->env, $this->getAttribute($context["item"], "num", array()), "html", null, true);
                echo "\" style=\"width: 50px;\" data-options=\"required:true\">分
        ";
            } elseif (($this->getAttribute(            // line 27
$context["item"], "type", array()) == 2)) {
                // line 28
                echo "        <input class=\"easyui-textbox\" type=\"text\" name=\"UserTask[";
                echo twig_escape_filter($this->env, $this->getAttribute($context["item"], "days", array()), "html", null, true);
                echo "][num]\" value=\"";
                echo twig_escape_filter($this->env, $this->getAttribute($context["item"], "num", array()), "html", null, true);
                echo "\" style=\"width: 50px;\" data-options=\"required:true\">个
        ";
            } elseif (($this->getAttribute(            // line 29
$context["item"], "type", array()) == 3)) {
                // line 30
                echo "        <label id=\"numName";
                echo twig_escape_filter($this->env, $this->getAttribute($context["item"], "days", array()), "html", null, true);
                echo "\">";
                echo twig_escape_filter($this->env, $this->getAttribute($context["item"], "packetName", array()), "html", null, true);
                echo "</label>
        <input type=\"hidden\" name=\"UserTask[";
                // line 31
                echo twig_escape_filter($this->env, $this->getAttribute($context["item"], "days", array()), "html", null, true);
                echo "][num]\" value=\"";
                echo twig_escape_filter($this->env, $this->getAttribute($context["item"], "num", array()), "html", null, true);
                echo "\" id=\"num";
                echo twig_escape_filter($this->env, $this->getAttribute($context["item"], "days", array()), "html", null, true);
                echo "\" data-options=\"required:true\">
        <a href=\"javascript:void(0);\" onclick=\"addPacket('";
                // line 32
                echo twig_escape_filter($this->env, $this->getAttribute($context["item"], "days", array()), "html", null, true);
                echo "');\" class=\"easyui-linkbutton\">选择红包</a>
        ";
            }
            // line 34
            echo "    </span>
        </td>
    </tr>
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 38
        echo "</table>

<span>签到规则说明:</span><br /><br />
<input class=\"easyui-textbox\" data-options=\"multiline:true\" style=\"width:400px;height:200px\" name=\"content\" value=\"";
        // line 41
        echo twig_escape_filter($this->env, (isset($context["content"]) ? $context["content"] : null), "html", null, true);
        echo "\">

<h3>新手任务</h3>
<hr />
<table cellpadding=\"5\">
    ";
        // line 46
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["task"]) ? $context["task"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
            // line 47
            echo "    ";
            if (($this->getAttribute($context["item"], "type", array()) == 1)) {
                // line 48
                echo "    <tr>
        <td><b>";
                // line 49
                echo twig_escape_filter($this->env, $this->getAttribute($context["item"], "name", array()), "html", null, true);
                echo "</b></td>
        <td>送
            <select class=\"easyui-combobox\" data-options=\"panelHeight:'auto', onChange: onChangeTask\" name=\"Task[";
                // line 51
                echo twig_escape_filter($this->env, $this->getAttribute($context["item"], "id", array()), "html", null, true);
                echo "][award_type]\" taskId=\"";
                echo twig_escape_filter($this->env, $this->getAttribute($context["item"], "id", array()), "html", null, true);
                echo "\">
                <option value=\"1\" ";
                // line 52
                if (($this->getAttribute($context["item"], "award_type", array()) == 1)) {
                    echo "selected";
                }
                echo " >福分</option>
                <option value=\"2\" ";
                // line 53
                if (($this->getAttribute($context["item"], "award_type", array()) == 2)) {
                    echo "selected";
                }
                echo " >伙购币</option>
                <option value=\"3\" ";
                // line 54
                if (($this->getAttribute($context["item"], "award_type", array()) == 3)) {
                    echo "selected";
                }
                echo " >红包</option>
            </select>
            <span>
                ";
                // line 57
                if (($this->getAttribute($context["item"], "award_type", array()) == 1)) {
                    // line 58
                    echo "                <input class=\"easyui-textbox\" type=\"text\" name=\"Task[";
                    echo twig_escape_filter($this->env, $this->getAttribute($context["item"], "id", array()), "html", null, true);
                    echo "][award_num]\" value=\"";
                    echo twig_escape_filter($this->env, $this->getAttribute($context["item"], "award_num", array()), "html", null, true);
                    echo "\" style=\"width: 50px;\" data-options=\"required:true\">分
                ";
                } elseif (($this->getAttribute(                // line 59
$context["item"], "award_type", array()) == 2)) {
                    // line 60
                    echo "                <input class=\"easyui-textbox\" type=\"text\" name=\"Task[";
                    echo twig_escape_filter($this->env, $this->getAttribute($context["item"], "id", array()), "html", null, true);
                    echo "][award_num]\" value=\"";
                    echo twig_escape_filter($this->env, $this->getAttribute($context["item"], "award_num", array()), "html", null, true);
                    echo "\" style=\"width: 50px;\" data-options=\"required:true\">个
                ";
                } elseif (($this->getAttribute(                // line 61
$context["item"], "award_type", array()) == 3)) {
                    // line 62
                    echo "                <label id=\"numNameTask";
                    echo twig_escape_filter($this->env, $this->getAttribute($context["item"], "id", array()), "html", null, true);
                    echo "\">";
                    echo twig_escape_filter($this->env, $this->getAttribute($context["item"], "packetName", array()), "html", null, true);
                    echo "</label>
                <input type=\"hidden\" name=\"Task[";
                    // line 63
                    echo twig_escape_filter($this->env, $this->getAttribute($context["item"], "id", array()), "html", null, true);
                    echo "][award_num]\" value=\"";
                    echo twig_escape_filter($this->env, $this->getAttribute($context["item"], "award_num", array()), "html", null, true);
                    echo "\" id=\"numTask";
                    echo twig_escape_filter($this->env, $this->getAttribute($context["item"], "id", array()), "html", null, true);
                    echo "\" data-options=\"required:true\">
                <a href=\"javascript:void(0);\" onclick=\"addPacket('Task";
                    // line 64
                    echo twig_escape_filter($this->env, $this->getAttribute($context["item"], "id", array()), "html", null, true);
                    echo "');\" class=\"easyui-linkbutton\">选择红包</a>
                ";
                }
                // line 66
                echo "            </span>
        </td>
    </tr>
    ";
            }
            // line 70
            echo "    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 71
        echo "</table>
<span>新手任务说明:</span><br /><br />
<input class=\"easyui-textbox\" data-options=\"multiline:true\" style=\"width:400px;height:200px\" name=\"new_task\" value=\"";
        // line 73
        echo twig_escape_filter($this->env, (isset($context["new_task"]) ? $context["new_task"] : null), "html", null, true);
        echo "\">

<h3>日常任务</h3>
<hr />
<table cellpadding=\"5\">
    ";
        // line 78
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["task"]) ? $context["task"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
            // line 79
            echo "    ";
            if (($this->getAttribute($context["item"], "type", array()) == 2)) {
                // line 80
                echo "    <tr>
        <td><b>";
                // line 81
                echo twig_escape_filter($this->env, $this->getAttribute($context["item"], "name", array()), "html", null, true);
                echo "</b></td>
        <td>送
            <select class=\"easyui-combobox\" data-options=\"panelHeight:'auto', onChange: onChangeTask\" name=\"Task[";
                // line 83
                echo twig_escape_filter($this->env, $this->getAttribute($context["item"], "id", array()), "html", null, true);
                echo "][award_type]\" taskId=\"";
                echo twig_escape_filter($this->env, $this->getAttribute($context["item"], "id", array()), "html", null, true);
                echo "\">
                <option value=\"1\" ";
                // line 84
                if (($this->getAttribute($context["item"], "award_type", array()) == 1)) {
                    echo "selected";
                }
                echo " >福分</option>
                <option value=\"2\" ";
                // line 85
                if (($this->getAttribute($context["item"], "award_type", array()) == 2)) {
                    echo "selected";
                }
                echo " >伙购币</option>
                <option value=\"3\" ";
                // line 86
                if (($this->getAttribute($context["item"], "award_type", array()) == 3)) {
                    echo "selected";
                }
                echo " >红包</option>
            </select>
            <span>
                ";
                // line 89
                if (($this->getAttribute($context["item"], "award_type", array()) == 1)) {
                    // line 90
                    echo "                <input class=\"easyui-textbox\" type=\"text\" name=\"Task[";
                    echo twig_escape_filter($this->env, $this->getAttribute($context["item"], "id", array()), "html", null, true);
                    echo "][award_num]\" value=\"";
                    echo twig_escape_filter($this->env, $this->getAttribute($context["item"], "award_num", array()), "html", null, true);
                    echo "\" style=\"width: 50px;\" data-options=\"required:true\">分
                ";
                } elseif (($this->getAttribute(                // line 91
$context["item"], "award_type", array()) == 2)) {
                    // line 92
                    echo "                <input class=\"easyui-textbox\" type=\"text\" name=\"Task[";
                    echo twig_escape_filter($this->env, $this->getAttribute($context["item"], "id", array()), "html", null, true);
                    echo "][award_num]\" value=\"";
                    echo twig_escape_filter($this->env, $this->getAttribute($context["item"], "award_num", array()), "html", null, true);
                    echo "\" style=\"width: 50px;\" data-options=\"required:true\">个
                ";
                } elseif (($this->getAttribute(                // line 93
$context["item"], "award_type", array()) == 3)) {
                    // line 94
                    echo "                <label id=\"numNameTask";
                    echo twig_escape_filter($this->env, $this->getAttribute($context["item"], "id", array()), "html", null, true);
                    echo "\">";
                    echo twig_escape_filter($this->env, $this->getAttribute($context["item"], "packetName", array()), "html", null, true);
                    echo "</label>
                <input type=\"hidden\" name=\"Task[";
                    // line 95
                    echo twig_escape_filter($this->env, $this->getAttribute($context["item"], "id", array()), "html", null, true);
                    echo "][award_num]\" value=\"";
                    echo twig_escape_filter($this->env, $this->getAttribute($context["item"], "award_num", array()), "html", null, true);
                    echo "\" id=\"numTask";
                    echo twig_escape_filter($this->env, $this->getAttribute($context["item"], "id", array()), "html", null, true);
                    echo "\" data-options=\"required:true\">
                <a href=\"javascript:void(0);\" onclick=\"addPacket('Task";
                    // line 96
                    echo twig_escape_filter($this->env, $this->getAttribute($context["item"], "id", array()), "html", null, true);
                    echo "');\" class=\"easyui-linkbutton\">选择红包</a>
                ";
                }
                // line 98
                echo "            </span>
        </td>
    </tr>
    ";
            }
            // line 102
            echo "    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 103
        echo "</table>
<span>日常任务说明:</span><br /><br />
<input class=\"easyui-textbox\" data-options=\"multiline:true\" style=\"width:400px;height:200px\" name=\"daily_task\" value=\"";
        // line 105
        echo twig_escape_filter($this->env, (isset($context["daily_task"]) ? $context["daily_task"] : null), "html", null, true);
        echo "\">

<h3>成长任务</h3>
<hr />
<h3>称号</h3>
<table cellpadding=\"5\">
    ";
        // line 111
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["task"]) ? $context["task"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
            // line 112
            echo "    ";
            if ((($this->getAttribute($context["item"], "type", array()) == 3) && ($this->getAttribute($context["item"], "level", array()) == 1))) {
                // line 113
                echo "    <tr>
        <td>
            <b>";
                // line 115
                echo twig_escape_filter($this->env, $this->getAttribute($context["item"], "name", array()), "html", null, true);
                echo "</b>
            <input class=\"easyui-textbox\" type=\"text\" name=\"Task[";
                // line 116
                echo twig_escape_filter($this->env, $this->getAttribute($context["item"], "id", array()), "html", null, true);
                echo "][num]\" value=\"";
                echo twig_escape_filter($this->env, $this->getAttribute($context["item"], "num", array()), "html", null, true);
                echo "\" style=\"width: 50px;\" data-options=\"required:true\">次
        </td>
        <td>送
            <select class=\"easyui-combobox\" data-options=\"panelHeight:'auto', onChange: onChangeTask\" name=\"Task[";
                // line 119
                echo twig_escape_filter($this->env, $this->getAttribute($context["item"], "id", array()), "html", null, true);
                echo "][award_type]\" taskId=\"";
                echo twig_escape_filter($this->env, $this->getAttribute($context["item"], "id", array()), "html", null, true);
                echo "\">
                <option value=\"1\" ";
                // line 120
                if (($this->getAttribute($context["item"], "award_type", array()) == 1)) {
                    echo "selected";
                }
                echo " >福分</option>
                <option value=\"2\" ";
                // line 121
                if (($this->getAttribute($context["item"], "award_type", array()) == 2)) {
                    echo "selected";
                }
                echo " >伙购币</option>
                <option value=\"3\" ";
                // line 122
                if (($this->getAttribute($context["item"], "award_type", array()) == 3)) {
                    echo "selected";
                }
                echo " >红包</option>
            </select>
            <span>
                ";
                // line 125
                if (($this->getAttribute($context["item"], "award_type", array()) == 1)) {
                    // line 126
                    echo "                <input class=\"easyui-textbox\" type=\"text\" name=\"Task[";
                    echo twig_escape_filter($this->env, $this->getAttribute($context["item"], "id", array()), "html", null, true);
                    echo "][award_num]\" value=\"";
                    echo twig_escape_filter($this->env, $this->getAttribute($context["item"], "award_num", array()), "html", null, true);
                    echo "\" style=\"width: 50px;\" data-options=\"required:true\">分
                ";
                } elseif (($this->getAttribute(                // line 127
$context["item"], "award_type", array()) == 2)) {
                    // line 128
                    echo "                <input class=\"easyui-textbox\" type=\"text\" name=\"Task[";
                    echo twig_escape_filter($this->env, $this->getAttribute($context["item"], "id", array()), "html", null, true);
                    echo "][award_num]\" value=\"";
                    echo twig_escape_filter($this->env, $this->getAttribute($context["item"], "award_num", array()), "html", null, true);
                    echo "\" style=\"width: 50px;\" data-options=\"required:true\">个
                ";
                } elseif (($this->getAttribute(                // line 129
$context["item"], "award_type", array()) == 3)) {
                    // line 130
                    echo "                <label id=\"numNameTask";
                    echo twig_escape_filter($this->env, $this->getAttribute($context["item"], "id", array()), "html", null, true);
                    echo "\">";
                    echo twig_escape_filter($this->env, $this->getAttribute($context["item"], "packetName", array()), "html", null, true);
                    echo "</label>
                <input type=\"hidden\" name=\"Task[";
                    // line 131
                    echo twig_escape_filter($this->env, $this->getAttribute($context["item"], "id", array()), "html", null, true);
                    echo "][award_num]\" value=\"";
                    echo twig_escape_filter($this->env, $this->getAttribute($context["item"], "award_num", array()), "html", null, true);
                    echo "\" id=\"numTask";
                    echo twig_escape_filter($this->env, $this->getAttribute($context["item"], "id", array()), "html", null, true);
                    echo "\" data-options=\"required:true\">
                <a href=\"javascript:void(0);\" onclick=\"addPacket('Task";
                    // line 132
                    echo twig_escape_filter($this->env, $this->getAttribute($context["item"], "id", array()), "html", null, true);
                    echo "');\" class=\"easyui-linkbutton\">选择红包</a>
                ";
                }
                // line 134
                echo "            </span>
        </td>
    </tr>
    ";
            }
            // line 138
            echo "    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 139
        echo "</table>
<h3>充值</h3>
<table cellpadding=\"5\">
    ";
        // line 142
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["task"]) ? $context["task"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
            // line 143
            echo "    ";
            if ((($this->getAttribute($context["item"], "type", array()) == 3) && ($this->getAttribute($context["item"], "level", array()) == 2))) {
                // line 144
                echo "    <tr>
        <td>
            <b>";
                // line 146
                echo twig_escape_filter($this->env, $this->getAttribute($context["item"], "name", array()), "html", null, true);
                echo "</b>
            <input class=\"easyui-textbox\" type=\"text\" name=\"Task[";
                // line 147
                echo twig_escape_filter($this->env, $this->getAttribute($context["item"], "id", array()), "html", null, true);
                echo "][num]\" value=\"";
                echo twig_escape_filter($this->env, $this->getAttribute($context["item"], "num", array()), "html", null, true);
                echo "\" style=\"width: 50px;\" data-options=\"required:true\">元
        </td>
        <td>送
            <select class=\"easyui-combobox\" data-options=\"panelHeight:'auto', onChange: onChangeTask\" name=\"Task[";
                // line 150
                echo twig_escape_filter($this->env, $this->getAttribute($context["item"], "id", array()), "html", null, true);
                echo "][award_type]\" taskId=\"";
                echo twig_escape_filter($this->env, $this->getAttribute($context["item"], "id", array()), "html", null, true);
                echo "\">
                <option value=\"1\" ";
                // line 151
                if (($this->getAttribute($context["item"], "award_type", array()) == 1)) {
                    echo "selected";
                }
                echo " >福分</option>
                <option value=\"2\" ";
                // line 152
                if (($this->getAttribute($context["item"], "award_type", array()) == 2)) {
                    echo "selected";
                }
                echo " >伙购币</option>
                <option value=\"3\" ";
                // line 153
                if (($this->getAttribute($context["item"], "award_type", array()) == 3)) {
                    echo "selected";
                }
                echo " >红包</option>
            </select>
            <span>
                ";
                // line 156
                if (($this->getAttribute($context["item"], "award_type", array()) == 1)) {
                    // line 157
                    echo "                <input class=\"easyui-textbox\" type=\"text\" name=\"Task[";
                    echo twig_escape_filter($this->env, $this->getAttribute($context["item"], "id", array()), "html", null, true);
                    echo "][award_num]\" value=\"";
                    echo twig_escape_filter($this->env, $this->getAttribute($context["item"], "award_num", array()), "html", null, true);
                    echo "\" style=\"width: 50px;\" data-options=\"required:true\">分
                ";
                } elseif (($this->getAttribute(                // line 158
$context["item"], "award_type", array()) == 2)) {
                    // line 159
                    echo "                <input class=\"easyui-textbox\" type=\"text\" name=\"Task[";
                    echo twig_escape_filter($this->env, $this->getAttribute($context["item"], "id", array()), "html", null, true);
                    echo "][award_num]\" value=\"";
                    echo twig_escape_filter($this->env, $this->getAttribute($context["item"], "award_num", array()), "html", null, true);
                    echo "\" style=\"width: 50px;\" data-options=\"required:true\">个
                ";
                } elseif (($this->getAttribute(                // line 160
$context["item"], "award_type", array()) == 3)) {
                    // line 161
                    echo "                <label id=\"numNameTask";
                    echo twig_escape_filter($this->env, $this->getAttribute($context["item"], "id", array()), "html", null, true);
                    echo "\">";
                    echo twig_escape_filter($this->env, $this->getAttribute($context["item"], "packetName", array()), "html", null, true);
                    echo "</label>
                <input type=\"hidden\" name=\"Task[";
                    // line 162
                    echo twig_escape_filter($this->env, $this->getAttribute($context["item"], "id", array()), "html", null, true);
                    echo "][award_num]\" value=\"";
                    echo twig_escape_filter($this->env, $this->getAttribute($context["item"], "award_num", array()), "html", null, true);
                    echo "\" id=\"numTask";
                    echo twig_escape_filter($this->env, $this->getAttribute($context["item"], "id", array()), "html", null, true);
                    echo "\" data-options=\"required:true\">
                <a href=\"javascript:void(0);\" onclick=\"addPacket('Task";
                    // line 163
                    echo twig_escape_filter($this->env, $this->getAttribute($context["item"], "id", array()), "html", null, true);
                    echo "');\" class=\"easyui-linkbutton\">选择红包</a>
                ";
                }
                // line 165
                echo "            </span>
        </td>
    </tr>
    ";
            }
            // line 169
            echo "    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 170
        echo "</table>
<h3>等级</h3>
<table cellpadding=\"5\">
    ";
        // line 173
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["task"]) ? $context["task"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
            // line 174
            echo "    ";
            if ((($this->getAttribute($context["item"], "type", array()) == 3) && ($this->getAttribute($context["item"], "level", array()) == 3))) {
                // line 175
                echo "    <tr>
        <td><b>";
                // line 176
                echo twig_escape_filter($this->env, $this->getAttribute($context["item"], "name", array()), "html", null, true);
                echo "</b></td>
        <td>送
            <select class=\"easyui-combobox\" data-options=\"panelHeight:'auto', onChange: onChangeTask\" name=\"Task[";
                // line 178
                echo twig_escape_filter($this->env, $this->getAttribute($context["item"], "id", array()), "html", null, true);
                echo "][award_type]\" taskId=\"";
                echo twig_escape_filter($this->env, $this->getAttribute($context["item"], "id", array()), "html", null, true);
                echo "\">
                <option value=\"1\" ";
                // line 179
                if (($this->getAttribute($context["item"], "award_type", array()) == 1)) {
                    echo "selected";
                }
                echo " >福分</option>
                <option value=\"2\" ";
                // line 180
                if (($this->getAttribute($context["item"], "award_type", array()) == 2)) {
                    echo "selected";
                }
                echo " >伙购币</option>
                <option value=\"3\" ";
                // line 181
                if (($this->getAttribute($context["item"], "award_type", array()) == 3)) {
                    echo "selected";
                }
                echo " >红包</option>
            </select>
            <span>
                ";
                // line 184
                if (($this->getAttribute($context["item"], "award_type", array()) == 1)) {
                    // line 185
                    echo "                <input class=\"easyui-textbox\" type=\"text\" name=\"Task[";
                    echo twig_escape_filter($this->env, $this->getAttribute($context["item"], "id", array()), "html", null, true);
                    echo "][award_num]\" value=\"";
                    echo twig_escape_filter($this->env, $this->getAttribute($context["item"], "award_num", array()), "html", null, true);
                    echo "\" style=\"width: 50px;\" data-options=\"required:true\">分
                ";
                } elseif (($this->getAttribute(                // line 186
$context["item"], "award_type", array()) == 2)) {
                    // line 187
                    echo "                <input class=\"easyui-textbox\" type=\"text\" name=\"Task[";
                    echo twig_escape_filter($this->env, $this->getAttribute($context["item"], "id", array()), "html", null, true);
                    echo "][award_num]\" value=\"";
                    echo twig_escape_filter($this->env, $this->getAttribute($context["item"], "award_num", array()), "html", null, true);
                    echo "\" style=\"width: 50px;\" data-options=\"required:true\">个
                ";
                } elseif (($this->getAttribute(                // line 188
$context["item"], "award_type", array()) == 3)) {
                    // line 189
                    echo "                <label id=\"numNameTask";
                    echo twig_escape_filter($this->env, $this->getAttribute($context["item"], "id", array()), "html", null, true);
                    echo "\">";
                    echo twig_escape_filter($this->env, $this->getAttribute($context["item"], "packetName", array()), "html", null, true);
                    echo "</label>
                <input type=\"hidden\" name=\"Task[";
                    // line 190
                    echo twig_escape_filter($this->env, $this->getAttribute($context["item"], "id", array()), "html", null, true);
                    echo "][award_num]\" value=\"";
                    echo twig_escape_filter($this->env, $this->getAttribute($context["item"], "award_num", array()), "html", null, true);
                    echo "\" id=\"numTask";
                    echo twig_escape_filter($this->env, $this->getAttribute($context["item"], "id", array()), "html", null, true);
                    echo "\" data-options=\"required:true\">
                <a href=\"javascript:void(0);\" onclick=\"addPacket('Task";
                    // line 191
                    echo twig_escape_filter($this->env, $this->getAttribute($context["item"], "id", array()), "html", null, true);
                    echo "');\" class=\"easyui-linkbutton\">选择红包</a>
                ";
                }
                // line 193
                echo "            </span>
        </td>
    </tr>
    ";
            }
            // line 197
            echo "    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 198
        echo "</table>
<span>成长任务说明:</span><br /><br />
<input class=\"easyui-textbox\" data-options=\"multiline:true\" style=\"width:400px;height:200px\" name=\"grow_task\" value=\"";
        // line 200
        echo twig_escape_filter($this->env, (isset($context["grow_task"]) ? $context["grow_task"] : null), "html", null, true);
        echo "\">

";
        // line 202
        echo $this->getAttribute((isset($context["html"]) ? $context["html"] : null), "endForm", array(), "method");
        echo "
<div style=\"width: 200px;\">
<a href=\"javascript:void(0)\" class=\"easyui-linkbutton\" onclick=\"submitForm()\" style=\"width: 80px;\">确定</a>
<a href=\"javascript:void(0)\" class=\"easyui-linkbutton\" onclick=\"clearForm()\" style=\"width: 80px;\">取消</a>
</div>

<div id=\"dlg-add-packet\" title=\"红包列表\" class=\"easyui-dialog\" style=\"width:600px;height:auto;padding:10px 20px\" modal=\"true\" closed=\"true\" buttons=\"#dlg-buttons-send\">
    <span>红包列表<select class=\"easyui-combobox\" id=\"packet\" editable=\"true\" style=\"width:100px;\"></select></span><br />
    <span id=\"content\"></span>
</div>

<div id=\"dlg-buttons-send\" style=\"text-align:center;padding:5px\">
    <a class=\"easyui-linkbutton\" iconCls=\"icon-ok\" onclick=\"submitAddPacket()\">确定</a>
    <a class=\"easyui-linkbutton\" iconCls=\"icon-cancel\" onclick=\"javascript:\$('#dlg-add-packet').dialog('close')\">取消</a>
</div>

";
    }

    // line 220
    public function block_js($context, array $blocks = array())
    {
        // line 221
        echo "<script type=\"text/javascript\">
    var day = 0;
    \$('#days').combobox({
        onChange: function(newValue, oldValue) {
            newValue = parseInt(newValue);
            oldValue = parseInt(oldValue);
            if (newValue > oldValue) {
                for (var i = oldValue + 1; i <= newValue; i++) {
                    var strHtml = '<tr><td><b>第' + i + '天</b></td><td>送 ';
                    strHtml += '<select class=\"easyui-combobox\" data-options=\"panelHeight:\\'auto\\', onChange: onChange\" name=\"UserTask[' + i + '][type]\" day=\"' + i + '\">';
                    strHtml += '<option value=\"1\" selected>福分</option>';
                    strHtml += '<option value=\"2\">伙购币</option>';
                    strHtml += '<option value=\"3\">红包</option></select> ';
                    strHtml += '<span><input class=\"easyui-textbox\" type=\"text\" name=\"UserTask[' + i + '][num]\" style=\"width: 50px;\">分</span>';
                    strHtml += '</td></tr>';
                    \$.parser.parse(\$(strHtml).appendTo('#signList'));
                }
            } else {
                for (var i = oldValue - 1; i >= newValue; i--) {
                    \$.parser.parse(\$('#signList tr:last').remove());
                }
            }
        }
    });

    function onChange(newValue, oldValue) {
        var selectedDay = \$(this).attr('day');
        if (newValue == 1) {
            var tr = '<input class=\"easyui-textbox\" type=\"text\" name=\"UserTask[' + selectedDay + '][num]\" style=\"width: 50px;\" data-options=\"required:true\">分';
            \$.parser.parse(\$(this).siblings('span').eq(1).html(tr));
        } else if (newValue == 2) {
            var tr = '<input class=\"easyui-textbox\" type=\"text\" name=\"UserTask[' + selectedDay + '][num]\" style=\"width: 50px;\" data-options=\"required:true\">个';
            \$.parser.parse(\$(this).siblings('span').eq(1).html(tr));
        } else if (newValue == 3) {
            var tr = '<label id=\"numName' + selectedDay + '\"></label><input type=\"hidden\" name=\"UserTask[' + selectedDay + '][num]\" id=\"num' + selectedDay + '\" data-options=\"required:true\"><a href=\"javascript:void(0);\" onclick=\"addPacket(' + selectedDay + ');\" class=\"easyui-linkbutton\">选择红包</a>';
            \$.parser.parse(\$(this).siblings('span').eq(1).html(tr));
        }
    }

    function onChangeTask(newValue, oldValue) {
        var taskId = \$(this).attr('taskId');
        if (newValue == 1) {
            var tr = '<input class=\"easyui-textbox\" type=\"text\" name=\"Task[' + taskId + '][award_num]\" style=\"width: 50px;\" data-options=\"required:true\">分';
            \$.parser.parse(\$(this).siblings('span').eq(1).html(tr));
        } else if (newValue == 2) {
            var tr = '<input class=\"easyui-textbox\" type=\"text\" name=\"Task[' + taskId + '][award_num]\" style=\"width: 50px;\" data-options=\"required:true\">个';
            \$.parser.parse(\$(this).siblings('span').eq(1).html(tr));
        } else if (newValue == 3) {
            var tr = '<label id=\"numNameTask' + taskId + '\"></label><input type=\"hidden\" name=\"Task[' + taskId + '][award_num]\" id=\"numTask' + taskId + '\" data-options=\"required:true\"><a href=\"javascript:void(0);\" onclick=\"addPacket(\\'Task' + taskId + '\\');\" class=\"easyui-linkbutton\">选择红包</a>';
            \$.parser.parse(\$(this).siblings('span').eq(1).html(tr));
        }
    }

    function submitForm() {
        \$('#sign_form').form({
            url: \"";
        // line 276
        echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url("user-task/edit"), "html", null, true);
        echo "\",
            onSubmit:function() {
                return \$(this).form('enableValidation').form('validate');
            },
            success: function (data) {
                var data = eval('('+data+')');
                if (data.error == 0) {
                    \$.messager.alert('成功', data.message);
                    parent.location.reload();
                } else {
                    \$.messager.alert('失败', data.message, 'error');
                }
            }
        });
        \$('#sign_form').submit();
    }

    function addPacket(days) {
        day = days;
        \$('#content').html('');
        \$('#packet').combobox({
            url:\"";
        // line 297
        echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url("active/packet-list"), "html", null, true);
        echo "\",
            method:'get',
            valueField: 'id',
            textField: 'name',
            onSelect: function(packet) {
                \$.get(\"";
        // line 302
        echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url("active/packet-detail"), "html", null, true);
        echo "\", {'id': packet.id}, function(data) {
                    \$('#content').html('');
                    var strHtml = '<table cellpadding=\"5\"';
                    \$.each(data, function(i, v) {
                        strHtml += '<tr><td>' + v.name + '</td>';
                        strHtml += '<td>' + v.desc + '</td></tr>';
                    });
                    strHtml += '</table>';
                    \$.parser.parse(\$(strHtml).appendTo('#content'));
                });
            }
        });
        \$('#dlg-add-packet').window('open');
    }

    function submitAddPacket() {
        packetId = \$('#packet').combobox('getValue');
        packetName = \$('#packet').combobox('getText');
        if (!packetId) {
            \$.messager.alert('错误','请选择红包');
        }
        \$('#numName' + day).html(packetName);
        \$('#num' + day).val(packetId);
        \$('#dlg-add-packet').dialog('close');
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
        return array (  800 => 302,  792 => 297,  768 => 276,  711 => 221,  708 => 220,  687 => 202,  682 => 200,  678 => 198,  672 => 197,  666 => 193,  661 => 191,  653 => 190,  646 => 189,  644 => 188,  637 => 187,  635 => 186,  628 => 185,  626 => 184,  618 => 181,  612 => 180,  606 => 179,  600 => 178,  595 => 176,  592 => 175,  589 => 174,  585 => 173,  580 => 170,  574 => 169,  568 => 165,  563 => 163,  555 => 162,  548 => 161,  546 => 160,  539 => 159,  537 => 158,  530 => 157,  528 => 156,  520 => 153,  514 => 152,  508 => 151,  502 => 150,  494 => 147,  490 => 146,  486 => 144,  483 => 143,  479 => 142,  474 => 139,  468 => 138,  462 => 134,  457 => 132,  449 => 131,  442 => 130,  440 => 129,  433 => 128,  431 => 127,  424 => 126,  422 => 125,  414 => 122,  408 => 121,  402 => 120,  396 => 119,  388 => 116,  384 => 115,  380 => 113,  377 => 112,  373 => 111,  364 => 105,  360 => 103,  354 => 102,  348 => 98,  343 => 96,  335 => 95,  328 => 94,  326 => 93,  319 => 92,  317 => 91,  310 => 90,  308 => 89,  300 => 86,  294 => 85,  288 => 84,  282 => 83,  277 => 81,  274 => 80,  271 => 79,  267 => 78,  259 => 73,  255 => 71,  249 => 70,  243 => 66,  238 => 64,  230 => 63,  223 => 62,  221 => 61,  214 => 60,  212 => 59,  205 => 58,  203 => 57,  195 => 54,  189 => 53,  183 => 52,  177 => 51,  172 => 49,  169 => 48,  166 => 47,  162 => 46,  154 => 41,  149 => 38,  140 => 34,  135 => 32,  127 => 31,  120 => 30,  118 => 29,  111 => 28,  109 => 27,  102 => 26,  100 => 25,  92 => 22,  86 => 21,  80 => 20,  74 => 19,  69 => 17,  66 => 16,  62 => 15,  57 => 12,  46 => 10,  42 => 9,  36 => 6,  32 => 4,  29 => 3,  11 => 1,);
    }
}
/* {% extends '@app/views/base.html' %}*/
/* */
/* {% block main %}*/
/* <h3>日常签到</h3>*/
/* <hr />*/
/* {{ html.beginForm('', 'post', {'id':'sign_form'}) | raw }}*/
/* <span>连续签到*/
/*     <select class="easyui-combobox" data-options="panelHeight:'auto'" id="days">*/
/*         {% for i in 7..31 %}*/
/*         <option value="{{ i }}">{{ i }}</option>*/
/*         {% endfor %}*/
/*     </select>天*/
/* </span><br>*/
/* <table cellpadding="5" id="signList">*/
/*     {% for item in sign %}*/
/*     <tr>*/
/*         <td><b>第{{ item.days }}天</b></td>*/
/*         <td>送*/
/*             <select class="easyui-combobox" data-options="panelHeight:'auto', onChange: onChange" name="UserTask[{{ item.days }}][type]" day="{{ item.days }}">*/
/*                 <option value="1" {% if item.type == 1 %}selected{% endif %} >福分</option>*/
/*                 <option value="2" {% if item.type == 2 %}selected{% endif %} >伙购币</option>*/
/*                 <option value="3" {% if item.type == 3 %}selected{% endif %} >红包</option>*/
/*             </select>*/
/*     <span>*/
/*         {% if item.type == 1 %}*/
/*         <input class="easyui-textbox" type="text" name="UserTask[{{ item.days }}][num]" value="{{ item.num }}" style="width: 50px;" data-options="required:true">分*/
/*         {% elseif item.type == 2 %}*/
/*         <input class="easyui-textbox" type="text" name="UserTask[{{ item.days }}][num]" value="{{ item.num }}" style="width: 50px;" data-options="required:true">个*/
/*         {% elseif item.type == 3 %}*/
/*         <label id="numName{{ item.days }}">{{ item.packetName }}</label>*/
/*         <input type="hidden" name="UserTask[{{ item.days }}][num]" value="{{ item.num }}" id="num{{ item.days }}" data-options="required:true">*/
/*         <a href="javascript:void(0);" onclick="addPacket('{{ item.days }}');" class="easyui-linkbutton">选择红包</a>*/
/*         {% endif %}*/
/*     </span>*/
/*         </td>*/
/*     </tr>*/
/*     {% endfor %}*/
/* </table>*/
/* */
/* <span>签到规则说明:</span><br /><br />*/
/* <input class="easyui-textbox" data-options="multiline:true" style="width:400px;height:200px" name="content" value="{{ content }}">*/
/* */
/* <h3>新手任务</h3>*/
/* <hr />*/
/* <table cellpadding="5">*/
/*     {% for item in task %}*/
/*     {% if item.type == 1 %}*/
/*     <tr>*/
/*         <td><b>{{ item.name }}</b></td>*/
/*         <td>送*/
/*             <select class="easyui-combobox" data-options="panelHeight:'auto', onChange: onChangeTask" name="Task[{{ item.id }}][award_type]" taskId="{{ item.id }}">*/
/*                 <option value="1" {% if item.award_type == 1 %}selected{% endif %} >福分</option>*/
/*                 <option value="2" {% if item.award_type == 2 %}selected{% endif %} >伙购币</option>*/
/*                 <option value="3" {% if item.award_type == 3 %}selected{% endif %} >红包</option>*/
/*             </select>*/
/*             <span>*/
/*                 {% if item.award_type == 1 %}*/
/*                 <input class="easyui-textbox" type="text" name="Task[{{ item.id }}][award_num]" value="{{ item.award_num }}" style="width: 50px;" data-options="required:true">分*/
/*                 {% elseif item.award_type == 2 %}*/
/*                 <input class="easyui-textbox" type="text" name="Task[{{ item.id }}][award_num]" value="{{ item.award_num }}" style="width: 50px;" data-options="required:true">个*/
/*                 {% elseif item.award_type == 3 %}*/
/*                 <label id="numNameTask{{ item.id }}">{{ item.packetName }}</label>*/
/*                 <input type="hidden" name="Task[{{ item.id }}][award_num]" value="{{ item.award_num }}" id="numTask{{ item.id }}" data-options="required:true">*/
/*                 <a href="javascript:void(0);" onclick="addPacket('Task{{ item.id }}');" class="easyui-linkbutton">选择红包</a>*/
/*                 {% endif %}*/
/*             </span>*/
/*         </td>*/
/*     </tr>*/
/*     {% endif %}*/
/*     {% endfor %}*/
/* </table>*/
/* <span>新手任务说明:</span><br /><br />*/
/* <input class="easyui-textbox" data-options="multiline:true" style="width:400px;height:200px" name="new_task" value="{{ new_task }}">*/
/* */
/* <h3>日常任务</h3>*/
/* <hr />*/
/* <table cellpadding="5">*/
/*     {% for item in task %}*/
/*     {% if item.type == 2 %}*/
/*     <tr>*/
/*         <td><b>{{ item.name }}</b></td>*/
/*         <td>送*/
/*             <select class="easyui-combobox" data-options="panelHeight:'auto', onChange: onChangeTask" name="Task[{{ item.id }}][award_type]" taskId="{{ item.id }}">*/
/*                 <option value="1" {% if item.award_type == 1 %}selected{% endif %} >福分</option>*/
/*                 <option value="2" {% if item.award_type == 2 %}selected{% endif %} >伙购币</option>*/
/*                 <option value="3" {% if item.award_type == 3 %}selected{% endif %} >红包</option>*/
/*             </select>*/
/*             <span>*/
/*                 {% if item.award_type == 1 %}*/
/*                 <input class="easyui-textbox" type="text" name="Task[{{ item.id }}][award_num]" value="{{ item.award_num }}" style="width: 50px;" data-options="required:true">分*/
/*                 {% elseif item.award_type == 2 %}*/
/*                 <input class="easyui-textbox" type="text" name="Task[{{ item.id }}][award_num]" value="{{ item.award_num }}" style="width: 50px;" data-options="required:true">个*/
/*                 {% elseif item.award_type == 3 %}*/
/*                 <label id="numNameTask{{ item.id }}">{{ item.packetName }}</label>*/
/*                 <input type="hidden" name="Task[{{ item.id }}][award_num]" value="{{ item.award_num }}" id="numTask{{ item.id }}" data-options="required:true">*/
/*                 <a href="javascript:void(0);" onclick="addPacket('Task{{ item.id }}');" class="easyui-linkbutton">选择红包</a>*/
/*                 {% endif %}*/
/*             </span>*/
/*         </td>*/
/*     </tr>*/
/*     {% endif %}*/
/*     {% endfor %}*/
/* </table>*/
/* <span>日常任务说明:</span><br /><br />*/
/* <input class="easyui-textbox" data-options="multiline:true" style="width:400px;height:200px" name="daily_task" value="{{ daily_task }}">*/
/* */
/* <h3>成长任务</h3>*/
/* <hr />*/
/* <h3>称号</h3>*/
/* <table cellpadding="5">*/
/*     {% for item in task %}*/
/*     {% if item.type == 3 and item.level == 1 %}*/
/*     <tr>*/
/*         <td>*/
/*             <b>{{ item.name }}</b>*/
/*             <input class="easyui-textbox" type="text" name="Task[{{ item.id }}][num]" value="{{ item.num }}" style="width: 50px;" data-options="required:true">次*/
/*         </td>*/
/*         <td>送*/
/*             <select class="easyui-combobox" data-options="panelHeight:'auto', onChange: onChangeTask" name="Task[{{ item.id }}][award_type]" taskId="{{ item.id }}">*/
/*                 <option value="1" {% if item.award_type == 1 %}selected{% endif %} >福分</option>*/
/*                 <option value="2" {% if item.award_type == 2 %}selected{% endif %} >伙购币</option>*/
/*                 <option value="3" {% if item.award_type == 3 %}selected{% endif %} >红包</option>*/
/*             </select>*/
/*             <span>*/
/*                 {% if item.award_type == 1 %}*/
/*                 <input class="easyui-textbox" type="text" name="Task[{{ item.id }}][award_num]" value="{{ item.award_num }}" style="width: 50px;" data-options="required:true">分*/
/*                 {% elseif item.award_type == 2 %}*/
/*                 <input class="easyui-textbox" type="text" name="Task[{{ item.id }}][award_num]" value="{{ item.award_num }}" style="width: 50px;" data-options="required:true">个*/
/*                 {% elseif item.award_type == 3 %}*/
/*                 <label id="numNameTask{{ item.id }}">{{ item.packetName }}</label>*/
/*                 <input type="hidden" name="Task[{{ item.id }}][award_num]" value="{{ item.award_num }}" id="numTask{{ item.id }}" data-options="required:true">*/
/*                 <a href="javascript:void(0);" onclick="addPacket('Task{{ item.id }}');" class="easyui-linkbutton">选择红包</a>*/
/*                 {% endif %}*/
/*             </span>*/
/*         </td>*/
/*     </tr>*/
/*     {% endif %}*/
/*     {% endfor %}*/
/* </table>*/
/* <h3>充值</h3>*/
/* <table cellpadding="5">*/
/*     {% for item in task %}*/
/*     {% if item.type == 3 and item.level == 2 %}*/
/*     <tr>*/
/*         <td>*/
/*             <b>{{ item.name }}</b>*/
/*             <input class="easyui-textbox" type="text" name="Task[{{ item.id }}][num]" value="{{ item.num }}" style="width: 50px;" data-options="required:true">元*/
/*         </td>*/
/*         <td>送*/
/*             <select class="easyui-combobox" data-options="panelHeight:'auto', onChange: onChangeTask" name="Task[{{ item.id }}][award_type]" taskId="{{ item.id }}">*/
/*                 <option value="1" {% if item.award_type == 1 %}selected{% endif %} >福分</option>*/
/*                 <option value="2" {% if item.award_type == 2 %}selected{% endif %} >伙购币</option>*/
/*                 <option value="3" {% if item.award_type == 3 %}selected{% endif %} >红包</option>*/
/*             </select>*/
/*             <span>*/
/*                 {% if item.award_type == 1 %}*/
/*                 <input class="easyui-textbox" type="text" name="Task[{{ item.id }}][award_num]" value="{{ item.award_num }}" style="width: 50px;" data-options="required:true">分*/
/*                 {% elseif item.award_type == 2 %}*/
/*                 <input class="easyui-textbox" type="text" name="Task[{{ item.id }}][award_num]" value="{{ item.award_num }}" style="width: 50px;" data-options="required:true">个*/
/*                 {% elseif item.award_type == 3 %}*/
/*                 <label id="numNameTask{{ item.id }}">{{ item.packetName }}</label>*/
/*                 <input type="hidden" name="Task[{{ item.id }}][award_num]" value="{{ item.award_num }}" id="numTask{{ item.id }}" data-options="required:true">*/
/*                 <a href="javascript:void(0);" onclick="addPacket('Task{{ item.id }}');" class="easyui-linkbutton">选择红包</a>*/
/*                 {% endif %}*/
/*             </span>*/
/*         </td>*/
/*     </tr>*/
/*     {% endif %}*/
/*     {% endfor %}*/
/* </table>*/
/* <h3>等级</h3>*/
/* <table cellpadding="5">*/
/*     {% for item in task %}*/
/*     {% if item.type == 3 and item.level == 3 %}*/
/*     <tr>*/
/*         <td><b>{{ item.name }}</b></td>*/
/*         <td>送*/
/*             <select class="easyui-combobox" data-options="panelHeight:'auto', onChange: onChangeTask" name="Task[{{ item.id }}][award_type]" taskId="{{ item.id }}">*/
/*                 <option value="1" {% if item.award_type == 1 %}selected{% endif %} >福分</option>*/
/*                 <option value="2" {% if item.award_type == 2 %}selected{% endif %} >伙购币</option>*/
/*                 <option value="3" {% if item.award_type == 3 %}selected{% endif %} >红包</option>*/
/*             </select>*/
/*             <span>*/
/*                 {% if item.award_type == 1 %}*/
/*                 <input class="easyui-textbox" type="text" name="Task[{{ item.id }}][award_num]" value="{{ item.award_num }}" style="width: 50px;" data-options="required:true">分*/
/*                 {% elseif item.award_type == 2 %}*/
/*                 <input class="easyui-textbox" type="text" name="Task[{{ item.id }}][award_num]" value="{{ item.award_num }}" style="width: 50px;" data-options="required:true">个*/
/*                 {% elseif item.award_type == 3 %}*/
/*                 <label id="numNameTask{{ item.id }}">{{ item.packetName }}</label>*/
/*                 <input type="hidden" name="Task[{{ item.id }}][award_num]" value="{{ item.award_num }}" id="numTask{{ item.id }}" data-options="required:true">*/
/*                 <a href="javascript:void(0);" onclick="addPacket('Task{{ item.id }}');" class="easyui-linkbutton">选择红包</a>*/
/*                 {% endif %}*/
/*             </span>*/
/*         </td>*/
/*     </tr>*/
/*     {% endif %}*/
/*     {% endfor %}*/
/* </table>*/
/* <span>成长任务说明:</span><br /><br />*/
/* <input class="easyui-textbox" data-options="multiline:true" style="width:400px;height:200px" name="grow_task" value="{{ grow_task }}">*/
/* */
/* {{ html.endForm() | raw }}*/
/* <div style="width: 200px;">*/
/* <a href="javascript:void(0)" class="easyui-linkbutton" onclick="submitForm()" style="width: 80px;">确定</a>*/
/* <a href="javascript:void(0)" class="easyui-linkbutton" onclick="clearForm()" style="width: 80px;">取消</a>*/
/* </div>*/
/* */
/* <div id="dlg-add-packet" title="红包列表" class="easyui-dialog" style="width:600px;height:auto;padding:10px 20px" modal="true" closed="true" buttons="#dlg-buttons-send">*/
/*     <span>红包列表<select class="easyui-combobox" id="packet" editable="true" style="width:100px;"></select></span><br />*/
/*     <span id="content"></span>*/
/* </div>*/
/* */
/* <div id="dlg-buttons-send" style="text-align:center;padding:5px">*/
/*     <a class="easyui-linkbutton" iconCls="icon-ok" onclick="submitAddPacket()">确定</a>*/
/*     <a class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg-add-packet').dialog('close')">取消</a>*/
/* </div>*/
/* */
/* {% endblock %}*/
/* */
/* {% block js %}*/
/* <script type="text/javascript">*/
/*     var day = 0;*/
/*     $('#days').combobox({*/
/*         onChange: function(newValue, oldValue) {*/
/*             newValue = parseInt(newValue);*/
/*             oldValue = parseInt(oldValue);*/
/*             if (newValue > oldValue) {*/
/*                 for (var i = oldValue + 1; i <= newValue; i++) {*/
/*                     var strHtml = '<tr><td><b>第' + i + '天</b></td><td>送 ';*/
/*                     strHtml += '<select class="easyui-combobox" data-options="panelHeight:\'auto\', onChange: onChange" name="UserTask[' + i + '][type]" day="' + i + '">';*/
/*                     strHtml += '<option value="1" selected>福分</option>';*/
/*                     strHtml += '<option value="2">伙购币</option>';*/
/*                     strHtml += '<option value="3">红包</option></select> ';*/
/*                     strHtml += '<span><input class="easyui-textbox" type="text" name="UserTask[' + i + '][num]" style="width: 50px;">分</span>';*/
/*                     strHtml += '</td></tr>';*/
/*                     $.parser.parse($(strHtml).appendTo('#signList'));*/
/*                 }*/
/*             } else {*/
/*                 for (var i = oldValue - 1; i >= newValue; i--) {*/
/*                     $.parser.parse($('#signList tr:last').remove());*/
/*                 }*/
/*             }*/
/*         }*/
/*     });*/
/* */
/*     function onChange(newValue, oldValue) {*/
/*         var selectedDay = $(this).attr('day');*/
/*         if (newValue == 1) {*/
/*             var tr = '<input class="easyui-textbox" type="text" name="UserTask[' + selectedDay + '][num]" style="width: 50px;" data-options="required:true">分';*/
/*             $.parser.parse($(this).siblings('span').eq(1).html(tr));*/
/*         } else if (newValue == 2) {*/
/*             var tr = '<input class="easyui-textbox" type="text" name="UserTask[' + selectedDay + '][num]" style="width: 50px;" data-options="required:true">个';*/
/*             $.parser.parse($(this).siblings('span').eq(1).html(tr));*/
/*         } else if (newValue == 3) {*/
/*             var tr = '<label id="numName' + selectedDay + '"></label><input type="hidden" name="UserTask[' + selectedDay + '][num]" id="num' + selectedDay + '" data-options="required:true"><a href="javascript:void(0);" onclick="addPacket(' + selectedDay + ');" class="easyui-linkbutton">选择红包</a>';*/
/*             $.parser.parse($(this).siblings('span').eq(1).html(tr));*/
/*         }*/
/*     }*/
/* */
/*     function onChangeTask(newValue, oldValue) {*/
/*         var taskId = $(this).attr('taskId');*/
/*         if (newValue == 1) {*/
/*             var tr = '<input class="easyui-textbox" type="text" name="Task[' + taskId + '][award_num]" style="width: 50px;" data-options="required:true">分';*/
/*             $.parser.parse($(this).siblings('span').eq(1).html(tr));*/
/*         } else if (newValue == 2) {*/
/*             var tr = '<input class="easyui-textbox" type="text" name="Task[' + taskId + '][award_num]" style="width: 50px;" data-options="required:true">个';*/
/*             $.parser.parse($(this).siblings('span').eq(1).html(tr));*/
/*         } else if (newValue == 3) {*/
/*             var tr = '<label id="numNameTask' + taskId + '"></label><input type="hidden" name="Task[' + taskId + '][award_num]" id="numTask' + taskId + '" data-options="required:true"><a href="javascript:void(0);" onclick="addPacket(\'Task' + taskId + '\');" class="easyui-linkbutton">选择红包</a>';*/
/*             $.parser.parse($(this).siblings('span').eq(1).html(tr));*/
/*         }*/
/*     }*/
/* */
/*     function submitForm() {*/
/*         $('#sign_form').form({*/
/*             url: "{{ url('user-task/edit') }}",*/
/*             onSubmit:function() {*/
/*                 return $(this).form('enableValidation').form('validate');*/
/*             },*/
/*             success: function (data) {*/
/*                 var data = eval('('+data+')');*/
/*                 if (data.error == 0) {*/
/*                     $.messager.alert('成功', data.message);*/
/*                     parent.location.reload();*/
/*                 } else {*/
/*                     $.messager.alert('失败', data.message, 'error');*/
/*                 }*/
/*             }*/
/*         });*/
/*         $('#sign_form').submit();*/
/*     }*/
/* */
/*     function addPacket(days) {*/
/*         day = days;*/
/*         $('#content').html('');*/
/*         $('#packet').combobox({*/
/*             url:"{{ url('active/packet-list') }}",*/
/*             method:'get',*/
/*             valueField: 'id',*/
/*             textField: 'name',*/
/*             onSelect: function(packet) {*/
/*                 $.get("{{ url('active/packet-detail') }}", {'id': packet.id}, function(data) {*/
/*                     $('#content').html('');*/
/*                     var strHtml = '<table cellpadding="5"';*/
/*                     $.each(data, function(i, v) {*/
/*                         strHtml += '<tr><td>' + v.name + '</td>';*/
/*                         strHtml += '<td>' + v.desc + '</td></tr>';*/
/*                     });*/
/*                     strHtml += '</table>';*/
/*                     $.parser.parse($(strHtml).appendTo('#content'));*/
/*                 });*/
/*             }*/
/*         });*/
/*         $('#dlg-add-packet').window('open');*/
/*     }*/
/* */
/*     function submitAddPacket() {*/
/*         packetId = $('#packet').combobox('getValue');*/
/*         packetName = $('#packet').combobox('getText');*/
/*         if (!packetId) {*/
/*             $.messager.alert('错误','请选择红包');*/
/*         }*/
/*         $('#numName' + day).html(packetName);*/
/*         $('#num' + day).val(packetId);*/
/*         $('#dlg-add-packet').dialog('close');*/
/*     }*/
/* </script>*/
/* {% endblock %}*/
