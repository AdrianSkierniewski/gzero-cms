<?php
return array(
    'multilang' => array(
        'enabled'   => TRUE,
        'detected'  => FALSE, // Do not change, changes in runtime!
        'subdomain' => FALSE
    ),
    'upload'    => array(
        'path'   => public_path('uploads'),
        'public' => asset('uploads')
    )
);
