<?php
class Form extends Block
{
    private $value;

    public function __construct($value)
    {
        $this->value = $value;
    }

    public function draw()
    {
        $str = <<<EOD
     <!-------------Блок "Form"-------------------------->
    <div class="container mt-3">
  <h2>Ваша форма</h2>
  <form action="send.php" method="post">
  <input type="hidden" name="MAX_FILE_SIZE" value="30000">
    <div class="mb-3 mt-3">
      <label for="email">Email:</label>
      <input type="email" class="form-control" id="email" placeholder="Enter email" name="email">
    </div>
    <div class="mb-3">
    <div class="mb-3 mt-3">
    <label for="name">Ім'я:</label>
    <input type="text" class="form-control" id="name" placeholder="Ваше ім'я" name="name">
  </div>
    </div>
    <input type="submit" class="btn btn-primary" name="submitB" value="{$this->value}">
  </form>
</div>
    <!-------------Кінець блока "Form"-------------------->\n
EOD;
        return $str;
    }
}
