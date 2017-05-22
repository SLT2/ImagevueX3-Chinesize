<?php

/* partials/content.html */
class __TwigTemplate_585aa3baeb85acf3dfa1278a54c5df9bba02d414440929f3d87365a177b57662 extends Twig_Template
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
        $this->env->loadTemplate("partials/nav/article-nav.html")->display(array_merge($context, array("page" => (isset($context["page"]) ? $context["page"] : null))));
        // line 2
        echo "
";
        // line 4
        $context["layout"] = $this->getAttribute((isset($context["page"]) ? $context["page"] : null), "layout");
        // line 6
        $context["items"] = call_user_func_array($this->env->getFilter('split')->getCallable(), array($this->getAttribute((isset($context["layout"]) ? $context["layout"] : null), "items"), ","));
        // line 7
        echo "
";
        // line 9
        if (((!call_user_func_array($this->env->getTest('empty')->getCallable(), array($this->getAttribute($this->getAttribute((isset($context["page"]) ? $context["page"] : null), "accounts"), "disqus_shortname")))) && $this->getAttribute((isset($context["layout"]) ? $context["layout"] : null), "disqus"))) {
            $context["items"] = call_user_func_array($this->env->getFilter('merge')->getCallable(), array((isset($context["items"]) ? $context["items"] : null), array(0 => "disqus")));
        }
        // line 10
        echo "
";
        // line 12
        $context["container"] = "partials/module.layout.html";
        // line 13
        echo "
";
        // line 15
        if (($this->getAttribute($this->getAttribute((isset($context["page"]) ? $context["page"] : null), "folders"), "assets") && call_user_func_array($this->env->getFunction('exists')->getCallable(), array(call_user_func_array($this->env->getFilter('trim')->getCallable(), array($this->getAttribute($this->getAttribute((isset($context["page"]) ? $context["page"] : null), "folders"), "assets"), "/")))))) {
            // line 16
            echo "\t";
            $context["folder"] = call_user_func_array($this->env->getFunction('get')->getCallable(), array(call_user_func_array($this->env->getFilter('trim')->getCallable(), array($this->getAttribute($this->getAttribute((isset($context["page"]) ? $context["page"] : null), "folders"), "assets"), "/"))));
        } else {
            // line 18
            echo "\t";
            $context["folder"] = (isset($context["page"]) ? $context["page"] : null);
        }
        // line 20
        echo "
";
        // line 22
        if (($this->getAttribute($this->getAttribute((isset($context["page"]) ? $context["page"] : null), "gallery"), "assets") && call_user_func_array($this->env->getFunction('exists')->getCallable(), array(call_user_func_array($this->env->getFilter('trim')->getCallable(), array($this->getAttribute($this->getAttribute((isset($context["page"]) ? $context["page"] : null), "gallery"), "assets"), "/")))))) {
            // line 23
            echo "\t";
            $context["gallery"] = call_user_func_array($this->env->getFunction('get')->getCallable(), array(call_user_func_array($this->env->getFilter('trim')->getCallable(), array($this->getAttribute($this->getAttribute((isset($context["page"]) ? $context["page"] : null), "gallery"), "assets"), "/"))));
        } else {
            // line 25
            echo "\t";
            $context["gallery"] = (isset($context["page"]) ? $context["page"] : null);
        }
        // line 27
        echo "
";
        // line 29
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["items"]) ? $context["items"] : null));
        $context['loop'] = array(
          'parent' => $context['_parent'],
          'index0' => 0,
          'index'  => 1,
          'first'  => true,
        );
        foreach ($context['_seq'] as $context["_key"] => $context["module"]) {
            if ((!$this->getAttribute($this->getAttribute((isset($context["page"]) ? $context["page"] : null), (isset($context["module"]) ? $context["module"] : null), array(), "array"), "hide"))) {
                // line 30
                echo "
\t";
                // line 32
                echo "\t";
                if (((isset($context["module"]) ? $context["module"] : null) == "context")) {
                    // line 33
                    echo "\t";
                    $template = $this->env->resolveTemplate((isset($context["container"]) ? $context["container"] : null));
                    $template->display(array_merge($context, array("module" => (isset($context["module"]) ? $context["module"] : null), "default" => true)));
                    // line 34
                    echo "
\t";
                    // line 36
                    echo "\t";
                } elseif ((((isset($context["module"]) ? $context["module"] : null) == "folders") && ($this->getAttribute((isset($context["folder"]) ? $context["folder"] : null), "children_count") > 0))) {
                    // line 37
                    echo "\t";
                    $template = $this->env->resolveTemplate((isset($context["container"]) ? $context["container"] : null));
                    $template->display(array_merge($context, array("module" => (isset($context["module"]) ? $context["module"] : null), "default" => true, "class" => "images")));
                    // line 38
                    echo "
\t";
                    // line 40
                    echo "\t";
                } elseif ((((isset($context["module"]) ? $context["module"] : null) == "gallery") && (((call_user_func_array($this->env->getFilter('length')->getCallable(), array($this->env, $this->getAttribute((isset($context["gallery"]) ? $context["gallery"] : null), "images"))) > 0) || $this->getAttribute($this->getAttribute((isset($context["page"]) ? $context["page"] : null), "gallery"), "embed")) || (call_user_func_array($this->env->getFilter('length')->getCallable(), array($this->env, $this->getAttribute((isset($context["gallery"]) ? $context["gallery"] : null), "video"))) > 0)))) {
                    // line 41
                    echo "\t\t";
                    $template = $this->env->resolveTemplate((isset($context["container"]) ? $context["container"] : null));
                    $template->display(array_merge($context, array("module" => (isset($context["module"]) ? $context["module"] : null), "default" => true, "class" => "images")));
                    // line 42
                    echo "
\t";
                    // line 44
                    echo "\t";
                } elseif ((((isset($context["module"]) ? $context["module"] : null) == "disqus") && (!call_user_func_array($this->env->getTest('empty')->getCallable(), array($this->getAttribute($this->getAttribute((isset($context["page"]) ? $context["page"] : null), "accounts"), "disqus_shortname")))))) {
                    // line 45
                    echo "\t";
                    $template = $this->env->resolveTemplate((isset($context["container"]) ? $context["container"] : null));
                    $template->display(array_merge($context, array("module" => (isset($context["module"]) ? $context["module"] : null), "default" => false)));
                    // line 46
                    echo "\t";
                }
                // line 47
                echo "
";
                ++$context['loop']['index0'];
                ++$context['loop']['index'];
                $context['loop']['first'] = false;
            }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['module'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
    }

    public function getTemplateName()
    {
        return "partials/content.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  120 => 46,  113 => 44,  96 => 37,  90 => 34,  49 => 18,  95 => 32,  71 => 24,  66 => 27,  63 => 19,  58 => 23,  56 => 22,  53 => 20,  44 => 12,  27 => 6,  282 => 106,  279 => 105,  269 => 99,  266 => 98,  264 => 97,  260 => 96,  256 => 95,  254 => 94,  249 => 91,  246 => 89,  243 => 87,  237 => 85,  234 => 84,  231 => 82,  225 => 80,  222 => 79,  218 => 76,  207 => 70,  182 => 64,  179 => 62,  163 => 56,  129 => 36,  123 => 47,  116 => 45,  110 => 42,  89 => 30,  86 => 33,  79 => 23,  69 => 29,  50 => 14,  46 => 13,  40 => 13,  22 => 2,  118 => 61,  114 => 58,  111 => 56,  107 => 54,  104 => 52,  93 => 36,  87 => 29,  76 => 21,  73 => 25,  62 => 25,  59 => 23,  51 => 18,  48 => 17,  45 => 16,  38 => 12,  36 => 10,  31 => 9,  26 => 6,  24 => 4,  21 => 2,  216 => 75,  213 => 77,  210 => 72,  208 => 75,  205 => 73,  201 => 68,  198 => 67,  195 => 69,  191 => 66,  188 => 64,  174 => 63,  170 => 61,  167 => 57,  164 => 59,  161 => 58,  158 => 57,  155 => 56,  152 => 55,  150 => 45,  147 => 44,  144 => 42,  138 => 40,  135 => 39,  132 => 46,  130 => 45,  127 => 44,  109 => 55,  106 => 41,  103 => 40,  100 => 38,  97 => 48,  94 => 27,  91 => 35,  88 => 34,  83 => 32,  80 => 30,  77 => 30,  75 => 29,  72 => 27,  70 => 26,  68 => 25,  65 => 26,  61 => 21,  57 => 21,  55 => 18,  52 => 16,  47 => 15,  43 => 15,  41 => 13,  39 => 12,  37 => 11,  35 => 10,  33 => 9,  30 => 8,  28 => 7,  25 => 4,  23 => 3,  19 => 1,);
    }
}
