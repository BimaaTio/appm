<?php
if ($_GET['hal'] == '') {
  include 'pages/dash.php';
} else if ($_GET['hal'] == 'form') {
  include 'pages/form.php';
} else if ($_GET['hal'] == 'laporan-saya') {
  include 'pages/laporan.php';
}
