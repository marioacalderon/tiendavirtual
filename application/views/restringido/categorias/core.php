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

                                if (isset($categorias)) 
                                {
                                    $categoria_id = $categorias->categoria_id;
                                }
                                else
                                {
                                    $categoria_id = '';
                                }
                            ?>
                            
                            <?php echo form_open('restringido/categorias/core/'.$categoria_id, $atributos); ?>    
                            <?php $col = ($categoria_id == '') ?  4 :  2; ?> 

                                <div class="card-body">
                                    <div class="form-row">
                                        <div class="form-group col-md-4">
                                            <label for="categoria_nombre">Nombre de la categoría <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="categoria_nombre" id="categoria_nombre" value="<?php echo (isset($categorias) ? $categorias->categoria_nombre : set_value('categoria_nombre')); ?>" autofocus autocomplete="off" onchange="this.value = this.value.capitalizeParagraph()">
                                            <?php echo form_error('categoria_nombre', '<div class="text-danger">', '</div>') ?>
                                        </div> 

                                        <?php if (isset($categorias)): ?>
                                            <div class="form-group col-md-4">
                                                <label for="categoria_meta_link">Meta link de la categoría</label>
                                                <input type="text" class="form-control" name="categoria_meta_link" id="categoria_meta_link" value="<?php echo $categorias->categoria_meta_link; ?>" readonly="">
                                            </div> 
                                        <?php endif; ?>                                  
                                        
                                        <div class="form-group col-md-<?php echo $col; ?>">
                                            <label for="categoria_principal_id">Categoría principal <span class="text-danger">*</span></label>
                                            <select id="categoria_principal_id" class="form-control" name="categoria_principal_id">
                                                <?php foreach ($maestros as $principal): ?>
                                                    <?php if (isset($categorias)): ?>
                                                        <option value="<?php echo $principal->categoria_principal_id; ?>" <?php echo ($principal->categoria_principal_id == $categorias->categoria_principal_id) ? 'selected' : ''; ?>><?php echo $principal->categoria_principal_nombre; ?></option>
                                                    <?php else: ?>
                                                        <option value="<?php echo $principal->categoria_principal_id; ?>"><?php echo $principal->categoria_principal_nombre;?></option>
                                                    <?php endif; ?>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>                            
                                        
                                        <div class="form-group col-md-<?php echo $col; ?>">
                                            <label for="categoria_activa">Estado </label>
                                            <select id="categoria_activa" class="form-control" name="categoria_activa">
                                                <?php if (isset($categorias)): ?>
                                                    <option value="1" <?php echo ($categorias->categoria_activa == 1) ? 'selected' : ''; ?>>Activa</option>
                                                    <option value="0" <?php echo ($categorias->categoria_activa == 0) ? 'selected' : ''; ?>>Inactiva</option>
                                                <?php else: ?>
                                                    <option value="1">Activa</option>
                                                    <option value="0">Inactiva</option>
                                                <?php endif; ?>
                                            </select>
                                        </div>  
                                    </div>

                                    <?php if(isset($categorias)): ?>
                                        <input type="hidden" name="categoria_id" value="<?php echo $categorias->categoria_id; ?>">
                                    <?php endif; ?>
                                </div>

                                <div class="card-footer">
                                    <button class="btn btn-primary">Guardar</button>
                                    <a class="btn btn-default" href="<?php echo base_url('restringido/categorias'); ?>">Cancelar</a>
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