<?php

/* partials/footer.html */
class __TwigTemplate_abcf16e1e00f822b275afa9087ad4a3c9956230d0a9b39e35b8fdd2fbd0eb962 extends Twig_Template
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
        echo "</main>
</div>
</div>

<footer class=\"footer\">

\t";
        // line 8
        echo "\t";
        echo call_user_func_array($this->env->getFilter('trim')->getCallable(), array(call_user_func_array($this->env->getFilter('replace')->getCallable(), array(call_user_func_array($this->env->getFilter('removeComments')->getCallable(), array($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["page"]) ? $context["page"] : null), "back"), "custom"), "footer"))), array("{{copy}}" => (((((("<p>&copy; " . $this->getAttribute((isset($context["page"]) ? $context["page"] : null), "current_year")) . " <a href=\"") . (isset($context["rootpath"]) ? $context["rootpath"] : null)) . "/\">") . $this->getAttribute((isset($context["page"]) ? $context["page"] : null), "base_url")) . "</a></p>"))))));
        echo "

\t";
        // line 12
        echo "\t<p>";
        echo call_user_func_array($this->env->getFunction('random')->getCallable(), array($this->env, array(0 => "Photo Gallery Website", 1 => "Photography Website Template", 2 => "Image Gallery CMS")));
        echo " by <a href=\"https://imagevuex.com\">imagevuex.com</a></p>
</footer>

";
        // line 16
        echo "<script>
var x3_settings = ";
        // line 17
        echo call_user_func_array($this->env->getFunction('jsonSettings')->getCallable(), array((isset($context["page"]) ? $context["page"] : null)));
        echo ";
var x3_page = ";
        // line 18
        echo call_user_func_array($this->env->getFunction('pageJson')->getCallable(), array((isset($context["page_title"]) ? $context["page_title"] : null), (isset($context["page_description"]) ? $context["page_description"] : null), "", $this->getAttribute((isset($context["page"]) ? $context["page"] : null), "template_name"), $this->getAttribute((isset($context["page"]) ? $context["page"] : null), "id"), (isset($context["preview_image_full"]) ? $context["preview_image_full"] : null), $this->getAttribute((isset($context["page"]) ? $context["page"] : null), "permalink"), $this->getAttribute((isset($context["page"]) ? $context["page"] : null), "file_path")));
        echo ";
";
        // line 19
        if ($this->getAttribute($this->getAttribute((isset($context["page"]) ? $context["page"] : null), "settings"), "cdn_core")) {
            // line 20
            echo "function jsFail(){
\tvar s = document.createElement('script');
\ts.type = 'text/javascript';
\ts.onload = imagevue_;
\ts.src = '";
            // line 24
            echo (isset($context["rootpath"]) ? $context["rootpath"] : null);
            echo "/public/js/";
            echo $this->getAttribute((isset($context["page"]) ? $context["page"] : null), "stacey_version");
            echo "/x3.min.js';
\tdocument.getElementsByTagName('head')[0].appendChild(s);
}
";
        }
        // line 28
        echo "</script>

";
        // line 31
        echo "<script src=\"";
        echo (isset($context["cdn_core"]) ? $context["cdn_core"] : null);
        echo "/js/";
        echo $this->getAttribute((isset($context["page"]) ? $context["page"] : null), "stacey_version");
        echo "/x3.min.js\" async";
        if ($this->getAttribute($this->getAttribute((isset($context["page"]) ? $context["page"] : null), "settings"), "cdn_core")) {
            echo " onerror=\"jsFail()\"";
        }
        echo " onload=\"imagevue";
        if ($this->getAttribute($this->getAttribute((isset($context["page"]) ? $context["page"] : null), "settings"), "cdn_core")) {
            echo "_";
        }
        echo "();\"></script>

";
        // line 34
        if ((!call_user_func_array($this->env->getTest('empty')->getCallable(), array(call_user_func_array($this->env->getFilter('trim')->getCallable(), array($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["page"]) ? $context["page"] : null), "back"), "custom"), "js"))))))) {
            // line 35
            echo "<script id=\"custom-javascript\">";
            echo call_user_func_array($this->env->getFilter('trim')->getCallable(), array($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["page"]) ? $context["page"] : null), "back"), "custom"), "js")));
            echo "</script>
";
        }
        // line 37
        echo "
</body>
</html>";
    }

    public function getTemplateName()
    {
        return "partials/footer.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  874 => 319,  858 => 316,  852 => 314,  849 => 313,  843 => 311,  837 => 309,  834 => 308,  828 => 305,  822 => 302,  815 => 299,  813 => 298,  808 => 295,  798 => 291,  786 => 287,  780 => 285,  774 => 283,  768 => 281,  762 => 279,  759 => 278,  754 => 277,  751 => 276,  745 => 272,  739 => 271,  735 => 269,  733 => 259,  730 => 257,  724 => 256,  718 => 254,  712 => 252,  706 => 250,  703 => 249,  699 => 248,  684 => 244,  678 => 242,  675 => 241,  672 => 240,  669 => 238,  666 => 237,  659 => 233,  651 => 231,  645 => 229,  643 => 228,  638 => 227,  635 => 226,  607 => 223,  604 => 221,  601 => 220,  598 => 219,  595 => 218,  592 => 217,  585 => 216,  582 => 215,  576 => 214,  573 => 213,  570 => 212,  567 => 210,  564 => 209,  561 => 208,  558 => 207,  555 => 206,  552 => 205,  549 => 204,  541 => 200,  538 => 199,  525 => 193,  521 => 191,  515 => 189,  512 => 188,  509 => 186,  506 => 185,  503 => 184,  497 => 183,  492 => 182,  487 => 181,  479 => 180,  474 => 179,  471 => 178,  468 => 176,  465 => 175,  457 => 171,  407 => 158,  399 => 157,  394 => 156,  391 => 155,  388 => 154,  385 => 153,  382 => 151,  379 => 150,  376 => 148,  373 => 147,  370 => 146,  367 => 145,  364 => 144,  355 => 141,  352 => 140,  349 => 139,  343 => 136,  340 => 135,  337 => 134,  334 => 133,  328 => 131,  325 => 130,  322 => 129,  319 => 127,  316 => 126,  313 => 125,  310 => 123,  307 => 122,  304 => 121,  301 => 120,  298 => 119,  295 => 117,  292 => 116,  286 => 114,  283 => 112,  280 => 111,  277 => 110,  274 => 108,  271 => 107,  268 => 106,  209 => 81,  189 => 78,  184 => 75,  181 => 74,  142 => 58,  139 => 56,  137 => 55,  134 => 53,  125 => 48,  122 => 47,  119 => 46,  102 => 40,  85 => 34,  82 => 32,  78 => 30,  67 => 26,  912 => 277,  898 => 276,  893 => 274,  890 => 273,  886 => 271,  883 => 270,  877 => 265,  871 => 263,  868 => 262,  865 => 260,  859 => 259,  856 => 258,  851 => 257,  846 => 256,  841 => 255,  836 => 254,  831 => 307,  824 => 252,  819 => 301,  816 => 250,  810 => 246,  804 => 293,  801 => 244,  795 => 290,  792 => 288,  787 => 241,  782 => 240,  777 => 239,  772 => 238,  765 => 237,  761 => 236,  752 => 235,  749 => 233,  746 => 232,  743 => 231,  740 => 230,  737 => 229,  734 => 228,  731 => 226,  728 => 225,  723 => 222,  708 => 221,  705 => 219,  700 => 216,  697 => 215,  690 => 247,  687 => 245,  681 => 243,  676 => 211,  671 => 210,  663 => 235,  655 => 208,  649 => 207,  641 => 206,  636 => 205,  633 => 204,  631 => 203,  623 => 200,  619 => 199,  615 => 197,  612 => 196,  609 => 195,  603 => 193,  600 => 192,  597 => 191,  594 => 190,  586 => 188,  583 => 187,  580 => 186,  577 => 185,  569 => 183,  566 => 182,  563 => 181,  557 => 179,  554 => 178,  546 => 203,  543 => 175,  535 => 198,  532 => 196,  529 => 195,  526 => 170,  523 => 169,  518 => 168,  484 => 167,  481 => 165,  478 => 164,  475 => 163,  472 => 162,  469 => 161,  466 => 160,  463 => 159,  459 => 157,  456 => 156,  453 => 170,  450 => 169,  447 => 168,  444 => 167,  441 => 165,  438 => 164,  435 => 148,  432 => 147,  429 => 163,  426 => 162,  423 => 161,  420 => 143,  417 => 160,  414 => 141,  412 => 159,  409 => 139,  406 => 138,  404 => 137,  401 => 136,  398 => 135,  395 => 133,  392 => 132,  389 => 131,  386 => 130,  383 => 128,  380 => 127,  377 => 126,  374 => 125,  371 => 124,  368 => 123,  365 => 122,  362 => 120,  359 => 119,  356 => 118,  353 => 117,  350 => 116,  347 => 115,  335 => 110,  332 => 109,  323 => 108,  317 => 106,  305 => 103,  297 => 102,  289 => 115,  278 => 99,  265 => 104,  262 => 103,  247 => 97,  235 => 92,  223 => 87,  220 => 86,  217 => 85,  214 => 84,  206 => 79,  203 => 73,  200 => 72,  197 => 71,  194 => 70,  185 => 67,  176 => 64,  173 => 62,  133 => 53,  131 => 52,  128 => 50,  124 => 48,  42 => 13,  361 => 143,  358 => 142,  351 => 139,  346 => 137,  344 => 114,  341 => 113,  338 => 112,  331 => 132,  327 => 127,  320 => 107,  314 => 123,  311 => 105,  308 => 120,  302 => 118,  299 => 117,  296 => 115,  290 => 113,  287 => 112,  284 => 100,  276 => 108,  273 => 107,  270 => 98,  267 => 104,  259 => 102,  253 => 99,  250 => 98,  244 => 96,  241 => 95,  238 => 94,  232 => 91,  229 => 90,  226 => 88,  221 => 87,  215 => 84,  211 => 82,  202 => 76,  183 => 73,  180 => 72,  177 => 72,  171 => 70,  159 => 65,  156 => 64,  153 => 63,  141 => 56,  126 => 49,  115 => 46,  112 => 45,  101 => 37,  98 => 36,  92 => 34,  74 => 28,  54 => 19,  172 => 70,  168 => 68,  165 => 67,  162 => 66,  117 => 45,  108 => 42,  105 => 41,  99 => 39,  84 => 36,  81 => 34,  60 => 21,  29 => 7,  64 => 26,  32 => 7,  120 => 46,  113 => 42,  96 => 37,  90 => 35,  49 => 18,  95 => 35,  71 => 27,  66 => 24,  63 => 19,  58 => 21,  56 => 20,  53 => 20,  44 => 14,  27 => 8,  282 => 106,  279 => 105,  269 => 99,  266 => 98,  264 => 97,  260 => 96,  256 => 100,  254 => 94,  249 => 91,  246 => 89,  243 => 87,  237 => 85,  234 => 84,  231 => 82,  225 => 80,  222 => 79,  218 => 85,  207 => 70,  182 => 66,  179 => 65,  163 => 56,  129 => 50,  123 => 47,  116 => 44,  110 => 48,  89 => 33,  86 => 32,  79 => 23,  69 => 27,  50 => 16,  46 => 16,  40 => 16,  22 => 3,  118 => 45,  114 => 44,  111 => 43,  107 => 54,  104 => 52,  93 => 37,  87 => 35,  76 => 21,  73 => 30,  62 => 23,  59 => 24,  51 => 19,  48 => 15,  45 => 14,  38 => 12,  36 => 11,  31 => 8,  26 => 5,  24 => 4,  21 => 2,  216 => 75,  213 => 77,  210 => 72,  208 => 75,  205 => 73,  201 => 68,  198 => 75,  195 => 69,  191 => 69,  188 => 68,  174 => 71,  170 => 61,  167 => 60,  164 => 59,  161 => 58,  158 => 56,  155 => 55,  152 => 61,  150 => 62,  147 => 61,  144 => 59,  138 => 54,  135 => 39,  132 => 52,  130 => 45,  127 => 44,  109 => 40,  106 => 39,  103 => 38,  100 => 38,  97 => 48,  94 => 41,  91 => 39,  88 => 34,  83 => 31,  80 => 30,  77 => 29,  75 => 29,  72 => 31,  70 => 26,  68 => 28,  65 => 25,  61 => 24,  57 => 19,  55 => 18,  52 => 19,  47 => 18,  43 => 17,  41 => 13,  39 => 12,  37 => 10,  35 => 10,  33 => 12,  30 => 6,  28 => 7,  25 => 5,  23 => 3,  19 => 1,);
    }
}
