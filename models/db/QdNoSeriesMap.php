<?php

class QdNoSeriesMap extends QdRoot
{
    static $table_name = 'mpd_noseries_map';

    public static function getFieldsConfig()
    {
        return array_merge(parent::getFieldsConfig(), array(
            'noseries' => array(
                'DataType' => 'Code',
                'FieldClass' => 'Normal',//'FlowField'
                'TableRelation' => array(
                    'Table' => 'QdNoSeries',
                    'Field' => 'id',
                    'TableFilter' => array(/*array(
                            'Condition' => array(
                                'Field' => '',
                                'Type' => 'CONST',//'FIELD'
                                'Value' => ''
                            ),
                            'Field' => 'order',
                            'Type' => 'FIELD',
                            'Value' => 10
                        )*/
                    )
                ),
                'DataPort' => 'noseries_port'
            ),
            'model' => array(
                'DataType' => 'Code',
                'FieldClass' => 'Normal',//'FlowField'
                'TableRelation' => array(
                    'Table' => 'QdQdmvcModel',
                    'Field' => 'id',
                    'TableFilter' => array(/*array(
                            'Condition' => array(
                                'Field' => '',
                                'Type' => 'CONST',//'FIELD'
                                'Value' => ''
                            ),
                            'Field' => 'order',
                            'Type' => 'FIELD',
                            'Value' => 10
                        )*/
                    )
                ),
                'DataPort' => 'qdmvcmodel_port'
            ),
            'active' => array(
                'DataType' => 'Boolean'
            )
        ));
    }

    public static function getInitObj()
    {
        $obj = new QdNoseriesMap();
        $obj->active = true;
        return $obj;
    }
}