<?php

/* partials/sitemap/sitemap-url.xml */
class __TwigTemplate_c064f0f4540ca7bbfbf747bfbcbb4bf2b12c62b3d9ff19fc665eb3fbabc6fd1a extends Twig_Template
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
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable(((array_key_exists("node", $context)) ? (call_user_func_array($this->env->getFilter('default')->getCallable(), array((isset($context["node"]) ? $context["node"] : null), $this->getAttribute((isset($context["page"]) ? $context["page"] : null), "root")))) : ($this->getAttribute((isset($context["page"]) ? $context["page"] : null), "root"))));
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
        foreach ($context['_seq'] as $context["_key"] => $context["child"]) {
            // line 2
            echo "<url>
    <loc>";
            // line 3
            echo call_user_func_array($this->env->getFilter('setpath')->getCallable(), array($this->getAttribute((isset($context["child"]) ? $context["child"] : null), "permalink"), (isset($context["absolutepath"]) ? $context["absolutepath"] : null)));
            echo "</loc>
    <lastmod>";
            // line 4
            echo $this->getAttribute((isset($context["child"]) ? $context["child"] : null), "updated");
            echo "</lastmod>
    ";
            // line 5
            ob_start();
            $this->env->loadTemplate("partials/preview-image.html")->display(array_merge($context, array("page" => (isset($context["child"]) ? $context["child"] : null), "allowEmpty" => true)));
            $context["preview_image"] = ('' === $tmp = ob_get_clean()) ? '' : new Twig_Markup($tmp, $this->env->getCharset());
            // line 6
            echo "    ";
            if ((!call_user_func_array($this->env->getTest('empty')->getCallable(), array((isset($context["preview_image"]) ? $context["preview_image"] : null))))) {
                // line 7
                echo "  \t<image:image>
       <image:loc>";
                // line 8
                echo (isset($context["absolutepath"]) ? $context["absolutepath"] : null);
                echo call_user_func_array($this->env->getFilter('trim')->getCallable(), array((isset($context["preview_image"]) ? $context["preview_image"] : null), "."));
                echo "</image:loc>
    </image:image>
  \t";
            }
            // line 11
            echo "    <changefreq>monthly</changefreq>
    <priority>0.7</priority>
</url>
";
            // line 14
            if (($this->getAttribute((isset($context["child"]) ? $context["child"] : null), "children_count") > 0)) {
                // line 15
                $this->env->loadTemplate("partials/sitemap/sitemap-url.xml")->display(array_merge($context, array("node" => $this->getAttribute((isset($context["child"]) ? $context["child"] : null), "children"))));
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
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['child'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
    }

    public function getTemplateName()
    {
        return "partials/sitemap/sitemap-url.xml";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  71 => 15,  69 => 14,  64 => 11,  57 => 8,  54 => 7,  51 => 6,  47 => 5,  43 => 4,  39 => 3,  36 => 2,  48 => 16,  46 => 15,  41 => 13,  37 => 11,  35 => 10,  33 => 9,  31 => 8,  29 => 7,  26 => 5,  24 => 4,  21 => 2,  19 => 1,);
    }
}
