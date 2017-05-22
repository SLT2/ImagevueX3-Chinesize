<?php

/* partials/module.layout.html */
class __TwigTemplate_e19200e63d78338b0664659b4d14cd50ba94f0323d7c2c998866c05335eb70cf extends Twig_Template
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
        echo "
";
        // line 3
        $context["name"] = (isset($context["module"]) ? $context["module"] : null);
        // line 4
        $context["module"] = $this->getAttribute((isset($context["page"]) ? $context["page"] : null), (isset($context["module"]) ? $context["module"] : null), array(), "array");
        // line 5
        echo "
";
        // line 7
        if (($this->getAttribute((isset($context["module"]) ? $context["module"] : null), "width") && ($this->getAttribute((isset($context["module"]) ? $context["module"] : null), "width") != "width-default"))) {
            // line 8
            echo "\t";
            $context["width"] = $this->getAttribute((isset($context["module"]) ? $context["module"] : null), "width");
        } elseif (($this->getAttribute((isset($context["layout"]) ? $context["layout"] : null), "width") && ($this->getAttribute((isset($context["layout"]) ? $context["layout"] : null), "width") != "width-default"))) {
            // line 10
            echo "  ";
            $context["width"] = $this->getAttribute((isset($context["layout"]) ? $context["layout"] : null), "width");
        } else {
            // line 12
            echo "\t";
            $context["width"] = "";
        }
        // line 14
        echo "
";
        // line 16
        if ((((isset($context["width"]) ? $context["width"] : null) == "wide") || ((isset($context["name"]) ? $context["name"] : null) == "disqus"))) {
            // line 17
            echo "\t";
            $context["columns"] = "";
        } elseif (((isset($context["width"]) ? $context["width"] : null) == "narrow")) {
            // line 19
            echo "\t";
            $context["columns"] = "small-12 large-10 small-centered columns";
        } elseif (((isset($context["width"]) ? $context["width"] : null) == "narrower")) {
            // line 21
            echo "\t";
            $context["columns"] = "small-12 medium-10 large-8 small-centered columns";
        } elseif (((isset($context["width"]) ? $context["width"] : null) == "narrowest")) {
            // line 23
            echo "\t";
            $context["columns"] = "small-12 medium-9 large-6 small-centered columns";
        } else {
            // line 25
            echo "\t";
            $context["columns"] = "small-12 small-centered columns";
        }
        // line 27
        echo "
";
        // line 29
        if ((((isset($context["width"]) ? $context["width"] : null) == "wide") || ((isset($context["name"]) ? $context["name"] : null) == "disqus"))) {
            // line 30
            echo "\t<div class=module>
";
        } else {
            // line 32
            echo "\t<div class='module row'>
";
        }
        // line 34
        echo "
";
        // line 36
        ob_start();
        // line 37
        if (((isset($context["name"]) ? $context["name"] : null) == "gallery")) {
            echo "itemscope itemtype='http://schema.org/ImageGallery'";
        }
        $context["schema"] = ('' === $tmp = ob_get_clean()) ? '' : new Twig_Markup($tmp, $this->env->getCharset());
        // line 39
        echo "
";
        // line 41
        if ($this->getAttribute($this->getAttribute((isset($context["module"]) ? $context["module"] : null), "caption"), "enabled")) {
            // line 42
            echo "\t";
            $context["caption_classes"] = $this->getAttribute($this->getAttribute((isset($context["module"]) ? $context["module"] : null), "caption"), "align");
            // line 43
            echo "\t";
            if ($this->getAttribute($this->getAttribute((isset($context["module"]) ? $context["module"] : null), "caption"), "hover")) {
                $context["caption_classes"] = ((isset($context["caption_classes"]) ? $context["caption_classes"] : null) . " caption-hover");
            }
        }
        // line 45
        echo "
";
        // line 47
        if ((($this->getAttribute((isset($context["module"]) ? $context["module"] : null), "layout") == "vertical") && $this->getAttribute($this->getAttribute((isset($context["module"]) ? $context["module"] : null), "vertical"), "horizontal_rule"))) {
            // line 48
            echo "\t";
            $context["hr"] = "hr";
        }
        // line 50
        echo "
";
        // line 56
        echo "
";
        // line 58
        ob_start();
        echo "clearfix ";
        echo (isset($context["name"]) ? $context["name"] : null);
        echo " ";
        echo (isset($context["columns"]) ? $context["columns"] : null);
        echo " ";
        if ($this->getAttribute((isset($context["module"]) ? $context["module"] : null), "layout")) {
            echo "layout-";
            echo $this->getAttribute((isset($context["module"]) ? $context["module"] : null), "layout");
        }
        echo " ";
        echo $this->getAttribute($this->getAttribute((isset($context["page"]) ? $context["page"] : null), "include"), "layout");
        echo " ";
        echo $this->getAttribute((isset($context["layout"]) ? $context["layout"] : null), "classes");
        echo " ";
        echo $this->getAttribute($this->getAttribute((isset($context["page"]) ? $context["page"] : null), "include"), (isset($context["name"]) ? $context["name"] : null), array(), "array");
        echo " ";
        echo $this->getAttribute((isset($context["module"]) ? $context["module"] : null), "classes");
        echo " ";
        echo (isset($context["caption_classes"]) ? $context["caption_classes"] : null);
        echo " ";
        echo (isset($context["class"]) ? $context["class"] : null);
        echo " title-";
        echo (($this->getAttribute((isset($context["module"]) ? $context["module"] : null), "title_size", array(), "any", true, true)) ? (call_user_func_array($this->env->getFilter('default')->getCallable(), array($this->getAttribute((isset($context["module"]) ? $context["module"] : null), "title_size"), "normal"))) : ("normal"));
        echo " ";
        echo (isset($context["width"]) ? $context["width"] : null);
        echo " ";
        echo (isset($context["hr"]) ? $context["hr"] : null);
        $context["module_classes"] = ('' === $tmp = ob_get_clean()) ? '' : new Twig_Markup($tmp, $this->env->getCharset());
        // line 60
        $context["module_classes"] = call_user_func_array($this->env->getFilter('textAlign')->getCallable(), array(call_user_func_array($this->env->getFilter('cleanData')->getCallable(), array((isset($context["module_classes"]) ? $context["module_classes"] : null)))));
        // line 61
        echo "
";
        // line 63
        echo "<div class='";
        echo (isset($context["module_classes"]) ? $context["module_classes"] : null);
        echo "' ";
        echo (isset($context["schema"]) ? $context["schema"] : null);
        echo ">
\t";
        // line 64
        $template = $this->env->resolveTemplate((("partials/module." . (isset($context["name"]) ? $context["name"] : null)) . ".html"));
        $template->display($context);
        // line 65
        echo "\t<hr class=module-separator />
\t";
        // line 67
        echo "</div>

";
        // line 70
        echo "</div>
";
    }

    public function getTemplateName()
    {
        return "partials/module.layout.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  172 => 70,  168 => 67,  165 => 65,  162 => 64,  117 => 56,  108 => 47,  105 => 45,  99 => 43,  84 => 36,  81 => 34,  60 => 23,  29 => 7,  64 => 25,  32 => 7,  120 => 58,  113 => 44,  96 => 42,  90 => 34,  49 => 18,  95 => 32,  71 => 29,  66 => 27,  63 => 19,  58 => 23,  56 => 21,  53 => 20,  44 => 12,  27 => 6,  282 => 106,  279 => 105,  269 => 99,  266 => 98,  264 => 97,  260 => 96,  256 => 95,  254 => 94,  249 => 91,  246 => 89,  243 => 87,  237 => 85,  234 => 84,  231 => 82,  225 => 80,  222 => 79,  218 => 76,  207 => 70,  182 => 64,  179 => 62,  163 => 56,  129 => 36,  123 => 47,  116 => 45,  110 => 48,  89 => 30,  86 => 37,  79 => 23,  69 => 29,  50 => 14,  46 => 16,  40 => 13,  22 => 3,  118 => 61,  114 => 50,  111 => 56,  107 => 54,  104 => 52,  93 => 36,  87 => 29,  76 => 21,  73 => 30,  62 => 25,  59 => 15,  51 => 13,  48 => 17,  45 => 16,  38 => 12,  36 => 10,  31 => 8,  26 => 5,  24 => 4,  21 => 2,  216 => 75,  213 => 77,  210 => 72,  208 => 75,  205 => 73,  201 => 68,  198 => 67,  195 => 69,  191 => 66,  188 => 64,  174 => 63,  170 => 61,  167 => 57,  164 => 59,  161 => 58,  158 => 57,  155 => 63,  152 => 61,  150 => 60,  147 => 44,  144 => 42,  138 => 40,  135 => 39,  132 => 46,  130 => 45,  127 => 44,  109 => 55,  106 => 41,  103 => 40,  100 => 38,  97 => 48,  94 => 41,  91 => 39,  88 => 34,  83 => 32,  80 => 30,  77 => 32,  75 => 29,  72 => 27,  70 => 26,  68 => 27,  65 => 26,  61 => 21,  57 => 21,  55 => 18,  52 => 19,  47 => 15,  43 => 14,  41 => 13,  39 => 12,  37 => 11,  35 => 10,  33 => 9,  30 => 6,  28 => 7,  25 => 4,  23 => 3,  19 => 1,);
    }
}
