<?php

/* page.html */
class __TwigTemplate_be251a80cefc6dcbcf550b1693727309775a38bda055a28c5622c1509545a68d extends Twig_Template
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
        echo "<!doctype html>
<!-- X3 website by imagevuex.com -->
";
        // line 3
        ob_start();
        // line 4
        echo "
";
        // line 6
        $context["baseurl"] = call_user_func_array($this->env->getFilter('default')->getCallable(), array(call_user_func_array($this->env->getFilter('trim')->getCallable(), array(call_user_func_array($this->env->getFilter('replace')->getCallable(), array($this->getAttribute($this->getAttribute((isset($context["page"]) ? $context["page"] : null), "settings"), "base_url"), array("http://" => "", "https://" => ""))), "/")), $this->getAttribute((isset($context["page"]) ? $context["page"] : null), "base_url")));
        // line 7
        echo "
";
        // line 9
        $context["absolutepath"] = call_user_func_array($this->env->getFilter('addprotocol')->getCallable(), array((isset($context["baseurl"]) ? $context["baseurl"] : null)));
        // line 10
        $context["rootpath"] = call_user_func_array($this->env->getFilter('replace')->getCallable(), array((isset($context["baseurl"]) ? $context["baseurl"] : null), array($this->getAttribute((isset($context["page"]) ? $context["page"] : null), "domain_name") => "")));
        // line 11
        $context["assetspath"] = call_user_func_array($this->env->getFilter('default')->getCallable(), array(call_user_func_array($this->env->getFilter('trim')->getCallable(), array($this->getAttribute($this->getAttribute((isset($context["page"]) ? $context["page"] : null), "settings"), "cdn_files"), "/")), (isset($context["rootpath"]) ? $context["rootpath"] : null)));
        // line 12
        $context["absolutepath_page"] = call_user_func_array($this->env->getFilter('setpath')->getCallable(), array($this->getAttribute((isset($context["page"]) ? $context["page"] : null), "permalink"), (isset($context["absolutepath"]) ? $context["absolutepath"] : null)));
        // line 13
        $context["rootpath_page"] = call_user_func_array($this->env->getFilter('setpath')->getCallable(), array($this->getAttribute((isset($context["page"]) ? $context["page"] : null), "permalink"), (isset($context["rootpath"]) ? $context["rootpath"] : null)));
        // line 14
        ob_start();
        $this->env->loadTemplate("partials/preview-image.html")->display($context);
        $context["preview_image"] = ('' === $tmp = ob_get_clean()) ? '' : new Twig_Markup($tmp, $this->env->getCharset());
        // line 15
        ob_start();
        echo (isset($context["absolutepath"]) ? $context["absolutepath"] : null);
        echo call_user_func_array($this->env->getFilter('replace')->getCallable(), array((isset($context["preview_image"]) ? $context["preview_image"] : null), array("./content" => "/content")));
        $context["preview_image_full"] = ('' === $tmp = ob_get_clean()) ? '' : new Twig_Markup($tmp, $this->env->getCharset());
        // line 16
        echo "
";
        // line 18
        if ($this->getAttribute($this->getAttribute((isset($context["page"]) ? $context["page"] : null), "settings"), "cdn_core")) {
            // line 19
            echo "\t";
            $context["cdn_core"] = "https://d30xwzl2pxzvti.cloudfront.net";
        } else {
            // line 21
            echo "\t";
            $context["cdn_core"] = ((isset($context["rootpath"]) ? $context["rootpath"] : null) . "/public");
        }
        // line 23
        echo "
";
        // line 25
        $context["page_title"] = "";
        // line 26
        $context["page_description"] = "";
        // line 27
        echo "
";
        // line 29
        if (($this->getAttribute((isset($context["page"]) ? $context["page"] : null), "template_name") == "file")) {
            // line 30
            echo "
\t";
            // line 32
            echo "\t";
            $context["dirname"] = call_user_func_array($this->env->getFilter('dirname')->getCallable(), array($this->getAttribute((isset($context["page"]) ? $context["page"] : null), "permalink")));
            // line 33
            echo "\t";
            if ((((isset($context["dirname"]) ? $context["dirname"] : null) == ".") || call_user_func_array($this->env->getTest('empty')->getCallable(), array((isset($context["dirname"]) ? $context["dirname"] : null))))) {
                $context["dirname"] = "/";
            }
            // line 34
            echo "\t";
            $context["parent"] = call_user_func_array($this->env->getFunction('get')->getCallable(), array((isset($context["dirname"]) ? $context["dirname"] : null)));
            // line 35
            echo "
\t";
            // line 37
            echo "\t";
            $context["this"] = $this->getAttribute((isset($context["page"]) ? $context["page"] : null), "file_path");
            // line 38
            echo "\t";
            $context["image_description"] = "";
            // line 39
            echo "\t";
            $context["file_index"] = 0;
            // line 40
            echo "\t";
            $context["myimage"] = "";
            // line 41
            echo "
\t";
            // line 43
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
                // line 44
                echo "
\t\t";
                // line 45
                if (((isset($context["this"]) ? $context["this"] : null) == $this->getAttribute((isset($context["image"]) ? $context["image"] : null), "url"))) {
                    // line 46
                    echo "
\t\t\t";
                    // line 48
                    echo "\t\t\t";
                    if ($this->getAttribute((isset($context["image"]) ? $context["image"] : null), "link")) {
                        // line 49
                        echo "\t\t\t\t";
                        echo call_user_func_array($this->env->getFunction('redirect')->getCallable(), array($this->getAttribute((isset($context["image"]) ? $context["image"] : null), "link")));
                        echo "

\t\t\t";
                        // line 52
                        echo "\t\t\t";
                    } else {
                        // line 53
                        echo "
\t\t\t\t";
                        // line 54
                        $context["folder_path"] = (((isset($context["assetspath"]) ? $context["assetspath"] : null) . call_user_func_array($this->env->getFilter('trim')->getCallable(), array($this->getAttribute((isset($context["parent"]) ? $context["parent"] : null), "file_path"), "."))) . "/");
                        // line 55
                        echo "\t      ";
                        $context["page_title"] = call_user_func_array($this->env->getFilter('default')->getCallable(), array(call_user_func_array($this->env->getFilter('replace')->getCallable(), array(call_user_func_array($this->env->getFilter('striptags')->getCallable(), array(call_user_func_array($this->env->getFunction('getDefault')->getCallable(), array($this->getAttribute((isset($context["image"]) ? $context["image"] : null), "title"), $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["parent"]) ? $context["parent"] : null), "gallery"), "image"), "title"), $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["parent"]) ? $context["parent"] : null), "gallery"), "image"), "title_include"), $this->getAttribute((isset($context["image"]) ? $context["image"] : null), "name"))), "<a><span><em><i><b><strong><small><s><mark>")), array("{file_name}" => call_user_func_array($this->env->getFilter('removeExtension')->getCallable(), array($this->getAttribute((isset($context["image"]) ? $context["image"] : null), "file_name"))), "{file_name_ext}" => $this->getAttribute((isset($context["image"]) ? $context["image"] : null), "file_name"), "{path}" => (isset($context["folder_path"]) ? $context["folder_path"] : null), "{image_path}" => ((isset($context["folder_path"]) ? $context["folder_path"] : null) . $this->getAttribute((isset($context["image"]) ? $context["image"] : null), "file_name"))))), $this->getAttribute((isset($context["image"]) ? $context["image"] : null), "name")));
                        // line 56
                        echo "\t\t\t\t";
                        $context["image_description"] = call_user_func_array($this->env->getFilter('replace')->getCallable(), array(call_user_func_array($this->env->getFilter('striptags')->getCallable(), array(call_user_func_array($this->env->getFunction('getDefault')->getCallable(), array($this->getAttribute((isset($context["image"]) ? $context["image"] : null), "description"), $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["parent"]) ? $context["parent"] : null), "gallery"), "image"), "description"), $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["parent"]) ? $context["parent"] : null), "gallery"), "image"), "description_include"), $this->getAttribute((isset($context["image"]) ? $context["image"] : null), "name"))), "<a><span><em><i><b><strong><small><s><br><mark><img><kbd><code><button>")), array("{file_name}" => call_user_func_array($this->env->getFilter('removeExtension')->getCallable(), array($this->getAttribute((isset($context["image"]) ? $context["image"] : null), "file_name"))), "{file_name_ext}" => $this->getAttribute((isset($context["image"]) ? $context["image"] : null), "file_name"), "{path}" => (isset($context["folder_path"]) ? $context["folder_path"] : null), "{image_path}" => ((isset($context["folder_path"]) ? $context["folder_path"] : null) . $this->getAttribute((isset($context["image"]) ? $context["image"] : null), "file_name")))));
                        // line 57
                        echo "\t\t\t\t";
                        $context["page_description"] = ((array_key_exists("image_description", $context)) ? (call_user_func_array($this->env->getFilter('default')->getCallable(), array((isset($context["image_description"]) ? $context["image_description"] : null), (((isset($context["page_title"]) ? $context["page_title"] : null) . " | ") . $this->getAttribute((isset($context["parent"]) ? $context["parent"] : null), "title"))))) : ((((isset($context["page_title"]) ? $context["page_title"] : null) . " | ") . $this->getAttribute((isset($context["parent"]) ? $context["parent"] : null), "title"))));
                        // line 58
                        echo "\t\t\t\t";
                        $context["file_index"] = $this->getAttribute((isset($context["loop"]) ? $context["loop"] : null), "index0");
                        // line 59
                        echo "\t\t\t\t";
                        $context["myimage"] = (isset($context["image"]) ? $context["image"] : null);
                        // line 60
                        echo "\t\t\t";
                    }
                    // line 61
                    echo "
\t\t";
                }
                // line 63
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
            // line 64
            echo "
\t";
            // line 66
            echo "\t";
            $context["template"] = "partials/file.html";
        } else {
            // line 69
            echo "\t";
            $context["page_title"] = $this->getAttribute((isset($context["page"]) ? $context["page"] : null), "title");
            // line 70
            echo "\t";
            $context["page_description"] = $this->getAttribute((isset($context["page"]) ? $context["page"] : null), "description");
            // line 71
            echo "\t";
            $context["template"] = "partials/content.html";
        }
        // line 73
        echo "
";
        // line 75
        $this->env->loadTemplate("partials/head.html")->display($context);
        // line 76
        $template = $this->env->resolveTemplate((isset($context["template"]) ? $context["template"] : null));
        $template->display($context);
        // line 77
        $this->env->loadTemplate("partials/footer.html")->display($context);
        echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
        // line 79
        echo "
<!-- X3 website by imagevuex.com -->";
    }

    public function getTemplateName()
    {
        return "page.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  216 => 79,  213 => 77,  210 => 76,  208 => 75,  205 => 73,  201 => 71,  198 => 70,  195 => 69,  191 => 66,  188 => 64,  174 => 63,  170 => 61,  167 => 60,  164 => 59,  161 => 58,  158 => 57,  155 => 56,  152 => 55,  150 => 54,  147 => 53,  144 => 52,  138 => 49,  135 => 48,  132 => 46,  130 => 45,  127 => 44,  109 => 43,  106 => 41,  103 => 40,  100 => 39,  97 => 38,  94 => 37,  91 => 35,  88 => 34,  83 => 33,  80 => 32,  77 => 30,  75 => 29,  72 => 27,  70 => 26,  68 => 25,  65 => 23,  61 => 21,  57 => 19,  55 => 18,  52 => 16,  47 => 15,  43 => 14,  41 => 13,  39 => 12,  37 => 11,  35 => 10,  33 => 9,  30 => 7,  28 => 6,  25 => 4,  23 => 3,  19 => 1,);
    }
}
