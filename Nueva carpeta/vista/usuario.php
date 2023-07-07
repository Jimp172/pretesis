<?php include('header.php'); ?>
<script type="text/javascript">
	$(document).ready(function () {
		$('#sidebarToggleTop').click();
		listar();
		tipo();
	   });

	function listar()
	{
	  var parametros = {
			'query':$('#txt_query').val(),
		}
     $.ajax({
      data:  {parametros:parametros},
      url:   '../controlador/usuarioC.php?listar_usuarios=true',
      type:  'post',
      dataType: 'json',
      success:  function (response) { 
        $('#tbl_usuarios').html(response);                
      }
    });

	}
	function tipo()
	{

     $.ajax({
      // data:  {parametros:parametros},
      url:   '../controlador/usuarioC.php?tipo=true',
      type:  'post',
      dataType: 'json',
      success:  function (response) { 
        $('#ddl_tipo').html(response);                
      }
    });

	}

  // funcion para guardar o editar usuario nuevo usuarios nuevo
	function guardar()
	{
		var n = $('#txt_nombre').val();
		var c = $('#txt_ci').val();
		var k = $('#txt_nick').val();
		var p = $('#txt_pass').val();
		var d = $('#txt_dir').val();
		var t = $('#ddl_tipo').val();
		var id = $('#txt_id').val();
    var tel = $('#txt_telegram').val();
		if(n=='' || c==''|| k=='' || p=='' || d==''|| t=='' || tel=='')
		{
			Swal.fire('Llene todo los campos','','info');
			return false;
		}

     $.ajax({
	      data:  $('#form-usuario').serialize(),
	      url:   '../controlador/usuarioC.php?guardar=true',
	      type:  'post',
	      dataType: 'json',
	      success:  function (response) { 
	      	if(id=='' && response==1)
	      	{ Swal.fire('Usuario Guardado','','success')

	      	}else if(id!='' && response==1)
	      	{ Swal.fire('Usuario Editado','','success')

	      	}else
	      	{ Swal.fire('No se pudo guardar','','error')

	      	}
	      	listar();
	      	limpiar();

	      }
	    });

	}

	function editar(id)
	{
		var parametros = {
			'id':id,
		}
      $.ajax({
      data:  {parametros:parametros},
      url:   '../controlador/usuarioC.php?editar=true',
      type:  'post',
      dataType: 'json',
      success:  function (response) { 
        $('#txt_id').val(response[0].id);
        $('#txt_nombre').val(response[0].nombre);
        $('#txt_ci').val(response[0].ci_ruc);
        $('#txt_nick').val(response[0].nick);
        $('#txt_pass').val(response[0].pass);
        $('#ddl_tipo').val(response[0].id_tipo);
        $('#txt_dir').val(response[0].direccion);   
        $('#txt_telegram').val(response[0].tele);        
      }
      });

    }

    function eliminar(id)
	{
		var parametros = {
			'id':id,
		}
      $.ajax({
      data:  {parametros:parametros},
      url:   '../controlador/usuarioC.php?eliminar=true',
      type:  'post',
      dataType: 'json',
      success:  function (response) {
	      	listar();   
      }
      });

    }

	 function limpiar()
      {
      	$('#txt_id').val('');
        $('#txt_nombre').val('');
        $('#txt_ci').val('');
        $('#txt_nick').val('');
        $('#txt_pass').val('');
        $('#ddl_tipo').val('');
        $('#txt_dir').val('');   
      }

  function eliminar_registro(id)
    {
    	Swal.fire({
		  title: 'Esta seguro de eliminar?',
		  text: "Esta apunto de eliminar un registro!",
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
</script>




  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Usuarios</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">nuevo usuario</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">

<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- <button onclick="eliminar_session()"> Cerrar</button> -->
    <div class="row">
         <div class="col-lg-12">
            <!-- Basic Card Example -->
            <div class="card shadow mb-8">
                <div class="card-header py-3">
                    <!-- <h6 class="m-0 font-weight-bold text-primary">Basic Card Example</h6> -->
                </div>
                <div class="card-body">
                	<div class="row">
                		<div class="col-sm-4">
                		<form id="form-usuario">
                			<div class="row">
                				<div class="col-sm-8">
                					<input type="hidden" name="txt_id" id="txt_id">
                					<b>Nombre</b>
                					<input type="text" class="form-control form-control-sm" placeholder="Nombre" name="txt_nombre" id="txt_nombre">               					
                				</div>
                				<div class="col-sm-4">
                					<b>CI / RUC</b>
                					<input type="text" class="form-control form-control-sm" placeholder="CI / RUC" name="txt_ci" id="txt_ci">                					
                				</div>
                				<div class="col-sm-6">
                					<b>Nick</b>
                					<input type="text" class="form-control form-control-sm" placeholder="Nick" name="txt_nick" id="txt_nick">                					
                				</div>
                				<div class="col-sm-6">
                					<b>Password</b>
                					<input type="text" class="form-control form-control-sm" placeholder="Password" name="txt_pass" id="txt_pass">                					
                				</div>
                        <div class="col-sm-12">
                          <b>Telegram ID</b>
                          <input type="text" class="form-control form-control-sm" placeholder="Password" name="txt_telegram" id="txt_telegram">                         
                        </div>                        
                				<div class="col-sm-12">
                					<b>Tipo de usuario</b>
                					 <select class="form-control form-control-sm" id="ddl_tipo" name="ddl_tipo">
                					 	<option value="">Seleccione tipo usuario</option>
                					 </select>                			
                				</div>
                				<div class="col-sm-12">
                					<b>Direccion</b>
                					<textarea class="form-control form-control-sm" placeholder="Direccion" name="txt_dir" id="txt_dir" style="resize: none" rows="3"></textarea>                 					
                				</div>
                			</div>
                			<div class="modal-footer">
                				<button class="btn btn-sm btn-primary" type="button" onclick="guardar()">Guardar</button>
                			</div>                			
                			 </form>
                		</div>
                		<div class="col-sm-8">
                			<input type="text" class="form-control form-control-sm" name="txt_query" id="txt_query" onkeyup="listar()" placeholder="Buscar usuario">
                			<div class="table-responsive" style="height: 400px">                				
                				<table class="table table-bordered dataTable">
                					<thead>
                						<th></th>
                						<th>Nombre</th>
                						<th>CI / RUC</th>
                						<th>Nick</th>
                						<th>Password</th>
                						<th>Tipo usuario</th>
                						<th>Direccion</th>
                					</thead>
                					<tbody id="tbl_usuarios">
                						
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
<?php include('footer.php'); ?>
           