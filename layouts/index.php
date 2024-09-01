<?php include('header.php'); ?>





<div class="container">
    <div class="square-wrapper">
        <div class="form-section">
            <h3>Formulário para consulta de signos</h3>
            <form id="signo-form" method="POST" action="show_zodiac_sign.php">
                <div class="mb-2">
                    <label for="dataNascimento" class="form-label">Digite sua data de Nascimento:</label>
                    <input type="date" class="form-control" id="dataNascimento" name="dataNascimento" required>

                </div>
                <button type="submit" class="btn-custom">Descubra seu signo</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>