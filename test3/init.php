<?php
include __DIR__.'/db.php';
include __DIR__.'/CSVClass.php';

$csves = CSVClass::getCSV();
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['csv']['tmp_name'])){
    if(file_exists($_FILES['csv']['tmp_name']) &&  $fl = fopen($_FILES['csv']['tmp_name'],'r')){
        $arr = array();
        while (!feof($fl)){
            $arr[] = new CSVClass(fgets($fl,8024));
        }

        foreach ($csves as $csv){
            $csv->checked($arr);
        }

    }
}