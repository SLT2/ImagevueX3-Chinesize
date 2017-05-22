<?php

/* partials/module.context.html */
class __TwigTemplate_e90f1a1f3267e26365c5775dd3979ae00afdf7f100f7aecb897853d94e6459c6 extends Twig_Template
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
        $context["p"] = (isset($context["page"]) ? $context["page"] : null);
        // line 6
        $context["context"] = $this->getAttribute((isset($context["p"]) ? $context["p"] : null), "context");
        // line 7
        $context["page_description"] = $this->getAttribute((isset($context["p"]) ? $context["p"] : null), "description");
        // line 8
        $context["content"] = call_user_func_array($this->env->getFilter('escapecode')->getCallable(), array(call_user_func_array($this->env->getFilter('shortcode')->getCallable(), array(call_user_func_array($this->env->getFilter('trim')->getCallable(), array(((((call_user_func_array($this->env->getFilter('trim')->getCallable(), array($this->getAttribute($this->getAttribute((isset($context["p"]) ? $context["p"] : null), "include"), "content_prepend"))) . " ") . $this->getAttribute((isset($context["p"]) ? $context["p"] : null), "content")) . " ") . call_user_func_array($this->env->getFilter('trim')->getCallable(), array($this->getAttribute($this->getAttribute((isset($context["p"]) ? $context["p"] : null), "include"), "content_append"))))))))));
        // line 9
        echo "
";
        // line 11
        $context["date"] = (($this->getAttribute((isset($context["p"]) ? $context["p"] : null), "date", array(), "any", true, true)) ? (call_user_func_array($this->env->getFilter('default')->getCallable(), array($this->getAttribute((isset($context["p"]) ? $context["p"] : null), "date"), $this->getAttribute((isset($context["p"]) ? $context["p"] : null), "updated")))) : ($this->getAttribute((isset($context["p"]) ? $context["p"] : null), "updated")));
        // line 12
        if (($this->getAttribute($this->getAttribute((isset($context["page"]) ? $context["page"] : null), "settings"), "date_format") == "timeago")) {
            // line 13
            echo "\t";
            $context["date_formatted"] = call_user_func_array($this->env->getFilter('date')->getCallable(), array($this->env, (isset($context["date"]) ? $context["date"] : null), "d F Y"));
            // line 14
            echo "\t";
            $context["date_class"] = "date timeago";
        } else {
            // line 16
            echo "\t";
            $context["date_formatted"] = call_user_func_array($this->env->getFilter('date')->getCallable(), array($this->env, (isset($context["date"]) ? $context["date"] : null), (($this->getAttribute($this->getAttribute((isset($context["page"]) ? $context["page"] : null), "settings", array(), "any", false, true), "date_format", array(), "any", true, true)) ? (call_user_func_array($this->env->getFilter('default')->getCallable(), array($this->getAttribute($this->getAttribute((isset($context["page"]) ? $context["page"] : null), "settings", array(), "any", false, true), "date_format"), "d F Y"))) : ("d F Y"))));
            // line 17
            echo "\t";
            $context["date_class"] = "date";
        }
        // line 19
        $context["time_tag"] = (((((("<time itemprop=dateCreated datetime=\"" . call_user_func_array($this->env->getFilter('date')->getCallable(), array($this->env, (isset($context["date"]) ? $context["date"] : null), "c"))) . "\" class=\"") . (isset($context["date_class"]) ? $context["date_class"] : null)) . "\">") . (isset($context["date_formatted"]) ? $context["date_formatted"] : null)) . "</time>");
        // line 20
        echo "
";
        // line 23
        $context["items"] = call_user_func_array($this->env->getFilter('split')->getCallable(), array($this->getAttribute((isset($context["context"]) ? $context["context"] : null), "items"), ","));
        // line 24
        echo "
";
        // line 26
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["items"]) ? $context["items"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
            // line 27
            echo "
\t";
            // line 29
            echo "\t";
            if (((isset($context["item"]) ? $context["item"] : null) == "title")) {
                // line 30
                echo "\t<h1 class='title style-icon'><span>";
                echo (isset($context["page_title"]) ? $context["page_title"] : null);
                echo "</span></h1>
\t";
            }
            // line 32
            echo "
\t";
            // line 34
            echo "\t";
            if (((isset($context["item"]) ? $context["item"] : null) == "label")) {
                // line 35
                echo "\t<h1 class='title'><span>";
                echo $this->getAttribute((isset($context["page"]) ? $context["page"] : null), "label");
                echo "</span></h1>
\t";
            }
            // line 37
            echo "
\t";
            // line 39
            echo "\t";
            if (((isset($context["item"]) ? $context["item"] : null) == "amount")) {
                // line 40
                echo "\t";
                $context["amount"] = call_user_func_array($this->env->getFilter('length')->getCallable(), array($this->env, $this->getAttribute((isset($context["gallery"]) ? $context["gallery"] : null), "images")));
                // line 41
                echo "\t<h6 class=amount><span>";
                echo (isset($context["amount"]) ? $context["amount"] : null);
                echo " ";
                echo call_user_func_array($this->env->getFunction('pluralize')->getCallable(), array((isset($context["amount"]) ? $context["amount"] : null), "image", "images"));
                echo "</span></h6>
\t";
            }
            // line 43
            echo "
\t";
            // line 45
            echo "\t";
            if (((isset($context["item"]) ? $context["item"] : null) == "folders_amount")) {
                // line 46
                echo "\t";
                $context["folders_amount"] = $this->getAttribute((isset($context["folder"]) ? $context["folder"] : null), "children_count");
                // line 47
                echo "\t<h6 class=folder_amount><span>";
                echo (isset($context["folders_amount"]) ? $context["folders_amount"] : null);
                echo " ";
                echo call_user_func_array($this->env->getFunction('pluralize')->getCallable(), array((isset($context["folders_amount"]) ? $context["folders_amount"] : null), "album", "albums"));
                echo "</span></h6>
\t";
            }
            // line 49
            echo "
\t";
            // line 51
            echo "\t";
            if (((isset($context["item"]) ? $context["item"] : null) == "date")) {
                // line 52
                echo "\t<h6 class=date>";
                echo (isset($context["time_tag"]) ? $context["time_tag"] : null);
                echo "</h6>
\t";
            }
            // line 54
            echo "
\t";
            // line 56
            echo "\t";
            if ((((isset($context["item"]) ? $context["item"] : null) == "description") && (!call_user_func_array($this->env->getTest('empty')->getCallable(), array((isset($context["page_description"]) ? $context["page_description"] : null)))))) {
                // line 57
                echo "\t<h2 class=subheader>";
                echo (isset($context["page_description"]) ? $context["page_description"] : null);
                echo "</h2>
\t";
            }
            // line 59
            echo "
\t";
            // line 61
            echo "\t";
            if (((isset($context["item"]) ? $context["item"] : null) == "preview")) {
                // line 62
                echo "\t";
                $context["imgInfo"] = call_user_func_array($this->env->getFunction('getimginfo')->getCallable(), array((isset($context["preview_image"]) ? $context["preview_image"] : null)));
                // line 63
                echo "\t";
                $context["preview_image_url"] = ((isset($context["assetspath"]) ? $context["assetspath"] : null) . call_user_func_array($this->env->getFilter('trim')->getCallable(), array((isset($context["preview_image"]) ? $context["preview_image"] : null), ".")));
                // line 64
                echo "
\t";
                // line 66
                echo "\t";
                if ($this->getAttribute($this->getAttribute((isset($context["context"]) ? $context["context"] : null), "crop"), "enabled")) {
                    // line 67
                    echo "\t\t";
                    $context["crop_ratio"] = (($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["context"]) ? $context["context"] : null), "crop"), "crop"), 1, array(), "array") / $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["context"]) ? $context["context"] : null), "crop"), "crop"), 0, array(), "array")) * 100);
                    // line 68
                    echo "\t";
                }
                // line 69
                echo "\t";
                $context["image_ratio"] = ((array_key_exists("crop_ratio", $context)) ? (call_user_func_array($this->env->getFilter('default')->getCallable(), array((isset($context["crop_ratio"]) ? $context["crop_ratio"] : null), (($this->getAttribute((isset($context["imgInfo"]) ? $context["imgInfo"] : null), 1, array(), "array") / $this->getAttribute((isset($context["imgInfo"]) ? $context["imgInfo"] : null), 0, array(), "array")) * 100)))) : ((($this->getAttribute((isset($context["imgInfo"]) ? $context["imgInfo"] : null), 1, array(), "array") / $this->getAttribute((isset($context["imgInfo"]) ? $context["imgInfo"] : null), 0, array(), "array")) * 100)));
                // line 70
                echo "
\t";
                // line 72
                echo "\t<div class='preview-image x-frame-medium-up images'>
\t\t<a class='img-link item-link item popup' data-options='w:";
                // line 73
                echo $this->getAttribute((isset($context["imgInfo"]) ? $context["imgInfo"] : null), 0, array(), "array");
                echo ";h:";
                echo $this->getAttribute((isset($context["imgInfo"]) ? $context["imgInfo"] : null), 1, array(), "array");
                echo "' href='.' data-popup-href='";
                echo (isset($context["preview_image_url"]) ? $context["preview_image_url"] : null);
                echo "' data-image='";
                echo (isset($context["preview_image_url"]) ? $context["preview_image_url"] : null);
                echo "'";
                if ((isset($context["crop_ratio"]) ? $context["crop_ratio"] : null)) {
                    echo " data-crop=true";
                }
                echo ">
\t\t\t<figure>
\t\t\t\t<div class='image-container' style='padding-bottom:";
                // line 75
                echo (isset($context["image_ratio"]) ? $context["image_ratio"] : null);
                echo "%;'>
\t\t\t\t\t<img data-src='";
                // line 76
                echo (isset($context["preview_image_url"]) ? $context["preview_image_url"] : null);
                echo "' alt=''>
\t\t\t\t</div>

\t\t\t";
                // line 80
                echo "\t\t\t";
                if ($this->getAttribute($this->getAttribute((isset($context["context"]) ? $context["context"] : null), "caption"), "enabled")) {
                    // line 81
                    echo "        <figcaption>

        \t";
                    // line 84
                    echo "\t\t\t\t\t";
                    $context["caption_items"] = call_user_func_array($this->env->getFilter('split')->getCallable(), array($this->getAttribute($this->getAttribute((isset($context["context"]) ? $context["context"] : null), "caption"), "items"), ","));
                    // line 85
                    echo "
        \t";
                    // line 87
                    echo "        \t";
                    $context['_parent'] = (array) $context;
                    $context['_seq'] = twig_ensure_traversable((isset($context["caption_items"]) ? $context["caption_items"] : null));
                    foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
                        // line 88
                        echo "
        \t\t";
                        // line 90
                        echo "        \t\t";
                        if (((isset($context["item"]) ? $context["item"] : null) == "title")) {
                            // line 91
                            echo "        \t\t<span class='title'>";
                            echo call_user_func_array($this->env->getFilter('replace')->getCallable(), array((isset($context["page_title"]) ? $context["page_title"] : null), array("<a" => "<span", "</a>" => "</span>", " href=" => " data-href=", " target=" => " data-target=")));
                            echo "</span>
        \t\t";
                        }
                        // line 93
                        echo "
        \t\t";
                        // line 95
                        echo "        \t\t";
                        if (((isset($context["item"]) ? $context["item"] : null) == "label")) {
                            // line 96
                            echo "        \t\t<span class='title'>";
                            echo $this->getAttribute((isset($context["page"]) ? $context["page"] : null), "label");
                            echo "</span>
        \t\t";
                        }
                        // line 98
                        echo "
        \t\t";
                        // line 100
                        echo "        \t\t";
                        if (((isset($context["item"]) ? $context["item"] : null) == "amount")) {
                            // line 101
                            echo "\t\t\t\t\t\t";
                            $context["amount"] = call_user_func_array($this->env->getFilter('length')->getCallable(), array($this->env, $this->getAttribute((isset($context["gallery"]) ? $context["gallery"] : null), "images")));
                            // line 102
                            echo "        \t\t<span class='amount'>";
                            echo (isset($context["amount"]) ? $context["amount"] : null);
                            echo " ";
                            echo call_user_func_array($this->env->getFunction('pluralize')->getCallable(), array((isset($context["amount"]) ? $context["amount"] : null), "image", "images"));
                            echo "</span>
        \t\t";
                        }
                        // line 104
                        echo "
        \t\t";
                        // line 106
                        echo "        \t\t";
                        if (((isset($context["item"]) ? $context["item"] : null) == "folders_amount")) {
                            // line 107
                            echo "        \t\t";
                            $context["folders_amount"] = $this->getAttribute((isset($context["folder"]) ? $context["folder"] : null), "children_count");
                            // line 108
                            echo "        \t\t<span class='folder_amount'>";
                            echo (isset($context["folders_amount"]) ? $context["folders_amount"] : null);
                            echo " ";
                            echo call_user_func_array($this->env->getFunction('pluralize')->getCallable(), array((isset($context["folders_amount"]) ? $context["folders_amount"] : null), "album", "albums"));
                            echo "</span>
        \t\t";
                        }
                        // line 110
                        echo "
        \t\t";
                        // line 112
                        echo "        \t\t";
                        if (((isset($context["item"]) ? $context["item"] : null) == "date")) {
                            // line 113
                            echo "\t\t\t\t\t\t\t";
                            echo (isset($context["time_tag"]) ? $context["time_tag"] : null);
                            echo "
        \t\t";
                        }
                        // line 115
                        echo "
        \t\t";
                        // line 117
                        echo "        \t\t";
                        if ((((isset($context["item"]) ? $context["item"] : null) == "description") && (!call_user_func_array($this->env->getTest('empty')->getCallable(), array((isset($context["page_description"]) ? $context["page_description"] : null)))))) {
                            // line 118
                            echo "        \t\t\t<span class='description'>";
                            echo call_user_func_array($this->env->getFilter('replace')->getCallable(), array((isset($context["page_description"]) ? $context["page_description"] : null), array("<a" => "<span", "</a>" => "</span>", " href=" => " data-href=", " target=" => " data-target=")));
                            echo "</span>
        \t\t";
                        }
                        // line 120
                        echo "
        \t\t";
                        // line 122
                        echo "        \t\t";
                        if ((((isset($context["item"]) ? $context["item"] : null) == "content") && (!call_user_func_array($this->env->getTest('empty')->getCallable(), array((isset($context["content"]) ? $context["content"] : null)))))) {
                            // line 123
                            echo "        \t\t\t<span class='content'>";
                            echo (isset($context["content"]) ? $context["content"] : null);
                            echo "</span>
        \t\t";
                        }
                        // line 125
                        echo "
        \t";
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                    // line 127
                    echo "        </figcaption>
      ";
                }
                // line 129
                echo "
\t\t\t</figure>
\t\t</a>
\t</div>
\t";
            }
            // line 134
            echo "
\t";
            // line 136
            echo "\t";
            if ((((isset($context["item"]) ? $context["item"] : null) == "content") && (!call_user_func_array($this->env->getTest('empty')->getCallable(), array((isset($context["content"]) ? $context["content"] : null)))))) {
                // line 137
                echo "\t\t";
                // line 138
                echo "\t\t";
                if ((((call_user_func_array($this->env->getFilter('length')->getCallable(), array($this->env, call_user_func_array($this->env->getFilter('split')->getCallable(), array((isset($context["content"]) ? $context["content"] : null), "</p>")))) > 2) || twig_in_filter("<ul>", (isset($context["content"]) ? $context["content"] : null))) || twig_in_filter("<ol>", (isset($context["content"]) ? $context["content"] : null)))) {
                    $context["text_align"] = "text-left";
                }
                // line 139
                echo "\t\t<div class='content ";
                echo (isset($context["text_align"]) ? $context["text_align"] : null);
                echo "'>";
                echo (isset($context["content"]) ? $context["content"] : null);
                echo "</div>
\t\t";
                // line 141
                echo "\t";
            }
            // line 142
            echo "
";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
    }

    public function getTemplateName()
    {
        return "partials/module.context.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  361 => 142,  358 => 141,  351 => 139,  346 => 138,  344 => 137,  341 => 136,  338 => 134,  331 => 129,  327 => 127,  320 => 125,  314 => 123,  311 => 122,  308 => 120,  302 => 118,  299 => 117,  296 => 115,  290 => 113,  287 => 112,  284 => 110,  276 => 108,  273 => 107,  270 => 106,  267 => 104,  259 => 102,  253 => 100,  250 => 98,  244 => 96,  241 => 95,  238 => 93,  232 => 91,  229 => 90,  226 => 88,  221 => 87,  215 => 84,  211 => 81,  202 => 76,  183 => 73,  180 => 72,  177 => 70,  171 => 68,  159 => 63,  156 => 62,  153 => 61,  141 => 56,  126 => 49,  115 => 46,  112 => 45,  101 => 41,  98 => 40,  92 => 37,  74 => 30,  54 => 19,  172 => 70,  168 => 67,  165 => 66,  162 => 64,  117 => 56,  108 => 47,  105 => 45,  99 => 43,  84 => 36,  81 => 34,  60 => 23,  29 => 7,  64 => 26,  32 => 7,  120 => 58,  113 => 44,  96 => 42,  90 => 34,  49 => 18,  95 => 39,  71 => 29,  66 => 27,  63 => 19,  58 => 23,  56 => 20,  53 => 20,  44 => 12,  27 => 6,  282 => 106,  279 => 105,  269 => 99,  266 => 98,  264 => 97,  260 => 96,  256 => 101,  254 => 94,  249 => 91,  246 => 89,  243 => 87,  237 => 85,  234 => 84,  231 => 82,  225 => 80,  222 => 79,  218 => 85,  207 => 70,  182 => 64,  179 => 62,  163 => 56,  129 => 51,  123 => 47,  116 => 45,  110 => 48,  89 => 30,  86 => 35,  79 => 23,  69 => 29,  50 => 17,  46 => 16,  40 => 13,  22 => 3,  118 => 47,  114 => 50,  111 => 56,  107 => 54,  104 => 52,  93 => 36,  87 => 29,  76 => 21,  73 => 30,  62 => 25,  59 => 23,  51 => 13,  48 => 17,  45 => 16,  38 => 12,  36 => 11,  31 => 8,  26 => 5,  24 => 4,  21 => 2,  216 => 75,  213 => 77,  210 => 72,  208 => 80,  205 => 73,  201 => 68,  198 => 75,  195 => 69,  191 => 66,  188 => 64,  174 => 69,  170 => 61,  167 => 57,  164 => 59,  161 => 58,  158 => 57,  155 => 63,  152 => 61,  150 => 59,  147 => 44,  144 => 57,  138 => 54,  135 => 39,  132 => 52,  130 => 45,  127 => 44,  109 => 43,  106 => 41,  103 => 40,  100 => 38,  97 => 48,  94 => 41,  91 => 39,  88 => 34,  83 => 34,  80 => 32,  77 => 32,  75 => 29,  72 => 27,  70 => 26,  68 => 27,  65 => 26,  61 => 24,  57 => 21,  55 => 18,  52 => 19,  47 => 16,  43 => 14,  41 => 13,  39 => 12,  37 => 11,  35 => 10,  33 => 9,  30 => 6,  28 => 7,  25 => 5,  23 => 3,  19 => 1,);
    }
}
