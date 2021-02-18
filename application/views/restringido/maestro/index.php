<?php $this->load->view('restringido/layouts/navbar'); ?>

    <?php $this->load->view('restringido/layouts/sidebar'); ?>

    <!-- Main Content -->
    <div class="main-content">
        <section class="section">
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header d-block">
                                <h4><?php echo $titulo ?></h4>   
                                <a class="btn btn-primary float-right" href="<?php echo base_url('restringido/maestro/core'); ?>">Registrar nueva categoría</a>
                            </div>
                            <div class="card-body"> 
                            
                                <?php $this->load->view('mensajes'); ?>

                                <div class="table-responsive">
                                    <table class="table table-striped data-table" id="" >
                                        <thead>
                                            <tr>
                                                <th class="text-center" width="30">#</th>
                                                <th>Nombre de la categoría</th>
                                                <th>Meta link de la categoría</th>
                                                <th>Creada</th>
                                                <th class="text-center">Estado</th>
                                                <th class="text-center nosort">Acción</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $no = 1; foreach ($categorias_principal as $categoria_principal): ?>
                                                <tr>
                                                    <td class="text-center"><?php echo $no++; ?>.</td>
                                                    <td><?php echo $categoria_principal->categoria_principal_nombre; ?></td>
                                                    <td><i class="text-info" data-feather="link"></i>&nbsp;<?php echo $categoria_principal->categoria_principal_meta_link; ?></td>
                                                    <td><?php echo formato_fecha_con_hora($categoria_principal->categoria_principal_creado); ?></td>
                                                    <td class="text-center"><?php echo ($categoria_principal->categoria_principal_activa == 1) ? '<span class="badge badge-success">Activa</span>' : '<span class="badge badge-danger">Inactiva</span>'; ?></td>
                                                    <td class="text-center" width="150px">
                                                        <a href="<?php echo base_url('restringido/maestro/core/'.$categoria_principal->categoria_principal_id); ?>" class="btn btn-primary btn-icon btn-sm">Editar</a>
                                                        <a href="<?php echo base_url('restringido/maestro/delete/'.$categoria_principal->categoria_principal_id); ?>" class="btn btn-danger btn-icon btn-sm delete" data-confirm="¿Está seguro de eliminar la categoria principal?">Eliminar</a>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table> 
                                </div>
                            </div>
                        </div>                    
                    </div>
                </div>
            </div>
        </section>
    </div>

    <?php $this->load->view('restringido/layouts/sidebar_settings'); ?>
