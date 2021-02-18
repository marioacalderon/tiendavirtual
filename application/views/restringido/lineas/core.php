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

                                if (isset($lineas)) 
                                {
                                    $linea_id = $lineas->linea_id;
                                }
                                else
                                {
                                    $linea_id = '';
                                }
                            ?>
                            
                            <?php echo form_open('restringido/lineas/core/'.$linea_id, $atributos); ?>

                                <div class="card-body">
                                    <div class="form-row">
                                        <div class="form-group col-md-4">
                                            <label for="linea_nombre">Nombre de la linea <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="linea_nombre" id="linea_nombre" value="<?php echo (isset($lineas) ? $lineas->linea_nombre : set_value('linea_nombre')); ?>" autofocus autocomplete="off" onchange="this.value = this.value.capitalizeParagraph()">
                                            <?php echo form_error('linea_nombre', '<div class="text-danger">', '</div>') ?>
                                        </div> 

                                        <?php if (isset($lineas)): ?>
                                            <div class="form-group col-md-4">
                                                <label for="linea_meta_link">Meta link de la linea</label>
                                                <input type="text" class="form-control" name="linea_meta_link" id="linea_meta_link" value="<?php echo $lineas->linea_meta_link; ?>" readonly="">
                                            </div> 
                                        <?php endif; ?>                                    
                                        
                                        <div class="form-group col-md-4">
                                            <label for="linea_activa">Estado </label>
                                            <select id="linea_activa" class="form-control" name="linea_activa">
                                                <?php if (isset($lineas)): ?>
                                                    <option value="1" <?php echo ($lineas->linea_activa == 1) ? 'selected' : ''; ?>>Activa</option>
                                                    <option value="0" <?php echo ($lineas->linea_activa == 0) ? 'selected' : ''; ?>>Inactiva</option>
                                                <?php else: ?>
                                                    <option value="1">Activa</option>
                                                    <option value="0">Inactiva</option>
                                                <?php endif; ?>
                                            </select>
                                        </div>
                                    </div>

                                    <?php if(isset($lineas)): ?>
                                        <input type="hidden" name="linea_id" value="<?php echo $lineas->linea_id; ?>">
                                    <?php endif; ?>
                                </div>

                                <div class="card-footer">
                                    <button class="btn btn-primary">Guardar</button>
                                    <a class="btn btn-default" href="<?php echo base_url('restringido/lineas'); ?>">Cancelar</a>
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