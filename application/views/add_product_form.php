<!-- add_product_form.php -->
<h2 class="mt-4">Adicionar Produto</h2>

<?= form_open('loja/add_product', ['class' => 'mt-3']); ?>
<div class="card p-4">
    <div class="form-group">
        <label for="nome">Nome:</label>
        <input type="text" name="nome" class="form-control" value="<?= set_value('nome'); ?>"
            placeholder="Digite o nome do produto" required>
    </div>

    <div class="form-group">
        <label for="descricao">Descrição:</label>
        <textarea name="descricao" class="form-control" rows="3"
            placeholder="Descrição detalhada do produto"><?= set_value('descricao'); ?></textarea>
    </div>

    <div class="form-row">
        <div class="form-group col-md-4">
            <label for="preco">Preço:</label>
            <input type="text" name="preco" class="form-control" value="<?= set_value('preco'); ?>"
                placeholder="Preço do produto" required>
        </div>
        <div class="form-group col-md-4">
            <label for="estoque">Estoque:</label>
            <input type="number" name="estoque" class="form-control" value="<?= set_value('estoque'); ?>"
                placeholder="Quantidade em estoque" required>
        </div>
        <div class="form-group col-md-4">
            <label for="custo">Custo:</label>
            <input type="text" name="custo" class="form-control" value="<?= set_value('custo'); ?>"
                placeholder="Custo do produto" required>
        </div>
    </div>

    <div class="d-flex justify-content-end">
        <button type="submit" class="btn btn-primary mr-2">Salvar</button>
        <a href="<?= base_url('loja'); ?>" class="btn btn-secondary">Cancelar</a>
    </div>
</div>
<?= form_close(); ?>