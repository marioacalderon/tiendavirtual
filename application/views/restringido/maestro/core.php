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
                                <h4><?php echo $titulo; ?></h4>
                            </div>  

                            <?php
                                $atributos = array(
                                    'name' => 'form_core',
                                );

                                if (isset($categorias_principal)) 
                                {
                                    $categoria_principal_id = $categorias_principal->categoria_principal_id;
                                }
                                else
                                {
                                    $categoria_principal_id = '';
                                }
                            ?>
                            
                            <?php echo form_open('restringido/maestro/core/'.$categoria_principal_id, $atributos); ?>

                                <div class="card-body">
                                    <div class="form-row">
                                        <div class="form-group col-md-4">
                                            <label for="categoria_principal_nombre">Nombre de la marca <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="categoria_principal_nombre" id="categoria_principal_nombre" value="<?php echo (isset($categorias_principal) ? $categorias_principal->categoria_principal_nombre : set_value('categoria_principal_nombre')); ?>" autofocus autocomplete="off" onchange="this.value = this.value.capitalizeParagraph()">
                                            <?php echo form_error('categoria_principal_nombre', '<div class="text-danger">', '</div>') ?>
                                        </div> 

                                        <?php if (isset($categorias_principal)): ?>
                                            <div class="form-group col-md-4">
                                                <label for="categoria_principal_meta_link">Meta link de la marca</label>
                                                <input type="text" class="form-control" name="categoria_principal_meta_link" id="categoria_principal_meta_link" value="<?php echo $categorias_principal->categoria_principal_meta_link; ?>" readonly="">
                                            </div> 
                                        <?php endif; ?>                                    
                                        
                                        <div class="form-group col-md-4">
                                            <label for="categoria_principal_activa">Estado </label>
                                            <select id="categoria_principal_activa" class="form-control" name="categoria_principal_activa">
                                                <?php if (isset($categorias_principal)): ?>
                                                    <option value="1" <?php echo ($categorias_principal->categoria_principal_activa == 1) ? 'selected' : ''; ?>>Activa</option>
                                                    <option value="0" <?php echo ($categorias_principal->categoria_principal_activa == 0) ? 'selected' : ''; ?>>Inactiva</option>
                                                <?php else: ?>
                                                    <option value="1">Activa</option>
                                                    <option value="0">Inactiva</option>
                                                <?php endif; ?>
                                            </select>
                                        </div>
                                    </div>

                                    <?php if(isset($categorias_principal)): ?>
                                        <input type="hidden" name="categoria_principal_id" value="<?php echo $categorias_principal->categoria_principal_id; ?>">
                                    <?php endif; ?>
                                </div>

                                <div class="card-footer">
                                    <button class="btn btn-primary">Guardar</button>
                                    <a class="btn btn-default" href="<?php echo base_url('restringido/maestro'); ?>">Cancelar</a>
                                </div>

                            <?php echo form_close(); ?>
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