<?php
require_once("models/paymentModel.php");
require_once("lib/TCPDF-master/tcpdf.php");

class PaymentController
{
    private $email;
    private $fullname;
    private $paymentprovider;
    private $tickets;
    private $customerID;
    private $totalPrice;


    function __construct($fullname, $email, $paymentprovider, $totalPrice)
    {
        $this->email = $email;
        $this->fullname = $fullname;
        $this->paymentprovider = $paymentprovider;
        $this->totalPrice = $totalPrice;

        $this->tickets = array();

        //transfer session to new tickets array format
        for ($i = 0; $i < count($_SESSION); $i++) {
            array_push($this->tickets, array(
                "ticket" . $i => $_SESSION["ticket" . $i]["ticketID"],
                "name" . $i => $_SESSION["ticket" . $i]["name"],
                "price" . $i => $_SESSION["ticket" . $i]["price"],
                "time" . $i => $_SESSION["ticket" . $i]["time"],
                "amount" . $i => $_SESSION["ticket" . $i]["amount"]
            ));
        }
    }

    function pay()
    {
        //set variables for transaction
        $paymentModel = new PaymentModel();
        $this->customerID = $paymentModel->getCustomerId($this->email, $this->fullname);
        $timestamp = date("Y-m-d H:m:s");

        //foreach ticket set vars and transfer
        for ($i = 0; $i < count($_SESSION); $i++) {
            $ticketID = $this->tickets[$i]["ticket" . $i];
            $amount = $this->tickets[$i]["amount" . $i];
            $price = $this->tickets[$i]["price" . $i];
            $paymentModel->confirmPayment($ticketID, $this->customerID, $timestamp, $amount, $price);
        }
    }

    function createPdf()
    {
        $pdf = new TCPDF();

        for ($i = 0; $i < count($this->tickets); $i++) {
            $pdf->addPage();

            $barcode = "{$this->tickets[$i]['ticket' . $i]} {$this->customerID} {$this->tickets[$i]['amount' . $i]}";
            //$barcode = $pdf->serializeTCPDFtagParameters(array($barcode, 'C128', '', '', 72, 25, 0.5, array('position'=>'S', 'border'=>false, 'padding'=>2, 'fgcolor'=>array(0,0,0), 'bgcolor'=>array(255,255,255), 'text'=>true, 'font'=>'helvetica', 'fontsize'=>7, 'stretchtext'=>6), 'N'));

            $html = "
            <ul>
                <li>Name: {$this->tickets[$i]['name' . $i]}</li>
                <li>Time: {$this->tickets[$i]['time' . $i]}</li>
                <li>Quantity: {$this->tickets[$i]['amount' . $i]}</li>
                <li>Price: € {$this->tickets[$i]['price' . $i]}</li>
            </ul>
            <style>
            ul {
                list-style-type: none;
                padding: 0;
                margin: 0;
            }
            </style>
            ";

            //line spacing
            $pdf->Ln(2);

            //write html
            $pdf->writeHTML($html);

            //line spacing
            $pdf->Ln(2);

            //write barcode
            $pdf->write1DBarcode($barcode, "C39");
        }

        session_start();

        // ob_end_clean();
        $_SESSION["pdfstring"] = "/home/thomaur292/domains/haarlem-festival.nl/private_html/{$barcode}{$this->email}.pdf";
        $pdf->Output("/home/thomaur292/domains/haarlem-festival.nl/private_html/{$barcode}{$this->email}.pdf", "FD");
    }
}
?>