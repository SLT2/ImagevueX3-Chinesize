<?php

/* partials/module.video.html */
class __TwigTemplate_2ed7b0d59236e70fffa4ca6fdd28388b83c71c9e1e25406f90302dfc3d71c5dc extends Twig_Template
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
        echo "
";
        // line 5
        $context["myvideos"] = $this->getAttribute((isset($context["gallery"]) ? $context["gallery"] : null), "video");
        // line 6
        echo "
";
        // line 8
        if ((($this->getAttribute((isset($context["settings"]) ? $context["settings"] : null), "sort") != "shuffle") && ($this->getAttribute((isset($context["settings"]) ? $context["settings"] : null), "sortby") != "shuffle"))) {
            // line 9
            echo "
\t";
            // line 11
            echo "\t";
            if (($this->getAttribute((isset($context["settings"]) ? $context["settings"] : null), "sortby") == "title")) {
                // line 12
                echo "\t\t";
                $context["myvideos"] = call_user_func_array($this->env->getFunction('sortby')->getCallable(), array($this->getAttribute((isset($context["gallery"]) ? $context["gallery"] : null), "video"), "title", "file_name"));
                // line 13
                echo "\t";
            } elseif (($this->getAttribute((isset($context["settings"]) ? $context["settings"] : null), "sortby") == "date")) {
                // line 14
                echo "\t\t";
                $context["myvideos"] = call_user_func_array($this->env->getFunction('sortbydate')->getCallable(), array($this->getAttribute((isset($context["gallery"]) ? $context["gallery"] : null), "video"), "date"));
                // line 15
                echo "\t";
            } elseif (($this->getAttribute((isset($context["settings"]) ? $context["settings"] : null), "sortby") == "custom")) {
                // line 16
                echo "\t\t";
                $context["myvideos"] = call_user_func_array($this->env->getFunction('sortby')->getCallable(), array($this->getAttribute((isset($context["gallery"]) ? $context["gallery"] : null), "video"), "index"));
                // line 17
                echo "\t";
            }
            // line 18
            echo "
\t";
            // line 20
            echo "\t";
            if (($this->getAttribute((isset($context["settings"]) ? $context["settings"] : null), "sort") == "desc")) {
                // line 21
                echo "\t\t";
                $context["myvideos"] = call_user_func_array($this->env->getFilter('reverse')->getCallable(), array($this->env, (isset($context["myvideos"]) ? $context["myvideos"] : null)));
                // line 22
                echo "\t";
            }
        }
        // line 24
        echo "
";
        // line 26
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["myvideos"]) ? $context["myvideos"] : null));
        $context['loop'] = array(
          'parent' => $context['_parent'],
          'index0' => 0,
          'index'  => 1,
          'first'  => true,
        );
        if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof Countable)) {
            $length = count($context['_seq']);
            $context['loop']['revindex0'] = $length - 1;
            $context['loop']['revindex'] = $length;
            $context['loop']['length'] = $length;
            $context['loop']['last'] = 1 === $length;
        }
        foreach ($context['_seq'] as $context["_key"] => $context["image"]) {
            // line 27
            echo "
\t";
            // line 29
            echo "\t";
            $context["title"] = call_user_func_array($this->env->getFilter('default')->getCallable(), array(call_user_func_array($this->env->getFilter('replace')->getCallable(), array(call_user_func_array($this->env->getFilter('striptags')->getCallable(), array(call_user_func_array($this->env->getFunction('getDefault')->getCallable(), array($this->getAttribute((isset($context["image"]) ? $context["image"] : null), "title"), $this->getAttribute($this->getAttribute((isset($context["settings"]) ? $context["settings"] : null), "image"), "title"), $this->getAttribute($this->getAttribute((isset($context["settings"]) ? $context["settings"] : null), "image"), "title_include"))), "<a><span><em><i><b><strong><small><s><mark>")), array("{file_name}" => call_user_func_array($this->env->getFilter('removeExtension')->getCallable(), array($this->getAttribute((isset($context["image"]) ? $context["image"] : null), "file_name"))), "{file_name_ext}" => $this->getAttribute((isset($context["image"]) ? $context["image"] : null), "file_name")))), $this->getAttribute((isset($context["image"]) ? $context["image"] : null), "name")));
            // line 30
            echo "\t";
            $context["title_pseudo"] = call_user_func_array($this->env->getFilter('replace')->getCallable(), array((isset($context["title"]) ? $context["title"] : null), array("<a" => "<span", "</a>" => "</span>", " href=" => " data-href=", " target=" => " data-target=")));
            // line 31
            echo "
\t";
            // line 33
            echo "\t";
            $context["image_description"] = call_user_func_array($this->env->getFunction('getDefault')->getCallable(), array($this->getAttribute((isset($context["image"]) ? $context["image"] : null), "description"), $this->getAttribute($this->getAttribute((isset($context["settings"]) ? $context["settings"] : null), "image"), "description"), $this->getAttribute($this->getAttribute((isset($context["settings"]) ? $context["settings"] : null), "image"), "description_include")));
            // line 34
            echo "\t";
            if (call_user_func_array($this->env->getTest('empty')->getCallable(), array((isset($context["image_description"]) ? $context["image_description"] : null)))) {
                // line 35
                echo "\t\t";
                $context["description"] = "";
                // line 36
                echo "\t\t";
                $context["description_pseudo"] = "";
                // line 37
                echo "\t";
            } else {
                // line 38
                echo "\t\t";
                $context["description"] = call_user_func_array($this->env->getFilter('replace')->getCallable(), array(call_user_func_array($this->env->getFilter('striptags')->getCallable(), array((isset($context["image_description"]) ? $context["image_description"] : null), "<a><span><em><i><b><strong><small><s><br><mark><img><kbd><code><button>")), array("{file_name}" => call_user_func_array($this->env->getFilter('removeExtension')->getCallable(), array($this->getAttribute((isset($context["image"]) ? $context["image"] : null), "file_name"))), "{file_name_ext}" => $this->getAttribute((isset($context["image"]) ? $context["image"] : null), "file_name"))));
                // line 39
                echo "\t\t";
                $context["description_pseudo"] = call_user_func_array($this->env->getFilter('replace')->getCallable(), array((isset($context["description"]) ? $context["description"] : null), array("<a" => "<span", "</a>" => "</span>", " href=" => " data-href=", " target=" => " data-target=")));
                // line 40
                echo "\t";
            }
            // line 41
            echo "
\t";
            // line 43
            echo "\t";
            $context["date"] = $this->getAttribute((isset($context["image"]) ? $context["image"] : null), "date");
            // line 44
            echo "\t";
            if (($this->getAttribute($this->getAttribute((isset($context["page"]) ? $context["page"] : null), "settings"), "date_format") == "timeago")) {
                // line 45
                echo "\t\t";
                $context["date_formatted"] = call_user_func_array($this->env->getFilter('date')->getCallable(), array($this->env, (isset($context["date"]) ? $context["date"] : null), "d F Y"));
                // line 46
                echo "\t\t";
                $context["date_class"] = "date timeago";
                // line 47
                echo "\t";
            } else {
                // line 48
                echo "\t\t";
                $context["date_formatted"] = call_user_func_array($this->env->getFilter('date')->getCallable(), array($this->env, (isset($context["date"]) ? $context["date"] : null), (($this->getAttribute($this->getAttribute((isset($context["page"]) ? $context["page"] : null), "settings", array(), "any", false, true), "date_format", array(), "any", true, true)) ? (call_user_func_array($this->env->getFilter('default')->getCallable(), array($this->getAttribute($this->getAttribute((isset($context["page"]) ? $context["page"] : null), "settings", array(), "any", false, true), "date_format"), "d F Y"))) : ("d F Y"))));
                // line 49
                echo "\t\t";
                $context["date_class"] = "date";
                // line 50
                echo "\t";
            }
            // line 51
            echo "\t";
            $context["time_tag"] = (((((("<time itemprop=dateCreated datetime=\"" . call_user_func_array($this->env->getFilter('date')->getCallable(), array($this->env, (isset($context["date"]) ? $context["date"] : null), "c"))) . "\" class=\"") . (isset($context["date_class"]) ? $context["date_class"] : null)) . "\">") . (isset($context["date_formatted"]) ? $context["date_formatted"] : null)) . "</time>");
            // line 52
            echo "
\t";
            // line 54
            echo "\t";
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["items"]) ? $context["items"] : null));
            foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
                // line 55
                echo "\t\t";
                if (((isset($context["item"]) ? $context["item"] : null) == "title")) {
                    // line 56
                    echo "\t\t\t<h2 class='title' itemprop='caption'>";
                    echo (isset($context["title_pseudo"]) ? $context["title_pseudo"] : null);
                    echo "</h2>
\t\t";
                } elseif ((((isset($context["item"]) ? $context["item"] : null) == "description") && (!call_user_func_array($this->env->getTest('empty')->getCallable(), array((isset($context["description"]) ? $context["description"] : null)))))) {
                    // line 58
                    echo "\t\t<p itemprop='description'>";
                    echo (isset($context["description_pseudo"]) ? $context["description_pseudo"] : null);
                    echo "</p>
\t\t";
                } elseif (((isset($context["item"]) ? $context["item"] : null) == "date")) {
                    // line 60
                    echo "\t\t\t<h6 class=date>";
                    echo (isset($context["time_tag"]) ? $context["time_tag"] : null);
                    echo "</h6>
\t\t";
                }
                // line 62
                echo "\t";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 63
            echo "
\t";
            // line 65
            echo "\t<video width=\"100%\" controls class=x3-style-frame>
\t\t<source src=\"";
            // line 66
            echo ((isset($context["assetspath"]) ? $context["assetspath"] : null) . call_user_func_array($this->env->getFilter('trim')->getCallable(), array((($this->getAttribute((isset($context["gallery"]) ? $context["gallery"] : null), "file_path") . "/") . $this->getAttribute((isset($context["image"]) ? $context["image"] : null), "file_name")), ".")));
            echo "\" type=\"video/mp4\">
\t</video>

\t";
            // line 69
            if (($this->getAttribute((isset($context["loop"]) ? $context["loop"] : null), "index") != call_user_func_array($this->env->getFilter('length')->getCallable(), array($this->env, $this->getAttribute((isset($context["gallery"]) ? $context["gallery"] : null), "video"))))) {
                // line 70
                echo "\t\t<hr class=hr />
\t";
            }
            ++$context['loop']['index0'];
            ++$context['loop']['index'];
            $context['loop']['first'] = false;
            if (isset($context['loop']['length'])) {
                --$context['loop']['revindex0'];
                --$context['loop']['revindex'];
                $context['loop']['last'] = 0 === $context['loop']['revindex0'];
            }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['image'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
    }

    public function getTemplateName()
    {
        return "partials/module.video.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  204 => 70,  202 => 69,  196 => 66,  193 => 65,  190 => 63,  184 => 62,  178 => 60,  172 => 58,  166 => 56,  163 => 55,  158 => 54,  155 => 52,  152 => 51,  149 => 50,  146 => 49,  143 => 48,  140 => 47,  137 => 46,  134 => 45,  131 => 44,  128 => 43,  125 => 41,  122 => 40,  119 => 39,  116 => 38,  113 => 37,  110 => 36,  107 => 35,  104 => 34,  101 => 33,  98 => 31,  95 => 30,  92 => 29,  89 => 27,  72 => 26,  69 => 24,  65 => 22,  62 => 21,  59 => 20,  56 => 18,  53 => 17,  50 => 16,  47 => 15,  44 => 14,  41 => 13,  38 => 12,  35 => 11,  32 => 9,  30 => 8,  27 => 6,  25 => 5,  22 => 3,  21 => 2,  19 => 1,);
    }
}
