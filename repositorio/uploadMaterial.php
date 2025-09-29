<?php
if(isset($_FILES['trabalhoPDF'], $_POST['hdnEnviaMaterial']) && $_POST['hdnEnviaMaterial'] == 'novoMaterial') {
    //$tam = json_encode($_FILES['trabalhoPDF']);
    if($_FILES['trabalhoPDF']['error'] == 0){
        if($_FILES['trabalhoPDF']['size']< 300*1024*1024) {
            $path = $_FILES['trabalhoPDF']['name'];
            $ext = pathinfo($path, PATHINFO_EXTENSION);
            if($ext == 'pdf' || $ext == 'PDF'){
                $dir = 'trabalhos/temp/';
                $new_name = preg_replace('/[^0-9]/', '',microtime(true))  . '.' . $ext;
                move_uploaded_file($_FILES['trabalhoPDF']['tmp_name'], $dir . $new_name);
                echo json_encode(array('novo' => $new_name, 'original' => $path, 'erro' => ''));
            }
            else{
                echo json_encode(array('erro' => "Somente arquivos no formato PDF"));
            }
        }
        else{
            echo json_encode(array('erro' => "Tamanho máximo para arquivo 300M!"));
        }
    }
    else{
        echo json_encode(array('erro' => "Falha ao carregar arquivo! Erro:".$_FILES['trabalhoPDF']['error']));
    }
}
else if(isset($_POST['excluiTrabalho'], $_POST['nomeTrabalho']) && $_POST['excluiTrabalho'] == 'exclui'){
    $dir = 'trabalhos/temp/';
    if (unlink($dir.$_POST['nomeTrabalho'])) { 
        echo '1'; 
    } 
    else { 
        echo '2'; 
    }
}


