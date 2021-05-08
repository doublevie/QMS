<?php
/* Change to the correct path if you copy this example! */
require __DIR__ . '/autoload.php';
use Mike42\Escpos\Printer;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
use Mike42\Escpos\PrintConnectors\NetworkPrintConnector;
use Mike42\Escpos\EscposImage;


$ini = parse_ini_file("../conf/qms.ini");
$header  = $ini["NOM_SOCIETE"];
$Adresse = $ini["ADRESSE_SOCIETE"];
$printer = $ini["PRINTER"];
$valid = preg_match('/^\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}\z/', $printer);
$logo = 'logo.png';

$TEL = "";

try {

    if ($valid == 1) {
        $connector = new NetworkPrintConnector("$printer" , 9100);
      
      } else {
      
        $connector = new WindowsPrintConnector("$printer");
      }

    $printer = new Printer($connector);
    $printer -> setJustification(Printer::JUSTIFY_CENTER);
      $tux = EscposImage::load($logo, false);
    $printer -> bitImage($tux);




$printer -> text("------------------------------------------------");


  $printer -> setJustification(Printer::JUSTIFY_CENTER);
  $printer -> selectPrintMode(Printer::MODE_FONT_B);
  $printer->selectPrintMode ( Printer::MODE_DOUBLE_HEIGHT ,Printer::MODE_DOUBLE_WIDTH  );

$printer -> text("NUMERO \n");
$printer->selectPrintMode ( Printer::MODE_DOUBLE_HEIGHT | Printer::MODE_DOUBLE_WIDTH );
$printer->setFont (Printer::FONT_C  );
$printer -> text("$srv-$number \n");
$printer->selectPrintMode();
$printer -> text("$today\n");
    $printer -> cut();


    $printer -> close();
} catch (Exception $e) {
    echo "Couldn't print to this printer: " . $e -> getMessage() . "\n";
}
