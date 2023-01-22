<?php
if($_GET['hal'] == ''){
  include 'pages/dash.php';
} else if ($_GET['hal'] == 'dashboard') {
  include 'pages/dash.php';
} else if ($_GET['hal'] == 'laporan') {
  include 'pages/laporan.php';
}
