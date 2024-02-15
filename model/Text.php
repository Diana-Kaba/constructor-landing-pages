<?php
class Text extends Block
{
    private $text;

    public function __construct($text)
    {
        $this->text = $text;
    }
    public function draw()
    {
        $str = <<<EOD
     <!-------------Блок "Text"-------------------------->
    <div class='container mt-5'>
       <p>{$this->text}</p>
    </div>
    <!-------------Кінець блоку "Text"-------------------->\n
EOD;
        return $str;
    }
}
