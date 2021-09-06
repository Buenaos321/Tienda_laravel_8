@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12">
        <h1>Crear producto</h1>
    </div>
</div>
<div class="row pt-4">
    <div class="col-md-12">
        <form>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="name">Nombre Del producto</label>
                        <input type="text" class="form-control" id="name" name="name">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="price">Precio</label>
                        <input type="number" class="form-control" id="price" name="price">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="description">Descripción</label>
                        <textarea class="form-control" name="description" id="description"></textarea>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="stock">Quedan en stock</label>
                        <input type="number" class="form-control" id="stock" name="stock">

                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="status">Estado</label>
                        <select name="status" id="status" class="form-control">
                            <option value="new">Nuevo</option>
                            <option value="used">Usado</option>
                            <option value="broken">Roto</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="warranty">Garantia</label>
                        <select name="warranty" id="warranty" class="form-control">
                            <option value="yes">SI</option>
                            <option value="no">No</option>
                        </select>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>


</div>
@endsection


