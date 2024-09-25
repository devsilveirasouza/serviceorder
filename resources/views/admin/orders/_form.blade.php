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
            <option value="{{ $client->id }}" {{  isset($order) && $order->client_id == $client->id ? 'selected' : '' }}>
                {{ $client->name }}
            </option>
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
            @foreach($vehicles as $vehicle)
            <option value="{{ $vehicle->id }}" {{  isset($order) && $order->vehicle_id == $vehicle->id ? 'selected' : '' }}>
                {{ $vehicle->model }} - {{ $vehicle->plate }}
            </option>
            @endforeach
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

</div>