<?php

/* member.html */
class __TwigTemplate_11910371d58907c4a823becaafc9e96e9efffbdc7b3b186d618c8852cd8ece8e extends yii\twig\Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<html xmlns=\"http://www.w3.org/1999/xhtml\">
<head>
    <meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />
    <title></title>
    <link href=\"";
        // line 5
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "params", array()), "skinUrl", array()), "html", null, true);
        echo "/css/jquery.jqplot.min.css\" rel=\"stylesheet\" />
    <link rel=\"stylesheet\" type=\"text/css\" href=\"";
        // line 6
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "params", array()), "skinUrl", array()), "html", null, true);
        echo "/js/jquery-easyui-1.4.4/themes/gray/easyui.css\">
    <script src=\"";
        // line 7
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "params", array()), "skinUrl", array()), "html", null, true);
        echo "/js/jqplot/jquery.min.js\"></script>
    <script src=\"";
        // line 8
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "params", array()), "skinUrl", array()), "html", null, true);
        echo "/js/jqplot/jquery.jqplot.min.js\"></script>
    <script src=\"";
        // line 9
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "params", array()), "skinUrl", array()), "html", null, true);
        echo "/js/jqplot/plugins/jqplot.pointLabels.min.js\"></script>
    <script src=\"";
        // line 10
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "params", array()), "skinUrl", array()), "html", null, true);
        echo "/js/jqplot/plugins/jqplot.canvasTextRenderer.min.js\"></script>
    <script src=\"";
        // line 11
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "params", array()), "skinUrl", array()), "html", null, true);
        echo "/js/jqplot/plugins/jqplot.categoryAxisRenderer.min.js\"></script>
    <script src=\"";
        // line 12
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "params", array()), "skinUrl", array()), "html", null, true);
        echo "/js/jquery-easyui-1.4.4/jquery.easyui.min.js\" type=\"text/javascript\"></script>
    <script src=\"";
        // line 13
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "params", array()), "skinUrl", array()), "html", null, true);
        echo "/js/jquery-easyui-1.4.4/locale/easyui-lang-zh_CN.js\" type=\"text/javascript\"></script>
    <script>
        \$(function(){
            var tick = '";
        // line 16
        echo twig_escape_filter($this->env, (isset($context["date"]) ? $context["date"] : null), "html", null, true);
        echo "';
            var tick2 = tick.split(\",\");
            var b1 = '";
        // line 18
        echo twig_escape_filter($this->env, (isset($context["reg"]) ? $context["reg"] : null), "html", null, true);
        echo "'.split(\",\");
            var b2 = '";
        // line 19
        echo twig_escape_filter($this->env, (isset($context["pay"]) ? $context["pay"] : null), "html", null, true);
        echo "'.split(\",\");
            \$.each(b1, function(i, v){
                b1[i] = parseInt(v);
            })
            \$.each(b2, function(i, v){
                b2[i] = parseInt(v);
            })

            var plot2 = \$.jqplot('chart2', [b1, b2], {
                title: tick2[0] + '到' + tick2[tick2.length-1] + '会员增加趋势',
                legend: { show: true, location: 'ne' }, //提示工具栏--show：是否显示,location: 显示位置 (e:东,w:西,s:南,n:北,nw:西北,ne:东北,sw:西南,se:东南)
                series: [
                    {
                        label: '注册会员数',
                        // lineWidth: 8, //线条粗细
                        markerOptions: { size: 6, style: \"circle\" }  // 节点配置
                    },
                    {
                        label: '付费会员数',
                        // lineWidth: 8, //线条粗细
                        markerOptions: { size: 6, style: \"circle\" }  // 节点配置
                    },
                ], //提示工具栏
                //captureRightClick: true,//禁用右键
                seriesDefaults: {
                    //pointLabels: { show: true, ypadding: -1 } //数据点标签
                    //renderer: \$.jqplot.BarRenderer, //使用柱状图表示
                    //柱状体组之间间隔
                    //rendererOptions: {barMargin: 25}
                },
                axes: {
                    xaxis: {
                        label: \"日期\",  //x轴显示标题
                        pad: 5,
                        renderer: \$.jqplot.CategoryAxisRenderer, //x轴绘制方式
                        tickInterval: '1day',
                        ticks: tick2,
                        tickOptions: {

                            fontSize: '10pt'
                        },
                        mark: 'cross'
                    },
                    yaxis: {
                        label: \"个\", // y轴显示标题
                        min: 0,
                        //tickInterval: 10,     //网格线间隔大小
                        tickOptions: { fontSize: '10pt' }
                    }
                }
            });
        })
    </script>
</head>
<body>
<div>
    <form action=\"\" method=\"get\">
        <select name=\"type\">
            <option value=\"0\" selected>默认</option>
            <option value=\"1\" ";
        // line 78
        if (($this->getAttribute((isset($context["get"]) ? $context["get"] : null), "type", array()) == 1)) {
            echo "selected";
        }
        echo ">按天查询</option>
            <option value=\"2\" ";
        // line 79
        if (($this->getAttribute((isset($context["get"]) ? $context["get"] : null), "type", array()) == 2)) {
            echo "selected";
        }
        echo ">按月查询</option>
            <option value=\"3\" ";
        // line 80
        if (($this->getAttribute((isset($context["get"]) ? $context["get"] : null), "type", array()) == 3)) {
            echo "selected";
        }
        echo ">按年查询</option>
        </select>
        <input type=\"text\" name=\"startTime\"  id=\"startTime\" class=\"easyui-datebox\" value=\"";
        // line 82
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["get"]) ? $context["get"] : null), "startTime", array()), "html", null, true);
        echo "\">
        <input type=\"text\" name=\"endTime\"  id=\"endTime\" class=\"easyui-datebox\" value=\"";
        // line 83
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["get"]) ? $context["get"] : null), "endTime", array()), "html", null, true);
        echo "\">
        <input type=\"submit\" value=\"查询\">
    </form>
    <span></span>
</div>
<div id=\"chart2\" style=\"width: 1000px; height: 400px;\"></div>

<table id=\"listdata\" class=\"easyui-datagrid\" title=\"会员列表\" data-options=\"toolbar:'#tb-user',singleSelect:true,pagination:true,method:'get',url:'";
        // line 90
        echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url("stats/list"), "html", null, true);
        echo "',nowrap:false,rownumbers: false\">
    <thead>
    <tr>
        <th data-options=\"field:'date', width:150, align:'center'\">日期</th>
        <th data-options=\"field:'member_num', width:150, align:'center'\">注册会员数</th>
        <th data-options=\"field:'reg_num', width:150, align:'center'\">新增会员数</th>
        <th data-options=\"field:'pay_num', width:150, align:'center'\">付费会员数</th>
        <th data-options=\"field:'valid_reg_num', width:150, align:'center'\">新增付费会员数</th>
        <th data-options=\"field:'tomorrow_left', width:150, align:'center'\">次日留存</th>
        <th data-options=\"field:'week_left', width:150, align:'center'\">七日留存</th>
        <th data-options=\"field:'month_left', width:150, align:'center'\">次月留存</th>
    </tr>
    </thead>
</table>

</body>
</html>";
    }

    public function getTemplateName()
    {
        return "member.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  167 => 90,  157 => 83,  153 => 82,  146 => 80,  140 => 79,  134 => 78,  72 => 19,  68 => 18,  63 => 16,  57 => 13,  53 => 12,  49 => 11,  45 => 10,  41 => 9,  37 => 8,  33 => 7,  29 => 6,  25 => 5,  19 => 1,);
    }
}
/* <html xmlns="http://www.w3.org/1999/xhtml">*/
/* <head>*/
/*     <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />*/
/*     <title></title>*/
/*     <link href="{{ app.params.skinUrl }}/css/jquery.jqplot.min.css" rel="stylesheet" />*/
/*     <link rel="stylesheet" type="text/css" href="{{ app.params.skinUrl }}/js/jquery-easyui-1.4.4/themes/gray/easyui.css">*/
/*     <script src="{{ app.params.skinUrl }}/js/jqplot/jquery.min.js"></script>*/
/*     <script src="{{ app.params.skinUrl }}/js/jqplot/jquery.jqplot.min.js"></script>*/
/*     <script src="{{ app.params.skinUrl }}/js/jqplot/plugins/jqplot.pointLabels.min.js"></script>*/
/*     <script src="{{ app.params.skinUrl }}/js/jqplot/plugins/jqplot.canvasTextRenderer.min.js"></script>*/
/*     <script src="{{ app.params.skinUrl }}/js/jqplot/plugins/jqplot.categoryAxisRenderer.min.js"></script>*/
/*     <script src="{{ app.params.skinUrl }}/js/jquery-easyui-1.4.4/jquery.easyui.min.js" type="text/javascript"></script>*/
/*     <script src="{{ app.params.skinUrl }}/js/jquery-easyui-1.4.4/locale/easyui-lang-zh_CN.js" type="text/javascript"></script>*/
/*     <script>*/
/*         $(function(){*/
/*             var tick = '{{ date }}';*/
/*             var tick2 = tick.split(",");*/
/*             var b1 = '{{ reg }}'.split(",");*/
/*             var b2 = '{{ pay }}'.split(",");*/
/*             $.each(b1, function(i, v){*/
/*                 b1[i] = parseInt(v);*/
/*             })*/
/*             $.each(b2, function(i, v){*/
/*                 b2[i] = parseInt(v);*/
/*             })*/
/* */
/*             var plot2 = $.jqplot('chart2', [b1, b2], {*/
/*                 title: tick2[0] + '到' + tick2[tick2.length-1] + '会员增加趋势',*/
/*                 legend: { show: true, location: 'ne' }, //提示工具栏--show：是否显示,location: 显示位置 (e:东,w:西,s:南,n:北,nw:西北,ne:东北,sw:西南,se:东南)*/
/*                 series: [*/
/*                     {*/
/*                         label: '注册会员数',*/
/*                         // lineWidth: 8, //线条粗细*/
/*                         markerOptions: { size: 6, style: "circle" }  // 节点配置*/
/*                     },*/
/*                     {*/
/*                         label: '付费会员数',*/
/*                         // lineWidth: 8, //线条粗细*/
/*                         markerOptions: { size: 6, style: "circle" }  // 节点配置*/
/*                     },*/
/*                 ], //提示工具栏*/
/*                 //captureRightClick: true,//禁用右键*/
/*                 seriesDefaults: {*/
/*                     //pointLabels: { show: true, ypadding: -1 } //数据点标签*/
/*                     //renderer: $.jqplot.BarRenderer, //使用柱状图表示*/
/*                     //柱状体组之间间隔*/
/*                     //rendererOptions: {barMargin: 25}*/
/*                 },*/
/*                 axes: {*/
/*                     xaxis: {*/
/*                         label: "日期",  //x轴显示标题*/
/*                         pad: 5,*/
/*                         renderer: $.jqplot.CategoryAxisRenderer, //x轴绘制方式*/
/*                         tickInterval: '1day',*/
/*                         ticks: tick2,*/
/*                         tickOptions: {*/
/* */
/*                             fontSize: '10pt'*/
/*                         },*/
/*                         mark: 'cross'*/
/*                     },*/
/*                     yaxis: {*/
/*                         label: "个", // y轴显示标题*/
/*                         min: 0,*/
/*                         //tickInterval: 10,     //网格线间隔大小*/
/*                         tickOptions: { fontSize: '10pt' }*/
/*                     }*/
/*                 }*/
/*             });*/
/*         })*/
/*     </script>*/
/* </head>*/
/* <body>*/
/* <div>*/
/*     <form action="" method="get">*/
/*         <select name="type">*/
/*             <option value="0" selected>默认</option>*/
/*             <option value="1" {% if(get.type == 1) %}selected{% endif %}>按天查询</option>*/
/*             <option value="2" {% if(get.type == 2) %}selected{% endif %}>按月查询</option>*/
/*             <option value="3" {% if(get.type == 3) %}selected{% endif %}>按年查询</option>*/
/*         </select>*/
/*         <input type="text" name="startTime"  id="startTime" class="easyui-datebox" value="{{ get.startTime }}">*/
/*         <input type="text" name="endTime"  id="endTime" class="easyui-datebox" value="{{ get.endTime }}">*/
/*         <input type="submit" value="查询">*/
/*     </form>*/
/*     <span></span>*/
/* </div>*/
/* <div id="chart2" style="width: 1000px; height: 400px;"></div>*/
/* */
/* <table id="listdata" class="easyui-datagrid" title="会员列表" data-options="toolbar:'#tb-user',singleSelect:true,pagination:true,method:'get',url:'{{ url('stats/list')}}',nowrap:false,rownumbers: false">*/
/*     <thead>*/
/*     <tr>*/
/*         <th data-options="field:'date', width:150, align:'center'">日期</th>*/
/*         <th data-options="field:'member_num', width:150, align:'center'">注册会员数</th>*/
/*         <th data-options="field:'reg_num', width:150, align:'center'">新增会员数</th>*/
/*         <th data-options="field:'pay_num', width:150, align:'center'">付费会员数</th>*/
/*         <th data-options="field:'valid_reg_num', width:150, align:'center'">新增付费会员数</th>*/
/*         <th data-options="field:'tomorrow_left', width:150, align:'center'">次日留存</th>*/
/*         <th data-options="field:'week_left', width:150, align:'center'">七日留存</th>*/
/*         <th data-options="field:'month_left', width:150, align:'center'">次月留存</th>*/
/*     </tr>*/
/*     </thead>*/
/* </table>*/
/* */
/* </body>*/
/* </html>*/
