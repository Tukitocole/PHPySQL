<html>
<html>

<head>
  <title>Problema</title>
</head>

<body>
<?php
  $conn = new mysqli("localhost", "GML", "GML123", "abml");  //conexion a la base de datos
if($conn->connect_error){
$error="Error #".$conn->connect_errno;
$error.=": ".$conn->connect_error;
echo($error);
}else{
echo "Conexión exitosa<br>";
}
// consulta en sql para recibir la tabla hurricanes
$resultado = $conn-> query ( "select * FROM hurricanes union select '',sum(Promedio),sum(`2005`),sum(`2006`),sum(`2007`),sum(`2008`),sum(`2009`),sum(`2010`),sum(`2011`),sum(`2012`),sum(`2013`),sum(`2014`),sum(`2015`) FROM hurricanes") or die ("No se pudo acceder a la tabla");
$conn -> close (); 

echo "<table border='1'>";

// fecth_fields para recorrer los nombres de los campos e imprimirlos
echo "<tr>";
foreach ($resultado->fetch_fields() as $campo) {
    echo "<th>" . $campo->name . "</th>"; // para accede al nombre
}
echo "</tr>";

$total_filas = $resultado->num_rows; // para contar las filas devueltas por una consulta SELECT
$fila_actual = 0;

foreach ($resultado as $indice => $valor) {
    $fila_actual++;
    echo "<tr>";
    foreach ($valor as $indiceCampos=>$columna) {
        // En la ultima fila, si la columna viene vacio la de los meeses entonces imprime "Total" para la consulta de sum
        if ($fila_actual == $total_filas && $columna === '') {
            echo "<td><strong>Total</strong></td>";
        } else {
            echo "<td>" . $columna . "</td>";
        }
    }
    echo "</tr>";
}
echo "</table>";


?>

</body>

</html>