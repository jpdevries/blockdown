<?php
$plugins = array();

/** create the plugin object */
$plugins[0] = $modx->newObject('modPlugin');
$plugins[0]->set('name','blockdown');
$plugins[0]->set('description','MarkDown Input Type. Powered by EpicEditor and Parsedown.');
$plugins[0]->set('plugincode', getSnippetContent($sources['plugins'] . 'blockdown.plugin.php'));

$events = include $sources['data'].'transport.plugin.events.php';

if (is_array($events) && !empty($events)) {
    $plugins[0]->addMany($events);
    $modx->log(xPDO::LOG_LEVEL_INFO,'Packaged in '.count($events).' Plugin Events for blockdown.'); flush();
} else {
    $modx->log(xPDO::LOG_LEVEL_ERROR,'Could not find plugin events for blockdown!');
}
unset($events);

return $plugins;
