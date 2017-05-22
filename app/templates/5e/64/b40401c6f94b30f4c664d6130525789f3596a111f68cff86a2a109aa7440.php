<?php

/* page.json */
class __TwigTemplate_5e64b40401c6f94b30f4c664d6130525789f3596a111f68cff86a2a109aa7440 extends Twig_Template
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
        // line 4
        $context["baseurl"] = call_user_func_array($this->env->getFilter('default')->getCallable(), array(call_user_func_array($this->env->getFilter('trim')->getCallable(), array(call_user_func_array($this->env->getFilter('replace')->getCallable(), array($this->getAttribute($this->getAttribute((isset($context["page"]) ? $context["page"] : null), "settings"), "base_url"), array("http://" => "", "https://" => ""))), "/")), $this->getAttribute((isset($context["page"]) ? $context["page"] : null), "base_url")));
        // line 5
        echo "
";
        // line 7
        $context["absolutepath"] = call_user_func_array($this->env->getFilter('addprotocol')->getCallable(), array((isset($context["baseurl"]) ? $context["baseurl"] : null)));
        // line 8
        $context["rootpath"] = call_user_func_array($this->env->getFilter('replace')->getCallable(), array((isset($context["baseurl"]) ? $context["baseurl"] : null), array($this->getAttribute((isset($context["page"]) ? $context["page"] : null), "domain_name") => "")));
        // line 9
        $context["assetspath"] = call_user_func_array($this->env->getFilter('default')->getCallable(), array(call_user_func_array($this->env->getFilter('trim')->getCallable(), array($this->getAttribute($this->getAttribute((isset($context["page"]) ? $context["page"] : null), "settings"), "cdn_files"), "/")), (isset($context["rootpath"]) ? $context["rootpath"] : null)));
        // line 10
        $context["absolutepath_page"] = call_user_func_array($this->env->getFilter('setpath')->getCallable(), array($this->getAttribute((isset($context["page"]) ? $context["page"] : null), "permalink"), (isset($context["absolutepath"]) ? $context["absolutepath"] : null)));
        // line 11
        $context["rootpath_page"] = call_user_func_array($this->env->getFilter('setpath')->getCallable(), array($this->getAttribute((isset($context["page"]) ? $context["page"] : null), "permalink"), (isset($context["rootpath"]) ? $context["rootpath"] : null)));
        // line 12
        echo "
";
        // line 14
        ob_start();
        $this->env->loadTemplate("partials/preview-image.html")->display($context);
        $context["preview_image"] = ('' === $tmp = ob_get_clean()) ? '' : new Twig_Markup($tmp, $this->env->getCharset());
        // line 15
        ob_start();
        echo ((isset($context["absolutepath"]) ? $context["absolutepath"] : null) . call_user_func_array($this->env->getFilter('replace')->getCallable(), array((isset($context["preview_image"]) ? $context["preview_image"] : null), array("./content" => "/content"))));
        $context["preview_image_full"] = ('' === $tmp = ob_get_clean()) ? '' : new Twig_Markup($tmp, $this->env->getCharset());
        // line 16
        echo "
";
        // line 18
        $context["page_title"] = "";
        // line 19
        $context["page_description"] = "";
        // line 20
        echo "
";
        // line 22
        if (($this->getAttribute((isset($context["page"]) ? $context["page"] : null), "template_name") == "file")) {
            // line 23
            echo "
\t";
            // line 25
            echo "\t";
            $context["dirname"] = call_user_func_array($this->env->getFilter('dirname')->getCallable(), array($this->getAttribute((isset($context["page"]) ? $context["page"] : null), "permalink")));
            // line 26
            echo "\t";
            if ((((isset($context["dirname"]) ? $context["dirname"] : null) == ".") || call_user_func_array($this->env->getTest('empty')->getCallable(), array((isset($context["dirname"]) ? $context["dirname"] : null))))) {
                $context["dirname"] = "/";
            }
            // line 27
            echo "\t";
            $context["parent"] = call_user_func_array($this->env->getFunction('get')->getCallable(), array((isset($context["dirname"]) ? $context["dirname"] : null)));
            // line 28
            echo "
\t";
            // line 30
            echo "\t";
            $context["this"] = $this->getAttribute((isset($context["page"]) ? $context["page"] : null), "file_path");
            // line 31
            echo "\t";
            $context["image_description"] = "";
            // line 32
            echo "\t";
            $context["file_index"] = 0;
            // line 33
            echo "\t";
            $context["myimage"] = "";
            // line 34
            echo "
\t";
            // line 36
            echo "\t";
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["parent"]) ? $context["parent"] : null), "images"));
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
                // line 37
                echo "\t\t";
                if (((isset($context["this"]) ? $context["this"] : null) == $this->getAttribute((isset($context["image"]) ? $context["image"] : null), "url"))) {
                    // line 38
                    echo "
\t\t\t";
                    // line 40
                    echo "\t    ";
                    $context["page_title"] = call_user_func_array($this->env->getFilter('default')->getCallable(), array(call_user_func_array($this->env->getFilter('replace')->getCallable(), array(call_user_func_array($this->env->getFilter('striptags')->getCallable(), array(call_user_func_array($this->env->getFunction('getDefault')->getCallable(), array($this->getAttribute((isset($context["image"]) ? $context["image"] : null), "title"), $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["parent"]) ? $context["parent"] : null), "gallery"), "image"), "title"), $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["parent"]) ? $context["parent"] : null), "gallery"), "image"), "title_include"), $this->getAttribute((isset($context["image"]) ? $context["image"] : null), "name"))), "<a><span><em><i><b><strong><small><s><mark>")), array("{file_name}" => call_user_func_array($this->env->getFilter('removeExtension')->getCallable(), array($this->getAttribute((isset($context["image"]) ? $context["image"] : null), "file_name"))), "{file_name_ext}" => $this->getAttribute((isset($context["image"]) ? $context["image"] : null), "file_name")))), $this->getAttribute((isset($context["image"]) ? $context["image"] : null), "name")));
                    // line 41
                    echo "\t\t\t";
                    $context["image_description"] = call_user_func_array($this->env->getFilter('replace')->getCallable(), array(call_user_func_array($this->env->getFilter('striptags')->getCallable(), array(call_user_func_array($this->env->getFunction('getDefault')->getCallable(), array($this->getAttribute((isset($context["image"]) ? $context["image"] : null), "description"), $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["parent"]) ? $context["parent"] : null), "gallery"), "image"), "description"), $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["parent"]) ? $context["parent"] : null), "gallery"), "image"), "description_include"), $this->getAttribute((isset($context["image"]) ? $context["image"] : null), "name"))), "<a><span><em><i><b><strong><small><s><br><mark><img><kbd><code><button>")), array("{file_name}" => call_user_func_array($this->env->getFilter('removeExtension')->getCallable(), array($this->getAttribute((isset($context["image"]) ? $context["image"] : null), "file_name"))), "{file_name_ext}" => $this->getAttribute((isset($context["image"]) ? $context["image"] : null), "file_name"))));
                    // line 42
                    echo "\t\t\t";
                    $context["page_description"] = ((array_key_exists("image_description", $context)) ? (call_user_func_array($this->env->getFilter('default')->getCallable(), array((isset($context["image_description"]) ? $context["image_description"] : null), (((isset($context["page_title"]) ? $context["page_title"] : null) . " | ") . $this->getAttribute((isset($context["parent"]) ? $context["parent"] : null), "title"))))) : ((((isset($context["page_title"]) ? $context["page_title"] : null) . " | ") . $this->getAttribute((isset($context["parent"]) ? $context["parent"] : null), "title"))));
                    // line 43
                    echo "\t\t\t";
                    $context["file_index"] = $this->getAttribute((isset($context["loop"]) ? $context["loop"] : null), "index0");
                    // line 44
                    echo "\t\t\t";
                    $context["myimage"] = (isset($context["image"]) ? $context["image"] : null);
                    // line 45
                    echo "
\t\t";
                }
                // line 47
                echo "\t";
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
            // line 48
            echo "
\t";
            // line 50
            echo "\t";
            $context["template"] = "partials/file.html";
            // line 51
            echo "
";
        } else {
            // line 54
            echo "\t";
            $context["page_title"] = $this->getAttribute((isset($context["page"]) ? $context["page"] : null), "title");
            // line 55
            echo "\t";
            $context["page_description"] = $this->getAttribute((isset($context["page"]) ? $context["page"] : null), "description");
            // line 56
            echo "\t";
            $context["template"] = "partials/content.html";
        }
        // line 58
        echo "
";
        echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
        // line 61
        ob_start();
        ob_start();
        $template = $this->env->resolveTemplate((isset($context["template"]) ? $context["template"] : null));
        $template->display($context);
        echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
        $context["content"] = ('' === $tmp = ob_get_clean()) ? '' : new Twig_Markup($tmp, $this->env->getCharset());
        // line 62
        echo call_user_func_array($this->env->getFunction('pageJson')->getCallable(), array((isset($context["page_title"]) ? $context["page_title"] : null), (isset($context["page_description"]) ? $context["page_description"] : null), (isset($context["content"]) ? $context["content"] : null), $this->getAttribute((isset($context["page"]) ? $context["page"] : null), "template_name"), $this->getAttribute((isset($context["page"]) ? $context["page"] : null), "id"), (isset($context["preview_image_full"]) ? $context["preview_image_full"] : null), $this->getAttribute((isset($context["page"]) ? $context["page"] : null), "permalink"), $this->getAttribute((isset($context["page"]) ? $context["page"] : null), "file_path")));
    }

    public function getTemplateName()
    {
        return "page.json";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  182 => 62,  175 => 61,  171 => 58,  167 => 56,  164 => 55,  161 => 54,  157 => 51,  154 => 50,  151 => 48,  137 => 47,  133 => 45,  130 => 44,  127 => 43,  124 => 42,  121 => 41,  118 => 40,  115 => 38,  112 => 37,  94 => 36,  91 => 34,  88 => 33,  85 => 32,  82 => 31,  79 => 30,  76 => 28,  73 => 27,  68 => 26,  65 => 25,  62 => 23,  60 => 22,  57 => 20,  55 => 19,  53 => 18,  50 => 16,  46 => 15,  42 => 14,  39 => 12,  37 => 11,  35 => 10,  33 => 9,  31 => 8,  29 => 7,  26 => 5,  24 => 4,  21 => 2,  19 => 1,);
    }
}
