<?php

/* partials/feed/feed-loop.atom */
class __TwigTemplate_50ba64980f5eba4e6f63b16b9aa4d5145e823422c7470ec6864b29620979e96e extends Twig_Template
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
        $context['_seq'] = twig_ensure_traversable(call_user_func_array($this->env->getFilter('reverse')->getCallable(), array($this->env, call_user_func_array($this->env->getFunction('sortbydate')->getCallable(), array(((array_key_exists("node", $context)) ? (call_user_func_array($this->env->getFilter('default')->getCallable(), array((isset($context["node"]) ? $context["node"] : null), $this->getAttribute((isset($context["page"]) ? $context["page"] : null), "root")))) : ($this->getAttribute((isset($context["page"]) ? $context["page"] : null), "root"))), "updated")))));
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
        foreach ($context['_seq'] as $context["_key"] => $context["page"]) {
            // line 2
            $context["title"] = call_user_func_array($this->env->getFilter('striptags')->getCallable(), array($this->getAttribute((isset($context["page"]) ? $context["page"] : null), "title")));
            // line 3
            echo "<entry>
<id>tag:";
            // line 4
            echo $this->getAttribute((isset($context["page"]) ? $context["page"] : null), "domain_name");
            echo ",";
            echo $this->getAttribute((isset($context["page"]) ? $context["page"] : null), "id");
            echo "</id>
<title>";
            // line 5
            echo (isset($context["title"]) ? $context["title"] : null);
            echo "</title>
<summary>";
            // line 6
            echo call_user_func_array($this->env->getFilter('default')->getCallable(), array(call_user_func_array($this->env->getFilter('e')->getCallable(), array($this->env, call_user_func_array($this->env->getFilter('striptags')->getCallable(), array($this->getAttribute((isset($context["page"]) ? $context["page"] : null), "description"))), "html")), (isset($context["title"]) ? $context["title"] : null)));
            echo "</summary>
<updated>";
            // line 7
            echo $this->getAttribute((isset($context["page"]) ? $context["page"] : null), "updated");
            echo "</updated>
<link rel=\"alternate\" type=\"text/html\" href=\"";
            // line 8
            echo call_user_func_array($this->env->getFilter('setpath')->getCallable(), array($this->getAttribute((isset($context["page"]) ? $context["page"] : null), "permalink"), (isset($context["absolutepath"]) ? $context["absolutepath"] : null)));
            echo "\" />
";
            // line 9
            ob_start();
            $this->env->loadTemplate("partials/preview-image.html")->display(array_merge($context, array("p" => (isset($context["page"]) ? $context["page"] : null))));
            $context["preview_image"] = ('' === $tmp = ob_get_clean()) ? '' : new Twig_Markup($tmp, $this->env->getCharset());
            // line 10
            $context["preview_image"] = call_user_func_array($this->env->getFilter('replace')->getCallable(), array((isset($context["preview_image"]) ? $context["preview_image"] : null), array("././" => "./")));
            // line 11
            echo "<media:thumbnail url=\"";
            echo (isset($context["absolutepath"]) ? $context["absolutepath"] : null);
            echo call_user_func_array($this->env->getFilter('replace')->getCallable(), array(call_user_func_array($this->env->getFilter('trim')->getCallable(), array(call_user_func_array($this->env->getFunction('resize_path')->getCallable(), array((isset($context["preview_image"]) ? $context["preview_image"] : null), "200", "200", "1:1", 90)), ".")), array(" " => "%20")));
            echo "\" width=\"200\" height=\"200\" />
<media:content url=\"";
            // line 12
            echo ((isset($context["absolutepath"]) ? $context["absolutepath"] : null) . call_user_func_array($this->env->getFilter('replace')->getCallable(), array(call_user_func_array($this->env->getFilter('trim')->getCallable(), array((isset($context["preview_image"]) ? $context["preview_image"] : null), ".")), array(" " => "%20"))));
            echo "\" />
</entry>
";
            // line 14
            if (($this->getAttribute((isset($context["page"]) ? $context["page"] : null), "children_count") > 0)) {
                $this->env->loadTemplate("partials/feed/feed-loop.atom")->display(array_merge($context, array("node" => $this->getAttribute((isset($context["page"]) ? $context["page"] : null), "children"))));
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
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['page'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
    }

    public function getTemplateName()
    {
        return "partials/feed/feed-loop.atom";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  69 => 11,  63 => 9,  59 => 8,  55 => 7,  51 => 6,  47 => 5,  41 => 4,  38 => 3,  36 => 2,  91 => 26,  89 => 25,  84 => 23,  80 => 14,  75 => 12,  71 => 19,  67 => 10,  62 => 16,  58 => 15,  54 => 14,  49 => 13,  43 => 12,  39 => 11,  34 => 8,  32 => 7,  30 => 6,  28 => 5,  26 => 4,  24 => 3,  21 => 2,  19 => 1,);
    }
}
