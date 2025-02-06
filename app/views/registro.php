: <?php include 'layout.php'; ?> 
<div class="container mt-5"> 
<div class="row justify-content-center"> 
<div class="col-md-4"> 
<h2 class="text-center">Registro de Usuario</h2> 
<form action="index.php?action=registrar" method="POST" class="border p-4 rounded shadow"> 
<div class="mb-3"> 
<label class="form-label">Nombre</label> 
<input type="text" name="nombre" class="form-control" required> 
</div> 
<label class="form-label">Correo Electrónico</label> 
<input type="email" name="email" class="form-control" required> 
</div> 
<div class="mb-3"> 
<label class="form-label">Contraseña</label> 
<input type="password" name="contraseña" class="form-control" required> 
</div> 
<button type="submit" class="btn btn-success w-100">Registrarse</button> 
</form> 
</div> 
</div> 
</div> 
