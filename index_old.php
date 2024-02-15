<?php
require "autoload.php";
$header = new Header("Створи Лендінг");
$text = new Text("Це лендінг");
$model = new Model([$header, $text], "Лендінг");
$str_land = $model->generate(); // генерація тексту лендинга
// echo $str_land;

$dir = "landing";
// mkdir($dir); // створення каталогу за вказаним шляхом
$f = fopen("{$dir}/index.html", "w+"); // створення файлу лендингу за вказаним шляхом
fwrite($f, $str_land); // запис в файл коду лендинга
fclose($f);
echo "<p>Лендінг успішно створено!</p>";

$zip = new ZipArchive(); // створюємо об'єкт для роботи із ZIP-архівами
$arch = "landing.zip";
$zip->open($arch, ZIPARCHIVE::CREATE);
echo "<p>Cтворюємо архів лендінгу " . $arch . ".</p>";
$file1 = "{$dir}/index.html";
$zip->addFile($file1);
$zip->close(); // завершуємо роботу з архівомecho "<a href=\"{$dir}/index.html\">Посмотреть результат</a>";
