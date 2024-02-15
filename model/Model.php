<?php
class Model
{

    private $name;
    private $blocks = [];

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getBlocks()
    {
        return $this->blocks;
    }

    public function setBlocks($blocks)
    {
        $this->blocks = $blocks;
    }

    public function __construct($blocks = [], $name = "Landing Page Constructor")
    {
        $this->name = $name;
        $this->blocks = $blocks;
    }

    public function generate()
    {
        $content = "";
        for ($i = 0; $i < count($this->blocks); $i++) {
            $content .= $this->blocks[$i]->draw();
        }
        return $template = <<<EOD
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>{$this->name}</title>
        <!-- Latest compiled and minified CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

        <!-- Latest compiled JavaScript -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    </head>
    <body>
        {$content}
    </body>
</html>
EOD;
    }

    public function achiving($dir)
    {
        // створюємо архів
        $zip = new ZipArchive(); // створюємо об'єкт для роботи з ZIP-архівами
        $arch = ".zip";
        $zip->open($dir . $arch, ZIPARCHIVE::CREATE | ZIPARCHIVE::OVERWRITE);
        $files = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator($dir), RecursiveIteratorIterator::LEAVES_ONLY
        );

        foreach ($files as $name => $file) {
            // пропускаємо каталоги (вони додадуться автоматично)
            if (!$file->isDir()) {
                // отримуємо реальний та відносний шляхи файлу
                $filePath = $file->getRealPath();
                $lendir = substr($dir, 3);
                $relativePath = strstr($filePath, $lendir);
                // додаємо поточний файл до архіву
                $zip->addFile($filePath, $relativePath);
            }
        }
        $zip->close(); // завершуємо роботу з архівом
    }

    public function upload($files, $uploaddir)
    {
        $message = "";

        $target_file = $uploaddir . basename($files["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // перевірка, чи є файл зображенням
        $check = @getimagesize($files["tmp_name"]);
        if ($check === false) {
            // $message = "Файл не є зображенням.";
            $uploadOk = 0;
        }

        // перевірка існування файла
        if (file_exists($target_file)) {
            $message = "Файл уже существует.";
            // $uploadOk = 0;
        }
        // перевірка розміру файлу
        if ($files["size"] > 50000000) {
            $message = "Файл занадто великий.";
            $uploadOk = 0;
        }
        // роздільна здатність певних файлових форматів
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
            $message = "Вибачте, дозволені тільки формати JPG, JPEG, PNG & GIF.";
            $uploadOk = 0;
        }
        // реревірка, чи встановлено $uploadOk в 0 (by an error) (помилка)
        if ($uploadOk == 0) {
            $message .= " Файл не був завантажений.";
            // якщо все гаразд, завантажуємо файл
        } else {
            if (move_uploaded_file($files['tmp_name'], $target_file)) {
                $message .= "Файл " . basename($files["tmp_name"]) . " був успішно завантажено.";
            } else {
                $message .= "При завантаженні файлу виникла помилка." . basename($files["tmp_name"]);
            }
        }

        return $message;
    }
}
