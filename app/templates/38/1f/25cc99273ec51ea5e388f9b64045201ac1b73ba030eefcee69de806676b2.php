<?php

/* video.html */
class __TwigTemplate_381f25cc99273ec51ea5e388f9b64045201ac1b73ba030eefcee69de806676b2 extends Twig_Template
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
        $this->env->loadTemplate("partials/module.video.html")->display($context);
        // line 2
        $this->env->loadTemplate("partials/module.disqus.html")->display($context);
    }

    public function getTemplateName()
    {
        return "video.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  21 => 2,  19 => 1,);
    }
}
