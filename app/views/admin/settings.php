<!-- Página de configurações do sistema -->

<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Configurações do Sistema</h1>
    </div>

    <!-- Formulário de configurações -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Configurações Gerais</h6>
        </div>
        <div class="card-body">
            <form class="form-admin" action="/admin/settings/save" method="post">
                <!-- Informações da Empresa -->
                <div class="mb-4">
                    <h5 class="border-bottom pb-2">Informações da Empresa</h5>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="company_name" class="form-label">Nome da Empresa</label>
                            <input type="text" class="form-control" id="company_name" name="company_name" value="<?php echo $settings['company_name']; ?>" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="company_slogan" class="form-label">Slogan</label>
                            <input type="text" class="form-control" id="company_slogan" name="company_slogan" value="<?php echo $settings['company_slogan']; ?>">
                        </div>
                    </div>
                </div>

                <!-- Informações de Contato -->
                <div class="mb-4">
                    <h5 class="border-bottom pb-2">Informações de Contato</h5>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="address" class="form-label">Endereço</label>
                            <input type="text" class="form-control" id="address" name="address" value="<?php echo $settings['address']; ?>" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="phone" class="form-label">Telefone</label>
                            <input type="text" class="form-control" id="phone" name="phone" value="<?php echo $settings['phone']; ?>" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="email" class="form-label">E-mail</label>
                            <input type="email" class="form-control" id="email" name="email" value="<?php echo $settings['email']; ?>" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="working_hours" class="form-label">Horário de Funcionamento</label>
                            <input type="text" class="form-control" id="working_hours" name="working_hours" value="<?php echo $settings['working_hours']; ?>">
                        </div>
                    </div>
                </div>

                <!-- Redes Sociais -->
                <div class="mb-4">
                    <h5 class="border-bottom pb-2">Redes Sociais</h5>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="facebook" class="form-label">Facebook</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fab fa-facebook"></i></span>
                                <input type="text" class="form-control" id="facebook" name="facebook" value="<?php echo $settings['facebook']; ?>">
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="instagram" class="form-label">Instagram</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fab fa-instagram"></i></span>
                                <input type="text" class="form-control" id="instagram" name="instagram" value="<?php echo $settings['instagram']; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="linkedin" class="form-label">LinkedIn</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fab fa-linkedin"></i></span>
                                <input type="text" class="form-control" id="linkedin" name="linkedin" value="<?php echo $settings['linkedin']; ?>">
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="youtube" class="form-label">YouTube</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fab fa-youtube"></i></span>
                                <input type="text" class="form-control" id="youtube" name="youtube" value="<?php echo $settings['youtube']; ?>">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- WhatsApp -->
                <div class="mb-4">
                    <h5 class="border-bottom pb-2">WhatsApp</h5>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="whatsapp_number" class="form-label">Número do WhatsApp</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fab fa-whatsapp"></i></span>
                                <input type="text" class="form-control" id="whatsapp_number" name="whatsapp_number" value="<?php echo $settings['whatsapp_number']; ?>">
                            </div>
                            <div class="form-text">Formato: 5511999999999 (código do país + DDD + número)</div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="whatsapp_message" class="form-label">Mensagem Padrão</label>
                            <input type="text" class="form-control" id="whatsapp_message" name="whatsapp_message" value="<?php echo $settings['whatsapp_message']; ?>">
                            <div class="form-text">Mensagem que será pré-preenchida quando o usuário clicar no botão do WhatsApp</div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="whatsapp_active" name="whatsapp_active" <?php echo $settings['whatsapp_active'] ? 'checked' : ''; ?>>
                                <label class="form-check-label" for="whatsapp_active">Exibir botão do WhatsApp no site</label>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Configurações de E-mail -->
                <div class="mb-4">
                    <h5 class="border-bottom pb-2">Configurações de E-mail</h5>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="contact_email" class="form-label">E-mail para Recebimento de Contatos</label>
                            <input type="email" class="form-control" id="contact_email" name="contact_email" value="<?php echo $settings['contact_email']; ?>" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="resume_email" class="form-label">E-mail para Recebimento de Currículos</label>
                            <input type="email" class="form-control" id="resume_email" name="resume_email" value="<?php echo $settings['resume_email']; ?>" required>
                        </div>
                    </div>
                </div>

                <!-- Configurações de SEO -->
                <div class="mb-4">
                    <h5 class="border-bottom pb-2">Configurações de SEO</h5>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="meta_title" class="form-label">Título do Site (Meta Title)</label>
                            <input type="text" class="form-control" id="meta_title" name="meta_title" value="<?php echo $settings['meta_title']; ?>">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="meta_keywords" class="form-label">Palavras-chave (Meta Keywords)</label>
                            <input type="text" class="form-control" id="meta_keywords" name="meta_keywords" value="<?php echo $settings['meta_keywords']; ?>">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 mb-3">
                            <label for="meta_description" class="form-label">Descrição do Site (Meta Description)</label>
                            <textarea class="form-control" id="meta_description" name="meta_description" rows="3"><?php echo $settings['meta_description']; ?></textarea>
                        </div>
                    </div>
                </div>

                <!-- Botões de Ação -->
                <div class="text-end">
                    <button type="reset" class="btn btn-secondary">Restaurar Padrões</button>
                    <button type="submit" class="btn btn-primary">Salvar Configurações</button>
                </div>
            </form>
        </div>
    </div>
</div>
