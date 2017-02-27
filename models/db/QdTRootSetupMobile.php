<?php

class QdTRootSetupMobile extends QdTRootSetup
{
    static $table_name = 'mpd_setup_theme_root_mobile';

    private $desktop_setup = null;
    public function getSetupValue($field, $default=null)
    {
        if($this->{$field}==='' || $this->{$field}===0){
            //get from Desktop setup
            if($this->desktop_setup==null){
                $this->desktop_setup = QdTRootSetup::GET();
            }
            if($default!=null && ($this->desktop_setup->{$field}==='' || $this->desktop_setup->{$field}===0))
            {
                return $default;
            }
            else{
                return $this->desktop_setup->{$field};
            }
        }else{
            return $this->{$field};
        }
    }

}