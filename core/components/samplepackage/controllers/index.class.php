<?php

require_once dirname(dirname(__FILE__)) . '/model/samplepackage/samplepackage.class.php';

/**
* Class for backend table
*/
class SamplePackageIndexManagerController extends modExtraManagerController {
    /** @var SamplePackage $samplepackage */
    public $samplepackage;
    public function initialize() {
        $this->samplepackage = new SamplePackage($this->modx);
        $this->addCss($this->samplepackage->options['cssUrl'].'mgr.css');
            $this->addJavascript($this->samplepackage->options['jsUrl'].'mgr/samplepackage.js');
            $this->addHtml('<script type="text/javascript">
            Ext.onReady(function() {
                SamplePackage.options = '.$this->modx->toJSON($this->samplepackage->options).';
            });
            </script>');
            return parent::initialize();
    }
    public function getLanguageTopics() {
            return array('samplepackage:default');
    }
    public function checkPermissions() { return true;}
    public function process(array $scriptProperties = array()) {}
    public function getPageTitle() { return $this->modx->lexicon('samplepackage'); }
    public function loadCustomCssJs() {
        //$this->addJavascript($this->samplepackage->options['jsUrl'].'mgr/widgets/samplepackage.grid.js');
        $this->addJavascript($this->samplepackage->options['jsUrl'].'mgr/widgets/home.panel.js');
        $this->addLastJavascript($this->samplepackage->options['jsUrl'].'mgr/sections/index.js');
    }
    public function getTemplateFile() {
        return $this->samplepackage->options['templatesPath'].'home.tpl';
    }
}
