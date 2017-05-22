<?php

/* partials/module.gallery.html */
class __TwigTemplate_1033e896130470e36447c93d4ef71133a5390366de2b3062bb13bcbbca321562 extends Twig_Template
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
        $context["settings"] = $this->getAttribute((isset($context["page"]) ? $context["page"] : null), "gallery");
        // line 6
        $context["items"] = call_user_func_array($this->env->getFilter('split')->getCallable(), array($this->getAttribute((isset($context["settings"]) ? $context["settings"] : null), "items"), ","));
        // line 7
        $context["limit"] = $this->getAttribute((isset($context["settings"]) ? $context["settings"] : null), "limit");
        // line 8
        $context["folder_path"] = (((isset($context["assetspath"]) ? $context["assetspath"] : null) . call_user_func_array($this->env->getFilter('trim')->getCallable(), array($this->getAttribute((isset($context["gallery"]) ? $context["gallery"] : null), "file_path"), "."))) . "/");
        // line 9
        if ((call_user_func_array($this->env->getTest('empty')->getCallable(), array((isset($context["limit"]) ? $context["limit"] : null))) || ((isset($context["limit"]) ? $context["limit"] : null) < 1))) {
            $context["limit"] = 99999;
        }
        // line 10
        echo "
";
        // line 12
        if (((call_user_func_array($this->env->getFilter('length')->getCallable(), array($this->env, $this->getAttribute((isset($context["gallery"]) ? $context["gallery"] : null), "video"))) > 0) && !twig_in_filter("hide-video", $this->getAttribute((isset($context["settings"]) ? $context["settings"] : null), "classes")))) {
            // line 13
            echo "\t";
            $this->env->loadTemplate("partials/module.video.html")->display($context);
            // line 14
            echo "\t";
            if ((call_user_func_array($this->env->getFilter('length')->getCallable(), array($this->env, $this->getAttribute((isset($context["gallery"]) ? $context["gallery"] : null), "images"))) > 0)) {
                // line 15
                echo "\t\t<hr class=hr />
\t";
            }
        }
        // line 18
        echo "
";
        // line 20
        if ((($this->getAttribute($this->getAttribute((isset($context["settings"]) ? $context["settings"] : null), "crop"), "enabled") && ($this->getAttribute((isset($context["settings"]) ? $context["settings"] : null), "layout") != "justified")) && ($this->getAttribute((isset($context["settings"]) ? $context["settings"] : null), "layout") != "columns"))) {
            // line 21
            echo "\t";
            $context["crop_ratio"] = (($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["settings"]) ? $context["settings"] : null), "crop"), "crop"), 1, array(), "array") / $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["settings"]) ? $context["settings"] : null), "crop"), "crop"), 0, array(), "array")) * 100);
        }
        // line 23
        echo "
";
        // line 25
        if ($this->getAttribute($this->getAttribute((isset($context["settings"]) ? $context["settings"] : null), "split"), "enabled")) {
            // line 26
            echo "\t";
            // line 27
            echo "\t";
            if ($this->getAttribute($this->getAttribute((isset($context["settings"]) ? $context["settings"] : null), "split"), "invert")) {
                // line 28
                echo "\t\t";
                $context["push"] = ("medium-push-" . (12 - $this->getAttribute($this->getAttribute((isset($context["settings"]) ? $context["settings"] : null), "split"), "ratio")));
                // line 29
                echo "\t\t";
                $context["pull"] = ("medium-pull-" . $this->getAttribute($this->getAttribute((isset($context["settings"]) ? $context["settings"] : null), "split"), "ratio"));
                // line 30
                echo "\t";
            }
        }
        // line 32
        echo "
";
        // line 34
        if (($this->getAttribute((isset($context["settings"]) ? $context["settings"] : null), "layout") == "grid")) {
            // line 35
            echo "\t";
            if ($this->getAttribute($this->getAttribute((isset($context["settings"]) ? $context["settings"] : null), "grid"), "use_width")) {
                // line 36
                echo "\t\t";
                $context["block_grid"] = array(0 => "3", 1 => "2", 2 => "1");
                // line 37
                echo "\t";
            } else {
                // line 38
                echo "\t\t";
                $context["block_grid"] = call_user_func_array($this->env->getFilter('split')->getCallable(), array($this->getAttribute($this->getAttribute((isset($context["settings"]) ? $context["settings"] : null), "grid"), "columns"), ","));
                // line 39
                echo "\t";
            }
            // line 40
            echo "\t";
            $context["columns_limit"] = call_user_func_array($this->env->getFunction('min')->getCallable(), array((isset($context["limit"]) ? $context["limit"] : null), call_user_func_array($this->env->getFilter('length')->getCallable(), array($this->env, $this->getAttribute((isset($context["gallery"]) ? $context["gallery"] : null), "images")))));
            // line 41
            echo "\t";
            $context["small_grid"] = call_user_func_array($this->env->getFunction('min')->getCallable(), array(call_user_func_array($this->env->getFilter('default')->getCallable(), array(call_user_func_array($this->env->getFilter('default')->getCallable(), array((($this->getAttribute((isset($context["block_grid"]) ? $context["block_grid"] : null), 2, array(), "array", true, true)) ? (call_user_func_array($this->env->getFilter('default')->getCallable(), array($this->getAttribute((isset($context["block_grid"]) ? $context["block_grid"] : null), 2, array(), "array"), $this->getAttribute((isset($context["block_grid"]) ? $context["block_grid"] : null), 1, array(), "array")))) : ($this->getAttribute((isset($context["block_grid"]) ? $context["block_grid"] : null), 1, array(), "array"))), $this->getAttribute((isset($context["block_grid"]) ? $context["block_grid"] : null), 0, array(), "array"))), "1")), (isset($context["columns_limit"]) ? $context["columns_limit"] : null)));
            // line 42
            echo "\t";
            $context["medium_grid"] = call_user_func_array($this->env->getFunction('min')->getCallable(), array(call_user_func_array($this->env->getFilter('default')->getCallable(), array((($this->getAttribute((isset($context["block_grid"]) ? $context["block_grid"] : null), 1, array(), "array", true, true)) ? (call_user_func_array($this->env->getFilter('default')->getCallable(), array($this->getAttribute((isset($context["block_grid"]) ? $context["block_grid"] : null), 1, array(), "array"), $this->getAttribute((isset($context["block_grid"]) ? $context["block_grid"] : null), 0, array(), "array")))) : ($this->getAttribute((isset($context["block_grid"]) ? $context["block_grid"] : null), 0, array(), "array"))), "2")), (isset($context["columns_limit"]) ? $context["columns_limit"] : null)));
            // line 43
            echo "\t";
            $context["large_grid"] = call_user_func_array($this->env->getFunction('min')->getCallable(), array((($this->getAttribute((isset($context["block_grid"]) ? $context["block_grid"] : null), 0, array(), "array", true, true)) ? (call_user_func_array($this->env->getFilter('default')->getCallable(), array($this->getAttribute((isset($context["block_grid"]) ? $context["block_grid"] : null), 0, array(), "array"), "3"))) : ("3")), (isset($context["columns_limit"]) ? $context["columns_limit"] : null)));
            // line 44
            echo "
\t";
            // line 45
            $context["ul_open"] = (((((("<ul class='small-block-grid-" . (isset($context["small_grid"]) ? $context["small_grid"] : null)) . " medium-block-grid-") . (isset($context["medium_grid"]) ? $context["medium_grid"] : null)) . " large-block-grid-") . (isset($context["large_grid"]) ? $context["large_grid"] : null)) . " items'>");
            // line 46
            echo "\t";
            $context["li_open"] = "<li>";
            // line 47
            echo "\t";
            $context["li_close"] = "</li>";
            // line 48
            echo "\t";
            $context["ul_close"] = "</ul>";
        }
        // line 50
        echo "
";
        // line 52
        if ((call_user_func_array($this->env->getFilter('length')->getCallable(), array($this->env, $this->getAttribute((isset($context["gallery"]) ? $context["gallery"] : null), "images"))) > 0)) {
            // line 53
            echo "
";
            // line 55
            $context["myimages"] = $this->getAttribute((isset($context["gallery"]) ? $context["gallery"] : null), "images");
            // line 56
            echo "
";
            // line 58
            if ((($this->getAttribute((isset($context["settings"]) ? $context["settings"] : null), "sort") != "shuffle") && ($this->getAttribute((isset($context["settings"]) ? $context["settings"] : null), "sortby") != "shuffle"))) {
                // line 59
                echo "
\t";
                // line 61
                echo "\t";
                if (($this->getAttribute((isset($context["settings"]) ? $context["settings"] : null), "sortby") == "title")) {
                    // line 62
                    echo "\t\t";
                    $context["myimages"] = call_user_func_array($this->env->getFunction('sortby')->getCallable(), array($this->getAttribute((isset($context["gallery"]) ? $context["gallery"] : null), "images"), "title", "file_name"));
                    // line 63
                    echo "\t";
                } elseif (($this->getAttribute((isset($context["settings"]) ? $context["settings"] : null), "sortby") == "date")) {
                    // line 64
                    echo "\t\t";
                    $context["myimages"] = call_user_func_array($this->env->getFunction('sortbydate')->getCallable(), array($this->getAttribute((isset($context["gallery"]) ? $context["gallery"] : null), "images"), "date"));
                    // line 65
                    echo "\t";
                } elseif (($this->getAttribute((isset($context["settings"]) ? $context["settings"] : null), "sortby") == "custom")) {
                    // line 66
                    echo "\t\t";
                    $context["myimages"] = call_user_func_array($this->env->getFunction('sortby')->getCallable(), array($this->getAttribute((isset($context["gallery"]) ? $context["gallery"] : null), "images"), "index"));
                    // line 67
                    echo "\t";
                }
                // line 68
                echo "
\t";
                // line 70
                echo "\t";
                if (($this->getAttribute((isset($context["settings"]) ? $context["settings"] : null), "sort") == "desc")) {
                    // line 71
                    echo "\t\t";
                    $context["myimages"] = call_user_func_array($this->env->getFilter('reverse')->getCallable(), array($this->env, (isset($context["myimages"]) ? $context["myimages"] : null)));
                    // line 72
                    echo "\t";
                }
            }
            // line 74
            echo "
";
            // line 75
            echo (isset($context["ul_open"]) ? $context["ul_open"] : null);
            echo "

";
            // line 78
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["myimages"]) ? $context["myimages"] : null));
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
                // line 79
                echo "
";
                // line 81
                if (($this->getAttribute((isset($context["loop"]) ? $context["loop"] : null), "index0") < (isset($context["limit"]) ? $context["limit"] : null))) {
                    // line 82
                    echo "
\t";
                    // line 84
                    echo "\t";
                    $context["url"] = ((isset($context["assetspath"]) ? $context["assetspath"] : null) . call_user_func_array($this->env->getFilter('trim')->getCallable(), array((($this->getAttribute((isset($context["gallery"]) ? $context["gallery"] : null), "file_path") . "/") . $this->getAttribute((isset($context["image"]) ? $context["image"] : null), "file_name")), ".")));
                    // line 85
                    echo "\t";
                    $context["image_link"] = (($this->getAttribute((isset($context["image"]) ? $context["image"] : null), "link", array(), "any", true, true)) ? (call_user_func_array($this->env->getFilter('default')->getCallable(), array($this->getAttribute((isset($context["image"]) ? $context["image"] : null), "link"), $this->getAttribute($this->getAttribute((isset($context["settings"]) ? $context["settings"] : null), "image"), "link")))) : ($this->getAttribute($this->getAttribute((isset($context["settings"]) ? $context["settings"] : null), "image"), "link")));
                    // line 86
                    echo "\t";
                    $context["link_target"] = (($this->getAttribute((isset($context["image"]) ? $context["image"] : null), "target", array(), "any", true, true)) ? (call_user_func_array($this->env->getFilter('default')->getCallable(), array($this->getAttribute((isset($context["image"]) ? $context["image"] : null), "target"), $this->getAttribute($this->getAttribute((isset($context["settings"]) ? $context["settings"] : null), "image"), "link_target")))) : ($this->getAttribute($this->getAttribute((isset($context["settings"]) ? $context["settings"] : null), "image"), "link_target")));
                    // line 87
                    echo "\t";
                    $context["name_no_ext"] = call_user_func_array($this->env->getFilter('removeExtension')->getCallable(), array($this->getAttribute((isset($context["image"]) ? $context["image"] : null), "file_name")));
                    // line 88
                    echo "
\t";
                    // line 90
                    echo "\t";
                    if ((isset($context["image_link"]) ? $context["image_link"] : null)) {
                        // line 91
                        echo "\t\t";
                        $context["link_href"] = call_user_func_array($this->env->getFilter('replace')->getCallable(), array((isset($context["image_link"]) ? $context["image_link"] : null), array("{file_name}" => (isset($context["name_no_ext"]) ? $context["name_no_ext"] : null), "{file_name_ext}" => $this->getAttribute((isset($context["image"]) ? $context["image"] : null), "file_name"), "{path}" => (isset($context["folder_path"]) ? $context["folder_path"] : null), "{image_path}" => ((isset($context["folder_path"]) ? $context["folder_path"] : null) . $this->getAttribute((isset($context["image"]) ? $context["image"] : null), "file_name")))));
                        // line 92
                        echo "
\t\t";
                        // line 94
                        echo "\t\t";
                        if ((call_user_func_array($this->env->getTest('empty')->getCallable(), array((isset($context["link_target"]) ? $context["link_target"] : null))) || ((isset($context["link_target"]) ? $context["link_target"] : null) == "auto"))) {
                            // line 95
                            echo "\t\t\t";
                            if (((0 === strpos(call_user_func_array($this->env->getFilter('lower')->getCallable(), array($this->env, (isset($context["link_href"]) ? $context["link_href"] : null))), "http")) || call_user_func_array($this->env->getFunction('hasExtension')->getCallable(), array((isset($context["link_href"]) ? $context["link_href"] : null))))) {
                                // line 96
                                echo "\t\t\t\t";
                                $context["link_target"] = " target=_blank";
                                // line 97
                                echo "\t\t\t";
                            } else {
                                // line 98
                                echo "\t\t\t\t";
                                $context["link_target"] = "";
                                // line 99
                                echo "\t\t\t";
                            }
                            // line 100
                            echo "
\t\t";
                            // line 102
                            echo "\t\t";
                        } elseif (((isset($context["link_target"]) ? $context["link_target"] : null) == "popup")) {
                            // line 103
                            echo "\t\t\t";
                            $context["link_target"] = ((((((" data-popup-window=\"" . call_user_func_array($this->env->getFilter('replace')->getCallable(), array($this->getAttribute((isset($context["image"]) ? $context["image"] : null), "name"), array(" " => "-")))) . ",") . $this->getAttribute($this->getAttribute((isset($context["settings"]) ? $context["settings"] : null), "image"), "popup_width")) . ",") . $this->getAttribute($this->getAttribute((isset($context["settings"]) ? $context["settings"] : null), "image"), "popup_height")) . "\"");
                            // line 104
                            echo "
\t\t";
                            // line 106
                            echo "\t\t";
                        } elseif (((isset($context["link_target"]) ? $context["link_target"] : null) == "_blank")) {
                            // line 107
                            echo "\t\t\t";
                            $context["link_target"] = " target=_blank";
                            // line 108
                            echo "
\t\t";
                            // line 110
                            echo "\t\t";
                        } elseif (((isset($context["link_target"]) ? $context["link_target"] : null) == "x3_popup")) {
                            // line 111
                            echo "\t\t\t";
                            $context["link_target"] = " data-popup";
                            // line 112
                            echo "
\t\t";
                            // line 114
                            echo "\t\t";
                        } else {
                            // line 115
                            echo "\t\t\t";
                            $context["link_target"] = "";
                            // line 116
                            echo "\t\t";
                        }
                        // line 117
                        echo "
\t";
                        // line 119
                        echo "\t";
                    } else {
                        // line 120
                        echo "\t\t";
                        $context["link_href"] = ((call_user_func_array($this->env->getFilter('setpath')->getCallable(), array($this->getAttribute((isset($context["gallery"]) ? $context["gallery"] : null), "permalink"), (isset($context["rootpath"]) ? $context["rootpath"] : null))) . call_user_func_array($this->env->getFilter('replace')->getCallable(), array((isset($context["name_no_ext"]) ? $context["name_no_ext"] : null), array(" " => "_")))) . "/");
                        // line 121
                        echo "\t\t";
                        $context["link_target"] = "";
                        // line 122
                        echo "\t";
                    }
                    // line 123
                    echo "
\t";
                    // line 125
                    echo "\t";
                    $context["title"] = call_user_func_array($this->env->getFilter('default')->getCallable(), array(call_user_func_array($this->env->getFilter('replace')->getCallable(), array(call_user_func_array($this->env->getFilter('striptags')->getCallable(), array(call_user_func_array($this->env->getFunction('getDefault')->getCallable(), array($this->getAttribute((isset($context["image"]) ? $context["image"] : null), "title"), $this->getAttribute($this->getAttribute((isset($context["settings"]) ? $context["settings"] : null), "image"), "title"), $this->getAttribute($this->getAttribute((isset($context["settings"]) ? $context["settings"] : null), "image"), "title_include"))), "<a><span><em><i><b><strong><small><s><mark>")), array("{file_name}" => (isset($context["name_no_ext"]) ? $context["name_no_ext"] : null), "{file_name_ext}" => $this->getAttribute((isset($context["image"]) ? $context["image"] : null), "file_name"), "{path}" => (isset($context["folder_path"]) ? $context["folder_path"] : null), "{image_path}" => ((isset($context["folder_path"]) ? $context["folder_path"] : null) . $this->getAttribute((isset($context["image"]) ? $context["image"] : null), "file_name"))))), $this->getAttribute((isset($context["image"]) ? $context["image"] : null), "name")));
                    // line 126
                    echo "\t";
                    $context["title_pseudo"] = call_user_func_array($this->env->getFilter('replace')->getCallable(), array((isset($context["title"]) ? $context["title"] : null), array("<a" => "<span", "</a>" => "</span>", " href=" => " data-href=", " target=" => " data-target=")));
                    // line 127
                    echo "
\t";
                    // line 129
                    echo "\t";
                    $context["image_description"] = call_user_func_array($this->env->getFunction('getDefault')->getCallable(), array($this->getAttribute((isset($context["image"]) ? $context["image"] : null), "description"), $this->getAttribute($this->getAttribute((isset($context["settings"]) ? $context["settings"] : null), "image"), "description"), $this->getAttribute($this->getAttribute((isset($context["settings"]) ? $context["settings"] : null), "image"), "description_include")));
                    // line 130
                    echo "\t";
                    if (call_user_func_array($this->env->getTest('empty')->getCallable(), array((isset($context["image_description"]) ? $context["image_description"] : null)))) {
                        // line 131
                        echo "\t\t";
                        $context["description"] = "";
                        // line 132
                        echo "\t\t";
                        $context["description_pseudo"] = "";
                        // line 133
                        echo "\t";
                    } else {
                        // line 134
                        echo "\t\t";
                        $context["description"] = call_user_func_array($this->env->getFilter('replace')->getCallable(), array(call_user_func_array($this->env->getFilter('striptags')->getCallable(), array((isset($context["image_description"]) ? $context["image_description"] : null), "<a><span><em><i><b><strong><small><s><br><mark><img><kbd><code><button>")), array("{file_name}" => (isset($context["name_no_ext"]) ? $context["name_no_ext"] : null), "{file_name_ext}" => $this->getAttribute((isset($context["image"]) ? $context["image"] : null), "file_name"), "{path}" => (isset($context["folder_path"]) ? $context["folder_path"] : null), "{image_path}" => ((isset($context["folder_path"]) ? $context["folder_path"] : null) . $this->getAttribute((isset($context["image"]) ? $context["image"] : null), "file_name")))));
                        // line 135
                        echo "\t\t";
                        $context["description_pseudo"] = call_user_func_array($this->env->getFilter('replace')->getCallable(), array((isset($context["description"]) ? $context["description"] : null), array("<a" => "<span", "</a>" => "</span>", " href=" => " data-href=", " target=" => " data-target=")));
                        // line 136
                        echo "\t";
                    }
                    // line 137
                    echo "
\t";
                    // line 139
                    echo "\t";
                    $context["date"] = $this->getAttribute((isset($context["image"]) ? $context["image"] : null), "date");
                    // line 140
                    echo "\t";
                    if (($this->getAttribute($this->getAttribute((isset($context["page"]) ? $context["page"] : null), "settings"), "date_format") == "timeago")) {
                        // line 141
                        echo "\t\t";
                        $context["date_formatted"] = call_user_func_array($this->env->getFilter('date')->getCallable(), array($this->env, (isset($context["date"]) ? $context["date"] : null), "d F Y"));
                        // line 142
                        echo "\t\t";
                        $context["date_class"] = "date timeago";
                        // line 143
                        echo "\t";
                    } else {
                        // line 144
                        echo "\t\t";
                        $context["date_formatted"] = call_user_func_array($this->env->getFilter('date')->getCallable(), array($this->env, (isset($context["date"]) ? $context["date"] : null), (($this->getAttribute($this->getAttribute((isset($context["page"]) ? $context["page"] : null), "settings", array(), "any", false, true), "date_format", array(), "any", true, true)) ? (call_user_func_array($this->env->getFilter('default')->getCallable(), array($this->getAttribute($this->getAttribute((isset($context["page"]) ? $context["page"] : null), "settings", array(), "any", false, true), "date_format"), "d F Y"))) : ("d F Y"))));
                        // line 145
                        echo "\t\t";
                        $context["date_class"] = "date";
                        // line 146
                        echo "\t";
                    }
                    // line 147
                    echo "\t";
                    $context["time_tag"] = (((((("<time itemprop=dateCreated datetime=\"" . call_user_func_array($this->env->getFilter('date')->getCallable(), array($this->env, (isset($context["date"]) ? $context["date"] : null), "c"))) . "\" class=\"") . (isset($context["date_class"]) ? $context["date_class"] : null)) . "\">") . (isset($context["date_formatted"]) ? $context["date_formatted"] : null)) . "</time>");
                    // line 148
                    echo "
\t";
                    // line 150
                    echo "\t";
                    $context["image_ratio"] = ((array_key_exists("crop_ratio", $context)) ? (call_user_func_array($this->env->getFilter('default')->getCallable(), array((isset($context["crop_ratio"]) ? $context["crop_ratio"] : null), (($this->getAttribute((isset($context["image"]) ? $context["image"] : null), "height") / $this->getAttribute((isset($context["image"]) ? $context["image"] : null), "width")) * 100)))) : ((($this->getAttribute((isset($context["image"]) ? $context["image"] : null), "height") / $this->getAttribute((isset($context["image"]) ? $context["image"] : null), "width")) * 100)));
                    // line 151
                    echo "
\t";
                    // line 153
                    echo "\t";
                    if ($this->getAttribute($this->getAttribute((isset($context["settings"]) ? $context["settings"] : null), "tooltip"), "enabled")) {
                        // line 154
                        echo "\t\t";
                        $context["tooltip_items"] = call_user_func_array($this->env->getFilter('split')->getCallable(), array($this->getAttribute($this->getAttribute((isset($context["settings"]) ? $context["settings"] : null), "tooltip"), "items"), ","));
                        // line 155
                        echo "\t\t";
                        ob_start();
                        // line 156
                        echo "\t\t";
                        $context['_parent'] = (array) $context;
                        $context['_seq'] = twig_ensure_traversable((isset($context["tooltip_items"]) ? $context["tooltip_items"] : null));
                        foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
                            // line 157
                            echo "\t\t\t";
                            if (((isset($context["item"]) ? $context["item"] : null) == "title")) {
                                echo "<span class=title>";
                                echo (isset($context["title"]) ? $context["title"] : null);
                                echo "</span>
\t\t\t";
                            } elseif (((isset($context["item"]) ? $context["item"] : null) == "date")) {
                                // line 158
                                echo (isset($context["time_tag"]) ? $context["time_tag"] : null);
                                echo "
\t\t\t";
                            } elseif ((((isset($context["item"]) ? $context["item"] : null) == "description") && (!call_user_func_array($this->env->getTest('empty')->getCallable(), array((isset($context["description"]) ? $context["description"] : null)))))) {
                                // line 159
                                echo "<span class=description>";
                                echo (isset($context["description"]) ? $context["description"] : null);
                                echo "</span>";
                            }
                            // line 160
                            echo "\t\t";
                        }
                        $_parent = $context['_parent'];
                        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
                        $context = array_intersect_key($context, $_parent) + $_parent;
                        // line 161
                        echo "\t\t";
                        $context["link_title_content"] = ('' === $tmp = ob_get_clean()) ? '' : new Twig_Markup($tmp, $this->env->getCharset());
                        // line 162
                        echo "\t\t";
                        $context["link_title_content"] = call_user_func_array($this->env->getFilter('trim')->getCallable(), array(call_user_func_array($this->env->getFilter('e')->getCallable(), array($this->env, (isset($context["link_title_content"]) ? $context["link_title_content"] : null), "html"))));
                        // line 163
                        echo "\t\t";
                        if ((!call_user_func_array($this->env->getTest('empty')->getCallable(), array((isset($context["link_title_content"]) ? $context["link_title_content"] : null))))) {
                            ob_start();
                            echo "title='";
                            echo (isset($context["link_title_content"]) ? $context["link_title_content"] : null);
                            echo "'";
                            $context["link_title"] = ('' === $tmp = ob_get_clean()) ? '' : new Twig_Markup($tmp, $this->env->getCharset());
                        }
                        // line 164
                        echo "\t";
                    }
                    // line 165
                    echo "
\t";
                    // line 167
                    echo "\t";
                    ob_start();
                    // line 168
                    echo "\t";
                    if (($this->getAttribute((isset($context["settings"]) ? $context["settings"] : null), "layout") != "slideshow")) {
                        // line 169
                        echo "\t<figure>
\t\t\t<div class='image-container' style='padding-bottom:";
                        // line 170
                        echo (isset($context["image_ratio"]) ? $context["image_ratio"] : null);
                        echo "%;'>
\t\t\t\t<img data-src='";
                        // line 171
                        echo (isset($context["url"]) ? $context["url"] : null);
                        echo "' alt='";
                        echo call_user_func_array($this->env->getFilter('e')->getCallable(), array($this->env, call_user_func_array($this->env->getFilter('striptags')->getCallable(), array((isset($context["title"]) ? $context["title"] : null))), "html"));
                        echo "' itemprop='thumbnail'>
\t\t\t</div>

\t\t";
                        // line 175
                        echo "\t\t";
                        if ($this->getAttribute($this->getAttribute((isset($context["settings"]) ? $context["settings"] : null), "caption"), "enabled")) {
                            // line 176
                            echo "
\t\t\t";
                            // line 178
                            echo "\t\t\t";
                            ob_start();
                            // line 179
                            echo "\t\t\t\t";
                            $context['_parent'] = (array) $context;
                            $context['_seq'] = twig_ensure_traversable(call_user_func_array($this->env->getFilter('split')->getCallable(), array($this->getAttribute($this->getAttribute((isset($context["settings"]) ? $context["settings"] : null), "caption"), "items"), ",")));
                            foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
                                // line 180
                                echo "\t\t\t\t\t";
                                if (((isset($context["item"]) ? $context["item"] : null) == "title")) {
                                    echo "<span class='title'>";
                                    echo (isset($context["title_pseudo"]) ? $context["title_pseudo"] : null);
                                    echo "</span>
\t\t\t\t\t";
                                } elseif (((isset($context["item"]) ? $context["item"] : null) == "date")) {
                                    // line 181
                                    echo (isset($context["time_tag"]) ? $context["time_tag"] : null);
                                    echo "
\t\t\t\t\t";
                                } elseif ((((isset($context["item"]) ? $context["item"] : null) == "description") && (!call_user_func_array($this->env->getTest('empty')->getCallable(), array((isset($context["description_pseudo"]) ? $context["description_pseudo"] : null)))))) {
                                    // line 182
                                    echo "<span class='description'>";
                                    echo (isset($context["description_pseudo"]) ? $context["description_pseudo"] : null);
                                    echo "</span>";
                                }
                                // line 183
                                echo "\t\t\t\t";
                            }
                            $_parent = $context['_parent'];
                            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
                            $context = array_intersect_key($context, $_parent) + $_parent;
                            // line 184
                            echo "\t\t\t";
                            $context["figcaption_content"] = ('' === $tmp = ob_get_clean()) ? '' : new Twig_Markup($tmp, $this->env->getCharset());
                            // line 185
                            echo "\t\t\t";
                            $context["figcaption_content"] = call_user_func_array($this->env->getFilter('trim')->getCallable(), array((isset($context["figcaption_content"]) ? $context["figcaption_content"] : null)));
                            // line 186
                            echo "
\t\t\t";
                            // line 188
                            echo "\t\t\t";
                            if ((!call_user_func_array($this->env->getTest('empty')->getCallable(), array((isset($context["figcaption_content"]) ? $context["figcaption_content"] : null))))) {
                                // line 189
                                echo "\t\t\t\t<figcaption itemprop='caption description'>";
                                echo (isset($context["figcaption_content"]) ? $context["figcaption_content"] : null);
                                echo "</figcaption>
\t\t\t";
                            }
                            // line 191
                            echo "
  \t";
                        }
                        // line 193
                        echo "\t</figure>
\t";
                    }
                    // line 195
                    echo "\t";
                    $context["figure"] = ('' === $tmp = ob_get_clean()) ? '' : new Twig_Markup($tmp, $this->env->getCharset());
                    // line 196
                    echo "
\t";
                    // line 198
                    echo "\t";
                    ob_start();
                    // line 199
                    echo "
\t\t";
                    // line 200
                    echo (isset($context["li_open"]) ? $context["li_open"] : null);
                    echo "

\t\t";
                    // line 203
                    echo "\t\t";
                    $context["anchor_class"] = "item img-link item-link";
                    // line 204
                    echo "\t\t";
                    if (($this->getAttribute($this->getAttribute((isset($context["page"]) ? $context["page"] : null), "popup"), "enabled") && call_user_func_array($this->env->getTest('empty')->getCallable(), array((isset($context["image_link"]) ? $context["image_link"] : null))))) {
                        // line 205
                        echo "\t\t\t";
                        $context["anchor_class"] = ((isset($context["anchor_class"]) ? $context["anchor_class"] : null) . " x3-popup");
                        // line 206
                        echo "\t\t";
                    }
                    // line 207
                    echo "\t\t";
                    if (($this->getAttribute($this->getAttribute((isset($context["settings"]) ? $context["settings"] : null), "split"), "enabled") && ($this->getAttribute((isset($context["settings"]) ? $context["settings"] : null), "layout") != "justified"))) {
                        // line 208
                        echo "\t\t\t";
                        $context["anchor_class"] = ((isset($context["anchor_class"]) ? $context["anchor_class"] : null) . " row");
                        // line 209
                        echo "\t\t";
                    }
                    // line 210
                    echo "
\t\t";
                    // line 212
                    echo "\t\t";
                    $context["exif"] = "";
                    // line 213
                    echo "\t\t";
                    if (($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["page"]) ? $context["page"] : null), "popup"), "caption"), "exif") && $this->getAttribute((isset($context["image"]) ? $context["image"] : null), "exif"))) {
                        // line 214
                        echo "\t\t\t";
                        $context['_parent'] = (array) $context;
                        $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["image"]) ? $context["image"] : null), "exif"));
                        foreach ($context['_seq'] as $context["key"] => $context["val"]) {
                            if ((!call_user_func_array($this->env->getTest('empty')->getCallable(), array((isset($context["val"]) ? $context["val"] : null))))) {
                                // line 215
                                echo "\t\t    ";
                                $context["exif"] = (((((isset($context["exif"]) ? $context["exif"] : null) . (isset($context["key"]) ? $context["key"] : null)) . ":") . (isset($context["val"]) ? $context["val"] : null)) . ";");
                                // line 216
                                echo "\t\t\t";
                            }
                        }
                        $_parent = $context['_parent'];
                        unset($context['_seq'], $context['_iterated'], $context['key'], $context['val'], $context['_parent'], $context['loop']);
                        $context = array_intersect_key($context, $_parent) + $_parent;
                        // line 217
                        echo "\t\t\t";
                        if ((isset($context["exif"]) ? $context["exif"] : null)) {
                            // line 218
                            echo "\t\t\t\t";
                            $context["exif"] = (("data-exif=\"" . (isset($context["exif"]) ? $context["exif"] : null)) . "\"");
                            // line 219
                            echo "\t\t\t";
                        }
                        // line 220
                        echo "\t\t";
                    }
                    // line 221
                    echo "
\t\t";
                    // line 223
                    echo "\t\t<a class='";
                    echo (isset($context["anchor_class"]) ? $context["anchor_class"] : null);
                    echo "' ";
                    echo (isset($context["exif"]) ? $context["exif"] : null);
                    echo " data-options='w:";
                    echo $this->getAttribute((isset($context["image"]) ? $context["image"] : null), "width");
                    echo ";h:";
                    echo $this->getAttribute((isset($context["image"]) ? $context["image"] : null), "height");
                    echo "' data-image='";
                    echo (isset($context["url"]) ? $context["url"] : null);
                    echo "' data-title='";
                    echo call_user_func_array($this->env->getFilter('e')->getCallable(), array($this->env, (isset($context["title"]) ? $context["title"] : null), "html"));
                    echo "' data-description='";
                    echo call_user_func_array($this->env->getFilter('e')->getCallable(), array($this->env, (isset($context["description"]) ? $context["description"] : null), "html"));
                    echo "' data-date='";
                    echo (isset($context["date_formatted"]) ? $context["date_formatted"] : null);
                    echo "' href='";
                    echo (isset($context["link_href"]) ? $context["link_href"] : null);
                    echo "'";
                    echo (isset($context["link_target"]) ? $context["link_target"] : null);
                    echo " id='";
                    echo call_user_func_array($this->env->getFilter('replace')->getCallable(), array($this->getAttribute((isset($context["image"]) ? $context["image"] : null), "name"), array(" " => "-")));
                    echo "' ";
                    echo (isset($context["link_title"]) ? $context["link_title"] : null);
                    echo " itemprop='associatedMedia' itemscope itemtype='http://schema.org/ImageObject'>

\t\t";
                    // line 226
                    echo "\t\t";
                    if (($this->getAttribute((isset($context["settings"]) ? $context["settings"] : null), "layout") == "slideshow")) {
                        // line 227
                        echo "\t\t\t<span itemprop='caption description' data-image='";
                        echo (isset($context["url"]) ? $context["url"] : null);
                        echo "'>
\t\t\t";
                        // line 228
                        if (call_user_func_array($this->env->getTest('empty')->getCallable(), array((isset($context["description"]) ? $context["description"] : null)))) {
                            // line 229
                            echo "\t\t\t\t";
                            echo (isset($context["title_pseudo"]) ? $context["title_pseudo"] : null);
                            echo "
\t\t\t";
                        } else {
                            // line 231
                            echo "\t\t\t\t<strong>";
                            echo (isset($context["title_pseudo"]) ? $context["title_pseudo"] : null);
                            echo "</strong>&nbsp; — &nbsp;";
                            echo (isset($context["description_pseudo"]) ? $context["description_pseudo"] : null);
                            echo "
\t\t\t";
                        }
                        // line 233
                        echo "\t\t\t</span>
\t\t";
                    } else {
                        // line 235
                        echo "
\t\t";
                        // line 237
                        echo "\t\t";
                        if (($this->getAttribute($this->getAttribute((isset($context["settings"]) ? $context["settings"] : null), "split"), "enabled") && ($this->getAttribute((isset($context["settings"]) ? $context["settings"] : null), "layout") != "justified"))) {
                            // line 238
                            echo "
\t\t";
                            // line 240
                            echo "\t\t";
                            if ($this->getAttribute($this->getAttribute((isset($context["settings"]) ? $context["settings"] : null), "split"), "invert")) {
                                // line 241
                                echo "\t\t\t";
                                $context["text_align"] = "medium-text-left";
                                // line 242
                                echo "\t\t";
                            } elseif ((!twig_in_filter("text-right", $this->getAttribute((isset($context["settings"]) ? $context["settings"] : null), "classes")) && !twig_in_filter("text-left", $this->getAttribute((isset($context["settings"]) ? $context["settings"] : null), "classes")))) {
                                // line 243
                                echo "\t\t\t";
                                $context["text_align"] = "medium-text-right";
                                // line 244
                                echo "\t\t";
                            }
                            // line 245
                            echo "
\t\t";
                            // line 247
                            echo "\t\t<div class='medium-";
                            echo $this->getAttribute($this->getAttribute((isset($context["settings"]) ? $context["settings"] : null), "split"), "ratio");
                            echo " columns ";
                            echo (isset($context["push"]) ? $context["push"] : null);
                            echo " ";
                            echo (isset($context["text_align"]) ? $context["text_align"] : null);
                            echo "'>
\t\t\t";
                            // line 248
                            $context['_parent'] = (array) $context;
                            $context['_seq'] = twig_ensure_traversable((isset($context["items"]) ? $context["items"] : null));
                            foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
                                // line 249
                                echo "\t\t\t\t";
                                if (((isset($context["item"]) ? $context["item"] : null) == "title")) {
                                    // line 250
                                    echo "\t\t\t\t\t<h2 class='title' itemprop='caption'>";
                                    echo (isset($context["title_pseudo"]) ? $context["title_pseudo"] : null);
                                    echo "</h2>
\t\t\t\t";
                                } elseif ((((isset($context["item"]) ? $context["item"] : null) == "description") && (!call_user_func_array($this->env->getTest('empty')->getCallable(), array((isset($context["description"]) ? $context["description"] : null)))))) {
                                    // line 252
                                    echo "\t\t\t\t<p itemprop='description'>";
                                    echo (isset($context["description_pseudo"]) ? $context["description_pseudo"] : null);
                                    echo "</p>
\t\t\t\t";
                                } elseif (((isset($context["item"]) ? $context["item"] : null) == "date")) {
                                    // line 254
                                    echo "\t\t\t\t\t<h6 class=date>";
                                    echo (isset($context["time_tag"]) ? $context["time_tag"] : null);
                                    echo "</h6>
\t\t\t\t";
                                }
                                // line 256
                                echo "\t\t\t";
                            }
                            $_parent = $context['_parent'];
                            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
                            $context = array_intersect_key($context, $_parent) + $_parent;
                            // line 257
                            echo "
\t\t\t";
                            // line 259
                            echo "\t\t\t";
                            // line 269
                            echo "
\t\t</div>
\t\t<div class='medium-";
                            // line 271
                            echo (12 - $this->getAttribute($this->getAttribute((isset($context["settings"]) ? $context["settings"] : null), "split"), "ratio"));
                            echo " columns ";
                            echo (isset($context["pull"]) ? $context["pull"] : null);
                            echo "'>
\t\t\t";
                            // line 272
                            echo (isset($context["figure"]) ? $context["figure"] : null);
                            echo "
\t\t</div>

\t\t";
                            // line 276
                            echo "\t\t";
                        } elseif (($this->getAttribute((isset($context["settings"]) ? $context["settings"] : null), "layout") != "justified")) {
                            // line 277
                            echo "\t\t";
                            $context['_parent'] = (array) $context;
                            $context['_seq'] = twig_ensure_traversable((isset($context["items"]) ? $context["items"] : null));
                            foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
                                // line 278
                                echo "\t\t\t";
                                if (((isset($context["item"]) ? $context["item"] : null) == "title")) {
                                    // line 279
                                    echo "\t\t\t\t<h2 class='title' itemprop='caption'>";
                                    echo (isset($context["title_pseudo"]) ? $context["title_pseudo"] : null);
                                    echo "</h2>
\t\t\t";
                                } elseif ((((isset($context["item"]) ? $context["item"] : null) == "description") && (!call_user_func_array($this->env->getTest('empty')->getCallable(), array((isset($context["description"]) ? $context["description"] : null)))))) {
                                    // line 281
                                    echo "\t\t\t\t<p itemprop='description'>";
                                    echo (isset($context["description_pseudo"]) ? $context["description_pseudo"] : null);
                                    echo "</p>
\t\t\t";
                                } elseif (((isset($context["item"]) ? $context["item"] : null) == "date")) {
                                    // line 283
                                    echo "\t\t\t\t<h6 class=date>";
                                    echo (isset($context["time_tag"]) ? $context["time_tag"] : null);
                                    echo "</h6>
\t\t\t";
                                } elseif (((isset($context["item"]) ? $context["item"] : null) == "preview")) {
                                    // line 285
                                    echo "\t\t\t\t";
                                    echo (isset($context["figure"]) ? $context["figure"] : null);
                                    echo "
\t\t\t";
                                }
                                // line 287
                                echo "\t\t";
                            }
                            $_parent = $context['_parent'];
                            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
                            $context = array_intersect_key($context, $_parent) + $_parent;
                            // line 288
                            echo "
\t\t";
                            // line 290
                            echo "\t\t";
                        } else {
                            // line 291
                            echo "\t\t\t";
                            echo (isset($context["figure"]) ? $context["figure"] : null);
                            echo "
\t\t";
                        }
                        // line 293
                        echo "
\t\t";
                    }
                    // line 295
                    echo "
\t\t</a>

\t\t";
                    // line 298
                    if ((((!$this->getAttribute((isset($context["loop"]) ? $context["loop"] : null), "last")) && ($this->getAttribute((isset($context["settings"]) ? $context["settings"] : null), "layout") == "vertical")) && $this->getAttribute($this->getAttribute((isset($context["settings"]) ? $context["settings"] : null), "vertical"), "horizontal_rule"))) {
                        // line 299
                        echo "\t\t\t<hr class=hr />
\t\t";
                    }
                    // line 301
                    echo "
\t\t";
                    // line 302
                    echo (isset($context["li_close"]) ? $context["li_close"] : null);
                    echo "

\t";
                    $context["item"] = ('' === $tmp = ob_get_clean()) ? '' : new Twig_Markup($tmp, $this->env->getCharset());
                    // line 305
                    echo "
\t";
                    // line 307
                    echo "\t";
                    if ((twig_in_filter("landscape", (isset($context["module_classes"]) ? $context["module_classes"] : null)) || twig_in_filter("portrait", (isset($context["module_classes"]) ? $context["module_classes"] : null)))) {
                        // line 308
                        echo "\t\t";
                        if ((twig_in_filter("landscape", (isset($context["module_classes"]) ? $context["module_classes"] : null)) && ($this->getAttribute((isset($context["image"]) ? $context["image"] : null), "width") > $this->getAttribute((isset($context["image"]) ? $context["image"] : null), "height")))) {
                            // line 309
                            echo "\t\t\t";
                            echo (isset($context["item"]) ? $context["item"] : null);
                            echo "
\t\t";
                        } elseif ((twig_in_filter("portrait", (isset($context["module_classes"]) ? $context["module_classes"] : null)) && ($this->getAttribute((isset($context["image"]) ? $context["image"] : null), "height") > $this->getAttribute((isset($context["image"]) ? $context["image"] : null), "width")))) {
                            // line 311
                            echo "\t\t\t";
                            echo (isset($context["item"]) ? $context["item"] : null);
                            echo "
\t\t";
                        }
                        // line 313
                        echo "\t";
                    } else {
                        // line 314
                        echo "\t\t";
                        echo (isset($context["item"]) ? $context["item"] : null);
                        echo "
\t";
                    }
                    // line 316
                    echo "
";
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
            // line 319
            echo (isset($context["ul_close"]) ? $context["ul_close"] : null);
            echo "
";
        }
    }

    public function getTemplateName()
    {
        return "partials/module.gallery.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  874 => 319,  858 => 316,  852 => 314,  849 => 313,  843 => 311,  837 => 309,  834 => 308,  828 => 305,  822 => 302,  815 => 299,  813 => 298,  808 => 295,  798 => 291,  786 => 287,  780 => 285,  774 => 283,  768 => 281,  762 => 279,  759 => 278,  754 => 277,  751 => 276,  745 => 272,  739 => 271,  735 => 269,  733 => 259,  730 => 257,  724 => 256,  718 => 254,  712 => 252,  706 => 250,  703 => 249,  699 => 248,  684 => 244,  678 => 242,  675 => 241,  672 => 240,  669 => 238,  666 => 237,  659 => 233,  651 => 231,  645 => 229,  643 => 228,  638 => 227,  635 => 226,  607 => 223,  604 => 221,  601 => 220,  598 => 219,  595 => 218,  592 => 217,  585 => 216,  582 => 215,  576 => 214,  573 => 213,  570 => 212,  567 => 210,  564 => 209,  561 => 208,  558 => 207,  555 => 206,  552 => 205,  549 => 204,  541 => 200,  538 => 199,  525 => 193,  521 => 191,  515 => 189,  512 => 188,  509 => 186,  506 => 185,  503 => 184,  497 => 183,  492 => 182,  487 => 181,  479 => 180,  474 => 179,  471 => 178,  468 => 176,  465 => 175,  457 => 171,  407 => 158,  399 => 157,  394 => 156,  391 => 155,  388 => 154,  385 => 153,  382 => 151,  379 => 150,  376 => 148,  373 => 147,  370 => 146,  367 => 145,  364 => 144,  355 => 141,  352 => 140,  349 => 139,  343 => 136,  340 => 135,  337 => 134,  334 => 133,  328 => 131,  325 => 130,  322 => 129,  319 => 127,  316 => 126,  313 => 125,  310 => 123,  307 => 122,  304 => 121,  301 => 120,  298 => 119,  295 => 117,  292 => 116,  286 => 114,  283 => 112,  280 => 111,  277 => 110,  274 => 108,  271 => 107,  268 => 106,  209 => 81,  189 => 78,  184 => 75,  181 => 74,  142 => 58,  139 => 56,  137 => 55,  134 => 53,  125 => 48,  122 => 47,  119 => 46,  102 => 40,  85 => 34,  82 => 32,  78 => 30,  67 => 26,  912 => 277,  898 => 276,  893 => 274,  890 => 273,  886 => 271,  883 => 270,  877 => 265,  871 => 263,  868 => 262,  865 => 260,  859 => 259,  856 => 258,  851 => 257,  846 => 256,  841 => 255,  836 => 254,  831 => 307,  824 => 252,  819 => 301,  816 => 250,  810 => 246,  804 => 293,  801 => 244,  795 => 290,  792 => 288,  787 => 241,  782 => 240,  777 => 239,  772 => 238,  765 => 237,  761 => 236,  752 => 235,  749 => 233,  746 => 232,  743 => 231,  740 => 230,  737 => 229,  734 => 228,  731 => 226,  728 => 225,  723 => 222,  708 => 221,  705 => 219,  700 => 216,  697 => 215,  690 => 247,  687 => 245,  681 => 243,  676 => 211,  671 => 210,  663 => 235,  655 => 208,  649 => 207,  641 => 206,  636 => 205,  633 => 204,  631 => 203,  623 => 200,  619 => 199,  615 => 197,  612 => 196,  609 => 195,  603 => 193,  600 => 192,  597 => 191,  594 => 190,  586 => 188,  583 => 187,  580 => 186,  577 => 185,  569 => 183,  566 => 182,  563 => 181,  557 => 179,  554 => 178,  546 => 203,  543 => 175,  535 => 198,  532 => 196,  529 => 195,  526 => 170,  523 => 169,  518 => 168,  484 => 167,  481 => 165,  478 => 164,  475 => 163,  472 => 162,  469 => 161,  466 => 160,  463 => 159,  459 => 157,  456 => 156,  453 => 170,  450 => 169,  447 => 168,  444 => 167,  441 => 165,  438 => 164,  435 => 148,  432 => 147,  429 => 163,  426 => 162,  423 => 161,  420 => 143,  417 => 160,  414 => 141,  412 => 159,  409 => 139,  406 => 138,  404 => 137,  401 => 136,  398 => 135,  395 => 133,  392 => 132,  389 => 131,  386 => 130,  383 => 128,  380 => 127,  377 => 126,  374 => 125,  371 => 124,  368 => 123,  365 => 122,  362 => 120,  359 => 119,  356 => 118,  353 => 117,  350 => 116,  347 => 115,  335 => 110,  332 => 109,  323 => 108,  317 => 106,  305 => 103,  297 => 102,  289 => 115,  278 => 99,  265 => 104,  262 => 103,  247 => 97,  235 => 92,  223 => 87,  220 => 86,  217 => 85,  214 => 84,  206 => 79,  203 => 73,  200 => 72,  197 => 71,  194 => 70,  185 => 67,  176 => 64,  173 => 62,  133 => 53,  131 => 52,  128 => 50,  124 => 48,  42 => 13,  361 => 143,  358 => 142,  351 => 139,  346 => 137,  344 => 114,  341 => 113,  338 => 112,  331 => 132,  327 => 127,  320 => 107,  314 => 123,  311 => 105,  308 => 120,  302 => 118,  299 => 117,  296 => 115,  290 => 113,  287 => 112,  284 => 100,  276 => 108,  273 => 107,  270 => 98,  267 => 104,  259 => 102,  253 => 99,  250 => 98,  244 => 96,  241 => 95,  238 => 94,  232 => 91,  229 => 90,  226 => 88,  221 => 87,  215 => 84,  211 => 82,  202 => 76,  183 => 73,  180 => 72,  177 => 72,  171 => 70,  159 => 65,  156 => 64,  153 => 63,  141 => 56,  126 => 49,  115 => 46,  112 => 45,  101 => 37,  98 => 36,  92 => 34,  74 => 28,  54 => 19,  172 => 70,  168 => 68,  165 => 67,  162 => 66,  117 => 45,  108 => 42,  105 => 41,  99 => 39,  84 => 36,  81 => 34,  60 => 21,  29 => 7,  64 => 26,  32 => 7,  120 => 46,  113 => 42,  96 => 38,  90 => 36,  49 => 18,  95 => 35,  71 => 27,  66 => 24,  63 => 19,  58 => 21,  56 => 20,  53 => 18,  44 => 14,  27 => 6,  282 => 106,  279 => 105,  269 => 99,  266 => 98,  264 => 97,  260 => 96,  256 => 100,  254 => 94,  249 => 91,  246 => 89,  243 => 87,  237 => 85,  234 => 84,  231 => 82,  225 => 80,  222 => 79,  218 => 85,  207 => 70,  182 => 66,  179 => 65,  163 => 56,  129 => 50,  123 => 47,  116 => 44,  110 => 48,  89 => 33,  86 => 32,  79 => 23,  69 => 27,  50 => 16,  46 => 16,  40 => 12,  22 => 3,  118 => 45,  114 => 44,  111 => 43,  107 => 54,  104 => 52,  93 => 37,  87 => 35,  76 => 21,  73 => 30,  62 => 23,  59 => 23,  51 => 13,  48 => 15,  45 => 14,  38 => 12,  36 => 11,  31 => 8,  26 => 5,  24 => 4,  21 => 2,  216 => 75,  213 => 77,  210 => 72,  208 => 75,  205 => 73,  201 => 68,  198 => 75,  195 => 69,  191 => 69,  188 => 68,  174 => 71,  170 => 61,  167 => 60,  164 => 59,  161 => 58,  158 => 56,  155 => 55,  152 => 61,  150 => 62,  147 => 61,  144 => 59,  138 => 54,  135 => 39,  132 => 52,  130 => 45,  127 => 44,  109 => 40,  106 => 39,  103 => 38,  100 => 38,  97 => 48,  94 => 41,  91 => 39,  88 => 34,  83 => 31,  80 => 30,  77 => 29,  75 => 29,  72 => 28,  70 => 26,  68 => 27,  65 => 25,  61 => 24,  57 => 19,  55 => 18,  52 => 19,  47 => 15,  43 => 14,  41 => 13,  39 => 12,  37 => 10,  35 => 10,  33 => 9,  30 => 6,  28 => 7,  25 => 5,  23 => 3,  19 => 1,);
    }
}
