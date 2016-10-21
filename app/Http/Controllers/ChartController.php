<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Khill\Lavacharts\Lavacharts;
use Coseva\CSV;


class ChartController extends Controller
{
    /**
     * Parse the csv file using COSEVA and creating Linechart using lavacharts
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
      $lava = new Lavacharts; // See note below for Laravel
      $mycsv = new CSV('exception.csv');
      $stocksTable = $lava->DataTable();  // Lava::DataTable() if using Laravel

      $stocksTable->addDateColumn('День')
                  ->addNumberColumn('Количество скачиваний')
                  ->addNumberColumn('Количество загрузок');

      $mycsv->flushEmptyRows();
      foreach($mycsv as $row) {
        if(isset($row[0]) || isset($row[1]) || isset($row[2]))
        $stocksTable->addRow([
          $row[0], $row[1], $row[2]
        ]);
      }
      $lava->LineChart('Temps', $stocksTable, [
          'title' => 'Статистика загрузок'
      ]);

      return view('chart', compact('lava', 'mycsv'));
    }
}
