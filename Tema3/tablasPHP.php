<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tablas</title>
</head>
<body>
    <h3>Tabla media anual</h3>
    <style>
        table {
            border: 1px solid black;
            border-collapse: collapse;
        }
        td{
            border: 1px solid black;
        }
        th{
            border: 1px solid black;
        }
    </style>

    <table>
        <tr>
            <td></td>
            <th>1er</th>
            <th>2o</th>
            <th>3o</th>
            <th>Tot</th>
        </tr>

        <tr>
            <th>Inf</th>
            <td>
                <?php
                    $nInf = rand(15,20);
                    $totInt += $nInf;
                    echo $nInf;
                ?>
            </td>
            <td>
                <?php
                    $nInf = rand(15,20);
                    $totInt += $nInf;
                    echo $nInf;
                ?>
            </td>
            <td>
                <?php
                    $nInf = rand(15,20);
                    $totInt += $nInf;
                    echo $nInf;
                ?>
            </td>
            <td>Total:
                <?php
                    echo $totInt;
                ?>
            </td>
        </tr>

        <tr>
            <th>Elc</th>
            <td>
                <?php
                    $nElc = rand(15,20);
                    $totElc += $nElc;
                    echo $nElc;
                ?>
            </td>
            <td>
                <?php
                    $nElc = rand(15,20);
                    $totElc += $nElc;
                    echo $nElc;
                ?>
            </td>
            <td>
                <?php
                    $nElc = rand(15,20);
                    $totElc += $nElc;
                    echo $nElc;
                ?>
            </td>
            <td>Total:
                <?php
                    echo $totElc;
                ?>
            </td>
        </tr>

        <tr>
            <th>Rob</th>
            <td>
                <?php
                    $nRob = rand(15,20);
                    $totRob += $nRob;
                    echo $nRob;
                ?>
            </td>
            <td>
                <?php
                    $nRob = rand(15,20);
                    $totRob += $nRob;
                    echo $nRob;
                ?>
            </td>
            <td>
                <?php
                    $nRob = rand(15,20);
                    $totRob += $nRob;
                    echo $nRob;
                ?>
            </td>
            <td>Total:
                <?php
                    echo $totRob;
                ?>
            </td>
        </tr>

        <tr>
            <td colspan=5>Media anual:
            <?php
                echo round(($totRob+$totElc+$totInt)/3);
            ?>
            </td>
        </tr>
            
    </table>
    
    
    
    <h3>Notas clase</h3>
        <table>
            <tr>
                <th>Alumnos</th>
                <th>Notas</th>
            </tr>
            <!--BODY DE LA TABLA-->
            <?php
                $tam = rand(15,25);
                $tot = 0;
                $count = 0;
                for ($i=0; $i < $tam; $i++) { 
            ?> 
                <tr>
                    <td>Alumno <?php echo $i?> </td>
                    <td>
                        <?php 
                            $nota = rand(1,20);
                            if($nota<10){
                                $count++;
                                $tot += $nota;
                            }
                            $queNota = match (true) {
                                ($nota<=5 && $nota>1) => "suspenso",
                                ($nota<=6)=> "bien",
                                ($nota<=8)=> "notable",
                                ($nota<=10)=> "sobresaliente",
                                default => "nota no valida"
                            };
                            echo "$nota ($queNota)";
                        ?>
                    </td>
                </tr>
            <?php
                } //cierre del for ppal
            ?>
            <!--BODY DE LA TABLA-->
            <tr>
                <td colspan=2>Media: <?php echo ($tot/$count)?></td>
            </tr>


        </table>
    
    
</body>
</html>