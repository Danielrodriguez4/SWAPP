<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Proyecto</h1>
            </div>
        </div>
    </div>
</section>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="card-tools">
                    <div class="input-group input-group-sm">
                    <?php
                        if ($_SESSION['user']->rol == 2) {
                            echo '<a href="?c=Estudiantes&a=Crud&p='. $alm->id .'"  style="border-color:white; background-color:#b90606;" class="btn btn-primary btn-block"><i class="fa fa-plus"></i>Agregar Estudiante</a>';
                        }
                        ?>   
                    </div>
                </div>
            </div>
            <form id="frm-proyecto" action="?c=Proyectos&a=Guardar" method="post" enctype="multipart/form-data">
                <div class="card-body">
                    <input type="hidden" name="id" value="<?php echo $alm->id; ?>" />

                    <div class="form-group">
                        <label>Titulo</label>
                        <input type="text" name="title" value="<?php echo $alm->titulo; ?>" class="form-control" placeholder="Ingrese Titulo del proyecto" data-validacion-tipo="requerido|min:3" />
                    </div>

                    <div class="form-group">
                        <label>Descripción</label>
                        <input type="text" name="description" value="<?php echo $alm->descripcion; ?>" class="form-control" placeholder="Ingrese la descripcion" data-validacion-tipo="requerido|min:10" />
                    </div>
                    <?php
                    if ($_SESSION['user']->rol == 1) {
                    ?><div class="form-group">
                            <a style="border-color:white; background-color:#b90606; color:black;" target="_blank" class="btn btn-outline-primary btn-block" href="<?php echo $alm->archivo ?>">Descargar proyecto</a>
                        </div>
                    <?php
                    } else {
                    ?><div class="form-group">
                            <p><strong>Archivo actual: </strong><?php echo $alm->archivo ?></p>
                        </div>
                        <div class="input-group">

                            <div class="custom-file">
                                <input type="file" name="archivo" class="custom-file-input" id="exampleInputFile">
                                <label class="custom-file-label" for="exampleInputFile">Seleccione el archivo</label>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                    <?php
                    if ($_SESSION['user']->rol == 1) {
                    ?> <div class="form-group">
                            <label>Comentario</label>
                            <input type="text" name="comentario" value="<?php echo $alm->comentario; ?>" class="form-control" placeholder="Agregue Comentarios" data-validacion-tipo="requerido|min:10" />
                        </div>
                    <?php
                    } else {
                    ?><div class="form-group">
                            <p><strong>Observaciones: </strong><?php echo $alm->comentario ?></p>
                        </div>
                    <?php
                    }
                    ?>
                    <?php
                    if ($_SESSION['user']->rol == 1) {
                    ?>
                        <div class="form-group">
                            <label>Director</label>
                            <select name="director" class="custom-select">
                                <option value="">Seleccione director</option>
                                <?php foreach ($docentes->Listar() as $docente) : ?>
                                    <option <?php echo $alm->director == $docente->id ? 'selected' : ''; ?> value="<?php echo $docente->id; ?>"><?php echo $docente->nombre; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Jurado1</label>
                            <select name="jurado1" class="custom-select">
                                <option value="">Seleccione Jurado1</option>
                                <?php foreach ($docentes->Listar() as $docente) : ?>
                                    <option <?php echo $alm->jurado1 == $docente->id ? 'selected' : ''; ?> value="<?php echo $docente->id; ?>"><?php echo $docente->nombre; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Jurado2</label>
                            <select name="jurado2" class="custom-select">
                                <option value="">Seleccione Jurado2</option>
                                <?php foreach ($docentes->Listar() as $docente) : ?>
                                    <option <?php echo $alm->jurado2 == $docente->id ? 'selected' : ''; ?> value="<?php echo $docente->id; ?>"><?php echo $docente->nombre; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Jurado3</label>
                            <select name="jurado3" class="custom-select">
                                <option value="">Seleccione Jurado3</option>
                                <?php foreach ($docentes->Listar() as $docente) : ?>
                                    <option <?php echo $alm->jurado3 == $docente->id ? 'selected' : ''; ?> value="<?php echo $docente->id; ?>"><?php echo $docente->nombre; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Nota</label>
                            <input type="number" name="nota" value="<?php echo $alm->nota; ?>" class="form-control" placeholder="Agregue Nota" data-validacion-tipo="requerido|min:10" />
                        </div>
                    <?php
                    } else if ($_SESSION['user']->rol == 2) {
                    ?>
                            <div class="form-group">
                                <label>Director</label>
                                <select name="director" class="custom-select">
                                    <?php $dir = $docentes->Obtener($alm->director); ?>
                                    <option value="<?php echo $dir->id; ?>" selected><?php echo $dir->nombre; ?></option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Jurado</label>
                                <select name="jurado1" class="custom-select">
                                    <?php $j1 = $docentes->Obtener($alm->jurado1); ?>
                                    <option value="<?php echo $j1->id; ?>" selected><?php echo $j1->nombre; ?></option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Jurado</label>
                                <select name="jurado2" class="custom-select">
                                    <?php $j2 = $docentes->Obtener($alm->jurado2); ?>
                                    <option value="<?php echo $j2->id; ?>" selected><?php echo $j2->nombre; ?></option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Jurado</label>
                                <select name="jurado3" class="custom-select">
                                    <?php $j3 = $docentes->Obtener($alm->jurado3); ?>
                                    <option value="<?php echo $j3->id; ?>" selected><?php echo $j3->nombre; ?></option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Nota</label>
                                <input type="number" name="nota" value="<?php echo $alm->nota; ?>" class="form-control" placeholder="Agregue Nota" data-validacion-tipo="requerido|min:10" disabled />
                            </div>
                    <?php
                    }
                    ?>
                </div>
            <div class="card-footer">
                <div class="text-right">
                    <?php
                    if ($_SESSION['user']->rol == 1) {
                    ?> <div class="form-group">
                            <button name='estado' value='2' type="submit" class="btn btn-warning">Revisado</button>

                            <button name='estado' value='3' type="submit" class="btn btn-success">Aprobado</button>

                            <button name='estado' value='4' type="submit" class="btn btn-danger">Finalizado</button>

                        </div>
                    <?php
                    } else {
                    ?><div class="form-group">
                            <button name='estado' value='1' type="submit" class="btn btn-success">Guardar</button>

                        </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
            </form>
        </div>
    </div>

</div>

<script>
    $(function() {
        bsCustomFileInput.init();
    });
</script>