<?php
/* @var $this yii\web\View */
$this->title = 'Sell Your Property';
$snippetsDir = __DIR__."/../snippets";

for( $i = 1; $i <= 7; $i++ ){ require_once "{$snippetsDir}/section-{$i}.php"; }