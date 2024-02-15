<?php
class Slider extends Block
{
    private $images, $size;

    public function __construct($images = [], $size = 0)
    {
        $this->images = $images;
        $this->size = $size;
    }

    public function draw()
    {
        $str =
            '<!-------------Блок "Carousel"-------------------------->
     <div class="container mt-3">
     <div id="demo" class="carousel slide" data-bs-ride="carousel">

       <!-- Indicators/dots -->
       <div class="carousel-indicators">';
        for ($i = 0; $i < $this->size; $i++) {
            $str .= '<button type="button" data-bs-target="#demo" data-bs-slide-to="' . $i . '" ';
            if ($i == 0) {
                $str .= 'class="active"';
            }
            $str .= '></button>';
        }
        $str .= '</div>';

        $str .= '<!-- The slideshow/carousel -->
        <div class="carousel-inner">';
        for ($i = 0; $i < $this->size; $i++) {
            $str .= '<div class="carousel-item';
            if ($i == 0) {
                $str .= ' active';
            }
            $str .= '">
                    <img src="' . $this->images[$i] . '" alt="Carousel item ' . $i . '" class="d-block" style="width:100%">
                </div>';
        }
        $str .= '</div>';

        $str .=
            '
       <!-- Left and right controls/icons -->
       <button class="carousel-control-prev" type="button" data-bs-target="#demo" data-bs-slide="prev">
         <span class="carousel-control-prev-icon"></span>
       </button>
       <button class="carousel-control-next" type="button" data-bs-target="#demo" data-bs-slide="next">
         <span class="carousel-control-next-icon"></span>
       </button>
     </div>
     </div>
    <!-------------Кінець блока "Carousel"-------------------->';
        return $str;
    }
}
