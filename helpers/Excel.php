<?php
/**
 * Created by PhpStorm.
 * User: chenyi
 * Date: 2015/12/15
 * Time: 16:34
 */

namespace app\helpers;

use PHPExcel;

class Excel
{
    public function writerExcel($tableHead = array(), $rowArray = array(), $filename='excel.xls') {
        file_put_contents('order.txt', print_r($tableHead, true).PHP_EOL, FILE_APPEND);
        $objPHPExcel = new PHPExcel ();
        $objPHPExcel->getProperties()->setCreator("伙购网")->setLastModifiedBy("伙购网")->setTitle("我的excel文档")->setSubject("文档导出测试")->setDescription("文档导出测试.")->setKeywords("office 2007 PHP数据")->setCategory("文档导出测试");
        $objPHPExcel->setActiveSheetIndex(0);
        $objPHPExcel->getActiveSheet()->setTitle('数据导出');
        $objPHPExcel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(15);
        $Letter = Array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z','AA', 'AB', 'AC', 'AD', 'AE', 'AF', 'AG', 'AH', 'AI', 'AJ', 'AK', 'AL', 'AM', 'AN', 'AO', 'AP', 'AQ', 'AR', 'AS', 'AT', 'AU', 'AV', 'AW', 'AX', 'AY', 'AZ');
        $i = 0;
        foreach ($tableHead as $headKey => $headValue) {
            $objPHPExcel->getActiveSheet()->setCellValue("$Letter[$i]1", "$headValue");
            $i++;
        }
        $j = 2;
        foreach ($rowArray as $rows) {
            $i = 0;
            foreach ($tableHead as $headKey => $headValue) {
                $objPHPExcel->getActiveSheet()->setCellValueExplicit("$Letter[$i]$j", "$rows[$headKey]", \PHPExcel_Cell_DataType::TYPE_STRING);
                $i++;
            }
            $j++;
        }
        $objPHPExcel->getActiveSheet()->getDefaultColumnDimension()->setWidth('20');
        $objPHPExcel->getActiveSheet()->getStyle('A1:AZ1')->getFont()->setBold(true);

        $objPHPExcel->getActiveSheet()->getProtection()->setSheet(true);
        $objPHPExcel->getActiveSheet()->getProtection()->setSort(true);
        $objPHPExcel->getActiveSheet()->getProtection()->setInsertRows(true);
        $objPHPExcel->getActiveSheet()->getProtection()->setFormatCells(true);

        header("Cache-Control:must-revalidate,post-check=0,pre-check=0");
        header('Content-Type: application/msexcel;charset=utf8');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');
        $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
//        if (!empty($filePath)){
//            $objWriter->save($filePath.$filename);
//        }
        file_put_contents('order.txt', print_r('save---before', true).PHP_EOL, FILE_APPEND);
        $objWriter->save('php://output');
        file_put_contents('order.txt', print_r('save---end', true).PHP_EOL, FILE_APPEND);
    }

    public static function readExcel($filename, $filetype)
    {
        if( $filetype =='xlsx' ) {
            $objReader = \PHPExcel_IOFactory::createReader('Excel2007');
        } else {
            $objReader = \PHPExcel_IOFactory::createReader('Excel5');
        }

        $objPHPExcel = $objReader->load($filename);
        $objWorksheet = $objPHPExcel->getActiveSheet();
        $highestRow = $objWorksheet->getHighestRow();
        $highestColumn = $objWorksheet->getHighestColumn();
        $highestColumnIndex = \PHPExcel_Cell::columnIndexFromString($highestColumn);
        $excelData = array();
        for ($row = 1; $row <= $highestRow; $row++) {
            for ($col = 0; $col < $highestColumnIndex; $col++) {
                $excelData[$row][] =(string)$objWorksheet->getCellByColumnAndRow($col, $row)->getValue();
            }
        }
        return $excelData;
    }
}