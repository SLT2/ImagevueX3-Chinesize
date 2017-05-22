<?php

/* partials/site.json */
class __TwigTemplate_2adbb97301e178632342b7381d9f570467244bc291ac45e38cf45b8da8f7c9f5 extends Twig_Template
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
            if ((((!($this->getAttribute((isset($context["child"]) ? $context["child"] : null), "protected") === "recursive")) && call_user_func_array($this->env->getTest('empty')->getCallable(), array($this->getAttribute((isset($context["child"]) ? $context["child"] : null), "protected")))) && call_user_func_array($this->env->getTest('empty')->getCallable(), array($this->getAttribute($this->getAttribute((isset($context["child"]) ? $context["child"] : null), "link"), "url"))))) {
                // line 3
                $this->env->loadTemplate("page.json")->display(array_merge($context, array("page" => (isset($context["child"]) ? $context["child"] : null))));
                echo ",
";
            }
            // line 5
            if (($this->getAttribute((isset($context["child"]) ? $context["child"] : null), "children_count") > 0)) {
                // line 6
                $this->env->loadTemplate("partials/site.json")->display(array_merge($context, array("node" => $this->getAttribute((isset($context["child"]) ? $context["child"] : null), "children"))));
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
        return "partials/site.json";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  45 => 6,  43 => 5,  38 => 3,  36 => 2,  19 => 1,);
    }
}
