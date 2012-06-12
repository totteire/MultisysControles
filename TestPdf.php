<?php

    ob_start();
    include('./ConstatDeVerification.php');
    $content = ob_get_clean();

    require_once('./html2pdf/html2pdf.class.php');
    $pdf = new HTML2PDF('P','A4','fr');
    $pdf->WriteHTML($content);
    $pdf->Output('exemple.pdf');
    
    
    echo $content;
?>
