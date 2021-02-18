<?php $this->load->view('restringido/layouts/navbar'); ?>

    <?php $this->load->view('restringido/layouts/sidebar'); ?>

    <!-- Main Content -->
    <div class="main-content">
        <section class="section">
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4><?php echo $titulo ?></h4>
                            </div>  

                            <?php echo form_open('restringido/sistema'); ?>

                                <div class="card-body">
                                
                                <?php $this->load->view('mensajes'); ?>

                                    <div class="form-row">
                                        <div class="form-group col-md-4">
                                            <label for="sistema_razon_social">Razón social <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="sistema_razon_social" value="<?php echo (isset($sistema) ? $sistema->sistema_razon_social : set_value('sistema_razon_social')); ?>" autofocus onchange="this.value = this.value.capitalizeParagraph()">
                                            <?php echo form_error('sistema_razon_social', '<div class="text-danger">', '</div>'); ?>
                                        </div>    

                                        <div class="form-group col-md-4">
                                            <label for="sistema_nombre">Nombre de la tienda <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="sistema_nombre" value="<?php echo (isset($sistema) ? $sistema->sistema_nombre : set_value('sistema_nombre')); ?>" onchange="this.value = this.value.capitalizeParagraph()">
                                            <?php echo form_error('sistema_nombre', '<div class="text-danger">', '</div>'); ?>
                                        </div>      

                                        <div class="form-group col-md-4">
                                            <label for="sistema_nit">Número de Nit <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control nit" name="sistema_nit" value="<?php echo (isset($sistema) ? $sistema->sistema_nit : set_value('sistema_nit')); ?>">
                                            <?php echo form_error('sistema_nit', '<div class="text-danger">', '</div>'); ?>
                                        </div>                   
                                    </div>
                                    
                                    <div class="form-row">
                                        <div class="form-group col-md-3">
                                            <label for="sistema_telefono_fijo">Teléfono <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control telefono_fijo" name="sistema_telefono_fijo" value="<?php echo (isset($sistema) ? $sistema->sistema_telefono_fijo : set_value('sistema_telefono_fijo')); ?>">
                                            <?php echo form_error('sistema_telefono_fijo', '<div class="text-danger">', '</div>'); ?>
                                        </div>    

                                        <div class="form-group col-md-3">
                                            <label for="sistema_telefono_movil">Teléfono celular </label>
                                            <input type="text" class="form-control telefono_celular" name="sistema_telefono_movil" value="<?php echo (isset($sistema) ? $sistema->sistema_telefono_movil : set_value('sistema_telefono_movil')); ?>">
                                        </div>      

                                        <div class="form-group col-md-3">
                                            <label for="sistema_email">E-mail de contacto <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="sistema_email" value="<?php echo (isset($sistema) ? $sistema->sistema_email : set_value('sistema_email')); ?>">
                                            <?php echo form_error('sistema_email', '<div class="text-danger">', '</div>'); ?>
                                        </div>      

                                        <div class="form-group col-md-3">
                                            <label for="sistema_sitio_url">Url del sitio web <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="sistema_sitio_url" value="<?php echo (isset($sistema) ? $sistema->sistema_sitio_url : set_value('sistema_sitio_url')); ?>">
                                            <?php echo form_error('sistema_sitio_url', '<div class="text-danger">', '</div>'); ?>
                                        </div>                   
                                    </div>
                                    
                                    <div class="form-row">
                                        <div class="form-group col-md-2">
                                            <label for="sistema_postal">Código postal </label>
                                            <input type="number" class="form-control postal" name="sistema_postal" value="<?php echo (isset($sistema) ? $sistema->sistema_postal : set_value('sistema_postal')); ?>">
                                        </div>    

                                        <div class="form-group col-md-3">
                                            <label for="sistema_direccion">Dirección <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control " name="sistema_direccion" value="<?php echo (isset($sistema) ? $sistema->sistema_direccion : set_value('sistema_direccion')); ?>">
                                            <?php echo form_error('sistema_direccion', '<div class="text-danger">', '</div>'); ?>
                                        </div>      

                                        <div class="form-group col-md-3">
                                            <label for="sistema_barrio">Barrio <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="sistema_barrio" value="<?php echo (isset($sistema) ? $sistema->sistema_barrio : set_value('sistema_barrio')); ?>" onchange="this.value = this.value.capitalizeParagraph()">
                                            <?php echo form_error('sistema_barrio', '<div class="text-danger">', '</div>'); ?>
                                        </div>      

                                        <div class="form-group col-md-2">
                                            <label for="sistema_ciudad">Ciudad <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="sistema_ciudad" value="<?php echo (isset($sistema) ? $sistema->sistema_ciudad : set_value('sistema_ciudad')); ?>" onchange="this.value = this.value.capitalizeParagraph()">
                                            <?php echo form_error('sistema_ciudad', '<div class="text-danger">', '</div>'); ?>
                                        </div>        

                                        <div class="form-group col-md-2">
                                            <label for="sistema_departamento">Departamento <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="sistema_departamento" value="<?php echo (isset($sistema) ? $sistema->sistema_departamento : set_value('sistema_departamento')); ?>" onchange="this.value = this.value.capitalizeParagraph()">
                                            <?php echo form_error('sistema_departamento', '<div class="text-danger">', '</div>'); ?>
                                        </div>                  
                                    </div>
                                    
                                    <div class="form-row">
                                        <div class="form-group col-md-3">
                                            <label for="sistema_productos_destacados">Cantidad de productos destacados a mostrar <span class="text-danger">*</span></label>
                                            <input type="number" class="form-control postal" name="sistema_productos_destacados" value="<?php echo (isset($sistema) ? $sistema->sistema_productos_destacados : set_value('sistema_productos_destacados')); ?>">
                                        </div>                         
                                    </div>
                                </div>

                                <div class="card-footer">
                                    <button class="btn btn-primary">Guardar</button>
                                </div>

                            <?php echo form_close() ?>
                        </div>                    
                    </div>
                </div>
            </div>
        </section>
    </div>

    <?php $this->load->view('restringido/layouts/sidebar_settings'); ?>

<script>
    String.prototype.capitalizeParagraph = function() {
        var res = "";
        var paragraphs = this.split(" ");
        for(var i = 0; i < paragraphs.length ; i++) {
            var temp = paragraphs[i].trim();
            res += " " + temp.charAt(0).toUpperCase() + temp.slice(1).toLowerCase();
        }
        return res.slice(1);
    };
</script>