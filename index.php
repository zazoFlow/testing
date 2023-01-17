<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>TEST</title>
    <style>
      body {
        margin: 0;
        background-color: #eee;
      }
      fieldset {
        width: fit-content;
        margin: auto;
        background-color: wheat;
      }
      input[type="submit"] {
        background-color: gray;
        border: none;
        padding: 5px 10px;
        color: #fff;
      }
      .my {
        width: fit-content;
        margin: auto;
        background-color: #fff;
        margin-top: 50px;
      }
      .my p {
        margin: 0;
        padding: 5px 10px;
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
      }
      .my p.bg-color {
        background-color: #ddd;
      }
    </style>
  </head>
  <body>
    <fieldset>
      <legend>Inscrire</legend>
      <form action="" method="post">
        <input type="text" name="name" id="name" />
        <input type="email" name="email" id="email" />
        <input type="submit" value="Enregistrer" />
      </form>
    </fieldset>

    <div class="my"></div>
  </body>
  <script type="module">
    import data from "./fileHTML.json" assert { type: "json" };
    let my = document.querySelector(".my");
    for (let i = 1; i < data.length; i += 2) {
      my.innerHTML += data[i];
    }
  </script>
</html>

<?php
  if (!empty($_POST["name"]) && !empty($_POST["email"])) {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $rep = true;
    $class = "";

    $file_html = fopen("fileHTML.json", "r");
    $lst = json_decode(fread($file_html, 500000));
    fclose($file_html);
    
    foreach ($lst as $v) {
      if ($v === $name) {
        $rep = false;
        break;
      }
    }
    
    if ($rep) {
      if ((count($lst) / 2) % 2 === 0) {
          $class = "bg-color";
      }
      $p = "<p class='$class'> <spam>$name</spam> <spam>$email</spam> </p>";
      
      array_push($lst, $name);
      array_push($lst, $p);
      
      $file_html = fopen("fileHTML.json", "w");
      fwrite($file_html, json_encode($lst));
      fclose($file_html);
    }
  }
?>