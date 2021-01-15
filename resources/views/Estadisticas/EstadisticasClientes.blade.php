
@extends ('layouts.admin')
@section ('contenido')	
<html>
  <head>
    <!--Load the AJAX API-->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">

      // Load the Visualization API and the corechart package.
      google.charts.load('current', {'packages':['corechart']});

      // Set a callback to run when the Google Visualization API is loaded.
      google.charts.setOnLoadCallback(drawChart);

      // Callback that creates and populates a data table,
      // instantiates the pie chart, passes in the data and
      // draws it.
      function drawChart() {

        // Create the data table.
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Topping');
        data.addColumn('number', 'Slices');
        data.addRows([
            @foreach ($clientes as $cliente)
             ['{{$cliente->nombre}}', {{$cliente->total_venta}}],
            @endforeach
        ]);

        // Set chart options
        var options = {'title':'Estadistica Torta de Clientes Mas Consumidores',
                         pieHole: 0.4,
                       'width':500,
                       'height':400};

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
        chart.draw(data, options);

          // Create the data table.
          var data = new google.visualization.DataTable();
        data.addColumn('string', 'Topping');
        data.addColumn('number', 'Cantidad');
        data.addRows([
            @foreach ($clientes as $cliente)
             ['{{$cliente->nombre}}', {{$cliente->total_venta}}],
            @endforeach

        ]);

        // Set chart options
        var options = {'title':'Estadistica Barras de Clientes Mas Consumidores',
                        bars: 'horizontal',
                        colors: ['green'],
                       'width':500,
                       'height':400};

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.ColumnChart(document.getElementById('chart_div2'));
        chart.draw(data, options);
      }
    </script>
  </head>

  <body>
  <center><h1 style="border: 1px dashed #ccc; padding:10px; color : white; background-color : #666666">
        Estadistica Clientes Mas Consumidores</center>
    <table class="columns">
      <tr>
        <td><div id="chart_div" style="border: 1px solid #ccc"></div></td>
        <td><div id="chart_div2" style="border: 1px solid #ccc"></div></td>
      </tr>
    </table>
    <!--Div that will hold the pie chart-->
  </body>
</html>
@endsection