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
		$this->Cell(100,10,'Your Payment List',0,1);
		$this->SetFont('Arial','B',8);
		
		$this->SetFillColor(180,180,255);
		$this->SetDrawColor(180,180,255);
		$this->Cell(17,5,'Payment ID',1,0,'',true);
		$this->Cell(47,5,'Customer Name',1,0,'',true);
		$this->Cell(30,5,'Product Name',1,0,'',true);
		$this->Cell(15,5,'Quantity',1,0,'',true);
		$this->Cell(25,5,'Payment Total',1,0,'',true);
		
		$this->Cell(35,5,'Payment Date',1,0,'',true);
		$this->Cell(28,5,'Mobile Number',1,1,'',true);
		
	}
	function Footer(){
                
		//add table's bottom line
		$this->Cell(197,0,'','T',1,'',true);
		
		//Go to 1.5 cm from bottom
		$this->SetY(-15);
				
		$this->SetFont('Arial','',15);
		
		$this->Cell(100,10,'Hotline # 01785876014',0,0);
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
$query=mysqli_query($con,"SELECT o.*,p.*,c.* FROM tbl_order as o,tbl_payment as p,tbl_customer as c WHERE p.order_id=o.order_id AND o.customer_id=c.customer_id ORDER BY payment_id DESC LIMIT 1 ");
while($data=mysqli_fetch_array($query)){
        $query1=mysqli_query($con,"SELECT o.* , c.*, p.* FROM tbl_order as o , tbl_customer as c , tbl_payment as p WHERE o.customer_id=c.customer_id AND o.order_id=p.order_id ");
	
        $pdf->Cell(17,5,$data['payment_id'],'LR',0);
        if($data1=mysqli_fetch_array($query1)){
	$pdf->Cell(47,5,$data['first_name'] . ' ' . $data['last_name'],'LR',0);
        
        $query2=mysqli_query($con,"SELECT * FROM tbl_order_details ORDER BY order_details_id DESC LIMIT 1");
        if($data2=mysqli_fetch_array($query2)){
            
        
        if($pdf->GetStringWidth($data2['product_name']) > 65){
		$pdf->SetFont('Arial','',7);
		$pdf->Cell(30,5,$data2['product_name'],'LR',0);
		$pdf->SetFont('Arial','',9);
	}else{
		$pdf->Cell(30,5,$data2['product_name'],'LR',0);
	}
        
	$pdf->Cell(15,5,$data2['product_quantity'],'LR',0);
        $query3=mysqli_query($con,"SELECT * FROM tbl_order ORDER BY order_id DESC LIMIT 1 ");
        while($data3=mysqli_fetch_array($query3)){
	$pdf->Cell(25,5,$data3['order_total'],'LR',0);
        }
	$pdf->Cell(35,5,$data['payment_date'],'LR',0);
	$pdf->Cell(28,5,$data['phone_number'],'LR',1);
        }
        }
}














$pdf->Output();
?>
