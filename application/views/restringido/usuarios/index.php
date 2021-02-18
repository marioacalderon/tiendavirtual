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
                                <a class="btn btn-primary float-right" href="<?php echo base_url('restringido/usuarios/core'); ?>">Registrar nuevo usuario</a>
                            </div>
                            <div class="card-body"> 

                                <?php if ($message = $this->session->flashdata('success')): ?>
                                    <div class="alert alert-success alert-dismissible show fade">
                                        <div class="alert-body">
                                            <button class="close" data-dismiss="alert">
                                            <span>&times;</span>
                                            </button>
                                            <?php echo $message; ?>
                                        </div>
                                    </div>
                                <?php endif; ?>

                                <?php if ($message = $this->session->flashdata('error')): ?>
                                    <div class="alert alert-danger alert-dismissible show fade">
                                        <div class="alert-body">
                                            <button class="close" data-dismiss="alert">
                                            <span>&times;</span>
                                            </button>
                                            <?php echo $message; ?>
                                        </div>
                                    </div>
                                <?php endif; ?>

                                <div class="table-responsive">
                                    <table class="table table-striped data-table" id="" >
                                        <thead>
                                            <tr>
                                                <th class="text-center" width="30">#</th>
                                                <th>Nombre</th>
                                                <th>E-mail</th>
                                                <th>Perfil de acceso</th>
                                                <th class="text-center">Estado</th>
                                                <th class="text-center nosort">Acción</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $no = 1; foreach ($usuarios as $usuario): ?>
                                                <tr>
                                                    <td class="text-center"><?php echo $no++ ?>.</td>
                                                    <td><?php echo $usuario->first_name .' '. $usuario->last_name ?></td>
                                                    <td><?php echo $usuario->email ?></td>
                                                    <td><?php echo ($this->ion_auth->is_admin($usuario->id) ? 'Administrador' : 'Cliente') ?></td>
                                                    <td class="text-center"><?php echo ($usuario->active == 1) ? '<span class="badge badge-success">Activo</span>' : '<span class="badge badge-danger">Inactivo</span>' ?></td>
                                                    <td class="text-center" width="150px">
                                                        <a href="<?php echo base_url('restringido/usuarios/core/'.$usuario->id) ?>" class="btn btn-primary btn-icon btn-sm">Editar</a>
                                                        <a href="<?php echo base_url('restringido/usuarios/delete/'.$usuario->id); ?>" class="btn btn-danger btn-icon btn-sm delete" data-confirm="¿Está seguro de eliminar?">Eliminar</a>
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
