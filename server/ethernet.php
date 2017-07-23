<?php
/* Change to the correct path if you copy this example! */
require __DIR__ . '/autoload.php';
use Mike42\Escpos\Printer;
use Mike42\Escpos\PrintConnectors\NetworkPrintConnector;
$header  = $_COOKIE["NOM_SOCIETE"];
$Adresse = $_COOKIE["ADRESSE_SOCIETE"];
$printer = $_COOKIE["PRINTER"];
$TEL = "036669888";

try {
    $connector = new NetworkPrintConnector("192.168.0.52", 9100);
    $printer = new Printer($connector);
    $printer -> setJustification(Printer::JUSTIFY_CENTER);
$printer->selectPrintMode ( Printer::MODE_DOUBLE_HEIGHT );
$printer -> text("$header\n");
$printer->selectPrintMode ();
$printer -> text("$Adresse\n");
 $printer -> text("$TEL\n");
$printer -> text("$today\n");
$printer->selectPrintMode ();

$printer -> text("$TEL\n");
$printer -> text("------------------------------------------------");


  $printer -> setJustification(Printer::JUSTIFY_CENTER);
  $printer -> selectPrintMode(Printer::MODE_FONT_B);
  $printer->selectPrintMode ( Printer::MODE_DOUBLE_HEIGHT ,Printer::MODE_DOUBLE_WIDTH  );

$printer -> text("NUMERO \n");
$printer->selectPrintMode ( Printer::MODE_DOUBLE_HEIGHT | Printer::MODE_DOUBLE_WIDTH );
$printer -> text("$number \n");

    $printer -> cut();


    $printer -> close();
} catch (Exception $e) {
    echo "Couldn't print to this printer: " . $e -> getMessage() . "\n";
}
