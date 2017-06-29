<?php
$file = 'schools.json';

if (file_exists($file)) {
    $filedata = file_get_contents($file);
    $obj = json_decode($filedata, true);

    if (isset($_GET['submit'])) {
        $name = $_GET['name'];
        $opleiding = $_GET['opleiding'];

        $courses = explode(', ', $opleiding);

        $obj['schools'][$name]['category'] = $_GET['categorie'];
        $obj['schools'][$name]['nr_students'] = $_GET['studenten'];
        $obj['schools'][$name]['courses'] = $courses;

        $fp = fopen($file, 'w');
        fwrite($fp, json_encode($obj));
        fclose($fp);
    }

    print '<pre>';
    print_r($obj);
    print '</pre>';

    foreach ($obj['schools'] as $key => $school) {
        echo $key.'<br>';
        echo $school['category'].'<br>';
        echo $school['nr_students'].'<br>';
        print_r(implode(', ', $school['courses']));
        echo '<br><br>';
    }

} else {
    echo $file . " does not exist";
}