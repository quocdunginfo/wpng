<?php

class QdNote extends QdRoot
{
    static $table_name = 'mpd_note';

    public static function getFieldsConfig()
    {
        return array_merge(parent::getFieldsConfig(), array(
            'content' => array(),
            'model' => array(
                'ReadOnly' => true
            ),
            'model_id' => array(
                'ReadOnly' => true
            )
        ));
    }

    public static function getInitObj()
    {
        $obj = new QdNote();
        return $obj;
    }

    protected function modelOnValidate($field_name)
    {
        if ($this->{$field_name} == '') {
            $this->pushValidateError($field_name, '"model" phải khác rỗng');
        }
    }

    protected function model_idOnValidate($field_name)
    {
        if ($this->{$field_name} == '') {
            $this->pushValidateError($field_name, '"model_id" phải khác rỗng');
        }
    }
    public static function import($qd_import_data_obj){
        Qdmvc::loadHelper('PHPExcel/PHPExcel');

        $obj_path = get_attached_file( $qd_import_data_obj->getMediaID('path'));

        //  Load the file
        $PHPExcel = PHPExcel_IOFactory::load($obj_path);

        $PHPExcel->setActiveSheetIndex(0);

        $worksheet = $PHPExcel->getActiveSheet();

        $highestRow         = $worksheet->getHighestRow(); // e.g. 10
        $highestColumn      = $worksheet->getHighestColumn(); // e.g 'F'
        $highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);


        $rows = array();
        $tpl = static::getImportTemplate();
        for ($row = 1; $row <= $highestRow; ++ $row) {
            $tmp_obj = new QdNote();

            for ($col = 0; $col < count($tpl); $col++) {
                $cell = $worksheet->getCellByColumnAndRow($col, $row);
                $val = $cell->getValue();
                $dataType = PHPExcel_Cell_DataType::dataTypeForValue($val);

                $tmp_obj->{$tpl[$col]} = $val;
            }
            array_push($rows, $tmp_obj);
        }
        $total_mod = 0;
        $total_insert=0;
        foreach($rows as $item){
            $tmp = QdNote::GET($item->id);
            if($tmp!=null){
                //modify
                $tmp->content = $item->content;
                if($tmp->save()){
                    $total_mod++;
                }
            }else{
                //insert
                $tmp = new QdNote();
                $tmp->content = $item->content;
                if($tmp->save()){
                    $total_insert++;
                }
            }
        }
        $qd_import_data_obj->pushValidateError('', 'Total done: '.($total_insert+$total_mod), 'info');
    }
    protected static function getImportTemplate(){
        return array(
            0 => 'id',
            1 => 'content',
        );
    }
}