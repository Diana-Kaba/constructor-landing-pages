<?php
session_start();
require "../autoload.php";

class Controller
{
    private $dir;
    private $uploaddir;

    public function __construct($dir)
    {
        $this->dir = $dir;
        $this->uploaddir = $dir . "/images/";
        if (!is_dir($this->dir)) {
            mkdir($this->dir); // створення каталогу 'landing'
        }
        if (!is_dir($this->uploaddir)) {
            mkdir($this->uploaddir);
        }
        // створення  каталогу 'landing/images'
    }

    public function action()
    {
        $blocks = [];
        ob_start();

        /* створення блоків */
        if ($_POST['header']) {
            if ($_FILES["logo"]["name"]) {
                $img = "images/" . $_FILES["logo"]["name"];
            } else {
                $img = "";
            }
            $header = new Header($_POST['header'], $img, $_POST['logo-width'], $_POST['logo-height']);
            $blocks[] = $header;
        }

        if ($_POST['form']) {
            $form = new Form($_POST['form']);
            $blocks[] = $form;
        }

        if ($_POST['text']) {
            $text = new Text($_POST['text']);
            $blocks[] = $text;
        }

        if ($_POST['size'] && isset($_FILES['images']["name"])) {
            $size = $_POST['size'];
            $imgs = [];
            for ($i = 0; $i < $size; $i++) {
                $imgs[] = "images/" . $_FILES["images"]["name"][$i];
            }
            for ($i = 0; $i < count($imgs); $i++) {
                if (is_uploaded_file($imgs[$i])) {
                    move_uploaded_file($imgs[$i], $this->uploaddir . basename($imgs[$i]));
                }
            }
            $slider = new Slider($imgs, $size);
            $blocks[] = $slider;
        }

        if ($_POST['footer']) {
            if ($_FILES["logo"]["name"]) {
                $img = "images/" . $_FILES["logo"]["name"];
            } else {
                $img = "";
            }
            $footer = new Footer($_POST['footer'], $img, $_POST['logo-width'], $_POST['logo-height']);
            $blocks[] = $footer;
        }

        /* створення моделі */
        if ($_POST['title']) {
            $model = new Model($blocks, $_POST['title']);
        } else {
            $model = new Model($blocks);
        }

        /* робота с моделлю */
        $str_land = $model->generate(); // генерація тексту лендінгу
        $path = "{$this->dir}/index.html";
        $f = fopen($path, "w+"); // створення файлу лендінгу по вказаному шляху
        fwrite($f, $str_land); // запис в файл лендінгу
        fclose($f);

        if ($_FILES["logo"]["name"]) {
            $model->upload($_FILES["logo"], $this->uploaddir);
        }

        $model->achiving($this->dir);

        header("Location: ../index.php");
        ob_flush();
    }
}

$controller = new Controller('../landing');
$controller->action();
