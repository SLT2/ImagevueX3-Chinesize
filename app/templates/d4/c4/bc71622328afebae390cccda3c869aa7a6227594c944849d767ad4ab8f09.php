<?php

/* partials/file.html */
class __TwigTemplate_d4c4bc71622328afebae390cccda3c869aa7a6227594c944849d767ad4ab8f09 extends Twig_Template
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
        $context["image_page"] = call_user_func_array($this->env->getFilter('setpath')->getCallable(), array($this->getAttribute((isset($context["page"]) ? $context["page"] : null), "permalink"), (isset($context["rootpath"]) ? $context["rootpath"] : null)));
        // line 4
        $context["preview_image_url"] = ((isset($context["assetspath"]) ? $context["assetspath"] : null) . call_user_func_array($this->env->getFilter('trim')->getCallable(), array((isset($context["preview_image"]) ? $context["preview_image"] : null), ".")));
        // line 5
        $context["image_ratio"] = (($this->getAttribute((isset($context["myimage"]) ? $context["myimage"] : null), "height") / $this->getAttribute((isset($context["myimage"]) ? $context["myimage"] : null), "width")) * 100);
        // line 6
        $context["date"] = $this->getAttribute($this->getAttribute((isset($context["myimage"]) ? $context["myimage"] : null), "exif"), "date_taken", array(), "array");
        // line 8
        echo "
";
        // line 10
        if ((call_user_func_array($this->env->getFilter('length')->getCallable(), array($this->env, $this->getAttribute((isset($context["parent"]) ? $context["parent"] : null), "images"))) > 1)) {
            // line 11
            echo "<div class=article-nav>
\t";
            // line 12
            $context["next"] = $this->getAttribute(call_user_func_array($this->env->getFilter('keys')->getCallable(), array($this->getAttribute((isset($context["parent"]) ? $context["parent"] : null), "images"))), ((isset($context["file_index"]) ? $context["file_index"] : null) + 1), array(), "array");
            // line 13
            echo "\t";
            if ((!call_user_func_array($this->env->getTest('empty')->getCallable(), array((isset($context["next"]) ? $context["next"] : null))))) {
                // line 14
                echo "\t";
                $context["url"] = call_user_func_array($this->env->getFilter('split')->getCallable(), array((isset($context["next"]) ? $context["next"] : null), "."));
                // line 15
                echo "\t<a href='";
                echo (("../" . call_user_func_array($this->env->getFilter('replace')->getCallable(), array(call_user_func_array($this->env->getFilter('join')->getCallable(), array(call_user_func_array($this->env->getFilter('slice')->getCallable(), array($this->env, (isset($context["url"]) ? $context["url"] : null), 0, (call_user_func_array($this->env->getFilter('length')->getCallable(), array($this->env, (isset($context["url"]) ? $context["url"] : null))) - 1))), ".")), array(" " => "_")))) . "/");
                echo "' class='next'><span>";
                echo (($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["parent"]) ? $context["parent"] : null), "images", array(), "any", false, true), (isset($context["next"]) ? $context["next"] : null), array(), "array", false, true), "title", array(), "any", true, true)) ? (call_user_func_array($this->env->getFilter('default')->getCallable(), array($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["parent"]) ? $context["parent"] : null), "images", array(), "any", false, true), (isset($context["next"]) ? $context["next"] : null), array(), "array", false, true), "title"), $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["parent"]) ? $context["parent"] : null), "images"), (isset($context["next"]) ? $context["next"] : null), array(), "array"), "name")))) : ($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["parent"]) ? $context["parent"] : null), "images"), (isset($context["next"]) ? $context["next"] : null), array(), "array"), "name")));
                echo "</span></a>
\t";
            }
            // line 17
            echo "\t";
            $context["prev"] = $this->getAttribute(call_user_func_array($this->env->getFilter('keys')->getCallable(), array($this->getAttribute((isset($context["parent"]) ? $context["parent"] : null), "images"))), ((isset($context["file_index"]) ? $context["file_index"] : null) - 1), array(), "array");
            // line 18
            echo "\t";
            if ((!call_user_func_array($this->env->getTest('empty')->getCallable(), array((isset($context["prev"]) ? $context["prev"] : null))))) {
                // line 19
                echo "\t";
                $context["url"] = call_user_func_array($this->env->getFilter('split')->getCallable(), array((isset($context["prev"]) ? $context["prev"] : null), "."));
                // line 20
                echo "\t<a href='";
                echo (("../" . call_user_func_array($this->env->getFilter('replace')->getCallable(), array(call_user_func_array($this->env->getFilter('join')->getCallable(), array(call_user_func_array($this->env->getFilter('slice')->getCallable(), array($this->env, (isset($context["url"]) ? $context["url"] : null), 0, (call_user_func_array($this->env->getFilter('length')->getCallable(), array($this->env, (isset($context["url"]) ? $context["url"] : null))) - 1))), ".")), array(" " => "_")))) . "/");
                echo "' class='previous'><span>";
                echo (($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["parent"]) ? $context["parent"] : null), "images", array(), "any", false, true), (isset($context["prev"]) ? $context["prev"] : null), array(), "array", false, true), "title", array(), "any", true, true)) ? (call_user_func_array($this->env->getFilter('default')->getCallable(), array($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["parent"]) ? $context["parent"] : null), "images", array(), "any", false, true), (isset($context["prev"]) ? $context["prev"] : null), array(), "array", false, true), "title"), $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["parent"]) ? $context["parent"] : null), "images"), (isset($context["prev"]) ? $context["prev"] : null), array(), "array"), "name")))) : ($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["parent"]) ? $context["parent"] : null), "images"), (isset($context["prev"]) ? $context["prev"] : null), array(), "array"), "name")));
                echo "</span></a>
\t";
            }
            // line 22
            echo "</div>
";
        }
        // line 24
        echo "
";
        // line 26
        $context["fotomoto"] = "";
        // line 27
        $context["fotomoto_collection"] = "";
        // line 28
        if ((($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["parent"]) ? $context["parent"] : null), "plugins"), "fotomoto"), "enabled") && $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["parent"]) ? $context["parent"] : null), "plugins"), "fotomoto"), "store_id")) && $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["parent"]) ? $context["parent"] : null), "plugins"), "fotomoto"), "enabled_page"))) {
            // line 29
            echo "\t";
            if ($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["parent"]) ? $context["parent"] : null), "plugins"), "fotomoto"), "buy_button")) {
                // line 30
                echo "\t\t";
                $context["fotomoto"] = " file-fotomoto file-fotomoto-buybutton";
                // line 31
                echo "\t";
            } else {
                // line 32
                echo "\t\t";
                $context["fotomoto"] = " file-fotomoto";
                // line 33
                echo "\t";
            }
            // line 34
            echo "\t";
            if (call_user_func_array($this->env->getFilter('trim')->getCallable(), array($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["parent"]) ? $context["parent"] : null), "plugins"), "fotomoto"), "collection")))) {
                // line 35
                echo "\t\t";
                $context["fotomoto_collection"] = ((" data-fotomoto-collection=\"" . call_user_func_array($this->env->getFilter('trim')->getCallable(), array($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["parent"]) ? $context["parent"] : null), "plugins"), "fotomoto"), "collection")))) . "\"");
                // line 36
                echo "\t";
            }
        }
        // line 38
        echo "
";
        // line 40
        echo "<div class='module row file gallery";
        echo (isset($context["fotomoto"]) ? $context["fotomoto"] : null);
        echo "'";
        echo (isset($context["fotomoto_collection"]) ? $context["fotomoto_collection"] : null);
        echo ">
  <div data-options='caption:' class='images clearfix context small-12 medium-10 large-8 small-centered columns narrower text-center frame";
        // line 41
        if (($this->getAttribute($this->getAttribute((isset($context["page"]) ? $context["page"] : null), "popup"), "enabled") == true)) {
            echo " x3-hover-icon-primary";
        }
        echo "'>

  ";
        // line 44
        echo "
  <h1 class='title'>";
        // line 45
        echo (isset($context["page_title"]) ? $context["page_title"] : null);
        echo "</h1>
  ";
        // line 46
        if ((!call_user_func_array($this->env->getTest('empty')->getCallable(), array((isset($context["image_description"]) ? $context["image_description"] : null))))) {
            echo "<h2 class='subheader'>";
            echo (isset($context["image_description"]) ? $context["image_description"] : null);
            echo "</h2>";
        }
        // line 47
        echo "  ";
        if ((!call_user_func_array($this->env->getTest('empty')->getCallable(), array((isset($context["date"]) ? $context["date"] : null))))) {
            echo "<h6 class=date><time itemprop=\"dateCreated\" datetime='";
            echo call_user_func_array($this->env->getFilter('date')->getCallable(), array($this->env, (isset($context["date"]) ? $context["date"] : null), "c"));
            echo "'>";
            echo call_user_func_array($this->env->getFilter('date')->getCallable(), array($this->env, (isset($context["date"]) ? $context["date"] : null), "d F Y"));
            echo "</time></h6>";
        }
        // line 48
        echo "
  ";
        // line 50
        echo "\t<a href=";
        echo call_user_func_array($this->env->getFilter('setpath')->getCallable(), array($this->getAttribute((isset($context["parent"]) ? $context["parent"] : null), "permalink"), (isset($context["rootpath"]) ? $context["rootpath"] : null)));
        echo " class='back'></a>

\t";
        // line 53
        echo "\t";
        $context["exif"] = "";
        // line 54
        echo "\t";
        if (($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["parent"]) ? $context["parent"] : null), "popup"), "caption"), "exif") && $this->getAttribute((isset($context["myimage"]) ? $context["myimage"] : null), "exif"))) {
            // line 55
            echo "\t\t";
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["myimage"]) ? $context["myimage"] : null), "exif"));
            foreach ($context['_seq'] as $context["key"] => $context["val"]) {
                if ((!call_user_func_array($this->env->getTest('empty')->getCallable(), array((isset($context["val"]) ? $context["val"] : null))))) {
                    // line 56
                    echo "\t    ";
                    $context["exif"] = (((((isset($context["exif"]) ? $context["exif"] : null) . (isset($context["key"]) ? $context["key"] : null)) . ":") . (isset($context["val"]) ? $context["val"] : null)) . ";");
                    // line 57
                    echo "\t\t";
                }
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['key'], $context['val'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 58
            echo "\t\t";
            if ((isset($context["exif"]) ? $context["exif"] : null)) {
                // line 59
                echo "\t\t\t";
                $context["exif"] = (("data-exif=\"" . (isset($context["exif"]) ? $context["exif"] : null)) . "\"");
                // line 60
                echo "\t\t";
            }
            // line 61
            echo "\t";
        }
        // line 62
        echo "
\t";
        // line 64
        echo "\t<div class=gallery>
\t\t<a class='item img-link item-link";
        // line 65
        if (($this->getAttribute($this->getAttribute((isset($context["page"]) ? $context["page"] : null), "popup"), "enabled") == true)) {
            echo " x3-popup";
        }
        echo "' ";
        echo (isset($context["exif"]) ? $context["exif"] : null);
        echo " id='";
        echo $this->getAttribute((isset($context["page"]) ? $context["page"] : null), "slug");
        echo "' data-options='w:";
        echo $this->getAttribute((isset($context["myimage"]) ? $context["myimage"] : null), "width");
        echo ";h:";
        echo $this->getAttribute((isset($context["myimage"]) ? $context["myimage"] : null), "height");
        echo "' href='";
        echo (isset($context["image_page"]) ? $context["image_page"] : null);
        echo "' data-image='";
        echo (isset($context["preview_image_url"]) ? $context["preview_image_url"] : null);
        echo "' data-title='";
        echo call_user_func_array($this->env->getFilter('e')->getCallable(), array($this->env, (isset($context["page_title"]) ? $context["page_title"] : null), "html"));
        echo "' data-description='";
        echo call_user_func_array($this->env->getFilter('e')->getCallable(), array($this->env, (isset($context["image_description"]) ? $context["image_description"] : null), "html"));
        echo "' data-date='";
        echo call_user_func_array($this->env->getFilter('date')->getCallable(), array($this->env, (isset($context["date"]) ? $context["date"] : null), "d F Y"));
        echo "'>

\t\t\t<figure>
\t\t\t\t<div class='image-container' style='padding-bottom:";
        // line 68
        echo (isset($context["image_ratio"]) ? $context["image_ratio"] : null);
        echo "%;'>
\t\t\t\t\t<img data-src='";
        // line 69
        echo (isset($context["preview_image_url"]) ? $context["preview_image_url"] : null);
        echo "' alt='";
        echo call_user_func_array($this->env->getFilter('e')->getCallable(), array($this->env, call_user_func_array($this->env->getFilter('striptags')->getCallable(), array((isset($context["page_title"]) ? $context["page_title"] : null))), "html"));
        echo "'>
\t\t\t\t</div>
\t\t\t</figure>
\t\t</a>
\t</div>

\t";
        // line 76
        echo "\t";
        if ((!call_user_func_array($this->env->getTest('empty')->getCallable(), array($this->getAttribute((isset($context["myimage"]) ? $context["myimage"] : null), "exif"))))) {
            // line 77
            echo "\t<div class=meta>
\t\t";
            // line 78
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["myimage"]) ? $context["myimage"] : null), "exif"));
            foreach ($context['_seq'] as $context["key"] => $context["val"]) {
                if ((!call_user_func_array($this->env->getTest('empty')->getCallable(), array((isset($context["val"]) ? $context["val"] : null))))) {
                    // line 79
                    echo "\t\t\t<div class='row ";
                    echo (isset($context["key"]) ? $context["key"] : null);
                    echo "'>
\t    \t<div class='small-6 columns meta-key'><span>";
                    // line 80
                    echo call_user_func_array($this->env->getFilter('replace')->getCallable(), array(call_user_func_array($this->env->getFilter('title')->getCallable(), array($this->env, (isset($context["key"]) ? $context["key"] : null))), array("_" => " ")));
                    echo "</span></div>
\t    \t<div class='small-6 columns meta-value styled'>";
                    // line 81
                    echo (isset($context["val"]) ? $context["val"] : null);
                    echo "</div>
\t    </div>
\t\t";
                }
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['key'], $context['val'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 84
            echo "\t</div>
\t";
        }
        // line 86
        echo "
\t";
        // line 88
        echo "\t";
        if ((!call_user_func_array($this->env->getTest('empty')->getCallable(), array($this->getAttribute($this->getAttribute((isset($context["page"]) ? $context["page"] : null), "accounts"), "disqus_shortname"))))) {
            // line 89
            echo "\t<hr>
\t<div id=comments>
\t\t<div>
\t\t\t<h2>Comments</h2>
\t\t\t<div id='disqus_thread'></div>
\t\t</div>
\t</div>
\t";
        }
        // line 97
        echo "
\t</div>
</div>
";
    }

    public function getTemplateName()
    {
        return "partials/file.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  288 => 97,  278 => 89,  275 => 88,  272 => 86,  268 => 84,  258 => 81,  254 => 80,  249 => 79,  244 => 78,  241 => 77,  238 => 76,  227 => 69,  223 => 68,  197 => 65,  194 => 64,  191 => 62,  188 => 61,  185 => 60,  182 => 59,  179 => 58,  172 => 57,  169 => 56,  163 => 55,  160 => 54,  157 => 53,  151 => 50,  148 => 48,  139 => 47,  133 => 46,  129 => 45,  126 => 44,  119 => 41,  112 => 40,  109 => 38,  105 => 36,  102 => 35,  99 => 34,  96 => 33,  93 => 32,  90 => 31,  87 => 30,  84 => 29,  82 => 28,  80 => 27,  78 => 26,  75 => 24,  71 => 22,  63 => 20,  60 => 19,  57 => 18,  54 => 17,  46 => 15,  43 => 14,  40 => 13,  38 => 12,  35 => 11,  33 => 10,  30 => 8,  28 => 6,  26 => 5,  24 => 4,  22 => 3,  19 => 1,);
    }
}
