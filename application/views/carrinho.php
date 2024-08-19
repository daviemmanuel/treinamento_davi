<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrinho de Compras</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- Bootstrap Bundle with Popper -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="container mt-4">
        <h1>Meu Carrinho</h1>
        <!-- Botão para abrir a modal -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#cartModal">
            Ver Carrinho
        </button>

        <!-- Modal -->
        <div class="modal fade" id="cartModal" tabindex="-1" aria-labelledby="cartModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="cartModalLabel">Itens do Carrinho</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Tabela para exibir itens do carrinho -->
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">Item</th>
                                    <th scope="col">Quantidade</th>
                                    <th scope="col">Preço</th>
                                </tr>
                            </thead>
                            <tbody id="cartItems">
                                <!-- Os itens serão inseridos aqui com AJAX -->
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Script para carregar itens do carrinho -->
    <script>
        $(document).ready(function() {
            // Evento para abrir a modal e carregar os itens
            $('#cartModal').on('show.bs.modal', function () {
                $.ajax({
                    url: '/cart/items', // URL do endpoint que retorna os itens do carrinho
                    type: 'GET',
                    success: function(response) {
                        var cartItems = $('#cartItems');
                        cartItems.empty(); // Limpa os itens existentes

                        if (response.success) {
                            $.each(response.items, function(index, item) {
                                cartItems.append(
                                    '<tr>' +
                                    '<td>' + item.name + '</td>' +
                                    '<td>' + item.quantity + '</td>' +
                                    '<td>' + item.price.toFixed(2) + '</td>' +
                                    '</tr>'
                                );
                            });
                        } else {
                            cartItems.append(
                                '<tr><td colspan="3">' + response.message + '</td></tr>'
                            );
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Erro:', error);
                        $('#cartItems').append(
                            '<tr><td colspan="3">Ocorreu um erro ao carregar os itens.</td></tr>'
                        );
                    }
                });
            });
        });
    </script>
</body>
</html>
