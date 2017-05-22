<?php

/* file.html */
class __TwigTemplate_569fef2154bf83afb393161305f89ed587432a8f5a4f3d58e099469011ae7d4e extends Twig_Template
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
        $this->env->loadTemplate("page.html")->display($context);
    }

    public function getTemplateName()
    {
        return "file.html";
    }

    public function getDebugInfo()
    {
        return array (  19 => 1,);
    }
}
