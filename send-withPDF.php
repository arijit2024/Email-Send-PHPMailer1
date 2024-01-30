<?php
// Include PHPMailer classes into the global namespace
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';

// Include FPDF library
require('fpdf/fpdf.php');

// Create a PDF class based on FPDF
class PDF extends FPDF
{
 function Header()
    {
         // Add an image
        // $this->Image('../assets/images/mmsLogo.png', 10, 8, 15);

        // Set font
        $this->SetFont('Arial', 'B', 12);

        // Move to the right
        $this->Cell(80);

        // Add a centered title
        $this->Cell(30, 10, 'INVOICE', 0, 0, 'C');

        // Move to the right
        $this->Cell(53);

        $this->SetFont('times', '', 10);

        $this->Cell(0, 10, '12/22/1999', 0, 0, 'R');

        $this->Ln();

        $this->SetFont('times', '', 10);

        $this->Cell(0, 25, '32G/1B, Haramohan Ghosh Lane,', 0, 0, 'L');

        $this->Ln(5);

        $this->Cell(0, 25, 'Kolkata - 700085,', 0, 0, 'L');

        $this->Ln(5);

        $this->Cell(0, 25, 'brainwebinfosolutions@gmail.com,', 0, 0, 'L');

        $this->Ln(5);

        $this->SetFont('times', '', 12);

        $this->Cell(0, 35, 'BILL TO:', 0, 0, 'L');

        $this->Cell(115);

        $this->Cell(0, 36, 'DHAKURIA RAMCHANDRA HIGH SCHOOL', 0, 0, 'R');

        $this->Ln(5);

        $this->SetFont('times', '', 12);

        $this->Cell(0, 35, 'CUSTOMER NAME:', 0, 0, 'L');

        $this->Cell(115);

        $this->Cell(0, 36, 'DHAKURIA RAMCHANDRA HIGH', 0, 0, 'R');
        
        $this->Ln(22);
        
        $this->Cell(0,0, 'ADDRESS:', 0, 0, 'L');
        
        $this->Ln(10);
         
        $this->Line(10, $this->GetY(), 200, $this->GetY());
        
        $this->Ln();

        $this->Cell(130, 10, 'DESCRIPTION', 1, 0, 'C'); 
        $this->Cell(60, 10, 'AMOUNT', 1, 0, 'C');

        $this->Ln();

        $this->Cell(30, 10, 'AMOUNT', 1, 0, 'C'); 
        $this->Cell(130, 10, 'DESCRIPTION', 1, 0, 'C');
        $this->Cell(30, 10, 'AMOUNT', 1, 0, 'C');

        $this->Ln();


        $this->Cell(30, 10, 'AMOUNT', 1, 0, 'C'); 
        $this->Cell(130, 10, 'DESCRIPTION', 1, 0, 'C');
        $this->Cell(30, 10, 'AMOUNT', 1, 0, 'C');

        $this->Ln();


        $this->Cell(130, 10, 'DESCRIPTION', 1, 0, 'C');
        $this->Cell(30, 10, 'AMOUNT', 1, 0, 'C'); 
        $this->Cell(30, 10, 'AMOUNT', 1, 0, 'C');

        $this->Ln();

        $this->Cell(100, 30, 'Left Column', 1, 0, 'C'); 
    
        $this->Cell(90, 10, 'Row 1', 1, 1, 'C');
        
        $this->Cell(100);
        $this->Cell(45, 10, 'Column 1', 1, 0, 'C'); 
        $this->Cell(45, 10, 'Column 2', 1, 1, 'C'); 

    
        $this->Cell(100);
        $this->Cell(45, 10, 'Column 1', 1, 0, 'C'); 
        $this->Cell(45, 10, 'Column 2', 1, 1, 'C'); 
        
        
        $this->Cell(30, 10, 'AMOUNT', 1, 0, 'C'); 
        $this->Cell(70, 10, 'DESCRIPTION', 1, 0, 'C');
        $this->Cell(45, 10, 'AMOUNT', 1, 0, 'C');
        $this->Cell(45, 10, 'AMOUNT', 1, 0, 'C');

        $this->Ln(22);
        
        $this->Cell(0,0, 'Payment made by Cheque/Cash in favour of: ', 0, 0, 'L');
        $this->Cell(0,0, 'abcdxyz', 0, 0, 'R');
        
        $this->Ln(25);
        
        $this->Cell(0,0, 'Authorised Signatory', 0, 0, 'R');
        
        $this->Ln(30);
        
        $this->Cell(0,0, 'Thank you for your kind cooperation', 0, 0, 'C');
        
        $this->Ln(10);
        
        $this->Cell(0,0, 'This is computer generated invoice, does not require any signature', 0, 0, 'C');
    }

    // Footer function
    function Footer()
    {
        // Position at 1.5 cm from the bottom
        $this->SetY(-15);

        // Set font
        $this->SetFont('Arial', 'I', 8);

        // Add a page number
        $this->Cell(0, 10, 'Page ' . $this->PageNo(), 0, 0, 'C');
    }
}

// Create a new PDF instance
$pdf = new PDF();

// Add a page with a fixed width and height
$pdf->AddPage('P', array(210, 297)); // 'P' for portrait mode, and (210, 297) is the page size in millimeters

// Set font
$pdf->SetFont('Arial', '', 12);

// Output the PDF content
$pdfContent = $pdf->Output('', 'S'); // 'S' parameter returns the PDF as a string

// Create a PHPMailer instance
$mail = new PHPMailer(true);

try {
    // Server settings
    $mail->isSMTP(); // Send using SMTP
    $mail->Host       = 'smtp.gmail.com'; // Set the SMTP server to send through
    $mail->SMTPAuth   = true; // Enable SMTP authentication
    $mail->Username   = 'arijitsarkar1998x@gmail.com'; // SMTP username
    $mail->Password   = 'Password'; // SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; // Enable implicit TLS encryption
    $mail->Port       = 465; // TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    // Recipients
    $mail->setFrom('arijitsarkar1998x@gmail.com', 'Arijit');
    $mail->addAddress('arijitsarkar2111@gmail.com', 'arijit2'); // Add a recipient

    // Attach the PDF
    $mail->addStringAttachment($pdfContent, 'invoice.pdf', 'base64', 'application/pdf');

    // Content
    $mail->isHTML(true); // Set email format to HTML
    $mail->Subject = 'Invoice Attached';
    $mail->Body    = 'Please find the attached invoice PDF.';

    // Send the email
    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
?>
