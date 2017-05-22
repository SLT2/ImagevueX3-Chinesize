<?php

/* file.json */
class __TwigTemplate_3ed674949f34ce895550568706b0c9f5cdf6dfb4b71132f3ff20e9a7932fd932 extends Twig_Template
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
        $this->env->loadTemplate("page.json")->display($context);
    }

    public function getTemplateName()
    {
        return "file.json";
    }

    public function getDebugInfo()
    {
        return array (  19 => 1,);
    }
}
