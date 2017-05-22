<?php

/* partials/nav/article-nav.html */
class __TwigTemplate_440e40b6e085816631b099e256a440b3fd0138b338c0c0cb0c2210df86701b66 extends Twig_Template
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
        ob_start();
        // line 2
        echo "
";
        // line 3
        if ((((($this->getAttribute($this->getAttribute((isset($context["page"]) ? $context["page"] : null), "settings"), "pagenav") && ($this->getAttribute((isset($context["page"]) ? $context["page"] : null), "siblings_count") > 0)) && ($this->getAttribute((isset($context["page"]) ? $context["page"] : null), "slug") != "index")) && ($this->getAttribute((isset($context["page"]) ? $context["page"] : null), "children_count") == 0)) && (!$this->getAttribute($this->getAttribute($this->getAttribute((isset($context["page"]) ? $context["page"] : null), "gallery"), "slideshow"), "background")))) {
            // line 4
            echo "<div class=article-nav>

\t";
            // line 6
            if ((!call_user_func_array($this->env->getTest('empty')->getCallable(), array($this->getAttribute($this->getAttribute((isset($context["page"]) ? $context["page"] : null), "next_sibling"), 0, array(), "array"))))) {
                // line 7
                echo "\t\t";
                $context["next"] = call_user_func_array($this->env->getFunction('getSibling')->getCallable(), array($this->getAttribute($this->getAttribute((isset($context["page"]) ? $context["page"] : null), "next_sibling"), 0, array(), "array")));
                // line 8
                echo "\t\t<a href='../";
                echo (isset($context["next"]) ? $context["next"] : null);
                echo "/' class='next'><span>";
                echo call_user_func_array($this->env->getFilter('title')->getCallable(), array($this->env, (isset($context["next"]) ? $context["next"] : null)));
                echo "</span></a>
\t";
            }
            // line 10
            echo "
\t";
            // line 11
            if ((!call_user_func_array($this->env->getTest('empty')->getCallable(), array($this->getAttribute($this->getAttribute((isset($context["page"]) ? $context["page"] : null), "previous_sibling"), 0, array(), "array"))))) {
                // line 12
                echo "\t\t";
                $context["previous"] = call_user_func_array($this->env->getFunction('getSibling')->getCallable(), array($this->getAttribute($this->getAttribute((isset($context["page"]) ? $context["page"] : null), "previous_sibling"), 0, array(), "array")));
                // line 13
                echo "\t\t<a href='../";
                echo (isset($context["previous"]) ? $context["previous"] : null);
                echo "/' class='previous'><span>";
                echo call_user_func_array($this->env->getFilter('title')->getCallable(), array($this->env, (isset($context["previous"]) ? $context["previous"] : null)));
                echo "</span></a>
\t";
            }
            // line 15
            echo "
</div>
";
        }
        // line 18
        echo "
";
        echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
    }

    public function getTemplateName()
    {
        return "partials/nav/article-nav.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  64 => 18,  32 => 7,  120 => 46,  113 => 44,  96 => 37,  90 => 34,  49 => 18,  95 => 32,  71 => 24,  66 => 27,  63 => 19,  58 => 23,  56 => 22,  53 => 20,  44 => 12,  27 => 6,  282 => 106,  279 => 105,  269 => 99,  266 => 98,  264 => 97,  260 => 96,  256 => 95,  254 => 94,  249 => 91,  246 => 89,  243 => 87,  237 => 85,  234 => 84,  231 => 82,  225 => 80,  222 => 79,  218 => 76,  207 => 70,  182 => 64,  179 => 62,  163 => 56,  129 => 36,  123 => 47,  116 => 45,  110 => 42,  89 => 30,  86 => 33,  79 => 23,  69 => 29,  50 => 14,  46 => 11,  40 => 13,  22 => 2,  118 => 61,  114 => 58,  111 => 56,  107 => 54,  104 => 52,  93 => 36,  87 => 29,  76 => 21,  73 => 25,  62 => 25,  59 => 15,  51 => 13,  48 => 12,  45 => 16,  38 => 12,  36 => 10,  31 => 9,  26 => 4,  24 => 3,  21 => 2,  216 => 75,  213 => 77,  210 => 72,  208 => 75,  205 => 73,  201 => 68,  198 => 67,  195 => 69,  191 => 66,  188 => 64,  174 => 63,  170 => 61,  167 => 57,  164 => 59,  161 => 58,  158 => 57,  155 => 56,  152 => 55,  150 => 45,  147 => 44,  144 => 42,  138 => 40,  135 => 39,  132 => 46,  130 => 45,  127 => 44,  109 => 55,  106 => 41,  103 => 40,  100 => 38,  97 => 48,  94 => 27,  91 => 35,  88 => 34,  83 => 32,  80 => 30,  77 => 30,  75 => 29,  72 => 27,  70 => 26,  68 => 25,  65 => 26,  61 => 21,  57 => 21,  55 => 18,  52 => 16,  47 => 15,  43 => 10,  41 => 13,  39 => 12,  37 => 11,  35 => 8,  33 => 9,  30 => 6,  28 => 7,  25 => 4,  23 => 3,  19 => 1,);
    }
}
