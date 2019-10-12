<?php


namespace admin\app\models;


class HTMLDocument extends Model
{
    public $lang;
    public $title;
    public $root_tag;
    /* ['name' => <name>, 'root' => <root_tag>,
     * 'attr' => [<name> => <value>],
     * 'closed' => <is_closed(bool)>,
     *  ?'content' => <content>?]
     */
    public $tags = [];

    public function __construct($title, $lang)
    {
        $this->lang = $lang;
        $this->title = $title;
        
        $this->root_tag = "html";
    }

    public function createHead()
    {
        $this->root_tag = "head";
        return $this;
    }

    public function meta($name = null, $content = null, $http_equiv = null, $charset = null)
    {
        $attrs = [];
        //
        if ($name !== null)
            $tag['attr']['name'] = $name;
        if ($content !== null)
            $tag['attr']['content'] = $content;
        if ($http_equiv !== null)
            $tag['attr']['http-equiv'] = $http_equiv;
        if ($charset !== null)
            $attrs['charset'] = $charset;
        
        //
        $tag = ['name' => "link", 'root' => $this->root_tag, 'attr' => $attrs, 'closed' => false];
        $this->tags[] = $tag;

        return $this;
    }

    public function link($href, $rel = null, $type = null, $media = null, $as = null, $another_attr = [])
    {
        $another_attr['href'] = $href;
        $tag = ['name' => "link", 'root' => $this->root_tag, 'attr' => $another_attr, 'closed' => false];
        
        if ($rel !== null)
            $tag['attr']['rel'] = $type;
        if ($type !== null)
            $tag['attr']['type'] = $type;
        if ($media !== null)
            $tag['attr']['media'] = $media;
        if ($as !== null)
            $tag['attr']['as'] = $as;
        $this->tags[] = $tag;

        return $this;
    }

    public function script($script, $rel = null, $type = null, $async = false, $another_attr = [])
    {
        if (is_string($script))
        {
            $another_attr['src'] = $script;
            $tag = ['name' => "script", 'root' => $this->root_tag,
                'attr' => $another_attr, 'closed' => true
            ];
        }
        else
            $tag = ['name' => "script", 'root' => $this->root_tag,
                'attr' => $another_attr, 'content' => $script, 'closed' => true
            ];

        if ($rel !== null)
            $tag['attr']['rel'] = $type;
        if ($type !== null)
            $tag['attr']['type'] = $type;
        if ($async === true)
            $tag['attr']['async'] = null;
        $this->tags[] = $tag;

        return $this;
    }

    public function style($style, $rel = null, $type = null, $another_attr = [])
    {
        if (is_string($style))
        {
            $another_attr['href'] = $style;
            $tag = ['name' => "style", 'root' => $this->root_tag,
                'attr' => $another_attr, 'closed' => true
            ];
        }
        else
            $tag = ['name' => "style", 'root' => $this->root_tag,
                'attr' => $another_attr, 'content' => $style, 'closed' => true
            ];

        if ($rel !== null)
            $tag['attr']['rel'] = $type;
        if ($type !== null)
            $tag['attr']['type'] = $type;
        $this->tags[] = $tag;

        return $this;
    }

    public function renderHead()
    {
        $this->root_tag = "html";
        return $this;
    }


    public function createBody()
    {
        $this->root_tag = "body";
        return $this;
    }
    
    public function header($content, $class = null, $id = null)
    {
        $tag = ['name' => "header", 'root' => $this->root_tag, 'content' => $content];
        if ($class !== null)
            $tag['attr']['class'] = $class;
        if ($id !== null)
            $tag['attr']['id'] = $id;
        $this->tags[] = $tag;
        
        return $this;
    }

    public function main($content, $class = null, $id = null)
    {
        $tag = ['name' => "main", 'root' => $this->root_tag, 'content' => $content];
        if ($class !== null)
            $tag['attr']['class'] = $class;
        if ($id !== null)
            $tag['attr']['id'] = $id;
        $this->tags[] = $tag;

        return $this;
    }

    public function footer($content, $class = null, $id = null)
    {
        $tag = ['name' => "footer", 'root' => $this->root_tag, 'content' => $content];
        if ($class !== null)
            $tag['attr']['class'] = $class;
        if ($id !== null)
            $tag['attr']['id'] = $id;
        $this->tags[] = $tag;

        return $this;
    }

    public function renderBody()
    {
        $this->root_tag = "html";
        return $this;
    }

    public function rendering()
    {
        echo "<!doctype html>\n<html lang='{$this->lang}'>";
        $current_root_tag = "html";

        foreach ($this->tags as $tag)
        {
            if ($tag['root'] !== $current_root_tag)
            {
                echo "</$current_root_tag>\n";
                echo "<{$tag['root']}>";
            }

            $attrs = $this->arrayToString($tag['attr']);
            echo "\t<{$tag['name']} $attrs>";

            if (isset($tag['content']) && is_callable($content = $tag['content']))
                $content();
            else
                echo $content;

            echo "</{$tag['name']}>";
        }

        if ($current_root_tag !== "html")
            echo "</$current_root_tag>";
        echo "</html>";
    }

    private function arrayToString($arr)
    {
        $str = "";

        foreach ($arr as $attr_name => $attr_value)
            $str .= ($attr_value !== null) ? " $attr_name='$attr_value'" : " $attr_name";

        return $str;
    }
}