<?php

/* partials/nav/header.html */
class __TwigTemplate_822840988cad7eabfff58a6d564192a3274110d6dcd9a2af5ddd870df06fe063 extends Twig_Template
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
<header class=header>

\t\t";
        // line 5
        echo "\t\t";
        $context["logo_title"] = (($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["page"]) ? $context["page"] : null), "style", array(), "any", false, true), "logo", array(), "any", false, true), "title", array(), "any", true, true)) ? (call_user_func_array($this->env->getFilter('default')->getCallable(), array($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["page"]) ? $context["page"] : null), "style", array(), "any", false, true), "logo", array(), "any", false, true), "title"), "Logo Here"))) : ("Logo Here"));
        // line 6
        echo "
\t\t";
        // line 8
        echo "\t\t";
        ob_start();
        // line 9
        echo "\t\t\t";
        if ($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["page"]) ? $context["page"] : null), "style"), "logo"), "use_image")) {
            // line 10
            echo "\t\t\t\t<img src='";
            echo ((isset($context["assetspath"]) ? $context["assetspath"] : null) . call_user_func_array($this->env->getFunction('firstImage')->getCallable(), array("./content/custom/logo")));
            echo "' alt='";
            echo (isset($context["logo_title"]) ? $context["logo_title"] : null);
            echo "' />
\t\t\t";
        } else {
            // line 12
            echo "\t\t\t\t";
            echo call_user_func_array($this->env->getFilter('trim')->getCallable(), array((isset($context["logo_title"]) ? $context["logo_title"] : null)));
            echo "
\t  \t";
        }
        // line 14
        echo "  \t";
        $context["logo_content"] = ('' === $tmp = ob_get_clean()) ? '' : new Twig_Markup($tmp, $this->env->getCharset());
        // line 15
        echo "
  \t";
        // line 17
        echo "  \t";
        // line 18
        echo "  \t";
        if ($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["page"]) ? $context["page"] : null), "style"), "logo"), "use_image")) {
            $context["logo_classes"] = " logo-image";
        }
        // line 19
        echo "
\t\t";
        // line 21
        echo "\t\t<div class=nav-wrapper>
\t\t\t<nav class=nav>
\t\t\t\t<div>
\t\t\t\t";
        // line 24
        if ($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["page"]) ? $context["page"] : null), "style"), "logo"), "enabled")) {
            // line 25
            echo "\t\t\t\t\t<a href=\"";
            echo (isset($context["rootpath"]) ? $context["rootpath"] : null);
            echo "/\" class='logo ";
            echo (isset($context["logo_classes"]) ? $context["logo_classes"] : null);
            echo "'>";
            echo call_user_func_array($this->env->getFilter('trim')->getCallable(), array((isset($context["logo_content"]) ? $context["logo_content"] : null)));
            echo "</a>
\t\t\t\t";
        }
        // line 27
        echo "\t\t\t\t</div>
\t\t\t\t<ul class='menu slim'>
\t\t\t\t\t";
        // line 29
        if ((!$this->getAttribute($this->getAttribute((isset($context["page"]) ? $context["page"] : null), "settings"), "menu_disabled"))) {
            // line 30
            echo "\t\t\t\t\t\t";
            echo call_user_func_array($this->env->getFunction('getMenu')->getCallable(), array());
            echo "
\t\t\t\t\t";
        }
        // line 32
        echo "\t\t\t\t</ul>
\t\t\t</nav>
\t\t</div>

</header>";
    }

    public function getTemplateName()
    {
        return "partials/nav/header.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  95 => 32,  71 => 24,  66 => 21,  63 => 19,  58 => 18,  56 => 17,  53 => 15,  44 => 12,  27 => 6,  282 => 106,  279 => 105,  269 => 99,  266 => 98,  264 => 97,  260 => 96,  256 => 95,  254 => 94,  249 => 91,  246 => 89,  243 => 87,  237 => 85,  234 => 84,  231 => 82,  225 => 80,  222 => 79,  218 => 76,  207 => 70,  182 => 64,  179 => 62,  163 => 56,  129 => 36,  123 => 33,  116 => 32,  110 => 31,  89 => 30,  86 => 24,  79 => 23,  69 => 20,  50 => 14,  46 => 13,  40 => 11,  22 => 2,  118 => 61,  114 => 58,  111 => 56,  107 => 54,  104 => 52,  93 => 45,  87 => 29,  76 => 21,  73 => 25,  62 => 19,  59 => 23,  51 => 18,  48 => 17,  45 => 15,  38 => 10,  36 => 10,  31 => 7,  26 => 4,  24 => 5,  21 => 2,  216 => 75,  213 => 77,  210 => 72,  208 => 75,  205 => 73,  201 => 68,  198 => 67,  195 => 69,  191 => 66,  188 => 64,  174 => 63,  170 => 61,  167 => 57,  164 => 59,  161 => 58,  158 => 57,  155 => 56,  152 => 55,  150 => 45,  147 => 44,  144 => 42,  138 => 40,  135 => 39,  132 => 46,  130 => 45,  127 => 44,  109 => 55,  106 => 30,  103 => 40,  100 => 28,  97 => 48,  94 => 27,  91 => 35,  88 => 34,  83 => 27,  80 => 36,  77 => 30,  75 => 29,  72 => 27,  70 => 26,  68 => 25,  65 => 26,  61 => 21,  57 => 21,  55 => 18,  52 => 16,  47 => 15,  43 => 14,  41 => 13,  39 => 12,  37 => 11,  35 => 10,  33 => 9,  30 => 8,  28 => 5,  25 => 4,  23 => 3,  19 => 1,);
    }
}
