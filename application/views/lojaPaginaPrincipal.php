<!-- <h1>Acesso Loja</h1>
<p>Esta é a página principal do acesso loja, coloque seu código aqui</p> -->

<h2>Gerenciar Produtos</h2>

<?php if ($this->session->flashdata('success')): ?>
    <p style="color: green;"><?= $this->session->flashdata('success'); ?></p>
<?php endif; ?>
<?php if ($this->session->flashdata('error')): ?>
    <p style="color: red;"><?= $this->session->flashdata('error'); ?></p>
<?php endif; ?>

<a href="<?= base_url('loja/add_product'); ?>">Adicionar Produto</a>

<table class="table table-bordered table-striped table-hover">
    <thead class="thead-dark">
        <tr>
            <th>Nome</th>
            <th>Descrição</th>
            <th>Preço</th>
            <th>Estoque</th>
            <th>Custo</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($produtos as $produto): ?>
            <tr>
                <td><?= $produto['nome']; ?></td>
                <td><?= $produto['descricao']; ?></td>
                <td><?= $produto['preco']; ?></td>
                <td><?= $produto['estoque']; ?></td>
                <td><?= $produto['custo']; ?></td>
                <td>
                    <a href="<?= base_url('loja/edit_product/' . $produto['id_produto']); ?>"
                        class="btn btn-sm btn-warning">Editar</a>
                    <a href="<?= base_url('loja/delete_product/' . $produto['id_produto']); ?>"
                        onclick="return confirm('Tem certeza que deseja deletar este produto?');"
                        class="btn btn-sm btn-danger">Deletar</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>