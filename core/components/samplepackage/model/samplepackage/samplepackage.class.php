<?php
/**
* @author <first name> <last name>
* @package samplepackage
* @namespace samplepackage
*/
class SamplePackage
{
    public $modx;

    public $options = array();

    public $namespace = 'samplepackage';

    public function __construct(modX &$modx, array $options = array())
    {
        $this->modx =& $modx;
        $basePath = $this->getOption('core_path', $options, $this->modx->getOption('core_path').'components/'.$this->namespace.'/');
        $assetsUrl = $this->getOption('assets_url', $options, $this->modx->getOption('assets_url').'components/'.$this->namespace.'/');
        $this->options = array_merge(array(
            'namespace' => $this->namespace,
            'basePath' => $basePath,
            'corePath' => $basePath,
            'modelPath' => $basePath.'model/',
            'processorsPath' => $basePath.'processors/',
            'templatesPath' => $basePath.'templates/',
            'chunksPath' => $basePath.'elements/chunks/',
            'jsUrl' => $assetsUrl.'js/',
            'cssUrl' => $assetsUrl.'css/',
            'assetsUrl' => $assetsUrl,
            'connectorUrl' => $assetsUrl.'connectors/connector.php',
        ), $options);

        $this->modx->addPackage($this->namespace, $this->options['modelPath']);
    }

    /**
    * This function gets a MODX Chunk according to its name
    *
    * @param $name --> name of the chunk
    * @param $properties --> placeholders to pass to chunk (default: empty array)
    */
    public function getChunk($name, $properties = array())
    {
        $chunk = null;

        if (!isset($this->chunks[$name])) {
            $chunk = $this->modx->getObject('modChunk', array('name' => $name));

            if (empty($chunk) || !is_object($chunk)) {
                $chunk = $this->_getTplChunk($name);
                if ($chunk == false) {
                    return false;
                }
            }

            $this->chunks[$name] = $chunk->getContent();
        } else {
            $o = $this->chunks[$name];
            $chunk = $this->modx->newObject('modChunk');
            $chunk->setContent($o);
        }

        $chunk->setCacheable(false);
        return $chunk->process($properties);
    }

    /**
    * This function gets a local chunk (file chunk) according to its name
    *
    * @param $name --> name of the chunk
    * @param $postfix --> suffix of the chunk name (default: .chunk.tpl)
    */
    private function _getTplChunk($name, $postfix = '.chunk.tpl')
    {
        $chunk = false;

        $filePath = $this->options['chunksPath'].$name.$postfix;

        if (file_exists($filePath)) {
            $fileContent = file_get_contents($filePath);
            $chunk = $this->modx->newObject('modChunk');
            $chunk->set('name', $name);
            $chunk->setContent($fileContent);
        }

        return $chunk;
    }

    /**
    * This function gets a MODX Option according to the defined namespace
    * @param $key --> name of the option
    * @param $options --> array of options
    * @param $default --> default if option is null
    */
    public function getOption($key, $options = array(), $default = null)
    {
        $option = $default;
        if (!empty($key) && is_string($key)) {
            if ($options != null && array_key_exists($key, $options)) {
                $option = $options[$key];
            } elseif (array_key_exists($key, $this->options)) {
                $option = $this->options[$key];
            } elseif (array_key_exists("{$this->namespace}.{$key}", $this->modx->config)) {
                $option = $this->modx->getOption("{$this->namespace}.{$key}");
            }
        }
        return $option;
    }
}
