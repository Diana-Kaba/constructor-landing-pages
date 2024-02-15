<?php
class Footer extends Block
{

    private $copyright, $logo_img, $width, $height;

    public function __construct($copyright = "&copy; 2024", $logo_img = "", $width = 40, $height = 40)
    {
        $this->copyright = $copyright;
        $this->logo_img = $logo_img;
        $this->width = $width;
        $this->height = $height;
    }

    public function draw()
    {
        if ($this->logo_img) {
            $img = "<img src=\"{$this->logo_img}\" alt=\"logo\" class=\"logo rounded-circle\" style=\"width:{$this->width}px; height: {$this->height}px;\"/>";
        } else {
            $img = "";
        }

        $str = <<<EOD
    <!-------------Блок "Footer"-------------------------->
    <div class="mt-5 p-4 bg-dark text-white">
    <div class="text-center">
    {$img}
    <p>{$this->copyright}</p>
    </div>
</div>
    <!-------------Кінець блока "Footer"-------------------->\n
EOD;
        return $str;
    }
}
