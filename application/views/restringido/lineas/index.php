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
                                <a class="btn btn-primary float-right" href="<?php echo base_url('restringido/lineas/core'); ?>">Registrar nuevo linea</a>
                            </div>
                            <div class="card-body"> 
                            
                                <?php $this->load->view('mensajes'); ?>

                                <div class="table-responsive">
                                    <table class="table table-striped data-table" id="" >
                                        <thead>
                                            <tr>
                                                <th class="text-center" width="30">#</th>
                                                <th>Nombre de la linea</th>
                                                <th>Meta link de la linea</th>
                                                <th>Creada</th>
                                                <th class="text-center">Estado</th>
                                                <th class="text-center nosort">Acción</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $no = 1; foreach ($lineas as $linea): ?>
                                                <tr>
                                                    <td class="text-center"><?php echo $no++; ?>.</td>
                                                    <td><?php echo $linea->linea_nombre; ?></td>
                                                    <td><i class="text-info" data-feather="link"></i>&nbsp;<?php echo $linea->linea_meta_link; ?></td>
                                                    <td><?php echo formato_fecha_con_hora($linea->linea_creado); ?></td>
                                                    <td class="text-center"><?php echo ($linea->linea_activa == 1) ? '<span class="badge badge-success">Activa</span>' : '<span class="badge badge-danger">Inactiva</span>'; ?></td>
                                                    <td class="text-center" width="150px">
                                                        <a href="<?php echo base_url('restringido/lineas/core/'.$linea->linea_id); ?>" class="btn btn-primary btn-icon btn-sm">Editar</a>
                                                        <a href="<?php echo base_url('restringido/lineas/delete/'.$linea->linea_id); ?>" class="btn btn-danger btn-icon btn-sm delete" data-confirm="¿Está seguro de eliminar la linea?">Eliminar</a>
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
