<?php
require('fpdf17/fpdf.php');
$con=mysqli_connect('localhost','root','');
mysqli_select_db($con,'db_fast_shopping');


class PDF extends FPDF {
	function Header(){
		$this->SetFont('Arial','B',15);
		
		//dummy cell to put logo
		//$this->Cell(12,0,'',0,0);
		//is equivalent to:
		$this->Cell(12);
		
		//put logo
		$this->Image('logo-small.png',10,10,10);
		
		$this->Cell(100,10,'Thanks for Shopping from Fast Shopping',0,0);
		
		
		
		//dummy cell to give line spacing
		//$this->Cell(0,5,'',0,1);
		//is equivalent to:
		$this->Ln(30);
		$this->Cell(100,10,'Customer Order List',0,1);
		$this->SetFont('Arial','B',8);
		
		$this->SetFillColor(180,180,255);
		$this->SetDrawColor(180,180,255);
		$this->Cell(14,5,'Order ID',1,0,'',true);
		$this->Cell(47,5,'Customer Name',1,0,'',true);
		$this->Cell(20,5,'Order Total',1,0,'',true);
		$this->Cell(20,5,'Order Status',1,0,'',true);
		$this->Cell(55,5,'Payment Type',1,0,'',true);
		$this->Cell(32,5,'Payment Date',1,1,'',true);
		
	}
	function Footer(){
                
		//add table's bottom line
		$this->Cell(188,0,'','T',1,'',true);
		
		//Go to 1.5 cm from bottom
		$this->SetY(-15);
				
		$this->SetFont('Arial','',15);
		
		$this->Cell(100,10,'',0,0);
		//width = 0 means the cell is extended up to the right margin
		$this->Cell(0,10,'Page '.$this->PageNo()." / {pages}",0,0,'C');
	}
}


//A4 width : 219mm
//default margin : 10mm each side
//writable horizontal : 219-(10*2)=189mm

$pdf = new PDF('P','mm','A4'); //use new class

//define new alias for total page numbers
$pdf->AliasNbPages('{pages}');

$pdf->SetAutoPageBreak(true,15);
$pdf->AddPage();

$pdf->SetFont('Arial','',9);
$pdf->SetDrawColor(180,180,255);

//$query=mysqli_query($con,"SELECT o.* , c.*, p.* FROM tbl_order as o , tbl_customer as c , tbl_payment as p WHERE o.customer_id=c.customer_id AND o.order_id=p.order_id ");
$query=mysqli_query($con,"SELECT o.*, c.first_name, c.last_name, p.payment_type, p.payment_status,p.payment_date FROM tbl_order as o, tbl_customer as c, tbl_payment as p WHERE o.customer_id=c.customer_id AND o.order_id=p.order_id");
while($data=mysqli_fetch_array($query)){
        
	
        $pdf->Cell(14,5,$data['order_id'],'LR',0);
        
	$pdf->Cell(47,5,$data['first_name'] . ' ' . $data['last_name'],'LR',0);
        
            
        
        if($pdf->GetStringWidth($data['order_total']) > 65){
		$pdf->SetFont('Arial','',7);
		$pdf->Cell(20,5,$data['order_total'],'LR',0);
		$pdf->SetFont('Arial','',9);
	}else{
		$pdf->Cell(20,5,$data['order_total'],'LR',0);
	}
        
	$pdf->Cell(20,5,$data['order_status'],'LR',0);
        
	$pdf->Cell(55,5,$data['payment_type'],'LR',0);
	$pdf->Cell(32,5,$data['payment_date'],'LR',1);
        
        
}














$pdf->Output();
?>
