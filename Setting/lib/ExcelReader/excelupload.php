<? include ("../../include/config2.inc.php");?>
<?php
require_once 'Excel/reader.php';
$data = new Spreadsheet_Excel_Reader();
$data->setOutputEncoding('CP949');

$savedir = "../../upload/";
$fname1 = $_FILES[fname1][name];
$file_type = $_FILES[fname1][type];
$tmp = $_FILES[fname1][tmp_name];

if(!$fname1) $fname1='null';
else {
	$fname1_var = $objfile -> fileUp($tmp, $fname1, $savedir, $file_type);
	$fname1_name = $fname1_var[0];
}
if (!empty($fname1_name)){
	$data->read($savedir.$fname1_name);
	error_reporting(E_ALL ^ E_NOTICE);
	echo "<table border=1>";
	for ($i = 1; $i <= $data->sheets[0]['numRows']; $i++) {
				 echo "<tr>";
				 for ($j = 1; $j <= $data->sheets[0]['numCols']; $j++) {
								echo "<td>&nbsp;".$data->sheets[0]['cells'][$i][$j]."</td>";
				 }
				 echo "</tr>\n";
	}
	echo "</table>";
}


//파일두번째
$fname2 = $_FILES[fname2][name];
$file_type = $_FILES[fname2][type];
$tmp = $_FILES[fname2][tmp_name];

if(!$fname2) $fname2='null';
else {
	$fname2_var = $objfile -> fileUp($tmp, $fname2, $savedir, $file_type);
	$fname2_name = $fname2_var[0];
}
if (!empty($fname2_name)){
	$data->read($savedir.$fname2_name);
	error_reporting(E_ALL ^ E_NOTICE);
	echo "<table border=1>";
	for ($i = 1; $i <= $data->sheets[0]['numRows']; $i++) {
				 echo "<tr>";
				 for ($j = 1; $j <= $data->sheets[0]['numCols']; $j++) {
								echo "<td>&nbsp;".$data->sheets[0]['cells'][$i][$j]."</td>";
				 }
				 echo "</tr>\n";
	}
	echo "</table>";
}


//파일세번째
$fname3 = $_FILES[fname3][name];
$file_type = $_FILES[fname3][type];
$tmp = $_FILES[fname3][tmp_name];

if(!$fname3) $fname3='null';
else {
	$fname3_var = $objfile -> fileUp($tmp, $fname3, $savedir, $file_type);
	$fname3_name = $fname3_var[0];
}
if (!empty($fname3_name)){
	$data->read($savedir.$fname3_name);
	error_reporting(E_ALL ^ E_NOTICE);
	echo "<table border=1>";
	for ($i = 1; $i <= $data->sheets[0]['numRows']; $i++) {
				 echo "<tr>";
				 for ($j = 1; $j <= $data->sheets[0]['numCols']; $j++) {
								echo "<td>&nbsp;".$data->sheets[0]['cells'][$i][$j]."</td>";
				 }
				 echo "</tr>\n";
	}
	echo "</table>";
}
?>
