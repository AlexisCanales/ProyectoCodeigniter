
<?php
    class clases{
	  private $ser; 
	  private $lng; 
      private $pas; 
	  private $bd;
	  private $id_con; 
	  private $conexion;
	  //private $id_bd; hola
	  
	
     function conectar(){
	    $this->ser="localhost";
		$this->lng="root";
		$this->pas="";
		$this->bd="policial";
		//$this->id_con= mysql_connect($this->ser,$this->lng,$this->pas);
		$this->id_con= mysqli_connect($this->ser,$this->lng,$this->pas,$this->bd);
		//$this
		//$this->id_bd= mysql_select_db($this->bd,$this->id_con);
		if(!$this->id_con){
		   die("error en la conexion");
		}else{
		   echo"conexion establecida";
		 
		}
		
		
		
	}
	
	  function desconectar(){
	      mysqli_close($this->id_con);
	  }
	

    /*function llenarcbo(){
	  	$sql = "select * from motivos";
		$sentencia = mysql_query($sql,$this->id_con);
		echo"<select id='cbomot' name='cbomot'>";
		while($rs = mysql_fetch_array($sentencia, MYSQL_BOTH)){
				echo "<option value='".$rs['codigo_mot']."'>" .$rs['nombre_mot']. "</option>";
		}
	    echo"</select>";
	}
	*/
	
	/* Consultas de selección que devuelven un conjunto de resultados */
//if ($resultado = $mysqli->query("SELECT Name FROM City LIMIT 10")) {
  //  printf("La selección devolvió %d filas.\n", $resultado->num_rows);

    /* liberar el conjunto de resultados */
    //$resultado->close();
//}
	
	
	//con mysqli
	function llenarcbo(){		
		$conexion = $this->id_con;
		$sql = "select * from motivos";
		$sentencia = $conexion->query($sql);
		echo"<select id='cbomot' name='cbomot'>";
		while($rs = $sentencia->fetch_array(MYSQLI_BOTH)){
				echo "<option value='".$rs['codigo_mot']."'>" .$rs['nombre_mot']. "</option>";
		}
	    echo"</select>";
	}
	
	
	function llenarcbo2(){
		$conexion = $this->id_con;
	  	$sql = "select * from comunas";
		$sentencia = $conexion->query($sql);
		//echo"<select id='cbomot' name='cbomot'>";
		while($rs = $sentencia->fetch_array(MYSQLI_BOTH)){
				echo "<option value='".$rs['codigo_com']."'>" . $rs['nombre_com'] . "</option>";
		}
	}
	
	  
	function listar(){
		echo "<h1>Listado de detenciones policiales</H1>";
		echo "<table width='700' border='1'/>";
		echo "<tr>";
			echo "<th>numero</th>";
			echo "<th>nombre</th>";
			echo "<th>motivo</th>";
			echo "<th>fecha</th>";
			echo "<th>comuna</th>";
			echo "<th>accion</th>";
		echo "</tr>";

	$conexion = $this->id_con;

$sql = "select detenciones.codigo_det,detenciones.nombre_det,motivos.nombre_mot,detenciones.fecha_det,comunas.nombre_com from detenciones,motivos,comunas where detenciones.codigo_mot=motivos.codigo_mot and detenciones.codigo_com=comunas.codigo_com";

	/*
		$sentencia= mysql_query($sql,$this->id_con); 
        while($rs= mysql_fetch_array($sentencia,MYSQL_BOTH)){ 
		*/
				$sentencia = $conexion->query($sql);
		while($rs = $sentencia->fetch_array(MYSQLI_BOTH)){
			echo "<tr>";
				echo "<td>" . $rs['codigo_det'] . "</td>";
				echo "<td>" . $rs['nombre_det'] . "</td>";
				echo "<td>" . $rs['nombre_mot'] . "</td>";
				echo "<td>" . $rs['fecha_det'] . "</td>";
				echo "<td>" . $rs['nombre_com'] . "</td>";
				echo "<td> <a href='index.php?cod=" .$rs['codigo_det'] . "'> quitar </a> </td>";
			echo "</tr>";
		}
		echo "</table>";
	}
	
	
//	$mysqli = new mysqli("localhost","root", "", "tables");

//$query = $mysqli->prepare("SELECT * FROM table1");
//$query->execute();
//$query->store_result();

//$rows = $query->num_rows;

//echo $rows;

     function buscar($rut){
		  $conexion = $this->id_con;
	      $sql="select * from detenciones where rut_det='$rut'";
	      //$sentencia= mysql_query($sql,$this->id_con);
	      $sentencia = $conexion->query($sql);
		  if(mysqli_num_rows($sentencia)>0){ //my sql num row, permite saver la cantidad de filas q ay 
		        echo"ya existe este rut";            // si es mayor a 0 osea lo encontro
		        return true;
		  }
		  return false;
		   echo"rut nuevo"; 
	  }
	
	
	function guardar($rut,$nom,$mot,$det,$fec,$com,$ubi){
		$conexion = $this->id_con;
		// los char llevan comillas '$char'
		 $sql = "insert into detenciones values(NULL,'$rut','$nom',$mot,'$det','$fec',$com,'$ubi')";
		 $sentencia = $conexion->query($sql);
		  echo"se guardo los datos"; 
		  //$sentencia = mysql_query($sql, $this->id_con);	
	}

    function eliminar($cod){
		$conexion = $this->id_con;
		$sql = "delete from detenciones where codigo_det='$cod'";
		//$sentencia = mysql_query($sql, $this->id_con);
		$sentencia = $conexion->query($sql);
		
	}
	
	}
	

?>
