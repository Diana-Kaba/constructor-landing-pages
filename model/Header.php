<?php
class Header extends Block
{

    private $landing_header, $logo_img, $width, $height;

    public function __construct($landing_header = "Header", $logo_img = "", $width = 40, $height = 40)
    {
        $this->landing_header = $landing_header;
        $this->logo_img = $logo_img;
        $this->width = $width;
        $this->height = $height;
    }

    public function draw()
    {
        if ($this->logo_img) {
            $img = "<img src=\"{$this->logo_img}\" alt=\"logo\" class=\"rounded-circle\" style=\"width:{$this->width}px; height: {$this->height}px;\"/>";
        } else {
            $img = "";
        }

        $str = <<<EOD
    <!-------------Блок "Header"-------------------------->
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
  <div class="container-fluid d-flex justify-content-center">
    <a class="navbar-brand" href="#">
    {$img}
    </a>
  </div>
</nav>
<h1 class="mt-2 text-center">{$this->landing_header}</h1>
    <!-------------Кінець блока "Header"-------------------->\n
EOD;
        return $str;
    }
}
