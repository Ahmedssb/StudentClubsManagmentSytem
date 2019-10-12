<?php 
session_start();
 
 ob_start();
 include'../Database/clubs.php';

     
  if(isset($_POST['print'])){
     
      if(isset($_GET['pos1'] )&& isset($_GET['pos2'] )&& isset($_GET['pos3'] )&& isset($_GET['pos4'] )&& isset($_GET['type1']) && isset($_GET['type2'])){
         
          $pos1=$_GET['pos1'];
          $pos2=$_GET['pos2'];
          $pos3=$_GET['pos3'];
          $pos4=$_GET['pos4'];
          $type1=$_GET['type1'];
          $type2=$_GET['type2'];
          
                $club= new Clubs();
                
                $admins =$club->getAdmins($pos1,$pos2,$pos3,$pos4,$type1,$type2); 

              /// pdf code 


                $output=""    ;

                         foreach($admins as $a){

                          $output.=' <tr> 
                              <td>'.$a["postion"].'</td>
                              <td>'.$a["phone"].'</td>
                              <td> '.$a["clubName"].'</td>
                             <td>'.$a["uid"].'</td>
                              <td>'.$a["name"].'</td>
                              </tr>';  
                     } 

                require_once('../TCPDF/tcpdf.php');
                // create an object from the tcpdf class
                $pdf= new TCPDF( 'P', PDF_UNIT,  PDF_PAGE_FORMAT,  true,  'UTF-8', false);
                $pdf->SetCreator(PDF_CREATOR);
                $pdf->SetTitle("  مسؤولي الأندية الطلابية");
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
              <h3 align="center"> مسؤولي الأندية الطلابية  </h3><br ><br>  
              <table border="1" cellspacing="2" cellpadding="5" text-align="right"    border-collapse=" collapse">  
                   <tr  >  
                        <th   width="15%"    >الصفة الادارية</th>  
                        <th width="15%">رقم الجوال</th>  
                         <th width="15%">النادي</th>  
                        <th width="15%">الرقم الجامعي</th> 
                        <th width="20%">الاسم</th>  

                   </tr>  
              ';  
              $content .= $output;
              $content .= '</table>';  
              $pdf->writeHTML($content);  
                    ob_end_clean();
              //Send the document to a given destination: string, local file or browser.
              $pdf->Output('sample.pdf', 'I');
      }
    }
   
   ?>  


 



















?>