<?php
if (isset($_POST) && !empty($_POST)) {
    $data = $_POST['data'];
    $t = time() . '.json';
    $myfile = fopen($t, "w");
    fwrite($myfile, $data);
    fclose($myfile);
    shell_exec("python main.py $t");
    unlink($t);
}
