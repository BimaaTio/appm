<?php
if($_GET['hal'] == ''){
  include 'pages/dash.php';
} else if($_GET['hal'] == 'laporan'){
  include 'pages/laporan.php';
} 