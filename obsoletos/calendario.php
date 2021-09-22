<?php

?>
<table border="1" width="100%">
    <tr>
       <th>DOM</th> 
       <th>SEG</th> 
       <th>TER</th> 
       <th>QUA</th> 
       <th>QUI</th> 
       <th>SEX</th> 
       <th>SAB</th> 
    </tr>
    <?php for($l = 0; $l<$linhas; $l++): //coloca a quantidade de linhas no calendario ?>
        <tr>
            <?php for($q=0;$q<7;$q++): //coloca os dias da semana?>
                <?php
                    $t =  strtotime(($q+($l*7)). ' days', strtotime($data_inicio));
                    $w = date('Y-m-d', $t);
                ?>
                <td>
                    <?php
                    echo date('d', $t)."<br/><br/>";
                    $w = strtotime($w);
                    foreach($lista as $item){
                        $dr_inicio = strtotime($item['data_inicio']);
                        $dr_fim = strtotime($item['data_fim']);
                        if($w >= $dr_inicio && $w <= $dr_fim){
                            echo $item['pessoa']."(".$item['id_carro'].")<br/>";
                        }
                    }
                    ?>
            
            </td> 
            <?php endfor; ?>
        </tr>
    <?php endfor; ?>    
</table>