@extends('../layouts/admin')
<h1>hoho</h1>
@section('formule')
  <div class="container">
    <form>

      <fieldset>
        <legend>Détail de la dum d'import, Dum N°:</legend>

        <div class="d-flex align-items-center">
          <div class="form-group col-md-5 d-flex align-items-center">
            <label for="disabledTextInput" class="form-label">N° de la Dum:</label>
            <input type="text" id="disabledTextInput" class="form-control w-100 ml-4" placeholder="Disabled input"
              disabled>
          </div>
          <div class="d-flex align-items-center ml-4">
            <span class="mr-2">Etat</span>
            <input class="form-check-input ml-5" type="checkbox" value="" id="flexCheckDisabled" disabled>
            <label class="form-check-label ml-5" for="flexCheckDisabled">
              DUM validate
            </label>
          </div>
        </div>
      </fieldset>

      <fieldset>
        <legend class="ident" style="border-bottom: 2px solid black; width:14%">
          Identification
        </legend>
        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="burau_d">Bureau de dédouanement:</label>
            <div class="input-group">
              <select id="burau_d" class="form-control">
               @foreach ($bureaus as $key => $bureau )
                <option value="{{ $key }}">{{ $bureau }}</option>
               @endforeach
              </select>
              <div class="input-group-append">
                <button class="btn btn-outline-secondary" type="button">
                  <span class="fas fa-plus"></span>
                </button>
              </div>
            </div>
          </div>
          <div class="form-group col-md-6">
            <label for="arrand">Arrandissment:</label>
            <div class="input-group">
              <select id="arrand" class="form-control">
                <option>xx</option>
                <option>xx</option>
                <option>xx</option>
              </select>
              <div class="input-group-append">
                <button class="btn btn-outline-secondary" type="button">
                  <span class="fas fa-plus"></span>
                </button>
              </div>
            </div>

          </div>
        </div>
        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="arrand">Bureau destination:</label>
            <div class="input-group">
              <select id="arrand" class="form-control">
                <option>xx</option>
                <option>xx</option>
                <option>xx</option>
              </select>
              <div class="input-group-append">
                <button class="btn btn-outline-secondary" type="button">
                  <span class="fas fa-plus"></span>
                </button>
              </div>
            </div>

          </div>
          <div class="form-group col-md-6">
            <label for="arrand">Regime:</label>
            <div class="input-group">
              <select id="arrand" class="form-control">
                <option>xx</option>
                <option>xx</option>
                <option>xx</option>
              </select>
              <div class="input-group-append">
                <button class="btn btn-outline-secondary" type="button">
                  <span class="fas fa-plus"></span>
                </button>
              </div>
            </div>

          </div>
        </div>
      </fieldset>





    </form>
  </div>
@endsection
