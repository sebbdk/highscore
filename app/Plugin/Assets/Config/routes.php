<?php
Router::connect(
    '/files/assets/:folder/:size/:file_name', array('plugin' => 'Assets', 'controller' => 'asset_files', 'action' => 'resize')
);