<?php
session_start();

if (!isset($_SESSION['selected_blocks'])) {
    $_SESSION['selected_blocks'] = [];
}

if (isset($_POST['save']) && isset($_POST['block_type'])) {
    $_SESSION['selected_blocks'] = array_merge($_SESSION['selected_blocks'], $_POST['block_type']);
}

if (isset($_POST['submit'])) {
    $_SESSION['selected_blocks'] = [];
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Конструктор Landing page</title>
    <!-- Latest compiled and minified CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        a {
            text-decoration: none;
        }
    </style>
</head>
<body>
<?php
function checkImgsCount($imagesCount, $uploadedImagesCount)
{
    if ($imagesCount != $uploadedImagesCount) {
        echo "<div class='alert alert-danger mt-3'><strong>Помилка!</strong> Кількість зображень не збігається!</div>";
    }
}
?>
    <div class="p-4 bg-primary text-white text-center">
        <h1 class="text-center">Конструктор Landing page</h1>
    </div>
<div class="container mt-5">
  <h2>Контент твого майбутнього сайту</h2>
  <p>На цій сторінці ви можете згенерувати сайт за своїми параметрами. Для цього <mark>заповніть форму</mark>, обравши тип блоків, а також ввівши необхідну інформацію в кожен блок.</p>

<form name="set" action="<?=$_SERVER['PHP_SELF']?>" method="post">

  <div class="input-group mb-3">
    <div class="input-group-text">
      <input type="checkbox" name="block_type[]" value="header">
    </div>
    <input type="text" class="form-control" placeholder="Header (з логотипом)" name="header">
  </div>

  <div class="input-group mb-3">
    <div class="input-group-text">
      <input type="checkbox" name="block_type[]" value="form">
    </div>
    <input type="text" class="form-control" placeholder="Форма" name="form">
  </div>

  <div class="input-group mb-3">
    <div class="input-group-text">
      <input type="checkbox" name="block_type[]" value="txt">
    </div>
    <input type="text" class="form-control" placeholder="Текстовий контент" name="txt">
  </div>

  <div class="input-group mb-3">
    <div class="input-group-text">
      <input type="checkbox" name="block_type[]" value="slider">
    </div>
    <input type="text" class="form-control" placeholder="Слайдер" name="slider">
  </div>

  <div class="input-group mb-3">
    <div class="input-group-text">
      <input type="checkbox" name="block_type[]" value="footer">
    </div>
<input type="text" class="form-control" placeholder="Footer" name="footer">
  </div>

  <div class="input-group mb-3">
      <input type="submit" class="btn btn-primary" value="Зберегти" name="save">
    </div>

</form>

  <form enctype="multipart/form-data" action="controller/controller.php" method="post">
    <div class="input-group mb-3">
      <span class="input-group-text">Title сторінки*</span>
      <input type="text" class="form-control" placeholder="Уведіть title сторінки" name="title" required>
    </div>

    <div class="input-group mb-3">
      <span class="input-group-text">Заголовок сторінки*</span>
      <input type="text" class="form-control" placeholder="Уведіть заголовок сторінки" name="header" required>
    </div>

    <?php
if (isset($_POST['save'])) {
    $selected_blocks = $_SESSION['selected_blocks'];

    foreach ($selected_blocks as $block) {
        switch ($block) {
            case 'header':
                echo '<div class="input-group mb-3">
                        <span class="input-group-text">Логотип*</span>
                        <input type="file" class="form-control" placeholder="Оберіть зображення логотипу" name="logo" required>
                        <input type="hidden" name="MAX_FILE_SIZE" value="30000">
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text">Розміри логотипу <b> (у px)</b></span>
                        <input type="number" class="form-control" placeholder="Уведіть ширину логотипу" name="logo-width">
                        <input type="number" class="form-control" placeholder="Уведіть висоту логотипу" name="logo-height">
                    </div>';
                break;

            case 'form':
                echo '<div class="input-group mb-3">
                        <span class="input-group-text">Call to action</span>
                        <input type="text" class="form-control" placeholder="Уведіть назву кнопки" name="form">
                    </div>';
                break;

            case 'txt':
                echo '<div class="input-group mb-3">
                        <span class="input-group-text">Текст сторінки*</span>
                        <textarea class="form-control" rows="5" id="comment" name="text" placeholder="Уведіть текст сторінки"></textarea>
                    </div>';
                break;

            case 'slider':
                echo '<div class="input-group mb-3">
                        <span class="input-group-text">Кількість зображень у слайдері</b></span>
                        <input type="number" class="form-control" placeholder="Уведіть кількість зображень" name="size">
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text">Зображення в слайдері  <b> (JPG, PNG)</b></span>
                        <input type="file" multiple class="form-control" placeholder="Оберіть зображення" name="images[]">
                        <input type="hidden" name="MAX_FILE_SIZE" value="30000">
                    </div>';
                break;

            case 'footer':
                echo '<div class="input-group mb-3">
                        <span class="input-group-text">Copyright сторінки*</span>
                        <input type="text" class="form-control" placeholder="Уведіть copyright сторінки" name="footer" required>
                    </div>';
                break;
        }
    }
}
?>

    <div class="input-group mb-3">
      <input type="submit" class="btn btn-primary" value="Сгенерувати" name="submit" id="ok">
    </div>

    <div class="alert alert-info">
<strong>Уважно!</strong> <b>*</b> поля, <mark>обов'язкові</mark> для заповнення.</a>
</div>

    <h3>Результат</h3>
    <button class="btn btn-primary"><a href='landing/index.html' target="_blank" class="text-light"> Переглянути результат у новому вікні </a></button>
    <button class="btn btn-primary"><a href='landing.zip' download class="text-light">Завантажити архів</a>
</button>
  </form>
      <?php
if (isset($_POST['submit'])) {
    checkImgsCount($_POST['size'], $_FILES['images']['name']);
}
?>
</div>

<div class="container mt-5">
<iframe width="800" height="400" src="landing/index.html"></iframe>

</div>
<div class="mt-5 p-4 bg-dark text-white text-center">
  <p>&copy; Конструктор Landing page. Усі права захищені.</p>
</div>
</body>
</html>
