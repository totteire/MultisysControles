<?php

    $content = "
        <page orientation='portrait' format='A4' style='font-size: 12pt;' backimg='./img/PAPIERENTETE.jpg'>
            <div style='margin: 100px 10px 20px 100px;'>
                <div style='margin: auto;width: 400px;text-align:center;'><h1>Constat de Vérification</h1></div>
                <div style='margin: auto;width: 400px;text-align:center;'><h1>N°1955654</h1></div>

                <table cellspacing='0' style='text-align: left; font-size: 11pt;'>
                    <tr>
                        <td>Délivré à :</td>
                        <td>M. Albert Dupont</td>
                    </tr>
                    <tr>
                        <td>Adresse :</td>
                        <td>
                            Résidence perdue<br>
                            1, rue sans nom<br>
                            00 000 - Pas de Ville<br>
                        </td>
                    </tr>
                </table>
                <h3>¤ APPAREIL DE MESURE VERIFIE ¤</h3>
                <table cellspacing='0' style='width: 100%;'>
                <tr>
                    <td>
                        <table cellspacing='0' style='text-align: left; font-size: 11pt; float: left;display: inline;'>
                            <tr>
                                <td>Désignation :</td>
                                <td><b>ALIMENTATION</b></td>
                            </tr>
                            <tr>
                                <td>Constructeur :</td>
                                <td><b>METRIX</b></td>
                            </tr>
                        </table>
                    </td><td>
                        <table cellspacing='0' style='display: inline;text-align: left; font-size: 11pt;'>
                            <tr>
                                <td>Type :</td>
                                <td><b>ALIMENTATION</b></td>
                            </tr>
                            <tr>
                                <td>N° de série :</td>
                                <td><b>AX322</b></td>
                            </tr>
                            <tr>
                                <td>N° de Chassis :</td>
                                <td><b>N°3</b></td>
                            </tr>
                        </table>
                    </td>
                </tr>
                </table>
                <h3>¤ MOYEN DE VÉRIFICATION UTILISÉ ¤</h3>
                <table cellspacing='0' style='width: 100%;'>
                    <tr>
                        <td>Calibrateur FLUKE 5500A N° de série 8675008</td><td></td><td>COFRAC N° E12-057 du 02/12</td>
                    </tr>
                    <tr>
                        <td>Calibrateur FLUKE 5500A N° de série 8675008</td><td></td><td>COFRAC N° F12-016 du 02/12</td>
                    </tr>
                    <tr>
                        <td>Multimètre KEITHLEY 2010 N°de série 773707</td><td></td><td>COFRAC N° E11-391 du 01/12
</td>
                    </tr>
                    <tr>
                        <td>Décades de résistances AOIP RD6C1</td><td></td><td>Vérification MULTISYS du 06/11</td>
                    </tr>
                    <tr>
                        <td>Banc de mesure et de transfert</td><td></td><td>Vérification MULTISYS du 06/11</td>
                    </tr>
                    <tr>
                        <td>Charge dynamique SODILEC SDCH/GB30-300</td><td></td><td>Vérification MULTISYS du 06/11</td>
                    </tr>
                </table>
                <h3>¤ TECHNICIEN RESPONSABLE DE LA VÉRIFICATION ¤</h3>
                
            </div>
        </page>";

    require_once('./html2pdf/html2pdf.class.php');
    $pdf = new HTML2PDF('P','A4','fr');
    $pdf->WriteHTML($content);
    $pdf->Output('exemple.pdf');
echo $content;
?>
