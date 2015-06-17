<?php
if (!class_exists('Parsedown')) require_once "ParseDown.php";
class blockDownInput extends cbBaseInput {
    public $defaultIcon = 'code';
    public $defaultTpl = '[[+value]]';
    
    /**
     * Process this field based on its template and the received data.
     *
     * @param cbField $field
     * @param array $data
     * @return mixed
     */
    
    public function process(cbField $field, array $data = array()) {
        $tpl = $field->get('template');
        //$this->modx->log(modX::LOG_LEVEL_ERROR,"process\n" . print_r($data,true));
        $Parsedown = new Parsedown();
        $data['value'] = $Parsedown->text($data['value']);
        return parent::process($field,$data);
        //return $Parsedown->text($this->contentBlocks->parse($tpl, $data));
    }

    public function getFieldProperties() {
        // i'm not sure hwo to make the combo boxes visually display their defaultValue. i HATE extJS
        return array(
            array(
                'key' => 'theme_editor',
                'fieldLabel' => $this->modx->lexicon('blockdown.theme_editor'),
                'xtype' => 'combo',
                'store' => array(
                    'themes/editor/epic-dark.css',
                    'themes/editor/epic-light.css'
                ),
                'value' => 'themes/editor/epic-dark.css',
                'description' => $this->modx->lexicon('blockdown.theme_editor.description')
            ),
            array(
                'key' => 'theme_preview',
                'fieldLabel' => $this->modx->lexicon('blockdown.theme_preview'),
                'xtype' => 'combo',
                'store' => array(
                    'themes/preview/github.css',
                    'themes/preview/bartik.css',
                    'themes/preview/preview-dark.css'
                ),
                'value' => 'themes/preview/github.css',
                'description' => $this->modx->lexicon('blockdown.theme_preview.description')
            ),
        );
    }

    public function getName() {
        $this->modx->log(modX::LOG_LEVEL_ERROR,"getName\n");
        return 'Blockdown Input'; 
        // return $this->modx->lexicon('blockdown.input_name');
    }
    
    public function getDescription() {
        $this->modx->log(modX::LOG_LEVEL_ERROR,"getDescription\n");
        return 'With Blockdown Input you can manage awesome content awesomely.'; 
        // return $this->modx->lexicon('blockdown.input_description');
    }

    /**
     * @return array
     */
    public function getJavaScripts() {
        $assetsUrl = $this->modx->getOption('blockdown.assets_url', null, MODX_ASSETS_URL . 'components/blockdown/');
        $this->modx->log(modX::LOG_LEVEL_ERROR,"getJavaScripts\n");
        return array(
            $assetsUrl . 'js/vendor/epiceditor/js/epiceditor.js',
            $assetsUrl . 'js/inputs/blockdown.js',
        );
    }

    /**
     * @return array
     */
    public function getTemplates() {
        $this->modx->log(modX::LOG_LEVEL_ERROR,"getTemplates\n");
        $tpls = array();
        
        // Grab the template from a .tpl file
        $corePath = $this->modx->getOption('blockdown.core_path', null, MODX_CORE_PATH . 'components/blockdown/');
        $template = file_get_contents($corePath . 'templates/blockdown.tpl');
        
        // Wrap the template, giving the input a reference of "blockdown", and
        // add it to the returned array.
        $tpls[] = $this->contentBlocks->wrapInputTpl('blockdown', $template);
        return $tpls;
    }
}