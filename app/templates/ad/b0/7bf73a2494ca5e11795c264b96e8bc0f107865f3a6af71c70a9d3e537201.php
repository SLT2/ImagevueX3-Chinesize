<?php

/* partials/preview-image.html */
class __TwigTemplate_adb07bf73a2494ca5e11795c264b96e8bc0f107865f3a6af71c70a9d3e537201 extends Twig_Template
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
        $context["page"] = ((array_key_exists("p", $context)) ? (call_user_func_array($this->env->getFilter('default')->getCallable(), array((isset($context["p"]) ? $context["p"] : null), (isset($context["page"]) ? $context["page"] : null)))) : ((isset($context["page"]) ? $context["page"] : null)));
        // line 4
        $context["gallery_assets"] = call_user_func_array($this->env->getFilter('trim')->getCallable(), array($this->getAttribute($this->getAttribute((isset($context["page"]) ? $context["page"] : null), "gallery"), "assets"), "/"));
        // line 5
        echo "
";
        // line 7
        ob_start();
        // line 8
        echo "
";
        // line 10
        if (($this->getAttribute((isset($context["page"]) ? $context["page"] : null), "template_name") == "file")) {
            // line 11
            echo "\t";
            echo $this->getAttribute((isset($context["page"]) ? $context["page"] : null), "file_path");
            echo "

";
        } elseif ((!call_user_func_array($this->env->getTest('empty')->getCallable(), array($this->getAttribute((isset($context["page"]) ? $context["page"] : null), "image"))))) {
            // line 15
            echo "
  ";
            // line 17
            echo "  ";
            if (twig_in_filter("/", $this->getAttribute((isset($context["page"]) ? $context["page"] : null), "image"))) {
                // line 18
                echo "    ";
                echo ("./content" . call_user_func_array($this->env->getFilter('replace')->getCallable(), array(call_user_func_array($this->env->getFilter('replace')->getCallable(), array(("/" . $this->getAttribute((isset($context["page"]) ? $context["page"] : null), "image")), array("content/" => "", "./" => ""))), array("//" => "/"))));
                echo "

  ";
                // line 21
                echo "  ";
                // line 23
                echo "
  ";
                // line 25
                echo "  ";
            } else {
                // line 26
                echo "    ";
                echo $this->getAttribute((isset($context["page"]) ? $context["page"] : null), "file_path");
                echo "/";
                echo $this->getAttribute((isset($context["page"]) ? $context["page"] : null), "image");
                echo "
  ";
            }
            // line 28
            echo "
";
            // line 33
            echo "
";
        } elseif (call_user_func_array($this->env->getFunction('exists')->getCallable(), array(($this->getAttribute((isset($context["page"]) ? $context["page"] : null), "file_path") . "/preview.jpg")))) {
            // line 36
            echo "  ";
            echo $this->getAttribute((isset($context["page"]) ? $context["page"] : null), "file_path");
            echo "/preview.jpg

";
        } elseif ((!call_user_func_array($this->env->getTest('empty')->getCallable(), array(call_user_func_array($this->env->getFilter('first')->getCallable(), array($this->env, $this->getAttribute((isset($context["page"]) ? $context["page"] : null), "images"))))))) {
            // line 40
            echo "  ";
            echo call_user_func_array($this->env->getFilter('first')->getCallable(), array($this->env, $this->getAttribute((isset($context["page"]) ? $context["page"] : null), "images")));
            echo "

";
            // line 45
            echo "
";
        } elseif ($this->getAttribute((isset($context["page"]) ? $context["page"] : null), "image_default")) {
            // line 48
            echo ("./content" . call_user_func_array($this->env->getFilter('replace')->getCallable(), array(call_user_func_array($this->env->getFilter('replace')->getCallable(), array(("/" . $this->getAttribute((isset($context["page"]) ? $context["page"] : null), "image_default")), array("content/" => "", "./" => ""))), array("//" => "/"))));
            echo "

";
        }
        $context["url"] = ('' === $tmp = ob_get_clean()) ? '' : new Twig_Markup($tmp, $this->env->getCharset());
        // line 52
        echo "
";
        // line 54
        $context["e_length"] = call_user_func_array($this->env->getFilter('length')->getCallable(), array($this->env, call_user_func_array($this->env->getFilter('last')->getCallable(), array($this->env, call_user_func_array($this->env->getFilter('split')->getCallable(), array(call_user_func_array($this->env->getFilter('trim')->getCallable(), array((isset($context["url"]) ? $context["url"] : null))), "."))))));
        // line 55
        if ((((isset($context["e_length"]) ? $context["e_length"] : null) < 2) || ((isset($context["e_length"]) ? $context["e_length"] : null) > 4))) {
            // line 56
            $context["url"] = (call_user_func_array($this->env->getFilter('trim')->getCallable(), array((isset($context["url"]) ? $context["url"] : null))) . ".jpg");
        }
        // line 58
        echo "
";
        echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
        // line 61
        echo call_user_func_array($this->env->getFilter('trim')->getCallable(), array((isset($context["url"]) ? $context["url"] : null)));
    }

    public function getTemplateName()
    {
        return "partials/preview-image.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  118 => 61,  114 => 58,  111 => 56,  107 => 54,  104 => 52,  93 => 45,  87 => 40,  76 => 33,  73 => 28,  62 => 25,  59 => 23,  51 => 18,  48 => 17,  45 => 15,  38 => 11,  36 => 10,  31 => 7,  26 => 4,  24 => 3,  21 => 2,  216 => 79,  213 => 77,  210 => 76,  208 => 75,  205 => 73,  201 => 71,  198 => 70,  195 => 69,  191 => 66,  188 => 64,  174 => 63,  170 => 61,  167 => 60,  164 => 59,  161 => 58,  158 => 57,  155 => 56,  152 => 55,  150 => 54,  147 => 53,  144 => 52,  138 => 49,  135 => 48,  132 => 46,  130 => 45,  127 => 44,  109 => 55,  106 => 41,  103 => 40,  100 => 39,  97 => 48,  94 => 37,  91 => 35,  88 => 34,  83 => 33,  80 => 36,  77 => 30,  75 => 29,  72 => 27,  70 => 26,  68 => 25,  65 => 26,  61 => 21,  57 => 21,  55 => 18,  52 => 16,  47 => 15,  43 => 14,  41 => 13,  39 => 12,  37 => 11,  35 => 10,  33 => 8,  30 => 7,  28 => 5,  25 => 4,  23 => 3,  19 => 1,);
    }
}
