<?php include('header.php'); ?>
   <script type="text/javascript">
	$(document).ready(function () {
	   	lista_sensor();
	   });
   </script>
   
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Nuevo sensor</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">nuevo sensor</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
<div class="container-fluid">
    <!-- Page Heading -->
    <!-- <button onclick="eliminar_session()"> Cerrar</button> -->
    <div class="row">
         <div class="col-lg-12">
            <!-- Basic Card Example -->
            <div class="card shadow mb-8">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold">Registro de nuevo sensor</h6>
                </div>
                <div class="card-body">
                   <div class="row">
                   		<div class="col-sm-6">
                        <div class="row">
                          <div class="col-sm-4">
                            <b>Codigo sensor.</b>
                            <input type="text" name="txt_cod" id="txt_cod" class="form-control form-control-sm" placeholder="Codigo">
                          </div> 
                          <div class="col-sm-8">
                            <b>Nombre de sensor.</b>
                            <input type="text" name="txt_nombre" id="txt_nombre" class="form-control form-control-sm" placeholder="Nombre del contenedor">
                            <input type="hidden" name="txt_id" id="txt_id">                            
                          </div>
                                                  
                        </div>                   			
                   		   <div class="row">                   		   	 
                   		   	 <div class="col-sm-12 text-right">  
                   		   	 <br>                 		   	 	
                   		   	   <button class="btn btn-sm btn-primary" onclick="guardar()">Guardar</button>
                   		   	 </div>
                   		   </div>
                       </div>                   		   
                   		   <div class="col-sm-6">
                   		   	<b>sensor registrados</b>
                   		   	<div class="row">                   		   		
                   		   		<div class="col-sm-12">
                   		   			<input type="text" class="form-control form-control-sm" name="txt_query" id="txt_query" onkeyup="lista_sensor()" placeholder="Buscar contenedor">
                              <input type="hidden" name="lin_tbl" id="lin_tbl" value="0">
                   		   			<div class="table-responsive" style="overflow-y: scroll; height: 70%">
                   		   				<table class="table table-bordered dataTable">
                   		   					<thead>
                                    <th>Codigo</th>
                   		   						<th>Nombre</th>
                   		   						<th></th>
                   		   					</thead>
                   		   					<tbody id="tbl_contenedor">
                   		   						
                   		   					</tbody>
                   		   				</table>
                   		   				
                   		   			</div>
                   		   		</div>
                   		   	</div>                   		   	
                   		   </div>
                   		
                   		</div>
                   
                   </div>
                </div>
            </div>

        </div>                        
    </div>
</div>
<script type="text/javascript">

   

     function lista_sensor(){
     	var parametros = {
     		'query':$('#txt_query').val(),
     	}
    	$.ajax({
          data:  {parametros:parametros},
          url:   '../controlador/nuevo_sensorC.php?lista_sensor=true',
          type:  'post',
          dataType: 'json',
          success:  function (response) { 
             if(response.length!=0){
               $('#lin_tbl').val(1);
             }
            $('#tbl_contenedor').html(response);
            }               
           });

    }

    function guardar()
    {

    	 var nom = $('#txt_nombre').val();
       var id = $('#txt_id').val();
       var cod = $('#txt_cod').val();

    	if(nom=='' || cod=='')
    	{
    		Swal.fire('Llene todo los campos','','info');
    		return false;
    	}
    	var parametros = {
    		'nom':nom,
    		'id':id,
        'cod':cod,
    	}
	 $.ajax({
          data:  {parametros:parametros},
          url:   '../controlador/nuevo_sensorC.php?nuevo=true',
          type:  'post',
          dataType: 'json',
          success:  function (response) { 
            if(response==1 && id=='')
            {
            	Swal.fire('Sensor registrado','','success');
            }else if(response==1 && id!='')
            {
            	Swal.fire('Sensor editado','','success');
            }    
            $('#txt_id').val('');
            lista_sensor();    

          }
        });

    }

    function editar(id)
    {
    	 $.ajax({
          data:  {id:id},
          url:   '../controlador/nuevo_sensorC.php?editar=true',
          type:  'post',
          dataType: 'json',
          success:  function (response) { 
          	console.log(response);
          	$('#txt_nombre').val(response[0].nombre);
    		    $('#txt_id').val(response[0].id);  
            $('#txt_cod').val(response[0].codigo);    

          }
        });

    }

    function delete_sensor(id)
    {
    	Swal.fire({
		  title: 'Esta seguro de eliminar?',
		  text: "Esta apunto de eliminar un contenedor!",
		  icon: 'warning',
		  showCancelButton: true,
		  confirmButtonColor: '#3085d6',
		  cancelButtonColor: '#d33',
		  confirmButtonText: 'Yes, delete it!'
		}).then((result) => {
		  if (result.isConfirmed) {
		     eliminar(id);
		  }
		})
    }

    function eliminar(id)
    {
    	 $.ajax({
          data:  {id:id},
          url:   '../controlador/nuevo_sensorC.php?eliminar=true',
          type:  'post',
          dataType: 'json',
          success:  function (response) { 
          	if(response==1)
          	{
          		Swal.fire('Contenedor eliminado','','success');
               lista_sensor();         		
          	}                    
          }
        });

    }

  


</script>
<?php include('footer.php'); ?>
           