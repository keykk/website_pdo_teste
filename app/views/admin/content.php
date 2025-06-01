<!-- Página de edição de conteúdo das páginas -->

<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edição de Conteúdo</h1>
    </div>

    <!-- Abas para diferentes páginas -->
    <ul class="nav nav-tabs mb-4" id="contentTabs" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Página Inicial</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="historia-tab" data-bs-toggle="tab" data-bs-target="#historia" type="button" role="tab" aria-controls="historia" aria-selected="false">História</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="portfolio-tab" data-bs-toggle="tab" data-bs-target="#portfolio" type="button" role="tab" aria-controls="portfolio" aria-selected="false">Portfólio</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="trabalhe-tab" data-bs-toggle="tab" data-bs-target="#trabalhe" type="button" role="tab" aria-controls="trabalhe" aria-selected="false">Trabalhe Conosco</button>
        </li>
    </ul>

    <!-- Conteúdo das abas -->
    <div class="tab-content" id="contentTabsContent">
        <!-- Página Inicial -->
        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Conteúdo da Página Inicial</h6>
                </div>
                <div class="card-body">
                    <form class="form-admin" action="/admin/content/save" method="post">
                        <input type="hidden" name="page" value="home">
                        
                        <div class="mb-4">
                            <h5 class="border-bottom pb-2">Seção Principal</h5>
                            <div class="mb-3">
                                <label for="home_title" class="form-label">Título Principal</label>
                                <input type="text" class="form-control" id="home_title" name="home_title" value="<?php echo $content['home']['title']; ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="home_subtitle" class="form-label">Subtítulo</label>
                                <input type="text" class="form-control" id="home_subtitle" name="home_subtitle" value="<?php echo $content['home']['subtitle']; ?>">
                            </div>
                        </div>
                        
                        <div class="mb-4">
                            <h5 class="border-bottom pb-2">Seção Sustentabilidade</h5>
                            <div class="mb-3">
                                <label for="sustainability_title" class="form-label">Título</label>
                                <input type="text" class="form-control" id="sustainability_title" name="sustainability_title" value="<?php echo $content['home']['sustainability_title']; ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="sustainability_content" class="form-label">Conteúdo</label>
                                <textarea class="form-control ckeditor" id="sustainability_content" name="sustainability_content" rows="5"><?php echo $content['home']['sustainability_content']; ?></textarea>
                            </div>
                        </div>
                        
                        <div class="mb-4">
                            <h5 class="border-bottom pb-2">Seção Valores</h5>
                            <div class="mb-3">
                                <label for="values_title" class="form-label">Título</label>
                                <input type="text" class="form-control" id="values_title" name="values_title" value="<?php echo $content['home']['values_title']; ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="values_content" class="form-label">Conteúdo</label>
                                <textarea class="form-control ckeditor" id="values_content" name="values_content" rows="5"><?php echo $content['home']['values_content']; ?></textarea>
                            </div>
                        </div>
                        
                        <div class="mb-4">
                            <h5 class="border-bottom pb-2">Seção Certificados</h5>
                            <div class="mb-3">
                                <label for="certificates_title" class="form-label">Título</label>
                                <input type="text" class="form-control" id="certificates_title" name="certificates_title" value="<?php echo $content['home']['certificates_title']; ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="certificates_content" class="form-label">Conteúdo</label>
                                <textarea class="form-control ckeditor" id="certificates_content" name="certificates_content" rows="5"><?php echo $content['home']['certificates_content']; ?></textarea>
                            </div>
                        </div>
                        
                        <div class="mb-4">
                            <h5 class="border-bottom pb-2">Seção Benefícios</h5>
                            <div class="mb-3">
                                <label for="benefits_title" class="form-label">Título</label>
                                <input type="text" class="form-control" id="benefits_title" name="benefits_title" value="<?php echo $content['home']['benefits_title']; ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="benefits_content" class="form-label">Conteúdo</label>
                                <textarea class="form-control ckeditor" id="benefits_content" name="benefits_content" rows="5"><?php echo $content['home']['benefits_content']; ?></textarea>
                            </div>
                        </div>
                        
                        <div class="mb-4">
                            <h5 class="border-bottom pb-2">Seção Indústria</h5>
                            <div class="mb-3">
                                <label for="industry_title" class="form-label">Título</label>
                                <input type="text" class="form-control" id="industry_title" name="industry_title" value="<?php echo $content['home']['industry_title']; ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="industry_content" class="form-label">Conteúdo</label>
                                <textarea class="form-control ckeditor" id="industry_content" name="industry_content" rows="5"><?php echo $content['home']['industry_content']; ?></textarea>
                            </div>
                        </div>
                        
                        <div class="text-end">
                            <button type="submit" class="btn btn-primary">Salvar Alterações</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        <!-- Página História -->
        <div class="tab-pane fade" id="historia" role="tabpanel" aria-labelledby="historia-tab">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Conteúdo da Página História</h6>
                </div>
                <div class="card-body">
                    <form class="form-admin" action="/admin/content/save" method="post">
                        <input type="hidden" name="page" value="historia">
                        
                        <div class="mb-4">
                            <h5 class="border-bottom pb-2">Cabeçalho</h5>
                            <div class="mb-3">
                                <label for="historia_title" class="form-label">Título</label>
                                <input type="text" class="form-control" id="historia_title" name="historia_title" value="<?php echo $content['historia']['title']; ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="historia_subtitle" class="form-label">Subtítulo</label>
                                <input type="text" class="form-control" id="historia_subtitle" name="historia_subtitle" value="<?php echo $content['historia']['subtitle']; ?>">
                            </div>
                        </div>
                        
                        <div class="mb-4">
                            <h5 class="border-bottom pb-2">Conteúdo Principal</h5>
                            <div class="mb-3">
                                <label for="historia_content" class="form-label">História da Empresa</label>
                                <textarea class="form-control ckeditor" id="historia_content" name="historia_content" rows="10"><?php echo $content['historia']['main_content_content']; ?></textarea>
                            </div>
                        </div>
                        
                        <div class="mb-4">
                            <h5 class="border-bottom pb-2">Missão, Visão e Valores</h5>
                            <div class="mb-3">
                                <label for="missao" class="form-label">Missão</label>
                                <textarea class="form-control" id="missao" name="missao" rows="3"><?php echo $content['historia']['missao_content']; ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="visao" class="form-label">Visão</label>
                                <textarea class="form-control" id="visao" name="visao" rows="3"><?php echo $content['historia']['visao_content']; ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="valores" class="form-label">Valores (um por linha)</label>
                                <textarea class="form-control" id="valores" name="valores" rows="5"><?php echo $content['historia']['valores_content']; ?></textarea>
                            </div>
                        </div>
                        
                        <div class="mb-4">
                            <h5 class="border-bottom pb-2">Mapa de Atuação</h5>
                            <div class="mb-3">
                                <label for="mapa_title" class="form-label">Título</label>
                                <input type="text" class="form-control" id="mapa_title" name="mapa_title" value="<?php echo $content['historia']['mapa_title']; ?>">
                            </div>
                            <div class="mb-3">
                                <label for="mapa_description" class="form-label">Descrição</label>
                                <textarea class="form-control" id="mapa_description" name="mapa_description" rows="3"><?php echo $content['historia']['mapa_content']; ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="paises" class="form-label">Países de Atuação (um por linha)</label>
                                <textarea class="form-control" id="paises" name="paises" rows="5"><?php echo $content['historia']['paises_content']; ?></textarea>
                            </div>
                        </div>
                        
                        <div class="text-end">
                            <button type="submit" class="btn btn-primary">Salvar Alterações</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        <!-- Página Portfólio -->
        <div class="tab-pane fade" id="portfolio" role="tabpanel" aria-labelledby="portfolio-tab">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Conteúdo da Página Portfólio</h6>
                </div>
                <div class="card-body">
                    <form class="form-admin" action="/admin/content/save" method="post">
                        <input type="hidden" name="page" value="portfolio">
                        
                        <div class="mb-4">
                            <h5 class="border-bottom pb-2">Cabeçalho</h5>
                            <div class="mb-3">
                                <label for="portfolio_title" class="form-label">Título</label>
                                <input type="text" class="form-control" id="portfolio_title" name="portfolio_title" value="<?php echo $content['portfolio']['title']; ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="portfolio_subtitle" class="form-label">Subtítulo</label>
                                <input type="text" class="form-control" id="portfolio_subtitle" name="portfolio_subtitle" value="<?php echo $content['portfolio']['subtitle']; ?>">
                            </div>
                        </div>
                        
                        <div class="mb-4">
                            <h5 class="border-bottom pb-2">Seção de Benefícios</h5>
                            <div class="mb-3">
                                <label for="benefits_section_title" class="form-label">Título da Seção</label>
                                <input type="text" class="form-control" id="benefits_section_title" name="benefits_section_title" value="<?php echo $content['portfolio']['benefits_section_title']; ?>">
                            </div>
                            <div class="mb-3">
                                <label for="benefits_section_subtitle" class="form-label">Subtítulo da Seção</label>
                                <input type="text" class="form-control" id="benefits_section_subtitle" name="benefits_section_subtitle" value="<?php echo $content['portfolio']['benefits_section_content']; ?>">
                            </div>
                        </div>
                        
                        <div class="mb-4">
                            <h5 class="border-bottom pb-2">Seção de Contato</h5>
                            <div class="mb-3">
                                <label for="contact_section_title" class="form-label">Título da Seção</label>
                                <input type="text" class="form-control" id="contact_section_title" name="contact_section_title" value="<?php echo $content['portfolio']['contact_section_title']; ?>">
                            </div>
                            <div class="mb-3">
                                <label for="contact_section_text" class="form-label">Texto da Seção</label>
                                <textarea class="form-control" id="contact_section_text" name="contact_section_text" rows="3"><?php echo $content['portfolio']['contact_section_content']; ?></textarea>
                            </div>
                        </div>
                        
                        <div class="text-end">
                            <button type="submit" class="btn btn-primary">Salvar Alterações</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        <!-- Página Trabalhe Conosco -->
        <div class="tab-pane fade" id="trabalhe" role="tabpanel" aria-labelledby="trabalhe-tab">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Conteúdo da Página Trabalhe Conosco</h6>
                </div>
                <div class="card-body">
                    <form class="form-admin" action="/admin/content/save" method="post">
                        <input type="hidden" name="page" value="trabalhe">
                        
                        <div class="mb-4">
                            <h5 class="border-bottom pb-2">Cabeçalho</h5>
                            <div class="mb-3">
                                <label for="trabalhe_title" class="form-label">Título</label>
                                <input type="text" class="form-control" id="trabalhe_title" name="trabalhe_title" value="<?php echo $content['trabalhe-conosco']['title']; ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="trabalhe_subtitle" class="form-label">Subtítulo</label>
                                <input type="text" class="form-control" id="trabalhe_subtitle" name="trabalhe_subtitle" value="<?php echo $content['trabalhe-conosco']['subtitle']; ?>">
                            </div>
                        </div>
                        
                        <div class="mb-4">
                            <h5 class="border-bottom pb-2">Conteúdo Principal</h5>
                            <div class="mb-3">
                                <label for="trabalhe_description" class="form-label">Descrição</label>
                                <textarea class="form-control ckeditor" id="trabalhe_description" name="trabalhe_description" rows="5"><?php echo $content['trabalhe-conosco']['description_content']; ?></textarea>
                            </div>
                        </div>
                        
                        <div class="mb-4">
                            <h5 class="border-bottom pb-2">Benefícios</h5>
                            <div class="mb-3">
                                <label for="beneficios" class="form-label">Benefícios (um por linha)</label>
                                <textarea class="form-control" id="beneficios" name="beneficios" rows="5"><?php echo $content['trabalhe-conosco']['beneficios_content']; ?></textarea>
                            </div>
                        </div>
                        
                        <div class="mb-4">
                            <h5 class="border-bottom pb-2">Seção de Depoimentos</h5>
                            <div class="mb-3">
                                <label for="depoimentos_title" class="form-label">Título da Seção</label>
                                <input type="text" class="form-control" id="depoimentos_title" name="depoimentos_title" value="<?php echo $content['trabalhe-conosco']['depoimentos_title']; ?>">
                            </div>
                            <div class="mb-3">
                                <label for="depoimentos_subtitle" class="form-label">Subtítulo da Seção</label>
                                <input type="text" class="form-control" id="depoimentos_subtitle" name="depoimentos_subtitle" value="<?php echo $content['trabalhe-conosco']['depoimentos_content']; ?>">
                            </div>
                        </div>
                        
                        <div class="text-end">
                            <button type="submit" class="btn btn-primary">Salvar Alterações</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Script para inicializar o CKEditor -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
      const textareas = document.querySelectorAll('textarea.ckeditor');
      textareas.forEach(textarea => {
        ClassicEditor
          .create(textarea)
          .catch(error => {
            console.error('Erro ao inicializar o CKEditor 5:', error);
          });
      });
    });
</script>