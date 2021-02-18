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

                            <?php
                                $atributos = array(
                                    'name' => 'form_core',
                                );

                                if (isset($usuario)) 
                                {
                                    $usuario_id = $usuario->id;
                                }
                                else
                                {
                                    $usuario_id = '';
                                }
                            ?>
                            
                            <?php echo form_open('restringido/usuarios/core/'.$usuario_id, $atributos) ?>

                                <div class="card-body">
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="first_name">Nombre <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="first_name" id="first_name" value="<?php echo (isset($usuario) ? $usuario->first_name : set_value('first_name')) ?>" placeholder="Nombre del usuario" autofocus autocomplete="off" onchange="this.value = this.value.capitalizeParagraph()">
                                            <?php echo form_error('first_name', '<div class="text-danger">', '</div>') ?>
                                        </div> 
                                        <div class="form-group col-md-6">
                                            <label for="last_name">Apellidos <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="last_name" id="last_name" value="<?php echo (isset($usuario) ? $usuario->last_name : set_value('last_name')) ?>" placeholder="Apellidos del usuario" autocomplete="off" onchange="this.value = this.value.capitalizeParagraph()">
                                            <?php echo form_error('last_name', '<div class="text-danger">', '</div>') ?>
                                        </div>                                 
                                    </div>

                                    <div class="form-row">            
                                        <div class="form-group col-md-6">
                                            <label for="username">Usuario <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="username" id="username" value="<?php echo (isset($usuario) ? $usuario->username : set_value('username')) ?>" placeholder="Usuario" autocomplete="off">
                                            <?php echo form_error('username', '<div class="text-danger">', '</div>') ?>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="email">Email <span class="text-danger">*</span></label>
                                            <input type="email" class="form-control" name="email" id="email" value="<?php echo (isset($usuario) ? $usuario->email : set_value('email')) ?>" placeholder="Email" autocomplete="off">
                                            <?php echo form_error('email', '<div class="text-danger">', '</div>') ?>
                                        </div>
                                    </div>

                                    <div class="form-row">   
                                        <div class="form-group col-md-6">
                                            <label for="password">Contraseña (Mínimo 5 caracteres) <span class="text-danger">*</span></label>
                                            <input type="password" class="form-control" name="password" id="password" placeholder="">
                                            
                                            <?php echo form_error('password', '<div class="text-danger">', '</div>') ?>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="conf_password">Confirmar contraseña <span class="text-danger">*</span></label>
                                            <input type="password" class="form-control" name="conf_password" id="conf_password" >
                                            <?php echo form_error('conf_password', '<div class="text-danger">', '</div>') ?>
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="active">Estado </label>
                                            <select id="active" class="form-control" name="active">
                                                <?php if (isset($usuario)): ?>
                                                    <option value="1" <?php echo ($usuario->active == 1) ? 'selected' : '' ?>>Activo</option>
                                                    <option value="0" <?php echo ($usuario->active == 0) ? 'selected' : '' ?>>Inactivo</option>
                                                <?php else: ?>
                                                    <option value="1">Activo</option>
                                                    <option value="0">Inactivo</option>
                                                <?php endif; ?>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="perfil">Perfil de acceso </label>
                                            <select id="perfil" class="form-control" name="perfil">
                                                <?php foreach ($grupos as $grupo): ?>
                                                    <?php if (isset($usuario)): ?>
                                                        <option value="<?php echo $grupo->id ?>" <?php echo ($grupo->id == $perfil->id) ? 'selected': '' ?>><?php echo $grupo->description?></option>
                                                    <?php else: ?>
                                                        <option value="<?php echo $grupo->id ?>"><?php echo $grupo->description?></option>
                                                    <?php endif; ?>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <?php if(isset($usuario)): ?>
                                        <input type="hidden" name="usuario_id" value="<?php echo $usuario->id?>">
                                    <?php endif; ?>
                                </div>

                                <div class="card-footer">
                                    <button class="btn btn-primary">Guardar</button>
                                    <a class="btn btn-default" href="<?php echo base_url('restringido/usuarios') ?>">Cancelar</a>
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