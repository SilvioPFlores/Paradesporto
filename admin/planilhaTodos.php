<?php
	require_once 'db/dbConnection.php';
	require_once 'query/query-planilha.php';
	
	/** Include PHPExcel */
	require_once dirname(__FILE__) . '/Classes/PHPExcel.php';
	// Create new PHPExcel object
	$objPHPExcel = new PHPExcel();
	// Set document properties
	$objPHPExcel->getProperties()->setCreator("Paradesporto Brasil")
								->setLastModifiedBy("Silvio Flores")
								->setTitle("Planilha Trabalhos")
								->setSubject("Planilha com todos os trabalhos")
								->setDescription("Lista com todos os trabalhos adicionados ao repositório do Paradesporto")
								->setKeywords("Planilha Trabalhos")
								->setCategory("Lista de trabalhos");

	
	$objWorkSheet = $objPHPExcel->createSheet(0); //Setting index when creating
	$arrChave = buscaChaveDesc($conn);
	$arrAutor = buscaAutorDesc($conn);
	$arrTipo = buscaTipoTrabalhoDesc($conn);
	$arrTrabalho = buscaTodosTrabalhos($conn);
	$objWorkSheet->setCellValue('B1', 'PALAVRA CHAVE')
				->setCellValue('C1', 'AUTORES')
				->setCellValue('D1', 'TÍTULO DA OBRA')
				->setCellValue('E1', 'COD TIPO DE TRABALHO')
				->setCellValue('F1', 'REVISTA')
				->setCellValue('G1', 'ANO DE PUBLICAÇÃO')
				->setCellValue('H1', 'VOLUME')
				->setCellValue('I1', 'PÁGINAS')
				->setCellValue('J1', 'INSTITUIÇÃO')
				->setCellValue('K1', 'CIDADE OU PAÍS')
				->setCellValue('L1', 'EDITORA')
				->setCellValue('M1', 'ISBN')
				->setCellValue('N1', 'DATA DE PUBLICAÇÃO')
				->setCellValue('O1', 'DATA DA ULTIMA CONSULTA')
				->setCellValue('P1', 'URL')
				->setCellValue('Q1', 'DOI')
				->setCellValue('R1', 'NOME DO ARQUIVO')
				->setCellValue('S1', 'PÚBLICO')
				->setCellValue('T1', 'COD USUÁRIO')
				->setCellValue('U1', 'STATUS');

	$n = 2;	
			
	$contador = 1;
	foreach ($arrTrabalho as $trabalho){
		//Buscar e montar os dados das chaves
		$strChave = '';
		$cdChave = buscaChaveTrabCod($conn, array(':cdTrabalho' => $trabalho['cd_trabalho']));
		foreach ($cdChave as $dadoChave){
			$strChave .= $arrChave[$dadoChave['cd_chave']].', ';
		}
		//Buscar e montar os dados dos autores
		$strAutor = '';
		$cdAutor = buscaAutorTrabCod($conn, array(':cdTrabalho' => $trabalho['cd_trabalho']));
		foreach ($cdAutor as $dadoAutor){
			$strAutor .= $arrAutor[$dadoAutor['cd_autor']].', ';
		}
		/*
		//define o Tipo de trabalho
		if($trabalho['cd_tipo'] == 100){
			$descTipo = '';
		}
		else{
			$descTipo = $arrTipo[$trabalho['cd_tipo']];
		}*/

		$objWorkSheet->setCellValue('A'.$n, $contador++)
						->setCellValue('B'.$n, rtrim($strChave, ", "))
						->setCellValue('C'.$n, rtrim($strAutor, ", "))
						->setCellValue('D'.$n, $trabalho['ds_titulo'])
						->setCellValue('E'.$n, $trabalho['cd_tipo'] == 100 ? '' : $trabalho['cd_tipo'])
						->setCellValue('F'.$n, $trabalho['ds_revista'])
						->setCellValue('G'.$n, $trabalho['ano_public'])
						->setCellValue('H'.$n, $trabalho['ds_volume'])
						->setCellValue('I'.$n, $trabalho['ds_pagina'])
						->setCellValue('J'.$n, $trabalho['ds_instituicao'])
						->setCellValue('K'.$n, $trabalho['ds_cidade'])
						->setCellValue('L'.$n, $trabalho['ds_editora'])
						->setCellValue('M'.$n, $trabalho['ds_isbn'])
						->setCellValue('N'.$n, $trabalho['data_public'])
						->setCellValue('O'.$n, $trabalho['data_consulta'])
						->setCellValue('P'.$n, $trabalho['ds_url'])
						->setCellValue('Q'.$n, $trabalho['ds_doi'])
						->setCellValue('R'.$n, $trabalho['nm_arquivo'])
						->setCellValue('S'.$n, $trabalho['ic_publico'])
						->setCellValue('Q'.$n, $trabalho['cd_usuario'])
						->setCellValue('U'.$n++, $trabalho['ic_status']);
		}
		$objWorkSheet->setTitle("Geral");

// Redirect output to a client’s web browser (Excel5)
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="Lista-'.date("d-m-Y").'.xls"');
header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
header('Cache-Control: max-age=1');
// If you're serving to IE over SSL, then the following may be needed
header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
header ('Pragma: public'); // HTTP/1.0
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');
exit;
?>