<div class="container">

    <h1>Produtos Disponíveis</h1>
    <div class="row">
        <?php foreach ($produtos as $produto):


            ?>
            <div class="col-md-4 product-card">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4><?= $produto->nome; ?></h4>
                    </div>


                    <div class="panel-body">
                        <p><?= $produto->descricao; ?></p>
                        <p><strong>Preço:</strong> R$ <?= number_format($produto->preco, 2, ',', '.'); ?></p>
                        <p><strong>Estoque:</strong> <?= $produto->estoque; ?> unidades</p>
                        <form action="<?= base_url('cliente/comprar_produto') ?>" method="post">
                            <div class="form-group">
                                <label for="quantidade_<?= $produto->id_produto; ?>">Quantidade:</label>
                                <input type="number" name="quantidade" id="quantidade_<?= $produto->id_produto; ?>"
                                    class="form-control" min="1" max="<?= $produto->estoque; ?>" value="1" required>
                            </div>
                            <input type="hidden" name="id_produto" value="<?= $produto->id_produto; ?>">
                            <button type="submit" class="btn btn-primary">Adicionar ao Carrinho</button>
                        </form>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>