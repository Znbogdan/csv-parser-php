@extends('layouts.app')

@section('content')
    <h1>Chart</h1>
    <div class="table-responsive"><?= $mycsv->toTable(); ?></div>
    <div id="temps_div"></div>
    <?= $lava->render('LineChart', 'Temps', 'temps_div') ?>
@stop
