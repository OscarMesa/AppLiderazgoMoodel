    <?php Yii::import('application.vendor.Utilidades'); ?>
    <table id="filtro-evaluaciones" class="table table-bordered table-hover table-condensed">
    <thead><tr><th>Estudiante</th>    
        <?php
        foreach ($header as $row) {
            echo "<th>" . $row['shortname'] . '</th>';
        }
        ?>
    </tr></thead>
    <?php
    $sw = true;
    foreach ($data as $estudiante => $cursos) {
        echo '<tr>';
        //$first_estudent = array_shift($cursos);
        $curso_end = end($cursos);
        echo '<td><p>' . $curso_end[0]['username'] . '</p></td>';
        foreach ($header as $key => $value) {
            if (array_key_exists($value['id'], $cursos)) {
                
                $array_notas = array();
                $nota = Utilidades::MaxNotaByDateFinish($cursos[$value['id']]);
//                foreach ($cursos[$value['id']] as $nota) {
//                     $array_notas[] = '<div class="nota">'.number_format(($nota['grade']*($nota['maxgrade']/$nota['sumgrades'])),2).'</div>';
//                }
                 echo '<td>'. '<div class="nota">'.number_format(($nota['grade']*($nota['maxgrade']/$nota['sumgrades'])),2).'</div>' .' </td>';
                 
//                 if(!$sw){
//                     echo '<pre>';
//                    print_r($array_notas);
//                    exit();
//                 }
            } else {
                echo '<td> - </td>';
            }
        }
        echo '</tr>';
    }
    ?>    

</table>