<?php

/* feed.atom */
class __TwigTemplate_01c51946966c3e149615b28c7db951dd5ad5c53a60a3994cd7116c9a46b3e2a4 extends Twig_Template
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
        ob_start();
        // line 2
        echo "
";
        // line 3
        $context["absolutepath"] = call_user_func_array($this->env->getFilter('addprotocol')->getCallable(), array($this->getAttribute((isset($context["page"]) ? $context["page"] : null), "base_url")));
        // line 4
        $context["rootpath"] = call_user_func_array($this->env->getFilter('replace')->getCallable(), array($this->getAttribute((isset($context["page"]) ? $context["page"] : null), "base_url"), array($this->getAttribute((isset($context["page"]) ? $context["page"] : null), "domain_name") => "")));
        // line 5
        $context["absolutepath_page"] = call_user_func_array($this->env->getFilter('setpath')->getCallable(), array($this->getAttribute((isset($context["page"]) ? $context["page"] : null), "permalink"), (isset($context["absolutepath"]) ? $context["absolutepath"] : null)));
        // line 6
        $context["rootpath_page"] = call_user_func_array($this->env->getFilter('setpath')->getCallable(), array($this->getAttribute((isset($context["page"]) ? $context["page"] : null), "permalink"), (isset($context["rootpath"]) ? $context["rootpath"] : null)));
        // line 7
        $context["index"] = call_user_func_array($this->env->getFunction('get')->getCallable(), array("index"));
        // line 8
        echo "
<?xml version=\"1.0\" encoding=\"utf-8\"?>
<feed xmlns=\"http://www.w3.org/2005/Atom\" xmlns:media=\"http://search.yahoo.com/mrss/\">
<title>";
        // line 11
        echo call_user_func_array($this->env->getFilter('e')->getCallable(), array($this->env, call_user_func_array($this->env->getFilter('striptags')->getCallable(), array($this->getAttribute((isset($context["index"]) ? $context["index"] : null), "title"))), "html"));
        echo "</title>
";
        // line 12
        if ((!call_user_func_array($this->env->getTest('empty')->getCallable(), array($this->getAttribute((isset($context["index"]) ? $context["index"] : null), "description"))))) {
            echo "<subtitle>";
            echo call_user_func_array($this->env->getFilter('e')->getCallable(), array($this->env, call_user_func_array($this->env->getFilter('striptags')->getCallable(), array($this->getAttribute((isset($context["index"]) ? $context["index"] : null), "description"))), "html"));
            echo "</subtitle>";
        }
        // line 13
        echo "<link href=\"";
        echo (isset($context["absolutepath_page"]) ? $context["absolutepath_page"] : null);
        echo "\" rel=\"self\" type=\"application/atom+xml\"/>
<link href=\"";
        // line 14
        echo (isset($context["absolutepath"]) ? $context["absolutepath"] : null);
        echo "/\" rel=\"alternate\" type=\"text/html\" />
<updated>";
        // line 15
        echo $this->getAttribute((isset($context["page"]) ? $context["page"] : null), "site_updated");
        echo "</updated>
<id>";
        // line 16
        echo (isset($context["absolutepath"]) ? $context["absolutepath"] : null);
        echo "/</id>
<generator uri=\"http://imagevuex.com\" version=\"3\">Imagevue X3</generator>
<icon>";
        // line 18
        echo (isset($context["absolutepath"]) ? $context["absolutepath"] : null);
        echo "/content/custom/favicon/favicon.png</icon>
<logo>";
        // line 19
        echo (isset($context["absolutepath"]) ? $context["absolutepath"] : null);
        echo "/content/custom/favicon/favicon.png</logo>
<rights>";
        // line 20
        echo (($this->getAttribute((isset($context["page"]) ? $context["page"] : null), "current_year") . " ") . $this->getAttribute((isset($context["page"]) ? $context["page"] : null), "domain_name"));
        echo "</rights>
<author>
<name>";
        // line 22
        echo $this->getAttribute((isset($context["page"]) ? $context["page"] : null), "domain_name");
        echo "</name>
<uri>";
        // line 23
        echo (isset($context["absolutepath"]) ? $context["absolutepath"] : null);
        echo "/</uri>
</author>
";
        // line 25
        $this->env->loadTemplate("partials/feed/feed-loop.atom")->display($context);
        // line 26
        echo "</feed>
";
        echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
    }

    public function getTemplateName()
    {
        return "feed.atom";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  91 => 26,  89 => 25,  84 => 23,  80 => 22,  75 => 20,  71 => 19,  67 => 18,  62 => 16,  58 => 15,  54 => 14,  49 => 13,  43 => 12,  39 => 11,  34 => 8,  32 => 7,  30 => 6,  28 => 5,  26 => 4,  24 => 3,  21 => 2,  19 => 1,);
    }
}
