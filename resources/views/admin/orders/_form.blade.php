<!-- User ID -->
<div class="row">
    <div class="form-group col-md-12">
        <label for="user_id">Usuário</label>
        <select class="form-control col-md-12" name="user_id" id="user_id" required>
            <option value="" disabled selected>Selecione um Usuário</option>
            @foreach($users as $user)
            <option value="{{ $user->id }}" {{  isset($order) && $order->user_id == $user->id ? 'selected' : '' }}>
                {{ $user->name }}
            </option>
            @endforeach
        </select>
    </div>
</div>
<!-- Client ID -->
<div class="row">
    <div class="form-group col-md-12">
        <label for="client_id">Cliente</label>
        <select class="form-control col-md-12" name="client_id" id="client_id" required>
            <option value="" disabled selected>Selecione um cliente</option>
            @foreach($clients as $client)
            <option value="{{ $client->id }}">{{ $client->name }}</option>
            @endforeach
        </select>
    </div>
</div>

<!-- Vehicle ID -->
<div class="row">
    <div class="form-group col-md-12">
        <label for="vehicle_id">Veículo</label>
        <select class="form-control col-md-12" name="vehicle_id" id="vehicle_id" required>
            <option value="" disabled selected>Selecione um Veículo</option>
            <!-- Os veículos serão carregados aqui dinamicamente via AJAX -->
        </select>
    </div>
</div>
<!-- Status -->
<div class="row">
    <div class="form-group col-md-12">
        <label for="status">Status</label>
        <select class="form-control col-md-12" name="status" id="status" required>
            <option value="Aberta" {{  isset($order) && $order->status == 'Aberta' ? 'selected' : '' }}>Aberta</option>
            <option value="Finalizada" {{  isset($order) && $order->status == 'Finalizada' ? 'selected' : '' }}>Finalizada</option>
            <option value="Cancelada" {{  isset($order) && $order->status == 'Cancelada' ? 'selected' : '' }}>Cancelada</option>
        </select>
    </div>
</div>
<!-- Button Atualizar -->
<div class="row">
    <div class="form-group col-md-12">
        <button type="submit" class="btn btn-primary mt-3">
            {{ isset($order) ? 'Atualizar' : 'Criar' }}
        </button>
    </div>
</div>

<!-- Adicionar o script AJAX -->
<script>
    document.getElementById('client_id').addEventListener('change', function() {
        var clientId = this.value;

        // Limpar o select de veículos
        var vehicleSelect = document.getElementById('vehicle_id');
        vehicleSelect.innerHTML = '<option value="" disabled selected>Selecione um Veículo</option>';

        // Fazer uma requisição AJAX para buscar os veículos do cliente selecionado
        if (clientId) {
            fetch('/get-vehicles/' + clientId)
                .then(response => response.json())
                .then(data => {
                    // Adicionar os veículos no select de veículos
                    data.forEach(vehicle => {
                        var option = document.createElement('option');
                        option.value = vehicle.id;
                        option.text = vehicle.model + ' - ' + vehicle.plate;
                        vehicleSelect.appendChild(option);
                    });
                })
                .catch(error => console.error('Erro ao buscar veículos:', error));
        }
    });
</script>