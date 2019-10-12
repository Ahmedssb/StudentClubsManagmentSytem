<?php 
 
    ob_start();  
 
 include'../Database/clubs.php';


  if(isset($_POST['print'])){
    
    
   if ( isset($_GET['clubnName'])){
       $clubName=$_GET['clubnName'];
   }
        $cc= new Clubs();
       // $s =$cc->getPresidentClubName($id);
       // $clubName= implode(" ",$s);
 
        $ss =$cc-> getClubMembers($clubName);

      /// pdf code 


        $output=""    ;

                 foreach($ss as $c){

                  $output.=' <tr> 
                        <td>'.$c["postion"].'</td>
                        <td>'.$c["phone"].'</td>
                        <td>'.$c["year"].'</td>
                        <td> '.$c["college"].'</td>
                        <td>'.$c["id"].'</td>
                        <td>'.$c["name"].'</td>
                      </tr>';  
             } 

        require_once('../TCPDF/tcpdf.php');
        // create an object from the tcpdf class
        $pdf= new TCPDF( 'P', PDF_UNIT,  PDF_PAGE_FORMAT,  true,  'UTF-8', false);
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetTitle("بيانات اعضاء النادي");
        $pdf->SetHeaderData('', '', PDF_HEADER_TITLE, PDF_HEADER_STRING);  
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));  
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));  
        $pdf->SetDefaultMonospacedFont('aealarabiya');  
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);  
        $pdf->SetMargins('30', '10', '10');  
        $pdf->setPrintHeader(false);  
        $pdf->setPrintFooter(false);  
        $pdf->SetAutoPageBreak(TRUE, 10);  
        $pdf->SetFont('aealarabiya', '', 10);
        $pdf->AddPage();  
        
        
        $content = '';  
      $content .= '  
      <h3 align="center">بيانات أعضاء  '.$clubName.'</h3><br ><br>  
      <table border="1" cellspacing="2" cellpadding="5" text-align="center" >  
           <tr>  
                <th width="15%">الصفة الادارية</th>  
                <th width="15%">رقم الجوال</th>  
                <th width="15%">السنة الدراسية</th>  
                <th width="15%">الكلية</th>  
                <th width="15%">الرقم الجامعي</th> 
                <th width="25%">الاسم</th>  

           </tr>  
      ';  
      $content .= $output;
      $content .= '</table>';  
      $pdf->writeHTML($content); 
      ob_end_clean();
      //Send the document to a given destination: string, local file or browser.
      $pdf->Output('sample.pdf', 'I');
    }
    
   ?>  


 



















?>