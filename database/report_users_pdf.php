<?php

require('fpdf/fpdf.php');

class PDF extends FPDF
{
    function __construct(){
        parent::__construct('L');
    }

    // Colored table
    function FancyTable($header, $data)
    {
        // Colors, line width and bold font
        
        $this->SetFillColor(255,0,0);
        $this->SetTextColor(255);
        $this->SetDrawColor(128,0,0);
        $this->SetLineWidth(.3);
        $this->SetFont('','B'); 

        // Header
        $w = array(45, 50, 65, 60, 55);
        for($i=0;$i<count($header);$i++)
            $this->Cell($w[$i],7,$header[$i],1,0,'C',true);
        $this->Ln();
        // Color and font restoration
        $this->SetFillColor(224,235,255);
        $this->SetTextColor(0);
        $this->SetFont('');
        // Data
        $fill = false;
        foreach($data as $row)
        {
            $this->Cell($w[0],6,$row[0],'LR',0,'C',$fill);
            $this->Cell($w[1],6,$row[1],'LR',0,'C',$fill);
            $this->Cell($w[2],6,$row[2],'LR',0,'C',$fill);
            $this->Cell($w[3],6,$row[3],'LR',0,'C',$fill);
            $this->Cell($w[4],6,$row[4],'LR',0,'C',$fill);
            $this->Ln();
            $fill = !$fill;
        }
        // Closing line
        $this->Cell(array_sum($w),0,'','T');
    }
}

$type = $_GET['report'];
$report_users_headers = [
    'user' => 'Users Report'
];

include('connection.php');
    
if($type == 'user'){
    $header = array('FIRST NAME', 'LAST NAME', 'email', 'Created at', 'Updated at');

    $stmt = $conn->prepare("SELECT first_name, last_name, email, created_at, updated_at FROM users ORDER BY created_at DESC");
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);

    $users = $stmt->fetchAll();

    $data = [];
    foreach($users as $user){

        array_walk($user, function(&$str){
            $str = preg_replace("/\t/", "\\t", $str);
            $str = preg_replace("/\r?\n/", "\\n", $str);
            if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"';
        });

        $data[] = [
            $user['first_name'],
            $user['last_name'],
            $user['email'],
            $user['created_at'],
            $user['updated_at'],
        ];
    }
}   

$pdf = new PDF();
$pdf->SetFont('Arial','',20);
$pdf->AddPage();

$pdf->Cell(125);
$pdf->Cell(30,10,$report_users_headers[$type],0,0,'C');
$pdf->SetFont('Arial','',14);
$pdf->Ln();
$pdf->Ln();
$pdf->FancyTable($header,$data);
$pdf->Output();
?>