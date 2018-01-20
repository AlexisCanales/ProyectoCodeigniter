<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
   <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
   <title>pagina policial</title>
      <link href="estilos/formatos.css" rel="stylesheet" type="text/css" />
</head>

<body>
  <?php
    require("docu.php");
	$llamafunciones= new clases();
	$llamafunciones->conectar();
	
	if(isset($_GET['cod'])){
	   $cod= $_GET['cod'];
	   $llamafunciones->eliminar($cod);
	   echo"se elimino el registro";
	}
	
			//pa grabar
		if(isset($_POST['btnenv'])){// si recibe datos del boton guardar
	  $rut= $_POST['txtrut']; // recive los datos
	  $nom= $_POST['txtnom'];
	  $mot= $_POST['cbomot'];
	  $det= $_POST['txtdet'];
	  $fec= $_POST['txtfec'];
	  $com= $_POST['cbocom'];
	  $ubi= $_POST['txtubi'];
		  // if(strlen($cod > 0)){ // si ingresa algo
if(strlen(trim($rut)) > 0 && strlen(trim($nom)) >0 && strlen(trim($mot)) >0 && strlen(trim($det)) >0 && strlen(trim($fec)) >0 && strlen(trim($com)) >0 && strlen(trim($ubi)) >0 ){ 
	           if($llamafunciones->buscar($rut) == false){
	               	  $llamafunciones->guardar($rut,$nom,$mot,$det,$fec,$com,$ubi);
				   echo"se almaceno correctamente";
	           }else{
				   echo"el rut ingresado ya existe";
			   }
		   }else{
		       echo"debes llenar todas las casillas";
		   }
		 }
	
  ?>

<form id="form1" name="form1" method="post" action="index.php">
<table width="450" border="1">
  <tr>
    <th id="titulo" border-right="0" colspan="2">formulario de registro de detenciones</th>
  </tr>
  <tr>
    <td width="400">rut:</td>
    <td width="220"> <input type="text" id="txtrut" name="txtrut" /> </td>
  </tr>
  <tr>
    <td>nombre:</td>
    <td> <input type="text" id="txtnom" name="txtnom" /> </td>
  </tr>
  <tr>
    <td>motivo:</td>
    <td> 
      <?php
	     $llamafunciones->llenarcbo();
	   ?>
       
    </td>
  </tr>
  <tr>
    <td height="107">detalle motivo:</td>
    <td><textarea id="txtdet" name="txtdet" cols="30" rows="5" minlength="20" maxlength="200" required> </textarea></td>
  </tr>
  <tr>
    <td>fecha:</td>
    <td> <input type="date" id="txtfec" name="txtfec" /> </td>
  </tr>
  <tr>
    <td>comuna:</td>
    <td><select id="cbocom" name="cbocom" >
     <?php
	     $llamafunciones->llenarcbo2();
	  ?>
       </select></td>
  </tr>
  <tr>
    <td>ubicacion detencion:</td>
    <td> <input type="text" id="txtubi" name="txtubi"/> </td>
  </tr>
  <tr>
    <td> <input type="submit" id="btnenv" name="btnenv" class="boton" value="enviar" /> </td>
    <td> <input type="reset" id="btnres" name="btnres" class="boton" value="restablecer" /></td>
  </tr>
</table>
</form>

   <?php
      $llamafunciones->listar();
	  //$llamafunciones->desconectar();
   ?>

   </body>
</html>