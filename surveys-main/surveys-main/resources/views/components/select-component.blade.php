<div class="{{ $column }}">
    <div class="form-group mb-2" >
      <label for="{{ $id }}" class="form-label">{{ $label }}</label>
      <div id="{{ $id }}err">
      <select class="form-select select2" name="{{ $id }}" id="{{ $name }}" data-allow-clear="true">
        <option value="">Select</option>
        @foreach ($data as $list)
          <option value="{{ $list->$arraykey  }}" @if($value == $list->$arraykey){{ "selected" }}@endif>{{ $list->$arrayValue }}</option>
        @endforeach
      </select>  
    </div>   
       <div id="{{ $id }}_error" class="invalid-feedback d-block error-text"></div>
    </div>
   </div>