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
                                <a class="btn btn-primary float-right" href="<?php echo base_url('restringido/productos/core'); ?>">Registrar nuevo producto</a>
                            </div>
                            <div class="card-body"> 
                            
                                <?php $this->load->view('mensajes'); ?>

                                <div class="table-responsive">
                                    <table class="table table-striped data-table" id="" >
                                        <thead>
                                            <tr>
                                                <th class="text-center" width="30">#</th>
                                                <th>Código</th>
                                                <th>Nombre del producto</th>
                                                <th>Marca</th>
                                                <th>Categoría</th>
                                                <th>Valor</th>
                                                <th class="text-center">Estado</th>
                                                <th class="text-center nosort">Acción</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $no = 1; foreach ($productos as $producto): ?>
                                                <tr>
                                                    <td class="text-center"><?php echo $no++; ?>.</td>
                                                    <td><?php echo $producto->producto_codigo; ?></td>
                                                    <td><?php echo $producto->producto_nombre; ?></td>
                                                    <td><?php echo $producto->marca_nombre; ?></td>
                                                    <td><?php echo $producto->categoria_nombre; ?></td>
                                                    <td><?php echo number_format($producto->producto_valor); ?></td>
                                                    <td class="text-center"><?php echo ($producto->producto_activo == 1) ? '<span class="badge badge-success">Activo</span>' : '<span class="badge badge-danger">Inactivo</span>'; ?></td>
                                                    <td class="text-center" width="150px">
                                                        <a href="<?php echo base_url('restringido/productos/core/'.$producto->producto_id); ?>" class="btn btn-primary btn-icon btn-sm">Editar</a>
                                                        <a href="<?php echo base_url('restringido/productos/delete/'.$producto->producto_id); ?>" class="btn btn-danger btn-icon btn-sm delete" data-confirm="¿Está seguro de eliminar el producto?">Eliminar</a>
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
