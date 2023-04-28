<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
<table>
  <tbody>
  @php
    for ($m =1; $m <= 100; $m++) {
        echo '<tr>';
        for ($i =1; $i <= 100; $i++) {
            echo "<td style='border: 2px solid black'></td>";
        }
        echo '</tr>';
    }
    @endphp
      {{-- <th>1</th> --}}
      {{-- <td>Mark</td>
      <td>Otto</td>
      <td>@mdo</td> --}}
    
  </tbody>
</table>


    @php

    @endphp
    
</body>
</html>