<div class="row">
    <div class="form-group col-md-12">
        <label for="client_id">Cliente</label>
        <select class="form-control col-md-12" name="client_id" id="client_id" required>
            @foreach($clients as $client)
            <option value="{{ $client->id }}" {{  (old('client_id') ?? $vehicle->client_id ?? '' ) == $client->id ? 'selected' : '' }}>
                {{ $client->name }}
            </option>
            @endforeach
        </select>
    </div>
</div>

<div class="row">
    <div class="form-group col-md-12">
        <label for="model">Modelo</label>
        <input type="text" name="model" value="{{ old('model') ?? $vehicle->model ?? '' }}" class="form-control" id="model">
    </div>
</div>

<div class="row">
    <div class="form-group col-md-12">
        <label for="brand">Marca</label>
        <input type="text" name="brand" value="{{ old('brand') ?? $vehicle->brand ?? '' }}" class="form-control" id="brand">
    </div>
</div>

<div class="row">
    <div class="form-group col-md-12">
        <label for="plate">Placa</label>
        <input type="text" name="plate" value="{{ old('plate') ?? $vehicle->plate ?? '' }}" class="form-control" id="plate">
    </div>
</div>

<div class="row">
    <div class="form-group col-md-12">
        <button type="submit" class="btn btn-primary mt-3">
            {{ isset($vehicle) ? 'Atulizar' : 'Criar' }}
        </button>
    </div>
</div>

</div>