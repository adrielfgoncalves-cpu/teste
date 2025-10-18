 document.addEventListener('DOMContentLoaded', () => {
        const productSelect = document.getElementById('product_id');
        const quantityInput = document.getElementById('quantidade');
        const totalInput = document.getElementById('total');
        const precoHidden = document.getElementById('preco_unitario');

        function calcularTotal() {
            const selectedOption = productSelect.options[productSelect.selectedIndex];
            const preco = parseFloat(selectedOption.getAttribute('data-price')) || 0;
            const quantidade = parseFloat(quantityInput.value) || 0;
            const total = preco * quantidade;

            totalInput.value = total.toLocaleString('pt-BR', { minimumFractionDigits: 2 });
        }

        function atualizarPreco() {
            const selectedOption = productSelect.options[productSelect.selectedIndex];
            const preco = selectedOption.getAttribute('data-price') || 0;
            precoHidden.value = preco;
        }

        productSelect.addEventListener('change', calcularTotal);
        quantityInput.addEventListener('input', calcularTotal);
        productSelect.addEventListener('change', atualizarPreco);
    });

    